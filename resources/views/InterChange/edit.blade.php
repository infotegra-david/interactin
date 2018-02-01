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
  $your_script = 'js/my_functions.js';
  // $your_script = '';

  //include left panel (navigation)
  //follow the tree in inc/config.ui.php

  $page_nav = 1;
  $page_nav_route[ "InterChange" ]["sub"][ $tipoInterChange ]["sub"][ 'Register'.$tipoInterChange ]["active"] = true;
  // $menu="InterChange";
  // $submenu1=$tipoInterChange;
  //$submenu2='';
  ?>

@endsection

@section('content')

    <!-- MAIN CONTENT -->
    <div id="contenido">
      @if( $peticion == "normal" )
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
          <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterAlliance <span>&gt; {{ $tipoInterChange }}</span></h1>
        </div>

      </div>
      @endif
      <!-- widget grid -->
      <section id="widget-grid" class="">
      
        <!-- row -->
        <div class="row">
          

        @if( $paso <= 4)
          <!-- Registro de una nueva inscripcion -->
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
                <h2 title="Pre registro del estudiante">Pre registro del estudiante</h2>

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
                        
                        $method = 'patch';
                        if( !isset($editar_paso) ){ $editar_paso = false; }

                        $route = [$route_split.'.update', $interchange['inscripcionId']];
                      ?>
                      

                      @if( $editar_paso === false || $editar_paso >= $paso )
                        @include('InterChange.fields_preregistro')
                      @else
                        @include('errors.404')
                      @endif

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
        @if( $paso >= 5)
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
                <h2 title="Registro del estudiante">Registro del estudiante</h2>

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

                      <?php 
                        
                        $method = 'patch';
                        if( !isset($editar_paso) ){ $editar_paso = false; }

                        $route = [$route_split.'.update', $interchange['inscripcionId']];
                      ?>
                      

                      @if( $editar_paso === false || $editar_paso >= $paso )
                        @include('InterChange.fields_registro')
                      @else
                        @include('errors.404')
                      @endif


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
  {{ Html::script('/js/plugin/fuelux/wizard/wizard_solo.js') }}
  <!-- { { Html::script('/js/bootstrap/bootstrap-multiselect.js') }} -->
  <!-- { { Html::script('/js/bootstrap/bootstrap-select.min.js') }} -->

  {{ Html::script('js/plugin/sparkline/jquery.sparkline.min.js') }}

  <!-- PAGE RELATED PLUGIN(S) -->
  <script type="text/javascript">

    $(document).ready(function() {
      var formEnviarRetorno = false;



      /*el formulario (form) es el que se valida*/
      //var $validator = $("#wizard-1").validate({


      

      //FIN ENVIAR AJAX POST
      //FIN ENVIAR AJAX POST


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

    });

  </script>
@endsection