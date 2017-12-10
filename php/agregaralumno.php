<?php
include './credenciales.php';
include '../constantes.php';

if(!empty($_POST)){
	$conexion=(mysqli_connect($servidor,$server_admin,$server_pass));
    mysqli_select_db($conexion,$database) or die ("no se encuentra la bd");	
	$nombreusuario=$_POST['nombreusuario'];
	$dni=$_POST['dni'];
	$nombre=$_POST['nombre'];
	$apellido=$_POST['apellido'];
	$apellido2=$_POST['apellido2'];
	$direccion=$_POST['direccion'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$fecha=$_POST['fecha'];
	$sexo=$_POST['sexo'];
	$password=md5($_POST['password']);	
	$rol=ROL_ALUMNO;
	$consultarusuario="SELECT 1 FROM usuarios where n_usuario='$nombreusuario'";
	$resultadousuario=mysqli_query($conexion,$consultarusuario);	
	$busquedausuario=mysqli_fetch_array($resultadousuario);

	if(empty($busquedausuario)){		
		$insertar="INSERT INTO usuarios ( `n_usuario`, `password`, `rol`, `nombre`, `apellido`, `apellido2`, `correo`, `direccion`, `fecha`, `dni`, `sexo`, `telefono`) VALUES ('$nombreusuario', '$password', (SELECT id FROM roles WHERE descripcion = '$rol'), '$nombre', '$apellido', '$apellido2', '$correo', '$direccion', '$fecha', '$dni', '$sexo', '$telefono')";
        mysqli_query($conexion,$insertar) or die ("NO se pudo insertar datos personales");
        mysqli_close($conexion);
			
		echo "Registro completado de manera correcta";
	}else if (!empty($busquedausuario)){
		echo "El nombre de usuario ya existe";
	}
}
?>