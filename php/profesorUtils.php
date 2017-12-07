<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

	function obtenerProfesores(){
		$conexion = getDBConexion();
		$sql = sprintf("SELECT usuarios.* FROM usuarios INNER JOIN roles ON (roles.id = usuarios.rol ) WHERE roles.descripcion = '%s'", ROL_PROFESOR);

		$resultSet = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		$profesores = array();
		
		while($fila=mysqli_fetch_array($resultSet,MYSQL_ASSOC)){
			$profesores[] = $fila;
		}

		closeConexion($conexion);

		return $profesores;

	}	

	function obtenerDiasSemana($profesor){
		$conexion = getDBConexion();
		$sql = sprintf("SELECT DISTINCT dia FROM horarios WHERE profesor = '%d'", $profesor);

		$resultSet = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		$dias = array();
		
		while($fila=mysqli_fetch_array($resultSet,MYSQL_ASSOC)){
			$dias[] = $fila["dia"];
		}

		closeConexion($conexion);

		return $dias;

	}	


	function obtenerHorario($diaSemana, $profesor, $fecha){
		$conexion = getDBConexion();
		$sql = sprintf("SELECT horarios.id_horario, horarios.hora_inicio, (CASE WHEN citas.id_horario IS NULL THEN 0 ELSE 1 END) estado FROM horarios LEFT JOIN citas ON (citas.id_horario = horarios.id_horario AND citas.fecha = '%s') WHERE horarios.profesor = %d AND horarios.dia = %d", $fecha, $profesor, $diaSemana);

		$resultSet = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
		$dias = array();
		
		while($fila=mysqli_fetch_array($resultSet,MYSQL_ASSOC)){
			$dias[] = $fila;
		}

		closeConexion($conexion);

		return $dias;

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