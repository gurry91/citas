<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
	
	setRolPermitido(ROL_PROFESOR);
	compruebaPermisos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Bienvenido Profesor</title>
</head>
<body>
   <div class="container">
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
  </div>

<!--//////////////////////////////////////////////////-->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
</body>