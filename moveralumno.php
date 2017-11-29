<?php
if(!empty($_POST)){
	$conexion=(mysqli_connect("localhost","root","entrar"));
    mysqli_select_db($conexion,'citas') or die ("no se encuentra la bd");	
	foreach($_POST as $field_name=>$val){
//		echo $field_name; //codigo del horario
//		echo $val; // nombre del paciente		
				if(!empty($field_name)&&!empty($val)){					 
					mysqli_query($conexion,"UPDATE horarios set alumno='' where alumno='$val'");
					mysqli_query($conexion,"UPDATE datosusuario set cita='$field_name' where id_usuario='$val'");
					mysqli_query($conexion,"UPDATE horarios set alumno='$val' where id_horario='$field_name'");
					echo"usuario movido exitosamente";
				}else{
					echo"no se pudo actualizar";
				}
	}
}
?>