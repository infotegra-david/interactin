@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

    <?php

    //require_once(base_path()."/resources/views/inc/...");
    
    ?>

@endsection

@section('styles')
    <style type="text/css">

        #bootstrap-wizard-1 > div.form-bootstrapWizard > ul > li{
            height: 80px;
        }

    </style>

@endsection

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = $tipoInterChange." - Movilidad académica";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    $your_style = 'bootstrap-select.min.css,your_style.css';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $menu="InterChange";
    $submenu1=$tipoInterChange;
    //$submenu2='';
    ?>

@endsection

@section('content')

        <!-- MAIN CONTENT -->
        <div id="contenido">
            @if( $peticion == "normal" )
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterChange <span>&gt; {{ $tipoInterChange }} </span></h1>
                </div>

                <!-- right side of the page with the sparkline graphs -->
                <!-- col -->
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                    <ul id="sparks" class="">
                        <li class="sparks-info">
                            <h5> Mi Presupuesto <span class="txt-color-blue">USD$2.500</span></h5>
                            <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                                1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end col -->
            </div>
            @endif
            <!-- widget grid -->
            <section id="widget-grid" class="">
            
                <!-- row -->
                <div class="row">
                    

                @if( $peticion == "normal" )

                    <!-- AYUDA -->
                    <!-- NEW WIDGET START -->
                    <article class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-2" data-widget-collapsed="true" data-widget-editbutton="false" data-widget-deletebutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
            
                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"
            
                            -->
                            <header>
                                <h2>Ayuda </h2>
            
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
            
                                </div>
                                <!-- end widget edit box -->
            
                                <!-- widget content -->
                                <div class="widget-body fuelux">
                                    <div class="step-content">
                                        <div class="form-horizontal" id="fuelux-wizard">
            
                                            <div class="step-pane active col-lg-11" > 
                                                Este formulario permite que los estudiantes registren sus datos para evaluar sus competencias y otorgar la autorización de movilidad
                                                <!-- wizard form starts here -->
                                          </div>            
                            
                                      </div>
                                  </div>
            
                              </div>
                                <!-- end widget content -->
            
                            </div>
                            <!-- end widget div -->
            
                        </div>
                        <!-- end widget -->


                    </article>
                    <!-- WIDGET END -->

                @endif
                @if( $paso == 1)
                    <!-- pre-Registro de una nueva alianza -->
                    <!-- NEW WIDGET START -->
                    <article class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-check"></i> </span>
                                <h2 title="Pre registro del estudiante">Pre inscripción del estudiante</h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body">

                                    <div class="row">

                                        <div id="flash-msg">
                                            @include('flash::message')
                                            @include('adminlte-templates::common.errors')

                                        </div>
                                        
                                        
                                        <div id="PreRegistro_results">
                                            <div id="show-msg" return="">
                                                @include( 'layouts.alerts' )
                                            </div>
                                        </div>
                                            <?php 
                                                $interchange = [''];
                                                $method = 'post';
                                             ?>
                                             @if(Route::current()->getName() == 'interchanges.interout.create')
                                            <?php 
                                                $route = ['interchanges.interout.store'];
                                             ?>
                                             @elseif(Route::current()->getName() == 'interchanges.interin.create')
                                            <?php 
                                                $route = ['interchanges.interin.store'];
                                             ?>                                             
                                             @endif
                                             
                                            @include('InterChange.fields_preregistro')

                                    </div>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->
                @endif
                @if( $paso == 5)
                    <!-- Registro de una nueva alianza -->
                    <!-- NEW WIDGET START -->
                    <article class="col-sm-12 col-md-12 col-lg-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false" data-widget-deletebutton="false">
                            <!-- widget options:
                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                            data-widget-colorbutton="false"
                            data-widget-editbutton="false"
                            data-widget-togglebutton="false"
                            data-widget-deletebutton="false"
                            data-widget-fullscreenbutton="false"
                            data-widget-custombutton="false"
                            data-widget-collapsed="true"
                            data-widget-sortable="false"

                            -->
                            <header>
                                <span class="widget-icon"> <i class="fa fa-check"></i> </span>
                                <h2 title="Registro del estudiante">Inscripción del estudiante</h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body">

                                    <div class="row">
                                    
                                        <div id="flash-msg">
                                            @include('flash::message')
                                            @include('adminlte-templates::common.errors')
                                        </div>

                                        <div id="Registro_results">
                                            <div id="show-msg" return="">
                                                @include( 'layouts.alerts' )
                                            </div>
                                        </div>

                                        @include('InterChange.fields_registro')

                                    </div>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->
                @endif

                </div>
            
                <!-- end row -->
            
            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

@endsection

