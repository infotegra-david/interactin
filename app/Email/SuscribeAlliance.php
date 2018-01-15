<?php

namespace App\Email;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuscribeAlliance extends Mailable
{
    use Queueable, SerializesModels;

    public $dataEmail;
    public $dataUsers;
    public $paso_titulo;
    public $dataAlianza;
    public $archivosAdjuntos;
    public $CoordinadorInterno;
    public $CoordinadorExterno;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataEmail, $dataUsers, $paso_titulo, $dataAlianza, $archivosAdjuntos, $CoordinadorInterno, $CoordinadorExterno)
    {
        $this->dataEmail = $dataEmail;
        $this->dataUsers = $dataUsers;
        $this->paso_titulo = $paso_titulo;
        $this->dataAlianza = $dataAlianza;
        $this->archivosAdjuntos = $archivosAdjuntos;
        $this->CoordinadorInterno = $CoordinadorInterno;
        $this->CoordinadorExterno = $CoordinadorExterno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cc = '';
        $ccName = '';
        $bcc = '';
        $bccName = '';
        $replyTo = '';
        $replyToName = '';
        $msj_header_text = '';
        $markdownView = 'emails.alliances.external';
        $accion = 'creado';
        $markdownWith = '';

        //$toData = json_decode($this->dataEmail[0]->to);
        $ccData = json_decode($this->dataEmail[0]->cc);
        $bccData = json_decode($this->dataEmail[0]->bcc);
        $replyToData = json_decode($this->dataEmail[0]->replyto);

        $content = json_decode($this->dataEmail[0]->content, true);

        $subject = $this->dataEmail[0]->subject;
        //el from no funciona aun, solo envia DESDE el email configurado \Config::get('mail.from.name')
        $from = \Config::get('mail.from.address');
        $fromName = \Config::get('mail.from.name');
     



        //return $this->view('view.name');
        //return $this->from('david.calderon@infotegra.com')
        if( $this->dataEmail[0]->estado_nombre == 'DECLINADO' ){
            $markdownView = 'emails.alliances.external_declined';
        }



        $markdown = $this->markdown($markdownView)->from( $from,$fromName );

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

        if ( count($this->archivosAdjuntos) >0 && $this->archivosAdjuntos != '' ) {
          foreach ($this->archivosAdjuntos as $archivoAdjunto) {
            $pathFile = '';
            
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
        

        $keyCoordExterno = array_search($this->CoordinadorExterno, array_column($this->dataUsers, 'usuario_id'));
        $keyCoordInterno = array_search($this->CoordinadorInterno, array_column($this->dataUsers, 'usuario_id'));

        $markdownWith = [
                            'content' => $content,
                            'dataEmail' => $this->dataEmail,
                        ];
        if( $this->dataEmail[0]->estado_nombre != 'DECLINADO' ){
            $markdownWith = array_merge($markdownWith,[
                            'dataUsers' => $this->dataUsers,
                            'paso_titulo' => $this->paso_titulo,
                            'dataAlianza' => $this->dataAlianza,
                            'keyCoordExterno' => $keyCoordExterno,
                            'keyCoordInterno' => $keyCoordInterno,
                        ]);
        }

        if( $this->dataEmail[0]->estado_nombre == 'DECLINADO' ){
            $coordinadorDestinoEmail = $this->dataUsers[$keyCoordExterno]['coordinador_email'];
            $markdownWith = array_merge($markdownWith,[
                            'coordinadorDestinoEmail' => $coordinadorDestinoEmail
                        ]);
        }elseif( $this->dataEmail[0]->estado_nombre == 'ACEPTADO' ){
            $markdownWith = array_merge($markdownWith,[
                            'url' => route('interalliances.show',$this->dataAlianza['token'])
                        ]);
        }else{
            $markdownWith = array_merge($markdownWith,[
                            'url' => route('interalliances.destination',$this->dataAlianza['token'])
                        ]);
        
        }

        $markdown = $markdown->with($markdownWith);


        return $markdown;
                
                


        //return $this->markdown('emails.orders.shipped')
                
    }
}
