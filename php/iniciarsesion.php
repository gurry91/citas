<?php
include './credenciales.php';

if(!empty($_POST)){
	session_start();
	$conexion=(mysqli_connect("$servidor","$server_admin","$server_pass"));
    mysqli_select_db($conexion,$database) or die ("no se encuentra la bd");	
	$user=$_POST['usuario'];
	$pass=md5($_POST["password"]);

	$sql="SELECT usuarios.id,usuarios.nombre, usuarios.password, roles.descripcion rol FROM usuarios
	INNER JOIN roles ON (roles.id = usuarios.rol) WHERE usuarios.n_usuario='$user'";

	$consulta=mysqli_query($conexion,$sql)or die(mysqli_error());
	if($fila=mysqli_fetch_array($consulta,MYSQL_ASSOC)){
		if($pass==$fila['password']){
			$_SESSION['nombre']=$user;
			$_SESSION['rol']=$fila['rol'];
			$_SESSION['usuario'] = $fila['id'];

			echo $fila['rol'];
		}else{
			session_destroy();
			mysqli_close($conexion);
			echo "Contraseña incorrecta";
		}
		
	}else{
		session_destroy();
		mysqli_close($conexion);
		echo "este usuario no existe";
	}
}
?>