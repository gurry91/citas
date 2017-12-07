<?php
include $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

if(!empty($_POST)){
	session_start();
	$alumno = $_SESSION["usuario"];
	$horario = $_POST["horario"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];

	$fecha = date("Y-m-d", mktime(0,0,0,$month,$day,$year));

	$conexion = mysqli_connect($servidor,$server_admin,$server_pass, $database) or die ("no se encuentra la bd");

	if (mysqli_connect_errno()) {
		die("Falló la conexión: " . mysqli_connect_error());
	}

	$sql = sprintf("INSERT INTO citas (id_horario, id_usuario, fecha) VALUES (%d,%d,'%s')", $horario, $alumno, $fecha);

	mysqli_query($conexion,$sql) or die(mysqli_error($conexion));
	mysqli_close($conexion);

	die("Se ha guardado las cita");
}
?>