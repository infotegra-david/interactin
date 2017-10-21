<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Validador extends Mailable
{
    use Queueable, SerializesModels;
    
    public $dataMail;
    public $archivosAdjuntos;
    public $tipo_link_boton;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataMail,$archivosAdjuntos,$tipo_link_boton)
    {
        $this->dataMail = $dataMail;
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

        //$toData = json_decode($this->dataMail->to);
        $ccData = json_decode($this->dataMail->cc);
        $bccData = json_decode($this->dataMail->bcc);
        $replyToData = json_decode($this->dataMail->replyto);

        $subject = $this->dataMail->subject;
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
        if (isset($this->dataMail->alianzaId)) {
          $url = route('intervalidation.interalliances.validations.show',[$this->dataMail->alianzaId]);
          if ($this->tipo_link_boton == 'interesados'){
            $url = route('interalliances.show',[$this->dataMail->alianzaId]);
          }
        }elseif (isset($this->dataMail->iniciativaId)) {
          $url = route('intervalidation.interactions.validations.show',[$this->dataMail->iniciativaId]);
          if ($this->tipo_link_boton == 'interesados'){
            $url = route('interactions.show',[$this->dataMail->iniciativaId]);
          }
        }elseif (isset($this->dataMail->inscripcionId)) {
          $url = route('intervalidation.interchanges.validations.show',[$this->dataMail->inscripcionId]);
          if ($this->tipo_link_boton == 'interesados'){
            $url = route('interchanges.edit',[$this->dataMail->inscripcionId]);
          }
        }else{
            $url = route('home');
        }

        $markdown = $markdown->with([
                        'dataMail' => $this->dataMail,
                        'url' => $url,
                    ]);


        return $markdown;
    }
}
