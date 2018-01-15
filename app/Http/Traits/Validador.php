<?php

namespace App\Http\Traits;
use DB;
use Illuminate\Support\Facades\Email;
use App\Models\Validation\UserPaso;
use App\Models\Admin\Role;
    
trait Validador{
    

    /**
     * @param $busqueda
     * @return mixed
     */
    public function verValidador($tipo_email,$datos)
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
    public function crearValidador($tipo_email,$datos)
    {

        $retorno = false;


        switch ($tipo_email) {
            
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
        $campus_id = $request['campus_id'];

        switch ($tipo) {
            case 'alianza':
                if (isset($request['alianzaId'])) {
                    $alianzaId = $request['alianzaId'];

                    $validaciones = \App\Models\Validation\PasosAlianza::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_alianza.user_id')
                            ->select('pasos_alianza.*')
                            ->where('alianza_id',$alianzaId);

                    $pasos_por_otros = \App\Models\Validation\PasosAlianza::select('pasos_alianza.*')
                            ->where('alianza_id',$alianzaId);

                    $nombreTabla = 'pasos_alianza';

                    //echo '$alianzaId:'.$alianzaId.'$validadores:'.implode(",", array_column($validadores, 'user_id')).'$estadosValidadores:'.implode(",", array_column($estadosValidadores, 'id')).'$validaciones:'.$validaciones->toSql();
                    
                }else{
                    $retorno['ok'] = false;
                    $errors += 1;
                    $returnMsg = 'No se recibio el identificador de la alianza.';
                    goto end;
                }
                $tipo_paso_nombre = '_interalliance';

                break;
            case 'iniciativa':
                if (isset($request['iniciativaId'])) {
                    $iniciativaId = $request['iniciativaId'];

                    $validaciones = \App\Models\Validation\PasosIniciativa::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_iniciativa.user_id')
                            ->select('pasos_iniciativa.*')
                            ->where('iniciativa_id',$iniciativaId);

                    $pasos_por_otros = \App\Models\Validation\PasosIniciativa::select('pasos_iniciativa.*')
                            ->where('iniciativa_id',$iniciativaId);

                    $nombreTabla = 'pasos_iniciativa';

                    //echo '$iniciativaId:'.$iniciativaId.'$validadores:'.implode(",", array_column($validadores, 'user_id')).'$estadosValidadores:'.implode(",", array_column($estadosValidadores, 'id')).'$validaciones:'.$validaciones->toSql();
                    
                }else{
                    $retorno['ok'] = false;
                    $errors += 1;
                    $returnMsg = 'No se recibio el identificador de la iniciativa.';
                    goto end;
                }
                $tipo_paso_nombre = '_interaction';
                
                break;
            case 'inscripcion':
                if (isset($request['inscripcionId'])) {
                    $inscripcionId = $request['inscripcionId'];

                    $validaciones = \App\Models\Validation\PasosInscripcion::join('user_tipo_paso', 'user_tipo_paso.user_id', '=', 'pasos_inscripcion.user_id')
                            ->select('pasos_inscripcion.*')
                            ->where('inscripcion_id',$inscripcionId);

                    $pasos_por_otros = \App\Models\Validation\PasosInscripcion::select('pasos_inscripcion.*')
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
            ->where('user_tipo_paso.campus_id',$campus_id)
            ->where('tipo_paso.nombre','like','%'.$tipo_paso_nombre)
            ->where('model_has_roles.role_id',$roleValidador)
            ->orderBy('user_tipo_paso.tipo_paso_id','asc')
            ->orderBy('user_tipo_paso.orden','asc');

        //echo $existenValidadores->toSql().'$tipo_paso_nombre:'.$tipo_paso_nombre.'$roleValidador:'.$roleValidador;
        $existenValidadores = $existenValidadores->select('user_tipo_paso.user_id','user_tipo_paso.id','user_tipo_paso.tipo_paso_id')->get();

        //print_r($existenValidadores);
        if( count($existenValidadores) ){

            
            $estado_recibido = \App\Models\Estado::where('id',$request['estado_id'])->select('id','nombre','uso')->first();
            $paso_recibido = \App\Models\TipoPaso::where('id',$request['tipo_paso_id'])->pluck('id')->first();

            //lista de las ultimas validaciones de cada usuario, para que no se repita 
            $validadores = $existenValidadores->toArray();
            $estadosValidadores = \App\Models\Estado::where('uso','VALIDATOR')->select('id','nombre')->get()->toArray();

            //lista de los registros en las tablas pasos_[proceso] estan registrados por los validadores 
            $validaciones = $validaciones->whereIn('estado_id',array_column($estadosValidadores, 'id'))
                ->whereIn($nombreTabla.'.user_id',array_column($validadores, 'user_id'))
                ->where($nombreTabla.'.tipo_paso_id','<=',$paso_recibido)
                ->where($nombreTabla.'.campus_id',$campus_id)
                ->groupBy($nombreTabla.'.id')
                ->orderBy('user_tipo_paso.orden','asc')
                ->orderBy($nombreTabla.'.updated_at','asc');

            //lista de los registros en las tablas pasos_[proceso] estan registrados por los que NO son validadores 
            $pasos_por_otros = $pasos_por_otros->whereNotIn('estado_id',array_column($estadosValidadores, 'id'))
                ->whereNotIn($nombreTabla.'.user_id',array_column($validadores, 'user_id'))
                ->where($nombreTabla.'.tipo_paso_id','<=',$paso_recibido)
                ->where($nombreTabla.'.campus_id',$campus_id)
                ->groupBy($nombreTabla.'.id')
                ->orderBy($nombreTabla.'.updated_at','asc');

            //echo 'array_column($estadosValidadores, id):'.implode(", ", array_column($estadosValidadores, 'id') ).'array_column($validadores, user_id):'.implode(", ", array_column($validadores, 'user_id') ).'$paso_recibido:'.$paso_recibido.'$validaciones->toSql():'.$validaciones->toSql();

            $validaciones = $validaciones->get();
            $pasos_por_otros = $pasos_por_otros->get();
            
            if( count($validaciones) ){
                $estadoAprobado = array_search('APROBADO', array_column($estadosValidadores, 'nombre'));
                //$validaciones trae una lista con todas las entradas de los validadores de pasos <= al actual, se recorre toda la lista y al final se obtienen solo las ultimas validacionces por cada validador
                foreach ($validaciones as $validacion) {
                    $ultimas_validaciones[$validacion->user_id] = $validacion->estado_id;
                    //echo '$ultimas_validaciones['.$validacion->user_id.'] = '.$validacion->estado_id.' <br>';
                }
                //print_r($validadores);
                $orden_ultimas_validaciones = array();
                //$validadores trae la lista de todos los validadores asignados al proceso ( %_interalliance|%_inscripcion|%_iniciativa ) ordenados por el campo 'orden', luego verifica que cada uno haya validado y reordena la lista $ultimas_validaciones
                foreach ($validadores as $keyValidadores => $valueValidadores ) {
                    //print_r($valueValidadores);
                    //valida en primer lugar que exista validacion segun el orden 
                    $yaValido = array_key_exists($validadores[$keyValidadores]['user_id'], $ultimas_validaciones);
                    $yaValidoAntes = array_key_exists($request['user_id'], $ultimas_validaciones);

                    if ($yaValido === false) {
                        if ($yaValidoAntes === false) {
                            if ($validadores[$keyValidadores]['user_id'] != $request['user_id']) {
                                $errors += 1;
                                $msg = 'No es su turno de validación.';
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
                            $msg = 'Ya se registró previamente su validación.';
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
                            $msg = 'No es su turno de validación.';
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
        }else{
            $retorno['validaciones'] = $validaciones->toArray();
            $retorno['pasos_por_otros'] = $pasos_por_otros->toArray();
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
        // $idTablaPaso = '';
        $UserPasoActual = 0;
        $UserPasoSiguiente = array();
        $UserPasoAnterior = array();
        $siguienteValidador = array();
        $anterioresValidadores = array();
        $numValidadoresPosteriores = 0;
        $paso_recibido = 0;
        $tipo_paso_nombre = '';
        $tablaPasos = '';
        $tablaEmailsPasos = '';
        $campoTablaEmailsPasos = '';
        $procesoId = 0;
        $tablaProceso = '';
        $alianzaId = 0;
        $iniciativaId = 0;
        $inscripcionId = 0;
        $datosInscripcion = '';
        $tipo_email = 'validador';
        $crearTipo = 'nuevo';
        $tipo_link_boton = 'validador';
        $validaciones = array();
        $ultimas_validaciones = array();
        $campus_id = $request['campus_id'];

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
                    $procesoId = $request['alianzaId'];
                    $tablaProceso = new \App\Models\Alianza;
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la alianza.');
                    goto end;
                }
                $tipo_paso_nombre = '_interalliance';
                $tablaPasos = new \App\Models\Validation\PasosAlianza;
                $campoProcesoTablaPasos = 'alianza_id';
                $tablaEmailsPasos = 'pasos_alianza_email';
                $campoTablaEmailsPasos = 'pasos_alianza_id';

                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la alianza #'.$request['alianzaId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva alianza por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la subscripción la alianza #'.$request['alianzaId'];
                $content['no_aprobado'] = 'El resulatdo de la revisión es <b>{estado_recibido_nombre}</b> con la siguiente observación: <br><br> <b>'.$request['observacion'].'</b> <br> <br> Por favor verifique los datos del tramite de la alianza #'.$request['alianzaId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la alianza #'.$request['alianzaId'].' se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la alianza #'.$request['alianzaId'].' ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la alianza #'.$request['alianzaId'].' se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la alianza #'.$request['alianzaId'].'!! <br> <br> Superó todas las revisiones y puede continuar.';

                break;
            case 'iniciativa':
                if (isset($request['iniciativaId'])) {
                    $procesoId = $request['iniciativaId'];
                    $tablaProceso = new \App\Models\Iniciativa;
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la iniciativa.');
                    goto end;
                }
                $tipo_paso_nombre = '_interaction';
                $tablaPasos = new \App\Models\Validation\PasosIniciativa;
                $campoProcesoTablaPasos = 'iniciativa_id';
                $tablaEmailsPasos = 'pasos_iniciativa_email';
                $campoTablaEmailsPasos = 'pasos_iniciativa_id';
                
                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la iniciativa #'.$request['iniciativaId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la iniciativa #'.$request['iniciativaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva iniciativa por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite de la iniciativa #'.$request['iniciativaId'].' que esta en curso, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la inscripción de la iniciativa #'.$request['iniciativaId'];
                $content['no_aprobado'] = 'El resulatdo de la revisión es <b>{estado_recibido_nombre}</b> con la siguiente observación: <br><br> <b>'.$request['observacion'].'</b> <br> <br> Por favor verifique los datos del tramite de la iniciativa #'.$request['iniciativaId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la iniciativa #'.$request['iniciativaId'].' se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la iniciativa #'.$request['iniciativaId'].' ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la iniciativa #'.$request['iniciativaId'].' se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la iniciativa #'.$request['iniciativaId'].'!! <br> <br> Superó todas las revisiones y puede continuar.';

                break;
            case 'inscripcion':
                if (isset($request['inscripcionId'])) {
                    $procesoId = $request['inscripcionId'];
                    $tablaProceso = new \App\Models\Inscripcion;
                }else{
                    $retorno = false;
                    $errors += 1;
                    array_push($returnMsg, 'No se recibio el identificador de la inscripcion.');
                    goto end;
                }
                $tipo_paso_nombre = '_interchange';
                $tablaPasos = new \App\Models\Validation\PasosInscripcion;
                $campoProcesoTablaPasos = 'inscripcion_id';
                $tablaEmailsPasos = 'pasos_inscripcion_email';
                $campoTablaEmailsPasos = 'pasos_inscripcion_id';


                //textos para el email
                $subject['siguiente_validador'] = 'Se requiere su validación por favor - se ha modificado información en la inscripcion #'.$request['inscripcionId'].'.';
                $content['siguiente_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite que esta en curso de la inscripcion #'.$request['inscripcionId'].' para una movilidad, valide la información y haga sus observaciones respectivas.';

                $subject['primer_validador'] = 'Se requiere su validación de la información de una nueva inscripcion por favor.';
                $content['primer_validador'] = 'Sr(a) {user_name} por favor verifique los datos del tramite que esta en curso de la inscripcion #'.$request['inscripcionId'].' para una movilidad, valide la información y haga sus observaciones respectivas.';

                $subject['no_aprobado'] = 'Un validador no ha aprobado la revisión de la información de la inscripción #'.$request['inscripcionId'].' para una movilidad';
                $content['no_aprobado'] = 'El resulatdo de la revisión es <b>{estado_recibido_nombre}</b> con la siguiente observación: <br><br> <b>'.$request['observacion'].'</b> <br> <br> Por favor verifique los datos del tramite de la inscripcion #'.$request['inscripcionId'].' que esta en curso y realice las correcciones necesarias.';

                $subject['todo_aprobado'] = 'El proceso de creación y revisión de la inscripcion #'.$request['inscripcionId'].' para una movilidad se completo correctamente!!';
                $content['todo_aprobado'] = 'Nos complace informar que la inscripcion #'.$request['inscripcionId'].' para una movilidad ya puede empezar a ejecutarse!! <br> <br> Superó todas las revisiones y entrará en vigencia inmediatamente.';

                $subject['si_aprobado'] = 'El proceso de revisión de la inscripcion #'.$request['inscripcionId'].' para una movilidad se completo correctamente!!';
                $content['si_aprobado'] = 'Puede seguir con el proximo paso en la inscripcion #'.$request['inscripcionId'].' para una movilidad!! <br> <br> Superó todas las revisiones y puede continuar.';

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
            ->where('user_tipo_paso.campus_id',$campus_id)
            ->where('tipo_paso.nombre','like','%'.$tipo_paso_nombre)
            ->where('model_has_roles.role_id',$roleValidador)
            ->orderBy('user_tipo_paso.tipo_paso_id','asc')
            ->orderBy('user_tipo_paso.orden','asc');

        //echo $existenValidadores->toSql().'$tipo_paso_nombre:'.$tipo_paso_nombre.'$roleValidador:'.$roleValidador;
        $existenValidadores = $existenValidadores->select('user_tipo_paso.user_id','user_tipo_paso.id','user_tipo_paso.tipo_paso_id')->get();
        // print_r($existenValidadores);
        $estados = \App\Models\Estado::get()->toArray();

        $estadoProcesoActiva = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        reset($estadoProcesoActiva);
        $keyEstadoActiva = key($estadoProcesoActiva);
        
        
        //print_r($existenValidadores);
        if( count($existenValidadores) ){

            $estadoProcesoEnproceso = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'EN PROCESO');
            });
            $estado_id = $request['estado_id'];
            $estado_recibido = array_filter($estados, function($var) use ($estado_id){
                // Retorna siempre que el número entero sea par
                return ($var['id'] == $estado_id);
            });
            $estadoPasoExternal = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'EXTERNAL');
            });
            $estadoPasoEnrevision = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'VALIDATOR' && $var['nombre'] == 'EN REVISIÓN');
            });
            $modificarEstadoProceso = '';
            // $fecha_inicio = NULL;

            reset($estadoProcesoEnproceso);
            $keyEstadoEnproceso = key($estadoProcesoEnproceso);
            reset($estado_recibido);
            $keyEstadoRecibido = key($estado_recibido);
            reset($estadoPasoExternal);
            $keyEstadoExternal = key($estadoPasoExternal);
            reset($estadoPasoEnrevision);
            $keyEstadoEnrevision = key($estadoPasoEnrevision);

            $modificarEstadoProceso = $estadoProcesoEnproceso[$keyEstadoEnproceso]['id'];

            $paso_recibido = \App\Models\TipoPaso::where('id',$request['tipo_paso_id'])->pluck('id')->first();

            //$estado = \App\Models\Estado::where('nombre','APROBADO')->select('id','nombre')->first();
            if (!count($estado_recibido)) {
                $errors += 1;
                array_push($returnMsg, 'No se recibio el estado de la validación.');
                goto end;
            }

            
            //si el estado es EN REVISIÓN no envia notificacion y termina el proceso
            if ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'EN REVISIÓN' || $estado_recibido[$keyEstadoRecibido]['nombre'] == 'GENERAR DOCUMENTO' ) {
                if ($tipo == 'alianza') {
                    $tablaProceso->where('id',$procesoId)->update(['estado_id' => $modificarEstadoProceso]);
                }

                $retorno = true;
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
                    //probar si se puede validar de esta manera la existencia de mas validadores para el mismo paso
                        $encontroValidador = 1;
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
                }elseif ($validadorActual == true) {
                    //verificar si se encontro el validador en el paso recibido pero hay mas validadores en pasos posteriores
                    $numValidadoresPosteriores++;
                }

// echo '$request[paso]:'.$request['paso'].'  ';
// echo '$existeValidador->tipo_paso_id:'.$existeValidador->tipo_paso_id.'  $paso_recibido:'.$paso_recibido.'  $numValidadoresPosteriores:'.$numValidadoresPosteriores;
// echo '<br>';
// echo '$encontroValidador:'.$encontroValidador.'  $validadorActual:'.($validadorActual ? 'si' : 'no' ).'  count($siguienteValidador):'.count($siguienteValidador).'  estado_recibido[$ keyEstadoRecibido] ["uso"]:'.$estado_recibido[$keyEstadoRecibido]['uso'].'  $estado_recibido[$keyEstadoRecibido]["nombre"]:'.$estado_recibido[$keyEstadoRecibido]['nombre'];
// echo '<br>';
// echo '$UserPasoActual:'.$UserPasoActual;
// echo '<br>';

            }

        ////hacer los procesos por cada estado y luego unir las similitudes
        ////opciones:

            //// TODOS (- ACTIVA): cambia el estado de la alianza (EN PROCESO) 
                //$modificarEstadoProceso //ya esta asignado

            ////$estado_recibido[$keyEstadoRecibido]['uso'] == USER || $estado_recibido[$keyEstadoRecibido]['uso'] == EXTERNAL
            if ($estado_recibido[$keyEstadoRecibido]['uso'] == 'USER' || $estado_recibido[$keyEstadoRecibido]['uso'] == 'EXTERNAL') {
                //// $siguienteValidador[] = $existeValidador->user_id;
                //// $UserPasoSiguiente[] = $existeValidador->id;
                $siguienteValidador[] = $existeValidador->user_id;
                $UserPasoSiguiente[] = $existeValidador->id;

                //busca al validador para entregar todos los datos a la creacion del email
                $to_users = \App\User::find($siguienteValidador);
                // $idTablaPaso = $UserPasoSiguiente;
                
                if (!count($to_users)) {
                    $errors += 1;
                    array_push($returnMsg, 'No se encontraron validadores ni coordinadores para el proceso.');
                    goto end;
                }

                ////asignar el texto al mensaje 

                //textos para el email
                $subject['final'] = $subject['primer_validador'];
                $content['final'] = $content['primer_validador'];
                $tipo_link_boton = 'validador';


            ////$estado_recibido[$keyEstadoRecibido]['uso'] == VALIDATOR
            }elseif ($estado_recibido[$keyEstadoRecibido]['uso'] == 'VALIDATOR') {

                ////$estado_recibido[$keyEstadoRecibido]['nombre'] = EN REVISIÓN
                ////$estado_recibido[$keyEstadoRecibido]['nombre'] = GENERAR DOCUMENTO
                    //// cambia el estado de la alianza y sale
                        //ya se ejecuto antes

                ////$estado_recibido[$keyEstadoRecibido]['nombre'] == RECHAZADO
                if ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'RECHAZADO') {
                    //// cambia el estado de la alianza 
                        //$modificarEstadoProceso //ya esta asignado
//parece que no lo encontro (alianza 2 -> validador 3) 
            // print_r($request['pasos_anteriores']);
                    //// cambia el estado de los pasos de los validadores anteriores: EN REVISIÓN
                    if ((isset($request['pasos_anteriores']['validaciones']) && count($request['pasos_anteriores']['validaciones'])) || (isset($request['pasos_anteriores']['pasos_por_otros']) && count($request['pasos_anteriores']['pasos_por_otros']))) {

                        $pasos_registrados = array_column($request['pasos_anteriores']['validaciones'], 'id') ?? [];
                        //elimina el id del paso recien (actual) registrado para que solo actualice los demas
                        // $todosLosPasos = $tablaPasos->where([[$campoProcesoTablaPasos, $procesoId],['campus_id',$campus_id]])->pluck('id')->toArray();

                        $todosLosPasos = $tablaPasos->where([[$campoProcesoTablaPasos, $procesoId]])->select('id','estado_id')->get()->toArray();
                        $idTodosLosPasos = array_column($todosLosPasos, 'id');
// echo '$todosLosPasos:';
// print_r($todosLosPasos);
                        if ($request['paso_proceso_id'] != 0) {
                            $pasos_registrados = array_diff($pasos_registrados, [$request['paso_proceso_id']]);
                            $idTodosLosPasos = array_diff(array_column($todosLosPasos, 'id'), [$request['paso_proceso_id']]);
                            // $quitarElemento = array_search($request['paso_proceso_id'], $pasos_registrados);
                            // unset($pasos_registrados[$quitarElemento]);
                        }
// echo '$todosLosPasos filtrados:';
// print_r($todosLosPasos);
// echo '$idTodosLosPasos filtrados:';
// print_r($idTodosLosPasos);

                        $cambio_estado_pasos = $tablaPasos->whereIn('id', $pasos_registrados)
                            ->update(['estado_id' => $estadoPasoEnrevision[$keyEstadoEnrevision]['id']]);
                        
                        //cambiar el estado y la observación del paso de la aceptacion por parte del coordinador externo 
                        $search_declinado = array_search('DECLINADO', array_column($estadoPasoExternal, 'nombre'));
                        $keys_external = array_keys($estadoPasoExternal);
                        //cambia el estado a RECHAZADO de los pasos registrados por los usuarios externos
                        $cambio_estado_pasos = $tablaPasos->whereIn('id', $idTodosLosPasos)->whereIn('estado_id', array_column($estadoPasoExternal, 'id'))
                            ->update(['estado_id' => $estadoPasoExternal[$keys_external[$search_declinado]]['id'],'observacion' => 'Fue rechazado por un validador']);
                        
                        
                    //// cambia el estado de los mails de los pasos de los validadores anteriores: 0 (NO ENVIADO)

                        //cambiar el estado de los emails de la tabla mails vinculados a travez de pasos_[proceso]_email y user_tipo_paso_email con el proceso en el caso que el estado no sea aprobado, es decir RECHAZADO

                        // $pasos_proceso_email_id = DB::table($tablaEmailsPasos)->whereIn($campoTablaEmailsPasos, array_column($pasos_registrados, 'id'))
                        //se cambia para que tome todos los emails enviados de los pasos excepto el actual (paso_proceso_id)
                        $pasos_proceso_email_id = DB::table($tablaEmailsPasos)->whereIn($campoTablaEmailsPasos, $idTodosLosPasos)
                            ->select('email_id',$campoTablaEmailsPasos.' AS pasos_proceso_id')->get()->toArray();

                        if (!count($pasos_proceso_email_id)) {
                            $pasos_proceso_email_id = array( array('email_id' => 0) );
                        }

                        //se debe recibir el id del usuario que creo los emails, en este caso del coordinador_externo
                        $listaValidadores = $existenValidadores->toArray();
// PARA SOLUCIONAR ESTE PROBLEMA SE DEBE ANALIZAR EL FUNCIONAMIENTO DEL PROCESO DE VALIDACION Y EMAILS PARA DEJAR TODOS LOS EMAILS ASOCIADOS A LAS TABLAS DE pasos_[proceso] y verificar si se puede eliminar la tabla user_tipo_paso_email
//------------------------------------
                        // $user_tipo_paso_email_id = DB::table('user_tipo_paso_email')->whereIn('user_tipo_paso_id',array_column($listaValidadores, 'id'))
                        //     ->pluck('email_id')->toArray();
// echo '$listaValidadores:';
// print_r($listaValidadores);
                        // if (!count($user_tipo_paso_email_id)) {
                        //     $user_tipo_paso_email_id = array();
                        // }
// print_r(array_column($pasos_proceso_email_id, 'email_id'));
                        // $emails_id = array_merge(array_column($pasos_proceso_email_id, 'email_id'),$user_tipo_paso_email_id);
                        $emails_id = array_column($pasos_proceso_email_id, 'email_id');
// echo '$emails_id:';
// return $emails_id;
                        $cambio_estado_emails = \App\Models\Email::whereIn('id', $emails_id)
                            ->update(['estado' => 0]);

                    }

                    //// obtiene los datos de los usuarios anteriores ([coordinadores, estudiantes, usuarios] y validadores) para notificarlos

                        //// $anterioresValidadores[] = $existeValidador->user_id;
                        //// $UserPasoAnterior[] = $existeValidador->id;
                        $proceso = $tipo;
                        $buscarUsuariosVinculados = $this->buscarUsuariosVinculados($proceso,$procesoId);

                        $anterioresValidadores = array_merge($anterioresValidadores, $buscarUsuariosVinculados );

                        $to_users = \App\User::find($anterioresValidadores);
                        // $idTablaPaso = $UserPasoActual;

                        if (!count($to_users)) {
                            $errors += 1;
                            array_push($returnMsg, 'No se encontraron validadores ni usuarios para el proceso.');
                            goto end;
                        }

                    //// asignar el texto al mensaje 
                    
                    //textos para el email
                    $subject['final'] = $subject['no_aprobado'];
                    $content['final'] = str_replace('{estado_recibido_nombre}', $estado_recibido[$keyEstadoRecibido]['nombre'], $content['no_aprobado']);
                    $tipo_link_boton = 'interesados';
                    
                ////$estado_recibido[$keyEstadoRecibido]['nombre'] == APROBADO
                }elseif ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'APROBADO') {
                    ////$siguienteValidador[] = $existeValidador->user_id;
                    ////$UserPasoSiguiente[] = $existeValidador->id;
                    $siguienteValidador[] = $existeValidador->user_id;
                    $UserPasoSiguiente[] = $existeValidador->id;
                    
                    // $idTablaPaso = $UserPasoSiguiente;

                    $interesadosYvalidadores = $siguienteValidador;

                    //entra aqui en el caso de que este aprobado pero el proceso continue y existan validaciones en pasos posteriores
                    if ($numValidadoresPosteriores > 0 && $validadorActual == true && $encontroValidador == 0) {

                        // $anterioresValidadores[] = $existeValidador->user_id;
                        // $UserPasoAnterior[] = $existeValidador->id;

                        $proceso = $tipo;
                        $buscarUsuariosVinculados = $this->buscarUsuariosVinculados($proceso,$procesoId);

                        // $interesadosYvalidadores = array_merge($anterioresValidadores, $buscarUsuariosVinculados );
                        $interesadosYvalidadores = $buscarUsuariosVinculados;

                        // $idTablaPaso = $UserPasoActual;

                    }
// echo '$interesadosYvalidadores: <br>';
// print_r($interesadosYvalidadores);

// echo '<br>';
// echo '$buscarUsuariosVinculados: <br>';
// print_r($buscarUsuariosVinculados);

// echo '<br>';
                    //busca al validador para entregar todos los datos a la creacion del email
                    $to_users = \App\User::find($interesadosYvalidadores);

                    
                    if (!count($to_users)) {
                        $errors += 1;
                        array_push($returnMsg, 'No se encontraron validadores ni coordinadores para este paso del proceso.');
                        goto end;
                    }




                    //// asignar el texto al mensaje 
                    //si no hay mas validadores en el paso actual, el estado es APROBADO y hay mas validadores en pasos posteriores entonces cambiar el mensaje porque el proceso continua
                    
                    if ($validadorActual == true && $encontroValidador == 1 ) {
                        //textos para el email
                        $subject['final'] = $subject['siguiente_validador'];
                        $content['final'] = $content['siguiente_validador'];
                        $tipo_link_boton = 'validador';
                    }elseif ($numValidadoresPosteriores > 0 ) {
                        //textos para el email
                        $subject['final'] = $subject['si_aprobado'];
                        $content['final'] = $content['si_aprobado'];
                        $tipo_link_boton = 'interesados';
                    }else{

                        if(!count($siguienteValidador) ){
                            // $idTablaPaso = $UserPasoAnterior;
                            
                            $modificarEstadoProceso = $estadoProcesoActiva[$keyEstadoActiva]['id'];
                            // $fecha_inicio = new \DateTime('now');

                            // $fecha_inicio->format('Y-m-d H:i:s');
                        }

                        //textos para el email
                        $subject['final'] = $subject['todo_aprobado'];
                        $content['final'] = $content['todo_aprobado'];
                        $tipo_link_boton = 'interesados';

                    }

                    
                ////$estado_recibido[$keyEstadoRecibido]['nombre'] == ACTIVA
                }elseif ($estado_recibido[$keyEstadoRecibido]['nombre'] == 'ACTIVA') {

                    //// obtiene los datos de los usuarios anteriores ([coordinadores, estudiantes, usuarioñ] y validadores) para notificarlos

                        //// $anterioresValidadores[] = $existeValidador->user_id;
                        //// $UserPasoAnterior[] = $existeValidador->id;
                        $anterioresValidadores[] = $existeValidador->user_id;
                        $UserPasoAnterior[] = $existeValidador->id;

                        $proceso = $tipo;
                        $buscarUsuariosVinculados = $this->buscarUsuariosVinculados($proceso,$procesoId);

                        $anterioresValidadores = array_merge($anterioresValidadores, $buscarUsuariosVinculados );

                        $to_users = \App\User::find($anterioresValidadores);
                        // $idTablaPaso = $UserPasoAnterior;

                        
                    if (!count($to_users)) {
                        $errors += 1;
                        array_push($returnMsg, 'No se encontraron validadores ni coordinadores para este paso del proceso.');
                        goto end;
                    }

                    //// asignar el texto al mensaje 
                    if ($numValidadoresPosteriores > 0) {
                        // $idTablaPaso = $UserPasoSiguiente;

                        //textos para el email
                        $subject['final'] = $subject['siguiente_validador'];
                        $content['final'] = $content['siguiente_validador'];
                    }else{

                        // if(!count($siguienteValidador) ){
                            
                            $modificarEstadoProceso = $estadoProcesoActiva[$keyEstadoActiva]['id'];
                            // $fecha_inicio = new \DateTime('now');

                            // $fecha_inicio->format('Y-m-d H:i:s');
                        // }

                        //textos para el email
                        $subject['final'] = $subject['todo_aprobado'];
                        $content['final'] = $content['todo_aprobado'];
                        $tipo_link_boton = 'interesados';

                    }
                    
                    
                    
                }

                
            }
            // print_r($idTablaPaso);
            //// cambia el estado del proceso (ACTIVA)
            $camposProcesoActualizar = ['estado_id' => $modificarEstadoProceso];
            // if (isset($fecha_inicio) ) {
            //     $camposProcesoActualizar = ['estado_id' => $modificarEstadoProceso,'fecha_inicio' => $fecha_inicio];
            // }

