<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

if(!empty($_POST)){
	$enlace=mysqli_connect($servidor,$server_admin,$server_pass, $database) or die('no se pudo conectar: '.mysqli_connect_errno());
	
	foreach($_POST as $field_name=>$val){
		$field_id=strip_tags(trim($val));
		if(!empty($field_id)){
			mysqli_query($enlace, "DELETE FROM usuarios where n_usuario='$field_id'") or mysqli_error($enlace);
			mysqli_close($enlace);
			echo"true";
		}else{
			echo"false";
		}
	}
}
?>