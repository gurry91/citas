<?php 
	include 'php/profesorUtils.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<title>Alta horario</title>
</head>
<body>
  <div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">HORARIO</div>
	<div class="table-responsive">
		<div style="text-align: center;margin: 40px auto; width: 480px">
			<label>Elige Profesor: </label>
            <div class="form-group" style="display: inline-block;min-width: 150px">
            	<?php 
                    $profesores = obtenerProfesores();
                    $atributosComboProfesores = array("id" => "profesor", "class" => "form-control");
            		echo generarComboDesdeAssocArray($profesores ,$atributosComboProfesores, "id", "nombre", true);
            	 ?>
            </div>

            <button id="btnCita" class="btn btn-success" disabled style="float: right;">Pedir Cita</button>
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

<script src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/maincita.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>