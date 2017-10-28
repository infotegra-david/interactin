<?php

namespace App\Http\Traits;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Validation\UserPaso;
use App\Models\Admin\Role;
    
trait Validador{
    

    /**
     * @param $busqueda
     * @return mixed
     */
    public function verValidador($tipo_mail,$datos)
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
    public function crearValidador($tipo_mail,$datos)
    {

        $retorno = false;


        switch ($tipo_mail) {
            
            case '':
                
                break;
        }

        end:
        return $retorno;
    }
    
    /**
     * @param $busqueda
     * @return mixed
     */
    public function verificarValidacion($request)
    {

        $retorno['retorno'] = false;
        $retorno['msg'] = [];

        // //validar el id de la alianza
        // $alianza = \App\Models\Alianza::find($request['alianzaId']);
        // if (!count($alianza)) {
        //     $retorno['retorno'] = false;
        //     $retorno['msg'] = 'No se encontro la alianza.';
        //     goto end;
        // }else{
        //     $alianzaId = $alianza->id;
        // }

        // //validar el numero del paso 
        // $tipo_paso = \App\Models\TipoPaso::where('nombre','paso'.$request['paso'].'_alianza')->select('id','titulo')->first();

        // if (!count($tipo_paso)) {
        //     $retorno['retorno'] = false;
        //     $retorno['msg'] = 'No se encontro el paso.';
        //     goto end;
        // }

        // //obtener el id del estado 'APROBADO'
        // $estadoAprobadoId = \App\Models\Estado::where('nombre','APROBADO')->pluck('id')->first();

        // //lista de todos los usuarios que pertenezcan al campus y tengan el rol de validador ($request['campusId'])
        // $validadores = \App\Models\Admin\Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
        //     ->join('users', 'users.id', '=', 'model_has_roles.model_id')
        //     ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
        //     ->where('roles.name','validador')
        //     ->where('user_campus.campus_id',$request['campusAppId'])
        //     ->pluck('users.id');

        // //filtrar los usuarios asignados para validar el paso segun la lista anterior (user_tipo_paso) si pertenecen al campus actual ($request['paso'])
        // $validadoresXelPaso = UserPaso::join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
        //     ->where('user_tipo_paso.tipo_paso_id',$tipo_paso->id)
        //     ->whereIn('user_tipo_paso.user_id',$validadores)
        //     ->orderBy('user_tipo_paso.orden','asc')
        //     ->select('user_tipo_paso.user_id','user_tipo_paso.orden','user_tipo_paso.titulo')
        //     ->get()->toArray();

        // switch ($request['tipo']) {
        //     case 'aceptado':
        //         $validaronAceptado = \App\Models\Validation\PasosAlianza::join('estado', 'pasos_alianza.estado_id', '=', 'estado.id')
        //             ->where('pasos_alianza.alianza_id',$alianzaId)
        //             ->where('pasos_alianza.tipo_paso_id',$tipo_paso->id)
        //             ->groupBy('pasos_alianza.id')
        //             ->orderBy('pasos_alianza.id','desc')
        //             ->select('pasos_alianza.*','estado.nombre')
        //             ->get();

        //         if ( count($validaronAceptado) ) {
        //             foreach ($validaronAceptado as $key => $validacion) {
        //                 if ( $validacion->nombre == 'ACEPTADO' ) {
        //                     $retorno['retorno'] = 'ACEPTADO';
        //                     break 1;
        //                 }elseif ( $validacion->nombre == 'DECLINADO'  ) {
        //                     $retorno['retorno'] = 'DECLINADO';
        //                     break 1;
        //                 }
        //             }
                    
        //         }else{
        //             $retorno['retorno'] = 'no_validaron';
        //         }
        //         break;
        //     case 'actual':
        //         if ( count($validadoresXelPaso) ) {
        //             $retornoMsg = 'Al paso \''.$tipo_paso->titulo.'\' le fue asignado '.count($validadoresXelPaso).' validador, será notificado cuando lo apruebe. <br>';
        //             if (count($validadoresXelPaso) > 1 ) {
        //                 $retornoMsg = 'Al paso \''.$tipo_paso->titulo.'\' le fueron asignados '.count($validadoresXelPaso).' validadores, será notificado cuando todos lo aprueben. <br>';
        //             }
        //             $retorno['retorno'] = 'lista_validadores';
        //             array_push($retorno['msg'], $retornoMsg);
                    
        //         }else{
        //             $retorno['retorno'] = 'sin_validadores';
        //         }
        //         break;
        //     case 'anterior':
                
        //         //obtener los ids de las ultimas entradas que hicieron los validadores asignados
        //         $ultimasValidaciones = \App\Models\Validation\PasosAlianza::join('alianza', 'pasos_alianza.alianza_id', '=', 'alianza.id')
        //             ->where('pasos_alianza.alianza_id',$alianzaId)
        //             ->where('pasos_alianza.tipo_paso_id',$tipo_paso->id)
        //             ->whereIn('pasos_alianza.user_id',array_column($validadoresXelPaso, 'user_id')) 
        //             ->groupBy('pasos_alianza.user_id')
        //             ->orderBy('pasos_alianza.id','asc')
        //             ->select(DB::raw('max(pasos_alianza.id) AS id_paso'));
        //         //echo '$ultimasValidaciones->toSql(): <br>';
        //         //echo $ultimasValidaciones->toSql().' |$alianzaId:'.$alianzaId.' |$tipo_paso->id:'.$tipo_paso->id.' |$validadoresXelPaso:'.implode(',',array_column($validadoresXelPaso, 'user_id'));
        //         //echo '<hr>';
        //         $ultimasValidaciones = $ultimasValidaciones->pluck('id_paso');

        //         //filtrar las validaciones que han hecho los usuarios de la lista anterior segun el paso y la alianza (pasos_alianza) ($request['paso'], $request['alianzaId'])
        //         $yaValidaron = \App\Models\Validation\PasosAlianza::join('estado', 'pasos_alianza.estado_id', '=', 'estado.id')
        //             ->join('user_tipo_paso', 'pasos_alianza.user_id', '=', 'user_tipo_paso.user_id')
        //             ->where('pasos_alianza.alianza_id',$alianzaId)
        //             ->where('pasos_alianza.tipo_paso_id',$tipo_paso->id)
        //             ->whereIn('pasos_alianza.user_id',array_column($validadoresXelPaso, 'user_id'))
        //             ->whereIn('pasos_alianza.id',$ultimasValidaciones)
        //             ->groupBy('pasos_alianza.id')
        //             ->orderBy('user_tipo_paso.orden','asc')
        //             ->select('pasos_alianza.*','estado.nombre','user_tipo_paso.orden','user_tipo_paso.titulo');
        //         //echo $yaValidaron->toSql().' |$alianzaId:'.$alianzaId.' |$tipo_paso->id:'.$tipo_paso->id.' |$validadoresXelPaso:'.implode(',',array_column($validadoresXelPaso, 'user_id')).' |$ultimasValidaciones:'.$ultimasValidaciones;
        //         $yaValidaron = $yaValidaron->get();

        //         //si existen registros de validaciones comprobar el estado
        //         if ( count($yaValidaron) ) {
        //             //$listaValidadores = array_column($validadoresXelPaso, 'user_id');
        //             $listaValidadores = $validadoresXelPaso;
        //             $retornoListaValidadores = $validadoresXelPaso;
        //             $no_continuar = 0;
        //             foreach ($yaValidaron as $validacion) {
        //                 //si el estado de la ultima validacion no es APROBADO entonces no permitir continuar y mostrar los mensajes correspondientes
        //                 if ($validacion->estado_id != $estadoAprobadoId) {
        //                     $retornoMsg = 'No puede continuar, en el paso \''.$tipo_paso->titulo.'\' el validador \''.$validacion->titulo.'\' registró el estado: '.$validacion->nombre;
        //                     if ($validacion->observacion != '') {
        //                         $retornoMsg .= ' y la siguiente observación: \''.$validacion->observacion.'\'.';
        //                     }
        //                     array_push($retorno['msg'], $retornoMsg.' <br>');
        //                     $no_continuar++;
        //                 }
        //                 //quitar el id del usuario del array para saber quienes no han validado aún
        //                 if ( in_array($validacion->user_id, array_column($listaValidadores, 'user_id')) ) {
        //                     unset($retornoListaValidadores[array_search($validacion->user_id, array_column($listaValidadores, 'user_id'))]);
        //                 }
        //             }
        //             //si quedan elementos en el array $retornoListaValidadores quiere decir que faltan validadores por hacer la revision
        //             if ( count($retornoListaValidadores) ) {
        //                 $retornoMsg = 'No puede continuar, el paso \''.$tipo_paso->titulo.'\' no ha sido revizado aún por los siguientes validadores: \''.implode("', '", array_column($retornoListaValidadores, 'titulo')).'\'. <br>';
        //                 array_push($retorno['msg'], $retornoMsg);
        //                 $retorno['retorno'] = 'no_continuar';
        //             }else{
        //                 $retorno['retorno'] = true;
        //             }

                    
        //         }elseif( count($validadoresXelPaso) ){
        //             $retorno['retorno'] = 'no_continuar';
        //             array_push($retorno['msg'], 'No puede continuar, los validadores no han aprobado el paso \''.$tipo_paso->titulo.'\'.');
        //         }else{
        //             $retorno['retorno'] = true;
        //         }
        //         break;
        // }

        end:
        return $retorno;
    }


