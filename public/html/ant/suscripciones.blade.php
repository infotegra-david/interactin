@extends('mockup::layout')

@section('main')
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>
                <i class="fa-fw fa fa-arrow-up"></i>
                InterAlliance
            </li>
            <li>
                <a href="{{ url('mockup/suscripciones') }}">Suscripciones</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-arrow-up"></i> Suscripciones</h1>
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
                                <h1 class="text-center">Convenios Suscritos</h1>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Fecha de Inicio</th>
                                            <th>Institución</th>
                                            <th>Pais</th>
                                            <th>Tipo de Convenio</th>
                                            <th>Modalidad del Convenio</th>
                                            <th>Facultades y Departamentos</th>
                                            <th>Programa</th>
                                            <th>Estado</th>
                                            <th>Documento</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10/01/2016</td>
                                            <td>
                                                <a>Universidad de Florida</a>
                                                <br/>
                                            </td>
                                            <td>
                                                <a>Colombia</a>
                                            </td>
                                            <td>
                                                <a>Marco</a>
                                            </td>
                                            <td>
                                                <a>Pasantias</a>
                                            </td>
                                            <td>
                                                <a>Facultad de Ingenieria</a>
                                            </td>
                                            <td>
                                                <a>Ingenieria de Sistemas</a>
                                            </td>
                                            <td>
                                                <span class="label label-success lg">Pendiente</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-xs"><i
                                                            class="fa fa-file-pdf-o"></i> Exportar </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10/01/2016</td>
                                            <td>
                                                <a>Universidad de Florida</a>
                                                <br/>
                                            </td>
                                            <td>
                                                <a>Colombia</a>
                                            </td>
                                            <td>
                                                <a>Marco</a>
                                            </td>
                                            <td>
                                                <a>Pasantias</a>
                                            </td>
                                            <td>
                                                <a>Facultad de Ingenieria</a>
                                            </td>
                                            <td>
                                                <a>Ingenieria de Sistemas</a>
                                            </td>
                                            <td>
                                                <span class="label label-success lg">Pendiente</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-xs"><i
                                                            class="fa fa-file-pdf-o"></i> Exportar </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            pageSetUp();
        });
    </script>
@endsection