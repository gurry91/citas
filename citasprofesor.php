<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
  
  setRolPermitido(ROL_PROFESOR);
  compruebaPermisos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Citas</title>
</head>
<body>
   <div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">HORARIO</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>HORAS</th>
					<th>Alumno</th>	
					<th>Datos personales</th>				
					<th>ACCION</th>				
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $user=$_SESSION['nombre'];
				     $result=mysqli_query($conexion,"SELECT id_horario,horas,alumno FROM horarios where profesor='$user'");
				     while ($horarios=mysqli_fetch_array($result)){	
						  $id=$horarios['id_horario'];
						  $alumno=$horarios['alumno'];
						 echo "<tr><td id='id:$id' class='cam_editable'>".$horarios['id_horario']."</td>";
						 echo "<td id='horas:$id' class='cam_editable'>".$horarios['horas']."</td>";				     
						 echo "<td id='alumno:$id' class='cam_editable'>".$horarios['alumno']."</td>";
//						 echo "<td id='profesor:$id' class='cam_editable'>".$horarios['doctor']."</td>";	
						 if ($horarios['alumno']<>''){
							 echo"<td id='$id' name='$alumno' button='false'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-eye-open'></span> Ver</button></td>";
							 echo"<td id='$id' name='$alumno' button='true'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Cancelar Cita</button></td>";
						 }else{
							 echo"<td id='$id' name='$alumno' button='false'></td>";
							 echo"<td id='$id' name='$alumno' button='true'></td>";
						 }
						 echo"</tr>";
							 }
				?>
			</tbody>	
					
		</table>
	</div>
	</div>

<!--//////////////////////////////////////////////////-->

<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/mainprofesor.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
</body>