
@include('admin.countries.filter')
<div class="clearfix"></div>

<div class="result">
    <h6>RESULTADOS</h6>

    @foreach($countries as $country)
        <div class="form-control resultbox">
            <div class="field icon-view full text-right">
                {!! Form::open(['route' => ['admin.countries.destroy', $country->id], 'method' => 'delete']) !!}
                    <a href="{!! route('admin.countries.show', [$country->id]) !!}" class="btn btn-default" title="Ver registro"><i class="fa fa-eye"></i></a>
                    <!--<a href="{ !! route('countries.edit', [$country->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>-->
                    <!--{ !! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                {!! Form::close() !!}
            </div>
            <div class="field" id="pais">
                <label>País</label>
                {!! $country->nombre !!}
            </div>
            <div class="field" id="codigo">
                <label>Código</label>
                {!! $country->codigo_ref !!}
            </div>         
        </div>
    @endforeach        
</div>
{!! $countries->render() !!}