
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
 
            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
<div class="ver_mail cuerpo">
    <div align="center">
        <table class="center_table">
            <!-- Email header -->
            <tr>
                <td class="header">
                    {{  Config::get('app.name') }}
                </td>
            </tr>
        </table>
        
        @yield('msj_header')
        
        @yield('data')

    </div>
{{ Form::hidden('enviar', true) }}
</div>