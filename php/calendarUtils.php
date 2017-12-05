<?php 

	$GLOBALS['meses'] = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$GLOBALS['dias'] = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");

	function nombreMesActual() {
		global $meses;

		return $meses[date( "n" ) - 1];
	}

	function mesActual(){
		date( "n" );
	}

	function nombreMesSiguiente(){
		global $meses;

		return $meses[date( "n", strtotime('+1 month')) - 1];
	}

 ?>