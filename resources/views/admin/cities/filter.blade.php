{!! Form::open(['route' => ['admin.cities.index'], 'method' => 'get']) !!}
   
    <div class="fieldbox textbox">
        <label>País</label>
        {!! Form::text('country', old('country'), ['class' => 'form-control text-uppercase']) !!}
    </div>
    <div class="fieldbox textbox">
        <label>Departamento</label>
        {!! Form::text('state', old('state'), ['class' => 'form-control text-uppercase']) !!}
    </div>
    <div class="fieldbox textbox">
        <label>Ciudad</label>
        {!! Form::text('city', old('city'), ['class' => 'form-control text-uppercase']) !!}
    </div>
    <!-- Submit Field -->
    <div class="button" id="filtro">
        {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
    </div>
    
{!! Form::close() !!}
