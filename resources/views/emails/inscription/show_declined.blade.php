@extends( 'emails.layouts.ver' )

<?php
    $content = json_decode($dataEmail[0]->content);
?>

@section('msj_header')
    <tr>
        <td class="content-cell">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    {{ $content['header'] }}
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="content-cell">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    Observaciones:
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="content-cell">
            <div class="col-sm-12">
                <div class="col-sm-12">
                    {{ $dataEmail[0]->paso_observacion }}
                </div>
            </div>
        </td>
    </tr>
@endsection



@section('mail_content')
    {{ $content['footer'] }}
@endsection

@section('email_footer')
    <br>
    E-mail del coordinador: {{ $emailCoordinador }}
@endsection