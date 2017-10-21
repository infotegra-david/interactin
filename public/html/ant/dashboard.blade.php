@extends('mockup::layout')

@section('main')
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('mockup') }}">Dashboard</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <h1><span class="semi-bold">Universidad</span> <i class="ultra-light"> ------------ </i>
                        <br>
                    </h1>
                    <img src="{{ asset('assets/img/img-dashboard.jpg') }}" alt="Dashboard Img" class="img-responsive"/>
                </div>
            </div>
        </div>

        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="jarviswidget" id="wid-1">
                        <div>
                            <div class="widget-body">
                                <img src="{{ asset('assets/img/campus1.jpg') }}" alt="Campus" class="img-responsive"/>
                                <h2 class="text-center">Becas Nacionales</h2>
                                <p>Es el Programa de Becas para Estudios de Posgrado más importante de Colombia, con
                                    casi 40 años de existencia; es conocido y reconocido a nivel nacional e
                                    internacional.</p>
                                <button class="btn-info btn btn-block">Ver</button>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="jarviswidget" id="wid-2">
                        <div>
                            <div class="widget-body">
                                <img src="{{ asset('assets/img/campus2.jpg') }}" alt="Campus" class="img-responsive"/>
                                <h2 class="text-center">Becas Internacionales</h2>
                                <p>Es el Programa de Becas para Estudios de Posgrado más importante de Colombia, con
                                    casi 40 años de existencia; es conocido y reconocido a nivel nacional e
                                    internacional.</p>
                                <button class="btn-info btn btn-block">Ver</button>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="jarviswidget" id="wid-3">
                        <div>
                            <div class="widget-body">
                                <img src="{{ asset('assets/img/campus3.jpg') }}" alt="Campus" class="img-responsive"/>
                                <h2 class="text-center">Otras Becas</h2>
                                <p>Es el Programa de Becas para Estudios de Posgrado más importante de Colombia, con
                                    casi 40 años de existencia; es conocido y reconocido a nivel nacional e
                                    internacional.</p>
                                <button class="btn-info btn btn-block">Ver</button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        </section>
    </div>
@endsection