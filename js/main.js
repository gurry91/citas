$(document).ready(function(){
	$(function(){
		$("td[contenteditable=true]").blur(function(){			
			var field_id=$(this).attr("id");
			var value=$(this).text();			
			console.log('value: '+value+' field:'+field_id);
			$.post('php/modificaralumno.php', field_id+"="+value,function(data){	
				if(data!=''){
					console.log(data);
					
					if (data=="dni"){
						window.location.reload(true);
						alert('El dni ya existe');						
					}
				}		
			});
		});		
		
		$("td[button=true]").click(function(){
			if (confirm("¿esta seguro?")) {
			var field_id=$(this).attr("id");
			console.log('id:'+field_id);			
			$.post('php/eliminarUsuario.php', "id=" + field_id,function(respuesta){
				if (respuesta=="true")
 				window.location.reload(true);
 			else
 				alert(respuesta);
			});				
		}
		});		
	});	
	$("select").change(function() {			
            var field_id=$(this).attr("name");
			var value=$(this).val();	
			console.log('value: '+value+' field:'+field_id);
			$.post('php/modificarprofesorcita.php', field_id+"="+value,function(data){
				if(data!=''){
					console.log(data);
				}
			});			
        });
	$("td[button=false]").click(function(){
		var value=$(this).attr("name");
		console.log('value: '+value);
		$.post('php/consultardatos.php',value,function(respuesta){	
				if (respuesta=="true")
 				window.location.href = "moveralumno.php";
 			else
 				alert(respuesta);	
			});			
		});
});
function Registraradministrador(){	
	if (document.getElementById("p1").value == document.getElementById("p2").value){
		$.post('php/agregaradministrador.php','&'+$("#frmadministrador").serialize(),function(respuesta){
 			if (respuesta=="true")
 				window.location.reload(true);
			   else
 				alert(respuesta);
			   });			   
	}else{
		alert('las contraseñas no coinciden');
	}
}
function Registrarprofesor(){	

	if (document.getElementById("p1").value == document.getElementById("p2").value){
		$.post('php/agregarprofesor.php','&'+$("#frmprofesor").serialize(),function(respuesta){
 			if (respuesta=="true")
 				window.location.reload(true);
			   else
 				alert(respuesta);
			   });			   
	}else{
		alert('diferentes');
	} 
}
function Registraralumno(){	
	if (document.getElementById("p1").value == document.getElementById("p2").value){
		$.post('php/agregaralumno.php','&'+$("#frmalumno").serialize(),function(respuesta){
 			if (respuesta=="true")
 				window.location.reload(true);
			  });			   
	}else{
		alert('las contraseñas no coinciden');
	}
}


function iniciarsesion(){
	$.post('php/iniciarsesion.php','&'+$("#iniciar").serialize(),function(respuesta){		
 			if (respuesta=="admin"){
 				window.location.href = "frmadmin.php";	
			}else if(respuesta=="profesor"){
 				window.location.href = "frmprofesor.php";
			}else{
				if(respuesta=="alumno"){
				window.location.href = "frmalumno.php";
				}else{
					alert(respuesta);
				}
			}
			
 		});
		}