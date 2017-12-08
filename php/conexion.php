<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

$conexion=(mysqli_connect($servidor,$server_admin,$server_pass));
mysqli_select_db($conexion,$database) or die ("no se encuentra la bd");
mysqli_set_charset($conexion,"utf8");
?>
