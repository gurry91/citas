<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';
	session_start(); //inicio sesion
		
		if(isset($_SESSION['rol'])){
			if ($_SESSION['rol'] !=  ROL_ALUMNO ){
				
				header("Location: error/error403.php"); 
			}
		}
		else{ 
			header("Location: error/error403.php" ); 
		}
		
					
					
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Bienvenido</title>
</head>
<body>
 <div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>
<!--////////////////////////////////////////////////-->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
</body>