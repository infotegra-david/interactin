



//INICIO SELECT DINAMICO
//INICIO SELECT DINAMICO

	// realiza la carga automatica y dinamica de los select 
	function mostrarContenido(thisElement){

		var valor = $(thisElement).val();
		var texto = $(thisElement).find(':selected').text();
		var destino = $(thisElement).attr('target');
		var thisName = $(thisElement).attr('name').replace('[]', '');
		var formId = $(thisElement).parents('form').attr('id');
		var exists999999 = -1;
		if ($(thisElement).parents('form').hasClass('PreRegistro_form')) {
			var formClass = 'PreRegistro_form';
		}else if ($(thisElement).parents('form').hasClass('PreRegistro_form_solo')) {
			var formClass = 'PreRegistro_form_solo';
		}else if ($(thisElement).parents('form').hasClass('Registro_form')) {
			var formClass = 'PreRegistro_form_solo';
		}else if ($(thisElement).parents('form').hasClass('Registro_form_solo')) {
			var formClass = 'PreRegistro_form_solo';
		}else{
			var formClass = $(thisElement).parents('form').attr('class');
		}
		
		//console.log(texto);
		if ( formClass == 'PreRegistro_form' || formClass == 'PreRegistro_form_solo' || formClass == 'Registro_form' || formClass == 'Registro_form_solo' ) {
			//mostrar el resto del formulario al seleccionar el tipo de tramite
			if ( thisName == 'tipo_tramite' && valor != '' ) {
				$('#'+ formId +' div.paso1').removeClass('hide');
			}else if ( thisName == 'tipo_tramite' && valor == '' ) {
				$('#'+ formId +' div.paso1').addClass('hide');
			};

			//mostrar el resto del formulario al seleccionar 'otra' institucion
			if ( thisName == 'institucion_destino' && valor == '999999' ) {
				$('#'+ formId +' div.paso2').removeClass('hide');
			}else if ( thisName == 'institucion_destino' && valor != '999999' ) {
				$('#'+ formId +' div.paso2').addClass('hide');
			};

			//mostrar el resto del formulario al seleccionar 'otra' institucion
			if ( $(thisElement).attr('multiple') != undefined ) {
				exists999999 = jQuery.inArray( "999999", valor );
			};
			
			//console.log(thisName);
			//console.log(valor);
			//mostrar campo de otro 
			if ( valor == '999999' || exists999999 >= 0 ) {
				$(thisElement).attr('otro', thisName +'_otro');
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').removeClass('hide');
				$('#'+ formId +' [name="'+ thisName +'_otro"]').focus();
				//ocultar los programas
				/*
				if ( thisName == 'facultad_origen' ) {
					$('#'+ formId +' div[contenido="programa_origen"]').addClass('hide');
				}*/
			}else if ( $(thisElement).attr('otro') != undefined ) {
				$('#'+ formId +' div[contenido="'+ thisName +'_otro"]').addClass('hide');
				//mostrar los programas
				/*
				if ( thisName == 'facultad_origen' ) {
					$('#'+ formId +' div[contenido="programa_origen"]').removeClass('hide');
				}*/
			};

			//mostrar el campo para el responsable de la arl
			if ( texto.toLowerCase().indexOf("prácticas y pasantías") >= 0 ) {
				$(thisElement).attr('responsable_arl', 'responsable_arl');
				$('#'+ formId +' div.responsable_arl').removeClass('hide');
			}else if ( $(thisElement).attr('responsable_arl') != undefined ) {
				$('#'+ formId +' div.responsable_arl').addClass('hide');
			};
		}

	}

	$('.PreRegistro_form select, .PreRegistro_form_solo select, .Registro_form select, .Registro_form_solo select').each(function(){
		mostrarContenido($(this));
	});



		// realiza la carga automatica y dinamica de los select
	$(document).on('change','select',function(){

		var valor = $(this).val();
		var texto = $(this).find(':selected').text();
		var destino = $(this).attr('target');
		var thisName = $(this).attr('name').replace('[]', '');
		// var exists999999 = -1;
		var formId = $(this).parents('form').attr('id');
		if (formId == undefined) {
			formId = $(this).parents('.form').attr('id');
		}
		var origenParent = formId;

		// console.log('|'+formId+'|');

		mostrarContenido($(this));

		//console.log(valor+ ' - ' +destino);
		if ( valor != null && destino != '' && destino != undefined ) {
			CambiarContenidoSelect( $(this) , destino, origenParent);
			
			//si hay mas de un target hara otras operaciones
			destino = destino.split(",");
			if (destino.length == 1) {
				$('#'+ formId +' select[name="'+ destino +'"]').removeAttr('disabled');
			}else{
				jQuery.each(destino, function(index, item) {
					$('#'+ formId +' [name="'+ item +'"]').removeAttr('disabled');
				});
			}
		};

		
	});


	// realiza la carga automatica y dinamica de los select 
	function CambiarContenidoSelect(origen,destinoName,origenParent){
		var origenVal = origen.val();
		var urlDestino = origen.attr('url');
		// var origenParent =  origen.parents('form').attr('id');
		var placeholder = {};
		var cloneDefaultOptions = {};
		//si hay mas de un target hara otras operaciones
		destinoName = destinoName.split(",");
		if (destinoName.length == 1) {
			placeholder = $('#'+ origenParent +' select[name="'+ destinoName[0] +'"]').find('option[value=""]').text();
		}else{
			jQuery.each(destinoName, function(index, item) {
				var sizeTargetSelect = $('#' +origenParent+ ' select[name="'+item+'"]').size();
				if (sizeTargetSelect > 0 ) {
					placeholder[item] = $('#'+ origenParent +' select[name="'+ item +'"]').find('option[value=""]').text();
				}
			});
		}


		
		if(!origenVal || origenVal == '' || origenVal == '999999'){
			if (destinoName.length == 1) {
				var cloneDefault = $('#' +origenParent+ ' select[name="'+destinoName[0]+'"]').find('option[value="999999"]');
				cloneDefault = cloneDefault.clone();
				var sizecloneDefault = cloneDefault.size();
console.log('entro por aqui, sizecloneDefault:' + sizecloneDefault);
				$('#' +origenParent+ ' select[name="'+destinoName[0]+'"]').empty();
				if (sizecloneDefault > 0) {
					// $('#' +origenParent+ ' select[name="'+destinoName[0]+'"]').append('<option value="">' + placeholder + '</option>');
					$('#' +origenParent+ ' select[name="'+destinoName[0]+'"]').append(cloneDefault);
					
				}
			}else{
				//si es un array de destinos entonces son inputs
				jQuery.each(destinoName, function(index, item) {
					var sizeTargetInput = $('#' +origenParent+ ' input[name="'+item+'"]').size();
					var sizeTargetSelect = $('#' +origenParent+ ' select[name="'+item+'"]').size();

					var cloneDefault = $('#' +origenParent+ ' select[name="'+item+'"]:not(.no_vaciar)').find('option[value="999999"]');
					cloneDefault = cloneDefault.clone();
					var sizecloneDefault = cloneDefault.size();

					
					if (sizeTargetInput > 0 ) {
						$('#' +origenParent+ ' input[name="'+item+'"]').val('');
					}else if (sizeTargetSelect > 0 ) {
						$('#' +origenParent+ ' select[name="'+item+'"]:not(.no_vaciar)').empty();
						//inserta la opcion 'otra' en donde existia
						if (sizecloneDefault > 0) {
							$('#' +origenParent+ ' select[name="'+item+'"]').append(cloneDefault);
						}
					}

				});
			}
			if (placeholder != '') {
				if (destinoName.length == 1) {
					$('#'+ origenParent +' select[name="'+ destinoName[0] +'"]').prepend('<option value="">' + placeholder + '</option>');
				}else{
					jQuery.each(placeholder, function(index, item) {
						$('#'+ origenParent +' select[name="'+ index +'"]:not(.no_vaciar)').prepend('<option value="">' + item + '</option>');
						$('#' +origenParent+ ' select[name="'+index+'"]').val('');
					});
				}
			}
			return false;
		}
		//esta peticion tendra una respuesta y un estado

		//console.log('#' +origenParent+ ' select[name="'+destinoName+'"]');
		if (destinoName.length == 1) {
			$('#' +origenParent+ ' select[name="'+destinoName+'"]').empty();
		}else{
			//si es un array de destinos entonces son inputs
			jQuery.each(destinoName, function(index, item) {
				var sizeTargetInput = $('#' +origenParent+ ' input[name="'+item+'"]').size();
				var sizeTargetSelect = $('#' +origenParent+ ' select[name="'+item+'"]:not(.no_vaciar)').size();
				
				if (sizeTargetInput > 0 ) {
					$('#' +origenParent+ ' input[name="'+item+'"]').val('');
				}else if (sizeTargetSelect > 0 ) {
					$('#' +origenParent+ ' select[name="'+item+'"]:not(.no_vaciar)').empty();
				}
			});
		}

		// var data = {_token : $("input[name=_token]").val(), id : origenVal};
		var data = {};
		data['_token'] = $("input[name=_token]").val();
		data['id'] = origenVal;


		if ( origen.attr('name') == 'institucion_destino') {
			// data = {_token: $("input[name=_token]").val(), id : origenVal, rol : 'coordinador_destino'};
			data['rol'] = 'coordinador_destino';
		}
		if ( origen.attr('name') == 'coordinador_origen') {
			data['rol'] = 'coordinador_origen';
		}
		if ( origen.attr('name') == 'coordinador_destino') {
			data['rol'] = 'coordinador_destino_datos';
		}
		if ( origen.attr('val_extra') !== undefined) {
			var val_extra_name = origen.attr('val_extra');
			var val_extra = origen.parents('form').find('[name="'+val_extra_name+'"]').val();
			data[val_extra_name] = val_extra;
		}


		$.post(urlDestino, data, function(response, state){
			
			
			//se puede ver que es lo que esta recibiendo
			//console.log(response);
			/*
			var multiple = false;

			//esto no se usa, era cuando que usaba un plugin para el select dinamico
			
			if ( $('#'+ origenParent +' select[name="'+ destinoName +'"]').attr('multiple') != undefined ) {
				multiple = true;
				$('#'+ origenParent +' select[name="'+ destinoName +'"]').parent().find('.multiselect-container').html('');
			};
			
			*/

			
			//alert(response);
			//se insertan los elementos recibidos con formato de option dentro del select
			$.each(response, function(i,item) {
				if (destinoName.length == 1) {
					$('#'+ origenParent +' select[name="'+ destinoName +'"]').append("<option value=\""+ i +"\">" + item + "</option>");
				}else{
					//si es un array de destinos entonces son inputs
					$usuario_activo = 1;
					jQuery.each(item, function(index, itemVal) {
						//console.log(index+'--'+itemVal);
						var sizeTargetInput = $('#' +origenParent+ ' input[name="'+index+'"]').size();
						var sizeTargetSelect = $('#' +origenParent+ ' select[name="'+index+'"]').size();
						var sizeTargetSelectNoVaciar = $('#' +origenParent+ ' select[name="'+index+'"].no_vaciar').size();
						
						if ( index == 'usuario_activo' && itemVal == 0 ) {
							$usuario_activo = 0;
						}else if ( index == 'usuario_activo' && itemVal == 1 ) {
							$usuario_activo = 1;
						}
						if ( $usuario_activo == 0 ) {
							if (sizeTargetInput > 0 ) {
								$('#' +origenParent+ ' input[name="'+index+'"]').attr('disabled','disabled');
							}else if (sizeTargetSelect > 0 ) {
								$('#' +origenParent+ ' select[name="'+index+'"]').attr('disabled','disabled');
							}
						}else if ( $usuario_activo == 1 ) {
							if (sizeTargetInput > 0 ) {
								$('#' +origenParent+ ' input[name="'+index+'"]').removeAttr('disabled');
							}else if (sizeTargetSelect > 0 ) {
								$('#' +origenParent+ ' select[name="'+index+'"]').removeAttr('disabled');
							}
						}
						if (sizeTargetInput > 0 ) {
							$('#' +origenParent+ ' input[name="'+index+'"]').val(itemVal);
						}else if (sizeTargetSelect > 0 ) {
							if (index+'_seleccion' in item) {
								if (sizeTargetSelectNoVaciar <= 0 ) {
									jQuery.each(itemVal, function(indexItem, itemValue) {
										$('#'+ origenParent +' select[name="'+ index +'"]').append("<option value=\""+ indexItem +"\">" + itemValue + "</option>");
									});
								}
								$('#' +origenParent+ ' select[name="'+index+'"]').val(item[index+'_seleccion']);
							}else {
								if (jQuery.isPlainObject(item[index])) {
									jQuery.each(itemVal, function(indexItem, itemValue) {
										$('#'+ origenParent +' select[name="'+ index +'"]').append("<option value=\""+ indexItem +"\">" + itemValue + "</option>");
									});
								}else{
									$('#' +origenParent+ ' select[name="'+index+'"]').val(item[index]);
								}
							}
						}
						
					});

					//$('#'+ origenParent +' input[name="'+ destinoName[] +'"]').append("<option value=\""+ i +"\">" + item + "</option>");
					
				}
				/*
				if (multiple) {
					var htmlList = '<li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="'+ i +'"> '+ item +'</label></a></li>';
					$('#'+ origenParent +' select[name="'+ destinoName +'"]').parent().find('.multiselect-container').append(htmlList);
				};
				*/
				
			});
			//$('#'+ origenParent +' select[name="'+ destinoName +'"]').multiselect({});
		});
		if (placeholder != '') {
			var optionStart = '<option value="">';
			var optionEnd = '</option>';
			
			if (destinoName.length == 1) {
				if ( $('#'+ origenParent +' select[name="'+ destinoName[0] +'"]').attr('multiple') != undefined ) {
					optionStart = '<option  hidden="hidden" value="">';
				};
				$('#'+ origenParent +' select[name="'+ destinoName[0] +'"]').prepend(optionStart + placeholder + optionEnd);
			}else{
				jQuery.each(placeholder, function(index, item) {
					if ( $('#'+ origenParent +' select[name="'+ index +'"]').attr('multiple') != undefined ) {
						optionStart = '<option  hidden="hidden" value="">';
					};
					$('#'+ origenParent +' select[name="'+ index +'"]:not(.no_vaciar)').prepend(optionStart + item + optionEnd);
				});
			}
		}
	};


