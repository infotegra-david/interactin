@extends('mockup::layout')

@section('main')
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <i class="fa-fw fa fa-arrow-up"></i>
                InterChange
            </li>
            <li>
                <a href="{{ url('mockup/changemap') }}">InterMap</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-arrow-up"></i> InterMap</h1>
            </div>
        </div>

        <section id="widget-grid" class="">
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false"
                         data-widget-deletebutton="false">
                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body">
                                <div class="row">
                                    <h1 class="text-center"><strong>Interchange - Mobility Map</strong></h1>
                                    <br/>
                                    <img src="{{ asset('assets/img/map1.png') }}" alt="InterChange Mobility Map" class="img-responsive" style="width: 95%"/>
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->
            </div>
        </section>
    </div>
@endsection
