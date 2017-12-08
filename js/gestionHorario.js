$(document).ready(function(){
	registraEventoClickDia();
	registraEventoBotonesForm();
});

var diaSemanaSeleccionado; //O-based, Lunes = 0
var intervalo; //minutos
var horasSeleccionadas = new Array(); // [[9:40,10:00],[10:00,10:20]]

function registraEventoClickDia(){
	$("#diasPanel .btn").click(clickDiaHandler);
}

function registraEventoBotonesForm(){
	$("#formIntervalo #btnHoras").click(btnMostrarHorasHandler);
	$("#formIntervalo #btnGuardar").click(btnGuardarHandler);
}

function registraEventoBotonesHora(){
	$("#hoursTable .btn").click(clickHoraHandler);
}

function clickDiaHandler(){
	diaSemanaSeleccionado = $(this).attr("data-dia");
	remarcaDiaSeleccionado(this);
	resetHoras();
	habilitaFormulario();
}

function btnMostrarHorasHandler(){
	if(validaForm()){
		calculaHoras();
		registraEventoBotonesHora();
	}
}

function btnGuardarHandler(){
	registraHoras();
	deshabilitaBotonGuardar();
}

function validaForm(){
	var horaInicio = $("#formIntervalo #horaInicio").val();
	var horaFin = $("#formIntervalo #horaFin").val();

	if(horaInicio >= horaFin){
		pintaErrorValidacion("La hora de fin debe ser mayor que la hora de inicio");
		return false;
	}

	return true;
}

function calculaHoras(){
	var horaInicio = $("#formIntervalo #horaInicio").val();
	var horaFin = $("#formIntervalo #horaFin").val();
	var intervaloMinutos = $("#formIntervalo #intervalo").val();

	if(!intervaloMinutos){
		return;
	}

	intervaloMinutos = Number(intervaloMinutos);

	// Separa horas y minutos en un array
	var horaMinutoInicio = horaInicio.split(":"); 
	var horaMinutoFin = horaFin.split(":");

	//Preparamos 1 objeto de fecha con la hora de inicio para que la API se encargue de establecer correctamente las horas y los minutos cuando vayamos iterando sobre tramos
	var fechaInicial = new Date();
	fechaInicial.setHours(horaMinutoInicio[0]);
	fechaInicial.setMinutes(horaMinutoInicio[1]);

	var fechaFin = new Date();
	fechaFin.setHours(horaMinutoFin[0]);
	fechaFin.setMinutes(horaMinutoFin[1]);
	
	//Calcula el número de tramos que hay entre las 2 horas
	var minutosDiferencia = getDiferenciaMinutos(fechaInicial, fechaFin);
	var esUltimoTramoIncompleto = Math.min(minutosDiferencia % intervaloMinutos, 1); // Flag identificativo si la duración del ultimo tramo es inferior a la definida en el intervalo
	var numeroTramosHorario = minutosDiferencia / intervaloMinutos + esUltimoTramoIncompleto;

	var contadorMinutosProcesados = 0;
	var tramosHorarios = new Array();
	
	//Crea un listado de tramos con las horas de inicio y fin de cada tramo [[hora inicio, hora fin], [hora inicio, hora fin], [hora inicio, hora fin]]
	while(contadorMinutosProcesados < minutosDiferencia){
		var horaInicialTramo = fechaInicial.getHours() + ":" + fechaInicial.getMinutes();
		fechaInicial.setMinutes(fechaInicial.getMinutes() + intervaloMinutos); //Actualiza la hora para el siguente tramo
		var horaFinalTramo = fechaInicial.getHours() + ":" + fechaInicial.getMinutes();

		tramosHorarios.push([normalizaHora(horaInicialTramo), normalizaHora(horaFinalTramo)]); 
		contadorMinutosProcesados+=intervaloMinutos;
	}

	//En el caso de que el ultimo tramo sea incompleto se actualiza el valor obtenido del calulo anterior por la hora final insertada por el usuario
	if(esUltimoTramoIncompleto){
		tramosHorarios[tramosHorarios.length - 1][1] = horaFin; //en el indice 1 es donde se guarda la hora de fin [[hora inicio, hora fin]]
	}

	pintarHoras(tramosHorarios);
}

