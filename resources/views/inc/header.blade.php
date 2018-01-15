<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" <?php echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_html_prop), $page_html_prop)); ?>>
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> <?php echo $page_title != "" ? $page_title." - " : ""; ?>Interactin </title>
		<meta name="description" content="">
		<meta name="author" content="">

		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/font-awesome.min.css')}}">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/smartadmin-production-plugins.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/smartadmin-production.min.css')}}"> 
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/smartadmin-skins.min.css')}}">

		<!-- SmartAdmin RTL Support is under construction-->
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/smartadmin-rtl.min.css')}}">

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/your_style.css')}}"> -->

		<?php

			if ($page_css) {
				foreach ($page_css as $css) {
		?>
					{!! Html::style('/css/'.$css) !!}
		<?php

				}
			}
		?>


		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/demo.min.css')}}">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{{URL::asset('img/favicon/favicon.ico')}}" type="image/x-icon">
		<link rel="icon" href="{{URL::asset('img/favicon/favicon.ico')}}" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700"> -->

		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="{{URL::asset('img/splash/sptouch-icon-iphone.png')}}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{URL::asset('img/splash/touch-icon-ipad.png')}}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('img/splash/touch-icon-iphone-retina.png')}}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('img/splash/touch-icon-ipad-retina.png')}}">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="{{URL::asset('img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="{{URL::asset('img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="{{URL::asset('img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		
		<script>
			if (!window.jQuery) {
				document.write('<script src="{{ URL::asset('js/libs/jquery-2.1.1.min.js') }}"><\/script>');
			}
		</script>

		
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="{{ URL::asset('js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
			}
		</script>


	</head>
	<body 
	
	class="fixed-ribbon  desktop-detected  fixed-header fixed-navigation    pace-done smart-style-{{ isset($smart_style)? $smart_style : 5 }}"
	<?php /*echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_body_prop), $page_body_prop)); */?> >

		<!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width -- desktop-detected pace-done fixed-header fixed-navigation fixed-ribbon
			 You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
		<?php
			if (!$no_main_header) {

		?>
				<!-- HEADER -->
				<header id="header">
					<div id="logo-group">

						<!-- PLACE YOUR LOGO HERE -->
						<span id="logo"> 
							<a href="{{ route('home') }}">
								<img src="{{URL::asset('img/logo.png')}}" alt="InterActin"> 
							</a>
						</span>
						<!-- END LOGO PLACEHOLDER -->

						<!-- Note: The activity badge color changes when clicked and resets the number to 0
						Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
						<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>

						<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
						<div class="ajax-dropdown">

							<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
							<div class="btn-group btn-group-justified" data-toggle="buttons">
								<label class="btn btn-default">
									<input type="radio" name="activity" id="{{URL::asset('ajax/notify/mail.php')}}">
									Msgs (14) </label>
								<label class="btn btn-default">
									<input type="radio" name="activity" id="{{URL::asset('ajax/notify/notifications.php')}}">
									notify (3) </label>
								<label class="btn btn-default">
									<input type="radio" name="activity" id="{{URL::asset('ajax/notify/tasks.php')}}">
									Tasks (4) </label>
							</div>

							<!-- notification content -->
							<div class="ajax-notifications custom-scroll">

								<div class="alert alert-transparent">
									<h4>Click a button to show messages here</h4>
									This blank page message helps protect your privacy, or you can show the first message here automatically.
								</div>

								<i class="fa fa-lock fa-4x fa-border"></i>

							</div>
							<!-- end notification content -->

							<!-- footer: refresh area -->
							<span> Last updated on: 12/12/2013 9:43AM
								<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
									<i class="fa fa-refresh"></i>
								</button> </span>
							<!-- end footer -->

						</div>
						<!-- END AJAX-DROPDOWN -->
					</div>

					<!-- projects dropdown -->
					<div class="project-context hidden-md-down">

						<span class="label">Projects:</span>
						<button id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Recent projects</button>

						<!-- Suggestion: populate this list with fetch and push technique -->
						<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
							<a class="dropdown-item" href="javascript:void(0);">Notes on pipeline upgradee</a>
							<a class="dropdown-item" href="javascript:void(0);">Assesment Report for merchant account</a>

							<a class="divider"></a>
							<a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
						</div>
						<!-- end dropdown-menu-->

					</div>
					<div class="institution-header data-header hidden-xs-down">
						<span class="label">Institución:</span>
						<span class="institution-name" title="{{ session('institucionAppNombre') }}">{{ session('institucionAppNombre') }}</span>
					</div>
					<div class="data-header campus-header" id="campusAppSelect">
						<span class="label">Campus:</span>
						@php
							$campusAppSelect = session('campusApp');
							$campusAppNombreSelect = session('campusAppNombre');
						@endphp
						<!--span class="input-group-addon"><i class="fa fa-university fa-lg fa-fw"></i></span-->
						{{ Form::select('campusAppSelect', ($campusApp ?? array($campusAppSelect => $campusAppNombreSelect)), (old('campusAppSelect') ?? $campusAppSelect), ['class' => 'form-control input-lg', 'rel' => 'tooltip', 'data-original-title' => 'Seleccione el campus que desea usar', 'data-placement' => 'bottom', 'results' => '', 'url' => route('campusAppSelect')]) }}

						{{ csrf_field() }}

						<script type="text/javascript">
							
							$(document).ready(function(){
								$('select[name="campusAppSelect"]').change(function(){
									var results = $(this).attr('results');
									var route = $(this).attr('url');
									var inputData = {campusAppSelect: $(this).val()};
									var token = $('#campusAppSelect').find('input[name="_token"]').val();
									//se envia la peticion mediante el metodo DELETE con el id del genero
									$.ajax({
										url: route,
										type: 'POST',
										headers: {'X-CSRF-TOKEN': token},
										data: inputData,
										success: function(msj){
											
											$.smallBox({
											  title: "El campus se cambio correctamente!",
											  content: "Hace un momento...",
											  color: '#5f895f',
											  iconSmall: "fa fa-check bounce animated"
											});
											$( document ).one('ajaxStop', function() {
							                	$('#container-loading').addClass("show");
							                });
											location.reload();

										},
								        error: function(msj){
								        	var row = '';
											
								            row = msj.responseText;
								            
								            //console.log(msj.responseJSON);
								            if( msj.responseJSON != undefined ){
								            	row = '';
								            	$.each(msj.responseJSON, function( index, value ) {
								               		row = row + value + "<br>";
								            	});
									        }

								            $.smallBox({
											  title: "Error! El campus no pudo ser cambiado",
											  content: row,
											  color: '#8b0000',
											  iconSmall: "fa fa-times bounce animated"
											});
								        }
									}).fail(function(jqXHR, textStatus, errorThrown) {
								        //de este modo se redirecciona a la pagina correspondiente
								        if (jqXHR.getResponseHeader('Location') != null){ 
								            window.Location= jqXHR.getResponseHeader('Location');
								        };
								    });
								});
							});

						</script>
					</div>
					<!-- end projects dropdown -->

					<!-- pulled right: nav area -->
					<div class="pull-right">

						<!-- collapse menu button -->
						<div id="hide-menu" class="btn-header pull-right">
							<span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
						</div>
						<!-- end collapse menu -->

						<!-- #MOBILE -->
						<!-- Top menu profile link : this shows only when top menu is active -->
						<ul id="mobile-profile-img" class="header-dropdown-list hidden-sm-up padding-5">
							<li class="">
								<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
									<img src="{{URL::asset('img/avatars/juan.png')}}" alt="John Doe" class="online" />
								</a>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="{{ URL('/logout') }}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>C</u>errar sesión</strong></a>
									</li>
								</ul>
							</li>
						</ul>

						<!-- logout button -->
						<div id="logout" class="btn-header transparent pull-right">
							<span> <a href="{{ URL('/logout') }}" title="Cerrar sesión" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
						</div>
						<!-- end logout button -->

						<!-- search mobile button (this is hidden till mobile view port) -->
						<div id="search-mobile" class="btn-header hidden-md-down transparent pull-right hidden-md-down">
							<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
						</div>
						<!-- end search mobile button -->

						<!-- input: search field -->
						<form action="{{URL::asset('search.php')}}" class="header-search pull-right hidden-md-down">
							<input type="text" name="param" placeholder="Find reports and more" id="search-fld">
							<button type="submit">
								<i class="fa fa-search"></i>
							</button>
							<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
						</form>
						<!-- end input: search field -->

						<!-- fullscreen button -->
						<div id="fullscreen" class="btn-header transparent pull-right hidden-sm-down">
							<span> <a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i></a> </span>
						</div>
						<!-- end fullscreen button -->
						
						<!-- #Voice Command: Start Speech -->
						<!-- 
						<div id="speech-btn" class="btn-header transparent pull-right hidden-sm-down hidden-xs-down">
							<div> 
								<a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a> 
								<div class="popover bottom"><div class="arrow"></div>
									<div class="popover-content">
										<h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
										<h4 class="vc-title-error text-center">
											<i class="fa fa-microphone-slash"></i> Voice command failed
											<br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
											<br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
										</h4>
										<a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a> 
										<a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a> 
									</div>
								</div>
							</div>
						</div>
						 -->
						<!-- end voice command -->
						
						<!-- multiple lang dropdown : find all flags in the flags page -->
						<!-- 					
						<ul class="header-dropdown-list hidden-xs-down">
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
									<img src="{{URL::asset('img/blank.gif')}}" class="flag flag-co')}}" alt="United States"> <span> Español (CO) </span> <i class="fa fa-angle-down"></i> </a>
								<ul class="dropdown-menu pull-right">
									<li class="active">
										<a href="javascript:void(0);"><img src="{{URL::asset('img/blank.gif')}}" class="flag flag-us" alt="United States"> English (US)</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="{{URL::asset('img/blank.gif')}}" class="flag flag-fr" alt="France"> Français</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="{{URL::asset('img/blank.gif')}}" class="flag flag-es" alt="Spanish"> Español</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="{{URL::asset('img/blank.gif')}}" class="flag flag-pt" alt="Portugal"> Portugal</a>
									</li>
									
								</ul>
							</li>
						</ul>
						-->
						<div id="google_translate_div" class="btn btn-header transparent pull-right hidden-md-down">
							<div id="google_translate_element"></div>
						</div>
<!--  
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------

						<script type="text/javascript">
							

							// function googleTranslateElementInit() {
							// 	new google.translate.TranslateElement({pageLanguage: 'hr', includedLanguages: 'en,fr,pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
							// }

							// $(document).ready(function(){
							// 	$('#google_translate_element a > span').addClass('hidden-xs-down');
							// });


						</script>
						<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
//--------------------------------
	 -->					
						<!-- end multiple lang -->

					</div>
					<!-- end pulled right: nav area -->

				</header>
				<!-- END HEADER -->

				<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
				Note: These tiles are completely responsive,
				you can add as many as you like
				-->
				<div id="shortcut">
					<ul>
						<li>
							<a href="{{URL::asset('/html/inbox.php')}}" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
						</li>
						<li>
							<a href="{{URL::asset('/html/calendar.php')}}" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
						</li>
						<li>
							<a href="{{URL::asset('/html/gmap-xml.php')}}" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
						</li>
						<li>
							<a href="{{URL::asset('/html/invoice.php')}}" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
						</li>
						<li>
							<a href="{{URL::asset('/html/gallery.php')}}" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
						</li>
						<li>
							<a href="{{URL::asset('/html/profile.php')}}" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
						</li>
					</ul>
				</div>
				<!-- END SHORTCUT AREA -->



		<?php
			}
		?>