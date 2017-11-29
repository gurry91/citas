$(document).ready(function(){		
		$("td[button=true]").click(function(){
			if (confirm("Desea cancelar esta cita?")) {
			var field_id=$(this).attr("id");
			var value=$(this).attr("name");			
			console.log('value:'+value+' field:'+field_id);
			$.post('php/cancelarcitaprofesor.php', field_id+"="+value, function(respuesta){	
				if (respuesta=="true")
 				window.location.reload(true);
 			else
 				alert(respuesta);	
			});			
		}
		});
	$("td[button=false]").click(function(){
		var field_id=$(this).attr("id");
		var value=$(this).attr("name");
		$.post('php/consultardatos.php',field_id+"="+value, function(respuesta){	
				if (respuesta=="true")
 				window.location.href = "consultaralumno.php";
 			else
 				alert("respadfadfafda");	
			});			
		});
});	