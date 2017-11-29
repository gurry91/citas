<?php
if(!empty($_POST)){
	session_start();
	foreach($_POST as $field_name=>$val){
	//	error_log("name:" . $field_name);
		$_SESSION['consultado']=$val;
		if(!empty($_SESSION['consultado'])){
			echo "true";
		}else{
			echo "false";
		}
}
}
?>