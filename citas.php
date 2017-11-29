<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Horarios de citas</title>
</head>
<body>
   <div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#miMenu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="frmadmin.php" class="navbar-brand">Bienvenido Administrador
				<?php
					session_start();
					echo $_SESSION['nombre'];
					?>
				</a>
			</div>		
			<div class="collapse navbar-collapse" id="miMenu">
				<ul class="nav navbar-nav">
					<li class="active"><a href="administradores.php">Administradores</a></li>
					<li><a href="profesores.php">Profesores</a></li>					
					<li><a href="alumnos.php">Alumnos</a></li>	
					<li><a href="citas.php">Citas</a></li>	
					<li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>
					<li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>									
				</ul>
			</div>
		</div>
	</nav>
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
	 <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Cambiar Contraseña</h4>
            </div>
            <form role="form"  id= "frmcambiar" name="frmcambiar" onsubmit="cambiarpassword(); return false">
              <div class="col-lg-12">               

                <div class="form-group">
                  <label>Contraseña Actual</label>
                  <input  name="password0" id="p" class="form-control" type="password"required>
                </div>
                <div class="form-group">
                  <label>Nueva contraseña</label>
                  <input  name="password1" id="p3" class="form-control" type="password"required>
                </div>
                
                <div class="form-group">
                  <label>Confirmar contraseña</label>
                  <input  name="password2" id="p4" class="form-control" type="password" required>
                </div> 
                 <button type="submit" class="btn btn-primary btn-lg" button='agregar'>
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Cambiar
                </button> 
              </div>
            </form>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
<!--//////////////////////////////////////////////////-->
<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/maincitaadmin.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/change.js"></script>
<script type="text/javascript">
	function cambiar(){
          $('#modal2').modal('show');

        }
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

</body>