@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

    <?php

    //require_once(base_path()."/resources/views/inc/...");
    
    ?>

@endsection

@section('styles')
    @if( $peticion == "basico" )
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/your_style.css')}}">
    @endif
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
        $your_style = '';
    }

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
                  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterChange <span>&gt; Vista de la inscripción </span></h1>
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
                    
                    <div class="col-sm-12">
                        <section class="content-header">
                            <h1>
                                Datos de la inscripción
                            </h1>
                        </section>
                    </div>
                    
                    <div class="row">
                        <div id="flash-msg">
                            @include('flash::message')
                            @include('adminlte-templates::common.errors')
                        </div>
                    </div>
                    <div class="content">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row" style="padding-left: 20px">
                                    @include('InterChange.show_fields')
                                    @if( $peticion == "normal" )
                                    <a href="{!! route('interchanges.'.$tipoInterChange.'.index') !!}" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                                    <a href="{!! route('interchanges.'.$tipoInterChange.'.edit',$inscripcionId) !!}" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i> Editar</a>
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
            
        });

    </script>
@endsection