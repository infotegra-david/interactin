
{!! Form::model($user, ['method' => 'PUT', 'route' => [$route,  $user->id ], 'id' => 'Form_edit_user' ]) !!}

    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Password Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <!-- Activo Field -->
    <div class="form-group col-sm-6">
        <div class="input-group full">
            {!! Form::label('activo', 'Activo:') !!}
            <div class="form-control">
                <label class="checkbox-inline full">
                    {!! Form::checkbox('activo', 1, null) !!} Si
                </label>
            </div>
        </div>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route($routeBack) !!}" class="btn btn-default">Cancel</a>
    </div>


    <!-- Submit Form Button -->
    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
