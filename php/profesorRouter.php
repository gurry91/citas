<?php 
	include "./profesorUtils.php";

	if(!empty($_GET)){
		$accion = $_GET["accion"];

		switch ($accion) {
		case 'getDias':
			$dias = obtenerDiasSemana($_GET['profesor']);
			echo json_encode($dias);
			break;
		case 'getHoras':
			$horario = obtenerHorario($_GET['diaSemana'],$_GET['profesor'], $_GET['fecha']);
			echo json_encode($horario);
			break;
		default:
			break;
		}	
	}

 ?>