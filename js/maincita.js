MESES = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
DIAS = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo"];

var mes;
var dia;
var profesorSeleccionado;
var horarioSeleccionado;
var fechaCargada;

$(document).ready(function(){		
		$("td[button=true]").click(function(){
			if (confirm("Desea pedir esta cita")) {
			var field_id=$(this).attr("id");
			var value=$(this).attr("name");			
			console.log('value:'+value+' field:'+field_id);
			$.post('php/apartarcita.php', field_id+"="+value,function(respuesta){	
				if (respuesta=="true")
 				window.location.reload(true);
 			else
 				alert(respuesta);	
			});			
		}
		});
	$("td[button=false]").click(function(){
			if (confirm("Desea cancelar esta cita?")) {
			var field_id=$(this).attr("id");
			var value=$(this).attr("name");			
			console.log('value:'+value+' field:'+field_id);
			$.post('php/cancelarcita.php', field_id+"="+value,function(respuesta){	
				if (respuesta=="true")
 				window.location.reload(true);
 			else
 				alert(respuesta);		
			});			
		}
		});	

		cargaMes();
		eventoClickPedirCita();
		eventosCalendario();
		eventoProfesor();
	});	

function eventoProfesor(){
	$("select#profesor").change(cargaDiasProfesor);
}

function cargaDiasProfesor(){
	
	profesorSeleccionado = this.value;
	resetCalendario();

	$.get("php/profesorRouter.php","accion=getDias&profesor="+profesorSeleccionado, function(data){
		var dias = $.parseJSON(data); 

		for(var dia in dias){
			$("#calendarTable td[data-dia='" + dias[dia] + "']").addClass("btn btn-primary");
		}

		eventoClickDia();
	});
}

function eventosCalendario(){
	$("#previousMonthButton").click(function(){
		cargaMes();
	});
	$("#nextMonthButton").click(function(){
		cargaMes(mes + 1);
	});
}

function cargaMes(mes){
	resetCalendario();

	var fecha = new Date();
	
	if(mes){
		fecha.setMonth(mes);
	}
	fechaCargada = fecha;
	this.mes = fecha.getMonth();

	$("#calendarMonth").text(MESES[this.mes]);
	ocultaBotonesNavMeses();
	cargaDias(this.mes);
}

function ocultaBotonesNavMeses(){
	$("#previousMonthButton").toggleClass("hidden");
	$("#nextMonthButton").toggleClass("hidden");
}

function cargaDias(mes){
	var dias = getDiasDelMes(mes);
	var diaSemanaComienzoMes = getPrimerDiaSemanaMes(mes);

	var semanaIncompleta = (dias + diaSemanaComienzoMes) % DIAS.length > 0;
	var semanasCalendario = Math.trunc((dias + diaSemanaComienzoMes) / DIAS.length) + (semanaIncompleta ? 1 : 0);
	var celdasCalendario = new Array();

	var celda = 0;
	var diasPintados = 1;

	for (var semana = 0; semana < semanasCalendario; semana++) {
		celdasCalendario[semana] = new Array();

		for (var dia = 0; dia < DIAS.length; dia++) {

			if(celda >= diaSemanaComienzoMes && diasPintados <= dias){
				celdasCalendario[semana][dia] = diasPintados;
				diasPintados++;
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
	fecha.setMonth(mes + 1);
	fecha.setDate(0); // Devuelve el último día del mes anterior

	return fecha.getDate();
}

function getPrimerDiaSemanaMes(mes){
	var fecha = new Date();
	fecha.setMonth(mes);
	fecha.setDate(1);

	var diaSemana = fecha.getDay();
	return getDiaCompatibleConArray(diaSemana);
}

//Parseo de compatibilidad con el Array DIAS, dado que la API devuelve 0 = Domingo
function getDiaCompatibleConArray(diaSemanaAPI){
	var diaCompatible = diaSemanaAPI - 1;
	
	if(diaSemanaAPI == 6){
		diaCompatible = 0;
	}else if(diaSemanaAPI == 0){
		diaCompatible = 6;
	}

	return diaCompatible; 
}

function pintaDiasCalendario(semanas){
	var calendarTable = $("#calendarTable tbody");
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
	$("#calendarTable td.btn").click(cargaHoras);
}

function cargaHoras(){
	var diaSemana = $(this).attr("data-dia");
	var profesor = profesorSeleccionado;
	dia = $(this).text();

	$.get("php/profesorRouter.php","accion=getHoras&profesor="+profesorSeleccionado+"&diaSemana="+diaSemana, function(data){
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
	var contador = 0;

	for (var fila = 0; fila < filas; fila++) {
		var nodoFila = $("<tr></tr>");

		for (var hora = 0; hora < CELDAS_POR_FILA; hora++){
			
			if(contador >= horario.length){
				break;
			}

			var nodoCelda = $("<td></td>").text(horario[contador]["hora_inicio"]);

			if(horario[contador]["estado"] == 0){
				nodoCelda.addClass("btn btn-primary");
				nodoCelda.attr("data-id", horario[contador]["id_horario"]);
			}

			nodoFila.append(nodoCelda);
			contador++;
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
	$.post("php/apartarcita.php","horario="+horarioSeleccionado+"&day="+dia+"&month="+(mes + 1)+"&year="+fechaCargada.getFullYear(), function(data){
		alert(data);
	});
}

