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

    <div id="contenido">

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div id="flash-msg">
                    @include('flash::message')
                    @include('adminlte-templates::common.errors')

                </div>
            </div>
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    
                    

                    <!-- NEW WIDGET START -->
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget " id="wid-id-12">
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
                                <span class="widget-icon"> <i class="fa fa-list"></i> </span>
                                <h2>Lista de archivos</h2>  
                                
                            </header>

                            <!-- widget div-->
                            <div>
                                
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
                                    <input class="form-control" type="text">    
                                </div>
                                <!-- end widget edit box -->
                                
                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    
                                    <table id="lista_archivos" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="hasinput">
                                                    <i class="fa fa-fw fa-handshake-o text-muted hide-md-down"></i> Tipo de documento
                                                </th>
                                                <th class="hasinput">
                                                    <i class="fa fa-fw fa-percent text-muted hide-md-down"></i> Nombre
                                                </th>
                                                <th class="hasinput">
                                                    <i class="fa fa-fw fa-user text-muted hide-md-down"></i> Acciones
                                                </th>
                                            </tr>
                                        </thead>

                                        <tfoot class="header">
                                            <tr>
                                                <th class="hasinput">
                                                    <button id="remove_filter" class="btn btn-xs btn-success" title="Quitar filtros de columnas">
                                                        <span class="fa-stack fa-md">
                                                          <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                                          <i class="fa fa-filter fa-stack-1x"></i>
                                                        </span>
                                                    </button>
                                                </th>
                                                <th class="hasinput">
                                                    <input type="text" class="form-control" placeholder="Por tipo" />
                                                </th>
                                                <th class="hasinput">
                                                    <input type="text" class="form-control" placeholder="Por nombre" />
                                                </th>
                                                <th class="hasinput text-right">
                                                    <a href="{{ $route_new }}" class="btn btn-md btn-primary text-black"><i class="fa fa-plus"></i> <strong>Agregar Nuevo</strong></a>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- end widget content -->
                                
                            </div>
                            <!-- end widget div -->
                            
                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->
                    
                </div>

                <!-- end row -->

                <!-- row -->

                <div class="row">

                    <!-- a blank row to get started -->
                    <div class="col-sm-12">
                        <!-- your contents here -->                 
                    </div>
                        
                </div>

                <!-- end row -->

            </section>
            <!-- end widget grid -->


        </div> 

    </div> 

@endsection


@section('scripts')

    {{ Html::script('/js/plugin/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('/js/plugin/datatables/dataTables.bootstrap.min.js') }}

    {{ Html::script('js/smartwidgets/jarvis.widget.min.js') }}

    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript">

        $(document).ready(function() {
            
            var data = [
                @foreach( $archivos as $archivo )
                    {
                        "tipo": "{{ $archivo['tipo_documento_nombre'] }}",
                        "nombre": "{{ $archivo['nombre'] }}",
                        "acciones": "<span><a class='btn btn-xs btn-success pull-right' href='{{ $archivo->url_edit }}'><i class='glyphicon glyphicon-edit'></i> Editar</a></span><span><a class='btn btn-xs btn-default pull-right' target='_blank' href='{{ Storage::url($archivo->path) }}'><i class='glyphicon glyphicon-eye-open'></i> Ver</a></span>"
                    },
                @endforeach
                ];


                //"ajax": "{{ URL::to('/data/dataList2.json') }}",
            var table = $('#lista_archivos').DataTable( {
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hide-xs-down'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hide-xs-down'i><'col-xs-12 col-sm-6'p>>",
                "bDestroy": true,
                "iDisplayLength": 15,
                "sLoadingRecords": "Espere por favor - cargando...",
                "sProcessing": "La tabla está actualmente ocupada",
                "oLanguage": {
                    "sSearch": '<span class="hide"> _INPUT_ </span>Filtrar por: {{ Form::select('select_filter', $select_filter, old('select_filter') ?? $filter, ['id' => 'select_filter', 'class' => 'form-control input-sm', 'target' => '', 'url' => route('admin.institutions.documents',$institucionId)]) }}'
                },
                "data": data,
                "columns": [
                    { "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "tipo" },
                    { "data": "nombre" },
                    { "data": "acciones", "orderable":      false},
                ],
                "order": [[1, 'asc']],
                "fnDrawCallback": function( oSettings ) {
                   runAllCharts()
                }
            } );

            //https://datatables.net/examples/api/multi_filter.html
            // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );

                $( 'input', this.footer() ).on( 'click', function (e) {
                    e.stopPropagation();
                });

            } );

            // var columns = this.s.dt.columns().eq(0).map( function (i) {
         //        return {
         //            className: this.column(i).header().className,
         //            includeIn: [],
         //            auto:      false,
         //            control: false,
         //            hide: false //new property to always hide column
         //        };
         //    } );


            $('#remove_filter').click(function(){
                $(this).parents('tr').find('input').val('').keyup(); 
            });

            $('select#select_filter').change(function(){
                $urlRoute = $(this).attr('url');
                $urlRoute = $urlRoute + '?filter=' + $(this).val();
                window.location.href = $urlRoute;
            });



        })

    </script>

@endsection
