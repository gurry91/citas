<?php
if(!empty($_POST)){
	$enlace=mysql_connect('localhost','root','entrar');
	if (!$enlace){
		die('no se pudo conectar: '.mysql_error());
	}
	mysql_select_db('citas');
	foreach($_POST as $field_name=>$val){
		$field_id=strip_tags(trim($field_name));
		if(!empty($field_id)){
			mysql_query("DELETE FROM usuarios where n_usuario='$field_id'") or mysql_error();
			echo"true";
		}else{
			echo"false";
		}
	}
}
?>