//FIN SELECT DINAMICO
//FIN SELECT DINAMICO

//INICIO ENVIAR AJAX POST
//INICIO ENVIAR AJAX POST

	// Attach a submit handler to the form
	$( ".PreRegistro_form, .Registro_form, .Form_submit_ajax" ).submit(function( event ) {
		// Stop form from submitting normally
		event.preventDefault();
		var form = '#' + $(this).attr('id');
		var results = '#' + $(this).attr('results') + ' #show-msg';
		var menu = '#' + $(form).parents('.wizard_content').attr('id');
		var botones = '#' + $(form).parents('.wizard_content').find('.button-content').attr('id');
		var sinArchivos = true;
		var data_extra_exists = $(form).find('[name="data_extra"]').size();
		var divData = [];

		if (data_extra_exists > 0 ) { 

			var data_extra = $(form).find('[name="data_extra"]').val();
			var data_extra_type = $(form).find('[name="data_extra"]').attr('data_extra_type');
			var data_extra_name = $(form).find('[name="data_extra"]').attr('data_extra_name');
			if (data_extra_type == 'jqGrid' ) {

				divData = $(form).serializeArray();
				
                var getGridData = $(data_extra).getGridParam('data');
                divData = divData.concat([
                    {name: data_extra_name, value: JSON.stringify(getGridData)}
                ]);

                // console.log(divData);

                if (getGridData.length == 0) {
                    var dialogError = $(form).find('#dialogError').clone().removeClass('hide');
                    dialogError.dialog({
                        autoOpen: true,
                        modal: true,
                        dialogClass: "alert text-danger",
                        buttons: {
                            Ok: function() {
                              $( this ).dialog( "close" );
                            }
                        }
                    });
                    // dialogError.dialog( "open" );
                    return false;
                }

			}else{
				divData = $(form).serialize();
			}
		}else{
			divData = $(form).serialize();
		}

		if ( $(form + ' input[type="file"]').size() > 0 ) {
			sinArchivos = false;
			divData = new FormData($(form)[0]);
			//console.log(divData);
			//divData = divData.append('prueba', $('input[name="paso"]').val() );
			//console.log(divData);
		}

		if( formEnviar(form,divData,results,'creación','no',sinArchivos) ){
			$( document ).one('ajaxStop', function() {
				if( $(results).attr('return') == 'correcto' ){
					var time = 2000;
					if( $(form).hasClass('Form_submit_ajax') == false ){
						if ( $( results ).find('.dato_adicional#noNext').size() == 0 ) {
							$(menu + ' .actions .btn-next').click();
						}else{
							$(botones + ' #btnNext').addClass('disabled');
						}

						//cambiar el id de la alianza en el titulo de cada paso
						// var alianzaId = $(results).find('[name="alianzaId"]').val();
						// $('span.alianza b').each(function(){
						// 	$(this).html(alianzaId+'jejejejejejejejejejejeje');
						// 	$(this).parent().removeClass(hide);
						// });


						$( results ).find('.dato_adicional').each(function(){
							var thisName = $(this).attr('name');
							$( '.step-pane.active form .dato_adicional[name="'+ thisName +'"]' ).remove();
							$( '.step-pane.active form' ).append($(this));
							
						});

						// se carga con cualquiera de los dos valores
			            var procesoId = $(form).find('[name="alianzaId"]').val();
			            if (procesoId == undefined) {
			            	procesoId = $(form).find('[name="inscripcionId"]').val();
			            }
			            if (procesoId == undefined) {
			            	procesoId = $(form).find('[name="iniciativaId"]').val();
			            }
			            if (procesoId == undefined) {
			            	procesoId = $(form).find('[name="oportunidadId"]').val();
			            }
			            $('.PreRegistro_form, form.PreRegistro').find('.span-proceso-id b').text(procesoId);
			            $('.PreRegistro_form, form.PreRegistro').find('.span-proceso-id').removeClass('hide');

					}else{
						time = 0;
					}
					
					if ( $( results ).find('#redirect_url').size() > 0 ) {

						var redirect_url = $( results ).find('#redirect_url').val();
						// setTimeout(function(){
							window.location.href = redirect_url;
						// }, time);
					}

				};
				//$(this).unbind("ajaxStop");
				//handler.off();
            });
		};
		return false;
	});

	$( "#files" ).submit(function( event ) {
		// Stop form from submitting normally
		event.preventDefault();
		var route = $(this).attr('action');
		var results = '#files #show-msg';
		var token = $(this).find('input[name="_token"]').val();
		$.ajax({
		      url:route,
		      data: new FormData($(this)[0]),
		      dataType:'json',
		      async:false,
		      type:'post',
			  headers: {'X-CSRF-TOKEN': token},
		      processData: false,
		      contentType: false,
		      success:function(response){
		        $( results ).attr('return','correcto');
		      },
		      error:function(msj){
		      	$( results ).attr('return','error');
		      }
		    }).fail(function(jqXHR, textStatus, errorThrown) {
		        $( results ).attr('return','error');
		        //de este modo se redirecciona a la pagina correspondiente
		        if (jqXHR.getResponseHeader('Location') != null){ 
		            window.Location= jqXHR.getResponseHeader('Location');
		        };
		    });
	});



	// envia la informacion del formulario 
	// es usado por varios formularios: para cargar formularios de ver, editar o crear 
	function formEnviar(form,divData,results,accion,mostrarMsg,sinArchivos){
		var retorno = true;
		mostrarMsg = mostrarMsg || 'no';
		var dataType = false;
		var contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
		//sinArchivos = sinArchivos || true;
		if ( sinArchivos == false ) {
			contentType = sinArchivos;
			dataType = 'json';
		}
		//console.log('|'+sinArchivos+'|');
		//var token = $('.form_delete input[name="_token"]').val();
		var route = $(form).attr('action');
		var inputData = divData || $(form).serialize();
		var token = $(form).find('input[name="_token"]').val();
		//se envia la peticion mediante el metodo DELETE con el id del genero
		$.ajax({
			url: route,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': token},
			data: inputData,
		    dataType: dataType,
		    //async:sinArchivos,
		    contentType: contentType,
		    processData: sinArchivos,
			success: function(msj){
				
				$(results + " #msj").html('');
				$(results + " #msj-success, " + results + " #msj-success #tipo, " + results + " #msj-error").fadeOut();
				row = msj;
	            if( msj.responseJSON != undefined ){
	            	row = '';
	            	$.each(msj.responseJSON, function( index, value ) {
	               		row = row + value + "<br>";
	            	});
		        }
        		$( results + " #msj-success #msj").html(row);
        		$( form ).find("#results.hide").html(row);
				$( results + " #msj-success").fadeIn();
	            	
	            $( results ).attr('return','correcto');
	            
	            var scrollPos =  $(results + " #msj-success").offset().top;
	 			$(window).scrollTop(scrollPos);
			},
	        error: function(msj){
	        	var row = '';
				$(results + " #msj").html('');
				$(results + " #msj-success, " + results + " #msj-success #tipo, " + results + " #msj-error").fadeOut();
	            /*if ( msj.status === 422 ) {
					row = 'No se logro la '+ accion +' del registro. <br>';
	            }else */
	            if( msj.status === 500 ) {
	            	row = msj.responseText;
	            }else{
	            	row = msj.responseText;
	            }
	            //console.log(msj.responseJSON);
	            if( msj.responseJSON != undefined ){
	            	row = '';
	            	var fields = [];
	            	$.each(msj.responseJSON, function( index, value ) {
	            	
	               		row = row + value + "<br>";
	               		fields.push(index);
	            	});

	            	$.each(fields, function( index, value ) {
	            		$('input[name="'+ value +'"], select[name="'+ value +'"], select[name="'+ value +'[]"], textarea[name="'+ value +'"]').parents('div.input-group').addClass('has-error');
	            	});
		        }

	            $(results + " #msj").html(row);
	            $(results + " #msj-error").fadeIn();
	            //console.log(msj);
	            var scrollPos =  $(results + " #msj-error").offset().top;
	 			$(window).scrollTop(scrollPos);
	 			
	            $( results ).attr('return','error');
	        }
		}).fail(function(jqXHR, textStatus, errorThrown) {
	        $( results ).attr('return','error');
	        //de este modo se redirecciona a la pagina correspondiente
	        if (jqXHR.getResponseHeader('Location') != null){ 
	            window.Location= jqXHR.getResponseHeader('Location');
	        };
	    });

	    return retorno;
	}

