<?php 
	include $_SERVER['DOCUMENT_ROOT'] . '/citas/php/horarioUtils.php';

	if(!empty($_GET)){
		$accion = $_GET["accion"];

		switch ($accion) {
			case 'registraHorario':
				if(!isset($_POST['dia']) || !isset($_POST['horas'])){

					echo "Deben enviarse todos los datos (Profesor, dia semana, horas)";
				}else{
					session_start();
					$profesor = empty($_POST['profesor']) ? $_SESSION['usuario'] : $profesor; //En caso de que el id del profesor no venga por parámetro se coge de session

					registraHorario($profesor, $_POST['dia'], json_decode($_POST['horas']));
					echo "true";		
				}
				break;
			default:
				break;
		}	
	}

 ?>