<?php 
	include 'php/profesorUtils.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/gestionHorario.css" rel="stylesheet">
	<title>Alta horario</title>
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
        <a href="frmprofesor.php" class="navbar-brand">Bienvenido Profesor/a
        <?php
          session_start();
          echo $_SESSION['nombre'];
          ?>
        </a>
        </a>
      </div>    
      <div class="collapse navbar-collapse" id="miMenu">
        <ul class="nav navbar-nav">           
          <li><a href="citasprofesor.php">Citas</a></li>
          <li><a href="gestionHorario.php">Gestión Horario</a></li>
          <li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>  
          <li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>                
        </ul>
      </div>
		</div>
	</nav>
</div>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">GESTION DE HORARIO</div>
	<div class="table-responsive">
		<div style="text-align: center;margin: 40px auto; width: 480px">
            <div class="form-group" style="display: inline-block;min-width: 150px">
            	<?php 
                    $profesores = obtenerProfesores();
                    $atributosComboProfesores = array("id" => "profesor", "class" => "form-control");
            		echo generarComboDesdeAssocArray($profesores ,$atributosComboProfesores, "id", "nombre", true);
            	 ?>
            </div>

            <button id="btnCita" class="btn btn-success" disabled style="float: right;">Registrar Horario</button>
		</div>


		<table id="calendarTable" class="table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                      <th colspan="7">
                        <span id="calendarMonthWrapper" class="btn-group">
                            <button id="previousMonthButton" class="btn btn-primary"><</button>
                        	<a id="calendarMonth" class="btn disabled"></a>
                        	<button id="nextMonthButton" class="btn btn-primary hidden">></button>
                        </span>
                      </th>
                    </tr>
                    
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                        <th>Domingo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <table id="hoursTable" class="table-condensed table-bordered table-striped hidden">
            	<caption>Elige una hora:</caption>
                <tbody>

                  
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