<?php 
	include "./horarioUtils.php";

	if(!empty($_GET)){
		$accion = $_GET["accion"];

		switch ($accion) {
			case 'registraHorario':
				if(empty($_POST['profesor']) || empty($_POST['dia']) || empty($_POST['horas'])){
					echo "Deben enviarse todos los datos (Profesor, dia semana, horas)";
				}else{
					registraHorario($_POST['profesor'], $_POST['dia'], json_decode($_POST['horas']));
					echo "true";		
				}
				break;
			default:
				break;
		}	
	}

 ?>