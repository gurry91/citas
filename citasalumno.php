<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
  
  setRolPermitido(ROL_ALUMNO);
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
					<th>FECHA</th>
					<th>HORA INICIO</th>
					<th>HORA FIN</th>
					<th>Alumno</th>	
					<th>ACCION</th>				
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $user=$_SESSION['usuario'];

				     $sql = "SELECT citas.id_cita, DATE_FORMAT(citas.fecha, '%d-%e-%Y') fecha, horarios.hora_inicio, horarios.hora_fin, CONCAT(usuarios.nombre, ' ', usuarios.apellido, ' ', usuarios.apellido2) profesor";
				     $sql .= " FROM citas ";
				     $sql .= " INNER JOIN usuarios ON (usuarios.id = citas.id_usuario) ";
				     $sql .= " INNER JOIN horarios ON (horarios.id_horario = citas.id_horario) ";
				     $sql .= sprintf(" WHERE citas.id_usuario = %d", $user);
				     $sql .= " ORDER BY citas.fecha DESC";
				     
				     error_log($sql);
				     $result=mysqli_query($conexion,$sql) or die(mysqli_error($conexion));

				     while ($citas= mysqli_fetch_array($result,MYSQL_ASSOC)){	
						 $id=$citas['id_cita'];
						 echo "<tr><td id='id:$id' class='cam_editable'>".$citas['fecha']."</td>";
						 echo "<td id='hora_inicio:$id' class='cam_editable'>".$citas['hora_inicio']."</td>";				     
						 echo "<td id='hora_fin:$id' class='cam_editable'>".$citas['hora_fin']."</td>";
						 echo "<td id='profesor:$id' class='cam_editable'>".$citas['profesor']."</td>";
						 echo"<td id='$id' button='false'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-minus'></span> Eliminar</button></td>";
						 echo"</tr>";
					 }
				?>
			</tbody>	
					
		</table>
	</div>
	</div>

<!--//////////////////////////////////////////////////-->

<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/mainalumno.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
</body>