            //// TODOS (- ACTIVA): cambia el estado de la alianza (EN PROCESO) 
            $tablaProceso->where('id',$procesoId)->update($camposProcesoActualizar);

//---------------------------------------------------------
//---------------------------------------------------------
//---------------------------------------------------------
//---------------------ANTERIOR METODO---------------------
//---------------------------------------------------------
//---------------------------------------------------------
//---------------------------------------------------------
/*
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

                            //cambiar el estado de los emails de la tabla mails vinculados a travez de pasos_alianza_email y user_tipo_paso_email con la alianza en el caso que el estado no sea aprobado, es decir RECHAZADO
                            $pasos_alianza_email_id = \App\Models\Validation\PasosAlianza::join('pasos_alianza_email','pasos_alianza.id','pasos_alianza_email.pasos_alianza_id')
                                ->where('pasos_alianza.alianza_id',$alianzaId)->select('pasos_alianza_email.email_id','pasos_alianza.id AS pasos_alianza_id')->get()->toArray();
                ///////////////////// definir si al momento de rechazar la validacion se continua desde el paso y usuario que rechazo o se vuelve a comenzar
                            if (!count($pasos_alianza_email_id)) {
                                $pasos_alianza_email_id = array( array('email_id' => 0) );
                            }elseif($estado_recibido[$keyEstadoRecibido]['nombre'] == 'RECHAZADO'){
                                // $cambio_estado_pasos = \App\Models\Validation\PasosAlianza::whereIn('id', array_column($pasos_alianza_email_id, 'pasos_alianza_id'))
                                // ->update(['estado_id' => $estadoPasoEnrevision[$keyEstadoEnrevision]['id']]);

                            }

                            //se debe recibir el id del usuario que creo los emails, en este caso del coordinador_externo
                            $user_tipo_paso_email_id = \App\Models\Validation\UserPaso::join('user_tipo_paso_email','user_tipo_paso.id','user_tipo_paso_email.user_tipo_paso_id')
                                ->where('user_tipo_paso_email.user_id',$request['user_id'])->select('user_tipo_paso_email.email_id')->pluck('email_id')->toArray();

                            if (!count($user_tipo_paso_email_id)) {
                                $user_tipo_paso_email_id = array();
                            }

                            $emails_id = array_merge(array_column($pasos_alianza_email_id, 'email_id'),$user_tipo_paso_email_id);

                            $cambio_estado_emails = \App\Models\Email::whereIn('id', $emails_id)
                                ->update(['estado' => 0]);

                            $modificarEstadoProceso = $estadoProcesoEnproceso[$keyEstadoEnproceso]['id'];
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
                                
                                $modificarEstadoProceso = $estadoProcesoActiva[$keyEstadoActiva]['id'];
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
                        $modificarEstadoProceso = $estadoProcesoEnproceso[$keyEstadoEnproceso]['id'];
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
                    $modificar_alianza->estado_id = $modificarEstadoProceso;
                    $modificar_alianza->fecha_inicio = $fecha_inicio;
                    $modificar_alianza->save();

                }

            }
            
*/
//---------------------------------------------------------
//---------------------------------------------------------
//---------------------------------------------------------
//---------------------ANTERIOR METODO---------------------
//---------------------------------------------------------
//---------------------------------------------------------
//---------------------------------------------------------
            

