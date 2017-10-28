<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "InterOutMap";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["InterChange"]["sub"]["InterOutMap"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			  <h1><em></em> InterOut &gt; Map</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8"> </div>
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">

			<!-- row -->
			<div class="row">
				<article class="col-sm-12">
					<!-- new widget -->
					<div class="jarviswidget" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
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
						<!-- widget div-->
						<div class="no-padding">
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
							</div>
							<!-- end widget edit box -->

                                        <div id="updating-chart" class="chart-large txt-color-blue" style="display:none"></div>
					

						</div>
						<!-- end widget div -->
					</div>
					<!-- end widget -->

				</article>
			</div>

			<!-- end row -->

			<!-- row -->

			<div class="row">
<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- new widget -->
			<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">

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
							<span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
							<h2>Mapa interOut</h2>
							&nbsp;&nbsp;&nbsp;

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Periodo
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="javascript:void(0);">2017 - 1</a>
									</li>
									<li>
										<a href="javascript:void(0);">2016 - 2</a>
									</li>
									<li>
										<a href="javascript:void(0);">2016 - 1</a>
									</li>
									<li>
										<a href="javascript:void(0);">Total</a>
									</li>
								</ul>
							</div>

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

							<div class="widget-body no-padding">
								<!-- content goes here -->

								<div id="vector-map" class="vector-map"></div>
								<div id="heat-fill">
									<span class="fill-a">0</span>

									<span class="fill-b">5,000</span>
								</div>

								<table class="table table-striped table-hover table-condensed">
									<thead>
										<tr>
											<th>País</th>
											<th>Estudiantes</th>
											<th class="text-align-center">Actividad</th>
											<th class="text-align-center">Demographic</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a href="javascript:void(0);">USA</a></td>
											<td>4,977</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												2700, 3631, 2471, 1300, 1877, 2500, 2577, 2700, 3631, 2471, 2000, 2100, 3000
											</div></td>
											
											<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												17,83
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);">Colombia</a></td>
											<td>4,873</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												1000, 1100, 3030, 1300, -1877, -2500, -2577, -2700, 3631, 2471, 4700, 1631, 2471
											</div></td>
											
											<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												22,88
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);">India</a></td>
											<td>3,671</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												3631, 1471, 2400, 3631, 471, 1300, 1177, 2500, 2577, 3000, 4100, 3000, 7700
											</div></td>
											
											<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												10,90
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);">Brazil</a></td>
											<td>2,476</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												2700, 1877, 2500, 2577, 2000, 3631, 2471, -2700, -3631, 2471, 1300, 2100, 3000,
											</div></td>
											<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												34,66
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);">Turkey</a></td>
											<td>1,476</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-blue text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												1300, 1877, 2500, 2577, 2000, 2100, 3000, -2471, -2700, -3631, -2471, 2700, 3631
											</div></td>
											
											<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												75,25
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
										<tr>
											<td><a href="javascript:void(0);">Canada</a></td>
											<td>146</td>
											<td class="text-align-center">
											<div class="sparkline txt-color-orange text-align-center" data-sparkline-height="22px" data-sparkline-width="90px" data-sparkline-barwidth="2">
												5, 34, 10, 1, 4, 6, -9, -1, 0, 0, 5, 6, 7
											</div></td>
																						<td class="text-align-center">
											<div class="sparkline display-inline" data-sparkline-type='pie' data-sparkline-piecolor='["#E979BB", "#57889C"]' data-sparkline-offset="90" data-sparkline-piesize="23px">
												50,50
											</div>
											<div class="btn-group display-inline pull-right text-align-left hidden-tablet">
												<button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
													<i class="fa fa-cog fa-lg"></i>
												</button>
												<ul class="dropdown-menu dropdown-menu-xs pull-right">
													<li>
														<a href="docs/Presentación.pdf" target="_blank"><i class="fa fa-file fa-lg fa-fw txt-color-redLight"></i> <u>P</u>DF</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-greenLight"></i> <u>E</u>xcel</a>
													</li>
													<li>
														<a href="javascript:void(0);"><i class="fa fa-file fa-lg fa-fw txt-color-orange"></i> P<u>o</u>werPoint</a>
													</li>
												</ul>
											</div></td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan=5>
											<ul class="pagination pagination-xs no-margin">
												<li class="prev disabled">
													<a href="javascript:void(0);">Previous</a>
												</li>
												<li class="active">
													<a href="javascript:void(0);">1</a>
												</li>
												<li>
													<a href="javascript:void(0);">2</a>
												</li>
												<li>
													<a href="javascript:void(0);">3</a>
												</li>
												<li class="next">
													<a href="javascript:void(0);">Next</a>
												</li>
											</ul></td>
										</tr>
									</tfoot>
								</table>

								<!-- end content -->

							</div>

						</div>
						<!-- end widget div -->
					</div>
					<!-- end widget -->

					<!-- new widget -->
					<div class="jarviswidget jarviswidget-color-blue" id="wid-id-4" data-widget-editbutton="false" data-widget-colorbutton="false">

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
						<!-- widget div-->						<!-- end widget div -->
					</div>
					<!-- end widget -->

				</article>

			</div>

			<!-- end row -->

		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>


<script>
	$(document).ready(function() {

		/*
		 * VECTOR MAP
		 */

		data_array = {
			"US" : 4977,
			"CO" : 4873,
			"IN" : 3671,
			"BR" : 2476,
			"TR" : 1476,
			"CN" : 146,
			"CA" : 134,
			"BD" : 100
		};

		$('#vector-map').vectorMap({
			map : 'world_mill_en',
			backgroundColor : '#fff',
			regionStyle : {
				initial : {
					fill : '#c4c4c4'
				},
				hover : {
					"fill-opacity" : 1
				}
			},
			series : {
				regions : [{
					values : data_array,
					scale : ['#85a8b6', '#4d7686'],
					normalizeFunction : 'polynomial'
				}]
			},
			onRegionLabelShow : function(e, el, code) {
				if ( typeof data_array[code] == 'undefined') {
					e.preventDefault();
				} else {
					var countrylbl = data_array[code];
					el.html(el.html() + ': ' + countrylbl + ' visits');
				}
			}
		});


	});

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>