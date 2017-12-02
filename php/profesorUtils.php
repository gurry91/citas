<?php 
	include_once './credenciales.php';
	include_once '../constantes.php';


	function obtenerProfesores(){
		$conexion = getDBConexion();
		$sql = "SELECT usuarios.* FROM usuarios INNER JOIN roles ON (roles.id = usuarios.rol ) WHERE roles.descripcion = " . ROL_PROFESOR;

		$resultSet=mysqli_query($conexion,$sql) or die(mysqli_error());
		$profesores = array();
		
		while($fila=mysqli_fetch_array($resultSet,MYSQL_ASSOC)){
			$profesores[] = $fila;
		}

		closeConexion($conexion);
		return $profesores;

	}	

	function getDBConexion() {
		global $servidor,$server_admin,$server_pass, $database;

		return mysqli_connect($servidor,$server_admin,$server_pass, $database) or die ("no se encuentra la bd");
	}

	function closeConexion($conexion){
		mysqli_close($conexion);
	}

 ?>