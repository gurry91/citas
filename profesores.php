<?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/php/controlAcceso.php';
  
  setRolPermitido(ROL_ADMIN);
  compruebaPermisos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/registroUsuario.css" rel="stylesheet">
	<title>Profesores</title>
</head>
<body>
   <div class="container">
	<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/menu.php" ?>
</div>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">LISTA DE PROFESORES</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>					
					<th>NOMBRE</th>	
          <th>APELLIDOS</th>  		
          <th>ACCIONES</th>   
				</tr>
			</thead>
			<tbody>
				<?php
				     require('php/conexion.php');
				     $result=mysqli_query($conexion,sprintf('SELECT n_usuario, nombre, apellido, apellido2 FROM usuarios INNER JOIN roles ON (roles.id = usuarios.rol) where roles.descripcion = "%s"', ROL_PROFESOR));

				     while ($usuarios=mysqli_fetch_array($result)){
						 
             $id=$usuarios['n_usuario'];			

						 echo "<td id='nombre:$id' class='cam_editable'>".$usuarios['nombre']."</td>";	 
             echo "<td id='apellido:$id' class='cam_editable'>".$usuarios['apellido'] . ' ' . $usuarios['apellido2']."</td>";
             echo"<td id='$id' button='true'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-minus'></span> Eliminar</button></td>";
						 echo"</tr>";
					 }				
				?>
			</tbody>	
					
		</table>
	</div>
	</div>
	<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
	<button type="button" onclick="ventananuevo();" class="btn btn-success btn-lg" >
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar
    </button>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
	</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Nuevo Alumno</h4>
            </div>
            <form role="form"  id= "frmprofesor" name="frmalumno" onsubmit="Registrarprofesor(); return false">
              <div class="col-lg-12">               

                <div id="instructionBox">* Campo obligatorio</div>
                <div class="form-group">
                  <label>* Nombre de usuario</label>
                  <input  name="nombreusuario" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>* Nombre</label>
                  <input  name="nombre" class="form-control" required>
                </div>
                 
                <div class="form-group">
                  <label>* Primer Apellido</label>
                  <input  name="apellido" class="form-control" required>
                </div>
        
                <div class="form-group">
                  <label>* Segundo Apellido</label>
                  <input  name="apellido2" class="form-control" required>
                </div>
                  
                <div class="form-group">
                  <label>Dni</label>
                  <input  name="dni" class="form-control">
                </div>

                <div class="form-group">
                  <label>Direccion</label>
                  <input  name="direccion"  class="form-control">
                </div>
                 
                 <div class="form-group">
                  <label>Correo</label>
                  <input name="correo" type="email"  class="form-control">
                </div>
                
                 <div class="form-group">
                  <label>Teléfono</label>
                  <input name="telefono" type="text" placeholder="+34999999999" class="form-control" pattern="([+]\d{2})?\d{9}">
                </div>
                 
                <div class="form-group">
                  <label>* Fecha de nacimiento</label>
                  <input  name="fecha" type="date" class="form-control" required>

                </div>
                 
                <div class="form-group">
                  <label>Sexo</label>
                  <br>
                  <div class="sexoFormElement">
                   <input name='sexo' type="radio" value="Hombre" class="form-control">  <span>Hombre</span>
                  </div>
                  <div class="sexoFormElement">
                   <input name='sexo' type="radio" value="Mujer" class="form-control"> <span>Mujer</span>       
                  </div>
                </div>

                <div class="form-group">
                  <label>* Contraseña</label>
                  <input  name="password" id="p1" type="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                  <label>* Repita contraseña</label>
                  <input name="password2" id="p2" type="password" class="form-control" required>
                </div>                         
                
                <button type="submit" class="btn btn-primary btn-lg" button='agregar'>
                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrar
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
<script type="text/javascript" src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
        function ventananuevo(){
          $('#modal').modal('show');

        }
    </script>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/citas/php/cambiarPassword.php" ?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////-->
</body>