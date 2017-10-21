<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @yield('meta')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/font-awesome.min.css') }}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen"
          href="{{ asset('assets/css/smartadmin-production-plugins.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen"
          href="{{ asset('assets/css/smartadmin-production.min.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/smartadmin-skins.min.css') }}">

    <!-- SmartAdmin RTL Support  -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/smartadmin-rtl.min.css') }}">

<!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/css/your_style.css') }}" > -->

    <!-- FAVICONS -->

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
</head>
<body class="smart-style-1">
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img src="{{ asset('assets/img/logo-white.png') }}" alt="SmartAdmin"> </span>
        <!-- END LOGO PLACEHOLDER -->

        <!-- Note: The activity badge color changes when clicked and resets the number to 0
        Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
        <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 0 </b> </span>

        <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
        <div class="ajax-dropdown">

            <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
            <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default">
                    <input type="radio" name="activity" id="ajax/notify/mail.html">
                    Msgs (0) </label>
                <label class="btn btn-default">
                    <input type="radio" name="activity" id="ajax/notify/notifications.html">
                    notify (0) </label>
                <label class="btn btn-default">
                    <input type="radio" name="activity" id="ajax/notify/tasks.html">
                    Tasks (0) </label>
            </div>

            <!-- notification content -->
            <div class="ajax-notifications custom-scroll">

                <div class="alert alert-transparent">
                    <h4>Click a button to show messages here</h4>
                    This blank page message helps protect your privacy, or you can show the first message here
                    automatically.
                </div>

                <i class="fa fa-lock fa-4x fa-border"></i>

            </div>
            <!-- end notification content -->

            <!-- footer: refresh area -->
            <span> Last updated on: 12/12/2016 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..."
                                class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button>
					</span>
            <!-- end footer -->

        </div>
        <!-- END AJAX-DROPDOWN -->
    </div>

    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                            class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="{{ asset('assets/img/avatars/sunny.png') }}" alt="John Doe" class="online"/>
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i
                                    class="fa fa-cog"></i> Setting</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i
                                    class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"
                           data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"
                           data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i
                                    class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="login.html" title="Sign Out" data-action="userLogout"
                      data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i
                            class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->

        <!-- search mobile button (this is hidden till mobile view port) -->
        <div id="search-mobile" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
        </div>
        <!-- end search mobile button -->

        <!-- input: search field -->
        <form action="search.html" class="header-search pull-right">
            <input id="search-fld" type="text" name="param" placeholder="Find reports and more" data-autocomplete='[
					"ActionScript",
					"AppleScript",
					"Asp",
					"BASIC",
					"C",
					"C++",
					"Clojure",
					"COBOL",
					"ColdFusion",
					"Erlang",
					"Fortran",
					"Groovy",
					"Haskell",
					"Java",
					"JavaScript",
					"Lisp",
					"Perl",
					"PHP",
					"Python",
					"Ruby",
					"Scala",
					"Scheme"]'>
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form>
        <!-- end input: search field -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
                            class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

        <!-- #Voice Command: Start Speech -->
        <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
            <div>
                <a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i
                            class="fa fa-microphone"></i></a>
                <div class="popover bottom">
                    <div class="arrow"></div>
                    <div class="popover-content">
                        <h4 class="vc-title">Voice command activated <br>
                            <small>Please speak clearly into the mic</small>
                        </h4>
                        <h4 class="vc-title-error text-center">
                            <i class="fa fa-microphone-slash"></i> Voice command failed
                            <br>
                            <small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
                            <br>
                            <small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
                        </h4>
                        <a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a>
                        <a href="javascript:void(0);" class="btn bg-color-purple txt-color-white"
                           onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end voice command -->

        <!-- multiple lang dropdown : find all flags in the flags page -->
        <ul class="header-dropdown-list hidden-xs">
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img
                            src="{{ asset('assets/img/blank.gif') }}" class="flag flag-us" alt="United States"> <span> English (US) </span>
                    <i class="fa fa-angle-down"></i> </a>
                <ul class="dropdown-menu pull-right">
                    <li class="active">
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-us" alt="United States"> English (US)</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-fr" alt="France"> Français</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-es" alt="Spanish"> Español</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-de" alt="German"> Deutsch</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-jp" alt="Japan"> 日本語</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-cn" alt="China"> 中文</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-it" alt="Italy"> Italiano</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-pt" alt="Portugal"> Portugal</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-ru" alt="Russia"> Русский язык</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('assets/img/blank.gif') }}"
                                                           class="flag flag-kr" alt="Korea"> 한국어</a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- end multiple lang -->

    </div>
    <!-- end pulled right: nav area -->
</header>