            $tipo_paso = $paso_recibido;
            $roleCopiaEmails = Role::where('name','copia_oculta_email')->pluck('id');
            //buscar el email del usuario asignado para recibir una copia oculta de los emails
            $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                ->where('model_has_roles.role_id',$roleCopiaEmails )
                ->select('users.id', 'users.name', 'users.email')->first();
            
            //print_r($siguienteValidador);
            //goto end;

            //QUEDA FIJO EL VALOR DE $idTablaPaso QUE CORRESPONDE AL ID DE LA TABLA user_tipo_paso DONDE ESTA ASIGNADO EL VALIDADOR ACTUAL Y DONDE SERA ASOCIADO EL EMAIL QUE SE VA A CREAR Y ENVIAR
            //$idTablaPaso = $UserPasoActual;
            //trait mail valida si la variable 'paso' no esta vacia para buscar en la tabla user_tipo_paso

            //antes se asociaba a la tabla user_paso mediante user_paso_email
            /*
            if (empty($idTablaPaso) ) {
                $idTablaPaso = $UserPasoActual;
            }

            if (is_array($idTablaPaso) && count($idTablaPaso) == 1) {
                $idTablaPaso = $idTablaPaso[0];
                $UserPasoId = [$idTablaPaso];
            }elseif (is_array($idTablaPaso) ) {
                $UserPasoId = $idTablaPaso;
            }else{
                $UserPasoId = [$idTablaPaso];
            }
            */
            $content['final'] = str_replace('{user_name}', implode(', ', array_column($to_users->toArray(), 'name')), $content['final']);
            $content['final'] = str_replace('{estado_recibido_nombre}', $estado_recibido[$keyEstadoRecibido]['nombre'], $content['final']);
            

