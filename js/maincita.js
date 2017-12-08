// Definición se meses y días dado que la API de javascript devuelve los textos en inglés
MESES = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
DIAS = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];

// Variables globales
var dia;
var profesorSeleccionado;
var horarioSeleccionado;
var fechaCargada;

$(document).ready(function(){ //jQuery onload - Ejecuta el contenido cuando carga la pantalla		
	cargaMes();
	eventoClickPedirCita();
	eventosCalendario();
	eventoProfesor();
});	

function eventoProfesor(){
	$("select#profesor").change(cargaDiasProfesor);
}

function cargaDiasProfesor(){
	
	if(this.value){
		profesorSeleccionado = this.value;
	}

	resetCalendario();

	$.get("php/profesorRouter.php","accion=getDias&profesor="+profesorSeleccionado, function(data){ 
		var dias = $.parseJSON(data);
		var fechaActual = new Date();

		//Añade estilo botón a los días del calendario que estén en un dia de la semana habilitado para citas del profesor seleccionado
		for(var dia in dias){
			$("#calendarTable td[data-dia='" + dias[dia] + "']").each(function(){
				//Obtiene la fecha del elemento de calendario por el que va iterando
				var fechaElemento = new Date(fechaCargada.getTime());
				fechaElemento.setDate($(this).text());

				// Si es una fecha mayor o igual al día de hoy lo habilita para ser seleccionable
				if(fechaElemento.getTime() >= fechaActual.getTime()){
					$(this).addClass("btn btn-primary");
				}
			}); 
		}

		eventoClickDia();
	});
}

function eventosCalendario(){
	$("#previousMonthButton").click(function(){
		cargaMes();
	});
	$("#nextMonthButton").click(function(){
		cargaMes(fechaCargada.getMonth() + 1);
	});
}

function cargaMes(mes){
	resetCalendario();

	var fecha = new Date(); 
	
	if(mes){
		fecha.setMonth(mes); // Si el mes es superior a 12 la API pasa al siguiente año
	}else{
		mes = fecha.getMonth();
	}

	fechaCargada = fecha;

	$("#calendarMonth").text(MESES[fecha.getMonth()]);
	ocultaBotonesNavMeses();

	cargaDias(mes);
	
	if(profesorSeleccionado){
		cargaDiasProfesor();
	}
}

function ocultaBotonesNavMeses(){
	$("#previousMonthButton").toggleClass("hidden");
	$("#nextMonthButton").toggleClass("hidden");
}

/** Carga los días de un mes */
function cargaDias(mes){
	
	var dias = getDiasDelMes(mes);
	var diaSemanaComienzoMes = getPrimerDiaSemanaMes(mes);
	
	// Calcula el numero de semanas que necesito para pintar el calendario en función del día de la semana en que comience el mes y el numero total de días del mes
	var semanaIncompleta = (dias + diaSemanaComienzoMes) % DIAS.length > 0;
	var semanasCalendario = Math.trunc((dias + diaSemanaComienzoMes) / DIAS.length) + (semanaIncompleta ? 1 : 0);

	var celdasCalendario = new Array();

	var celda = 0; //Contador de celdas que se agregan al calendario
	var diasAgregados = 1; // Contador de días que se agregan al calendario

	// Rellena un array bidimensional (Semana / día semana) que representará el calendario para el mes
	for (var semana = 0; semana < semanasCalendario; semana++) { // Agrega semanas
		celdasCalendario[semana] = new Array();

		for (var dia = 0; dia < DIAS.length; dia++) { //Agrega dias

			if(celda >= diaSemanaComienzoMes && diasAgregados <= dias){
				celdasCalendario[semana][dia] = diasAgregados;
				diasAgregados++;	
			}else{
				celdasCalendario[semana][dia] = null;
			}

			celda++;
		}
	}

	pintaDiasCalendario(celdasCalendario);

}

function getDiasDelMes(mes){
	var fecha = new Date();
	fecha.setMonth(mes);
	fecha.setDate(0); // Devuelve el último día del mes anterior

	return fecha.getDate();
}

function getPrimerDiaSemanaMes(mes){
	var fecha = new Date();
	fecha.setMonth(mes);
	fecha.setDate(1);

	return getDiaSemana(fecha);
}

