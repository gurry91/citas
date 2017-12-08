<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

	function registraHorario($profesor, $dia, $horas){
		const HORA_INICIO_INDEX = 0;
		const HORA_FIN_INDEX = 1;

		$conexion = getDBConexion();

		$sql = "INSERT INTO horarios (id_profesor, hora_inicio, hora_fin, dia) VALUES ";

		$horasSql = array();
		
		foreach ($horas as $hora) {
			
			$horaInicio = $horas[$hora][HORA_INICIO_INDEX];
			$horaFin = $horas[$hora][HORA_FIN_INDEX];

			array_push($horasSql, sprintf("(%d,'%s','%s', %d)", $profesor, $horaInicio, $horaFin, $dia));
		}

		$sql .= implode(",", $horasSql); //Une los valores del array con las sql de las horas separadarandolas por coma

		mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		closeConexion($conexion);

		return true;
	}

	function getDBConexion() {
		global $servidor,$server_admin,$server_pass, $database;

		$conexion = mysqli_connect($servidor,$server_admin,$server_pass, $database) or die ("no se encuentra la bd");

		if (mysqli_connect_errno()) {
		    die("Falló la conexión: " . mysqli_connect_error());
		}

		return $conexion;
	}

	function closeConexion($conexion){
		mysqli_close($conexion);
	}
 ?>