@section('scripts')

    
    {{ Html::script('/js/smartwidgets/jarvis.widget.min.js') }}
    {{ Html::script('/js/plugin/fuelux/wizard/wizard_externo.min.js') }}
    <!-- { { Html::script('/js/bootstrap/bootstrap-multiselect.js') }} -->
    <!-- { { Html::script('/js/bootstrap/bootstrap-select.min.js') }} -->

    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript">

        $(document).ready(function() {
            var formEnviarRetorno = false;


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
                }else if ( $(this).is(':radio') && $(this).val() == 'NO' && $(this).is(':checked') )  {
                    accion = accion || 'mostrar';
                    mostrarCheckbox_show(thisId,accion);
                }

                //tipo checkbox
                if ( $(this).is(':checkbox') && $(this).is(':checked') ) {
                    accion = accion || 'ocultar';
                    mostrarCheckbox_show(thisId,accion);
                }   
                
            });
            // para que se vea animado el progreso de los pasos
            $('input.checkbox_show').on('change', function(){
                var thisId = $(this).attr('id');
                var thisForm = $(this).parents('form').attr('id');
                var accion = $(this).attr('accion');
                //console.log(thisId + ' - ' + $(this).val() + ' - ' + accion);
                
                //tipo radio button
                if ( $(this).is(':radio') && $(this).val() == 'SI' ) {

                    accion = accion || 'ocultar';
                    mostrarCheckbox_show(thisId,accion);

                }else if ( $(this).is(':radio') && $(this).val() == 'NO' )  {
                    accion = accion || 'mostrar';
                    mostrarCheckbox_show(thisId,accion);

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

            /*el formulario (form) es el que se valida*/
            //var $validator = $("#wizard-1").validate({

            /*
            var $validator_PreRegistro = $(".PreRegistro_form").validate({
                    
                rules: {
                  facultad_origen: {
                    required: true
                  },
                  facultad_origen_otra: {
                    required: true
                  },
                  programa_origen: {
                    required: true
                  },
                  nombre_coordinador_origen: {
                    required: true
                  },
                  cargo_coordinador_origen: {
                    required: true
                  },
                  telefono_coordinador_origen: {
                    required: true
                  },
                  email_coordinador_origen: {
                    required: true,
                    email: "El e-mail del coordinador debe tener el formato nombre@dominio.com"
                  },
                  tipo_alianza: {
                    required: true
                  },
                  aplicaciones: {
                    required: true
                  },
                  arl_responsable: {
                    required: true
                  },
                  duracion: {
                    required: true
                  },
                  duracion_unid: {
                    required: true
                  },
                  tipo_tramite: {
                    required: true
                  },
                  facultad: {
                    required: true
                  },
                  objetivo_alianza: {
                    required: true
                  },
                  institucion: {
                    required: true
                  },
                  tipo_institucion: {
                    required: true
                  },
                  direccion: {
                    required: true
                  },
                  codigo_postal: {
                    required: true
                  },
                  pais: {
                    required: true
                  },
                  ciudad: {
                    required: true
                  },
                  email_destino: {
                    required: true,
                    email: "El e-mail del destino debe tener el formato nombre@dominio.com"
                  }
                },
                
                messages: {

                  facultad_origen: "Por favor, ingrese la facultad / Oficina / Departamento",
                  facultad_origen_otra: "Por favor, ingrese la otra facultad / Oficina / Departamento",
                  programa_origen: "Por favor, ingrese los programas",
                  nombre_coordinador_origen: "Por favor, ingrese el nombre del coordinador",
                  cargo_coordinador_origen: "Por favor, ingrese el cargo coordinador",
                  telefono_coordinador_origen: "Por favor, ingrese el telefono del coordinador",
                  email_coordinador_origen: {
                    required: "Por favor, ingrese el email del coordinador",
                    email: "El email debe tener el formato usuario@dominio.com"
                  },
                  tipo_alianza: "Por favor, ingrese el tipo de alianza",
                  aplicaciones: "Por favor, ingrese las aplicaciones",
                  arl_responsable: "Por favor, ingrese quien es el responsable de la ARL",
                  duracion: "Por favor, ingrese la duracion",
                  duracion_unid: "Por favor, ingrese la duracion",
                  tipo_tramite: "Por favor, ingrese el tipo de tramite",
                  facultad: "Por favor, ingrese las facultades",
                  objetivo_alianza: "Por favor, ingrese el objetivo de la alianza",
                  institucion: "Por favor, ingrese el nombre de la institucion",
                  tipo_institucion: "Por favor, ingrese el tipo de institucion",
                  direccion: "Por favor, ingrese la direccion",
                  codigo_postal: "Por favor, ingrese el codigo postal",
                  pais: "Por favor, ingrese el pais",
                  ciudad: "Por favor, ingrese la ciudad",
                  email_destino: {
                    required: "Por favor, ingrese el email de destino",
                    email: "El email debe tener el formato usuario@dominio.com"
                  },
                  
                },
                
                highlight: function (element) {
                  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                  if (element.parent('.input-group').length) {
                    error.insertAfter( element.parent() );
                  } else if ( element.parent().parent('.input-group').length ) {
                    error.insertAfter( element.parent().parent() );
                  } else {
                    error.insertAfter(element);
                  }
                }
              });
            */

            //INICIO ENVIAR AJAX POST
            //INICIO ENVIAR AJAX POST

            // Attach a submit handler to the form
            $( ".PreRegistro_form, .Registro_form" ).submit(function( event ) {
                // Stop form from submitting normally
                event.preventDefault();
                var form = '#' + $(this).attr('id');
                var results = '#' + $(this).attr('results') + ' #show-msg';
                var menu = '#' + $(form).parents('#wizard_content').find('.wizard.menu').attr('id');
                var sinArchivos = true;
                var divData = $(form).serialize();

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
                            if ( $( results ).find('.dato_adicional#noNext').size() == 0 ) {
                                $(menu + ' .actions .btn-next').click();
                            }
                            $( results ).find('.dato_adicional').each(function(){
                                var thisName = $(this).attr('name');
                                $( '.step-pane.active form .dato_adicional[name="'+ thisName +'"]' ).remove();
                                $( '.step-pane.active form' ).append($(this));
                                
                            });
                        };
                        //$(this).unbind("ajaxStop");
                        //handler.off();
                    });
                };
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
                            $.each(msj.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
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

            /*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/

            $('#PreRegistro_content #btnNext, #Registro_content #btnNext').on('click', function() {
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

            $('#PreRegistro_content #btnBack, #Registro_content #btnBack').on('click', function() {
                var menu = '#' + $(this).parents('#wizard_content').find('.wizard.menu').attr('id');
                
                $(menu + ' .actions .btn-prev').click();
            });

            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
            /* ------------------------------------------------- */
    
            /*el formulario (form) es el que se valida*/
              //var $validator = $("#wizard-1").validate({
              /*
              var $validator_Registro = $(".Registro_form").validate({
                
                rules: {
                  repre_nombre: {
                    required: true
                  },
                  repre_nacimiento: {
                    required: true
                  },
                  repre_tipo_documento: {
                    required: true
                  },
                  repre_numero_documento: {
                    required: true
                  },
                  repre_lugar_exped_documento: {
                    required: true
                  },
                  repre_cargo: {
                    required: true
                  },
                  repre_telefono: {
                    required: true
                  },
                  repre_email: {
                    required: true,
                    email: "El e-mail del representante debe tener el formato nombre@dominio.com"
                  },
                  tipos_documentos: {
                    required: true
                  },
                  otros_documentos: {
                    required: true
                  },
                  archivo_documentos: {
                    required: true
                  },
                  nombre_coordinador_destino: {
                    required: true
                  },
                  cargo_coordinador_destino: {
                    required: true
                  },
                  telefono_coordinador_destino: {
                    required: true
                  },
                  email_coordinador_destino: {
                    required: true,
                    email: "El e-mail del coordinador debe tener el formato nombre@dominio.com"
                  }
                },
                
                messages: {
                  repre_nombre: "Por favor, ingrese el nombre del representante",
                  repre_nacimiento: "Por favor, ingrese el lugar de nacimiento del representante",
                  repre_tipo_documento: "Por favor, ingrese el tipo de documento del representante",
                  repre_numero_documento: "Por favor, ingrese el numero de documento del representante",
                  repre_lugar_exped_documento: "Por favor, ingrese el lugar_expedición del documento del representante",
                  repre_cargo: "Por favor, ingrese el cargo del representante",
                  repre_telefono: "Por favor, ingrese el telefono del representante",
                  repre_email: "Por favor, ingrese el email del representante",
                  tipos_documentos: "Por favor, ingrese los tipos de documentos",
                  otros_documentos: "Por favor, ingrese el otros tipo de documentos",
                  archivo_documentos: "Por favor, ingrese el archivo con los documentos",
                  nombre_coordinador_destino: "Por favor, ingrese el nombre del coordinador en el destino",
                  cargo_coordinador_destino: "Por favor, ingrese el cargo del coordinador en el destino",
                  telefono_coordinador_destino: "Por favor, ingrese el telefono del coordinador en el destino",
                  email_coordinador_destino: "Por favor, ingrese el email del coordinador en el destino",
                },
                
                highlight: function (element) {
                  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                  if (element.parent('.input-group').length) {
                    error.insertAfter( element.parent() );
                  } else if ( element.parent().parent('.input-group').length ) {
                    error.insertAfter( element.parent().parent() );
                  } else {
                    error.insertAfter(element);
                  }
                }
              });
            */

                /*se usan botones situados en otro lugar para ejecutar las funciones de los botones originales*/



                $('.Registro_form #btnBack').on('click', function() {
                    $('#menuRegistro .actions .btn-prev').click();
                });
        });

    </script>
@endsection