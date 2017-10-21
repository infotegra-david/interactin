<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Validador";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["dashboard"]["sub"]["Validador"]["active"] = true;
include("inc/nav.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Other Pages"] = "";
		$breadcrumbs["Forum Layout"] = APP_URL."/forum.php";
		include("inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">

		<!-- Bread crumb is created dynamically -->
		<!-- row -->
		<div class="row">

			<!-- col -->
			<div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i> Inicio <span>>
					Validador </span></h1>
			</div>
			<!-- end col -->

			<!-- right side of the page with the sparkline graphs -->
			<!-- col -->
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<!-- sparks -->
				<ul id="sparks">
					<li class="sparks-info">
						<h5> Revisiones <span class="txt-color-blue">171</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile">
							1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
						</div>
					</li>
					<li class="sparks-info">
						<h5> Nuevas <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" title="Increased"></i>&nbsp;45%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile">
							110,150,300,130,400,240,220,310,220,300, 270, 210
						</div>
					</li>
					<li class="sparks-info">
						<h5> Pendientes <span class="txt-color-greenDark"><i class="fa fa-clock-o"></i>&nbsp;47</span></h5>
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
		
		<!-- row -->
		<div class="row">
		
			<div class="col-sm-12">
		
				<div class="well">
		
					<table class="table table-striped table-forum">
						<thead>
							<tr>
								<th colspan="2"><a href="forum.php"> Inicio </a> > Validador</th>
							</tr>
						</thead>
					</table>

					<div>
						&nbsp;&nbsp;<h1 class="" center><strong>Bienvenido <?php echo isset($_SESSION["username"]) == true ? $_SESSION["username"] : 'Jhon'; ?>!</strong></h1>
					</div>
						
					<div>
						&nbsp;&nbsp;<h3 class="txt-color-blue" center><strong>Sus tareas</strong></h3>
					</div>

					<table class="table table-striped table-forum">
						<thead>
							<tr>
								<th colspan="2"><a href="forum.php"> Item </a></th>
								<th class="text-center hidden-xs hidden-sm" style="width: 100px;">Alumnos</th>
								<th class="hidden-xs hidden-sm" style="width: 200px;">Última modificación</th>
							</tr>
						</thead>
						<tbody>

							
							<!-- TR -->
							<tr class="warning">

								<td class="text-center" style="width: 40px;"><i class="glyphicon glyphicon-pushpin fa-2x text-danger"></i></td>
								<td>
									<h4><a href="forum-post.php">
										Instituto Brasileño
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
							
							<!-- TR -->
							<tr class="warning">
								<td class="text-center" style="width: 40px;"><i class="glyphicon glyphicon-pushpin fa-2x text-danger"></i></td>
								<td>
									<h4><a href="forum-post.php">
										Universidad de España
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
							
							<!-- TR -->
							<tr>
								<td colspan="2">
									<h4><a href="forum-post.php">
										Nam quam nunc blandit vel
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
							
							<!-- TR -->
							<tr>
								<td colspan="2">
									<h4><a href="forum-post.php">
										Maecenas nec odio et ante tincidun
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
		
							<!-- TR -->
							<tr>
								<td colspan="2">
									<h4><a href="forum-post.php">
										Donec sodales sagittis magna
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
		
							<!-- TR -->
							<tr>
								<td colspan="2">
									<h4><a href="forum-post.php">
										Sed consequat, leo eget bibendum sodales
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
		
							<!-- TR -->
							<tr>
								<td colspan="2">
									<h4><a href="forum-post.php">
										Consectetuer adipiscing elit
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
		
							<!-- TR -->
							<tr class="locked">
								<td colspan="2">
									<h4><a href="forum-post.php">
										This is a locked topic!
									</a>
										<small><a href="#ajax/profile.php">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->
		
							<!-- TR -->
							<tr class="closed">
								<td colspan="2">
									<h4><a href="forum-post.php">
										This is a closed topic!
									</a>
										<small><a href="javascript:void(0);">John Doe</a> on <em>January 1, 2017</em></small>
									</h4>
								</td>
								<td class="text-center hidden-xs hidden-sm">
									<a href="javascript:void(0);">1342</a>
								</td>
								<td class="hidden-xs hidden-sm">by 
									<a href="javascript:void(0);">John Doe</a>
									<br>
									<small><i>January 1, 2017</i></small>
								</td>
							</tr>
							<!-- end TR -->									
							
						</tbody>
					</table>
		
					<div class="text-center">
		                <ul class="pagination pagination-sm">
		                    <li class="disabled"><a href="javascript:void(0);">Prev</a></li>
		                    <li class="active"><a href="javascript:void(0);">1</a></li>
		                    <li><a href="javascript:void(0);">2</a></li>
		                    <li><a href="javascript:void(0);">3</a></li>
		                    <li><a href="javascript:void(0);">...</a></li>
		                    <li><a href="javascript:void(0);">99</a></li>
		                    <li><a href="javascript:void(0);">Next</a></li>
		                </ul>
		            </div>
		
				</div>
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
<script src="..."></script>-->

<script>

	$(document).ready(function() {
		// PAGE RELATED SCRIPTS
	})

</script>

<?php 
	//include footer
	include("inc/google-analytics.php"); 
?>