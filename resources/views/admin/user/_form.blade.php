<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>
<!-- institucion Form Input -->
<div class="form-group @if ($errors->has('institucion')) has-error @endif">
    {!! Form::label('institucion', 'institución') !!}
    {{ Form::select('institucion', $institucion->prepend('Seleccione la institución', ''), old('institucion'), ['class' => 'form-control', 'target' => 'campus', 'url' => route('admin.campus.listcampus'), 'placeholder' => 'Seleccione la institución']) }}
    @if ($errors->has('institucion')) <p class="help-block">{{ $errors->first('institucion') }}</p> @endif
</div>
<!-- campus Form Input -->
<div class="form-group @if ($errors->has('campus')) has-error @endif">
    {!! Form::label('campus', 'campus') !!}
    {{ Form::select('campus', $campus, old('campus'), ['class' => 'form-control', 'target' => '', 'url' => '', 'placeholder' => 'Seleccione el campus']) }}
    @if ($errors->has('campus')) <p class="help-block">{{ $errors->first('campus') }}</p> @endif
</div>

<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    {!! Form::label('roles[]', 'Roles') !!}
    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'multiple']) !!}
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>

<!-- Permissions -->
@if(isset($user))
    @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
@endif