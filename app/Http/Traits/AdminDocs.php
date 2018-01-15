<?php

namespace App\Http\Traits;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Flash;

trait AdminDocs{
    

    /**
     * @param $busqueda
     * @return mixed
     */
    public function datosDocumento($tipo_documento,$datos)
    {
        
    }
    /**
     * @param $busqueda
     * @return mixed
     */
    public function verDocumento($proceso,$datos) //$this->verDocumento($proceso,[$archivo_id, $institucionId, $view, $peticion ])  
    {
        $errors = 0;
        $errorsMsg = '';
        $okMsg = [];
        $view = $datos['view'];
        $route_error = $view;

        $viewWith = [];

        switch ($proceso) {
            case 'institucion':

                
                if (!isset($datos['institucionId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_institucion';
                    goto end;
                }

                $idProceso = $datos['institucionId'];
                $nombreCampoDatoProceso = 'institucion_id';
                $tablaAsociarArchivo = new \App\Models\Admin\DocumentosInstitucion;
                $nombreTablaAsociarArchivo = 'documentos_institucion';
            
                break;
            case 'alianza':
                
                if (!isset($datos['alianzaId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_alianza';
                    goto end;
                }

                $idProceso = $datos['alianzaId'];
                $nombreCampoDatoProceso = 'alianza_id';
                $tablaAsociarArchivo = new \App\Models\DocumentosAlianza;
                $nombreTablaAsociarArchivo = 'documentos_alianza';

                break;
            case 'iniciativa':
                if (!isset($datos['iniciativaId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_iniciativa';
                    goto end;
                }

                $idProceso = $datos['iniciativaId'];
                $nombreCampoDatoProceso = 'iniciativa_id';
                $tablaAsociarArchivo = new \App\Models\DocumentosIniciativa;
                $nombreTablaAsociarArchivo = 'documentos_iniciativa';

                break;
            case 'oportunidad':
                if (!isset($datos['oportunidadId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_oportunidad';
                    goto end;
                }

                $idProceso = $datos['oportunidadId'];
                $nombreCampoDatoProceso = 'oportunidad_id';
                $tablaAsociarArchivo = new \App\Models\DocumentosOportunidad;
                $nombreTablaAsociarArchivo = 'documentos_oportunidad';
                
                break;
            case 'inscripcion':
                
                if (!isset($datos['inscripcionId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_inscripcion';
                    goto end;
                }

                $idProceso = $datos['inscripcionId'];
                $nombreCampoDatoProceso = 'inscripcion_id';
                $tablaAsociarArchivo = new \App\Models\DocumentosInscripcion;
                $nombreTablaAsociarArchivo = 'documentos_inscripcion';
                
                break;
            case 'identidad':
                
                if (!isset($datos['userId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_user';
                    goto end;
                }

                $idProceso = $datos['userId'];
                $nombreCampoDatoProceso = 'user_id';
                $tablaAsociarArchivo = new \App\Models\DocumentosUser;
                $nombreTablaAsociarArchivo = 'documentos_user';

                break;
            default:
                $view = $route_error;
                $errors += 1;
                $errorsMsg = 'error_proceso';
                goto end;

                break;
        }
        $archivoProceso = $tablaAsociarArchivo->join('tipo_documento',$nombreTablaAsociarArchivo.'.tipo_documento_id','tipo_documento.id')
            ->join('archivo',$nombreTablaAsociarArchivo.'.archivo_id','archivo.id')
            ->join('formato','archivo.formato_id','formato.id')
            ->where($nombreTablaAsociarArchivo.'.'.$nombreCampoDatoProceso,$idProceso)
            ->where('archivo.id',$datos['archivo_id'])
            ->select('archivo.id','archivo.nombre','archivo.path','tipo_documento.id AS tipo_documento','formato.nombre AS formato')
            ->get();


        if (count($archivoProceso)) {
            $archivoProceso = $archivoProceso[0]->toArray();

            if ( in_array(strtolower($archivoProceso['formato']), ['pdf','application/pdf']) ) {
                $documento_contenido = '<embed src="'.\Storage::url($archivoProceso['path']).'" type="application/pdf" >';
                
            }elseif( in_array(strtolower($archivoProceso['formato']), ['imagen','png','jpg','jpeg']) ) {
                $documento_contenido = '<img src="'.\Storage::url($archivoProceso['path']).'" alt="'.$archivoProceso['nombre'].'" >';
                
            }elseif( in_array(strtolower($archivoProceso['formato']), ['htm','html']) ) {
                $documento_contenido = \Storage::disk('public')->get('/'.$archivoProceso['path']);

            }else{
                $documento_contenido = '<a href="'.\Storage::url($archivoProceso['path']).'" alt="'.$archivoProceso['nombre'].'" >'.$archivoProceso['nombre'].'</a>';
            }


            $viewWith = array_merge($viewWith, ['documento' => $archivoProceso, 'documento_contenido' => $documento_contenido]);

        }else{

            $errors += 1;
            $errorsMsg = 'error_documento';
            goto end;
        }

        //print_r($viewWith['keyWords']);

        end:
        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ( $datos['peticion'] == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                flash()->error($errorsMsg);
                return redirect($view);
            }
        }else{
            DB::commit();

            if ( $datos['peticion'] == 'local' ) {
                return $viewWith;
            }else if ($this->peticion == 'ajax') {
                return $viewWith;
            }else{
                if (count($okMsg)) {
                    flash()->success($okMsg);
                }
                return view($view)->with($viewWith);
            }

        }
    }










    /**
     * @param $busqueda
     * @return mixed
     */
    public function crearDocumento($proceso,$datos) //$proceso [institucion,iniciativa,inscripcion,validador],$datos [view,institucionId,origen,tipo_documento,archivo_id,archivo_contenido,archivo_input,user_id,route_error]
    {
        
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = $datos['view'];
        $route_error = $datos['route_error'];

        $archivo_id = 0;
        $tablaAsociarArchivo = '';
        $path = '';
        $path_orig = '';
        $nombre = 'nombre_default';
        $nombre_orig = 'nombre_default';

        if (!isset($datos['user_id'])) {
            $view = $route_error;
            $errors += 1;
            $errorsMsg = 'error_user';
            goto end;
        }

        if (!isset($datos['archivo_contenido'])) {
            $datos['archivo_contenido'] = '';
        }

        switch ($proceso) {
            case 'institucion':
                if (!isset($datos['institucionId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_institucion';
                    goto end;
                }

                $datoProceso = 'institucionId';
                $idProceso = $datos['institucionId'];
                $nombreCampoDatoProceso = 'institucion_id';
                $tablaProceso = new \App\Models\Admin\Institucion;
                $error_tabla_proceso = 'error_institucion';
                $tablaAsociarArchivo = new \App\Models\Admin\DocumentosInstitucion;
                $nombreTablaAsociarArchivo = 'documentos_institucion';
                
                break;
            case 'alianza':
                
                if (!isset($datos['alianzaId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_alianza';
                    goto end;
                }

                $datoProceso = 'alianzaId';
                $idProceso = $datos['alianzaId'];
                $nombreCampoDatoProceso = 'alianza_id';
                $tablaProceso = new \App\Models\Alianza;
                $error_tabla_proceso = 'error_alianza';
                $tablaAsociarArchivo = new \App\Models\DocumentosAlianza;
                $nombreTablaAsociarArchivo = 'documentos_alianza';

                break;
            case 'iniciativa':
                if (!isset($datos['iniciativaId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_iniciativa';
                    goto end;
                }

                $datoProceso = 'iniciativaId';
                $idProceso = $datos['iniciativaId'];
                $nombreCampoDatoProceso = 'iniciativa_id';
                $tablaProceso = new \App\Models\Iniciativa;
                $error_tabla_proceso = 'error_iniciativa';
                $tablaAsociarArchivo = new \App\Models\DocumentosIniciativa;
                $nombreTablaAsociarArchivo = 'documentos_iniciativa';

                break;
            case 'oportunidad':
                if (!isset($datos['oportunidadId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_oportunidad';
                    goto end;
                }

                $datoProceso = 'oportunidadId';
                $idProceso = $datos['oportunidadId'];
                $nombreCampoDatoProceso = 'oportunidad_id';
                $tablaProceso = new \App\Models\Oportunidad;
                $error_tabla_proceso = 'error_oportunidad';
                $tablaAsociarArchivo = new \App\Models\DocumentosOportunidad;
                $nombreTablaAsociarArchivo = 'documentos_oportunidad';
                
                break;
            case 'inscripcion':
                
                if (!isset($datos['inscripcionId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_inscripcion';
                    goto end;
                }

                $datoProceso = 'inscripcionId';
                $idProceso = $datos['inscripcionId'];
                $nombreCampoDatoProceso = 'inscripcion_id';
                $tablaProceso = new \App\Models\Inscripcion;
                $error_tabla_proceso = 'error_inscripcion';
                $tablaAsociarArchivo = new \App\Models\DocumentosInscripcion;
                $nombreTablaAsociarArchivo = 'documentos_inscripcion';
                
                break;
            case 'identidad':
                
                if (!isset($datos['userId'])) {
                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_user';
                    goto end;
                }

                $datoProceso = 'userId';
                $idProceso = $datos['userId'];
                $nombreCampoDatoProceso = 'user_id';
                $tablaProceso = new \App\User;
                $error_tabla_proceso = 'error_user';
                $tablaAsociarArchivo = new \App\Models\DocumentosUser;
                $nombreTablaAsociarArchivo = 'documentos_user';

                break;
            default:
                $view = $route_error;
                $errors += 1;
                $errorsMsg = 'error_proceso';
                goto end;

                break;

        }

        //buscar el registro a partir del id del proceso recibido
        $tablaProceso = $tablaProceso->find($idProceso);

        if ( empty($tablaProceso) ) {
            $view = $route_error;
            $errors += 1;
            $errorsMsg = $error_tabla_proceso;
            goto end;
        }else{
            $idProceso = $tablaProceso->id;
        }



        //estructura el nuevo path y el nombre del archivo para guardarlo

            if (isset($datos['tipo_documento'])) {

                $tipo_documento = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                    ->where('tipo_documento.id',$datos['tipo_documento'])
                    ->select('tipo_documento.id','tipo_documento.nombre','clase_documento.nombre AS clase_documento')
                    ->first();

                if(empty($tipo_documento)){

                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_documento';
                    goto end;
                }

                //define el formato y tipo de archivo
                if ($tipo_documento->nombre == 'PRE-FORMAS') {
                    
                    $formatoDefault = 'html';
                    $tipo_archivo_nombre = 'PRE-FORMA';

                }else{
                    
                    $formatoDefault = 'pdf';
                    $tipo_archivo_nombre = 'DOCUMENTO';
                    
                }


                $tipo_documento_id = $tipo_documento->id;
                $formatoArchivo = ($datos['archivo_formato'] ? $datos['archivo_formato'] : $formatoDefault);
                
                $nombre = ($datos['archivo_nombre'] != '' ? $datos['archivo_nombre'] : $nombre);
                $nombre_archivo = md5($nombre . microtime()).'.'.$formatoArchivo;
                
                if (!in_array($datos['archivo_contenido'], ['',null]) || !in_array($datos['archivo_input'], ['',null]) ) {

                    if ($tipo_documento->clase_documento == 'INSTITUCION') {
                        if ($datoProceso != 'institucionId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_institucion';
                            goto end;
                        }
                        $path = 'institucion/'.$idProceso;
                        if ($tipo_documento->nombre == 'PRE-FORMAS') {
                            $path = 'institucion/'.$idProceso.'/convenios';
                        }
                    }elseif ($tipo_documento->clase_documento == 'ALIANZA') {
                        if ($datoProceso != 'alianzaId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_alianza';
                            goto end;
                        }
                        $path = 'alianza/'.$idProceso;

                        if ($tipo_documento->nombre == 'PRE-FORMAS') {
                            $path = 'alianza/'.$idProceso.'/documentos';
                        }elseif ($tipo_documento->nombre == 'DOCUMENTOS FINALES ALIANZA') {
                            $path = 'alianza/'.$idProceso.'/documentos';
                        }

                    }elseif ($tipo_documento->clase_documento == 'IDENTIDAD') {
                        if ($datoProceso != 'userId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_user';
                            goto end;
                        }
                        $path = 'user/'.$idProceso;
                    }elseif ($tipo_documento->clase_documento == 'INSCRIPCION') {
                        if ($datoProceso != 'inscripcionId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_inscripcion';
                            goto end;
                        }
                        $path = 'inscripcion/'.$idProceso;
                    }elseif ($tipo_documento->clase_documento == 'OPORTUNIDAD') {
                        if ($datoProceso != 'oportunidadId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_oportunidad';
                            goto end;
                        }
                        $path = 'oportunidad/'.$idProceso;
                    }elseif ($tipo_documento->clase_documento == 'INICIATIVA') {
                        if ($datoProceso != 'iniciativaId') {
                            $view = $route_error;
                            $errors += 1;
                            $errorsMsg = 'error_iniciativa';
                            goto end;
                        }
                        $path = 'oportunidad/'.$idProceso;
                    }elseif ($tipo_documento->clase_documento == 'MULTIMEDIA') {
                        $path = 'multimedia';
                    }else{
                        $view = $route_error;
                        $errors += 1;
                        $errorsMsg = 'error_documento';
                        goto end;
                    }

                    //se movio mas abajo para determinar si se cambia el nombre del archivo almacenado en el caso que el nombre sea diferente
                    /*
                    // if ($datos['archivo_contenido'] !== '' || $datos['archivo_input'] !== '') {
                        // $MimeType = $request->file('archivo_documentos')->getClientMimeType();
                        if ($tipo_documento->nombre == 'PRE-FORMAS') {
                            $path .= '/'.$nombre_archivo;
                            Storage::disk('public')->put($path, $datos['archivo_contenido']);

                        }else{
                            $path = Storage::disk('public')->putFileAs(
                                $path, $datos['archivo_input'], $nombre_archivo
                            );
                        }

                    // }
                    */
                }

            //busca el archivo anterior y lo elimina
                $archivoProceso = '';
                
                //busca si existe el archivo para actualizarlo
                if (isset($datos['archivo_id'])) {
                        $archivoProceso = $tablaAsociarArchivo->join('tipo_documento',$nombreTablaAsociarArchivo.'.tipo_documento_id','tipo_documento.id')
                                ->join('archivo',$nombreTablaAsociarArchivo.'.archivo_id','archivo.id')
                                ->where([[$nombreTablaAsociarArchivo.'.'.$nombreCampoDatoProceso,$idProceso],['tipo_documento.id',$tipo_documento_id]]);
                    if (!isset($datos['unique'])) {
                        $archivoProceso = $archivoProceso->where('archivo.id',$datos['archivo_id']);
                    }
                        $archivoProceso = $archivoProceso->select('archivo.id','archivo.nombre','archivo.path');
                    // echo $archivoProceso->toSql();
                    // print_r($archivoProceso->getBindings() );
                        $archivoProceso = $archivoProceso->get();
                                // ->where($nombreTablaAsociarArchivo.'.tipo_documento_id',$tipo_documento_id)

                }
                $listaArchivos = [];

                //busca el registro de los archivos almacenados y los elimina
                if (count($archivoProceso)) {
                    foreach ($archivoProceso as $key => $archivo) {
                        //guardara el ultimo id, nombre y path
                        $archivo_id = $archivo->id;
                        $listaArchivos[] = $archivo->id;
                        $nombre_orig = $archivo->nombre;
                        $path_orig = $archivo->path;
                        if (!in_array($datos['archivo_contenido'], ['',null]) || !in_array($datos['archivo_input'], ['',null])) {
                            $exists = Storage::disk('public')->exists($archivo->path);
                            if($exists){
                                Storage::disk('public')->delete($archivo->path);
                            }
                        }
                    }
                    if (!in_array($datos['archivo_contenido'], ['',null]) || !in_array($datos['archivo_input'], ['',null])) {
                        if (count($listaArchivos) > 1) {
                            $eliminarArchivo = \App\Models\Archivo::whereIn('id',$listaArchivos)->forceDelete();
                        }
                    }
                }

                //almacena el nuevo archivo en el path determinado definiendo si cambia o mantiene el nombre del archivo
                if (!in_array($datos['archivo_contenido'], ['',null]) || !in_array($datos['archivo_input'], ['',null]) ) {
                    // if ($datos['archivo_contenido'] !== '' || $datos['archivo_input'] !== '') {
                        // $MimeType = $request->file('archivo_documentos')->getClientMimeType();
                        $nombre_archivo = ($nombre != $nombre_orig ? $nombre_archivo : substr($path_orig,strrpos($path_orig,"/")));

                        if ($tipo_documento->nombre == 'PRE-FORMAS') {
                            $path .= '/'.$nombre_archivo;
                            Storage::disk('public')->put($path, $datos['archivo_contenido']);

                        }else{
                            $path = Storage::disk('public')->putFileAs(
                                $path, $datos['archivo_input'], $nombre_archivo
                            );
                        }

                    // }
                }



                $nombre = ($nombre != 'nombre_default' ? ($nombre != $nombre_orig ? $nombre : $nombre_orig) : $nombre_orig);
                $path = ($nombre != $nombre_orig ? ($path != '' ? $path : $path_orig) : $path_orig );
                
                $tipo_archivo = \App\Models\TipoArchivo::where('nombre',$tipo_archivo_nombre)->select('id')->first();

                $formato = \App\Models\Formato::firstOrCreate(
                    ['nombre' => $formatoArchivo]
                );
                $formato_id = $formato->id;

                if ($tipo_archivo){
                    if ($archivo_id != 0) {
                        $dataArchivo['id'] = $archivo_id;
                    }
                    $dataArchivo['nombre'] = $nombre;
                    $dataArchivo['path'] = $path;
                    $dataArchivo['user_id'] = $datos['user_id'];
                    $dataArchivo['formato_id'] = $formato_id;
                    $dataArchivo['tipo_archivo_id'] = $tipo_archivo->id;
                    $dataArchivo['permisos_archivo'] = '{owner:rwx,group:rw-,other:r--}';

                    if ($archivo_id != 0 && count($listaArchivos) == 1) {
                        $archivo = \App\Models\Archivo::where('id',$archivo_id)
                            ->update($dataArchivo);
                    }else{
                        $archivo = \App\Models\Archivo::create($dataArchivo);
                    }

                    if (!$archivo){

                        $view = $route_error;
                        $errors += 1;
                        $errorsMsg = 'error_archivo';
                        goto end;
                    }
                    if ($archivo_id == 0) {
                        $archivo_id = $archivo->id;
                    }
                    
                    $asociarArchivoCamposBusqueda = [$nombreCampoDatoProceso => $idProceso, 'archivo_id' => $archivo_id];
                    // asociar el archivo con la tabla correspondiente
        
                    if (count($listaArchivos) > 1) {
                        $eliminarArchivosAsociados = $tablaAsociarArchivo->where($nombreCampoDatoProceso, $idProceso)
                            ->whereIn('archivo_id',$listaArchivos)
                            ->forceDelete();
                    //SE DESHABILITA PORQUE ELIMINA EL REGISTRO Y SE REGISTRA CON UN NUEVO ID, DESPERDICIANDO ESPACIOS
                    // }elseif (count($listaArchivos) == 1) {
                        // $eliminarArchivosAsociados = $tablaAsociarArchivo->where([[$nombreCampoDatoProceso, $idProceso],['tipo_documento_id',$tipo_documento_id]])
                        //     ->whereIn('archivo_id',$listaArchivos)
                        //     ->forceDelete();
                    }elseif (isset($datos['unique'])) {
                        $eliminarArchivosAsociados = $tablaAsociarArchivo->where([[$nombreCampoDatoProceso, $idProceso],['tipo_documento_id',$tipo_documento_id]])->get();
                        if (count($eliminarArchivosAsociados) > 1) {
                            $tablaAsociarArchivo->where([[$nombreCampoDatoProceso, $idProceso],['tipo_documento_id',$tipo_documento_id]])->forceDelete();
                        }
                    }

                    $tablaAsociarArchivo = $tablaAsociarArchivo->updateOrCreate(
                        $asociarArchivoCamposBusqueda,
                        ['tipo_documento_id' => $tipo_documento_id, 'archivo_id' => $archivo_id]
                    );

                    if (!$tablaAsociarArchivo) {
                        $view = $route_error;
                        $errors += 1;
                        $errorsMsg = 'error_asociar';
                        goto end;

                    }
                    
                    $okMsg = 'Se registro la información del archivo correctamente.';
                    $retorno = $tablaAsociarArchivo;

        // echo count($archivoProceso)."\n";
        // echo $nombre."\n";
        // echo $path.'|'."\n";
        // echo print_r($listaArchivos);
        // echo '|'.$archivo_id."\n";
        // print_r($dataArchivo);


                }else{

                    $view = $route_error;
                    $errors += 1;
                    $errorsMsg = 'error_archivo';
                    goto end;
                }

            }else{

                $view = $route_error;
                $errors += 1;
                $errorsMsg = 'error_documento';
                goto end;
            }
                 
        //print_r($viewWith['keyWords']);

        end:
        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ( $datos['peticion'] == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                flash()->error($errorsMsg);
                return redirect($view);
            }
        }else{
            DB::commit();

            if ( $datos['peticion'] == 'local' ) {
                return $retorno;
            }else if ($this->peticion == 'ajax') {
                return $retorno;
            }else{
                flash()->success($okMsg);
                return view($view)->with($retorno);
            }

        }
    }


    public function datosCrearDocumento($proceso,$request)
    {
        //$proceso [institucion,iniciativa,inscripcion,validador],$datos [view,institucionId,origen,tipo_documento,archivo_id,archivo_nombre,archivo_contenido,archivo_input,user_id,route_error]

        $errorsMsg = '';
        $okMsg = '';
        $errors = 0;
        $nombre = '';
        $archivoFormato = null;
        $MimeType = '';
        $peticion = $request['peticion'];
        switch ($proceso) {
            case 'institucion':
                if (!isset($request['institucionId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_institucion';
                    goto end;
                }

                $datoProceso = 'institucionId';
                $idProceso = $request['institucionId'];
                $nombreCampoDatoProceso = 'institucion_id';
                $tablaProceso = new \App\Models\Admin\Institucion;
                $error_tabla_proceso = 'error_institucion';
                $tablaAsociarArchivo = new \App\Models\Admin\DocumentosInstitucion;
                $nombreTablaAsociarArchivo = 'documentos_institucion';
                $texto_error_proceso = 'la institución';
                
                break;
            case 'alianza':
                
                if (!isset($request['alianzaId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_alianza';
                    goto end;
                }

                $datoProceso = 'alianzaId';
                $idProceso = $request['alianzaId'];
                $nombreCampoDatoProceso = 'alianza_id';
                $tablaProceso = new \App\Models\Alianza;
                $error_tabla_proceso = 'error_alianza';
                $tablaAsociarArchivo = new \App\Models\DocumentosAlianza;
                $nombreTablaAsociarArchivo = 'documentos_alianza';
                $texto_error_proceso = 'la alianza';

                break;
            case 'iniciativa':
                if (!isset($request['iniciativaId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_iniciativa';
                    goto end;
                }

                $datoProceso = 'iniciativaId';
                $idProceso = $request['iniciativaId'];
                $nombreCampoDatoProceso = 'iniciativa_id';
                $tablaProceso = new \App\Models\Iniciativa;
                $error_tabla_proceso = 'error_iniciativa';
                $tablaAsociarArchivo = new \App\Models\DocumentosIniciativa;
                $nombreTablaAsociarArchivo = 'documentos_iniciativa';
                $texto_error_proceso = 'la iniciativa';

                break;
            case 'oportunidad':
                if (!isset($request['oportunidadId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_oportunidad';
                    goto end;
                }

                $datoProceso = 'oportunidadId';
                $idProceso = $request['oportunidadId'];
                $nombreCampoDatoProceso = 'oportunidad_id';
                $tablaProceso = new \App\Models\Oportunidad;
                $error_tabla_proceso = 'error_oportunidad';
                $tablaAsociarArchivo = new \App\Models\DocumentosOportunidad;
                $nombreTablaAsociarArchivo = 'documentos_oportunidad';
                $texto_error_proceso = 'la oportunidad';
                
                break;
            case 'inscripcion':
                
                if (!isset($request['inscripcionId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_inscripcion';
                    goto end;
                }

                $datoProceso = 'inscripcionId';
                $idProceso = $request['inscripcionId'];
                $nombreCampoDatoProceso = 'inscripcion_id';
                $tablaProceso = new \App\Models\Inscripcion;
                $error_tabla_proceso = 'error_inscripcion';
                $tablaAsociarArchivo = new \App\Models\DocumentosInscripcion;
                $nombreTablaAsociarArchivo = 'documentos_inscripcion';
                $texto_error_proceso = 'la inscripción';
                
                break;
            case 'identidad':
                
                if (!isset($request['userId'])) {
                    $errors += 1;
                    $errorsMsg = 'error_user';
                    goto end;
                }

                $datoProceso = 'userId';
                $idProceso = $request['userId'];
                $nombreCampoDatoProceso = 'user_id';
                $tablaProceso = new \App\User;
                $error_tabla_proceso = 'error_user';
                $tablaAsociarArchivo = new \App\Models\DocumentosUser;
                $nombreTablaAsociarArchivo = 'documentos_user';
                $texto_error_proceso = 'el usuario';

                break;
            default:
                $view = $route_error;
                $errors += 1;
                $errorsMsg = 'error_proceso';
                goto end;

                break;

        }


        //buscar el registro a partir del id del proceso recibido
        $tablaProceso = $tablaProceso->find($idProceso);

        if ( empty($tablaProceso) ) {
            $view = $route_error;
            $errors += 1;
            $errorsMsg = $error_tabla_proceso;
            goto end;
        }else{
            $idProceso = $tablaProceso->id;
        }
        
        // $alianza = \App\Models\Alianza::find($alianza_id);

        // ya no es necesario porque se esta recibiendo
        // $tipo_documento_nombre = 'PRE-FORMAS';
        // $clase_documento_nombre = 'ALIANZA';
        // $request['tipo_documento'] = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
        //         ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
        //         ->pluck('id')->first();

        // $tipo_documento = \App\Models\TipoDocumento::where('id',$request['tipo_documento'])->pluck('nombre')->first();
        /*
        if ( $request->file('archivo_input') != null ) {
            $nombre = str_replace(' ', '_', $request->file('archivo_input')->getClientOriginalName());
            $archivoFormato = $request->file('archivo_input')->getClientOriginalExtension();
            $MimeType = $request->file('archivo_input')->getClientMimeType();
            $request['archivo_input'] = \File::get($request->file('archivo_input'));
        }
        */

        $route = $request['route'];
        $datos['peticion'] = 'local';
        $datos['view'] = $route;
        $datos[$datoProceso] = $idProceso;
        if (isset($request['unique'])) {
            //unique se coloca si debe eliminar los demas archivos del mismo tipo, de lo contrario se omite
            $datos['unique'] = $request['unique'];
        }
        $datos['tipo_documento'] = $request['tipo_documento'];
        $datos['archivo_id'] = (isset($request['archivo_id']) ? $request['archivo_id'] : 0);
        $datos['archivo_nombre'] = (isset($request['nombre']) ? $request['nombre'] : $nombre);
        $datos['archivo_formato'] = (isset($request['archivo_formato']) ? $request['archivo_formato'] : $archivoFormato);
        $datos['archivo_MimeType'] = (isset($request['archivo_MimeType']) ? $request['archivo_MimeType'] : $MimeType);
        $datos['archivo_contenido'] = (isset($request['archivo_contenido']) ? $request['archivo_contenido'] : '');
        $datos['archivo_input'] = $request['archivo_input'];
        $datos['user_id'] = $request['user_id'];
        $datos['route_error'] = (isset($request['route_error']) ? $request['route_error'] : $route);

        DB::beginTransaction();

        $crearDocumento = $this->crearDocumento($proceso,$datos);
        if ($crearDocumento === 'error_alianza') {
            $errors += 1;
            $errorsMsg = 'No se encontro '.$texto_error_proceso.'.';
            goto end;
        }elseif ($crearDocumento === 'error_archivo') {
            $errors += 1;
            $errorsMsg = 'Error al registrar los datos del archivo.';
            goto end;
        }elseif ($crearDocumento === 'error_asociar') {
            $errors += 1;
            $errorsMsg = 'Error al asociar el documento con '.$texto_error_proceso.'.';
            goto end;
        }elseif ($crearDocumento === 'error_documento') {
            $errors += 1;
            $errorsMsg = 'No se selecciono algún documento.';
            goto end;
        }elseif (is_string($crearDocumento) ) {
            $errors += 1;
            $errorsMsg = 'Ocurrio un error: '.$crearDocumento;
            goto end;
        }else{
            $okMsg = 'El documento fue almacenado correctamente.';
        }

        
        end:
        // return $crearDocumento;

        if( isset($request['peticion']) && $request['peticion'] == 'local' ){
            if ($errors == 0) {
                $okMsg = $crearDocumento;
            }
        }

        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ( $peticion == 'local' ) {
                return $errorsMsg;
            }else if ($peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                return redirect($route);
            }
        }else{
            DB::commit();

            if ( $peticion == 'local' || $peticion == 'ajax') {
                return $okMsg;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return redirect($route);
            }
        }

    }


    
    /**
     * @param $busqueda
     * @return mixed
     */
    public function editarDocumento($tipo_documento, $datos)
    {   
        $retorno = false;
        $errors = 0;
        $returnMsg = [];


        end:
        if ($errors > 0) {
            $retorno['errors'] = $errors;
            $retorno['returnMsg'] = $returnMsg;
        }
        return $retorno;
    }
}

