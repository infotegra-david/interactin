@extends( $peticion == "normal" ? 'layouts.app' : 'layouts.empty' )

@section('requires')

	<?php

	//require_once(base_path()."/resources/views/inc/...");
	
	?>

@endsection

@section('styles')
	
@endsection

@section('head_vars')

	<?php
	/*---------------- PHP Custom Scripts ---------

	YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$pagetitle = "Alianzas";

	$breadcrumbs["Other Pages"] = "";
	$breadcrumbs["Forum Layout"] = "/forum.php";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	$your_style = 'your_style.css';
	//$your_style = 'bootstrap-select.min.css';
	//$your_script = 'js/plugin/sparkline/jquery.sparkline.min.js';
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php

	$page_nav = 1;
	$page_nav_route[ "InterAlliance" ]["sub"][ "Alliances" ]["active"] = true;
	//$submenu2='';
	?>

@endsection

@section('content')
		

		<!-- MAIN CONTENT -->
		<div id="contenido">
			@if( $peticion == "normal" )
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				  <h1 class="page-title txt-color-blueDark"><em class="fa fa-pencil-square-o fa-fw "></em> InterAlliance <span>&gt; Mis alianzas </span></h1>
				</div>

				<!-- right side of the page with the sparkline graphs -->
				<!-- col -->
				<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
					<!-- sparks -->
					<ul id="sparks">
						<li class="sparks-info">
							<h5> Mis alianzas <span class="txt-color-blue">171</span></h5>
							<div class="sparkline txt-color-blue hide-mobile">
								1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
							</div>
						</li>
					</ul>
					<!-- end sparks -->
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
				<div id="flash-msg">
		            @include('flash::message')
		            @include('adminlte-templates::common.errors')
		            
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
									<h2>Lista de alianzas</h2>	
									
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
										
										<table id="lista_alianzas" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									        <thead>
									            <tr>
									                <th></th>
									                <th class="hasinput">
														<i class="fa fa-fw fa-handshake-o text-muted hide-md-down"></i> Alianzas - Institución
													</th>
									                <th class="hasinput">
									                	<i class="fa fa-fw fa-percent text-muted hide-md-down"></i> Progreso
									                </th>
									                <th class="hasinput">
														<i class="fa fa-fw fa-user text-muted hide-md-down"></i> Involucrados
									                </th>
									                <th class="hasinput">
									                	<i class="fa fa-fw fa-file-pdf-o text-muted hide-md-down"></i> Documento
									                </th>
									                <th class="hasinput hide-sm-down">
									                	Actividad: &nbsp;<i class="fa fa-circle txt-color-darken font-xs"></i> Objetivo/ <i class="fa fa-circle text-danger font-xs"></i> Actual
									                </th>
									                <th class="hasinput hide-sm-down">
									                	<i class="fa fa-fw fa-calendar text-muted hide-md-down"></i> Actualización
									                </th>
									                <th class="hasinput hide-sm-down">
									                	<i class="fa fa-fw fa-calendar text-muted hide-md-down"></i> Inicio
									                </th>
									                <th class="hasinput hide-sm-down">
									                	<i class="fa fa-fw fa-calendar text-muted hide-md-down"></i> Final
									                </th>
									                <th class="hasinput hide-sm-down">
									                	<i class="fa fa-fw fa-calendar text-muted hide-md-down"></i> Restante
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
														<input type="text" class="form-control" placeholder="Por alianza" />
													</th>
													<th class="hasinput">
														<input type="text" class="form-control" placeholder="Por progreso" />
													</th>
													<th class="hasinput">
														<input type="text" class="form-control" placeholder="Por involucrados" />
													</th>
													<th class="hasinput">
														<input type="text" class="form-control" placeholder="Por documento" />
													</th>
													<th class="hasinput hide-sm-down">
														<input type="text" class="form-control" placeholder="Por actividad" />
													</th>

													<th class="hasinput hide-sm-down">
														<div class="icon-addon">
															<input id="dateselect_filter1" type="text" placeholder="Por actualización" class="form-control datepicker" data-dateformat="yy-mm-dd">
															<label for="dateselect_filter1" class="glyphicon glyphicon-calendar no-margin padding-top-10" rel="tooltip" title="" data-original-title="Por actualización"></label>
														</div>
													</th>

													<th class="hasinput hide-sm-down">
														<div class="icon-addon">
															<input id="dateselect_filter2" type="text" placeholder="Por fecha de inicio" class="form-control datepicker" data-dateformat="yy-mm-dd">
															<label for="dateselect_filter2" class="glyphicon glyphicon-calendar no-margin padding-top-10" rel="tooltip" title="" data-original-title="Por fecha de inicio"></label>
														</div>
													</th>
													<th class="hasinput hide-sm-down">
														<div class="icon-addon">
															<input id="dateselect_filter3" type="text" placeholder="Por fecha de fin" class="form-control datepicker" data-dateformat="yy-mm-dd">
															<label for="dateselect_filter3" class="glyphicon glyphicon-calendar no-margin padding-top-10" rel="tooltip" title="" data-original-title="Por fecha de fin"></label>
														</div>
													</th>
													<th class="hasinput hide-sm-down">
														<input type="text" class="form-control" placeholder="Por tiempo restante" />
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
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
		<!-- ==========================CONTENT ENDS HERE ========================== -->


@endsection

@section('scripts')

	<!-- https://datatables.net/examples/advanced_init/html5-data-attributes.html -->
	{{ Html::script('/js/plugin/datatables/jquery.dataTables.min.js') }}
	{{ Html::script('/js/plugin/datatables/dataTables.bootstrap.min.js') }}
	{{-- Html::script('/js/plugin/datatable-responsive/datatables.responsive.min.js') --}}
		<!-- SPARKLINES -->
	{{ Html::script('js/plugin/sparkline/jquery.sparkline.min.js') }}
	{{ Html::script('js/smartwidgets/jarvis.widget.min.js') }}

	{{-- Html::script('/js/plugin/datatables/dataTables.colVis.min.js') --}}
	{{-- Html::script('/js/plugin/datatables/dataTables.tableTools.min.js') --}}

	<!-- PAGE RELATED PLUGIN(S) -->
	<script type="text/javascript">

		$(document).ready(function() {
			
			var data = [
				@foreach($alianzas AS $alianza)
			        {
			            "nombre": "Alianza #{{ $alianza['id'] }}: {{ $alianza['institucion']['institucion_nombre'] }}<br><small class='text-muted'><i>{{ $alianza['institucion']['campus']['ciudad']['pais']['pais_nombre'] }}<i></small>",
			            "progreso": "{{ $alianza['progreso'] }}% <div class='progress progress-xs no_progress_val' data-progressbar-value='{{ $alianza['progreso'] }}'><div class='progress-bar'></div></div>",
			            "task_pending": "{{ $alianza['task_pending'] }}",
			            "involucrados": "<div class='project-members {{ $alianza['task_pending'] }}'>"+
			            @foreach ($alianza['validaciones'] as $validacion)
			            	"<a href='{{ route('user.show',$validacion['user_id']) }}' target='_blank'><img src='{{ URL::to('/img/avatars/male.png') }}' "+
			            	@if ($validacion['estado_nombre'] == 'APROBADO' || $validacion['estado_nombre'] == 'ACTIVA')
			            		"class='online'"+
			            	@elseif(in_array($validacion['estado_nombre'],['RECHAZADO','DECLINADO']))
			            		"class='busy'"+
			            	@elseif($validacion['estado_nombre'] == 'EN REVISIÓN' || $validacion['estado_nombre'] == 'GENERAR DOCUMENTO')
			            		"class='away'"+
			            	@else
			            		"class='online'"+
			            	@endif
			            	" title='{{ $validacion['validador_titulo'].': '.$validacion['estado_nombre'] }}' alt='validator'></a>"+
			            @endforeach
			            " </div> ",
			            @if(isset($alianza['archivo']) )
			            "documento": "<a href='{{ \Storage::url($alianza['archivo']['path']) }}' title='{{ $alianza['archivo']['nombre'] }}' target='_blank' class='btn btn-danger fa fa-file-pdf-o'> PDF</a>",
		        		@else
		        			@if(isset($alianza['tipo_paso_id']) )
			            		"documento": '{!! Form::open(["route" => ["interalliances.validations_interalliances.store","alianza=".$alianza["id"]], "files" => true]) !!}{{ Form::hidden("tipo_paso_id", $alianza["tipo_paso_id"]) }}{{ Form::hidden("user_id", $alianza["user_id"]) }}{{ Form::hidden("estado_id", $alianza["estado_id"]) }}{!! Form::label("archivo_input".$alianza["id"], " Cargar documento", ["class" => "btn btn-md btn-success fa fa-file-pdf-o", "title" => "Cargue el archivo del documento final diligenciado.", "rel"=> "tooltip", "data-content"=> "Cargue el archivo del documento final diligenciado.", "data-placement"=> "top" ]) !!}{{ Form::file("archivo_input", ["id" => "archivo_input".$alianza["id"], "class" => "btn btn-danger fa fa-file-pdf-o hide", "placeholder" => "", "accept" => ".pdf, .jpg, .jpeg, .png" ]) }}{!! Form::submit(" Enviar", ["type" => "button", "class" => "btn btn-md btn-success hide", "name" => "cargar_documento", "id" => "cargar_documento", "onclick" => "return confirm(\'¿Desea cargar el documento?\')", "title" => "Envíe el archivo escogido del documento final diligenciado.", "rel"=> "tooltip", "data-content"=> "Envíe el archivo escogido del documento final diligenciado.", "data-placement"=> "top" ]) !!}{!! Form::close() !!}',
		        			@else
			            		"documento": "<span class='btn btn-default'>SIN ARCHIVO</span>",
		        			@endif
		        		@endif
			            "target-actual": "<span style='margin-top:5px' class='sparkline display-inline' data-sparkline-type='compositebar' data-sparkline-height='18px' data-sparkline-barcolor='#aafaaf' data-sparkline-line-width='2.5' data-sparkline-line-val='[6, 40, 14, 36, 32, 4, 7, 16, 50, 49, 24, 47, 33, 10, 45, 41, 18, 37, 38]' data-sparkline-bar-val='[9, 4, 32, 33, 18, 23, 17, 8, 30, 7, 48, 29, 10, 14, 6, 36, 28, 16, 24]'></span>",
			            "actual": "<span class='sparkline text-align-center' data-sparkline-type='line' data-sparkline-width='100%' data-sparkline-height='25px'>20,-35,70</span>",
			            "estado": "{{ $alianza['estado_nombre'] }}",
			            "actualizacion": "{{ $alianza['updated_at'] }}",
			            "inicio": "{{ $alianza['fecha_inicio'] }}",
			            "duracion": "{{ $alianza['duracion'] }}",
			            "final": "<strong>{{ $alianza['fecha_final'] }}</strong>",
			            "restante": "<strong class='txt-color-orange'>{{ $alianza['tiempo_restante'] }}</strong>",
			            "tipo_institucion": "{{ $alianza['institucion']['tipo_institucion_nombre'] }}",
			            "pasos_registrados": "{{ $alianza['pasos_registrados'].'/'.$alianza['total_pasos'] }}",
			            @if(isset($alianza['validacion_coor_ext']) )
			            "validacion_coor_ext": "<strong>Decisión del coordinador externo:</strong> {{ str_replace(PHP_EOL,' ',$alianza['validacion_coor_ext']) }} <br/>",
			            @else
			            "validacion_coor_ext": "",
			            @endif
			            "estado_actual": "{{ $alianza['estado_actual'] }}",
			            "objetivo": "{{ json_encode($alianza['objetivo']) }}",
			            @if(isset($alianza['validador']) && $alianza['task_pending'] != '' )
			            	"acciones": "<span><a href='{{ route('interalliances.validations_interalliances.show',$alianza['id']) }}' class='btn btn-sm btn-primary fa fa-check-square-o'> Realizar Validación</a></span>"
			            @elseif(isset($alianza['coordinador_externo']) )
			            	"acciones": "<span><a href='{{ route('interalliances.destination',$alianza['id']) }}' class='btn btn-sm btn-success fa fa-search-plus'> Ver Alianza</a></span>"
			            @else
			            	"acciones": "<span><a href='{{ route('interalliances.show',$alianza['id']) }}' class='btn btn-sm btn-success fa fa-search-plus'> Ver Alianza</a></span>"
			            @endif
			        }, 
	        	@endforeach
	        	];

			/* Formatting function for row details - modify as you need */
			function format ( d ) {
			    // `d` is the original data object for the row
			    return '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed" >'+
			        '<tr>'+
			            '<td style="width:100px">Estado de la alianza:</td>'+
			            '<td>'+d.estado+'</td>'+
			        '</tr>'+
			        '<tr>'+
			            '<td>Duración:</td>'+
			            '<td>'+d.duracion+'</td>'+
			        '</tr>'+
			        '<tr>'+
			            '<td>Información extra:</td>'+
			            '<td>'+
				            '<strong>Tipo de institución</strong>: '+d.tipo_institucion+'<br/>'+
				            '<strong>Pasos registrados</strong>: '+d.pasos_registrados+'<br/>'+
				            d.validacion_coor_ext+
				            '<strong>Estado del proceso</strong>: '+d.estado_actual+
			            '</td>'+
			        '</tr>'+
			        '<tr>'+
			            '<td>Objetivo:</td>'+
			            '<td>'+d.objetivo+'</td>'+
			        '</tr>'+
			        '<tr>'+
			            '<td>Acciones:</td>'+
			            '<td>'+d.acciones+'</td>'+
			        '</tr>'+
			    '</table>';
			}

		        //"ajax": "{{ URL::to('/data/dataList2.json') }}",
		    var table = $('#lista_alianzas').DataTable( {
		    	"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hide-xs-down'l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hide-xs-down'i><'col-xs-12 col-sm-6'p>>",
		        "bDestroy": true,
		        "iDisplayLength": 15,
		        "sLoadingRecords": "Please wait - loading...",
		        "sProcessing": "Table is currently busy",
		        "oLanguage": {
				    "sSearch": '<span class="hide"> _INPUT_ </span>Filtrar por: {{ Form::select('select_filter', $select_filter, old('select_filter') ?? $filter, ['id' => 'select_filter', 'class' => 'form-control input-sm', 'target' => '', 'url' => route('interalliances.index')]) }}'
				},
				"data": data,
		        "columns": [
		            {
		                "class":          'details-control',
		                "orderable":      false,
		                "data":           null,
		                "defaultContent": ''
		            },
					{ "data": "nombre" },
					{ "data": "progreso" },
					{ "data": "involucrados" },
					{ "data": "documento" },
					{ "data": "target-actual" },
					{ "data": "actualizacion" },
					{ "data": "inicio" },
					{ "data": "final" },
					{ "data": "restante" },
		        ],
		        "order": [[6, 'desc']],
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

		     
		    // Add event listener for opening and closing details


		    $('#lista_alianzas tbody').on('click', 'td.details-control', function () {
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

		    /* para la carga de archivos*/

		    $('input[name="archivo_input"]').on('change',function(){
		    	$(this).parents('form').find('input[type="submit"]').trigger('click');
		    });

		    $('#lista_alianzas .task_pending').each(function () {
			    $(this).parents('tr').addClass('task_pending');
		    });


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