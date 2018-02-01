
	$(document).on('change','select[name="campusAppSelect"], select[name="idiomaAppSelect"]',function(){
		var results = $(this).attr('results');
		var route = $(this).attr('url');
		var thisName = $(this).attr('name');
		var inputData = {};
		var token = $('#'+thisName).find('input[name="_token"]').val();
		var smallBoxTitleSuccess = "El dato se cambio correctamente!";
		var smallBoxTitleError = "Error! El dato no pudo ser cambiado";

		if (thisName == 'campusAppSelect') {
			inputData = {campusAppSelect: $(this).val()};
			smallBoxTitleSuccess = "El campus se cambio correctamente!";			
			smallBoxTitleError = "Error! El campus no pudo ser cambiado";
		}else if (thisName == 'idiomaAppSelect') {
			inputData = {idiomaAppSelect: $(this).val()};
			smallBoxTitleSuccess = "El idioma se cambio correctamente!";			
			smallBoxTitleError = "Error! El idioma no pudo ser cambiado";
		}
		if ($(this).val() != '') {

			//se envia la peticion mediante el metodo DELETE con el id del genero
			$.ajax({
				url: route,
				type: 'POST',
				headers: {'X-CSRF-TOKEN': token},
				data: inputData,
				success: function(msj){
					
					$.smallBox({
					  title: smallBoxTitleSuccess,
					  content: "Hace un momento...",
					  color: '#5f895f',
					  iconSmall: "fa fa-check bounce animated"
					});
					$( document ).one('ajaxStop', function() {
	                	$('#container-loading').addClass("show");
						location.reload();
	                });

				},
		        error: function(msj){
		        	var row = '';
					
		            row = msj.responseText;
		            
		            //console.log(msj.responseJSON);
		            if( msj.responseJSON != undefined ){
		            	row = '';
		            	$.each(msj.responseJSON, function( index, value ) {
		               		row = row + value + "<br>";
		            	});
			        }

		            $.smallBox({
					  title: smallBoxTitleError,
					  content: row,
					  color: '#8b0000',
					  iconSmall: "fa fa-times bounce animated"
					});
		        }
			}).fail(function(jqXHR, textStatus, errorThrown) {
		        //de este modo se redirecciona a la pagina correspondiente
		        if (jqXHR.getResponseHeader('Location') != null){ 
		            window.Location= jqXHR.getResponseHeader('Location');
		        };
		    });
		}
	});
