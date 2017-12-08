<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
  include 'php/profesorUtils.php';
  
  setRolPermitido(ROL_PROFESOR);
  compruebaPermisos();
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/gestionHorario.css" rel="stylesheet">
	<title>Gestión horario</title>
</head>
<body>
<div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>

<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">GESTION DE HORARIO</div>
	<div class="table-responsive">
		    <div id="diasPanel" style="text-align: center; padding-top: 15px">
              <button type="button" class="btn btn-primary">Lunes</button>
              <button class="btn btn-primary">Martes</button>
              <button class="btn btn-primary">Miércoles</button>
              <button class="btn btn-primary">Jueves</button>
              <button class="btn btn-primary">Viernes</button> 
              <button class="btn btn-primary">Sábado</button>
              <button class="btn btn-primary">Domingo</button>
        </div>

      <form id="formIntervalo" onsubmit="Registraralumno(); return false">
        <fieldset disabled>
            <div class="form-row align-items-center">               
             
              <div class="form-group col-md-4">
                <label for="horaInicio">Hora Inicio</label>
                <input type="text" class="form-control mb-2" id="horaInicio" placeholder="HH:mm" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]">
              </div>

              <div class="form-group col-md-4">
                <label for="horaFin">Hora Inicio</label>
                <input type="text" class="form-control mb-2" id="horaFin" placeholder="HH:mm" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]">
              </div>

              <div class="form-group col-md-4">
                <label for="intervalo">Intervalo (minutos)</label>
                <input type="number" class="form-control mb-2" id="intervalo" maxlength="60">
              </div>
              
              <div class="form-group col-md-12" id="buttons">
                <button type="submit" class="btn btn-success">Mostrar Horas</button>
               <button id="btnCita" class="btn btn-success" disabled>Registrar Horario</button>
              </div>
            </div>
         </fieldset>             
      </form>

    <table id="hoursTable" class="table-condensed table-bordered">
        <caption>Selecciona las horas deseadas: </caption>
          <tbody>
              <tr>
                <th>7</td>
                <td class="btn btn-primary">7:20</td>
                <td class="btn btn-primary">7:20</td>
                <td class="btn btn-primary">7:20</td>
              </tr>
              <tr>
                <th>8</td>
                <td class="btn btn-primary">7:20</td>
                <td class="btn btn-primary">7:20</td>
                <td class="btn btn-primary">7:20</td>
              </tr>
          </tbody>
      </table>
  </div>

	
	</div>
	</div>
	
<!--//////////////////////////////////////////////////-->	
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>