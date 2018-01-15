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

    $pagetitle = "Vista de la Inscripción";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    if( $peticion == "normal" ){
        $your_style = 'bootstrap-select.min.css,your_style.css';
    }elseif( $peticion == "limpio" ){
        $your_style = 'your_style.css';
    }

    $your_script = '/js/plugin/sparkline/jquery.sparkline.min.js';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterChange" ]["sub"][ $tipoInterChange ]["sub"][ $tipoInterChange.'List' ]["active"] = true;
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
                  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterChange <span>&gt; Vista de la inscripción </span></h1>
                </div>

            </div>
            @endif
            <!-- widget grid -->
            <section id="widget-grid" class="">
            
                <!-- row -->
                <div class="row col-sm-12">
                    <div class="hide content text-center" id="datos_inscripcion">
                        <div class="col-sm-12">
                            <div class="content-header content-center text-left">
                                <h1>
                                    Datos de la inscripción #{{ $inscripcionId }}
                                </h1>
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div id="flash-msg">
                                @include('flash::message')
                                @include('adminlte-templates::common.errors')
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-body content-center text-left">
                                <div class="row {{ $metodo ?? '' }}" style="padding-left: 20px">
                                    @include('InterChange.show_fields')
                                    @if( $peticion == "normal" )
                                        <div class="col-sm-12">
                                            <br><br>
                                            <div class="col-sm-12">
                                                <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>

                                                @if( $editar_paso == true )
                                                    <a href="{!! route('interchanges.'.strtolower($tipoInterChange).'.edit',$inscripcionId) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar todo</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="">
                                                <div class=" full">
                                                    <!-- Updated At Field -->
                                                    <div class=" full">
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            
                <!-- end row -->
            
            </section>
            <!-- end widget grid -->

        </div>
        <!-- END MAIN CONTENT -->

@endsection

@section('scripts')


    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript">

        $(document).ready(function() {
            $('div#datos_inscripcion div:not(.no_tocar)').removeClass('form-group').removeClass('input-group').removeClass('form-control');
            $('div#datos_inscripcion').removeClass('hide');
        });

    </script>
@endsection