
    {!! Form::open(['route' => ['admin.countries.index'], 'method' => 'get']) !!}
    
        <div class="fieldbox textbox" id="filtro">
        	<label>País</label>
            {!! Form::text('country', old('country'), ['class' => 'form-control text-uppercase']) !!}
        </div>
    
        <!-- Submit Field -->
        <div class="button" id="button_filtro">
            {!! Form::submit('Filtrar', ['class' => 'btn btn-primary']) !!}
        </div>

        
        
    {!! Form::close() !!}

