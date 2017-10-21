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
                <a href="{{ url('mockup/interin') }}">InterIn</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-arrow-up"></i> InterIn</h1>
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
                                <h1 class="text-center">Solicitudes de Estudiantes</h1>
                                <br/>
                                <div class="table-responsive">

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Fecha de Pre-Registro</th>
                                            <th>Periodo</th>
                                            <th>Modalidad</th>
                                            <th>Nombres</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>10/01/2016</td>
                                            <td>Primer Semestre 2017</td>
                                            <td>Pasantias</td>
                                            <td>Giovanni Vecchio</td>
                                            <td>
                                                <span class="label label-warning">En Trámite</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-xs btn-warning">Ver</a>
                                                    <a href="#" class="btn btn-xs btn-info">Editar</a>
                                                    <a href="#" class="btn btn-xs btn-danger">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>02/02/2017</td>
                                            <td>Segundo Semestre 2017</td>
                                            <td>Pasantias</td>
                                            <td>Svetlana Lébedev</td>
                                            <td>
                                                <span class="label label-warning">En Trámite</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-xs btn-warning">Ver</a>
                                                    <a href="#" class="btn btn-xs btn-info">Editar</a>
                                                    <a href="#" class="btn btn-xs btn-danger">Eliminar</a>
                                                </div>
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