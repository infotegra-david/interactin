<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreatePasosInscripcionRequest;
use App\Http\Requests\Validation\UpdatePasosInscripcionRequest;
use App\Repositories\Validation\PasosInscripcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Validation\PasosInscripcion;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\TipoPaso;
use PDF;
use App\Http\Traits\Emails;
use App\Http\Traits\Validador;

class PasosInscripcionController extends AppBaseController
{
    use Authorizable;
    use Emails;
    use Validador;
    /** @var  PasosInscripcionRepository */
    private $pasosInscripcionRepository;
    private $pasosInscripcion;
    private $user;
    private $campusApp;
    private $campusAppFound;
    private $tipoPaso;
    private $peticion;
    private $viewWith = [];

    public function __construct(PasosInscripcionRepository $pasosInscripcionRepo, PasosInscripcion $pasosInscripcionModel, TipoPaso $tipoPasoModel, Request $request)
    {
        $this->middleware(function ($request, $next) {

            if (Auth::user()) {
                $this->user = Auth::user();
                if (isset($this->user->campus)) {
                    $this->campusApp = $this->user->campus;
                    if (session('campusApp') == null) {
                        session(['campusApp' => ($this->campusApp->first()->id ?? 0 ) ]);
                        session(['campusAppNombre' => ($this->campusApp->first()->nombre ?? 'No pertenece a alguna institución.' )]);
                        session(['institucionAppNombre' => ($this->campusApp->first()->institucion->nombre ?? 'Sin institución.' )]);
                    }
                    if (count($this->campusApp)) {
                        $this->campusApp = $this->campusApp->pluck('nombre','id');
                    }else{
                        $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                    }
                }else{
                    $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                }
            }

            if( session('campusApp') != null && session('campusApp') != 0 ){
                $campusAppId = session('campusApp');
            }else{
                return redirect(route('home'));
            }
            if ( Auth::user() !== NULL) {
                $this->campusAppFound = \App\Models\Admin\Campus::find($campusAppId);
                if( !count($this->campusAppFound) ){
                    Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                    return redirect(route('home'));
                }
            }

            $this->viewWith = array_merge($this->viewWith,['campusApp' => $this->campusApp]);

            return $next($request);
        });

        $this->pasosInscripcionRepository = $pasosInscripcionRepo;
        $this->pasosInscripcion = $pasosInscripcionModel;
        $this->tipoPaso = $tipoPasoModel;

        //valida si es una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }
        
        $this->viewWith = array_merge($this->viewWith,['peticion' => $this->peticion]);
    }

    /**
     * Display a listing of the PasosInscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // return redirect(route('home'));

        return view('validation.interchanges.pasos_inscripcions.index')
            ->with($this->viewWith);

        // $this->pasosInscripcionRepository->pushCriteria(new RequestCriteria($request));
        // $pasosInscripcions = $this->pasosInscripcionRepository->paginate(20);

        // $this->viewWith = ['pasosInscripcions' => $pasosInscripcions];
        
        // return view('validation.interchanges.pasos_inscripcions.index')
        //     ->with($this->viewWith);
    }

    /**
     * Display a listing of the Pasosinscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function datosNotificarValidador($request)
    {
        $returnMsg = [];
        
        //notificar a el validador en caso que este asociado al paso 
        $datos = $request;
        // $datos['paso'] = 123456;
        $datos['accion'] = 'creacion';
        $datos['origen_peticion'] = 'local';
        //$datos['tipo_paso_id'] = $tipo_paso_id;
        
        $notificarValidador = $this->notificarValidador('inscripcion', $datos);
        if (isset($notificarValidador['errors'])) {
            $returnMsg['ok'] = false;
            $returnMsg['returnMsg'] = $notificarValidador['returnMsg'];
        }elseif( $notificarValidador === true ){
            $returnMsg['ok'] = true;
        }elseif( $notificarValidador != false ){
            $returnMsg['ok'] = true;
            $returnMsg['returnMsg'] = $notificarValidador;
        }

        return $returnMsg;
    }


    /**
     * Display the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($inscripcion_id,$paso_id ='',$peticion ='')
    {

        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        $inscripcionId = 0;
        $dataInscripcion = '';
        $dataUsers = 0;
        $pasosInscripcion = '';
        $archivosAdjuntos = '';
        $viewWith = $this->viewWith;

        $user_actual = $this->user;
        //Validar EL ROL DE generar_documento 
        $GenerarDocumento = false;
        $pre_formas = [];


        if ( empty($inscripcion) ) {
            Flash::error('Inscripcion no encontrada');

            return redirect(route('interchanges.validations_interchanges.index'));
        }else{
            $inscripcionId = $inscripcion->id;
        }

        //$pasosInscripcion = $this->pasosInscripcion->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
        $pasosInscripcion = DB::table('pasos_inscripcion')->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                    ->join('tipo_paso', 'pasos_inscripcion.tipo_paso_id', '=', 'tipo_paso.id')
                    ->join('users', 'pasos_inscripcion.user_id', '=','users.id' )
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->leftJoin('user_tipo_paso', 'users.id', '=', 'user_tipo_paso.user_id')
                    ->where('pasos_inscripcion.inscripcion_id', $inscripcionId)
                    ->where('estado.uso', 'VALIDATOR');

        if ( $peticion !='' ) {
            $this->peticion = $peticion;
        }

        //si el estado de la inscripcion es activa no permitira editar el registro
        $editar = false;
        $estadoActiva = $estados = \App\Models\Estado::where('id',$inscripcion->estado_id)->select('id','nombre')->first();
        if ($estadoActiva->nombre != 'ACTIVA') {
            $editar = true;
        }

        if ( $paso_id !='' ) {

            $pasosInscripcion = $pasosInscripcion->where('pasos_inscripcion.id', $paso_id)
                ->select('pasos_inscripcion.*','estado.nombre As estado_nombre',DB::raw("concat('#',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ','\'',tipo_paso.titulo,'\'') AS tipo_paso_titulo"),'users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
                //echo $pasosInscripcion->toSql();
                $pasosInscripcion = $pasosInscripcion->first();

            if ( empty($pasosInscripcion) ) {
                Flash::error('No se ha encontrado el registro del paso.');
                return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
            }else{
                $viewWith = array_merge($viewWith,['pasosInscripcion' => $pasosInscripcion]);
                $view = 'validation.interchanges.pasos_inscripcions.show';
            }


        }else{
            
            $viewWith = array_merge($viewWith,app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local'));
            
            //asegura que en los datos de la inscripcion no aparezca el boton de editar
            $viewWith = array_merge($viewWith, ['editar_paso' => false]);
            
            //si la inscripcion no esta activa trae los datos para crear un registro de validacion
            if ( $viewWith['dataInscripcion']['estado_nombre'] != 'ACTIVA' ) {

                $viewWithCreate = $this->create($inscripcion_id, 'local');
                
                if ( is_array($viewWithCreate) ) {
                    $viewWith = array_merge($viewWith, $viewWithCreate);
                }elseif($viewWithCreate === 'error_editar'){
                    $editar = false;
                }
            }

            //lista de registros con el mismo tipo de paso
            $pasosInscripcion = $pasosInscripcion->orderBy('pasos_inscripcion.updated_at','desc')
                    ->groupBy('pasos_inscripcion.id')
                    ->select('pasos_inscripcion.*','estado.nombre As estado_nombre',DB::raw("concat('#',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ','\'',tipo_paso.titulo,'\'') AS tipo_paso_titulo"),'users.id AS user_id','users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
            //echo $pasosInscripcion->toSql();
            $pasosInscripcion = $pasosInscripcion->get();
            // $pasosInscripcion = $pasosInscripcion->paginate(20);
            //$pasosInscripcion = json_decode(json_encode($pasosInscripcion),true);

            if ( empty($pasosInscripcion) ) {
                Flash::error('No se ha encontrado el registro del paso.');
                return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
            }
            
            
            //verifica si tiene el rol para generar el documento
            $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
            if ( $hasAllRoles ) {

                $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange')->select('id','nombre')->get()->toArray();
                $roleValidador = Role::where('name','validador')->pluck('id');
                $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id')
                            ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos, 'id') )
                            ->where('model_has_roles.role_id',$roleValidador )
                            ->orderBy('user_tipo_paso.orden','desc')
                            ->first();
                //compara si el ultimo validador es es actual para mostrarle la opcion
                if ($ultimoValidador->id == $user_actual->id) {
                    $GenerarDocumento = true;
                    
                    $institucionId = $this->user->campus->first()->institucion->id;

                    $tipo_documento_nombre = 'PRE-FORMAS';

                    $clase_documento_nombre = 'INSCRIPCION';
                    $tipo_documento_id = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                        ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
                        ->pluck('tipo_documento.id')->first();
                    $IdDocumentosInscripcion =  \App\Models\DocumentosInscripcion::join('tipo_documento','documentos_inscripcion.tipo_documento_id','tipo_documento.id')
                                ->where('documentos_inscripcion.inscripcion_id',$inscripcionId)
                                ->where('documentos_inscripcion.tipo_documento_id',$tipo_documento_id)
                                ->pluck('documentos_inscripcion.archivo_id')->toArray();

                    $clase_documento_nombre = 'INSTITUCION';
                    $tipo_documento_id = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                        ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
                        ->pluck('tipo_documento.id')->first();

                    
                    $IdDocumentosInstitucion =  \App\Models\Admin\DocumentosInstitucion::join('tipo_documento','documentos_institucion.tipo_documento_id','tipo_documento.id')
                                ->where('documentos_institucion.institucion_id',$institucionId)
                                ->where('documentos_institucion.tipo_documento_id',$tipo_documento_id)
                                ->pluck('documentos_institucion.archivo_id')->toArray();

                    $pre_formas_inscripcion =  \App\Models\Archivo::whereIn('id',$IdDocumentosInscripcion)->select(DB::raw('concat("GUARDADO - ",nombre) AS nombre'),'id','path')->get()->toArray();
                    $pre_formas_institucion =  \App\Models\Archivo::whereIn('id',$IdDocumentosInstitucion)->select('nombre','id','path')->get()->toArray();

                    $pre_formas =  array_merge($pre_formas_inscripcion,$pre_formas_institucion);

                }

            }


            $view = 'validation.interchanges.show';
            
            $viewWith = array_merge($viewWith, ['pasosInscripcion' => $pasosInscripcion, 'GenerarDocumento' => $GenerarDocumento, 'pre_formas' => $pre_formas]);
                
        }

        $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'inscripcionId' => $inscripcionId, 'user_actual' => $user_actual->id, 'editar' => $editar]);
        //print_r($viewWith);
        if ( $peticion == 'local' ) {
            return $viewWith;
        }else{
            return view($view)->with($viewWith);
        }
    }

    /**
     * Show the form for editing the specified Pasosinscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function pdf($inscripcion_id, Request $request)
    {   
        
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('interchanges.validations_interchanges.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $viewWith = $this->viewWith;
        $viewWith = array_merge($viewWith,$this->show($inscripcion_id,'', 'local'));
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'limpio']);
        $view = 'validation.interchanges.show';
        //$view = 'welcome';
        
        //$pdf = PDF::loadView($view, $viewWith);
        //return $pdf->download('interchange-'.$inscripcion_id.'.pdf');
        //return  PDF::loadView($view, $viewWith)->save( storage_path().'/interchange-'.$inscripcion_id.'.pdf')->stream('interchange-'.$inscripcion_id.'.pdf');
        if ( isset($request['tipo']) ) {
            if ( $request['tipo'] == 1 ) {
                return view($view)->with($viewWith);
            }elseif ( $request['tipo'] == 2 ) {
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }elseif ( $request['tipo'] == 3 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'basico']);
                //return view($view)->with($viewWith);
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }elseif ( $request['tipo'] == 4 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'ajax']);
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }
        }else{
            return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
        }
    }

    /**
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */


