@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

    <?php

    //require_once(base_path()."/resources/views/inc/...");
    
    ?>

@endsection

@section('styles')
    <style type="text/css">


    </style>

@endsection

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Mis Inscripciones";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    $your_style = 'bootstrap-select.min.css,your_style.css';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $menu="InterChange";
    $submenu1="Inscripciones";
    //$submenu2='';
    ?>

@endsection

@section('content')

        <!-- MAIN CONTENT -->
        <div id="contenido">
            @if( $peticion == "normal" )
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterChange <span>&gt; Mis Inscripciones </span></h1>
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
<!-- ==========================CONTENT STARTS HERE ========================== -->
            

            <!-- MAIN CONTENT -->
            <div id="content">

                <!-- end row -->
                
                <!--
                    The ID "widget-grid" will start to initialize all widgets below 
                    You do not need to use widgets if you dont want to. Simply remove 
                    the <section></section> and you can use wells or panels instead 
                    -->
                



                <!-- widget grid -->
                <section id="widget-grid" class="">

                    <!-- row -->
                    <div class="row">
                        
                        
                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                            <!-- new widget -->
                            <div class="jarviswidget jarviswidget-color-blue" id="wid-id-4" data-widget-collapsed="true" data-widget-editbutton="false" data-widget-colorbutton="false">

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
                                    <span class="widget-icon"> <i class="fa fa-clock-o txt-color-white"></i> </span>
                                    <h2> Que hacer </h2>
                                    <!-- <div class="widget-toolbar">
                                    add: non-hidden - to disable auto hide

                                    </div>-->
                                </header>

                                <!-- widget div-->
                                <div>
                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <div>
                                            <label>Title:</label>
                                            <input type="text" />
                                        </div>
                                    </div>
                                    <!-- end widget edit box -->

                                    <div class="widget-body no-padding smart-form">
                                        <!-- content goes here -->
                                        <h5 class="todo-group-title"><i class="fa fa-warning"></i> Tareas Criticas (<small class="num-of-tasks">1</small>)</h5>
                                        <ul id="sortable1" class="todo">
                                            <li>
                                                <span class="handle"> <label class="checkbox" title="Completada">
                                                        <input type="checkbox" name="checkbox-inline">
                                                        <i></i> </label> </span>
                                                <p>
                                                    <strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
                                                    <span class="date">Jan 1, 2014</span>
                                                </p>
                                            </li>
                                        </ul>
                                        <h5 class="todo-group-title"><i class="fa fa-exclamation"></i> Tareas Importantes (<small class="num-of-tasks">3</small>)</h5>
                                        <ul id="sortable2" class="todo">
                                            <li>
                                                <span class="handle"> <label class="checkbox" title="Completada">
                                                        <input type="checkbox" name="checkbox-inline">
                                                        <i></i> </label> </span>
                                                <p>
                                                    <strong>Ticket #1347</strong> - Inbox email is being sent twice <small>(bug fix)</small> [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="date">Nov 22, 2013</span>
                                                </p>
                                            </li>
                                            <li>
                                                <span class="handle"> <label class="checkbox" title="Completada">
                                                        <input type="checkbox" name="checkbox-inline">
                                                        <i></i> </label> </span>
                                                <p>
                                                    <strong>Ticket #1314</strong> - Call customer support re: Issue <a href="javascript:void(0);" class="font-xs">#6134</a><small>(code review)</small>
                                                    <span class="date">Nov 22, 2013</span>
                                                </p>
                                            </li>
                                            <li>
                                                <span class="handle"> <label class="checkbox" title="Completada">
                                                        <input type="checkbox" name="checkbox-inline">
                                                        <i></i> </label> </span>
                                                <p>
                                                    <strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
                                                    <span class="date">Jan 1, 2014</span>
                                                </p>
                                            </li>
                                        </ul>

                                        <h5 class="todo-group-title"><i class="fa fa-check"></i> Tareas Completadas (<small class="num-of-tasks">1</small>)</h5>
                                        <ul id="sortable3" class="todo">
                                            <li class="complete">
                                                <span class="handle" style="display:none"> <label class="checkbox state-disabled">
                                                        <input type="checkbox" name="checkbox-inline" checked="checked" disabled="disabled">
                                                        <i></i> </label> </span>
                                                <p>
                                                    <strong>Ticket #17643</strong> - Hotfix for WebApp interface issue [<a href="javascript:void(0);" class="font-xs">More Details</a>] <span class="text-muted">Sea deep blessed bearing under darkness from God air living isn't. </span>
                                                    <span class="date">Jan 1, 2014</span>
                                                </p>
                                            </li>
                                        </ul>

                                        <!-- end content -->
                                    </div>

                                </div>
                                <!-- end widget div -->
                            </div>
                            <!-- end widget -->


                        </article>

                        <!-- NEW WIDGET START -->
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            
                            <div class="alert alert-info">
                                <strong>NOTE:</strong> All the data is loaded from a seperate JSON file
                            </div>

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget well" id="wid-id-0">
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
                                    <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                                    <h2>Widget Title </h2>              
                                    
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
                                        
                                        <table id="example" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th></th><th>Alianzas - Institución</th>
                                                    <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Progreso</th>
                                                    <th>Revisores</th>
                                                    <th>Archivo</th>
                                                    <th>Actividad: &nbsp;<i class="fa fa-circle txt-color-darken font-xs"></i> Objetivo/ <i class="fa fa-circle text-danger font-xs"></i> Actual</th>
                                                    <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Inicio</th>
                                                    <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Final</th>
                                                    <th><i class="fa fa-fw fa-calendar text-muted hidden-md hidden-sm hidden-xs"></i> Faltan</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            </tbody>
                                                <tr role="row" class="odd">
                                                    <td class=" details-control"></td>
                                                    <td class="sorting_1">Nombre Institucion</td>

                                                    <td><div class="progress progress-xs" data-progressbar-value="15"><div class="progress-bar"></div></div></td>

                                                    <td><div class="project-members"><a href="javascript:void(0)"></a><a href="javascript:void(0)"><img src="img/avatars/male.png" class="away"></a><a href="javascript:void(0)"><img src="img/avatars/3.png" class="away"></a> </div> </td>

                                                    <td><a href="docs/Presentación.pdf" target="_blank" class="btn btn-danger fa fa-file-pdf-o"> PDF</a></td>

                                                    <td><span style='margin-top:5px' class='sparkline display-inline' data-sparkline-type='compositebar' data-sparkline-height='18px' data-sparkline-barcolor='#aafaaf' data-sparkline-line-width='2.5' data-sparkline-line-val='[6, 40, 14, 36, 32, 4, 7, 16, 50, 49, 24, 47, 33, 10, 45, 41, 18, 37, 38]' data-sparkline-bar-val='[9, 4, 32, 33, 18, 23, 17, 8, 30, 7, 48, 29, 10, 14, 6, 36, 28, 16, 24]'></span></td>

                                                    <td>fecha inicial</td>

                                                    <td><strong>fecha final</strong></td>

                                                    <td><strong class="txt-color-green">faltan N Días</strong></td>

                                                    <td><span class="onoffswitch"><input type="checkbox" name="start_interval" class="onoffswitch-checkbox" id="st6"><label class="onoffswitch-label" for="st6"><span class="onoffswitch-inner" data-swchon-text="ACTIVO" data-swchoff-text="INACTIVO"></span><span class="onoffswitch-switch"></span></label></span></td>
                                                </tr>
                                            </tbody>
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
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->


