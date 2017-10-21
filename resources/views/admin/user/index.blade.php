@extends('layouts.app')

@section('head_vars')

    <?php
    /*---------------- PHP Custom Scripts ---------

    YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
    E.G. $page_title = "Custom Title" */

    $pagetitle = "Lista de usuarios";

    /* ---------------- END PHP Custom Scripts ------------- */

    //include header
    //you can add your custom css in $page_css array.
    $your_style = 'your_style.css';
    //$your_style = 'bootstrap-select.min.css';
    

    //include left panel (navigation)
    //follow the tree in inc/config.ui.php

    $page_nav = 1;
    $menu="InterAdmin";
    $submenu1="Users";
    //$submenu2='';
    ?>

@endsection

@section('content')
    <div class="clearfix"></div>

        @include('flash::message')

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->total() }} {{ str_plural('User', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @if ($ruta == 'admin')
                @can('add_users')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Create</a>
                @endcan
            @endif
        </div>
    </div>



    <div class="result-set">
        <table class="table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                @if ($ruta == 'admin')
                    <th>Created At</th>
                    @can('edit_users', 'delete_users')
                    <th class="text-center">Actions</th>
                    @endcan
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ implode(', ', array_column($item->listRoles, 'name') ) }}</td>
                    @if ($ruta == 'admin')
                        <td>{{ $item->created_at->toFormattedDateString() }}</td>

                        @can('edit_users')
                        <td class="text-center">
                            @include('shared._actions', [
                                'entity' => 'admin.users',
                                'id' => $item->id
                            ])
                        </td>
                        @endcan
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        
        <div class="text-center">
            {!! $result->render() !!}
        </div>
    </div>

@endsection