    /**
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function print($inscripcion_id, Request $request)
    {   
        
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = 'files.editor_word_drag_drop';
        $route_back = route('interchanges.validations_interchanges.show',$inscripcion_id);
        $route_new = '';
        $this->user = Auth::user();
        $user_actual = $this->user->id;

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange')->select('id','nombre')->get()->toArray();
        $roleValidador = Role::where('name','validador')->pluck('id');
        $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id','user_tipo_paso.tipo_paso_id')
                    ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos, 'id') )
                    ->where('model_has_roles.role_id',$roleValidador )
                    ->orderBy('user_tipo_paso.orden','desc')
                    ->first();
        //compara si el ultimo validador es es actual para mostrarle la opcion
        if ($ultimoValidador->id != $user_actual) {
            $view = route('interchanges.validations_interchanges.show',$inscripcion_id);
            $errors += 1;
            $errorsMsg = 'No tiene permitido imprimir el documento.';
            goto end;
        }

        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {

            $view = route('interchanges.validations_interchanges.index');
            $errors += 1;
            $errorsMsg = 'No se encontro la inscripcion.';
            goto end;
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $ruta_guardar = ['interchanges.validations_interchanges.documents.store',$inscripcion_id];
        $editar = ['nombre' => true];

        $estadoGenerarDocumento = \App\Models\Estado::where('nombre','GENERAR DOCUMENTO')->pluck('id')->first();

        $storeUpdateData['user_id'] = $ultimoValidador->id;
        $storeUpdateData['inscripcion_id'] = $inscripcion_id;
        $storeUpdateData['paso_inscripcion_id'] = 0;
        $storeUpdateData['tipo_paso_id'] = $ultimoValidador->tipo_paso_id;
        $storeUpdateData['estado_id'] = $estadoGenerarDocumento;
        $storeUpdateData['observacion'] = 'Se imprimio el documento.';
        $thisStoreUpdate = $this->storeUpdate($storeUpdateData,'','local');
        
        if (!is_string($thisStoreUpdate) && !is_array($thisStoreUpdate)) {
            return $thisStoreUpdate;
        }
        $viewWith = $this->viewWith;
        //$viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'normal']);

        if (isset($request['pre_forma'])) {

            $archivo_id = $request['pre_forma'];
            
            $tipo_documento_nombre = 'PRE-FORMAS';
            $clase_documento_nombre = 'INSCRIPCION';
            $tipo_documento = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                    ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
                    ->select('tipo_documento.id')->first();

            if (session('campusApp') != null) {
                $institucion = \App\Models\Admin\Institucion::join('campus','institucion.id','campus.institucion_id')
                    ->where('campus.id',session('campusApp'))
                    ->select('institucion.id')->first();

                if ( count($institucion) ) {
                    $institucionId = $institucion->id;
                }
            }else{
                $institucionId = $this->user->campus->first()->institucion->id;
            }
            
            $viewError = ['interchanges.validations_interchanges.show',$inscripcion_id];

            $documentoDe = 'inscripcion';
            $datosDocumento = $this->verDocumento('inscripcion',['archivo_id' => $archivo_id, 'inscripcionId' => $inscripcion_id, 'view' => $viewError, 'peticion' => 'local' ]);
            if ( is_string($datosDocumento) && $datosDocumento === 'error_documento' ) {
                $documentoDe = 'institucion';
                $datosDocumento = $this->verDocumento('institucion',['archivo_id' => $archivo_id, 'institucionId' => $institucionId, 'view' => $viewError, 'peticion' => 'local' ]);

            }
            

            if ( is_string($datosDocumento) && $datosDocumento === 'error_documento' ) {

                $view = route('interchanges.validations_interchanges.show',$inscripcion_id);
                $errors += 1;
                $errorsMsg = 'No se encontro el documento.';
                goto end;
            }elseif ( is_string($datosDocumento) && $datosDocumento === 'error_proceso' ) {

                $view = route('interchanges.validations_interchanges.show',$inscripcion_id);
                $errors += 1;
                $errorsMsg = 'El nombre del proceso no se encuentra.';
                goto end;
            }elseif ( is_string($datosDocumento) && $datosDocumento === 'seleccione_documento' ) {

                $view = route('interchanges.validations_interchanges.show',$inscripcion_id);
                $errors += 1;
                $errorsMsg = 'Seleccione un documento.';
                goto end;
            }else{

                //obtiene todos los datos de la inscripcion y sus usuarios
                $datosInscripcion = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');

                $keyCoordExterno = $datosInscripcion['keyCoordExterno'];
                $keyCoordInterno = $datosInscripcion['keyCoordInterno'];

                $dataUsers = $datosInscripcion['dataUsers'];
                $dataInscripcion = $datosInscripcion['dataInscripcion'];

                // opciones para mostrar request ['keyword','value']
                $showData = 'value';
                if (isset($request['accion']) ){
                    if ( $request['accion'] == 'edicion') {
                        $showData = 'keyword';
                    }
                }

                $duracion = str_replace(["MESES","AÑOS"], ["month","year"], $dataInscripcion['duracion']);
                $dataInscripcion['fecha_final'] = strtotime ( '+'.$duracion , strtotime ( $dataInscripcion['fecha_inicio'] ) );
                $dataInscripcion['fecha_final'] = date('Y-m-d', $dataInscripcion['fecha_final'] );

                $keyWords = array(
                    'ESTUDIANTE_NOMBRE' => array('keyword' => 'ESTUDIANTE_NOMBRE', 'name' => 'estudiante nombre', 'value' => strtoupper($dataUsers[$keyEstudianteId]['nombres'].' '.$dataUsers[$keyEstudianteId]['apellidos'])),
                    'ESTUDIANTE_CARGO' => array('keyword' => 'ESTUDIANTE_CARGO', 'name' => 'estudiante cargo', 'value' => strtoupper($dataUsers[$keyEstudianteId]['cargo'])),
                    'ESTUDIANTE_TELEFONO' => array('keyword' => 'ESTUDIANTE_TELEFONO', 'name' => 'estudiante telefono', 'value' => strtoupper($dataUsers[$keyEstudianteId]['telefono'])),
                    'ESTUDIANTE_EMAIL' => array('keyword' => 'ESTUDIANTE_EMAIL', 'name' => 'estudiante email', 'value' => strtoupper($dataUsers[$keyEstudianteId]['usuario_email'])),

                    'COORDINADOR_NOMBRE' => array('keyword' => 'COORDINADOR_NOMBRE', 'name' => 'coordinador nombre', 'value' => strtoupper($dataUsers[$keyCoordExterno]['nombres'].' '.$dataUsers[$keyCoordInterno]['apellidos'])),
                    'COORDINADOR_CARGO' => array('keyword' => 'COORDINADOR_CARGO', 'name' => 'coordinador cargo', 'value' => strtoupper($dataUsers[$keyCoordExterno]['cargo'])),
                    'COORDINADOR_TELEFONO' => array('keyword' => 'COORDINADOR_TELEFONO', 'name' => 'coordinador telefono', 'value' => strtoupper($dataUsers[$keyCoordExterno]['telefono'])),
                    'COORDINADOR_EMAIL' => array('keyword' => 'COORDINADOR_EMAIL', 'name' => 'coordinador email', 'value' => strtoupper($dataUsers[$keyCoordExterno]['usuario_email'])),

//existira insitucion origen y destino, falta definir como se mostraran
                    'INSTITUCION_ORIGEN_TIPO' => array('keyword' => 'INSTITUCION_ORIGEN_TIPO', 'name' => 'institucion origen tipo', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['tipo_institucion_nombre'])),
                    'INSTITUCION_ORIGEN_NOMBRE' => array('keyword' => 'INSTITUCION_ORIGEN_NOMBRE', 'name' => 'institucion origen nombre', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['nombre'])),
                    'INSTITUCION_ORIGEN_DIRECCION_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_DIRECCION_CAMPUS_P', 'name' => 'institucion origen direccion campus principal', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['campus_direccion'])),
                    'INSTITUCION_ORIGEN_TELEFONO_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_TELEFONO_CAMPUS_P', 'name' => 'institucion origen telefono campus principal', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['campus_telefono'])),
                    'INSTITUCION_ORIGEN_POSTAL_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_POSTAL_CAMPUS_P', 'name' => 'institucion origen postal campus principal', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['campus_codigo_postal'])),
                    'INSTITUCION_ORIGEN_PAIS_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_PAIS_CAMPUS_P', 'name' => 'institucion origen_pais campus principal', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['ciudad']['pais_nombre'])),
                    'INSTITUCION_ORIGEN_CIUDAD_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_CIUDAD_CAMPUS_P', 'name' => 'institucion origen ciudad campus principal', 'value' => strtoupper($dataUsers[$keyCoordInterno]['institucion']['ciudad']['ciudad_nombre'])),

                    'INSTITUCION_DESTINO_TIPO' => array('keyword' => 'INSTITUCION_DESTINO_TIPO', 'name' => 'institucion destino tipo', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['tipo_institucion_nombre'])),
                    'INSTITUCION_DESTINO_NOMBRE' => array('keyword' => 'INSTITUCION_DESTINO_NOMBRE', 'name' => 'institucion destino nombre', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['nombre'])),
                    'INSTITUCION_DESTINO_DIRECCION_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_DIRECCION_CAMPUS_P', 'name' => 'institucion destino direccion campus principal', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['campus_direccion'])),
                    'INSTITUCION_DESTINO_TELEFONO_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_TELEFONO_CAMPUS_P', 'name' => 'institucion destino telefono campus principal', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['campus_telefono'])),
                    'INSTITUCION_DESTINO_POSTAL_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_POSTAL_CAMPUS_P', 'name' => 'institucion destino postal campus principal', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['campus_codigo_postal'])),
                    'INSTITUCION_DESTINO_PAIS_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_PAIS_CAMPUS_P', 'name' => 'institucion destino pais campus principal', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['ciudad']['pais_nombre'])),
                    'INSTITUCION_DESTINO_CIUDAD_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_CIUDAD_CAMPUS_P', 'name' => 'institucion destino ciudad campus principal', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['ciudad']['ciudad_nombre'])),

                    'INSCRIPCION_ID' => array('keyword' => 'INSCRIPCION_ID', 'name' => 'inscripcion id', 'value' => strtoupper($dataInscripcion['id'])),
                    'INSCRIPCION_FACULTADES' => array('keyword' => 'INSCRIPCION_FACULTADES', 'name' => 'inscripcion facultades', 'value' => strtoupper(implode(", ", array_column($dataInscripcion['facultades'], 'facultad_nombre')) )),
                    'INSCRIPCION_PROGRAMAS' => array('keyword' => 'INSCRIPCION_PROGRAMAS', 'name' => 'inscripcion programas', 'value' => strtoupper(implode(", ", array_column($dataInscripcion['programas'], 'programa_nombre')) )),
                    'INSCRIPCION_DURACION' => array('keyword' => 'INSCRIPCION_DURACION', 'name' => 'inscripcion duracion', 'value' => strtoupper($dataInscripcion['duracion'])),
                    'INSCRIPCION_FECHA_INICIO' => array('keyword' => 'INSCRIPCION_FECHA_INICIO', 'name' => 'inscripcion fecha inicio', 'value' => (empty($dataInscripcion['fecha_inicio']) ? $dataInscripcion['fecha_inicio'] : date('Y-m-d', strtotime($dataInscripcion['fecha_inicio']))) ),
                    'INSCRIPCION_FECHA_FIN' => array('keyword' => 'INSCRIPCION_FECHA_FIN', 'name' => 'inscripcion fecha fin', 'value' => $dataInscripcion['fecha_final']),
                    'INSCRIPCION_FECHA_CREACION' => array('keyword' => 'INSCRIPCION_FECHA_CREACION', 'name' => 'inscripcion fecha creacion', 'value' => strtoupper($dataInscripcion['created_at'])),
                    'INSCRIPCION_FECHA_ACTUALIZACION' => array('keyword' => 'INSCRIPCION_FECHA_ACTUALIZACION', 'name' => 'inscripcion fecha actualizacion', 'value' => strtoupper($dataInscripcion['updated_at'])),
                );
                if ($showData == 'value') {
                    foreach ($keyWords as $key => $value) {
                        $datosDocumento['documento_contenido'] = str_replace('['.$key.']', $value['value'],$datosDocumento['documento_contenido']);
                    }
                }
                //para poder guardar una copia de la pre-forma editada por el usuario se cambia el id del tipo de documento asociado a la institucion por el asociado a la inscripcion 

                if ($documentoDe == 'institucion') {
                    $datosDocumento['documento']['tipo_documento'] = $tipo_documento->id;
                }

                $viewWith = array_merge($viewWith, $datosInscripcion);
                $viewWith = array_merge($viewWith, $datosDocumento);
                $viewWith = array_merge($viewWith, ['imprimir' => true, 'copiar' => true, 'editar' => $editar,]);
                $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'ruta_guardar' => $ruta_guardar, 'keyWords' => $keyWords, 'route_back' => $route_back, 'showData' => $showData, 'menuApp' => 'InterValidations', 'submenu1App' => 'Imprimir']);
            }

        }else{
            $view = route('interchanges.validations_interchanges.show',$inscripcion_id);
            $errors += 1;
            $errorsMsg = 'Seleccione un documento.';
            goto end;
        }

        /*
        //return view('files.editor')->with($viewWith);
        if (isset($request['tipo_editor'])) {
            if ($request['tipo_editor'] == 1) {
                $view = 'files.editor';
            }elseif ($request['tipo_editor'] == 2) {
                $view = 'files.editor_drag_drop';
            }elseif ($request['tipo_editor'] == 3) {
                $view = 'files.editor_word_drag_drop';
            }
        }*/


