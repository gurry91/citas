<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Horarios de citas</title>
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
					<th>Mover alumno</th>	
					<th>Cancelar cita</th>	
					<th>Profesor</th>									
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $result=mysqli_query($conexion,'SELECT * FROM horarios');
				     while ($horarios=mysqli_fetch_array($result)){
						 $id=$horarios['alumno'];
						 $doct=$horarios['profesor'];
						 $id2=$horarios['id_horario'];
						 $alumno=$horarios['alumno'];
					 echo "<tr><td id='id:$id' class='cam_editable'>".$horarios['id']."</td>";
				     echo "<td id='horas:$id' class='cam_editable'>".$horarios['horas']."</td>";				     
				     echo "<td id='alumno:$id' class='cam_editable' >".$horarios['alumno']."</td>";	
					 if ($horarios['alumno']<>''){
							 echo"<td id='$id' name='$alumno' button='false'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-move'></span> Mover</button></td>";
							 echo"<td id='$id2' name='$alumno' button='true'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Cancelar Cita</button></td>";
					 }else{
							 echo"<td></td>";						 
							 echo"<td></td>";						 
						 }
					  	 
				     $result2=mysqli_query($conexion,'SELECT nombre FROM usuarios where tipo="doctor"');
					 echo"<td id='id:$id''><select id='id".$doct."' name='$id2'>";					 
				     while ($doctor=mysqli_fetch_array($result2)){
						 echo"<option value='".$doctor['nombre']."'>".$doctor['nombre']."</option>";
					 }
					 echo"</td></select>";				    
					 echo"</tr>";
					 }				
				?>
			</tbody>	
					
		</table>
	</div>
	</div>
	
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
	</div>


	
<!--//////////////////////////////////////////////////-->

<!--//////////////////////////////////////////////////-->
<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/maincitaadmin.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">

        function ventananuevo(){
          $('#modal').modal('show');

        }
    </script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
    <script type="text/javascript">
		<?php
		$result=mysqli_query($conexion,'SELECT n_usuario FROM usuarios where rol="profesor"');
	    while ($doc=mysqli_fetch_array($result)){
			?>
						 $(document).ready(function(){
							$('#id<?php echo $doc['n_usuario'];?> > option[value="<?php echo $doc['n_usuario'];?>"]').attr('selected', 'selected');
					 });
		<?php } ?>
    </script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
</body>