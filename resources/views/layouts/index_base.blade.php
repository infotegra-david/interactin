
<?php

//initilize the page
require_once(base_path()."/resources/views/inc/init.php");


//require UI configuration (nav, ribbon, etc.)
//require_once(base_path()."/resources/views/inc/config.ui.php");

?>

@yield('requires')

<?php
/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = (isset($pagetitle)? $pagetitle :"Inicio");

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");


?>
@include('inc.header')


<style type="text/css">

    html, #extr-page{
        background: none;
    }
    body {
        /*background: url(img/fondo.jpg) rgb(255, 255, 255) !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-position: bottom !important;
        background-size: 100% !important;*/
    }


    body div, #extr-page #main{
        background: none;
    }

    #extr-page #main .container{
        /*background: #fff;*/
    }

</style>

@yield('styles')



<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
<header id="header">
    <!--<span id="logo"></span>-->

    <div id="logo-groups" class="logo_inicio">
        <span id="logo"> 
            <a href="{{ route('index') }}">
                <img src="{{URL::asset('img/logo.png')}}" alt="InterActin"> 
            </a>
        </span>
        <!-- END AJAX-DROPDOWN -->
    </div>

    

    <ul id="extr-page-header-space"> 
        <!-- si no esta logueado -->
        @if (Auth::guest())
            @if ( !Request::is('login*') )
                @php
                    if (old('open_login')){
                        $open_login = old('open_login');
                    } 
                    $show_login = '';
                    $expanded_login = 'false';
                @endphp
                @if ($errors->has('email') || $errors->has('password') || isset($open_login)) 
                    @php
                        $show_login = 'open';
                        $expanded_login = 'true';
                    @endphp
                @endif
                <div class="dropdown login {{ $show_login }}">
                    <a class="btn btn-success" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="{{ $expanded_login }}">Iniciar sesión</a>
                    <div class="dropdown-menu dropdown-menu-right login row">
                        
                            <form id="login-form" class="smart-form client-form " role="form" method="POST" action="{{ url( (isset($route) ? $route : '/login') ) }}">
                                {!! csrf_field() !!}
                                <fieldset>
                                    @if (!$errors->has('password') && !$errors->has('password'))
                                        @include('flash::message')
                                        @include('adminlte-templates::common.errors')
                                    @endif
                                    {{ Form::hidden('open_login', '1') }}
                                    <section class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="label control-label">E-mail</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif

                                        </label>
                                    </section>

                                    <section class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="label control-label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" class="form-control" name="password">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </label>
                                        <div class="note">
                                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvido su password?</a>
                                        </div>
                                    </section>


                                    <section>
                                        <label class="checkbox">
                                            <input type="checkbox" name="remember" checked="">
                                            <i></i>Manter la sesión
                                        </label>
                                    </section>
                                </fieldset>

                                <footer>
                                    <?php 
                                        if ( isset($_GET['page']) ) {


                                            echo '<input type="hidden" name="page" value="'. $_GET['page'] .'">';
                                        }

                                    ?>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-btn fa-sign-in"></i> Iniciar sesión
                                    </button>
                                </footer>
                            </form>
                        
                    </div>
                </div>
            @endif
            @if ( !Request::is('register*') )
                @php
                    if (old('open_register')){
                        $open_register = old('open_register');
                    } 

                    $show_register = '';
                    $expanded_register = 'false';
                @endphp
                @if (isset($open_register) ) 
                    @php
                        $show_register = 'open';
                        $expanded_register = 'true';
                    @endphp
                @endif
                <div class="dropdown register {{ $show_register }}">
                    <a class="btn btn-primary" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="{{ $expanded_register }}">Registrarse</a>
                    <div class="dropdown-menu dropdown-menu-right register row">
                        <form id="smart-form-register" class="smart-form client-form " role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}
                            <header>
                                El registro es gratuito!*
                            </header>
                            {{ Form::hidden('open_register', '1') }}
        
                            <fieldset>
                                <section class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="input control-label"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="name" placeholder="Nombre de usuario" value="{{ old('name') }}">
                                        <b class="tooltip tooltip-bottom-right">Necesario para ingresar a InterActin</b> 
                                    </label>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </section>

                                <section class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="input control-label"> <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" placeholder="email@institucion.edu.co" value="{{ old('email') }}">
                                        <b class="tooltip tooltip-bottom-right">Necesario para verificar su cuenta</b> 
                                    </label>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </section>

                                <section class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="input control-label"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password" placeholder="Password" id="password">
                                        <b class="tooltip tooltip-bottom-right">No olvide su password</b> 
                                    </label>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </section>

                                <section class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label class="input control-label"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme el password">
                                        <b class="tooltip tooltip-bottom-right">No olvide su password</b> 
                                    </label>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </section>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="input control-label">
                                            <input type="text" name="firstname" placeholder="Nombres">
                                            <b class="tooltip tooltip-bottom-right">Sus nombres reales</b>
                                        </label>

                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </section>
                                    <section class="col col-6">
                                        <label class="input control-label">
                                            <input type="text" name="lastname" placeholder="Apellidos">
                                            <b class="tooltip tooltip-bottom-right">Sus apellidos reales</b>
                                        </label>

                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </section>
                                    <section class="col col-6">
                                        <label class="select control-label">
                                            <select name="genero">
                                                <option value="0" selected="" disabled="">Genero</option>
                                                <option value="1">Hombre</option>
                                                <option value="2">Mujer</option>
                                                <option value="3">Prefer not to answer</option>
                                            </select> <i></i> 
                                            <b class="tooltip tooltip-bottom-right">Escoja su genero</b>
                                        </label>

                                        @if ($errors->has('genero'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('genero') }}</strong>
                                            </span>
                                        @endif
                                    </section>
                                    <section class="col col-6">
                                        <label class="input control-label">
                                            <input type="text" name="cargo" placeholder="Cargo">
                                            <b class="tooltip tooltip-bottom-right">Que cargo tiene en la institucion?</b>
                                        </label>

                                        @if ($errors->has('cargo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cargo') }}</strong>
                                            </span>
                                        @endif
                                    </section>
                                    <section class="col col-6">
                                        <label class="input control-label">
                                            <input type="text" name="telefono" placeholder="Telefono y extensión">
                                            <b class="tooltip tooltip-bottom-right">El telefono a donde contactarlo</b>
                                        </label>

                                        @if ($errors->has('telefono'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </section>
                                </div>

                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="subscription" id="subscription">
                                        <i></i>Quiero recibir noticias y ofertas especiales </label>
                                    <label class="checkbox control-label">
                                        <input type="checkbox" name="terms" id="terms">
                                        <i></i>Estoy de acuerdo con los <a href="#" data-toggle="modal" data-target="#myModal"> Terminos y Condiciones </a></label>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                            </footer>

                            <div class="message">
                                <i class="fa fa-check"></i>
                                <p>
                                    Gracias por registrarse!
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        @else
        <!-- cuando si esta logueado -->

            <div class="dropdown home">
                <a class="btn btn-primary" href="{{ url('/home') }}" >Ir al Home</a>
            </div>

            <div class="dropdown logout">
                <a class="btn btn-danger" href="{{ url('/logout') }}" >Cerrar sesión</a>
            </div>
        @endif
        
    </ul>

</header>



<!-- <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> -->
<!-- <script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'js/particlesjs-config.json', function() {
        console.log('callback - particles.js config loaded');
    });
</script> -->

<div id="main" role="main">

    <div id="particles-js"></div>
	<!-- MAIN CONTENT -->
	<div id="content" class="container">

        <div class="row">

            <!--  --------------------------------------------------- -->


			@yield('content')

			
            <!--  --------------------------------------------------- -->

        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 hidden-xs hidden-sm">
                <h1 class="txt-color-red login-header-big">&nbsp;</h1>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">Nuevas oportunidades para globalización</h5>
                        <p>
                            Después de haber creado 12 alianzas nuevas en paises Europeos se ha incrementado la movilidad un 25%.
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="about-heading">Animate a conocer el mundo</h5>
                        <p>
                            Tenemos 45 propuestas para que complementes tus estudios en el exterior
                        </p>
                    </div>
                </div>

            </div>

            
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pull-right">
                
                <h5 class="text-center"> - Siguenos en -</h5>
                                                    
                <ul class="list-inline text-center">
                    <li>
                        <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
                
            </div>

            <!-- ==========================CONTENT ENDS HERE ========================== -->


		</div>
		<!-- END row PANEL -->
	</div>
	<!-- END content PANEL -->
</div>
<div id="container-loading"><i class="iconfont icon-loading_a"></i></div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->


<!-- include required scripts -->
@include('inc.scripts')


<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

</script>


<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
{{ Html::script('js/plugin/jquery-validate/jquery.validate.min.js') }} 
<!-- otro: http://vincentgarreau.com/particles.js/ -->
{{-- Html::script('js/particle-network.min.js') --}} 
{{-- Html::script('js/particles.js') --}} 
{{ Html::script('js/particles.min.js') }} 
{{ Html::script('js/particlesjs-config.json') }} 

<script type="text/javascript">
    $(document).ready(function() {

        $('.carousel').carousel();

        $('[type="submit"]').click(function(){
            $('#container-loading').addClass("show");
        });

        $(function() {
            // Validation
            $("#login-form").validate({
                // Rules for form validation
                rules : {
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    }
                },

                // Messages for form validation
                messages : {
                    email : {
                        required : 'Por favor, ingrese su email',
                        email : 'Por favor, ingrese una cuenta valida'
                    },
                    password : {
                        required : 'Por favor ingrese su password'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                    $('#container-loading').removeClass("show");
                }
            });
        });


        // Model i agree button
        $("#i-agree").click(function(){
            $this=$("#terms");
            if($this.checked) {
                $('#myModal').modal('toggle');
            } else {
                $this.prop('checked', true);
                $('#myModal').modal('toggle');
            }
        });
        
        // Validation
        $(function() {
            // Validation
            $("#smart-form-register").validate({

                // Rules for form validation
                rules : {
                    name : {
                        required : true
                    },
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    },
                    passwordConfirm : {
                        required : true,
                        minlength : 3,
                        maxlength : 20,
                        equalTo : '#password_confirmation'
                    },
                    firstname : {
                        required : true,
                        maxlength : 100
                    },
                    lastname : {
                        required : true,
                        maxlength : 100
                    },
                    genero : {
                        required : true
                    },
                    cargo : {
                        required : true
                    },
                    telefono : {
                        required : true
                    },
                    terms : {
                        required : true
                    }
                },

                // Messages for form validation
                messages : {
                    name : {
                        required : 'Please enter your name'
                    },
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    password : {
                        required : 'Please enter your password'
                    },
                    passwordConfirm : {
                        required : 'Please enter your password one more time',
                        equalTo : 'Please enter the same password as above'
                    },
                    firstname : {
                        required : 'Please select your first name'
                    },
                    lastname : {
                        required : 'Please select your last name'
                    },
                    genero : {
                        required : 'Please select your gender'
                    },
                    cargo : {
                        required : 'Please select your cargo'
                    },
                    telefono : {
                        required : 'Please select your phone'
                    },
                    terms : {
                        required : 'You must agree with Terms and Conditions'
                    }
                },

                // Ajax form submition
                submitHandler : function(form) {
                    $(form).submit();
                    // $(form).ajaxSubmit({
                    //  success : function() {
                    //      $("#smart-form-register").addClass('submited');
                    //  }
                    // });
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                    $('#container-loading').removeClass("show");
                }
            });

        });
    });
</script>

@yield('scripts')



<?php

//include footer
include(base_path()."/resources/views/inc/google-analytics.php"); 
?>