//Parseo de compatibilidad con el Array DIAS, dado que la API devuelve 0 = Domingo
function getDiaSemana(fecha){
	var diaSemanaAPI = fecha.getDay();
	var diaCompatible = diaSemanaAPI - 1;
	
	if(diaSemanaAPI == 6){
		diaCompatible = 0;
	}else if(diaSemanaAPI == 0){
		diaCompatible = 6;
	}

	return diaCompatible; 
}

function pintaDiasCalendario(semanas){
	var calendarTable = $("#calendarTable tbody"); //Guarda el elemento HTML tbody para posteriormente agregarle los dias
	calendarTable.empty(); //Resetea el contenido del mes previo

	for (var semana in semanas) {
		var nodoFila = $("<tr></tr>");
		for (var dia in semanas[semana]) {
			var nodoCelda = $("<td></td>").text(semanas[semana][dia]);
			
			if(semanas[semana][dia] != null){
				nodoCelda.attr("data-dia", dia);
			}

			nodoFila.append(nodoCelda);
		}
		calendarTable.append(nodoFila);
	}
}

function eventoClickDia(){
	$("#calendarTable td.btn").click(clickDiaHandler); //Aplica evento click solamente los días seleccionables
}

function clickDiaHandler(){
	cargaHoras($(this).text());
}

function cargaHoras(diaSeleccionado){
	dia = diaSeleccionado;

	var fechaSeleccionada = new Date(fechaCargada.getTime());
	fechaSeleccionada.setDate(diaSeleccionado);
	var diaSemana = getDiaSemana(fechaSeleccionada);
	var profesor = profesorSeleccionado;

	var fechaSerializada = fechaSeleccionada.toISOString(); //(YYYY-MM-DDTHH:mm:ss) Convierte la fecha a texto
	fechaSerializada = fechaSerializada.substring(0, fechaSerializada.indexOf("T")); // Omite la hora (YYYY-MM-DD)

	$.get("php/profesorRouter.php","accion=getHoras&profesor="+profesorSeleccionado+"&diaSemana="+diaSemana+"&fecha="+fechaSerializada, function(data){
		var horario = $.parseJSON(data); 
		if(horario != null && horario.length > 0){
			pintaHorario(horario);
		}
	});	
}

function pintaHorario(horario){
	resetHorario();
	var horarioTabla = $("#hoursTable tbody");
	var CELDAS_POR_FILA = 7;

	var filas = Math.ceil(horario.length / CELDAS_POR_FILA);
	var hora = 0;

	for (var fila = 0; fila < filas; fila++) {
		var nodoFila = $("<tr></tr>");

		for (var horaFila = 0; horaFila < CELDAS_POR_FILA; horaFila++){
			
			if(hora >= horario.length){
				break;
			}

			var nodoCelda = $("<td></td>").text(horario[hora]["hora_inicio"]);

			if(horario[hora]["estado"] == 0){
				nodoCelda.addClass("btn btn-primary");
				nodoCelda.attr("data-id", horario[hora]["id_horario"]);
			}

			nodoFila.append(nodoCelda);
			hora++;
		}

		
		horarioTabla.append(nodoFila);
	}

		$("#hoursTable").removeClass("hidden");
		eventoClickHora();
}


function resetCalendario(){
	$("#calendarTable td.btn").removeClass("btn btn-primary"); //Resetea el contenido, si lo hay
	resetHorario();

}

function resetHorario(){
	$("#hoursTable tbody").empty(); //Resetea el contenido, si lo hay
	$("#hoursTable").addClass("hidden");
	$("#btnCita").attr("disabled","true");
}

function eventoClickHora(){
	$("#hoursTable td.btn").click(function (){
		horarioSeleccionado = $(this).attr("data-id");
		$("#btnCita").removeAttr("disabled");
	});	
}

function eventoClickPedirCita(){
	$("#btnCita").click(registrarCita);
}

function registrarCita(){
	$.post("php/apartarcita.php","horario="+horarioSeleccionado+"&day="+dia+"&month="+(fechaCargada.getMonth() + 1)+"&year="+fechaCargada.getFullYear(), function(data){
		alert(data);
		cargaHoras(dia);
	});
}

