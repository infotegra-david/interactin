

@if($metodo == 'edit')
{!! Form::model($user, ['method' => 'PUT', 'route' => [$route,  $user->id ], 'id' => 'Form_edit_user', 'class' => 'Form_user']) !!}
@else
{!! Form::open(['route' => [$route], 'id' => 'Form_create_user', 'class' => 'Form_user Form_submit_ajax', 'results' => 'Form_user_results' ]) !!}
@endif
    <!-- Name Form Input -->
    <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
    </div>

    <!-- email Form Input -->
    <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('email')) has-error @endif">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    </div>

    <!-- password Form Input -->
    <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('password')) has-error @endif">
        {!! Form::label('password', 'Password') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    </div>

    <!-- Activo Field -->
    <div class="form-group col-xs-12 col-sm-6 ">
        <div class="input-group">
            {!! Form::label('activo', 'Activo:') !!}
            <div class="form-control">
                <label class="checkbox-inline full">
                    {!! Form::checkbox('activo', 1, null) !!} Si
                </label>
            </div>
        </div>
    </div>
    <!-- institucion Form Input -->
    <!-- <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('institucion')) has-error @endif">
        {!! Form::label('institucion', 'institución') !!}
        {{ Form::select('institucion', $institucion, old('institucion'), ['class' => 'form-control', 'target' => 'campus', 'url' => route('admin.campus.listcampus'), 'placeholder' => 'Seleccione la institución']) }}
        @if ($errors->has('institucion')) <p class="help-block">{{ $errors->first('institucion') }}</p> @endif
    </div> -->
    <!-- campus Form Input -->
    <!-- <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('campus')) has-error @endif">
        {!! Form::label('campus', 'campus') !!}
        {{ Form::select('campus1', $campus, old('campus'), ['class' => 'form-control', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el campus']) }}
        @if ($errors->has('campus')) <p class="help-block">{{ $errors->first('campus') }}</p> @endif
    </div> -->

    <!-- Roles Form Input -->
    <div class="form-group col-xs-12 col-sm-6 @if ($errors->has('roles')) has-error @endif">
        {!! Form::label('roles[]', 'Roles') !!}
        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}
        @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
    </div>

    <div class="form-group col-xs-12">
        <!-- Permissions -->
        @if(isset($user))
            @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
        @endif
    </div>

    {{ Form::hidden('data_extra', '#jqGrid1', ['data_extra_type' => 'jqGrid', 'data_extra_name' => 'campus_asignados']) }}

    <div title="Datos incompletos" id="dialogError" class="dialogue hide">El usuario debe pertenecer al menos a 1 campus</div>

{!! Form::close() !!}


<div class="form form-group col-xs-12" id="jqgrid_form">
    <div class="panel table_jqGrid div-error @if ($errors->has('campus_asignados')) has-error @endif">
        <table id="jqGrid1"></table>
        <div id="jqGrid1Pager"></div>
        @if ($errors->has('campus_asignados')) <p class="help-block">{{ $errors->first('campus_asignados') }}</p> @endif
    </div>
</div>

<div class="form-group col-xs-12">
    <!-- Submit Form Button -->        
    {!! Form::button('Guardar cambios', ['class' => 'btn btn-primary', 'id' => 'Form_user_button']) !!}
</div>

<?php
    
    $institucion = json_encode($institucion);
    $institucion = '{"0":"Seleccione una institución",'. substr($institucion, 1);
    
?>


{{ Html::script('js/plugin/jqgrid/jquery.jqGrid.js') }}
{{ Html::script('js/plugin/jqgrid/locale/grid.locale-es.js') }}


    <script type="text/javascript"> 
    
        $(document).ready(function () {

                // $('form.Form_user').on('submit',function(e){
                //     @if($metodo == 'createssss')
                //         var formData = $(this).serializeArray();
                //         var getGridData = $('#jqGrid1').getGridParam('data');
                //         formData = formData.concat([
                //             {name: "campus_asignados", value: JSON.stringify(getGridData) }
                //         ]);
                        
                //         console.log(formData);
                //         console.log(getGridData);
                //         console.log(jQuery.type( getGridData ) );
                //         console.log(getGridData.length);

                //         if (getGridData.length == 0) {
                //             var $dialogError = $('<div title="Datos incompletos" id="dialogError" class="dialogue">El usuario debe pertenecer al menos a 1 campus</div>');
                //             $dialogError.dialog({
                //                 autoOpen: true,
                //                 modal: true,
                //                 dialogClass: "alert text-danger",
                //                 buttons: {
                //                     Ok: function() {
                //                       $( this ).dialog( "close" );
                //                     }
                //                 }
                //             });
                //         }




                //     @endif
                //     // e.preventDefault(); 
                //     // setTimeout(function(){ $(document).trigger('ajaxStop'); }, 100);
                    
                // });

                $('#Form_user_button').on('click',function(e){
                    $('form.Form_user').submit();
                });




            $("#jqGrid1").jqGrid({
                @if($metodo == 'edit')
                    url: '{{ route('admin.users.listUserCampus',$user->id) }}',
                    mtype: "POST",
                @endif
                editurl : "{{ ($metodo == 'edit') ? route('admin.users.editCampus',$user->id) : route('admin.users.editCampus',0)    }}",
                caption : "Campus asignados",
                autowidth : true,
                datatype: "{{ ($metodo == 'edit') ? 'json' : 'local' }}",
                page: 1,
                loadComplete: function () {
                    cambiarEstilosJqgrid();
                },
                colModel: [
                    // {
                    //     label: "Acciones",
                    //     name: "actions",
                    //     width: 100,
                    //     formatter: "actions",
                    //     formatoptions: {
                    //         keys: true,
                    //         editbutton : false, 
                    //         delOptions: {}
                    //     }       
                    // },
                    { label: 'ID', name: 'id', index:'id', key: true, width: 75, hidden:true, editable: true, editrules: { edithidden: false } },
                    { label: 'Metodo', name: 'metodo', index:'metodo', hidden:true, editable: true, editrules: { edithidden: false }, editoptions: { defaultValue: '{{ $metodo }}'} },                   
                    { label: 'Campus Id', name: 'campus_id', index:'campus_id', hidden:true, editable: true, editrules: { edithidden: false }, editoptions: { defaultValue: '0'} },
                    {
                        label: 'Institución',
                        name: 'institucion',
                        editable: true,
                        edittype:'select',
                        editoptions: {
                            value: {!! $institucion !!},
                            dataInit: function (elem) {
                                $(elem).attr('target','campus');
                                $(elem).attr('url','{{ route('admin.campus.listcampus') }}');
                            }
                        },
                        editrules: {
                            required: true,
                            custom:true,
                            custom_func:validate_rules
                        }
                    },                   
                    {
                        label: 'Campus',
                        name: 'campus',
                        editable: true,
                        edittype:"select",
                        editoptions: {
                            value: {0:'Seleccione una institución'},
                        },
                        editrules: {
                            required: true
                        }
                    },
                ],
                loadonce : true,
                // onSelectRow: editRow, // the javascript function to call on row click. will ues to to put the row in edit mode
                viewrecords: true,

                height: 250,
                rowNum: 20,
                pager: "#jqGrid1Pager",


            });

            function validate_rules(value, colname, length){
                var rowid = $('#jqGrid1').jqGrid('getGridParam', 'selrow');
                
                // console.log('Esto llego |' + value + '| - |' + colname + '| - |' + length + '| - |' + rowid);
                if (value == 0 || value == '') {
                    return [false,'El campo Institución es requerido'];
                }else{
                    return [true,''];
                }

            }

            $("#jqGrid1").jqGrid('navGrid','#jqGrid1Pager' 
                ,{
                    edit: false, add: false, 
                    del: true, 
                    search: true, reload: true, refresh: true
                },
                {}, // default settings for edit
                {}, // default settings for add
                { // define settings for Delete 
                    mtype: "post", 
                    reloadAfterSubmit: true,
                    resize: false,
                    afterSubmit: function (jqXHR) {
                        return $.parseJSON(jqXHR.responseText); // return decoded response
                    }
                }
            );

            $('#jqGrid1').inlineNav('#jqGrid1Pager',
                // the buttons to appear on the toolbar of the grid
                { 
                    edit: true, 
                    add: true, 
                    del: true, 
                    cancel: true,
                    cloneToTop: false,
                    editParams: {
                        keys: true,
                        aftersavefunc: function(rowid, response) {
                            var dataResponse = '';
                            if( response.responseText != undefined ){ 
                                dataResponse = $.parseJSON(response.responseText);
                            }else{
                                dataResponse = jQuery('#jqGrid1').jqGrid ('getRowData', rowid);
                                console.log(dataResponse);
                            }

                            // jQuery("#jqGrid1").jqGrid("getGridParam", rowid, "id", newId);
                            jQuery("#jqGrid1").jqGrid('setCell', rowid, 'campus_id', dataResponse.campus);

                            // now change the internal local data
                            jQuery("#jqGrid1").jqGrid('getLocalRow', rowid).campus_id = dataResponse.campus;

                            // var grid = $("#jqGrid1");
                            // reloadgrid(grid);
                            // alert("aftersave fired for edit1");
                        }//aftersavefunc
                    },
                    addParams: {
                        keys: true,
                        addRowParams: {
                            useFormatter:true,
                            keys: true,
                            
                            aftersavefunc: function(rowid, response) {
                                var dataResponse = '';
                                if( response.responseText != undefined ){ 
                                    dataResponse = $.parseJSON(response.responseText);
                                }else{
                                    dataResponse = jQuery('#jqGrid1').jqGrid ('getRowData', rowid);
                                    console.log(dataResponse);
                                }
                                
                                // $self = $(this),
                                // console.log(rowid);
                                // console.log(response);

                                // jQuery("#jqGrid1").jqGrid("getGridParam", rowid, "id", newId);
                                jQuery("#jqGrid1").jqGrid('setCell', rowid, 'id', dataResponse.id);

                                // now change the internal local data
                                jQuery("#jqGrid1").jqGrid('getLocalRow', rowid).id = dataResponse.id;

                                // jQuery("#jqGrid1").jqGrid("getGridParam", rowid, "id", newId);
                                jQuery("#jqGrid1").jqGrid('setCell', rowid, 'campus_id', dataResponse.campus);

                                // now change the internal local data
                                jQuery("#jqGrid1").jqGrid('getLocalRow', rowid).campus_id = dataResponse.campus;

                                // reloadgrid(grid);
                                // alert("aftersave fired for add2");
                            }
                            
                        }
                    }
                }
            );

            // jQuery("#jqGrid1").delGridRow(rowid, {
            //     url: $("#jqGrid1").getGridParam("editurl"),
            //     caption: 'Delete User?',
            //     msg: 'Delete selected User? <br />Careful, this is irreversable!',
            //     resize: false,
            //     afterSubmit: function (jqXHR) {
            //         return $.parseJSON(jqXHR.responseText); // return decoded response
            //     }
            // });

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
        });


    </script>



<!-- 
<script type="text/javascript">
    $(document).ready(function() {

        var jqgrid_data = [
            @ foreach($listUserCampus AS $campus)
                {
                    id : "{ { $campus['user_campus_id'] }}",
                    ucampus_id : "{ { $campus['user_campus_id'] }}",
                    user : "{ { $user->id }}",
                    institucion_id : "{ { $campus['institucion_id'] }}",
                    institucion : "{ { $campus['institucion_nombre'] }}",
                    campus_id : "{ { $campus['campus_id'] }}",
                    campus : "{ { $campus['campus_nombre'] }}"
                },
            @ endforeach
            ];

        jQuery("#jqgrid").jqGrid({
            data : jqgrid_data,
            datatype : "local",
            height : 'auto',
            colNames : ['Acciones', 'Id', 'ucampus_id', 'Usuario', 'Institución', 'Campus'],
            colModel : [
                { name : 'act', index:'act', sortable:false }, 
                { name : 'id', index:'id', hidden:true }, 
                { name : 'ucampus_id', index:'ucampus_id', hidden:true, editable: true, editrules: { edithidden: false } }, 
                { name : 'user', index:'user', hidden:true, editable: true, editrules: { edithidden: false } }, 
                { name : 'institucion', index : 'institucion', editable : true, edittype: 'select',
                    editoptions: { 
                        value: {!! $institucion !!},
                        dataInit: function (elem) {
                            $(elem).attr('target','campus');
                            $(elem).attr('url','{{ route('admin.campus.listcampus') }}');
                        }
                    }
                }, 
                { name : 'campus', index : 'campus', editable : true, edittype: 'select',
                    editoptions: { 
                        value: {0:'Seleccione una institución'},
                    }
                }],
            rowNum : 10,
            rowList : [10, 20, 30],
            pager : '#pjqgrid',
            sortname : 'id',
            toolbarfilter: true,
            viewrecords : true,
            sortorder : "asc",
            gridComplete: function(){
                var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
                for(var i=0;i < ids.length;i++){
                    var cl = ids[i];
                    be = "<button class='btn btn-xs btn-default' data-original-title='Edit Row' onclick=\"jQuery('#jqgrid').editRow('"+cl+"');\"><i class='fa fa-pencil'></i></button>"; 
                    se = "<button class='btn btn-xs btn-default' data-original-title='Save Row' onclick=\"jQuery('#jqgrid').saveRow('"+cl+"');\"><i class='fa fa-save'></i></button>";
                    ca = "<button class='btn btn-xs btn-default' data-original-title='Cancel' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";  
                    //ce = "<button class='btn btn-xs btn-default' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>"; 
                    //jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ce});
                    jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ca});


                    jQuery("#jqgrid").jqGrid('saveRow',ids[i], 
                    { 
                        successfunc: function( response ) {
                            alert('he');
                            var newValue = 3;
                            // first change the cell in the visible part of grid
                            jQuery("#jqgrid").jqGrid('setCell', rowid, 'id', newValue);

                            // now change the internal local data
                            jQuery("#jqgrid").jqGrid('getLocalRow', rowid).id = newValue;

                            return true; 
                        }
                    });

                }   
            },
            editurl : "{ { route('admin.users.editCampus',$user->id) }}",
            caption : "Campus asignados",
            multiselect : true,
            autowidth : true,

            formatoptions:{
                keys:true,
                delbutton:false,
                onSuccess:function (rowID, response) {
                  alert(response);             
                  $("#" + rowID).attr("id", response.responseText);
                },

                onEdit: function (rowID) {
                 if (typeof (lastSelectedRow) !== 'undefined' && rowID !== lastSelectedRow)
                   cancelEditing($('#jqgrid'));
                   lastSelectedRow = rowID;
                }
            },

            });

//--------------------------
//--------------------------
            var someRetValue;
            jQuery("#jqgrid").jqGrid('saveRow', 'rowid',
            {
                url: 'clientArray',
                aftersavefunc: function (id, response, options) {
                    someRetValue = response; // set someRetValue to any value
                    console.log(someRetValue);
                }
            });
            rowid = 47;
            jQuery("#jqgrid").jqGrid('saveRow',rowid, 
            { 
                successfunc: function( response ) {
                    alert('he');
                    var newValue = 3;
                    // first change the cell in the visible part of grid
                    jQuery("#jqgrid").jqGrid('setCell', rowid, 'id', newValue);

                    // now change the internal local data
                    jQuery("#jqgrid").jqGrid('getLocalRow', rowid).id = newValue;

                    return true; 
                }
            });
//--------------------------
//--------------------------

            jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
                edit : false,
                add : false,
                del : true
            });
            jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid");
            /* Add tooltips */
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
            $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
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
      
    })

    $(window).on('resize.jqGrid', function () {
        $("#jqgrid").jqGrid( 'setGridWidth', $(".table_jqGrid").width() );
    })

    // $('.table_jqGrid div, .table_jqGrid div')



</script> -->
