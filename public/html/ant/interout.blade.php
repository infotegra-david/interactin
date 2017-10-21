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
                <a href="{{ url('mockup/interout') }}">InterOut</a>
            </li>
        </ol>
        <!-- end breadcrumb -->
    </div>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-arrow-up"></i> InterOut</h1>
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
                                    <h1 class="text-center"><strong>Pre Registro del Estudiante</strong></h1>
                                    <br/>
                                    <form id="wizard-1" novalidate>
                                        <div id="bootstrap-wizard-1" class="col-sm-12">
                                            <div class="form-bootstrapWizard">
                                                <ul class="bootstrapWizard form-wizard">
                                                    <li class="active" data-target="#step1">
                                                        <a href="#tab1" data-toggle="tab"> <span class="step">1</span>
                                                            <span class="title">Datos Personales</span> </a>
                                                    </li>
                                                    <li data-target="#step2">
                                                        <a href="#tab2" data-toggle="tab"> <span class="step">2</span>
                                                            <span class="title">Información Académica</span> </a>
                                                    </li>
                                                    <li data-target="#step3">
                                                        <a href="#tab3" data-toggle="tab"> <span class="step">3</span>
                                                            <span class="title">Información de Movilidad</span> </a>
                                                    </li>
                                                    <li data-target="#step4">
                                                        <a href="#tab4" data-toggle="tab"> <span class="step">4</span>
                                                            <span class="title">Guardar Formulario</span> </a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <br>
                                                    <h3><strong>Paso 1 </strong> - Datos Personales</h3>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Nombre del Estudiante</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tu nombre completo"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Apellidos del Estudiante</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tus Apellidos"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Documento de Identidad</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-id-card fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tu Documento de Identidad"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Codigo Estudiantil</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-id-card-o fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tu Codigo Estudiantil"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Email Estudiantil</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-envelope fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tu email estudiantil"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Email Personal</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-envelope-o fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tus Apellidos"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <br>
                                                    <h3><strong>Paso 2</strong> - Información Académica</h3>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Facultad</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Facultad</option>
                                                                        <option>Facultad 1</option>
                                                                        <option>Facultad 2</option>
                                                                        <option>Facultad 3</option>
                                                                        <option>Facultad 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Programa</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building-o fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Programa</option>
                                                                        <option>Programa 1</option>
                                                                        <option>Programa 2</option>
                                                                        <option>Programa 3</option>
                                                                        <option>Programa 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Promedio</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-envelope fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Escribe tu promedio"
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Creditos Aprobados</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-envelope-o fa-fw"></i>
                                                                    </span>
                                                                    <input class="form-control"
                                                                           placeholder="Creditos aprobados."
                                                                           type="text"
                                                                           name="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab3">
                                                    <br>
                                                    <h3><strong>Paso 3</strong> - Información de Movilidad</h3>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Periodo</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building-o fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Periodo</option>
                                                                        <option>Periodo 1</option>
                                                                        <option>Periodo 2</option>
                                                                        <option>Periodo 3</option>
                                                                        <option>Periodo 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Modalidad</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Modalidad</option>
                                                                        <option>Modalidad 1</option>
                                                                        <option>Modalidad 2</option>
                                                                        <option>Modalidad 3</option>
                                                                        <option>Modalidad 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Pais</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Pais</option>
                                                                        <option>Pais 1</option>
                                                                        <option>Pais 2</option>
                                                                        <option>Pais 3</option>
                                                                        <option>Pais 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Universidad Destino</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-building-o fa-fw"></i>
                                                                    </span>
                                                                    <select id="Age1" name="Age" class="form-control">
                                                                        <option selected>Seleccionar Universidad
                                                                        </option>
                                                                        <option>Universidad 1</option>
                                                                        <option>Universidad 2</option>
                                                                        <option>Universidad 3</option>
                                                                        <option>Universidad 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab4">
                                                    <br>
                                                    <h3><strong>Step 4</strong> - Save Form</h3>
                                                    <br>
                                                    <h1 class="text-center text-success"><strong><i
                                                                    class="fa fa-check fa-lg"></i> Complete</strong>
                                                    </h1>
                                                    <h4 class="text-center">Click next to finish</h4>
                                                    <br>
                                                    <br>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <ul class="pager wizard no-margin">
                                                                <!--<li class="Anterior first disabled">
                                                                <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                                </li>-->
                                                                <li class="Anterior disabled">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg btn-default"> Anterior </a>
                                                                </li>
                                                                <!--<li class="next last">
                                                                <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                                </li>-->
                                                                <li class="next">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-lg txt-color-darken"> Next </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
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
    <script src="{{ asset('assets/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            pageSetUp();

            $('#bootstrap-wizard-1').bootstrapWizard({
                'tabClass': 'form-wizard',
                'onNext': function (tab, navigation, index) {
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                        'complete');
                    $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step')
                        .html('<i class="fa fa-check"></i>');

                }
            });


        });
    </script>
@endsection