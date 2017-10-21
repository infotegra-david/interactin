@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = $proceso." - Lista de Archivos";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    $your_style = 'bootstrap-select.min.css,your_style.css';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $menu=($menuApp ?? "dashboard");
    $submenu1=($submenu1App ?? "Lista de Archivos");
    //$submenu2='';
    ?>

@endsection


@section('content')
    <div class="row">
        <div id="flash-msg">
            @include('flash::message')
            @include('adminlte-templates::common.errors')

        </div>
    </div>
    <!-- MAIN CONTENT -->
    <div id="content_editor" class="container">
        <div class="col-sm-12">
            <!-- <div class="col-sm-12"> -->
                <div class="table-responsive text-left no_overflow form-group">
                    <table class="table-hover full no_margin">
                        <thead>
                            <tr>
                                <th class="content-cell" >
                                    <h2>Lista de archivos:</h2>
                                </th>
                                <th class="text-right" >
                                    <a href="{{ $route_new }}" class="btn btn-md btn-primary text-black"><i class="fa fa-plus"></i> <strong>Nuevo</strong></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($archivos) && $archivos != '' )
                                @foreach( $archivos as $archivo )
                                <tr  class="" >
                                    <td class=""  title="{{ $archivo->nombre }}" >
                                        {{ $archivo->nombre }}
                                    </td>       
                                    <td class="" >
                                        <a class="btn btn-xs btn-success pull-right" href="{{ $archivo->url_edit }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                        <a class="btn btn-xs btn-default pull-right" target="_blank"href="{{ Storage::url($archivo->path) }}"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr  class="" >
                                    <td class="" >
                                        No tiene archivos asociados.
                                    </td>       
                                    <td class="" >
                                        
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> 
            <!-- </div>  -->
                <div class="form-group text-left">
                    <footer>
                        <a href="{{ $route_back }}" class="btn btn-md btn-default text-black"><i class="fa fa-arrow-left"></i> <strong>Atras</strong></a>
                    </footer>
                </div>
        </div> 

    </div> 

@endsection