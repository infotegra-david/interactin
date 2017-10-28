<?php

namespace App\Http\Traits;
use DB;
use Illuminate\Support\Facades\Mail;
use Flash;

trait Mails{
    

    /**
     * @param $busqueda
     * @return mixed
     */
    public function verMail($tipo_mail,$datos)
    {
        if( strtoupper($tipo_cuenta) =='%%' ){
            $tipo_cuenta = '';
        }
        return $this->model->where('tipo', 'like', '%'.strtoupper($tipo_cuenta).'%');
    }
    /**
     * @param $busqueda
     * @return mixed
     */
    public function crearMail($tipo_mail,$datos)
    {

        $retorno = false;
        $conteo = 0;
        $dataMail['to'] = [];
        $dataMail['cc'] = [];
        $dataMail['bcc'] = [];
        $mail = '';
        $mails = '';

        if (isset($datos['to'][0]->email)) {
            foreach ($datos['to'] as $to) {
                array_push($dataMail['to'],array('email' => $to->email, 'name' => $to->name ) );
            }
        }
        $dataMail['to'] = json_encode($dataMail['to']);
        
        if (isset($datos['cc'][0]->email)) {
            foreach ($datos['cc'] as $cc) {
                array_push($dataMail['cc'],array('email' => $cc->email, 'name' => $cc->name ) );
            }
        }
        $dataMail['cc'] = json_encode($dataMail['cc']);

        if (isset($datos['bcc'][0]->email)) {
            foreach ($datos['bcc'] as $bcc) {
                array_push($dataMail['bcc'],array('email' => $bcc->email, 'name' => $bcc->name ) );
            }
        }
        $dataMail['bcc'] = json_encode($dataMail['bcc']);

        $dataMail['subject'] = $datos['subject'];
        
        $dataMail['content'] = $datos['content'];

        $dataMail['tokenmail'] = md5(hash("md2",(string)microtime())).hash("md2",(string)microtime());
        $dataMail['estado'] = 0;

        switch ($tipo_mail) {
            case 'alianza':

                if( $datos['paso'] != '' ){

                    // DB::beginTransaction();
                    $pasoAlianza = \App\Models\Validation\PasosAlianza::find($datos['paso']);
                    if ( $datos['crearTipo'] == 'nuevo' ){
                        if ($mails = \App\Models\Mail::create($dataMail) ){ 
                            
                            //$pasoAlianza->mail()->sync($mail->id,['user_id' => $datos['user_id']]);
                            $pasoAlianza->mail()->sync([$mails->id => [ 'user_id' => $datos['user_id']] ], true);

                        }else{
                            //DB::rollBack();
                            $retorno = 'error_mail';
                            goto end;
                        }
                    }elseif ( $datos['crearTipo'] == 'actualizar' ){

                        $mails = \App\Models\Mail::find($datos['id']);

                        if ( count($mails) ){ 
                            if (count($mails) > 1) {
                                foreach ($mails as $key => $mail) {
                                    $mail->update($dataMail);

                                    //$pasoAlianza->mail()->sync($mail->id,['user_id' => $datos['user_id']]);
                                    $pasoAlianza->mail()->sync([$mail->id => [ 'user_id' => $datos['user_id']] ], true);
                                    
                                    // $estado = \App\Models\Estado::where('nombre',$datos['estadoPaso'])->pluck('id')->first();
                                    // $pasoAlianza->estado_id = $estado;
                                    // $pasoAlianza->save();
                                }
                            }else{
                                $mails->update($dataMail);
                                $pasoAlianza->mail()->sync([$mails->id => [ 'user_id' => $datos['user_id']] ], true);
                            }
                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_mail';
                            goto end;
                        }
                    }

            //GUARDAR LA SELECCION DE ARCHIVOS A ENVIAR en el MAIL
                    
                    if ( $datos['archivosAdjuntos'] !== '' || $datos['archivosAdjuntos'] === 0 ) {
                        $archivosAdjuntos = \App\Models\Archivo::find($datos['archivosAdjuntos']);
                        if (count($mails) > 1) {
                            foreach ($mails as $key => $mail) {
                                $mail->archivo()->sync($archivosAdjuntos);
                            }
                        }else{
                            $mails->archivo()->sync($archivosAdjuntos);
                        }
                    }

                    $retorno = $mails;

                    // DB::commit();

                }else{
                    $retorno = 'error_paso';
                    goto end;
                }

                break;
            case 'iniciativa':
                
                break;
            case 'inscripcion':
                
                break;
            case 'validador':
                //recibe el id de la tabla user_tipo_paso que se esta validando
                if( $datos['paso'] != '' ){

                    // DB::beginTransaction();

                    $usersPaso = \App\Models\Validation\UserPaso::find( $datos['paso'] );
                    
                    // print_r($usersPaso);
                    $usersPasoId = array();
                    if (count($usersPaso) == 1) {
                        $usersPasoId[] = $usersPaso->id;
                    }elseif (count($usersPaso) > 1) {
                        foreach ($usersPaso as $userPaso) {
                            $usersPasoId[] = $userPaso->id;
                        }
                    }else{
                        //// DB::rollBack();
                        $retorno = 'error_user';
                        goto end;
                    }

                    if ( $datos['crearTipo'] == 'nuevo' ){
                        if ($mails = \App\Models\Mail::create($dataMail) ){
                            //echo '$mail->id'.$mail->id;

                            //$usersPaso->mail()->syncWithoutDetaching($mail->id,['user_id' => $datos['user_id']]);
                            $usersPaso->mail()->syncWithoutDetaching([$mails->id => [ 'user_id' => $datos['user_id']] ]);

                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_mail';
                            goto end;
                        }
                    }elseif ( $datos['crearTipo'] == 'actualizar' ){
                        
                        $mails = \App\Models\Mail::find($datos['id']);

                        if ( count($mails) ){ 
                            //echo '$mail->id'.$mail->id;

                            foreach ($mails as $key => $mail) {
                                $mail->update($dataMail);

                                $usersPasoMail = DB::table('user_tipo_paso_mail')->whereIn('user_tipo_paso_id',$usersPasoId)
                                    ->where('user_id',$datos['user_id'])
                                    ->where('mail_id',$mail->id)
                                    ->update([
                                        'user_id' => $datos['user_id']
                                    ]);
                                
                            }

                            //$usersPaso->mail()->syncWithoutDetaching($mail->id,['user_id' => $datos['user_id']]);

                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_mail';
                            goto end;
                        }
                    }else{
                        //// DB::rollBack();
                        $retorno = 'error_crear_tipo';
                        goto end;
                    }
                    
        //GUARDAR LA SELECCION DE ARCHIVOS A ENVIAR en el MAIL

                    if ( $datos['archivosAdjuntos'] !== '' || $datos['archivosAdjuntos'] === 0 ) {
                        $archivosAdjuntos = \App\Models\Archivo::find($datos['archivosAdjuntos']);
                        if (count($mails) > 1) {
                            foreach ($mails as $key => $mail) {
                                $mail->archivo()->sync($archivosAdjuntos);
                            }
                        }else{
                            if ($mails[0] != '') {
                                $mails[0]->archivo()->sync($archivosAdjuntos);
                            }else{
                                $mails->archivo()->sync($archivosAdjuntos);
                            }
                        }
                    }

                    $retorno = $mails;

                    // DB::commit();   

                }else{
                    $retorno = 'error_paso';
                    goto end;
                }
                break;

            default:
                $retorno = 'error_tipo_mail';
                goto end;

                break;
        }

        end:
        return $retorno;
    }

    
    /**
     * @param $busqueda
     * @return mixed
     */
    public function enviarMail($tipo_mail, $request)
    {   
        $retorno = false;
        $errors = 0;
        $returnMsg = [];

        switch ($tipo_mail) {
            case 'alianza':

                if( isset($request['enviar']) && isset($request['tokenmail']) ) {
                    
                    $verificarToken = \App\Models\Mail::where('tokenmail',$request['tokenmail'])->where('id',$request['dataMail'][0]->id)->select('id');
                    //echo $verificarToken->toSql().' |$request["tokenmail"]:'.$request['tokenmail'].' |$request['dataMail'][0]->id:'.$request['dataMail'][0]->id;
                    $verificarToken = $verificarToken->get();

                    //if ( count($verificarToken) > 0 ) {
                    //if ( count($verificarToken) > 0 || ( isset($request['peticion']) && $request['peticion'] == 'local' ) ) {
                    if ( count($verificarToken) > 0 ) {

                        if ($request['dataMail'][0]->estado == '1') {
                            $errors += 1;
                            array_push($returnMsg, 'El e-mail ya fue enviado.');
                            goto end;
                        }
                        

                //falta hacerlo array para enviarlo a varios usuarios a la vez
                        $to = json_decode($request['dataMail'][0]->to);
                        $emailTo = $to;
                        $cc = json_decode($request['dataMail'][0]->cc);
                        $emailCc = $cc;
                        /*
                        $emailTo = '';
                        $conteo = 0;
                        foreach ($to as $tokey) {
                            if($conteo >0){
                                $emailTo = $emailTo.',';
                            }
                            $emailTo = $tokey->email;
                            $conteo++;
                        }
                        */
                        
                        //llama al mail creado llamado OrderShipped
                        Mail::to($emailTo)->send( new \App\Mail\SuscribeAlliance($request['dataMail'], $request['dataUsers'], $request['paso_titulo'], $request['dataAlianza'], $request['archivosAdjuntos'], $request['CoordinadorInterno'], $request['CoordinadorExterno']) );
                        
                        /*
                        //retrasa el envio 10 minutos
                        $when = Carbon\Carbon::now()->addMinutes(10);
                        */


                        $existeMail = \App\Models\Mail::where('id',$request['dataMail'][0]->id)
                            ->update(['estado' => 1]);

                        // if( count($existeMail) ){
                        //     $existeMail->estado = 1;
                        //     $existeMail->save();

                            
                            
                                //     if ( !$this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId) ){
                                //         $errors += 1;
                                //         array_push($errorsMsg, 'No se puede registrar del paso '.$request['paso'].' para la alianza.');
                                //         goto end;
                                //     }
                            

                        // }else{
                        //     $errors += 1;
                        //     array_push($returnMsg, 'No se encontraron los datos del e-mail para actualizar el estado.');
                        //     goto end;
                        // }

                        $successMsj = 'El e-mail a los coordinadores fue enviado correctamente.';
                        if( isset($emailTo) ){
                            $separado_por_comas = implode(", ", array_column($emailTo, 'email'));
                            $separado_por_comas_cc = implode(", ", array_column($emailCc, 'email'));
                            $successMsj = 'El e-mail al coordinador '.$separado_por_comas.' y '.$separado_por_comas_cc.' fue enviado correctamente.';
                        }
                        //$successMsj .= '<br> Será notificado cuando haya una respuesta.';

                        if ( isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {
                            $retorno = $successMsj.' <br>';
                        }else{
                            Flash::success($successMsj);

                            return \View::make('emails.alliances.response')->with(['peticion' => $this->peticion]);

                        }
                        
                    }else{
                        
                        $errors += 1;
                        array_push($returnMsg, 'El token no es valido.');
                        goto end;
                    }

                }else{
                    $errors += 1;
                    array_push($returnMsg, 'No se recibieron datos para buscar información.');
                    goto end;

                }

                break;
            case 'iniciativa':
                
                break;
            case 'inscripcion':
                
                break;
            case 'validador':
                if( isset($request['enviar']) && isset($request['tokenmail']) ) {
                    
                    $verificarToken = \App\Models\Mail::where('tokenmail',$request['tokenmail'])->where('id',$request['dataMail']->id)->select('id');
                    //echo $verificarToken->toSql().' |$request["tokenmail"]:'.$request['tokenmail'].' |$request['dataMail'][0]->id:'.$request['dataMail'][0]->id;
                    $verificarToken = $verificarToken->get();

                    if ( count($verificarToken) > 0 ) {
                        
                        if ($request['dataMail']->estado == '1') {
                            $errors += 1;
                            array_push($returnMsg, 'El e-mail ya fue enviado al validador.');
                            goto end;
                        }
                        if (isset($request['alianzaId'])) {
                            $request['dataMail']->alianzaId = $request['alianzaId'];
                        }

                //falta hacerlo array para enviarlo a varios usuarios a la vez
                        $to = json_decode($request['dataMail']->to);
                        $emailTo = $to;
                        /*
                        $emailTo = '';
                        $conteo = 0;
                        foreach ($to as $tokey) {
                            if($conteo >0){
                                $emailTo = $emailTo.',';
                            }
                            $emailTo = $tokey->email;
                            $conteo++;
                        }
                        */

                        //llama al mail creado llamado OrderShipped
                        Mail::to($emailTo)->send( new \App\Mail\Validador($request['dataMail'],$request['archivosAdjuntos'],$request['tipo_link_boton']) );
                        


                        $existeMail = \App\Models\Mail::find($request['dataMail']->id);
                        if( count($existeMail) ){
                            $existeMail->estado = 1;
                            $existeMail->save();
                        }else{
                            $errors += 1;
                            array_push($returnMsg, 'El estado del email no se puede actualizar, no se encontraron los datos del e-mail a enviar al validador.');
                            goto end;
                        }

                        $successMsj = 'Fue notificado el validador.';
                        /*
                        if( count($emailTo) ){
                            $separado_por_comas = implode(", ", array_column($emailTo, 'email'));
                            $successMsj = 'El e-mail al/los validador(es) '.$separado_por_comas.' fue enviado correctamente.';
                        }
                        */

                        if ( isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {
                            $retorno = $successMsj.' <br>';
                        }else{
                            Flash::success($successMsj);

                            return \View::make('emails.validator.response')->with(['peticion' => $this->peticion]);

                        }
                        
                    }else{
                        
                        $errors += 1;
                        array_push($returnMsg, 'El token recibido del e-mail a enviar al validador no es valido.');
                        goto end;
                    }

                }else{
                    $errors += 1;
                    array_push($returnMsg, 'No se recibieron datos para buscar información del e-mail a enviar al validador.');
                    goto end;

                }
                break;
        }

        end:
        if ($errors > 0) {
            $retorno['errors'] = $errors;
            $retorno['returnMsg'] = $returnMsg;
        }
        return $retorno;
    }
}