function normalizaHora(hora){
	var horaMinuto = hora.split(":");

	var hora = horaMinuto[0] + "";
	hora = (hora.length >= 2 ? hora : "0"+hora);

	var minutos = horaMinuto[1] + "";
	minutos = (minutos.length >= 2 ? minutos : "0"+ minutos);

	return hora + ":" + minutos;
}

function getDiferenciaMinutos(fechaInicio, fechaFin){
	var fechaInicioMilisegundos = fechaInicio.getTime();
	var fechaFinMilisegundos = fechaFin.getTime();

	var diferenciaMilisegundos = fechaFinMilisegundos - fechaInicioMilisegundos;
	var diferenciaMinutos = diferenciaMilisegundos / 1000 / 60; // Pasa a minutos los milisegundos obtenidos entre las 2 fechas

	return diferenciaMinutos;
}

function registraHoras(){
	var datos = "dia=" + diaSemanaSeleccionado + "&horas=" + JSON.stringify(horasSeleccionadas);

	$.post("php/horarioRouter.php?accion=registraHorario", datos, function(resultado){
		if(resultado == 'true'){
			alert("Horas guardadas correctamente");
		}else{
			console.error(resultado);
			alert("Hubo un error al insertar las horas, consulte un administrador");
		}
	});
}

function clickHoraHandler(){
	agregaHora($(this).text(), $(this).attr("data-fin"));
	$(this).removeClass("btn-primary").addClass("btn-success").unbind('click');
	habilitaBotonGuardar();
}

function agregaHora(horaInicio, horaFin){
	horasSeleccionadas.push([horaInicio, horaFin]);
}

function remarcaDiaSeleccionado(diaButton){
	$("#diasPanel .btn-success").removeClass("btn-success").addClass("btn-primary"); //Desmarca el dia anterior seleccionado, si lo hubiera
	$(diaButton).removeClass("btn-primary").addClass("btn-success");
}

function pintarHoras(horas){
	resetHoras();
	var HORA_INICIO_INDEX = 0;
	var HORA_FIN_INDEX = 1;

	var tablaHoras = $("#hoursTable tbody");
	var horasPintadas = 0;
	var hora;
	var fila;
	
	do{
		var horaInicioTramo = horas[horasPintadas][HORA_INICIO_INDEX];
		var horaFinTramo = horas[horasPintadas][HORA_FIN_INDEX];

		// En el caso que se pase a otra hora se crea una nueva fila con un indicador de la hora que corresponde a esa fila
		var horaInicioSeparada = horaInicioTramo.split(":")[0];
		if(!hora || hora != horaInicioSeparada){
			hora = horaInicioSeparada;
			fila = $("<tr />").append($("<th />").text(horaInicioSeparada));
			tablaHoras.append(fila);
		}

		var celdaTramo = $("<td />").addClass("btn btn-primary").text(horaInicioTramo).attr("data-fin", horaFinTramo);
		fila.append(celdaTramo);

		horasPintadas++;
	}while(horasPintadas < horas.length);

	$("#hoursTable").removeClass("hidden");
}

function resetHoras(){
	horasSeleccionadas = new Array();
	$("#hoursTable tbody").empty();
	$("#hoursTable").addClass("hidden");
	deshabilitaBotonGuardar();
}

function habilitaFormulario(){
	$("#formIntervalo fieldset").removeAttr("disabled");
}

function deshabilitaBotonGuardar(){
	$("#formIntervalo #btnGuardar").addClass("disabled");
}

function habilitaBotonGuardar(){
	$("#formIntervalo #btnGuardar").removeClass("disabled");
}

function pintaErrorValidacion(mensaje){
	//Crea un componente HTML para mostrar el mensaje de error con estilo de bootstrap
	var alertNodo = $("<div/>").addClass("alert alert-danger alert-dismissable fade in show");
	var nodoCerrarAlert = $("<a/>").text("x").addClass("close").attr({"href":"#","data-dismiss":"alert","aria-label":"close"});
	var mensajeNodo = $("<span/>").text(mensaje);
	
	alertNodo.append(nodoCerrarAlert);
	alertNodo.append(mensajeNodo);

	$("#formIntervalo fieldset").prepend(alertNodo); // Añade el elemento html de error al principio del formulario
}
