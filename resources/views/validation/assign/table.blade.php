    <div class="form form-group col-xs-12" id="jqgrid_form">
        <div class="panel table_jqGrid div-error @if ($errors->has('assignments')) has-error @endif">
            <table id="jqGrid1"></table>
            <div id="jqGrid1Pager"></div>
        </div>
    </div>

<?php

    // $campus = $campus->toArray();
    $campus = json_encode($campus);
    $campus = '{"0":"Seleccione un campus",'. substr($campus, 1);
    $user = json_encode($user);

    // print_r(count($orden));
    $orden = json_encode($orden);
    // $orden = '{"0":"Seleccione el orden",'. substr($orden, 1);
    $tipo_paso = json_encode($tipo_paso);
    $route = $route_split.'.storeupdate';
    $routeView = $route_split.'.index';

    if(!isset($omitir_tipo_paso)){
        // $orden = '{"0":"Seleccione primero un paso del proceso"}';
    }else{
    }
?>


{{ Html::script('js/plugin/jqgrid/jquery.jqGrid.js') }}
{{ Html::script('js/plugin/jqgrid/locale/grid.locale-es.js') }}


    <script type="text/javascript"> 
    
        $(document).ready(function () {

            $('#Form_assignments_button').on('click',function(e){
                $('form.Form_assignments').submit();
            });

            // $.jgrid.defaults.styleUI = 'Bootstrap';

            // var jqgrid_data = [
            //     @ foreach($userPasos AS $userPaso)
            //     {
            //         "id" : "{ !! $userPaso->id !!}",
            //         "campus_id" : "{ !! $userPaso->campus_id !!}",
            //         "campus" : "{ !! $userPaso->campus !!}",
            //         "user_id" : "{ !! $userPaso->user_id !!}",
            //         "user" : "{ !! $userPaso->user !!}",
            //         "tipo_paso_idd" : "{ !! $userPaso->tipo_paso_id !!}",
            //         "tipo_paso" : "{ !! $userPaso->tipo_paso !!}",
            //         "orden" : "{ !! $userPaso->orden !!}",
            //         "titulo" : "{ !! $userPaso->titulo !!}",
            //         "accion" : "<a href='{ !! route($route_split.'.show', [$userPaso->id]) !!}' class='btn btn-default btn-xs'><i class='glyphicon glyphicon-eye-open'></i> Ver</a>"
            //     },
            //     @ endforeach
            // ];


            $("#jqGrid1").jqGrid({
                // data : jqgrid_data,
                url: '{{ route($routeData) }}',
                mtype: "GET",
                datatype: "json",
                editurl : "{{ route($route) }}",
                caption : "",
                autowidth : true,
                loadonce : true,
                // onSelectRow: editRow, // the javascript function to call on row click. will ues to to put the row in edit mode
                viewrecords: true,

                height: 250,
                rowNum: 20,
                rownumbers: false, // show row numbers
                // multiselect : true,
                rownumWidth: 35, // the width of the row numbers columns
                pager: "#jqGrid1Pager",
                // multiselect: true,
                page: 1,
                loadComplete: function () {
                    cambiarEstilosJqgrid();
                },

                //LO NOMBRES DE LAS COLUMNAS SON USADOS POR UNA FUNCION EXTERNA PARA REALIZAR VALIDACIONES
                colModel: [
                    { label: 'ID', name: 'id', index:'id', key: true, width: 75, hidden:true, editable: true, editrules: { edithidden: false } },
                    // { label: 'campus_id', name: 'campus_id', index:'campus_id', hidden:true, editable: false, editrules: { edithidden: true } },
                    {
                        label: 'Campus',
                        name: 'campus_id',
                        editable: true,
                        edittype:'select',
                        editoptions: {
                            value: {!! $campus !!},
                            dataInit: function (elem) {
                                $(elem).attr('target','user_id');
                                $(elem).attr('change_after','tipo_paso_id');
                                // $(elem).attr('url','{{ route('admin.campus.listcampus') }}');
                                $(elem).attr('url','{{ $routeLists }}?type=validador');
                            }
                        },
                        editrules: {
                            number: true,
                            minValue: 1,
                            required: true,
                            custom:true,
                            custom_func:validate_rules
                        }
                    },
                    // { label: 'user_id', name: 'user_id', index:'user_id', hidden:true, editable: false, editrules: { edithidden: true } },
                    {
                        label: 'Validador',
                        name: 'user_id',
                        editable: true,
                        edittype:"select",
                        editoptions: {
                            value: {!! $user !!},
                        },
                        editrules: {
                            // number: true,
                            // minValue: 1,
                            required: true,
                            custom:true,
                            custom_func:validate_rules
                        }
                    },
                    {
                        label: 'Paso del proceso',
                        name: 'tipo_paso_id',
                        editable: true,
                    @if(isset($omitir_tipo_paso))
                        hidden:true,
                    @endif
                        edittype:'select',
                        editoptions: {
                            value: {!! $tipo_paso !!},
                            dataInit: function (elem) {
                                 $(elem).attr('target','orden');
                                 $(elem).attr('url','{{ $routeLists }}?type=orden');
                                 $(elem).attr('val_extra','campus_id');
                            },
                            defaultValue: {{ $tipo_paso_default }}
                        },
                        editrules: {
                    @if(isset($omitir_tipo_paso))
                            edithidden: false,
                    @endif
                            number: true,
                            minValue: 1,
                            required: true
                        }
                    },
                    {
                        label: 'Orden',
                        name: 'orden',
                        editable: true,
                        edittype:"select",
                        editoptions: {
                            value: {!! $orden !!},
                        },
                        editrules: {
                            number: true,
                            minValue: 1,
                            required: true,
                            custom:true,
                            custom_func:validate_rules
                        }
                    },
                    {
                        label: 'Título',
                        name: 'titulo',
                        editable: true,
                        editrules: {
                            required: true
                        }
                    },
                    {
                        label: 'Acción',
                        name: 'accion',
                        editable: false,
                        formatter:linkFormat,
                        
                    },
                ],

            });

            function linkFormat( cellvalue, options, rowObject ){
                return '<span><a href="{{ route($routeView) }}/'+cellvalue+'" class="btn btn-sm btn-success fa fa-search-plus"> Ver Registro</a></span>';
            }

            function refresh_jqGrid(){
                $('#jqGrid1').jqGrid('setGridParam',{datatype:'json'}).trigger('reloadGrid');
            }
    

            $('#jqGrid1').jqGrid('navGrid','#jqGrid1Pager',
                // the buttons to appear on the toolbar of the grid
                { edit: true, add: true, del: true, search: true, refresh: true, view: false, position: "left", cloneToTop: false },
                // options for the Edit Dialog
                {
                    editCaption: "Editar asignación",
                    recreateForm: true,
                    closeAfterEdit: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response != undefined && response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        if(response.status == 200){ 
                              alert(response);
                        } else {
                              return [false,'error message'];
                        }
                        refresh_jqGrid();
                        
                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    },
                    afterShowForm: function (formid) {
                        $('#FrmGrid_jqGrid1 [name="campus_id"]').change();
                        // Here I want to center the form
                    }
                },
                // options for the Add Dialog
                {
                    addCaption: "Crear asignación",
                    recreateForm: true,
                    closeAfterAdd: true,
                    afterSubmit : function( data, postdata, oper) {
                        var response = data.responseJSON;
                        if (response.hasOwnProperty("error")) {
                            if(response.error.length) {
                                return [false,response.error ];
                            }
                        }
                        refresh_jqGrid();

                        return [true,"",""];
                    },
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    }
                },
                // options for the Delete Dailog
                {
                    errorTextFormat: function (data) {
                        if( data.responseJSON != undefined ){
                            row = '';
                            $.each(data.responseJSON, function( index, value ) {
                                row = row + value + "<br>";
                            });
                            return row
                        }else{
                            return 'Error: ' + data.responseText
                        }
                    }
                }
            ); 

            jQuery("#refresh_jqGrid1").click(function(){
                refresh_jqGrid();
            });



            function validate_rules(value, colname, length){
                var rowid = $('#jqGrid1').jqGrid('getGridParam', 'selrow');
                
                // console.log('Esto llego |' + value + '| - |' + colname + '| - |' + length + '| - |' + rowid);
                var colnamesssssssssssssss = '';
                switch(colnamesssssssssssssss) {
                    case 'Campus':
                        // jQuery("#jqGrid1").jqGrid("getGridParam", rowid, "campus_id", value);
                        $("#jqGrid1").jqGrid("setCell", rowid, "campus_id", value);

                        // now change the internal local data
                        $("#jqGrid1").jqGrid("getLocalRow", rowid).campus_id = value;

                        return [true,''];
                        break;
                    case 'Validador':

                        $("#jqGrid1").jqGrid('setCell', rowid, 'user_id', value);

                        // now change the internal local data
                        $("#jqGrid1").jqGrid('getLocalRow', rowid).user_id = value;
                        return [true,''];
                        break;
                    case 'Orden':
                        return [true,''];
                        break;
                    default:
                        return [true,''];
                }

            }


            function cambiarEstilosJqgrid(){
                // /* Add tooltips */
                $('.navtable .ui-pg-button').tooltip({
                    container : 'body'
                });

                // remove classes
                $(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
                $(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
                $(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
                $(".ui-jqgrid-pager").removeClass("ui-state-default");
                $(".ui-jqgrid").removeClass("ui-widget-content");
                
                // add classes
                $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
                $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");
               
               
                $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
                $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
                $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
                $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");
                $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
                $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
                $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
                $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");
                
                $( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
                $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");
                
                $( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
                $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");         

                $( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
                $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");
                
                $( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
                $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

                
                $(".ui-pager-table").addClass("full");
            }

            cambiarEstilosJqgrid();

            $(window).on('resize.jqGrid', function () {
                $("#jqGrid1").jqGrid( 'setGridWidth', $(".table_jqGrid").width() );
            })

            $(document).on('change','select[name="campus_id"]',function(){
                //los datos de la lista de pasos y el orden dependen de la combinacion entre el campus y el tipo de paso
                $('[name="tipo_paso_id"]').change();
            })
        });


    </script>