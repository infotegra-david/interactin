<?php

namespace App\Http\Traits;
use DB;
use Illuminate\Support\Facades\Mail;
use Flash;

trait Emails{
    

    /**
     * @param $busqueda
     * @return mixed
     */
    public function verEmail($tipo_email,$datos)
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
    public function crearEmail($tipo_email,$datos)
    {

        $retorno = false;
        $conteo = 0;
        $dataEmail['to'] = [];
        $dataEmail['cc'] = [];
        $dataEmail['bcc'] = [];
        $email = '';
        $emails = '';

        if (isset($datos['to'][0]->email)) {
            foreach ($datos['to'] as $to) {
                array_push($dataEmail['to'],array('user_id' => ($to->user_id ?? $to->id), 'email' => $to->email, 'name' => $to->name ) );
            }
        }
        $dataEmail['to'] = json_encode($dataEmail['to']);
        
        if (isset($datos['cc'][0]->email)) {
            foreach ($datos['cc'] as $cc) {
                array_push($dataEmail['cc'],array('user_id' => ($cc->user_id ?? $cc->id), 'email' => $cc->email, 'name' => $cc->name ) );
            }
        }
        $dataEmail['cc'] = json_encode($dataEmail['cc']);

        if (isset($datos['bcc'][0]->email)) {
            foreach ($datos['bcc'] as $bcc) {
                array_push($dataEmail['bcc'],array('user_id' => ($bcc->user_id ?? $bcc->id), 'email' => $bcc->email, 'name' => $bcc->name ) );
            }
        }
        $dataEmail['bcc'] = json_encode($dataEmail['bcc']);

        $dataEmail['subject'] = $datos['subject'];
        
        $dataEmail['content'] = $datos['content'];

        $dataEmail['tokenemail'] = md5(hash("md2",(string)microtime())).hash("md2",(string)microtime());
        $dataEmail['estado'] = 0;

        switch ($tipo_email) {
            case 'alianza':

                if( $datos['paso_proceso_id'] != '' ){

                    // DB::beginTransaction();
                    $pasoAlianza = \App\Models\Validation\PasosAlianza::find($datos['paso_proceso_id']);
                    if ( $datos['crearTipo'] == 'nuevo' ){
                        if ($emails = \App\Models\Email::create($dataEmail) ){ 
                            
                            //$pasoAlianza->email()->sync($email->id,['user_id' => $datos['user_id']]);
                            $pasoAlianza->email()->sync([$emails->id => [ 'user_id' => $datos['user_id']] ], true);

                        }else{
                            //DB::rollBack();
                            $retorno = 'error_email';
                            goto end;
                        }
                    }elseif ( $datos['crearTipo'] == 'actualizar' ){

                        $emails = \App\Models\Email::find($datos['id']);

                        if ( count($emails) ){ 
                            if (count($emails) > 1) {
                                foreach ($emails as $key => $email) {
                                    $email->update($dataEmail);

                                    //$pasoAlianza->email()->sync($email->id,['user_id' => $datos['user_id']]);
                                    $pasoAlianza->email()->sync([$email->id => [ 'user_id' => $datos['user_id']] ], true);
                                    
                                    // $estado = \App\Models\Estado::where('nombre',$datos['estadoPaso'])->pluck('id')->first();
                                    // $pasoAlianza->estado_id = $estado;
                                    // $pasoAlianza->save();
                                }
                            }else{
                                $emails->update($dataEmail);
                                $pasoAlianza->email()->sync([$emails->id => [ 'user_id' => $datos['user_id']] ], true);
                            }
                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_email';
                            goto end;
                        }
                    }

            //GUARDAR LA SELECCION DE ARCHIVOS A ENVIAR en el MAIL
                    
                    if ( $datos['archivosAdjuntos'] !== '' || $datos['archivosAdjuntos'] === 0 ) {
                        $archivosAdjuntos = \App\Models\Archivo::find($datos['archivosAdjuntos']);
                        if (count($emails) > 1) {
                            foreach ($emails as $key => $email) {
                                $email->archivo()->sync($archivosAdjuntos);
                            }
                        }else{
                            $emails->archivo()->sync($archivosAdjuntos);
                        }
                    }

                    $retorno = $emails;

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
                if( $datos['paso_proceso_id'] != '' ){
                    $pasosProceso = '';
                    $campoPasosProceso = '';
                    // DB::beginTransaction();
                    switch ($datos['tabla_email']) {
                        case 'pasos_alianza_email':
                            $pasosProceso = \App\Models\Validation\PasosAlianza::find($datos['paso_proceso_id']);
                            $campoPasosProceso = 'pasos_alianza_id';
                            break;
                        case 'pasos_inscripcion_email':
                            $pasosProceso = \App\Models\Validation\PasosInscripcion::find($datos['paso_proceso_id']);
                            $campoPasosProceso = 'pasos_inscripcion_id';
                            break;
                        case 'pasos_iniciativa_email':
                            $pasosProceso = \App\Models\Validation\PasosIniciativa::find($datos['paso_proceso_id']);
                            $campoPasosProceso = 'pasos_iniciativa_id';
                            break;
                        default:
                            $retorno = 'error_tabla';
                            goto end;
                            break;
                    }

                    // print_r($pasosProceso);

                    $pasosProcesoArray = $pasosProceso->toArray();
                    $pasosProcesoId = array();
                    if (count($pasosProceso) >= 1) {
                    // if (count($pasosProceso) == 1) {
                    //     $pasosProcesoId[] = $pasosProceso[0]->id;
                    // }elseif (count($pasosProceso) > 1) {
                        if (isset($pasosProcesoArray[0]) ) {
                            $pasosProcesoId = array_column($pasosProcesoArray, 'id');
                        }else{
                            $pasosProcesoId = [$pasosProcesoArray['id']];
                        }

                    }else{
                        //// DB::rollBack();
                        $retorno = 'error_user';
                        goto end;
                    }

                    if ( $datos['crearTipo'] == 'nuevo' ){
                        if ($emails = \App\Models\Email::create($dataEmail) ){
                            //echo '$email->id'.$email->id;

                            //$pasosProceso->email()->syncWithoutDetaching($email->id,['user_id' => $datos['user_id']]);
                            if (isset($pasosProceso[0])) {
                                foreach ($pasosProceso as $key => $userP) {
                                    $userP->email()->syncWithoutDetaching([$emails->id => [ 'user_id' => $datos['user_id']] ]);
                                }
                            }else{
                                $pasosProceso->email()->syncWithoutDetaching([$emails->id => [ 'user_id' => $datos['user_id']] ]);
                            }

                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_email';
                            goto end;
                        }
                    }elseif ( $datos['crearTipo'] == 'actualizar' ){
                        
                        $emails = \App\Models\Email::find($datos['id']);

                        if ( count($emails) ){ 
                            //echo '$email->id'.$email->id;

                            foreach ($emails as $key => $email) {
                                $email->update($dataEmail);

                                $pasosProcesoEmail = DB::table($datos['tabla_email'])->whereIn($campoPasosProceso,$pasosProcesoId)
                                    ->where('user_id',$datos['user_id'])
                                    ->where('email_id',$email->id)
                                    ->update([
                                        'user_id' => $datos['user_id']
                                    ]);
                                
                            }

                            //$pasosProceso->email()->syncWithoutDetaching($email->id,['user_id' => $datos['user_id']]);

                        }else{
                            //// DB::rollBack();
                            $retorno = 'error_email';
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
                        if (count($emails) > 1) {
                            foreach ($emails as $key => $email) {
                                $email->archivo()->sync($archivosAdjuntos);
                            }
                        }else{
                            if ($emails[0] != '') {
                                $emails[0]->archivo()->sync($archivosAdjuntos);
                            }else{
                                $emails->archivo()->sync($archivosAdjuntos);
                            }
                        }
                    }

                    $retorno = $emails;

                    // DB::commit();   

                }else{
                    $retorno = 'error_paso';
                    goto end;
                }
                break;

            default:
                $retorno = 'error_tipo_email';
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
    public function enviarEmail($tipo_email, $request)
    {   
        $retorno = false;
        $errors = 0;
        $returnMsg = [];

        switch ($tipo_email) {
            case 'alianza':

                if( isset($request['enviar']) && isset($request['tokenemail']) ) {
                    
                    // $verificarToken = \App\Models\Email::where('tokenemail',$request['tokenemail'])->where('id',$request['dataEmail'][0]->id)->select('id');
                    $verificarToken = \App\Models\Email::where('tokenemail',$request['tokenemail'])->select('id');
                    //echo $verificarToken->toSql().' |$request["tokenemail"]:'.$request['tokenemail'].' |$request['dataEmail'][0]->id:'.$request['dataEmail'][0]->id;
                    $verificarToken = $verificarToken->get();

                    //if ( count($verificarToken) > 0 ) {
                    //if ( count($verificarToken) > 0 || ( isset($request['peticion']) && $request['peticion'] == 'local' ) ) {
                    if ( count($verificarToken) > 0 ) {

                        if ($request['dataEmail'][0]->estado == '1') {
                            $errors += 1;
                            array_push($returnMsg, 'El email ya fue enviado.');
                            goto end;
                        }
                        

                //falta hacerlo array para enviarlo a varios usuarios a la vez
                        $to = json_decode($request['dataEmail'][0]->to);
                        $emailTo = $to;
                        $cc = json_decode($request['dataEmail'][0]->cc);
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
                        
                        //llama al email creado llamado OrderShipped
//SIN INTERNET NO SIRVE
                        Mail::to($emailTo)->send( new \App\Email\SuscribeAlliance($request['dataEmail'], $request['dataUsers'], $request['paso_titulo'], $request['dataAlianza'], $request['archivosAdjuntos'], $request['CoordinadorInterno'], $request['CoordinadorExterno']) );
                        
                        /*
                        //retrasa el envio 10 minutos
                        $when = Carbon\Carbon::now()->addMinutes(10);
                        */


                        $existeEmail = \App\Models\Email::where('id',$request['dataEmail'][0]->id)
                            ->update(['estado' => 1]);

                        // if( count($existeEmail) ){
                        //     $existeEmail->estado = 1;
                        //     $existeEmail->save();

                            
                            
                                //     if ( !$this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId) ){
                                //         $errors += 1;
                                //         array_push($errorsMsg, 'No se puede registrar del paso '.$request['paso'].' para la alianza.');
                                //         goto end;
                                //     }
                            

                        // }else{
                        //     $errors += 1;
                        //     array_push($returnMsg, 'No se encontraron los datos del email para actualizar el estado.');
                        //     goto end;
                        // }

                        $successMsj = 'El email a los coordinadores fue enviado correctamente.';
                        if( isset($emailTo) ){
                            $separado_por_comas = implode(", ", array_column($emailTo, 'email'));
                            $separado_por_comas_cc = implode(", ", array_column($emailCc, 'email'));
                            $separado_por_comas_cc = ($separado_por_comas_cc != '' ? ' y '.$separado_por_comas_cc : '');
                            $successMsj = 'El email al coordinador '.$separado_por_comas.$separado_por_comas_cc.' fue enviado correctamente.';
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
                if( isset($request['enviar']) && isset($request['tokenemail']) ) {
                    
                    $verificarToken = \App\Models\Email::where('tokenemail',$request['tokenemail'])->where('id',$request['dataEmail']->id)->select('id');
                    //echo $verificarToken->toSql().' |$request["tokenemail"]:'.$request['tokenemail'].' |$request['dataEmail'][0]->id:'.$request['dataEmail'][0]->id;
                    $verificarToken = $verificarToken->get();

                    if ( count($verificarToken) > 0 ) {
                        
                        if ($request['dataEmail']->estado == '1') {
                            $errors += 1;
                            array_push($returnMsg, 'El email ya fue enviado al validador.');
                            goto end;
                        }
                        if (isset($request['alianzaId'])) {
                            $request['dataEmail']->alianzaId = $request['alianzaId'];
                        }

                //falta hacerlo array para enviarlo a varios usuarios a la vez
                        $to = json_decode($request['dataEmail']->to);
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
//SIN INTERNET NO SIRVE
                        //llama al email creado llamado OrderShipped
                        mail::to($emailTo)->send( new \App\Email\Validador($request['dataEmail'],$request['archivosAdjuntos'],$request['tipo_link_boton']) );
                        


                        $existeEmail = \App\Models\Email::find($request['dataEmail']->id);
                        if( count($existeEmail) ){
                            $existeEmail->estado = 1;
                            $existeEmail->save();
                        }else{
                            $errors += 1;
                            array_push($returnMsg, 'El estado del email no se puede actualizar, no se encontraron los datos del email a enviar al validador.');
                            goto end;
                        }

                        $successMsj = 'Los datos fueron enviados correctamente.';
                        /*
                        if( count($emailTo) ){
                            $separado_por_comas = implode(", ", array_column($emailTo, 'email'));
                            $successMsj = 'El email al/los validador(es) '.$separado_por_comas.' fue enviado correctamente.';
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
                        array_push($returnMsg, 'El token recibido del email a enviar al validador no es valido.');
                        goto end;
                    }

                }else{
                    $errors += 1;
                    array_push($returnMsg, 'No se recibieron datos para buscar información del email a enviar al validador.');
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