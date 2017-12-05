<?php 

	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$dias = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");

	function nombreMesActual(){
		return $meses[date( "n" )];
	}
 ?>