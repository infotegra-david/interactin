@include('admin.cities.filter')
<div class="clearfix"></div>

<div class="result">
    <h6>RESULTADOS</h6>

        @foreach($cities as $city)
            <div class="form-control resultbox">

                <div class="field icon-view full text-right">
                    {!! Form::open(['route' => ['admin.cities.destroy', $city->id], 'method' => 'delete']) !!}
                        <a href="{!! route('admin.cities.show', [$city->id]) !!}" class="btn btn-default" title="Ver registro"><i class="fa fa-eye"></i></a>
                        <!-- <a href="{ !! route('cities.edit', [$city->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> -->
                        <!-- { !! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                    {!! Form::close() !!}
                </div>

                <div class="field" id="pais">
                    <label>País</label>
                    {!! $city->state->country->nombre !!}
                </div>

                <div class="field" id="departamento">
                    <label>Departamento</label>
                    {!! $city->state->nombre !!}
                </div>

                <div class="field" id="ciudad">
                    <label>Ciudad</label>
                    {!! $city->nombre !!}
                </div>
                
                <div class="field" id="codigo">
                    <label>Código</label>
                    {!! $city->state->country->codigo_ref.$city->state->codigo_ref.$city->codigo_ref !!}
                </div>
                
            </div>
        @endforeach
    </div>
{!! $cities->render() !!}