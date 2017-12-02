<?php
	include './credenciales.php';
	include '../constantes.php';


if(!empty($_POST)){
	$conexion=(mysqli_connect($servidor,$server_admin,$server_pass));
    mysqli_select_db($conexion,$database) or die ("no se encuentra la bd");	
	$nombre=$_POST['nombre'];
	$password=$_POST['password'];
	$rol=ROL_PROFESOR;
	$id=null;
	$consultarusuario="SELECT * FROM usuarios where n_usuario='$nombre'";
	$resultadousuario=mysqli_query($conexion,$consultarusuario);
	$busquedausuario=mysqli_fetch_array($resultadousuario);
	if(empty($busquedausuario)){	
		$insertar="INSERT INTO usuarios (n_usuario, password, rol) VALUES ('$nombre', '$password', (SELECT id FROM roles WHERE descripcion = '$rol'))";
        mysqli_query($conexion,$insertar) or die ("NO se pudo insertar");
        mysqli_close($conexion);
			echo"true";
		}else{
		    if(!empty($busquedausuario)){
				echo "el nombre de usuario ya esta registrado";
			}
		}
}
?>