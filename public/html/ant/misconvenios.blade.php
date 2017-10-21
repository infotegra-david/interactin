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
                <a href="{{ url('mockup/misconvenios') }}">Mis Convenios</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-arrow-up"></i> Mis Convenios</h1>
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
                                <h1 class="text-center">Mi Historial de Convenios</h1>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Institución</th>
                                            <th>Progreso</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="text-center">
                                            <td>10021</td>
                                            <td>
                                                <a>Universidad de Florida</a>
                                                <br/>
                                                <small>Creado: 01.02.2017</small>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-color-blue" data-transitiongoal="30" style="width: 30%;" aria-valuenow="75"></div>
                                                </div>
                                                <small>30% Completado</small>
                                            </td>
                                            <td>
                                                <span class="label label-success lg">Pendiente</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i>
                                                    Ver </a>
                                                <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                    Editar </a>
                                                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                    Eliminar </a>
                                                <a href="#" class="btn btn-warning btn-xs"><i
                                                            class="fa fa-file-pdf-o"></i> Exportar </a>
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>10022</td>
                                            <td>
                                                <a>Universidad de Francia</a>
                                                <br/>
                                                <small>Creado: 01.21.2017</small>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-color-blue" data-transitiongoal="40" style="width: 40%;" aria-valuenow="40"></div>
                                                </div>
                                                <small>40% Completado</small>
                                            </td>
                                            <td>
                                                <span class="label label-success lg">Pendiente</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i>
                                                    Ver </a>
                                                <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                    Editar </a>
                                                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                    Eliminar </a>
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