//FIN ENVIAR AJAX POST
//FIN ENVIAR AJAX POST


	function EnviarDatosAjax(route,token,inputData,results,accion){
		var retorno = true;
		var msjSuccess = $('<div id="msj-success" class="alert" role="alert"></div>');
		var msjError = $('<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert"></div>');
		
		$.ajax({
			url: route,
			type: 'POST',
			headers: {'X-CSRF-TOKEN': token},
			data: inputData,
			success: function(msj){

				if ( msj.status === 'success' ) {
					$(msjSuccess).append(msj.msg);
					$(results).html(msjSuccess);
	            }else{
	            	$(msjSuccess).append(msj);
	            	$(results).empty().append(msjSuccess);
	            }
	            
	            $( results ).attr('return','correcto');

	            var scrollPos =  $(results).offset().top;
	 			$(window).scrollTop(scrollPos);
			},
	        error:function(msj){
	        	var row = '';
				$(results).html('');
	            /*
	            if ( msj.status === 422 ) {
					row = 'No se logro la '+ accion +' del registro. <br>';
	            }else if( msj.status === 500 ) {
	            	row = msj.responseText;
	            }else{
	            	row = msj.responseText;
	            }*/
	            row = msj.responseText;
	            
	            if( msj.responseJSON != undefined ){
	            	row = '';
	            	$.each(msj.responseJSON, function( index, value ) {
	               		row = row + value + "<br>";
	            	});
		        }
		        $(msjError).append(row);
	            $(results).html(msjError);
	            var scrollPos =  $(results).offset().top;
	 			$(window).scrollTop(scrollPos);
	 			$( results ).attr('return','error');
	        }
		}).fail(function(jqXHR, textStatus, errorThrown) {
	        $( results ).attr('return','error');
	        //de este modo se redirecciona a la pagina correspondiente
	        if (jqXHR.getResponseHeader('Location') != null){ 
	            window.Location= jqXHR.getResponseHeader('Location');
	        };
	    });
	    return retorno;
	};


	$('#seleccionar_todos[type="checkbox"]').change(function(){
		$checked = false;
		if ( $(this).is(':checked') ) {
			$checked = true;
		}
		$(this).parents('.checkbox_show').find('[type="checkbox"]').prop('checked', $checked);
	});


	$('#remove_filter').click(function(){
		$(this).parents('tr').find('input').val('').keyup(); 
	});

	$('input, select, textarea').change(function(){
		$(this).parents('div.input-group').removeClass('has-error');
	});


	$('#ver_pre_registro').on('click', function () {
		// console.log('entro #ver_pre_registro');
		var route = $(this).attr('url');
		var thisForm =  $(this).parents('form').attr('id');
		var token = $('#'+ thisForm).find('input[name="_token"]').val();
		
		$('#'+ thisForm ).find('> .dato_adicional').each(function(){
			var thisName = $(this).attr('name');
			$( '#'+ thisForm + ' .para_ver_datos [name="'+ thisName +'"]' ).remove();
			$( '#'+ thisForm + ' .para_ver_datos' ).append($(this));
			
		});
		var inputData =  $('#'+ thisForm + ' .para_ver_datos').find('input, textarea, select').serialize();
		var results = '#'+ thisForm +' div#ver_datos';
		var accion = 'vista';


		if ( EnviarDatosAjax(route,token,inputData,results,accion) ){
			$( document ).one('ajaxStop', function() {
				if( $(results).attr('return') == 'correcto' ){
					$('div#datos_email_enviar').removeClass('hide');
				};
            });
		};
		
	});


	$('#enviar_pre_registro').on('click', function (e, data) {
		//console.log('entro #enviar_pre_registro');
		var proceso = 'enviados';
		var color = '#5f895f';
		var mensaje = 'Cuando den una respuesta se enviará un mensaje a su correo electrónico.';
		if ($(this).parents('form').hasClass('interalliance')) {
			mensaje = 'Cuando la institución de una respuesta se enviará un mensaje a su correo electrónico.';
		}else if ($(this).parents('form').hasClass('interchange')) {
			mensaje = 'Cuando el director de programa de una respuesta se enviará un mensaje a su correo electrónico.';
		}

		var thisForm =  $(this).parents('form').attr('id');
		/*
		var route = $(this).attr('url');
		var token = $('#'+ thisForm).find('input[name="_token"]').val();

		var inputData = "paso="+$('#'+ thisForm ).find('input[name="paso"]').val();
		inputData = inputData+"&alianzaId="+$('#'+ thisForm ).find('input[name="alianzaId"]').val();
		inputData = inputData+"&aceptar_alianza="+$('#'+ thisForm ).find('input[name="aceptar_alianza"]').val();
		inputData = inputData+"&enviar="+$('#'+ thisForm ).find('input[name="enviar"]').val();
		inputData = inputData+"&tokenmail="+$('#'+ thisForm ).find('input[name="tokenmail"]').val();
		//var inputData =  $('#'+ thisForm ).find('input, textarea, select').serialize();
		//console.log(inputData);
		var results = '#'+ thisForm +' div#ver_datos';
		var accion = 'vista';
		*/

		var results = '#' + $('#'+ thisForm).attr('results') + ' #show-msg';


		//$('.article_registro').find('input, textarea, button, select').removeAttr('disabled');
		//$('.article_registro').removeClass('hide');  
		//$("#PreRegistro_wizard_form").submit();

		//if ( EnviarDatosAjax(route,token,inputData,results,accion) ){
		var counter = 0;
		var intervalCounter = setInterval(function() {
		    counter++;
		}, 1000);
		//console.log(thisForm);
		$('#'+ thisForm).submit();
			//console.log("submitted!");
			$( document ).one('ajaxStop', function() {
				if( $(results).attr('return') == 'correcto' ){
					$('div#datos_email_enviar').addClass('hide');
					$.smallBox({
					  title: "Perfecto! Los datos fueron " + proceso + " correctamente",
					  content: "Hace <i class='fa fa-clock-o'></i> <i>"+counter+" segundos...</i> <br> " + mensaje,
					  color: color,
					  iconSmall: "fa fa-check bounce animated"
					});
					clearInterval(intervalCounter);
					/*
					setTimeout(function(){
					  location.reload();
					}, 2000);
					*/
				};
            });
		//};

		//
	});






	//funcionaes para los radio button o chekbox que sirvan para mostrar algun contenido
	//funcionaes para los radio button o chekbox que sirvan para mostrar algun contenido
	//funcionaes para los radio button o chekbox que sirvan para mostrar algun contenido
	//funcionaes para los radio button o chekbox que sirvan para mostrar algun contenido
	//funcionaes para los radio button o chekbox que sirvan para mostrar algun contenido

	function mostrarCheckbox_show(thisId,accion){
		if (accion == 'mostrar') {
			if ( $('div.checkbox_show#'+ thisId ).hasClass('disabledContent') ) {
				$('div.checkbox_show#'+ thisId ).removeClass('disabledContent').addClass('enabledContent');
			}
			if ( $('div.checkbox_show#'+ thisId ).hasClass('hide') ) {
				$('div.checkbox_show#'+ thisId ).removeClass('hide');
			}
			$('div.checkbox_show#'+ thisId ).show('fast');

		}else if(accion == 'ocultar'){
			if ( $('div.checkbox_show#'+ thisId ).hasClass('enabledContent') ) {
				$('div.checkbox_show#'+ thisId ).addClass('disabledContent').removeClass('enabledContent');
			}else{
				$('div.checkbox_show#'+ thisId ).hide('fast');
			}
		}

	}
	
	$('input.checkbox_show').each(function(){
		var thisId = $(this).attr('id');
		var thisForm = $(this).parents('form').attr('id');
		var accion = $(this).attr('accion');
		
		//console.log(thisId + ' - ' + $(this).val() + ' - ' + accion);
		
		//tipo radio button
		if ( $(this).is(':radio') && $(this).val() == 'SI' && $(this).is(':checked') ) {
			accion = accion || 'ocultar';
			mostrarCheckbox_show(thisId,accion);
			//especifico para la aceptacion o rechazo de la solicitud de alianza
			if ( thisId == 'aceptar_alianza' ) {
				$(this).parents('form').find('div#aceptar_alianza_enviar').addClass('hide');
				$(this).parents('form').find('div#aceptar_alianza').removeClass('hide');
				$(this).parents('#Registro_content').find('#btnNext').removeClass('disabled');
			}
		}else if ( $(this).is(':radio') && $(this).val() == 'NO' && $(this).is(':checked') )  {
			accion = accion || 'mostrar';
			mostrarCheckbox_show(thisId,accion);
			//especifico para la aceptacion o rechazo de la solicitud de alianza
			if ( thisId == 'aceptar_alianza' ) {
				$(this).parents('form').find('div#aceptar_alianza_enviar').removeClass('hide');
				$(this).parents('form').find('div#aceptar_alianza').addClass('hide');
				$(this).parents('#Registro_content').find('#btnNext').addClass('disabled');
			}
		}

		//tipo checkbox
		if ( $(this).is(':checkbox') && $(this).is(':checked') ) {
			accion = accion || 'ocultar';
			mostrarCheckbox_show(thisId,accion);
		}	
		
	});

	// para que se vea animado el progreso de los pasos
	// $('input.checkbox_show').on('change', function(){

	$(document).on('change','input.checkbox_show',function(){
		var thisId = $(this).attr('id');
		var thisForm = $(this).parents('form').attr('id');
		var accion = $(this).attr('accion');
		//console.log(thisId + ' - ' + $(this).val() + ' - ' + accion);
		
		//tipo radio button
		if ( $(this).is(':radio') && $(this).val() == 'SI' ) {

			accion = accion || 'ocultar';
			mostrarCheckbox_show(thisId,accion);

			//especifico para la aceptacion o rechazo de la solicitud de alianza
			if ( thisId == 'aceptar_alianza' ) {
				//$('#' + thisForm +' div#aceptar_alianza_enviar').addClass('hide');
				$(this).parents('form').find('div#aceptar_alianza_enviar').addClass('hide');
				$(this).parents('form').find('div#aceptar_alianza').removeClass('hide');
				$(this).parents('#Registro_content').find('#btnNext').removeClass('disabled');
			}
		}else if ( $(this).is(':radio') && $(this).val() == 'NO' )  {
			accion = accion || 'mostrar';
			mostrarCheckbox_show(thisId,accion);

			//especifico para la aceptacion o rechazo de la solicitud de alianza
			if ( thisId == 'aceptar_alianza' ) {
				//$('#' + thisForm +' div#aceptar_alianza_enviar').addClass('hide');
				$(this).parents('form').find('div#aceptar_alianza_enviar').removeClass('hide');
				$(this).parents('form').find('div#aceptar_alianza').addClass('hide');
				$(this).parents('#Registro_content').find('#btnNext').addClass('disabled');
			}
		}

		//tipo checkbox
		if ( $(this).is(':checkbox') && $(this).is(':checked') ) {
			accion = accion || 'ocultar';
			mostrarCheckbox_show(thisId,accion);
		}else if ( $(this).is(':checkbox') && !$(this).is(':checked') )  {
			accion = accion || 'mostrar';
			mostrarCheckbox_show(thisId,accion);
		}	
		
	});

	





	/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/
	/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/
	/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/
	/*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/

	$(document).on('click','#PreRegistro_content #btnNext, #Registro_content #btnNext',function(){
		/*var $valid = $(".PreRegistro_form").valid();
		if (!$valid) {
		  $validator_PreRegistro.focusInvalid();
		  return false;
		} else {
		  //$('.PreRegistro_form').wizard('next');
		    $('#menuPreRegistro .actions .btn-next').click();
		}*/
		var FormContent = $(this).parents('.step-content').attr('id');
		$( "#" + FormContent + " .step-pane.active form" ).submit();
	});

	$(document).on('click','#PreRegistro_content #btnBack, #Registro_content #btnBack',function(){

		var menu = '#' + $(this).parents('.wizard_content').attr('id');
		var botones = '#' + $(this).parents('.wizard_content').find('.button-content').attr('id');
		
		$(menu + ' .actions.menu .btn-prev').click();
		$(botones + ' #btnNext').removeClass('disabled');
	});

	