<?php
$conexion=(mysqli_connect("localhost","root","entrar"));
mysqli_select_db($conexion,'citas') or die ("no se encuentra la bd");
mysqli_set_charset($conexion,"utf8");
?>