    /**
     * @param $busqueda
     * @return mixed
     */
    public function comprobarValidacion($tipo, $request)// 'alianza',[alianzaId,estado_id,paso,user_id]
    {   
        
        $retorno = array();
        $retorno['ok'] = true;

        $errors = 0;
        $returnMsg = '';
        $errorMsg = '';

        $paso_recibido = 0;
        $tipo_paso_nombre = '';
        $alianzaId = 0;
        $iniciativaId = 0;
        $inscripcionId = 0;
        $validaciones = array();
        $ultimas_validaciones = array();
        $nombreTabla = 'pasos_alianza';

        switch ($tipo) {
            case 'alianza':
                if (isset($request['alianzaId'])) {
                    $alianzaId = $request['alianzaId'];

                    $validaciones = \App\Models\Validation\PasosAlianza::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_alianza.user_id')
                            ->select('pasos_alianza.*')
                            ->where('alianza_id',$alianzaId);

                    $nombreTabla = 'pasos_alianza';

                    //echo '$alianzaId:'.$alianzaId.'$validadores:'.implode(",", array_column($validadores, 'user_id')).'$estadosValidadores:'.implode(",", array_column($estadosValidadores, 'id')).'$validaciones:'.$validaciones->toSql();
                    
                }else{
                    $retorno['ok'] = false;
                    $errors += 1;
                    $returnMsg = 'No se recibio el identificador de la alianza.';
                    goto end;
                }
                $tipo_paso_nombre = '_alianza';

                break;
            case 'iniciativa':
                if (isset($request['iniciativaId'])) {
                    $iniciativaId = $request['iniciativaId'];

                    $validaciones = \App\Models\Validation\PasosIniciativa::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_iniciativa.user_id')
                            ->select('pasos_iniciativa.*')
                            ->where('iniciativa_id',$iniciativaId);

                    $nombreTabla = 'pasos_iniciativa';

                    //echo '$iniciativaId:'.$iniciativaId.'$validadores:'.implode(",", array_column($validadores, 'user_id')).'$estadosValidadores:'.implode(",", array_column($estadosValidadores, 'id')).'$validaciones:'.$validaciones->toSql();
                    
                }else{
                    $retorno['ok'] = false;
                    $errors += 1;
                    $returnMsg = 'No se recibio el identificador de la iniciativa.';
                    goto end;
                }
                $tipo_paso_nombre = '_iniciativa';
                
                break;
            case 'inscripcion':
                if (isset($request['inscripcionId'])) {
                    $inscripcionId = $request['inscripcionId'];

                    $validaciones = \App\Models\Validation\PasosInscripcion::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_inscripcion.user_id')
                            ->select('pasos_inscripcion.*')
                            ->where('inscripcion_id',$inscripcionId);

                    $nombreTabla = 'pasos_inscripcion';

                    //echo '$inscripcionId:'.$inscripcionId.'$validadores:'.implode(",", array_column($validadores, 'user_id')).'$estadosValidadores:'.implode(",", array_column($estadosValidadores, 'id')).'$validaciones:'.$validaciones->toSql();
                }else{
                    $retorno['ok'] = false;
                    $errors += 1;
                    $returnMsg = 'No se recibio el identificador de la inscripcion.';
                    goto end;
                }
                $tipo_paso_nombre = '_interchange';

                break;
        }
        
        $roleValidador = \App\Models\Admin\Role::where('name','validador')->pluck('id');

        $existenValidadores = UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
            ->where('tipo_paso.nombre','like','%'.$tipo_paso_nombre)
            ->where('model_has_roles.role_id',$roleValidador)
            ->orderBy('user_tipo_paso.tipo_paso_id','asc')
            ->orderBy('user_tipo_paso.orden','asc');

        //echo $existenValidadores->toSql().'$tipo_paso_nombre:'.$tipo_paso_nombre.'$roleValidador:'.$roleValidador;
        $existenValidadores = $existenValidadores->select('user_tipo_paso.user_id','user_tipo_paso.id','user_tipo_paso.tipo_paso_id')->get();

        //print_r($existenValidadores);
        if( count($existenValidadores) ){

            
            $estado_recibido = \App\Models\Estado::where('id',$request['estado_id'])->select('id','nombre','uso')->first();
            $paso_recibido = \App\Models\TipoPaso::where('nombre','paso'.$request['paso'].$tipo_paso_nombre)->pluck('id')->first();

            //lista de las ultimas validaciones de cada usuario, para que no se repita 
            $validadores = $existenValidadores->toArray();
            $estadosValidadores = \App\Models\Estado::where('uso','VALIDATOR')->select('id','nombre')->get()->toArray();

            $validaciones = $validaciones->whereIn('estado_id',array_column($estadosValidadores, 'id'))
                ->whereIn($nombreTabla.'.user_id',array_column($validadores, 'user_id'))
                ->where($nombreTabla.'.tipo_paso_id','<=',$paso_recibido)
                ->orderBy('user_tipo_paso.orden','asc')
                ->orderBy($nombreTabla.'.updated_at','asc');

            //echo 'array_column($estadosValidadores, id):'.implode(", ", array_column($estadosValidadores, 'id') ).'array_column($validadores, user_id):'.implode(", ", array_column($validadores, 'user_id') ).'$paso_recibido:'.$paso_recibido.'$validaciones->toSql():'.$validaciones->toSql();

            $validaciones = $validaciones->get();
            
            if( count($validaciones) ){
                $estadoAprobado = array_search('APROBADO', array_column($estadosValidadores, 'nombre'));
                //$validaciones trae una lista con todas las entradas de los validadores de pasos <= al actual, se recorre toda la lista y al final se obtienen solo las ultimas validacionces por cada validador
                foreach ($validaciones as $validacion) {
                    $ultimas_validaciones[$validacion->user_id] = $validacion->estado_id;
                    //echo '$ultimas_validaciones['.$validacion->user_id.'] = '.$validacion->estado_id.' <br>';
                }
                //print_r($validadores);
                $orden_ultimas_validaciones = array();
                //$validadores trae la lista de todos los validadores asignados al proceso ( %_alianza|%_inscripcion|%_iniciativa ) ordenados por el campo 'orden', luego verifica que cada uno haya validado y reordena la lista $ultimas_validaciones
                foreach ($validadores as $keyValidadores => $valueValidadores ) {
                    //print_r($valueValidadores);
                    //valida en primer lugar que exista validacion segun el orden 
                    $yaValido = array_key_exists($validadores[$keyValidadores]['user_id'], $ultimas_validaciones);
                    $yaValidoAntes = array_key_exists($request['user_id'], $ultimas_validaciones);

                    if ($yaValido === false) {
                        if ($yaValidoAntes === false) {
                            if ($validadores[$keyValidadores]['user_id'] != $request['user_id']) {
                                $errors += 1;
                                $msg = 'No es su turno de validación en el paso '.$request['paso'].'.';
                                if ($tipo == 'alianza') {
                                    $msg = 'No es su turno de validación.';
                                }
                                $returnMsg = $msg;
                                goto end;
                            }else{
                                break;
                            }
                        }
                    }else{
                        $orden_ultimas_validaciones[$validadores[$keyValidadores]['user_id']] = $ultimas_validaciones[$validadores[$keyValidadores]['user_id']];
                    }
                }
                $ultimas_validaciones = $orden_ultimas_validaciones;
                //$ultimas_validaciones tiene la lista de los ultimos registros por cada validador, listados por el orden de validacion determinado, si el validador actual ya registro la misma validacion no lo deja continuar, al igual que si un validador anterior no registro una aprobacion 
        
                foreach ($ultimas_validaciones as $keyUltimas => $valueUltimas ) {
                    if ($keyUltimas == $request['user_id']) {
                        if($valueUltimas == $estado_recibido->id){
                            $errors += 1;
                            $errorMsg = 'error_ya_registro';
                            $msg = 'Ya se registró su validación en el paso '.$request['paso'].'.';
                            if ($tipo == 'alianza') {
                                $msg = 'Ya se registró su validación.';
                            }
                            $returnMsg = $msg;
                            goto end;
                        }else{
                            break;
                        }

                    }else{
                        if($valueUltimas != $estadosValidadores[$estadoAprobado]['id']){
                            $errors += 1;
                            $msg = 'No es su turno de validación en el paso '.$request['paso'].'.';
                            if ($tipo == 'alianza') {
                                $msg = 'No es su turno de validación.';
                            }
                            $returnMsg = $msg;
                            goto end;
                        }
                    }
                }

            }
        }

        end:
        if ($errors > 0) {
            $retorno['ok'] = false;
            $retorno['errors'] = $errors;
            $retorno['error_msg'] = $errorMsg;
            $retorno['returnMsg'] = $returnMsg;
            //print_r($retorno);
        }

        return $retorno;
    }
    /**
     * @param $busqueda
     * @return mixed
     */
    public function notificarValidador($tipo, $request)
    {   
        $retorno = false;
        $errors = 0;
        $returnMsg = [];

        $subject = array();
        $content = array();
        $idTablaPaso = '';
        $UserPasoActual = 0;
        $UserPasoSiguiente = array();
        $UserPasoAnterior = array();
        $siguienteValidador = array();
        $anterioresValidadores = array();
        $numValidadoresPosteriores = 0;
        $paso_recibido = 0;
        $tipo_paso_nombre = '';
        $alianzaId = 0;
        $iniciativaId = 0;
        $inscripcionId = 0;
        $datosInscripcion = '';
        $tipo_mail = 'validador';
        $crearTipo = 'nuevo';
        $tipo_link_boton = 'validador';
        $validaciones = array();
        $ultimas_validaciones = array();

        // DB::beginTransaction();

        if (!isset($request['user_id']) ) {
            $retorno = false;
            $errors += 1;
            array_push($returnMsg, 'No se recibio el identificador del usuario.');
            goto end;
        }

        switch ($tipo) {
            case 'alianza':
                if (isset($request['alianzaId'])) {
                    $alianzaId = $request['alianzaId'];
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la alianza.');
                    goto end;
                }
                $tipo_paso_nombre = '_alianza';

                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la alianza #'.$request['alianzaId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva alianza por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la subscripción la alianza #'.$request['alianzaId'];
                $content['no_aprobado'] = 'El resulatdo de la revisión es {estado_recibido_nombre} con la siguiente observación: <br> '.$request['observacion'].' <br> <br> Por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la alianza #'.$request['alianzaId'].' se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la alianza #'.$request['alianzaId'].' ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la alianza #'.$request['alianzaId'].' se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la alianza #'.$request['alianzaId'].'!! <br> <br> Superó todas las revisiones y puede continuar.';

                break;
            case 'iniciativa':
                if (isset($request['iniciativaId'])) {
                    $iniciativaId = $request['iniciativaId'];
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la iniciativa.');
                    goto end;
                }
                $tipo_paso_nombre = '_iniciativa';
                
                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la iniciativa '.$request['iniciativaId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la iniciativa '.$request['iniciativaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva iniciativa por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la iniciativa '.$request['iniciativaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la inscripción de la iniciativa '.$request['iniciativaId'];
                $content['no_aprobado'] = 'El resulatdo de la revisión es {estado_recibido_nombre} con la siguiente observación: <br> '.$request['observacion'].' <br> <br> Por favor verifique los datos del tramite de la iniciativa '.$request['iniciativaId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la iniciativa '.$request['iniciativaId'].' se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la iniciativa '.$request['iniciativaId'].' ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la iniciativa '.$request['iniciativaId'].' se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la iniciativa '.$request['iniciativaId'].'!! <br> <br> Superó todas las revisiones y puede continuar.';

                break;
            case 'inscripcion':
                if (isset($request['inscripcionId'])) {
                    $inscripcionId = $request['inscripcionId'];
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la inscripcion.');
                    goto end;
                }
                $tipo_paso_nombre = '_interchange';

                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la inscripcion '.$request['inscripcionId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la inscripcion '.$request['inscripcionId'].' para una movilidad que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva inscripcion por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la inscripcion '.$request['inscripcionId'].' para una movilidad que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la inscripción '.$request['inscripcionId'].' para una movilidad';
                $content['no_aprobado'] = 'El resulatdo de la revisión es {estado_recibido_nombre} con la siguiente observación: <br> '.$request['observacion'].' <br> <br> Por favor verifique los datos del tramite de la inscripcion '.$request['inscripcionId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la inscripcion '.$request['inscripcionId'].' para una movilidad se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la inscripcion '.$request['inscripcionId'].' para una movilidad ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la inscripcion '.$request['inscripcionId'].' para una movilidad se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la inscripcion '.$request['inscripcionId'].' para una movilidad!! <br> <br> Superó todas las revisiones y puede continuar.';

                break;
        }

        //cambiar el mensaje si se ha modificado información en el pre-registro
        if ( isset($request['modificar']) ) {
            $subject['primer_validador'] = $subject['siguiente_validador'];
            $content['primer_validador'] = $content['siguiente_validador'];
        }
        
        $roleValidador = \App\Models\Admin\Role::where('name','validador')->pluck('id');

        $existenValidadores = UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
            ->where('tipo_paso.nombre','like','%'.$tipo_paso_nombre)
            ->where('model_has_roles.role_id',$roleValidador)
            ->orderBy('user_tipo_paso.tipo_paso_id','asc')
            ->orderBy('user_tipo_paso.orden','asc');

        //echo $existenValidadores->toSql().'$tipo_paso_nombre:'.$tipo_paso_nombre.'$roleValidador:'.$roleValidador;
        $existenValidadores = $existenValidadores->select('user_tipo_paso.user_id','user_tipo_paso.id','user_tipo_paso.tipo_paso_id')->get();

        //print_r($existenValidadores);
        if( count($existenValidadores) ){

            $estados = \App\Models\Estado::get()->toArray();
            $estadoAlianzaEnproceso = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'EN PROCESO');
            });
            $estado_id = $request['estado_id'];
            $estado_recibido = array_filter($estados, function($var) use ($estado_id){
                // Retorna siempre que el número entero sea par
                return ($var['id'] == $estado_id);
            });
            $estadoAlianzaActiva = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
            });
            $estadoModificarAlianza = '';
            $fecha_inicio = NULL;

            reset($estadoAlianzaEnproceso);
            $keyEstadoEnproceso = key($estadoAlianzaEnproceso);
            reset($estado_recibido);
            $keyEstadoRecibido = key($estado_recibido);
            reset($estadoAlianzaActiva);
            $keyEstadoActiva = key($estadoAlianzaActiva);

            $estadoModificarAlianza = $estadoAlianzaEnproceso[$keyEstadoEnproceso]['id'];

            $paso_recibido = \App\Models\TipoPaso::where('nombre','paso'.$request['paso'].$tipo_paso_nombre)->pluck('id')->first();

            
            //si el estado es EN REVISIÓN no envia notificacion
            if ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'EN REVISIÓN' || $estado_recibido[$keyEstadoRecibido]['nombre'] == 'GENERAR DOCUMENTO' ) {
                if ($tipo == 'alianza') {
                    \App\Models\Alianza::where('id',$alianzaId)->update(['estado_id' => $estadoModificarAlianza]);
                }

                $retorno = true;
                goto end;
            }

            //$estado = \App\Models\Estado::where('nombre','APROBADO')->select('id','nombre')->first();
            if (!count($estado_recibido)) {
                $errors += 1;
                array_push($returnMsg, 'No se recibio el estado del registro de validación del paso '.$request['paso'].'.');
                goto end;
            }

            $validadorActual = false;
            $encontroValidador = 1;
            //ciclo que recorre la lista de validadores guarda los id's  
            foreach ($existenValidadores as $existeValidador) {
                //verificar si hay validadores en el paso actual
                if( $existeValidador->tipo_paso_id == $paso_recibido ){
                    //guarda el valor del id de user_tipo_paso.id del validador actual en el caso que solo exista un validador por el paso
                    // $UserPasoActual = $existeValidador->id;
                    if ($estado_recibido[$keyEstadoRecibido]['uso'] == 'USER' || $estado_recibido[$keyEstadoRecibido]['uso'] == 'EXTERNAL' ) {
                        //selecciona el primer validador para que sea notificado
                        
                        $siguienteValidador[] = $existeValidador->user_id;
                        $UserPasoSiguiente[] = $existeValidador->id;

                        break; 
                    }
                    //si en la iteracion anterior se encontro al validador actual entonces este es el siguiente validador que hay que notificar
                    if( $validadorActual == true ){
                        //selecciona el siguiente validador para que sea notificado
                        $siguienteValidador[] = $existeValidador->user_id;
                        $UserPasoSiguiente[] = $existeValidador->id;
                        break; 
                    }else{
                        $encontroValidador = 0;
                    }
                    //si se encuentra al validador actual cambia el valor de $validadorActual para efectuar las acciones en la siguiente iteracion
                    if( $existeValidador->user_id == $request['user_id'] ){
                        //guarda el valor del id de user_tipo_paso.id del validador actual para asociarle el email
                        $UserPasoActual = $existeValidador->id;
                        $validadorActual = true;
                    }else{
                        //va guardando los validadores anteriores al actual
                        $anterioresValidadores[] = $existeValidador->user_id;
                        $UserPasoAnterior[] = $existeValidador->id;
                    }
                }elseif ($validadorActual == true && $existeValidador->tipo_paso_id != $paso_recibido) {
                    //verificar si se encontro el validador en el paso recibido pero hay mas validadores en pasos posteriores
                    $numValidadoresPosteriores++;
                }

// echo '$request[paso]:'.$request['paso'].'  ';
// echo '$existeValidador->tipo_paso_id:'.$existeValidador->tipo_paso_id.'  $paso_recibido:'.$paso_recibido;
// echo '<br>';
// echo '$encontroValidador:'.$encontroValidador.'  count($siguienteValidador):'.count($siguienteValidador).'  estado_recibido[$ keyEstadoRecibido] ["uso"]:'.$estado_recibido[$keyEstadoRecibido]['uso'].'  $estado_recibido[$keyEstadoRecibido]["nombre"]:'.$estado_recibido[$keyEstadoRecibido]['nombre'];
// echo '<br>';

            }

            //si no hay mas validadores notificar a todos los interesados del fin exitoso del tramite
            //if ( ($encontroValidador === 0  && !count($siguienteValidador) && $estado_recibido[$keyEstadoRecibido]['nombre'] != 'APROBADO' && $estado_recibido[$keyEstadoRecibido]['uso'] != 'USER') ) {
            // if ( ($encontroValidador === 0  && !count($siguienteValidador) && $estado_recibido[$keyEstadoRecibido]['uso'] != 'USER') ) {
            if ( $encontroValidador === 0  && $estado_recibido[$keyEstadoRecibido]['uso'] != 'USER' ) {
            //buscar si hay validadores en el paso actual y anteriores

                // if (  $estado_recibido[$keyEstadoRecibido]['nombre'] == 'ACTIVA' || $estado_recibido[$keyEstadoRecibido]['nombre'] != 'APROBADO' ) {
                    if ($tipo == 'alianza') {

                        //agregar a los interesados faltantes, ya estan los validadores, faltan los coordinadores de la alianza
                        //buscar los coordinadores (interno y externo)
                        $roleCoordinadorInterno = Role::where('name','coordinador_interno')->pluck('id')->first();
                        //$roleCoordinadorExterno = Role::where('name','coordinador_externo')->pluck('id')->first();

                        $dataCoordinadores = DB::table('alianza')
                                ->join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                                ->join('users', 'alianza_user.user_id', '=', 'users.id')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->where('alianza.id',$alianzaId )
                                //->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno,$roleCoordinadorExterno] )
                                ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno] )
                                ->select('users.id AS usuario_id')
                                ->orderBy('users.id','asc')
                                ->get()->toArray();

                        $anterioresValidadores = array_merge($anterioresValidadores, array_column($dataCoordinadores, 'usuario_id'));
                        //se sociara a la tabla user_tipo_paso (donde estan asignados los validadores y los pasos) tomando el id donde esta asociado el validador actual
                        $idTablaPaso = $UserPasoActual;
                        $tipo_link_boton = 'interesados';

                        if ( $estado_recibido[$keyEstadoRecibido]['nombre'] != 'APROBADO' && $estado_recibido[$keyEstadoRecibido]['nombre'] != 'ACTIVA') {

                            //cambiar el estado de los emails de la tabla mails vinculados a travez de pasos_alianza_mail y user_tipo_paso_mail con la alianza en el caso que el estado no sea aprobado, es decir RECHAZADO
                            $pasos_alianza_mail_id = \App\Models\Validation\PasosAlianza::join('pasos_alianza_mail','pasos_alianza.id','pasos_alianza_mail.pasos_alianza_id')
                                ->where('pasos_alianza.alianza_id',$alianzaId)->select('pasos_alianza_mail.mail_id','pasos_alianza.id AS pasos_alianza_id')->get()->toArray();
///////////////////// definir si al momento de rechazar la validacion se continua desde el paso y usuario que rechazo o se vuelve a comenzar
                            if (!count($pasos_alianza_mail_id)) {
                                $pasos_alianza_mail_id = array( array('mail_id' => 0) );
                            }

                            //se debe recibir el id del usuario que creo los emails, en este caso del coordinador_externo
                            $user_tipo_paso_mail_id = \App\Models\Validation\UserPaso::join('user_tipo_paso_mail','user_tipo_paso.id','user_tipo_paso_mail.user_tipo_paso_id')
                                ->where('user_tipo_paso_mail.user_id',$request['user_id'])->select('user_tipo_paso_mail.mail_id')->pluck('mail_id')->toArray();

                            if (!count($user_tipo_paso_mail_id)) {
                                $user_tipo_paso_mail_id = array();
                            }

                            $mails_id = array_merge(array_column($pasos_alianza_mail_id, 'mail_id'),$user_tipo_paso_mail_id);

                            $cambio_estado_mails = \App\Models\Mail::whereIn('id', $mails_id)
                                ->update(['estado' => 0]);

                            $estadoModificarAlianza = $estadoAlianzaEnproceso[$keyEstadoEnproceso]['id'];
                        }


                    }elseif ($tipo == 'inscripcion') {
                        
                        //agregar a los interesados faltantes, ya estan los validadores, falta el estudiante y el postulante de la inscripcion
                        //buscar al estudiante y al postulante

                        //buscar la inscripcion
                        $datosInscripcion = \App\Models\Inscripcion::where('id',$inscripcionId )->first();
                        
                        //buscar el usuario del estudiante de la inscripcion
                        $estudianteInscripcion = \App\User::where('users.id',$datosInscripcion->user_id )
                            ->select('users.id')->first();

                        //buscar el usuario del postulante (coordinador) de la inscripcion
                        $postulanteInscripcion = \App\Models\Postulacion::join('users', 'postulacion.user_id', '=', 'users.id')
                            ->where('postulacion.inscripcion_id',$inscripcionId )
                            ->select('users.id')->first();
                        if ($estudianteInscripcion->id == $postulanteInscripcion->id) {
                            $anterioresValidadores = array_merge($anterioresValidadores, [$estudianteInscripcion->id] );
                        }else{
                            $anterioresValidadores = array_merge($anterioresValidadores, [$estudianteInscripcion->id, $postulanteInscripcion->id] );
                        }
                        //se sociara a la tabla user_tipo_paso (donde estan asignados los validadores y los pasos) tomando el id donde esta asociado el validador actual
                        $idTablaPaso = $UserPasoActual;
                        $tipo_link_boton = 'interesados';

                    }elseif ($tipo == 'iniciativa') {

                        //agregar a los interesados faltantes, ya estan los validadores, falta ... de la iniciativa
                        //buscar a ..

                        $anterioresValidadores = array_merge($anterioresValidadores, [] );
                        //se sociara a la tabla user_tipo_paso (donde estan asignados los validadores y los pasos) tomando el id donde esta asociado el validador actual
                        $idTablaPaso = $UserPasoActual;
                        $tipo_link_boton = 'interesados';
                    }

                    $to_users = \App\User::find($anterioresValidadores);
                    if (!count($to_users)) {
                        $errors += 1;
                        array_push($returnMsg, 'No se encontraron validadores ni coordinadores para el paso '.$request['paso'].'.');
                        goto end;
                    }
                    if ($estado_recibido[$keyEstadoRecibido]['uso'] == 'VALIDATOR' && ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'APROBADO' || $estado_recibido[$keyEstadoRecibido]['nombre'] == 'ACTIVA') ) {
                        //si no hay mas validadores en el paso actual, el estado es APROBADO y hay mas validadores en pasos posteriores entonces cambiar el mensaje porque el proceso continua
                        if ($numValidadoresPosteriores > 0) {
                            //textos para el email
                            $subject['final'] = $subject['si_aprobado'];
                            $content['final'] = $content['si_aprobado'];
                        }else{

                            if(!count($siguienteValidador) ){
                                
                                $estadoModificarAlianza = $estadoAlianzaActiva[$keyEstadoActiva]['id'];
                                $fecha_inicio = new \DateTime('now');

                                $fecha_inicio->format('Y-m-d H:i:s');
                            }

                            //textos para el email
                            $subject['final'] = $subject['todo_aprobado'];
                            $content['final'] = $content['todo_aprobado'];
                            $tipo_link_boton = 'interesados';

                        }
                    }
                // }

            }else{
                if ($estado_recibido[$keyEstadoRecibido]['uso'] == 'VALIDATOR' && $estado_recibido[$keyEstadoRecibido]['nombre'] != 'APROBADO' && $estado_recibido[$keyEstadoRecibido]['nombre'] != 'ACTIVA' ) {

                    //busca al validador para entregar todos los datos a la creacion del email
                    $to_users = \App\User::find($anterioresValidadores);
                    $idTablaPaso = $UserPasoAnterior;
                }else {
                    //busca al validador para entregar todos los datos a la creacion del email
                    $to_users = \App\User::find($siguienteValidador);
                    $idTablaPaso = $UserPasoSiguiente;

                }

                if (!count($to_users)) {
                    $errors += 1;
                    array_push($returnMsg, 'No se encontraron validadores para el paso '.$request['paso'].'.');
                    goto end;
                }
                //print_r($to_users);
                
            }

            if ($estado_recibido[$keyEstadoRecibido]['uso'] == 'USER' || $estado_recibido[$keyEstadoRecibido]['uso'] == 'EXTERNAL' ) {

                //textos para el email
                $subject['final'] = $subject['primer_validador'];
                $content['final'] = str_replace('{user_name}', $to_users[0]->name, $content['primer_validador']);


            }elseif ($estado_recibido[$keyEstadoRecibido]['uso'] == 'VALIDATOR' ) {
                
                if ($estado_recibido[$keyEstadoRecibido]['nombre'] != 'APROBADO' && $estado_recibido[$keyEstadoRecibido]['nombre'] != 'ACTIVA' ) {
                    if ($tipo == 'alianza') {
                        $estadoModificarAlianza = $estadoAlianzaEnproceso[$keyEstadoEnproceso]['id'];
                    }
                    //NO APROBADO
                        //verificar si hay validadores en el paso actual (en orden descentente) y anteriores
                        //buscar los coordinadores (interno y externo)

                    //textos para el email
                    $subject['final'] = $subject['no_aprobado'];
                    $content['final'] = str_replace('{estado_recibido_nombre}', $estado_recibido[$keyEstadoRecibido]['nombre'], $content['no_aprobado']);

                }elseif ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'APROBADO' || $estado_recibido[$keyEstadoRecibido]['nombre'] == 'ACTIVA' ) {
                    
                    //SI APROBADO
                        //verificar si hay validadores (en orden ascentente)
                        //enviar notificacion al siguiente validador

                        //si no hay mas validadores notificar a todos los interesados del fin exitoso del tramite
                        //buscar si hay validadores en el paso actual (en orden descentente) y anteriores
                        //buscar los coordinadores (interno y externo)
                    if (!isset($subject['final'])) {

                        //textos para el email
                        $subject['final'] = $subject['siguiente_validador'];
                        $content['final'] = str_replace('{user_name}', $to_users[0]->name, $content['siguiente_validador']);
                    }

                }

                //MODIFICA EL ESTADO DE LA ALIANZA
                if ($tipo == 'alianza') {

                    $modificar_alianza = \App\Models\Alianza::find($alianzaId);
                    $modificar_alianza->estado_id = $estadoModificarAlianza;
                    $modificar_alianza->fecha_inicio = $fecha_inicio;
                    $modificar_alianza->save();

                }

            }
            /*
            //anterior metodo, filtraba los que no habian APROBADO la revision y enviaba la nitificacion al siguiente 
            $estadosValidadores = \App\Models\Estado::where('uso','VALIDATOR')->pluck('id')->toArray();

            $yaRevisaron = \App\Models\Validation\PasosAlianza::whereIn('user_id',$existenValidadores)
                    ->where('alianza_id',$request['alianzaId'])
                    ->whereIn('estado_id',$estadosValidadores)->get();

            if( count($yaRevisaron) ){
                foreach ($yaRevisaron as $yaReviso) {
                    if( $yaReviso->estado_id == $estado->id ){
                        //'quita' los usuarios que ya validaron con el estado APROBADO
                        $existenValidadores = array_diff($existenValidadores, array($yaReviso->user_id));
                    }
                }
            }

            //print_r($existenValidadores);
            if( !count($existenValidadores) ){
                $retorno = true;
                goto end;
            }
            //se va a filtrar solo el primero en la lista de los validadores, va a ser uno por uno
            reset($existenValidadores);
            $first_key = key($existenValidadores);
            $siguienteValidador[$first_key] = $existenValidadores[$first_key];

            $to_users = \App\User::find($siguienteValidador);
            if (!count($to_users)) {
                $retorno = 'error_to_users';
                goto end;
            }
            */

            

            $tipo_paso = $paso_recibido;
            $roleCopiaEmails = Role::where('name','copia_oculta_email')->pluck('id');
            //buscar el email del usuario asignado para recibir una copia oculta de los emails
            $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                ->where('model_has_roles.role_id',$roleCopiaEmails )
                ->select('users.name', 'users.email')->first();
            
            //print_r($siguienteValidador);
            //goto end;

            //QUEDA FIJO EL VALOR DE $idTablaPaso QUE CORRESPONDE AL ID DE LA TABLA user_tipo_paso DONDE ESTA ASIGNADO EL VALIDADOR ACTUAL Y DONDE SERA ASOCIADO EL EMAIL QUE SE VA A CREAR Y ENVIAR
            //$idTablaPaso = $UserPasoActual;
            //trait mail valida si la variable 'paso' no esta vacia para buscar en la tabla user_tipo_paso
            


            if (is_array($idTablaPaso) && count($idTablaPaso) == 1) {
                $idTablaPaso = $idTablaPaso[0];
                $UserPasoId = [$idTablaPaso];
            }elseif (is_array($idTablaPaso) ) {
                $UserPasoId = $idTablaPaso;
            }else{
                $UserPasoId = [$idTablaPaso];
            }
            

            $datos['paso'] = $idTablaPaso;
            $datos['user_id'] = $request['user_id'];
            $datos['to'] = $to_users;
            //esto es temporal, no siempre se deberia copiar al correo de la aplicacion
            $datos['cc'] = '';
            $datos['bcc'][0] = $copia_oculta_email;

            $datos['subject'] = $subject['final'];
            $datos['content'] = $content['final'];
            if (!isset($request['archivo_documentos'])) {
                $request['archivo_documentos'] = '';
            }
            $datos['archivosAdjuntos'] = $request['archivo_documentos'];
            $archivosAdjuntos = $request['archivo_documentos'];

            //valida si existe el registro del email con el mismo usuario remitente y lo actualiza en lugar de crear mas registros
            $userPaso_mail_id = \App\Models\Validation\UserPaso::join('user_tipo_paso_mail','user_tipo_paso.id','user_tipo_paso_mail.user_tipo_paso_id')
                        ->join('mail','mail.id','user_tipo_paso_mail.mail_id')
                        ->whereIn('user_tipo_paso.id',$UserPasoId)
                        ->where('user_tipo_paso_mail.user_id',$request['user_id'])
                        ->where('mail.subject',$datos['subject'])
                        ->select('user_tipo_paso_mail.mail_id')->pluck('mail_id');
            //agrega el id del mail y cambiar el tipo de creacion
            if ( count($userPaso_mail_id) ) {
                $datos['id'] = $userPaso_mail_id;
                $crearTipo = 'actualizar';
            }
            
            $datos['crearTipo'] = $crearTipo;

            //$crearMail = $this->crearMail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);

            //se cambia porque segun el tipo de mail busca el registro para asociar el mail y si se envia como tipo al valor de $tipo_mail va a buscar en la tabla incorrecta y debe buscar en user_tipo_paso por eso siempre debe ser 'validador'
            //$crearMail = $this->crearMail($tipo_mail,$datos); 
            // echo '$tipo_mail:'.$tipo_mail.'<br>';
            // print_r($datos);
            $crearMail = $this->crearMail($tipo_mail,$datos);
            if ( $crearMail == 'error_mail' ) {
                $retorno = $crearMail;
                $errors += 1;
                array_push($returnMsg, 'No se puede crear el e-mail de notificación del paso '.$request['paso'].' para el validador.');
                goto end;
            }elseif ( $crearMail == 'error_paso' ) {
                $retorno = $crearMail;
                $errors += 1;
                array_push($returnMsg, 'No se encuentra el registro, no se puede crear el e-mail de notificación del paso '.$request['paso'].' para el validador.');
                goto end;
            }elseif ( $crearMail == 'error_user' ) {
                $retorno = $crearMail;
                $errors += 1;
                array_push($returnMsg, 'No se encuentra el validador, no se puede crear el e-mail de notificación del paso '.$request['paso'].' para el validador.');
                goto end;
            }elseif ( $crearMail == 'error_tipo_mail' || $crearMail == 'error_crear_tipo' ) {
                $retorno = $crearMail;
                $errors += 1;
                array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el e-mail de notificación del paso '.$request['paso'].' para el validador.');
                goto end;
            }elseif ($crearMail === false) {
                $retorno = $crearMail;
                $errors += 1;
                array_push($returnMsg, 'Ocurrio un error al crear el e-mail de notificación del paso '.$request['paso'].' al validador.');
                goto end;
            }else{

                $dataMail = $crearMail[0];
                if (empty($crearMail[0]) ) {
                    $dataMail = $crearMail;
                }
                // print_r($dataMail);

                if ($tipo == 'alianza') {
                    $token_alianza = \App\Models\Alianza::where('id',$request['alianzaId'])->select('token')->first(); 
                    $dataMail->token_alianza = $token_alianza->token;
                }
                
                if ($tipo == 'iniciativa') {
                    $iniciativaId = \App\Models\Iniciativa::where('id',$request['iniciativaId'])->select('id')->first(); 
                    $dataMail->iniciativaId = $iniciativaId->id;
                }
                
                if ($tipo == 'inscripcion') {
                    $inscripcionId = \App\Models\inscripcion::where('id',$request['inscripcionId'])->select('id')->first(); 
                    $dataMail->inscripcionId = $inscripcionId->id;
                }

                //para saber si el link del boton que aparece en el email sera hacia una validacion o hacia el registro del proceso
                $request['tipo_link_boton'] = $tipo_link_boton;
                $request['tokenmail'] = $dataMail->tokenmail;
                $request['proceso_origen'] = $tipo;
                $request['enviar'] = true;
                $request['peticion'] = 'local';
                $request['dataMail'] = $dataMail;
                $request['archivosAdjuntos'] = $archivosAdjuntos;

                $enviarMail = $this->enviarMail($tipo_mail, $request);
                $retorno = $enviarMail;
                
            }

            //$existeMail->estado = 1;
            //$existeMail->save();

            
            /*
            if ( !$this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId) ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede registrar del paso '.$request['paso'].' para la alianza.');
                goto end;
            }
            */
            //return $crearMail;
        }else{
            $retorno = true;
        }


        end:
// print_r($returnMsg);
        if ($errors > 0) {
            // DB::rollBack();
            $retorno = array();
            $retorno['ok'] = false;
            $retorno['errors'] = $errors;
            $retorno['returnMsg'] = $returnMsg;
            //print_r($retorno);
        }else{
            // DB::commit();
        }
        return $retorno;
    }
}