            $datos['tabla_email'] = $tablaEmailsPasos;
            //antes se asociaba a la tabla user_paso mediante user_paso_email
            // $datos['paso'] = $idTablaPaso;
            //ahora todos los emails de los procesos estan asociados en una misma tabla: pasos_[proceso]_email
            $datos['paso_proceso_id'] = $request['paso_proceso_id'];
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
            $tablaPaso_email_id = DB::table($tablaEmailsPasos)
                        ->join('email','email.id',$tablaEmailsPasos.'.email_id')
                        ->where($tablaEmailsPasos.'.'.$campoTablaEmailsPasos,$request['paso_proceso_id'])
                        ->where($tablaEmailsPasos.'.user_id',$request['user_id'])
                        ->where('email.subject',$datos['subject'])
                        ->select($tablaEmailsPasos.'.email_id')->pluck('email_id');
            //agrega el id del mail y cambiar el tipo de creacion
            if ( count($tablaPaso_email_id) ) {
                $datos['id'] = $tablaPaso_email_id;
                $crearTipo = 'actualizar';
            }
            
            $datos['crearTipo'] = $crearTipo;

            //$crearEmail = $this->crearEmail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);

            //se cambia porque segun el tipo de mail busca el registro para asociar el mail y si se envia como tipo al valor de $tipo_email va a buscar en la tabla incorrecta y debe buscar en user_tipo_paso por eso siempre debe ser 'validador'
            //$crearEmail = $this->crearEmail($tipo_email,$datos); 
            // echo '$tipo_email:'.$tipo_email.'<br>';
            // print_r($datos);
            //para obligar a generar un error y mostrar los datos 
            // echo $datos->prueba;
            $crearEmail = $this->crearEmail($tipo_email,$datos);
            
