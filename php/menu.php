<?php 
	include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';

	session_start();

	$rol = $_SESSION["rol"];

	switch ($rol) {
		case ROL_ALUMNO:
?>

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
						echo $_SESSION['nombre'];
						?>
					</a>
				</div>		
				<div class="collapse navbar-collapse" id="miMenu">
					<ul class="nav navbar-nav">
						<li><a href="horarios.php">Horarios</a></li>	
						<li><a href="datospersonales.php">Datos personales</a></li>
						<li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>
						<li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>								
					</ul>
				</div>
			</div>
		</nav>

<?php
		break;
		case ROL_PROFESOR:
		?>

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
						echo $_SESSION['nombre'];
						?>
					</a>
					</a>
				</div>		
				<div class="collapse navbar-collapse" id="miMenu">
					<ul class="nav navbar-nav">						
						<li><a href="citasprofesor.php">Citas</a></li>
						<li><a href="gestionHorario.php">Gestión Horario</a></li>
						<li><a href="alumnos.php">Alumnos</a></li>	
						<li><a href="datospersonales.php">Datos personales</a></li>
						<li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>	
						<li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>								
					</ul>
				</div>
			</div>
		</nav>

<?php 
		break;
		case ROL_ADMIN:
?>

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
						echo $_SESSION['nombre'];
						?>
					</a>
				</div>		
				<div class="collapse navbar-collapse" id="miMenu">
					<ul class="nav navbar-nav">
						<li><a href="administradores.php">Administradores</a></li>
						<li><a href="profesores.php">Profesor</a></li>					
						<li><a href="alumnos.php">Alumnos</a></li>	
						<li><a href="citas.php">Citas</a></li>										
						<li><a onclick="cambiar();" href="#">Cambiar contraseña</a></li>
						<li><a href="php/cerrarsesion.php"><span class="label label-danger">CERRAR SESION </span></a></li>										
					</ul>
				</div>
			</div>
		</nav>
<?php
		break;
	}
 ?>