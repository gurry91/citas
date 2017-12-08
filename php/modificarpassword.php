<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/credenciales.php';

if(!empty($_POST)){
	session_start();
	$conexion=mysqli_connect($servidor,$server_admin,$server_pass, $database) or die ("no se encuentra la bd") ;
	$vieja=$_POST['password0'];
	$nueva=$_POST['password1'];
    $usuario=$_SESSION['nombre'];
	$sql="SELECT * FROM usuarios WHERE n_usuario='$usuario'";	
	$consulta=mysqli_query($conexion,$sql)or die(mysqli_error());
	if($fila=mysqli_fetch_array($consulta,MYSQL_ASSOC)){		
		if ($fila['password']==$vieja){
			mysqli_query($conexion,"UPDATE usuarios set password='$nueva' where n_usuario='$usuario'"); 
			echo "<script> alert('Contrase\u00f1a actualizada') </script>";	
				
			header( "Refresh:2; url=http://192.168.56.2/citas/php/cerrarsesion.php", true, 303);

			
			
		}else{
		//	echo "<script> alert('Contrase\u00f1a incorrecta') </script>";
		//	error_log($_SERVER['HTTP_REFERER']);
			echo "<script> alert($_SERVER['HTTP_REFERER']) </script>";	
				
			header( "Refresh:15; url=http://192.168.56.2/citas/frmprofesor.php", true, 303);
			

				
			
		}
		
		
	}
}

?>