<!-- Left panel : Navigation area -->
<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="{{ asset('assets/img/avatars/sunny.png') }}" alt="me" class="online"/>
                <span>
                    john.doe
                </span>
                <i class="fa fa-angle-down"></i>
            </a>

        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
        <ul>
            <li>
                <a href="{{ url('mockup') }}" title="Dashboard">
                    <i class="fa fa-lg fa-fw fa-home"></i>
                    <span class="menu-item-parent">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" title="Interchange">
                    <i class="fa fa-lg fa-fw fa-exchange"></i>
                    <span class="menu-item-parent">Interchange</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ url('mockup/interout') }}" title="InterOut"><i class="fa fa-lg fa-fw fa-arrow-up"></i> <span class="menu-item-parent">InterOut</span></a>
                    </li>
                    <li class="">
                        <a href="{{ url('mockup/interin') }}" title="InterIn"><i class="fa fa-lg fa-fw fa-arrow-down"></i> <span class="menu-item-parent">InterIn</span></a>
                    </li>
                    <li>
                        <a href="{{ url('mockup/changemap') }}" title="ChangeMap"><i class="fa fa-map-marker"></i>InterMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="InterAlliance">
                    <i class="fa fa-lg fa-fw fa-handshake-o "></i>
                    <span class="menu-item-parent">InterAlliance</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ url('mockup/suscripciones') }}" title="Suscripciones"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Suscripciones</span></a>
                    </li>
                    <li class="">
                        <a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Solicitar una Alianza</span></a>
                    </li>
                    <li class="">
                        <a href="{{ url('mockup/misconvenios') }}" title="Dashboard"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Revisar mis Solicitudes</span></a>
                    </li>
                    <li>
                        <a href=""{{ url('mockup/alliancemap') }}"><i class="fa fa-map-marker"></i>InterMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="InterActions">
                    <i class="fa fa-lg fa-fw fa-rocket"></i>
                    <span class="menu-item-parent">InterActions</span>
                </a>
                <ul>
                    <li class="">
                        <a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-gear"></i> <span class="menu-item-parent">Encontrar Oportunidades</span></a>
                    </li>
                    <li class="">
                        <a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Presentar mi Iniciativa</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-map-marker"></i>InterMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" title="InterAdmin">
                    <i class="fa fa-lg fa-fw fa-gears"></i>
                    <span class="menu-item-parent">InterAdmin</span>
                </a>
            </li>
        </ul>

    </nav>
</aside>
<!-- MAIN PANEL -->
<div id="main" role="main">
    @yield('main')
</div>

@include('common::SmartAdmin.layout.footer')

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script data-pace-options='{ "restartOnRequestAfter": true }'
        src="{{ asset('assets/js/plugin/pace/pace.min.js') }}"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="{{ asset('assets/js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="{{ asset('assets/js/app.config.js') }}"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="{{ asset('assets/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- CUSTOM NOTIFICATION -->
<script src="{{ asset('assets/js/notification/SmartNotification.min.js') }}"></script>

<!-- JARVIS WIDGETS -->
<script src="{{ asset('assets/js/smartwidgets/jarvis.widget.min.js') }}"></script>

<!-- EASY PIE CHARTS -->
<script src="{{ asset('assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>

<!-- SPARKLINES -->
<script src="{{ asset('assets/js/plugin/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- JQUERY VALIDATE -->
<script src="{{ asset('assets/js/plugin/jquery-validate/jquery.validate.min.js') }}"></script>

<!-- JQUERY MASKED INPUT -->
<script src="{{ asset('assets/js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

<!-- JQUERY SELECT2 INPUT -->
<script src="{{ asset('assets/js/plugin/select2/select2.min.js') }}"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<script src="{{ asset('assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<!-- browser msie issue fix -->
<script src="{{ asset('assets/js/plugin/msie-fix/jquery.mb.browser.min.js') }}"></script>

<!-- FastClick: For mobile devices -->
<script src="{{ asset('assets/js/plugin/fastclick/fastclick.min.js') }}"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

<![endif]-->

<!-- Demo purpose only -->
<!--<script src="{{ asset('assets/js/demo.min.js') }}"></script>-->

<!-- MAIN APP JS FILE -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<script src="{{ asset('assets/js/speech/voicecommand.min.js') }}"></script>

<!-- SmartChat UI : plugin -->
<script src="{{ asset('assets/js/smart-chat-ui/smart.chat.ui.min.js') }}"></script>
<script src="{{ asset('assets/js/smart-chat-ui/smart.chat.manager.min.js') }}"></script>

<!-- PAGE RELATED PLUGIN(S) -->

<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="{{ asset('assets/js/plugin/flot/jquery.flot.cust.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/flot/jquery.flot.tooltip.min.js') }}"></script>

<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="{{ asset('assets/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- Full Calendar -->
<script src="{{ asset('assets/js/plugin/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/fullcalendar/jquery.fullcalendar.min.js') }}"></script>

@yield('scripts')
</body>
</html>