@endsection

@section('scripts')

    
    {{ Html::script('/js/plugin/datatables/jquery.dataTables.min.js') }}
    {{ Html::script('/js/plugin/datatables/dataTables.colVis.min.js') }}
    {{ Html::script('/js/plugin/datatables/dataTables.tableTools.min.js') }}
    {{ Html::script('/js/plugin/datatables/dataTables.bootstrap.min.js') }}
    {{ Html::script('/js/plugin/datatable-responsive/datatables.responsive.min.js') }}

    <!-- PAGE RELATED PLUGIN(S) -->
    <script type="text/javascript">

        $(document).ready(function() {
            
            /* Formatting function for row details - modify as you need */
            function format ( d ) {
                // `d` is the original data object for the row
                return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">'+
                    '<tr>'+
                        '<td style="width:100px">Alianzas - Institución:</td>'+
                        '<td>'+d.name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Fecha Final:</td>'+
                        '<td>'+d.ends+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Informacion extra:</td>'+
                        '<td>And any further details here (images etc)...</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Comentarios:</td>'+
                        '<td>'+d.comments+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Acciones:</td>'+
                        '<td>'+d.action+'</td>'+
                    '</tr>'+
                '</table>';
            }

            // clears the variable if left blank
            var table = $('#example').DataTable( {
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "ajax": "data/dataList2.json",
                "bDestroy": true,
                "iDisplayLength": 15,
                "oLanguage": {
                    "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
                "columns": [
                    {
                        "class":          'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "name" },
                    { "data": "est" },
                    { "data": "contacts" },
                    { "data": "status" },
                    { "data": "target-actual" },
                    { "data": "starts" },
                    { "data": "ends" },
                    { "data": "half" },
                    { "data": "tracker" },
                ],
                "order": [[1, 'asc']],
                "fnDrawCallback": function( oSettings ) {
                   runAllCharts()
                }
            } );


             
            // Add event listener for opening and closing details
            $('#example tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            /* para la lista de tareas 'ToDo'*/

            /*
            * TODO: add a way to add more todo's to list
            */

            // initialize sortable
            $(function() {
                $("#sortable1, #sortable2").sortable({
                    handle : '.handle',
                    connectWith : ".todo",
                    update : countTasks
                }).disableSelection();
            });

            // check and uncheck
            $('.todo .checkbox > input[type="checkbox"]').click(function() {
                var $this = $(this).parent().parent().parent();

                if ($(this).prop('checked')) {
                    $this.addClass("complete");

                    // remove this if you want to undo a check list once checked
                    //$(this).attr("disabled", true);
                    $(this).parent().hide();

                    // once clicked - add class, copy to memory then remove and add to sortable3
                    $this.slideUp(500, function() {
                        $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                        $this.remove();
                        countTasks();
                    });
                } else {
                    // insert undo code here...
                }

            })
            // count tasks
            function countTasks() {

                $('.todo-group-title').each(function() {
                    var $this = $(this);
                    $this.find(".num-of-tasks").text($this.next().find("li").size());
                });

            }

        })

    </script>
@endsection

