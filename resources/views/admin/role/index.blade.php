@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Lista de roles y permisos";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    //$your_style = 'bootstrap-select.min.css,your_style.css';
    $your_style = 'your_style.css';

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $page_nav_route[ "InterAdmin" ]["sub"][ "Roles" ]["active"] = true;
    //$submenu2='';
    ?>

@endsection


@section('content')
    
    @include('flash::message')
    @include('adminlte-templates::common.errors')

    <!-- Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'post']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="roleModalLabel">Rol</h4>
                </div>
                <div class="modal-body">
                    <!-- name Form Input -->
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del rol']) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <!-- Submit Form Button -->
                    {!! Form::submit('Crear', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <h3>Roles</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_roles')
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="glyphicon glyphicon-plus"></i> Crear rol</a>
            @endcan
        </div>
    </div>

    @php $role_id = 0; @endphp
    @forelse ($roles as $role)
        @if($role['id'] != $role_id)
            {!! Form::model($role, ['method' => 'PUT', 'route' => ['admin.roles.update',  $role['id'] ], 'class' => 'm-b']) !!}
            
            @php 
                $role_id_user = $role['id'];
                $rolesUsuario = array_filter($roles, function($var) use ($role_id_user){
                    return ($var['id'] == $role_id_user);
                });
            @endphp

            @if($role['name'] === 'administrador')
                @include('shared._permissions', [
                              'title' => 'Permisos para el rol '. $role['name'],
                              'options' => ['disabled'] ])
            @else
                    <?php $submit = false; ?>
                @can('edit_roles')
                    <?php $submit = true; ?>
                @endcan
                @include('shared._permissions', [
                              'title' => 'Permisos para el rol '. $role['name'],
                              'submit' => $submit ])
            @endif
            <br>
            <br>
            {!! Form::close() !!}
            @php $role_id = $role['id']; @endphp
        @endif
    @empty
        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
    @endforelse
@endsection