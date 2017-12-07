<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Mi horario</title>
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
				<a href="frmalumno.php" class="navbar-brand">Bienvenido usuario
				<?php
					session_start();
					echo $_SESSION['nombre'];
					?>
				</a>
			</div>		
			<div class="collapse navbar-collapse" id="miMenu">
				<ul class="nav navbar-nav">
					<li><a href="datospersonales.php">Datos personales</a></li>
					<li class="active"><a href="horarios.php">Horarios</a></li>	
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
					<th>ALUMNO</th>	
					<th>PROFESOR</th>				
					<th>ACCION</th>				
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $user=$_SESSION['nombre'];
				     $result=mysqli_query($conexion,"SELECT cita FROM datosusuario where id_usuario='$user'");
				     $cita=mysqli_fetch_array($result);
				     $codcita=$cita['cita'];
				     if ($codcita==0){
						 $result=mysqli_query($conexion,'SELECT * FROM horarios');
						 while ($horarios=mysqli_fetch_array($result)){
							 $id=$horarios['id_horario'];						 
							 if ($horarios['alumno']==null){
						 echo "<tr><td id='id:$id' class='cam_editable'>".$horarios['id_horario']."</td>";
						 echo "<td id='horas:$id' class='cam_editable'>".$horarios['horas']."</td>";				     
						 echo "<td id='alumno:$id' class='cam_editable'>".$horarios['alumno']."</td>";
						 echo "<td id='profesor:$id' class='cam_editable'>".$horarios['profesor']."</td>";	
						 echo"<td id='$id' name='$user' button='true'><button type='button' class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span> Pedir cita</button></td>";
						 echo"</tr>";
							 }
						 }
					 }else{
						 $result=mysqli_query($conexion,"SELECT * FROM horarios where id_horario='$codcita'");
						 while ($horarios=mysqli_fetch_array($result)){
							 $id=$horarios['id_horario'];
							 echo "<tr><td id='id:$id' class='cam_editable'>".$horarios['id_horario']."</td>";
							 echo "<td id='horas:$id' class='cam_editable'>".$horarios['horas']."</td>";
							 echo "<td id='alumno:$id' class='cam_editable'>".$horarios['alumno']."</td>";
							 echo "<td id='profesor:$id' class='cam_editable'>".$horarios['profesor']."</td>";
							 echo"<td id='$id' name='$user' button='false'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Cancelar Cita</button></td>";
							 echo"</tr>";
						 }
					 }
				?>
			</tbody>	
					
		</table>
	</div>
	</div>
	
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
	</div>
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
<script type="text/javascript" src="js/maincita.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/change.js"></script>
<script type="text/javascript">        
	function cambiar(){
          $('#modal2').modal('show');

        }
    </script>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>