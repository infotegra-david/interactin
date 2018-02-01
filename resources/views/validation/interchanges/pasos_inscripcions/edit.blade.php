@extends('layouts.app')



@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Editar validación de la inscripcion";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    if( $peticion == "normal" ){
        $your_style = 'bootstrap-select.min.css,your_style.css';
    }elseif( $peticion == "limpio" ){
        $your_style = '';
    }

    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $menu="InterValidations";
    $submenu1="InterChanges";
    $submenu2='Create';
    ?>

@endsection
@section('content')
  <div class="row hide" style="padding-left: 20px" id="datos_validacion_inscripcion">

    <h2>
        Datos de la inscripcion #{{ $inscripcion_id }}
    </h2>

    @include('InterChange.show_fields')
  </div>

   <section class="content-header">
        <h1>
            Desición
        </h1>
   </section>
   <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pasosInscripcion, ['route' => ['interchanges.validations_interchanges.update', $pasosInscripcion->id], 'method' => 'patch','files' => true]) !!}

                        @include('validation.interchanges.pasos_inscripcions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('div#datos_validacion_inscripcion div').removeClass('form-group').removeClass('input-group').removeClass('form-control');
            $('div#datos_validacion_inscripcion .collapseInscripcion').removeClass('hide');
            $('div#datos_validacion_inscripcion #collapseDataInscripcion').addClass('collapse');

            $('div#datos_validacion_inscripcion').removeClass('hide');
        });
    </script>
@endsection