        //print_r($viewWith);

        end:
        if ($errors > 0) {
            //echo 'error <br>';

            if ( $this->peticion == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                return redirect($view);
            }
        }else{

            if ( $this->peticion == 'local' || $this->peticion == 'ajax') {
                return $viewWith;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return view($view)->with($viewWith);
            }
        }

    }

    /**
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */

    public function documents_store($inscripcion_id,Request $request)
    {
        //$proceso [institucion,iniciativa,inscripcion,validador],$datos [view,institucionId,origen,tipo_documento,archivo_id,archivo_nombre,archivo_contenido,archivo_input,user_id,route_error]
        $peticion = (isset($request['peticion']) ? $request['peticion'] : $this->peticion );

        $this->validate($request, [
            'tipo_documento' => 'required',
        ]);

        $errorsMsg = '';
        $okMsg = '';
        $errors = 0;
        $route = (isset($request['route']) ? $request['route'] : route('interchanges.index') );
        $route_error = route('interchanges.validations_interchanges.show',$inscripcion_id);
        $this->user = Auth::user();

        if ( $request->file('archivo_input') != null ) {
            $datos['nombre'] = str_replace(' ', '_', $request->file('archivo_input')->getClientOriginalName());
            $datos['archivo_formato'] = $request->file('archivo_input')->getClientOriginalExtension();
            $datos['archivo_MimeType'] = $request->file('archivo_input')->getClientMimeType();
            $request['archivo_input'] = \File::get($request->file('archivo_input'));
        }
        
        $proceso = 'inscripcion';
        $datos['inscripcionId'] = $inscripcion_id;
        $datos['peticion'] = 'local';
        $datos['user_id'] = $this->user->id;
        $datos['route'] = $route;
        $datos['route_error'] = $route_error;
        $datos['nombre'] = (isset($request['nombre']) ? $request['nombre'] : $datos['nombre']);
        $datos['archivo_contenido'] = $request['archivo_contenido'];
        $datos['archivo_input'] = (isset($request['archivo_input']) ? $request['archivo_input'] : '');
        $datos['tipo_documento'] = $request['tipo_documento'];
        //unique se coloca si debe eliminar los demas archivos del mismo tipo, de lo contrario se omite
        $datos['unique'] = true;
        
        
        $crearDocumento = $this->datosCrearDocumento($proceso,$datos);

        if (is_string($crearDocumento) ) {
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
                return redirect($route_error);
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
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($inscripcion_id,$paso_id)
    {
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('interchanges.validations_interchanges.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $pasoInscripcion = $this->pasosInscripcionRepository->findWithoutFail($paso_id);

        if (empty($pasoInscripcion)) {
            Flash::error('No se encontro el paso de la inscripcion');

            return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
        }

        if ($pasoInscripcion->user_id != $this->user->id) {
            Flash::error('No puede editar esta validación');

            return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
        }

        $datosInscripcion = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');

        $viewWith = $this->editCreateData($inscripcion,$paso_id);
        if (!is_array($viewWith) && $viewWith != '' )   {
            return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
        }

        $viewWith = array_merge($viewWith,$this->viewWith);
        
        $viewWith = array_merge($viewWith, $datosInscripcion);

        return view('validation.interchanges.pasos_inscripcions.edit')->with($viewWith);
    }

    /**
     * Show the form for creating a new PasosInscripcion.
     *
     * @return Response
     */
    public function create($inscripcion_id,$peticion ='')
    {
        $datosInscripcion = array();
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);
        
        if ($peticion != 'local') {

            if ( empty($inscripcion) ) {
                Flash::error('No se encontro la inscripcion');

                return redirect(route('interchanges.validations_interchanges.index'));
            }else{
                $inscripcion_id = $inscripcion->id;
            }

            $datosInscripcion = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');
        }
        $idPasoInscripcion = '';
        if ($peticion == 'local') {
            $idPaso = $this->pasosInscripcion->where('inscripcion_id',$inscripcion_id)->where('user_id',$this->user->id)->pluck('id');
            if (count($idPaso) > 1 || !count($idPaso)) {
                $idPasoInscripcion = '';
            }else{
                $idPasoInscripcion = $idPaso[0];
            }
        }

        $viewWith = $this->editCreateData($inscripcion,$idPasoInscripcion);
        if (!is_array($viewWith) && $viewWith != '' ) {
            if ($peticion == 'local') {
                return $viewWith;
            }else{
                return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
            }
        }else{
            $viewWith = array_merge($viewWith, $this->viewWith);
            $viewWith = array_merge($viewWith, $datosInscripcion);
        }
        
        if ($peticion == 'local') {
            return $viewWith;
        }else{
            return view('validation.interchanges.pasos_inscripcions.create')->with($viewWith);
        }
    }

    /**
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editCreateData($inscripcion,$paso_id ='')
    {
        $viewWith = $this->viewWith;
        $pasoInscripcion = 0;
        $user_actual = $this->user;
        $inscripcion_id = $inscripcion->id;

        if ($paso_id !='') {
            $pasoInscripcion = $this->pasosInscripcionRepository->findWithoutFail($paso_id);

            if (empty($pasoInscripcion)) {
                Flash::error('No se encontro el paso de la inscripcion');

                return redirect(route('interchanges.validations_interchanges.show',[$inscripcion_id]));
            }
        }

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange');
        $estadoInscripcion = \App\Models\Estado::where('id',$inscripcion->estado_id)->select('id','nombre')->first();
        
        if ($estadoInscripcion->nombre == 'ACTIVA') {
            Flash::error('No se pueden agregar o editar validaciones en esta inscripcion');

            return 'error_permitido';
        }

        $estados = \App\Models\Estado::where('uso','VALIDATOR');

        //verificar que el validador sea el ultimo de la lista para habilitar la opcion de ACTIVA
        $tipos_pasos_array = $tipos_pasos->select('id','nombre')->get()->toArray();
        $roleValidador = Role::where('name','validador')->pluck('id');
        $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id')
                    ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos_array, 'id') )
                    ->where('model_has_roles.role_id',$roleValidador )
                    ->orderBy('user_tipo_paso.tipo_paso_id','desc')
                    ->orderBy('user_tipo_paso.orden','desc')
                    ->first();

        //compara si el ultimo validador es es actual para mostrarle la opcion
        if ($ultimoValidador->id != $user_actual->id) {
            $estados = $estados->whereNotIn('nombre',['GENERAR DOCUMENTO','ACTIVA']);
        }else{
            $estados = $estados->whereNotIn('nombre',['GENERAR DOCUMENTO','APROBADO']);
        }
        /*
        //verifica si tiene el rol para generar el documento
        $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
        if ( $hasAllRoles ) {
        }else{
            $estados = $estados->whereNotIn('nombre',['GENERAR DOCUMENTO','ACTIVA']);
        }
        */
        $estados = $estados->pluck('nombre','id');

        $idAciva = array_search('ACTIVA', $estados->toArray());

        $campusAppId = session('campusApp');
        if (session('campusApp') == null) {
            $keys = array_keys($this->campusApp);
            $campusAppId = $this->campusApp[$keys[0]];
        }

        //los validadores estaban filtrados por los que pertenezcan al mismo campus que el usuario logueado
        //se quito esa condicion para que se permita a todos los que esten asignados por base de datos (user_tipo_paso)
        $validadores = \App\Models\Admin\Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->where('roles.name','validador')
            ->pluck('users.id');

        $tipos_pasos_id = $tipos_pasos->pluck('id');
        $validadoresXlosPasos = \App\Models\Admin\Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->join('user_tipo_paso', 'users.id', '=', 'user_tipo_paso.user_id')
            ->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
            ->whereIn('user_tipo_paso.tipo_paso_id',$tipos_pasos_id)
            ->orderBy('user_tipo_paso.orden','asc')
            ->select(DB::raw('CONCAT(user_tipo_paso.titulo,\' - \', users.email,\' (\',REPLACE(roles.name, \'_\', \' \'),\')\') AS name'),'users.id', 'user_tipo_paso.tipo_paso_id');

        //buscar el rol administrador
        // $role = Role::where('name','administrador')->get();
        // //validar si tiene  el rol administrador y filtrar los demas usuarios
        // if ( !$this->user->hasAllRoles($role) ) {
            $validadoresXlosPasos = $validadoresXlosPasos->where('users.id',$this->user->id);
            $validadoresResultado = $validadoresXlosPasos->get();
            
            if (!count($validadoresResultado)) {
                Flash::error('No tiene permitido agregar validaciones en esta inscripcion');

                return 'error_permitido';
            }
        // }else{

        //     $validadoresXlosPasos = $validadoresXlosPasos->whereIn('user_tipo_paso.user_id',$validadores);

        //     $validadoresXlosPasos = \App\Models\Admin\Role::select(DB::raw("'Seleccione un validador' AS name, '' AS id"))->union($validadoresXlosPasos);

        //     $validadoresResultado = $validadoresXlosPasos->get();
        // }

        $pasosAprobadosUsuario = \App\Models\Validation\PasosInscripcion::select('pasos_inscripcion.*')
                        ->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                        ->whereIn('pasos_inscripcion.tipo_paso_id',array_column($validadoresResultado->toArray(), 'tipo_paso_id') )
                        ->where('pasos_inscripcion.user_id',$user_actual->id )
                        ->where('pasos_inscripcion.inscripcion_id',$inscripcion_id )
                        ->whereIn('estado.nombre',['APROBADO','ACTIVA'] )
                        ->orderBy('pasos_inscripcion.created_at','asc')
                        ->get()
                        ->toArray();

        // echo '$pasosAprobadosUsuario:';
        // print_r($pasosAprobadosUsuario);

        // echo '$validadoresResultado->toArray():';
        // print_r($validadoresResultado->toArray());
    
        $tipos_pasos_faltantes = array_column($validadoresResultado->toArray(), 'tipo_paso_id');
        // echo '$tipos_pasos_faltantes:';
        // print_r($tipos_pasos_faltantes);

        $tipos_pasos_faltantes = array_diff($tipos_pasos_faltantes, array_column($pasosAprobadosUsuario, 'tipo_paso_id'));
        // echo '$tipos_pasos_faltantes:';
        // print_r($tipos_pasos_faltantes);

        $tipos_pasos = $tipos_pasos->whereIn('id',$tipos_pasos_faltantes)
            ->select(DB::raw("concat(replace(substr(nombre,instr(nombre,'paso')+4,2),'_',''),' - ',titulo) AS titulo"),'id')
            ->orderBy('id','asc')
            ->groupBy('id')
            ->limit(1)
            ->pluck('titulo','id');

        // echo "tipos_pasos:";
        // print_r($tipos_pasos);

        $keysTiposPasos = array_keys($tipos_pasos->toArray());

        $paso_id = $keysTiposPasos[0] ?? 0;

        //verifica si puede editar o crear un registro 
        $validarEditar = $this->validarEditar('editar',$user_actual->id,$inscripcion_id,$paso_id);
        if ($validarEditar['puedeEditar'] == false) {
            /*
            'GENERAR_DOCUMENTO'
            'VACIO'
            'DECLINADO'
            'REVISION_GENERAR'
            'RECHAZADO_USER'
            'RECHAZADO'
            'PASOS_INCOMPLETOS'
            'PRIMER_VALIDADOR'
            */
            if ($validarEditar['dondeSalio'] == 'PASOS_INCOMPLETOS') {

                Flash::error('No puede agregar o editar validaciones en esta inscripción, no se han registrados los datos de todos los pasos.');

                return 'error_editar';
            }else{

                Flash::error('No es su turno, aún no puede agregar o editar validaciones en esta inscripción.');

                return 'error_editar';
            }
        }

        $usersValidadores = [];
        foreach ($validadoresResultado as $key => $value) {
            $usersValidadores[$value['id']] = $value['name'];
        }
        $paso_inscripcion_id = 0;
        if (!empty($pasoInscripcion)) {
            $paso_inscripcion_id = $pasoInscripcion->id;
        }
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'paso_inscripcion_id' => $paso_inscripcion_id, 'pasoInscripcion' => $pasoInscripcion, 'inscripcion_id' => $inscripcion_id, 'tipo_paso_id' => $tipos_pasos, 'estado_id' => $estados, 'idAciva' => $idAciva, 'user_id' => $usersValidadores]);

        return $viewWith;
    }

    /**
     * Store a newly created PasosInscripcion in storage.
     *
     * @param CreatePasosInscripcionRequest $request
     *
     * @return Response
     */
    public function store(CreatePasosInscripcionRequest $request)
    {
        if (isset($request['inscripcion']) && $request->file('archivo_input') ) {
            $estadoActiva = \App\Models\Estado::where([['uso','VALIDATOR'],['nombre','ACTIVA']])->first();
            $request['inscripcion_id'] = $request['inscripcion'];
            $request['estado_id'] = ($request['estado_id'] ?? $estadoActiva->id);
            $request['tipo_paso_id'] = ($request['tipo_paso_id'] ?? 6);
            $request['observacion'] = ($request['observacion'] ?? 'Documento final cargado.');
        }

        return $this->storeUpdate($request);

    }

    /**
     * Update the specified PasosInscripcion in storage.
     *
     * @param  int              $id
     * @param UpdatePasosInscripcionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePasosInscripcionRequest $request)
    {
        
        return $this->storeUpdate($request,$id);

    }


    /**
     * Update the specified PasosInscripcion in storage.
     *
     * @param  int              $id
     * @param UpdatePasosInscripcionRequest $request
     *
     * @return Response
     */
    public function storeUpdate($request,$id = '',$peticion = '')
    {
        
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $msg = '';

        $paso = 654321;
        $user_actual = $this->user;


        // $estadoValidadorActiva = \App\Models\Estado::where('uso','VALIDATOR')->where('nombre','ACTIVA')->first();
        $estados = \App\Models\Estado::get()->toArray();
        $estadoValidadorActiva = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'VALIDATOR' && $var['nombre'] == 'ACTIVA');
        });
        $estadoGenerarDocumento = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'VALIDATOR' && $var['nombre'] == 'GENERAR DOCUMENTO');
        });
        $estadoInscripcionActiva = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        $estadoInscripcionEnproceso = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'EN PROCESO');
        });

        reset($estadoValidadorActiva);
        $keyEstadoActiva = key($estadoValidadorActiva);

        reset($estadoGenerarDocumento);
        $keyGenerarDocumento = key($estadoGenerarDocumento);

        reset($estadoInscripcionActiva);
        $keyInscripcionActiva = key($estadoInscripcionActiva);

        reset($estadoInscripcionEnproceso);
        $keyInscripcionEnproceso = key($estadoInscripcionEnproceso);

        if (is_array($request)) {
            $input = $request;
        }else{
            $this->validate($request, [
                'tipo_paso_id' => 'required',
                'estado_id' => 'required',
                'user_id' => 'required',
                'observacion' => 'required|max:190',
                'inscripcion_id' => 'required'
            ]);
            $input = $request->all();
        }
        $input['user_id'] = $user_actual->id;

        $datos = $input;


        if ($request['user_id'] != $user_actual->id) {
            Flash::error('No puede editar esta validación');

            return redirect(route('interchanges.validations_interchanges.show',[$input['inscripcion_id']]));
        }

        if ($peticion == '') {
            $peticion = $this->peticion;
        }
        $inscripcion = \App\Models\Inscripcion::find($input['inscripcion_id']);

        if ( empty($inscripcion) ) {
            
            Flash::error('No se encontro la inscripcion');

            return redirect(route('interchanges.index'));
        }else{

            $inscripcion_id = $inscripcion->id;
            $tipoInscripcion = ($inscripcion->tipo == 0 ? 'interout' : 'interin');
        }

        if ($id == '' && $request['paso_inscripcion_id'] != 0 ) {
            $id = $request['paso_inscripcion_id'];
        }
        if ($id != '' ) {
            $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($id);
            if (empty($pasosInscripcion) && $peticion != 'local' ) {
                Flash::error('Validación de la inscripcion no encontrada.');

                return redirect(route('interchanges.validations_interchanges.show',$input['inscripcion_id']));
            }
        }
        $paso_id = $input['tipo_paso_id'];
        $validarEditar = $this->validarEditar('editar',$user_actual->id,$inscripcion_id,$paso_id);

        if ($validarEditar['puedeEditar'] == false) {
            Flash::error('No es su turno, aún no se puede registrar la validación.');

            return redirect(route('interchanges.validations_interchanges.show',$input['inscripcion_id']));
        }
        
        $esUltimoValidador = false;
        if ($estadoValidadorActiva[$keyEstadoActiva]['id'] == $input['estado_id'] || $estadoGenerarDocumento[$keyGenerarDocumento]['id'] == $input['estado_id'] || $inscripcion->estado_id == $estadoInscripcionActiva[$keyInscripcionActiva]['id']) {
            //verifica si es el ultimo validador
            
            $validarEditar = $this->validarEditar('ultimo_validador',$user_actual->id);
            
            //compara si el ultimo validador es es actual para mostrarle la opcion
            if ($validarEditar['puedeEditar'] == false) {
                Flash::error('No tiene permitido realizar este tipo de validación.');

                return redirect(route('interchanges.index'));
            }else{
                $esUltimoValidador = true;
            }

            // $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
            // if ( $hasAllRoles ) {
                
            // }else{
            //     Flash::error('No tiene permitido realizar este tipo de validación.');

            //     return redirect(route('interchanges.index'));
            // }

            //valida que reciba el archivo final
            // if ($estadoValidadorActiva[$keyEstadoActiva]['id'] == $input['estado_id'] ) {
            //     $this->validate($request, ['archivo_input' => 'required|mimes:pdf,jpg,png,jpeg']);
            // }
        }

        if ($inscripcion->estado_id == $estadoInscripcionActiva[$keyInscripcionActiva]['id'] && $esUltimoValidador == false) {
            Flash::error('No se puede realizar la validación, la inscripcion ya esta activa.');

            return redirect(route('interchanges.validations_interchanges.show',$input['inscripcion_id']));
        }

        $comprobarValidacion = $this->comprobarValidacion('inscripcion',['campus_id' => $inscripcion->campus_id, 'inscripcionId' => $inscripcion_id, 'estado_id' => $input['estado_id'], 'tipo_paso_id' => $input['tipo_paso_id'], 'paso' => $paso, 'user_id' => $input['user_id']]);
        
        if ($comprobarValidacion['ok'] === false) {
            
            if ($peticion != 'local' && $comprobarValidacion['error_msg'] != 'error_ya_registro') {
                // if ($estadoValidadorActiva[$keyEstadoActiva]['id'] != $input['estado_id'] ) {
                //     //ACTUALIZAR EL ESTADO DE LA INSCIRPCION
                //     $inscripcion->estado_id = $estadoInscripcionEnproceso[$keyInscripcionEnproceso]['id'];
                //     $inscripcion->save();
                // }
                Flash::error($comprobarValidacion['returnMsg']);
                // return redirect(route('interchanges.validations_interchanges.show',$input['inscripcion_id']));
                return redirect(route('interchanges.index'));
            }/*else{
                $msg .= $comprobarValidacion['returnMsg'].'<br>';
            }*/
        }else{

            $datos['pasos_anteriores'] = $comprobarValidacion;
        }

        DB::beginTransaction();

        $input['campus_id'] = $inscripcion->campus_id;

        // $buscar_registro = $this->pasosInscripcion->where('tipo_paso_id',$input['tipo_paso_id'])->where('estado_id',$input['estado_id'])->where('user_id',$input['user_id'])->where('inscripcion_id',$input['inscripcion_id'])->orderBy('id','desc')->get();
        $buscar_registro = $this->pasosInscripcion->where('tipo_paso_id',$input['tipo_paso_id'])->where('user_id',$input['user_id'])->where('inscripcion_id',$input['inscripcion_id'])->orderBy('id','desc')->get();
        if (count($buscar_registro)) {
            if ($id == '') {
                $id = $buscar_registro->first()->id;
            }
            $pasosInscripcion = $this->pasosInscripcionRepository->update($input, $id);
            // $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($buscar_registro[0]->id);
            // $pasosInscripcion->observacion = $input['observacion'];
            // $pasosInscripcion->save();
        }else{
            $pasosInscripcion = $this->pasosInscripcionRepository->create($input);
        }

        //cargar el archivo de soporte

        if ( !is_array($request) && $request->file('archivo_input') ) {
            
            $request['tipo_documento'] = \App\Models\TipoDocumento::where('nombre','DOCUMENTOS FINALES INSCIRPCION')->pluck('id')->first();
            $request['peticion'] = 'local';
            $request['route'] = route('interchanges.index');

            $documents_store = $this->documents_store($inscripcion->id,$request);
            if ( is_string($documents_store)) {
                $errors += 1;
                array_push($errorsMsg, 'No se pudo procesar la carga del archivo del documento final de la inscripcion.');
                array_push($errorsMsg, $documents_store);
                goto end;
            }
        }

        // $datos['pasoProcesoId'] = 0;
        // if (isset($pasosInscripcion->id)) {
        //     $datos['pasoProcesoId'] = $pasosInscripcion->id;
        // }

        $datos['paso_proceso_id'] = $pasosInscripcion->id ?? $id;

        $datos['campus_id'] = $inscripcion->campus_id;
        $datos['inscripcionId'] = $inscripcion_id;
        $datos['tipo_paso_id'] =$input['tipo_paso_id'];
        // if (!count($buscar_registro)) {
        //como este metodo es usado para editar y crear entonces se trabaja con el registro del paso y luego se verifica que no hubiera estado ya registrado

        if ($comprobarValidacion['ok'] === true) {
            $notificarValidador = $this->datosNotificarValidador($datos); 
// print_r($notificarValidador);
// DB::rollBack();
// return 1;
            if ($notificarValidador['ok'] === false) {
                $errors += 1;
                $errorsMsg = implode("<br> ", $notificarValidador['returnMsg']);
                goto end;
            }
        }
        // }

        end:

        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ($peticion != 'ajax') {
                flash()->error($errorsMsg);
                if ($peticion == 'local') {
                    return $errorsMsg;
                }
            }else{
                return Response::json($errorsMsg, 422);
            }
        }else{
            DB::commit();
            if ( isset($request['modificar']) ) {
                $msg .= 'El registro de la validación fue actualizado correctamente. <br/>';
            }else{
                $msg .= 'El registro de la validación fue creado correctamente. <br/>';
            }

            if ($peticion != 'ajax') {
                Flash::success($msg);
                if ($peticion == 'local') {
                    return $msg;
                }
            }else{
                return Response::json($msg);
            }
            //echo 'correcto <br>';
        }

        //llegara aqui si no es de tipo ajax la peticion
        // return redirect(route('interchanges.validations_interchanges.show',$input['inscripcion_id']));
        return redirect(route('interchanges.'.$tipoInscripcion.'.index'));

    }


    /**
     * Remove the specified PasosInscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($id);

        if (empty($pasosInscripcion)) {
            Flash::error('Pasos Inscripción not found');

            return redirect(route('interchanges.index'));
        }

        $this->pasosInscripcionRepository->delete($id);

        Flash::success('Pasos Inscripción deleted successfully.');

        return redirect(route('interchanges.index'));
    }


    /**
     * Remove the specified PasosInscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function validarEditar($tipo,$user_id,$inscripcion_id = '',$paso_id = 0)
    {   
        $puedeEditar = false;
        $dondeSalio = 'VACIO';

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange');
        $tipos_pasos_array = $tipos_pasos->select('id','nombre')->get()->toArray();
        
        if ($tipo == 'ultimo_validador') {
            //verificar que el validador sea el ultimo de la lista para habilitar la opcion de ACTIVA
            $roleValidador = Role::where('name','validador')->pluck('id');
            $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id AS user_id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos_array, 'id') )
                        ->where('model_has_roles.role_id',$roleValidador )
                        ->orderBy('user_tipo_paso.tipo_paso_id','desc')
                        ->orderBy('user_tipo_paso.orden','desc')
                        ->first();
            //compara si el ultimo validador es es actual para mostrarle la opcion
            if ($ultimoValidador->user_id != $user_id) {
                $puedeEditar = false;
                $dondeSalio = 'ULTIMO_VALIDADOR';
            }else{
                $puedeEditar = true;
                $dondeSalio = 'ULTIMO_VALIDADOR';
            }
        }elseif($tipo == 'editar'){
            $estados = \App\Models\Estado::get()->toArray();
            $estadosUser_External = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'USER' || $var['uso'] == 'EXTERNAL');
            });
            $estadosValidador = array_filter($estados, function($var){
                // Retorna siempre que el número entero sea par
                return ($var['uso'] == 'VALIDATOR');
            });

            reset($estadosUser_External);
            $keyUser_External = key($estadosUser_External);

            reset($estadosValidador);
            $keyEstadosValidador = key($estadosValidador);

            $registrosPasos = \App\Models\Validation\PasosInscripcion::select('pasos_inscripcion.tipo_paso_id','pasos_inscripcion.estado_id','pasos_inscripcion.user_id','estado.uso AS estado_uso','estado.nombre AS estado_nombre','email.estado AS email_estado')
                        ->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                        ->leftJoin('pasos_inscripcion_email','pasos_inscripcion.id','pasos_inscripcion_email.pasos_inscripcion_id')
                        ->leftJoin('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
                        ->where('pasos_inscripcion.inscripcion_id',$inscripcion_id )
                        ->orderBy('pasos_inscripcion.tipo_paso_id','asc')
                        ->orderBy('pasos_inscripcion.id','asc')
                        ->get()->toArray();
                    // ->whereIn('estado.id',array_column($estadosValidador, 'id') )

// echo "registrosPasos:";
// print_r($registrosPasos);

            // $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange')->select('id',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS numero'))->pluck('numero','id');

            $hayValidaciones = 0;
            $keyAnterior = null;
            foreach ($registrosPasos as $key => $registroPaso) {

// echo 'tipo_paso_id:'.$registroPaso['tipo_paso_id'].'<br>';

                if(in_array($registroPaso['estado_uso'],['USER','EXTERNAL']) ){
                    if ($registroPaso['estado_nombre'] == 'ACEPTADO'){
                        $puedeEditar = true;
                        $dondeSalio = 'ACEPTADO';
                    }elseif($registroPaso['estado_nombre'] == 'DECLINADO'){
                        $puedeEditar = false;
                        $dondeSalio = 'DECLINADO';

                        break;
                    }
                }

                if(in_array($registroPaso['estado_uso'],['VALIDATOR']) ){
// echo 'entro como validacion <br>';
                    $hayValidaciones = 1;
                    if(in_array($registroPaso['estado_nombre'],['EN REVISIÓN','GENERAR DOCUMENTO']) ){
                        if ($registroPaso['user_id'] == $user_id){
                            $puedeEditar = true;
                            $dondeSalio = 'REVISION_GENERAR';

                            break;
                        }else{
                            $puedeEditar = false;
                            $dondeSalio = 'REVISION_GENERAR';
                        }
                    }elseif(in_array($registroPaso['estado_nombre'],['RECHAZADO']) ){

                        if ($registroPaso['user_id'] == $user_id){
                            // $puedeEditar = true;
                            if ($keyAnterior !== null && $registrosPasos[$keyAnterior]['estado_nombre'] == 'APROBADO') {
                                // SI EL PASO ANTERIOR ES DE UN VALIDADOR
                                $puedeEditar = true;
                                $dondeSalio = 'ANTERIOR_APROBADO';
                            }elseif ($keyAnterior !== null && $registrosPasos[$keyAnterior]['estado_nombre'] == 'ACEPTADO') {
                                // SI EL PASO ANTERIOR ES DE UN COORD. EXTERNO
                                $puedeEditar = true;
                                $dondeSalio = 'ANTERIOR_ACEPTADO';
                            }elseif ($keyAnterior !== null && $registrosPasos[$keyAnterior]['email_estado'] == 1) {
                                // SI EL PASO ANTERIOR ES DE UN USUARIO
                                $puedeEditar = true;
                                $dondeSalio = 'ANTERIOR_EMAIL_ESTADO';
                            }else{
                                $puedeEditar = false;
                            }

                            $dondeSalio = 'RECHAZADO_USER';

                            break;
                        }else{
                            $puedeEditar = false;

                            $dondeSalio = 'RECHAZADO';

                            break;
                        }
                    }
                }else{
                    $hayValidaciones = 0;
                }
                $keyAnterior = $key;

// echo "puedeEditar foreach:";                
// var_dump($puedeEditar);
            }

            if ($paso_id != 0) {
                $tipo_paso_id = $paso_id;
            }else{
                $paso = 4;
                $tipo_paso_id = $this->tipoPaso->where('nombre','paso'.$paso.'_interchange')->pluck('id')->first();
            }

            $roleValidador = Role::where('name','validador')->pluck('id');
            $validadoresPaso = \App\Models\Validation\UserPaso::select('users.id AS user_id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('user_tipo_paso.tipo_paso_id',$tipo_paso_id)
                        ->where('model_has_roles.role_id',$roleValidador )
                        ->orderBy('user_tipo_paso.orden','asc');
            
            $validadoresPaso = $validadoresPaso->get()->toArray();
// echo 'validadoresPaso:';
// print_r($validadoresPaso);
// echo "user_id:".$user_id.'<br>';

            if ($hayValidaciones == 0) {
                //se espera que no cambie el tipo de paso de la inscripcion
                
                $primerValidador = current($validadoresPaso);

                if ($primerValidador['user_id'] != $user_id) {

                    $puedeEditar = false;

                    $dondeSalio = 'PRIMER_VALIDADOR';

                }else{
                    $puedeEditar = true;

                    $dondeSalio = 'PRIMER_VALIDADOR';
                }
            }else{
                $ultimoRegistro = end($registrosPasos);
// echo 'ultimoRegistro:';
// print_r($ultimoRegistro);

                foreach ($validadoresPaso as $key => $validadorPaso) {
// echo "validadorPaso['user_id']:".$validadorPaso['user_id'];
// echo "|ultimoRegistro['user_id']:".$ultimoRegistro['user_id'].'<br>';

                    if ($validadorPaso['user_id'] == $ultimoRegistro['user_id']) {
                        $siguienteValidador = $validadoresPaso[$key+1] ?? [];
// echo 'siguienteValidador:';
// print_r($siguienteValidador);

                        if (count($siguienteValidador) && $siguienteValidador['user_id'] == $user_id) {
                            
                            $puedeEditar = true;

                            $dondeSalio = 'HAY_VALIDACIONES';
                        }
                    }
                }
            }

            //--------------------------------------
            //--------------------------------------
            //--------------------------------------
            if ($paso_id != 0) {
// echo "paso_id:".$paso_id.'<br>';
// echo "puedeEditar llega:";                
// var_dump($puedeEditar);
                $pasoRecibido = $paso_id;
                $pasos_validacion = array_filter($tipos_pasos_array, function($var) use ($pasoRecibido) {
                    return ($var['id'] < $pasoRecibido);
                });

                //obtiene el registro de los pasos registrados por el usuario (estudiante o coordinador)
                $pasos_registrados = \App\Models\Validation\PasosInscripcion::join('estado','pasos_inscripcion.estado_id','estado.id')
                    ->where('pasos_inscripcion.inscripcion_id',$inscripcion_id)
                    ->where('estado.uso', 'USER')
                    ->select('pasos_inscripcion.tipo_paso_id')
                    ->get()
                    ->toArray();

                $tipos_pasos_registrados = array_column($pasos_registrados, 'tipo_paso_id');

                // si no se han registrado todos los pasos anteriores devuelve un mensaje de error
                foreach ($pasos_validacion as $key => $value) {

                    $estaRegistrado = array_search($value['id'], $tipos_pasos_registrados);

                    if ($estaRegistrado === false) {

                        $puedeEditar = false;

                        $dondeSalio = 'PASOS_INCOMPLETOS';

                        /*
                        $errors += 1;
                        array_push($errorsMsg, 'No ha registrado toda la información, es necesario que complete los datos que faltan.');
                        array_push($errorsMsg, 'El paso #'.$value['orden'].' - \''.$value['titulo'].'\' no aparece registrado.');
                        goto end;
                        */
                    }
                }

            }

            //--------------------------------------
            //--------------------------------------
            //--------------------------------------
        
        // echo $registrosPasos[$keyAnterior]['estado_nombre'];

        // echo "puedeEditar sale:";
        // var_dump($puedeEditar);
        // echo 'dondeSalio:'.$dondeSalio;

            

        }

        $retorno['puedeEditar'] = $puedeEditar;
        $retorno['dondeSalio'] = $dondeSalio;

        return $retorno;

    }
}
