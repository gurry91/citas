<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
  
  setRolPermitido(ROL_ALUMNO);
  setRolPermitido(ROL_PROFESOR);
  compruebaPermisos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Mis datos personales</title>
</head>
<body>
   <div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">MIS DATOS PERSONALES</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>NOMBRE DE USUARIO</th>
					<th>DNI</th>	
					<th>NOMBRE</th>	
					<th>APELLIDOS</th>		
					<th></th>	
					<th>DIRECCION</th>	
					<th>CORREO</th>	
					<th>TELEFONO</th>	
					<th>FECHA DE NACIMIENTO</th>	
					<th>SEXO</th>					
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
					 
					 $id=$_SESSION['nombre'];
					
				     $result=mysqli_query($conexion,"SELECT n_usuario FROM usuarios where n_usuario='$id'");				    
				     while ($usuarios=mysqli_fetch_array($result)){
						 $id=$usuarios['n_usuario'];
					 //////////////////////////////////////
					 $result2=mysqli_query($conexion,"SELECT * FROM usuarios where n_usuario='$id'");
					 $dato=mysqli_fetch_array($result2);
					 //////////////////////////////////////
					 echo "<tr><td id='id:$id' class='cam_editable'>".$usuarios['n_usuario']."</td>";
					 echo "<td id='dni:$id' class='cam_editable' contenteditable='true'>".$dato['dni']."</td>";
				     echo "<td id='nombre:$id' class='cam_editable' contenteditable='true'>".$dato['nombre']."</td>";
					 echo "<td id='apellido:$id' class='cam_editable' contenteditable='true'>".$dato['apellido']."</td>";
					 echo "<td id='apellido2:$id' class='cam_editable' contenteditable='true'>".$dato['apellido2']."</td>";
					 //////////////////////////////////////
					 echo "<td id='direccion:$id' class='cam_editable' contenteditable='true'>".$dato['direccion']."</td>";
					 echo "<td id='correo:$id' class='cam_editable' contenteditable='true'>".$dato['correo']."</td>";
					 echo "<td id='telefono:$id' class='cam_editable' contenteditable='true'>".$dato['telefono']."</td>";
					 echo "<td id='fecha:$id' class='cam_editable' contenteditable='true'>".$dato['fecha']."</td>";
					 echo "<td id='sexo:$id' class='cam_editable' contenteditable='true'>".$dato['sexo']."</td>";
					 echo "<td id='regimen subsidiario:$id' class='cam_editable' contenteditable='true'>".$dato['regimensubsidiario']."</td>"; 
					 ///////////////////////////////////////	 
					 echo"</tr>";
					 }				
				?>			
			</tbody>					
		</table>
	</div>
	</div>	
	</div>
<!--//////////////////////////////////////////////////-->
 
<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>