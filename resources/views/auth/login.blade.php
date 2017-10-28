@extends('layouts.index_base')



@section('styles')

    <style type="text/css">
        
        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        html, body {
            /*background-color: #fff;*/
            /*color: #636b6f;*/
            height: 100vh;
            margin: 0;
        }

        #extr-page #main {
            z-index: 555;
        }

        #extr-page #header {
            border-bottom: none !important;
            background-color: #fbfbfb !important;
        }

        #extr-page .hero {
            background: none;
        }


    </style>

@endsection

@section('content')

    <?php

    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Inicio de sesión";
    $smart_style = "0";

    ?>


    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
        <div class="well no-padding">

            <form id="login-form" class="smart-form client-form " role="form" method="POST" action="{{ url( (isset($route) ? $route : '/login') ) }}">
                {!! csrf_field() !!}
                <header>
                    Ingreso
                </header>
                <fieldset>
                    @if (!$errors->has('password') && !$errors->has('password'))
                        @include('flash::message')
                        @include('adminlte-templates::common.errors')
                    @endif
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

@endsection



@section('scripts')

    <!-- PAGE RELATED PLUGIN(S) 
    <script src="..."></script>-->
    {{ Html::script('js/plugin/jquery-validate/jquery.validate.min.js') }} 

    <script type="text/javascript">
        

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
                }
            });
        });
    </script>

@endsection
