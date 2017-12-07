<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';

	$GLOBALS["rolesPermitidos"] = Array(); // Roles permitidos para cosultar la pantalla

	//Comprueba si el rol del usuario está en el listado de roles permitidos
	function compruebaPermisos(){
		global $rolesPermitidos;
		session_start(); //inicio sesion
		
		if(isset($_SESSION['rol'])){
			if (!in_array($_SESSION['rol'], $rolesPermitidos) ){
				header("Location: error/error403.php"); 
			}
		}
		else{ 
			header("Location: index.php" ); 
		}
	}

	// Añade un rol como permitido
	function setRolPermitido($rol){
		global $rolesPermitidos;

		array_push($rolesPermitidos, $rol);
	}

?>
