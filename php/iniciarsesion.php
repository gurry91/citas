<?php
if(!empty($_POST)){
	session_start();
	$conexion=(mysqli_connect("localhost","root","entrar"));
    mysqli_select_db($conexion,'citas') or die ("no se encuentra la bd");	
	$user=$_POST['usuario'];
	$pass=$_POST["password"];
	$sql="SELECT * FROM usuarios WHERE n_usuario='$user'";
	$consulta=mysqli_query($conexion,$sql)or die(mysqli_error());
	if($fila=mysqli_fetch_array($consulta,MYSQL_ASSOC)){
//		echo "este usuario existe";
		if($pass==$fila['password']){
//			echo "contraseña correcta";
			$_SESSION['nombre']=$user;
			$_SESSION['rol']=$fila['rol'];
			echo $fila['rol'];
		}else{
			session_destroy();
			mysqli_close($conexion);
			echo "contraseña incorrecta";
		}
		
	}else{
		session_destroy();
		mysqli_close($conexion);
		echo "este usuario no existe";
	}
}
?>