            if ( $crearEmail == 'error_email' ) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'No se puede crear el email de notificación hacia el validador.');
                goto end;
            }elseif ( $crearEmail == 'error_paso' ) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'No se encuentra el registro, no se puede crear el email de notificación hacia el validador.');
                goto end;
            }elseif ( $crearEmail == 'error_user' ) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'No se encuentra el validador, no se puede crear el email de notificación hacia el validador.');
                goto end;
            }elseif ( $crearEmail == 'error_tipo_email' || $crearEmail == 'error_crear_tipo' ) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el email de notificación hacia el validador.');
                goto end;
            }elseif ( $crearEmail == 'error_tabla' ) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'Error al especificar el proceso asociado al email, no se puede crear el email de notificación hacia el validador.');
                goto end;
            }elseif ($crearEmail === false) {
                $retorno = $crearEmail;
                $errors += 1;
                array_push($returnMsg, 'Ocurrio un error al crear el email de notificación hacia el validador.');
                goto end;
            }else{

                if (empty($crearEmail[0]) ) {
                    $dataEmail = $crearEmail;
                }else{
                    $dataEmail = $crearEmail[0];
                }
                // print_r($dataEmail);

                if ($tipo == 'alianza') {
                    $dataEmail->alianzaId = $procesoId;
                }
                
                if ($tipo == 'iniciativa') {
                    $dataEmail->iniciativaId = $procesoId;
                }
                
                if ($tipo == 'inscripcion') {
                    $dataEmail->inscripcionId = $procesoId;

                    $tipoInscripcion = $tablaProceso->where('id',$procesoId)->select('tipo')->first();

                    $dataEmail->tipoInscripcion = ($tipoInscripcion->tipo == 0 ? 'interout' : 'interin');
                }
                //esto se ejecuta solo para el proceso de inscripcion, debido a que no hay otra forma de comprobar que el email fue enviado al validador
                if ($tipo == 'inscripcion') {


                    
                    $pasoInscripcion = \App\Models\Validation\PasosInscripcion::find($request['paso_proceso_id']);

                    $pasoInscripcion->email()->syncWithoutDetaching([$dataEmail->id => [ 'user_id' => $datos['user_id']] ]);
                }
                
                //para saber si el link del boton que aparece en el email sera hacia una validacion o hacia el registro del proceso
                $request['tipo_link_boton'] = $tipo_link_boton;
                $request['tokenemail'] = $dataEmail->tokenemail;
                $request['proceso_origen'] = $tipo;
                $request['enviar'] = true;
                $request['peticion'] = 'local';
                $request['dataEmail'] = $dataEmail;
                $request['archivosAdjuntos'] = $archivosAdjuntos;

                $enviarEmail = $this->enviarEmail($tipo_email, $request);
                $retorno = $enviarEmail;
                
            }

            //$existeEmail->estado = 1;
            //$existeEmail->save();

            
            /*
            if ( !$this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId) ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede registrar hacia la alianza.');
                goto end;
            }
            */
            //return $crearEmail;
        }else{
            //el proceso quedara activo si no hay validadores
            $modificarEstadoProceso = $estadoProcesoActiva[$keyEstadoActiva]['id'];
            $tablaProceso->where('id',$procesoId)->update(['estado_id' => $modificarEstadoProceso]);
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


    public function buscarUsuariosVinculados($proceso,$procesoId){ 
        $retorno = array();

        if ($proceso == 'alianza') {

            //agregar a los interesados faltantes, ya estan los validadores, faltan los coordinadores de la alianza
            //buscar los coordinadores (interno y externo)
            $roleCoordinadorInterno = Role::where('name','coordinador_interno')->pluck('id')->first();
            $roleCoordinadorExterno = Role::where('name','coordinador_externo')->pluck('id')->first();

            $dataCoordinadores = DB::table('alianza')
                    ->join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('alianza.id',$procesoId )
                    ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno,$roleCoordinadorExterno] )
                    // ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno] )
                    ->select('users.id AS usuario_id')
                    ->orderBy('users.id','asc')
                    ->get()->toArray();

            $retorno = array_column($dataCoordinadores, 'usuario_id');
            

        }elseif ($proceso == 'inscripcion') {
            
            //agregar a los interesados faltantes, ya estan los validadores, falta el estudiante y el postulante de la inscripcion
            //buscar al estudiante y al postulante

            //buscar la inscripcion
            $datosInscripcion = \App\Models\Inscripcion::where('id',$procesoId )->first();

            //buscar el usuario del postulante (coordinador) de la inscripcion
            $postulanteInscripcion = \App\Models\Postulacion::join('users', 'postulacion.user_id', '=', 'users.id')
                ->where('postulacion.inscripcion_id',$procesoId )
                ->select('users.id AS user_id')->first();

            if ($datosInscripcion->user_id == $postulanteInscripcion->user_id) {
                $retorno = [$datosInscripcion->user_id];
            }else{
                $retorno = [$datosInscripcion->user_id, $postulanteInscripcion->user_id];
            }

        }elseif ($proceso == 'iniciativa') {

            //agregar a los interesados faltantes, ya estan los validadores, falta ... de la iniciativa
            //buscar a ..

            $retorno = [];
        }

        return $retorno;
    }




}

