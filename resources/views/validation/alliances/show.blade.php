@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('styles')
    @if( $peticion == "basico" )
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/your_style.css')}}">
    @endif

@endsection


@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Validación - Vista de la Alianza";

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
    $submenu1="InterAlliances";
    //$submenu2='';
    ?>

@endsection

@section('content')
    <section class="content-header">
        <h1>
            Datos de la Alianza #{{ $alianzaId }}
        </h1>
    </section>

    <div class="row">
        <div id="flash-msg">
            @include('flash::message')
            @include('adminlte-templates::common.errors')
        </div>
    </div>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row {{ ( $peticion == 'normal' ? 'hide' : '') }}" style="padding-left: 20px" id="datos_validacion">
                    
                    @include('validation.alliances.show_fields')
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('div#datos_validacion_alianza div').removeClass('form-group').removeClass('input-group').removeClass('form-control');
            $('div#datos_validacion_alianza .collapseAlianza').removeClass('hide');
            $('div#datos_validacion_alianza #collapseDataAlianza').addClass('collapse');
            
            $('div#datos_validacion_alianza, div#datos_validacion').removeClass('hide');
        });
    </script>
@endsection