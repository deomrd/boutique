$(document).ready(function(){
	$('#search-user').keyup(function(){
		$('#resultat-search').html('');
		var utilisateur = $(this).val();
		if(utilisateur !=""){
			$.ajax({
			type :'GET',
			url :'../include/recherche.php',
			data: 'user=' + encodeURIComponent(utilisateur),
			success : function(data){
				if(data !=""){
					$('#resultat-search').append(data);
				}else{
					$('#resultat-search').html("<div style='font-size:20px; text-align:center; margin-top: 10px; color: red;'><b>Aucune donnée trouvée pour cette entrée.</b></div>");
				}
			}
			});
		}
		
	});
});