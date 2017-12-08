$(document).ready(function(){
	registraEventoClickDia();
	registraEventoBotonesForm();
});

var diaSemanaSeleccionado; //O-based, Lunes = 0
var intervalo; //minutos
var horasSeleccionadas = new Array(); // [9:40,10:00,11:20]

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
	calculaHoras();
}

function btnGuardarHandler(){
	registraHoras();
}

function validaForm(){
	var horaInicio = $("#formIntervalo #horaInicio").val();
	var horaFin = $("#formIntervalo #horaFin").val();
	var intervalo = $("#formIntervalo #intervalo").val();

	var mensajes = new Array();

	if(horaInicio <= horaFin){
		mensajes.push("La hora de fin debe ser mayor que la hora de inicio");
	}

}

function calculaHoras(){

}

function registraHoras(){}

function clickHoraHandler(){
	agregaHora($(this).text());
}

function agregaHora(hora){
	horasSeleccionadas.push(hora);
}

function remarcaDiaSeleccionado(diaButton){
	$("#diasPanel .btn-success").removeClass("btn-success").addClass("btn-primary"); //Desmarca el dia anterior seleccionado, si lo hubiera
	$(diaButton).removeClass("btn-primary").addClass("btn-success");
}

function pintarHoras(){
	resetHoras();
}

function resetHoras(){
	horasSeleccionadas = new Array();
	$("#hoursTable tbody").empty();
	$("#hoursTable").addClass("hidden");
}

function habilitaFormulario(){
	$("#formIntervalo fieldset").removeAttr("disabled");
}

function deshabilitaFormulario(){
	$("#formIntervalo fieldset").attr("disabled", true);
}

function pintaErrorValidacion(mensajes){
	var listaMensajesNodo = $("#formMensajes ul"); //Obtiene el elemento html del que colgarán los mensajes de error

	//Crea un elemento de lista <li> por cada mensaje a mostrar
	for (var mensaje in mensajes) {
		var mensajeNodo = $("<li/>").text(mensaje);
		listaMensajesNodo.appendChild(mensajeNodo);
	}

	listaMensajesNodo.removeClass("hidden");
}