<?php
include './conexion.php';


if(!empty($_POST)){
	$conexion=(mysqli_connect("localhost","root","entrar"));
    mysqli_select_db($conexion,citas) or die ("no se encuentra la bd");	
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
	$password=$_POST['password'];	
	$rol='alumno';
	$consultardni="SELECT * FROM datosusuario where dni='$dni'";
	$resultadodni=mysqli_query($conexion,$consultardni);
	$busquedadni=mysqli_fetch_array($resultadodni);
//	echo $busquedadni;
	$consultarusuario="SELECT * FROM usuarios where nombre='$nombreusuario'";
	$resultadousuario=mysqli_query($conexion,$consultarusuario);	
	$busquedausuario=mysqli_fetch_array($resultadousuario);
//	echo $busquedausuario;	
	if(empty($busquedadni)&&empty($busquedausuario)){		
		$insertar="INSERT INTO `citas`.`usuarios` (`id`, `n_usuario`, `password`, `rol`, `nombre`, `apellido`, `apellido2`, `correo`, `direccion`, `fecha`, `dni`, `sexo`, `telefono`) VALUES (NULL, '$nombreusuario', '$password', 'alumno', '$nombre', '$apellido', '$apellido2', '$correo', '$direccion', '$fecha', '$dni', '$sexo', '$telefono')";
        mysqli_query($conexion,$insertar) or die ("NO se pudo insertar datos personales");
        mysqli_close($conexion);
			
			echo"Registro completado de manera correcta";
		}else{
		    if (!empty($busquedadni)){
				echo "DNI ya esta registrado";
			}
		    if (!empty($busquedausuario)){
				echo "el nombre de usuario ya existe";
			}	
		}
}
?>