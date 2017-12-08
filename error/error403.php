<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/citas/constantes.php';

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link href="/citas/css/bootstrap.min.css" rel="stylesheet">
	<title>¡No puedes pasar!</title> 
	
		<style>
		body {
			color:#1a1a37;
			font-family: MrDumDumver07srHeavy, sans-serif;
			font-size: 15px;
			margin: 0;
			padding:0;
		}
		h1{
			font-weight: normal;
			font-size: 7em;
			margin: 0;
			line-height: 1;
		}
		img {
			height: 400px;
			width: 300px;
			margin: 0 auto;
			display: block;
		}
		.retina img{
			height: 200px;
			width: 150px;
		}
		p{
			font-size: 1.2em;
			margin: 0;
			
		}
		div{
			position: absolute;
			width:400px;
			top: 50%;
			left: 50%;
			margin-left: -200px;
			margin-top: -300px;
			text-align: center;
			
		}
		.retina div{
			margin-left: -100px;
			margin-top: -200px;
			width: 200px;
		}
		
	</style>
	
</head>
<body>

	<div>
		<img src="/citas/images/403.png" alt="Gandalf standing and holding his staff in one hand and a sword with another."/>
		<h1>ERROR 403</h1>
		<p>¡No puedes pasar!</p>
		<br/>
		<a class="btn btn-primary" href="javascript:pantallainicial()" role="button">Volver a página inicial</a>
	</div>
	 
<script>
function pantallainicial(){		
    var rol='<?php session_start(); echo $_SESSION['rol']?>';
 			if (rol=="admin"){
 				window.location.href = "../frmadmin.php";	
			}else if(rol=="profesor"){
 				window.location.href = "../frmprofesor.php";
			}else{
				if(rol=="alumno"){
				window.location.href = "../frmalumno.php";
				}else{
				window.location.href = "../index.php";
				}
			}
		}
</script>

</body>
</html>