<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Products View";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["dashboard"]["sub"]["Coordinador_ext"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["E-commerce"] = "";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<!-- row -->
		<div class="row">
			
			<!-- col -->
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark">
					
					<!-- PAGE HEADER -->
					<i class="fa-fw fa fa-home"></i> 
						Inicio
					<span>>  
						Coordinador Ext.
					</span>
				</h1>
			</div>
			<!-- end col -->

			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<!-- sparks -->
				<ul id="sparks">
					<li class="sparks-info">
						<h5> Mis Postulados <span class="txt-color-blue">171</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
					<li class="sparks-info">
						<h5> Postulantes <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" title="Increased"></i>&nbsp;45%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
					<li class="sparks-info">
						<h5> Sin evaluar <span class="txt-color-greenDark"><i class="fa fa-clock-o"></i>&nbsp;47</span></h5>
						<div class="sparkline txt-color-greenDark hidden-mobile">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
				</ul>
				<!-- end sparks -->
			</div>
			<!-- end col -->
			
		</div>
		<!-- end row -->

		<!--
			The ID "widget-grid" will start to initialize all widgets below 
			You do not need to use widgets if you dont want to. Simply remove 
			the <section></section> and you can use wells or panels instead 
			-->

		<!-- widget grid -->
		<section id="widget-grid" class="coordinador_items">

			<!-- row -->

			<div class="row">



				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<!-- product -->
					
					<header>
						&nbsp;&nbsp;<h1 class="" center><strong>Bienvenido <?php echo isset($_SESSION["username"]) == true ? $_SESSION["username"] : 'Jaime'; ?>!</strong></h1>

					</header>
					<!-- end product -->
				</div>	

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


				<div class="col-sm-4 col-md-4 col-lg-4">
					<!-- product -->
					<div class="product-content product-wrap clearfix">
						<div class="row">
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="product-image"> 
										<img src="img/avatars/student.jpg" alt="194x228" class="img-responsive"> 
									</div>
								</div>
								<div class="col-md-7 col-sm-12 col-xs-12">
								<div class="product-deatil">
										<h5 class="name">
											<a href="#">
												Estudiantes para postular <span>Movilidad</span>
											</a>
										</h5>
										<p class="price-container">
											<span>&nbsp;</span>
										</p>
										<span class="tag1"></span> 
								</div>
								<div class="description">
									<p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
									<p><a href="<?php echo APP_URL."/interin.php" ?>" class="btn btn-primary btn-lg">Postular Estudiante <i class="fa fa-arrow-right"></i></a></p>
									<br>
								</div>
							</div>
						</div>
					</div>
					<!-- end product -->
				</div>			

				<div class="col-sm-4 col-md-4 col-lg-4">
					<!-- product -->
					<div class="product-content product-wrap clearfix">
						<div class="row">
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="product-image"> 
										<img src="img/avatars/teacher2.jpg" alt="194x228" class="img-responsive"> 
									</div>
								</div>
								<div class="col-md-7 col-sm-12 col-xs-12">
								<div class="product-deatil">
										<h5 class="name">
											<a href="#">
												Estudiantes internacionales <span>Sus postulantes</span>
											</a>
										</h5>
										<p class="price-container">
											<span>19</span>
										</p>
										<span class="tag1"></span> 
								</div>
								<div class="description">
									<p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
									<p><a href="javascript:void(0);" class="btn btn-primary btn-lg">Evaluar Postulantes<i class="fa fa-arrow-right"></i></a></p>
									<br>
								</div>
							</div>
						</div>
					</div>
					<!-- end product -->
				</div>	

				<div class="col-sm-4 col-md-4 col-lg-4">
					<!-- product -->
					<div class="product-content product-wrap clearfix">
						<div class="row">
								<div class="col-md-5 col-sm-12 col-xs-12">
									<div class="product-image"> 
										<img src="img/avatars/universidad.jpg" alt="194x228" class="img-responsive"> 
									</div>
								</div>
								<div class="col-md-7 col-sm-12 col-xs-12">
								<div class="product-deatil">
										<h5 class="name">
											<a href="#">
												Universidad de Barcelona <span>Información</span>
											</a>
										</h5>
										<p class="price-container">
											<span>&nbsp;</span>
										</p>
										<span class="tag1"></span> 
								</div>
								<div class="description">
										<p>Proin in ullamcorper lorem. Maecenas eu ipsum </p>
										<p><a href="javascript:void(0);" class="btn btn-primary btn-lg">Actualizar Información <br> Institucional <i class="fa fa-arrow-right"></i></a></p>
								</div>
							</div>
						</div>
					</div>
					<!-- end product -->
				</div>	

			</div>

			<!-- end row -->
			
			<div class="row">

				<div class="col-sm-12">
					
					<div class="well">

						<hr>

						<div class="padding-10">

							<ul class="nav nav-tabs tabs-pull-right">
								<li class="active">
									<a href="#a1" data-toggle="tab">Recent Articles</a>
								</li>
								<li>
									<a href="#a2" data-toggle="tab">New Members</a>
								</li>
								<li class="pull-left">
									<span class="margin-top-10 display-inline"><i class="fa fa-rss text-success"></i> Activity</span>
								</li>
							</ul>

							<div class="tab-content padding-top-10">
								<div class="tab-pane fade in active" id="a1">

									<div class="row">

										<div class="col-xs-2 col-sm-1">
											<time datetime="2014-09-20" class="icon">
												<strong>Jan</strong>
												<span>10</span>
											</time>
										</div>

										<div class="col-xs-10 col-sm-11">
											<h6 class="no-margin"><a href="javascript:void(0);">Allice in Wonderland</a></h6>
											<p>
												Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi Nam eget dui.
												Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero,
												sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel.
											</p>
										</div>

										<div class="col-sm-12">

											<hr>

										</div>

										<div class="col-xs-2 col-sm-1">
											<time datetime="2014-09-20" class="icon">
												<strong>Jan</strong>
												<span>10</span>
											</time>
										</div>

										<div class="col-xs-10 col-sm-11">
											<h6 class="no-margin"><a href="javascript:void(0);">World Report</a></h6>
											<p>
												Morning our be dry. Life also third land after first beginning to evening cattle created let subdue you'll winged don't Face firmament.
												You winged you're was Fruit divided signs lights i living cattle yielding over light life life sea, so deep.
												Abundantly given years bring were after. Greater you're meat beast creeping behold he unto She'd doesn't. Replenish brought kind gathering Meat.
											</p>
										</div>

										<div class="col-sm-12">

											<br>

										</div>

									</div>

								</div>
								<div class="tab-pane fade" id="a2">

									<div class="alert alert-info fade in">
										<button class="close" data-dismiss="alert">
											×
										</button>
										<i class="fa-fw fa fa-info"></i>
										<strong>51 new members </strong>joined today!
									</div>

									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/female.png"><a href="javascript:void(0);">Jenn Wilson</a>
										<div class="email">
											travis@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Marshall Hitt</a>
										<div class="email">
											marshall@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Joe Cadena</a>
										<div class="email">
											joe@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Mike McBride</a>
										<div class="email">
											mike@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Travis Wilson</a>
										<div class="email">
											travis@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Marshall Hitt</a>
										<div class="email">
											marshall@company.com
										</div>
									</div>
									<div class="user" title="Joe Cadena joe@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Joe Cadena</a>
										<div class="email">
											joe@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Mike McBride</a>
										<div class="email">
											mike@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Marshall Hitt</a>
										<div class="email">
											marshall@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);">Joe Cadena</a>
										<div class="email">
											joe@company.com
										</div>
									</div>
									<div class="user" title="email@company.com">
										<img src="<?php echo ASSETS_URL; ?>/img/avatars/male.png"><a href="javascript:void(0);"> Mike McBride</a>
										<div class="email">
											mike@company.com
										</div>
									</div>

									<div class="text-center">
										<ul class="pagination pagination-sm">
											<li class="disabled">
												<a href="javascript:void(0);">Prev</a>
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
											<li>
												<a href="javascript:void(0);">...</a>
											</li>
											<li>
												<a href="javascript:void(0);">99</a>
											</li>
											<li>
												<a href="javascript:void(0);">Next</a>
											</li>
										</ul>
									</div>

								</div><!-- end tab -->
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

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>

	$(document).ready(function() {
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		 * // activate tooltips
		 * $("[rel=tooltip]").tooltip();
		 *
		 * // activate popovers
		 * $("[rel=popover]").popover();
		 *
		 * // activate popovers with hover states
		 * $("[rel=popover-hover]").popover({ trigger: "hover" });
		 *
		 * // activate inline charts
		 * runAllCharts();
		 *
		 * // setup widgets
		 * setup_widgets_desktop();
		 *
		 * // run form elements
		 * runAllForms();
		 *
		 ********************************
		 *
		 * pageSetUp() is needed whenever you load a page.
		 * It initializes and checks for all basic elements of the page
		 * and makes rendering easier.
		 *
		 */
		
		 pageSetUp();
		 
		/*
		 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
		 * eg alert("my home function");
		 * 
		 * var pagefunction = function() {
		 *   ...
		 * }
		 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
		 * 
		 * TO LOAD A SCRIPT:
		 * var pagefunction = function (){ 
		 *  loadScript(".../plugin.js", run_after_loaded);	
		 * }
		 * 
		 * OR
		 * 
		 * loadScript(".../plugin.js", run_after_loaded);
		 */
	})

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>