$(document).ready(function(){
	    $("#changer").submit(function(e){
	        e.preventDefault();
	 
	        $.post(
	            'include/parametre.php', 
	            {
	                login1 : $("#login1").val(),  
	                mdp1 : $("#mdp1").val(),
	                login2 : $("#login2").val(),  
	                mdp2 : $("#mdp2").val()
	            },
	 
	            function(data){
	                if(data == 'Success'){
	                     window.location('deconnexion');

	                }
	                else{
	                      if(data=="Failled"){
	                      	$("#resultat").html('<p class="text text-danger">Impossible de modifier ces informations..</p>');
	                      }else{
	                      	if(data=="Inexistant"){
	                      		$("#resultat").html('<p  class="text text-danger">Mauvais identifiants.</p>');
	                      	}else{
	                      		if(data=="Used"){
	                      			$("#resultat").html('<p class="text text-danger">Le nom d\'uilisateur non disponible.</p>');
	                      		}else{
	                      			if(data=="Court"){
	                      				$("#resultat").html('<p  class="text text-danger">Le mot de passe est court.</p>');
	                      			}else{
	                      				$("#resultat").html('<p class="text text-danger">Impossible de modifier ces informations..</p>');
	                      			}
	                      		}
	                      	}
	                      }
	                }
	            },
	            'text'
	         );
	    });
	});