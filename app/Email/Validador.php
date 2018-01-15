<?php

namespace App\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Validador extends Mailable
{
    use Queueable, SerializesModels;
    
    public $dataEmail;
    public $archivosAdjuntos;
    public $tipo_link_boton;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataEmail,$archivosAdjuntos,$tipo_link_boton)
    {
        $this->dataEmail = $dataEmail;
        $this->archivosAdjuntos = $archivosAdjuntos;
        $this->tipo_link_boton = $tipo_link_boton;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cc = '';
        $bcc = '';
        $replyTo = '';
        $msj_header_text = '';

        //$toData = json_decode($this->dataEmail->to);
        $ccData = json_decode($this->dataEmail->cc);
        $bccData = json_decode($this->dataEmail->bcc);
        $replyToData = json_decode($this->dataEmail->replyto);

        $subject = $this->dataEmail->subject;
        //el from no funciona aun, solo envia DESDE el email configurado
        $from = \Config::get('mail.from.address');
        $fromName = \Config::get('mail.from.name');



        //return $this->view('view.name');
        //return $this->from('david.calderon@infotegra.com')

        
        $markdown = $this->markdown('emails.validator.send')
              ->from( $from,$fromName );

        if ( count($ccData) ) {
          $markdown = $markdown->cc($ccData);
        }
        if ( count($bccData) ) {
          $markdown = $markdown->bcc($bccData);
        }
        if ( count($replyToData) ) {
          $markdown = $markdown->replyTo($replyToData);
        }

        $markdown = $markdown->subject($subject);

        /*
        $markdown = $markdown->attach('C:\xampp\htdocs\interactin_5.4\public\docs\Presentación.pdf', [
                              'as' => 'Presentación.pdf',
                              'mime' => 'application/pdf',
                          ]);
        */

        if ( count($this->archivosAdjuntos) > 0 && $this->archivosAdjuntos != '' ) {
          foreach ($this->archivosAdjuntos as $archivoAdjunto) {
            
            $separador = '/';
            if (DIRECTORY_SEPARATOR == '\\') {
                $separador = '\\';
            }

            if (config('filesystems.default') == 'local'){
                $pathFile = storage_path().$separador.'app'.$separador.'public'.$separador.str_replace("/",$separador,$archivoAdjunto->path);  
            }else {
                $pathFile = storage_path().$separador.str_replace("/",$separador,$archivoAdjunto->path);    
            }

            $markdown = $markdown->attach( $pathFile, [
                                  'as' => $archivoAdjunto->nombre,
                                  'mime' => $archivoAdjunto->formato_nombre,
                              ]);
          }
        }
        $url = '';
        if (isset($this->dataEmail->alianzaId)) {
          $url = route('interalliances.validations_interalliances.show',[$this->dataEmail->alianzaId]);
          if ($this->tipo_link_boton == 'interesados'){
            $url = route('interalliances.show',[$this->dataEmail->alianzaId]);
          }
        }elseif (isset($this->dataEmail->iniciativaId)) {
          $url = route('interactions.validations_interactions.show',[$this->dataEmail->iniciativaId]);
          if ($this->tipo_link_boton == 'interesados'){
            $url = route('interactions.show',[$this->dataEmail->iniciativaId]);
          }
        }elseif (isset($this->dataEmail->inscripcionId)) {
          $url = route('interchanges.validations_interchanges.show',[$this->dataEmail->inscripcionId]);
          if ($this->tipo_link_boton == 'interesados'){
            $tipoInscripcion = $this->dataEmail->tipoInscripcion;
            $url = route('interchanges.'.$tipoInscripcion.'.show',[$this->dataEmail->inscripcionId]);
          }
        }else{
            $url = route('home');
        }

        $markdown = $markdown->with([
                        'dataEmail' => $this->dataEmail,
                        'url' => $url,
                    ]);


        return $markdown;
    }
}
