<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreatePasosAlianzaRequest;
use App\Http\Requests\Validation\UpdatePasosAlianzaRequest;
use App\Repositories\Validation\PasosAlianzaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Validation\PasosAlianza;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\TipoPaso;
use PDF;
use App\Http\Traits\Emails;
use App\Http\Traits\Validador;
use App\Http\Traits\AdminDocs;

use Illuminate\Support\Facades\Hash;

class PasosAlianzaController extends AppBaseController
{
    use Authorizable;
    use Emails;
    use Validador;
    use AdminDocs;
    
    /** @var  PasosAlianzaRepository */
    private $pasosAlianzaRepository;
    private $pasosAlianza;
    private $user;
    private $campusApp;
    private $campusAppFound;
    private $tipoPaso;
    private $peticion;
    private $viewWith;

    public function __construct(PasosAlianzaRepository $pasosAlianzaRepo, PasosAlianza $pasosAlianzaModel, TipoPaso $tipoPasoModel, Request $request)
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

            $this->viewWith = ['campusApp' => $this->campusApp];

            return $next($request);
        });

        $this->pasosAlianzaRepository = $pasosAlianzaRepo;
        $this->pasosAlianza = $pasosAlianzaModel;
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
    }

    /**
     * Display a listing of the PasosAlianza.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return redirect(route('interalliances.index'));

        /*
        //$this->pasosAlianzaRepository->pushCriteria(new RequestCriteria($request));
        //$pasosAlianzas = $this->pasosAlianzaRepository->paginate(20);

        $pasosAlianzas = \App\Models\Alianza::leftJoin('pasos_alianza','pasos_alianza.alianza_id','alianza.id')
                ->leftJoin('estado','pasos_alianza.estado_id','estado.id')
                ->groupBy('alianza.id');
        //esta consulta devuelve las alianzas con el conteo de todos los registros
        $pasosAlianzasTodos = $pasosAlianzas->select('alianza.id AS alianza_id','alianza.created_at AS alianza_created_at','alianza.updated_at AS alianza_updated_at','alianza.estado AS alianza_estado',DB::raw('count(*) AS conteo_pasos'))
                ->paginate(20);

        //print_r($pasosAlianzas);

        //esta consulta devuelve las alianzas con el conteo de todos los registros filtrados por los que hicieron los validadores
        $pasosAlianzasValidados = $pasosAlianzas->select('alianza.id AS alianza_id',DB::raw('count(*) AS conteo_pasos'))
                ->where('estado.uso', 'VALIDATOR')
                ->get()->toArray();

        //se valida cada registro del paso, en el caso de no tener registros por parte de un validador se asigna 0 a la columna 'conteo_pasos'
        foreach ($pasosAlianzasTodos as $key) {
            $keySearch = array_search($key->alianza_id, array_column($pasosAlianzasValidados, 'alianza_id'));
            if ($keySearch === false) {
                $key->conteo_pasos = 0;
            }else{
                $key->conteo_pasos = $pasosAlianzasValidados[$keySearch]['conteo_pasos'];
            }
        }



        return view('validation.interalliances.pasos_alianzas.index')
            ->with(['campusApp' => $this->campusApp, 'peticion' => $this->peticion, 'pasosAlianzas' => $pasosAlianzasTodos]);
        */
    }

    /**
     * Display a listing of the PasosAlianza.
     *
     * @param Request $request
     * @return Response
     */
    public function datosNotificarValidador($request)
    {
        $returnMsg = [];
        
        //notificar a el validador en caso que este asociado al paso 
        $datos = $request;
        // $datos['paso'] = 6;
        $datos['accion'] = 'creacion';
        $datos['origen_peticion'] = 'local';
        //$datos['tipo_paso_id'] = $tipo_paso_id;
        $notificarValidador = $this->notificarValidador('alianza', $datos);
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
     * Display the specified PasosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($alianza_id,$paso_id ='',$peticion ='')
    {   
        //este metodo se modifico para trabajar junto con el metodo edit debido a que se solicito que el formuario de crear una validacion estuviera inmerso en la vista de las validaciones de cada alianza
        $alianza = \App\Models\Alianza::find($alianza_id);

        $alianzaId = 0;
        $dataAlianza = '';
        $dataUsers = 0;
        $pasosAlianza = '';
        $archivosAdjuntos = '';
        $CoordinadorInterno = 0;
        $CoordinadorExterno = 0;
        $viewWith = $this->viewWith;

        // $user_actual = \App\User::find($this->user->id);
        $user_actual = $this->user;
        //Validar EL ROL DE generar_documento 
        $GenerarDocumento = false;
        $pre_formas = [];

        if ( empty($alianza) ) {
            Flash::error('Alianza no encontrada');

            return redirect(route('interalliances.validations_interalliances.index'));
        }else{
            $alianzaId = $alianza->id;
        }

        $pasosAlianza = DB::table('pasos_alianza')->join('estado', 'pasos_alianza.estado_id', '=', 'estado.id')
                    ->join('tipo_paso', 'pasos_alianza.tipo_paso_id', '=', 'tipo_paso.id')
                    ->join('users', 'pasos_alianza.user_id', '=','users.id' )
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->leftJoin('user_tipo_paso', 'users.id', '=', 'user_tipo_paso.user_id')
                    ->where('pasos_alianza.alianza_id', $alianzaId)
                    ->where('estado.uso', 'VALIDATOR');

        if ( $peticion !='' ) {
            $this->peticion = $peticion;
        }
        //si el estado de la aliaza es activa no permitira editar el registro
        $editar = false;
        $estadoActiva = $estados = \App\Models\Estado::where('id',$alianza->estado_id)->select('id','nombre')->first();
        if ($estadoActiva->nombre != 'ACTIVA') {
            $editar = true;
        }


        if ( $paso_id !='' ) {

            $pasosAlianza = $pasosAlianza->where('pasos_alianza.id', $paso_id)
                        ->select('pasos_alianza.*','estado.nombre As estado_nombre',DB::raw("concat(replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso_titulo"),'users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
                //echo $pasosAlianza->toSql();
                $pasosAlianza = $pasosAlianza->first();
                //$pasosAlianza = (array) $pasosAlianza;

            if ( empty($pasosAlianza) ) {
                Flash::error('No se ha encontrado el registro del paso.');
                return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
            }else{
                $viewWith = array_merge($viewWith,['pasoAlianza' => $pasosAlianza]);
                $view = 'validation.interalliances.pasos_alianzas.show';
            }


        }else{
            
            $viewWith = array_merge($viewWith,app('App\Http\Controllers\InterAllianceController')->show($alianza_id, 'local'));
            
            if ( $viewWith['dataAlianza']['estado_nombre'] != 'ACTIVA' ) {
                $viewWithCreate = $this->create($alianza_id, 'local');
                if ( is_array($viewWithCreate) ) {
                    $viewWith = array_merge($viewWith, $viewWithCreate);
                }elseif($viewWithCreate === 'error_editar'){
                    $editar = false;
                }
            }

            //lista de registros con el mismo tipo de paso
                    // ->orderBy('tipo_paso.id','desc')
                    // ->orderBy('pasos_alianza.id','desc')
            $pasosAlianza = $pasosAlianza->orderBy('pasos_alianza.updated_at','desc')
                    ->groupBy('pasos_alianza.id')
                    ->select('pasos_alianza.*','estado.nombre As estado_nombre',DB::raw("concat(replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso_titulo"),'users.id AS user_id','users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
            //echo $pasosAlianza->toSql();

            $pasosAlianza = $pasosAlianza->paginate(20);
            //$pasosAlianza = json_decode(json_encode($pasosAlianza),true);


            if ( empty($pasosAlianza) ) {
                Flash::error('No se ha encontrado el registro del paso.');
                return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
            }
            
            //verifica si tiene el rol para generar el documento
            $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
            if ( $hasAllRoles ) {

                $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interalliance')->select('id','nombre')->get()->toArray();
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

                    $clase_documento_nombre = 'ALIANZA';
                    $tipo_documento_id = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                        ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
                        ->pluck('tipo_documento.id')->first();
                    $IdDocumentosAlianza =  \App\Models\DocumentosAlianza::join('tipo_documento','documentos_alianza.tipo_documento_id','tipo_documento.id')
                                ->where('documentos_alianza.alianza_id',$alianzaId)
                                ->where('documentos_alianza.tipo_documento_id',$tipo_documento_id)
                                ->pluck('documentos_alianza.archivo_id')->toArray();

                    $clase_documento_nombre = 'INSTITUCION';
                    $tipo_documento_id = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                        ->where([['clase_documento.nombre',$clase_documento_nombre],['tipo_documento.nombre',$tipo_documento_nombre]])
                        ->pluck('tipo_documento.id')->first();

                    
                    $IdDocumentosInstitucion =  \App\Models\Admin\DocumentosInstitucion::join('tipo_documento','documentos_institucion.tipo_documento_id','tipo_documento.id')
                                ->where('documentos_institucion.institucion_id',$institucionId)
                                ->where('documentos_institucion.tipo_documento_id',$tipo_documento_id)
                                ->pluck('documentos_institucion.archivo_id')->toArray();

                    $pre_formas_alianza =  \App\Models\Archivo::whereIn('id',$IdDocumentosAlianza)->select(DB::raw('concat("GUARDADO - ",nombre) AS nombre'),'id','path')->get()->toArray();
                    $pre_formas_institucion =  \App\Models\Archivo::whereIn('id',$IdDocumentosInstitucion)->select('nombre','id','path')->get()->toArray();

                    $pre_formas =  array_merge($pre_formas_alianza,$pre_formas_institucion);

                }

            }

            $view = 'validation.interalliances.show';
            
            $viewWith = array_merge($viewWith, ['pasosAlianza' => $pasosAlianza, 'GenerarDocumento' => $GenerarDocumento, 'pre_formas' => $pre_formas]);
                
        }

        $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'alianzaId' => $alianzaId, 'user_actual' => $user_actual->id, 'editar' => $editar]);
        //print_r($viewWith);
        if ( $peticion == 'local' ) {
            return $viewWith;
        }else{
            return view($view)->with($viewWith);
        }
    }

    /**
     * Show the form for editing the specified PasosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function pdf($alianza_id, Request $request)
    {   
        
        $alianza = \App\Models\Alianza::find($alianza_id);

        if ( empty($alianza) ) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.validations_interalliances.index'));
        }else{
            $alianza_id = $alianza->id;
        }

        $viewWith = $this->viewWith;
        $viewWith = array_merge($viewWith,$this->show($alianza_id,'', 'local'));
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'limpio']);
        $view = 'validation.interalliances.show';
        //$view = 'welcome';
        
        //$pdf = PDF::loadView($view, $viewWith);
        //return $pdf->download('alliance-'.$alianza_id.'.pdf');
        //return  PDF::loadView($view, $viewWith)->save( storage_path().'/alliance-'.$alianza_id.'.pdf')->stream('alliance-'.$alianza_id.'.pdf');
        if ( isset($request['tipo']) ) {
            if ( $request['tipo'] == 1 ) {
                return view($view)->with($viewWith);
            }elseif ( $request['tipo'] == 2 ) {
                return  PDF::loadView($view, $viewWith)->stream('validation-alliance-'.$alianza_id.'.pdf');
            }elseif ( $request['tipo'] == 3 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'basico']);
                //return view($view)->with($viewWith);
                return  PDF::loadView($view, $viewWith)->stream('validation-alliance-'.$alianza_id.'.pdf');
            }elseif ( $request['tipo'] == 4 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'ajax']);
                return  PDF::loadView($view, $viewWith)->stream('validation-alliance-'.$alianza_id.'.pdf');
            }
        }else{
            return  PDF::loadView($view, $viewWith)->stream('validation-alliance-'.$alianza_id.'.pdf');
        }
    }

    /**
     * Show the form for editing the specified PasosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function print($alianza_id, Request $request)
    {   
        
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = 'files.editor_word_drag_drop';
        $route_back = route('interalliances.validations_interalliances.show',$alianza_id);
        $route_new = '';
        $this->user = Auth::user();
        $user_actual = $this->user->id;

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interalliance')->select('id','nombre')->get()->toArray();
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
            $view = route('interalliances.validations_interalliances.show',$alianza_id);
            $errors += 1;
            $errorsMsg = 'No tiene permitido imprimir el documento.';
            goto end;
        }

        $alianza = \App\Models\Alianza::find($alianza_id);

        if ( empty($alianza) ) {

            $view = route('interalliances.validations_interalliances.index');
            $errors += 1;
            $errorsMsg = 'No se encontro la alianza.';
            goto end;
        }else{
            $alianza_id = $alianza->id;
        }

        $ruta_guardar = ['interalliances.validations_interalliances.documents.store',$alianza_id];
        $editar = ['nombre' => true];

        $estadoGenerarDocumento = \App\Models\Estado::where('nombre','GENERAR DOCUMENTO')->pluck('id')->first();

        $storeUpdateData['user_id'] = $ultimoValidador->id;
        $storeUpdateData['alianza_id'] = $alianza_id;
        $storeUpdateData['paso_alianza_id'] = 0;
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
            $clase_documento_nombre = 'ALIANZA';
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
            
            $viewError = ['interalliances.validations_interalliances.show',$alianza_id];

            $documentoDe = 'alianza';
            $datosDocumento = $this->verDocumento('alianza',['archivo_id' => $archivo_id, 'alianzaId' => $alianza_id, 'view' => $viewError, 'peticion' => 'local' ]);
            if ( is_string($datosDocumento) && $datosDocumento === 'error_documento' ) {
                $documentoDe = 'institucion';
                $datosDocumento = $this->verDocumento('institucion',['archivo_id' => $archivo_id, 'institucionId' => $institucionId, 'view' => $viewError, 'peticion' => 'local' ]);

            }
            

            if ( is_string($datosDocumento) && $datosDocumento === 'error_documento' ) {

                $view = route('interalliances.validations_interalliances.show',$alianza_id);
                $errors += 1;
                $errorsMsg = 'No se encontro el documento.';
                goto end;
            }elseif ( is_string($datosDocumento) && $datosDocumento === 'error_proceso' ) {

                $view = route('interalliances.validations_interalliances.show',$alianza_id);
                $errors += 1;
                $errorsMsg = 'El nombre del proceso no se encuentra.';
                goto end;
            }elseif ( is_string($datosDocumento) && $datosDocumento === 'seleccione_documento' ) {

                $view = route('interalliances.validations_interalliances.show',$alianza_id);
                $errors += 1;
                $errorsMsg = 'Seleccione un documento.';
                goto end;
            }else{

                //obtiene todos los datos de la alianza y sus usuarios
                $datosAlianza = app('App\Http\Controllers\InterAllianceController')->show($alianza_id, 'local');

                $keyCoordExterno = $datosAlianza['keyCoordExterno'];
                $keyCoordInterno = $datosAlianza['keyCoordInterno'];

                $dataUsers = $datosAlianza['dataUsers'];
                $dataAlianza = $datosAlianza['dataAlianza'];

                // opciones para mostrar request ['keyword','value']
                $showData = 'value';
                if (isset($request['accion']) ){
                    if ( $request['accion'] == 'edicion') {
                        $showData = 'keyword';
                    }
                }

                $duracion = str_replace(["MESES","AÑOS"], ["month","year"], $dataAlianza['duracion']);
                $dataAlianza['fecha_final'] = strtotime ( '+'.$duracion , strtotime ( $dataAlianza['fecha_inicio'] ) );
                $dataAlianza['fecha_final'] = date('Y-m-d', $dataAlianza['fecha_final'] );

                $keyWords = array(
                    'COORDINADOR_INTERNO_NOMBRE' => array('keyword' => 'COORDINADOR_INTERNO_NOMBRE', 'name' => 'coordinador interno nombre', 'value' => strtoupper($dataUsers[$keyCoordInterno]['coordinador_nombres'].' '.$dataUsers[$keyCoordInterno]['coordinador_apellidos'])),
                    'COORDINADOR_INTERNO_CARGO' => array('keyword' => 'COORDINADOR_INTERNO_CARGO', 'name' => 'coordinador interno cargo', 'value' => strtoupper($dataUsers[$keyCoordInterno]['coordinador_cargo'])),
                    'COORDINADOR_INTERNO_TELEFONO' => array('keyword' => 'COORDINADOR_INTERNO_TELEFONO', 'name' => 'coordinador interno telefono', 'value' => strtoupper($dataUsers[$keyCoordInterno]['coordinador_telefono'])),
                    'COORDINADOR_INTERNO_EMAIL' => array('keyword' => 'COORDINADOR_INTERNO_EMAIL', 'name' => 'coordinador interno email', 'value' => strtoupper($dataUsers[$keyCoordInterno]['coordinador_email'])),

                    'COORDINADOR_EXTERNO_NOMBRE' => array('keyword' => 'COORDINADOR_EXTERNO_NOMBRE', 'name' => 'coordinador externo nombre', 'value' => strtoupper($dataUsers[$keyCoordExterno]['coordinador_nombres'].' '.$dataUsers[$keyCoordExterno]['coordinador_apellidos'])),
                    'COORDINADOR_EXTERNO_CARGO' => array('keyword' => 'COORDINADOR_EXTERNO_CARGO', 'name' => 'coordinador externo cargo', 'value' => strtoupper($dataUsers[$keyCoordExterno]['coordinador_cargo'])),
                    'COORDINADOR_EXTERNO_TELEFONO' => array('keyword' => 'COORDINADOR_EXTERNO_TELEFONO', 'name' => 'coordinador externo telefono', 'value' => strtoupper($dataUsers[$keyCoordExterno]['coordinador_telefono'])),
                    'COORDINADOR_EXTERNO_EMAIL' => array('keyword' => 'COORDINADOR_EXTERNO_EMAIL', 'name' => 'coordinador externo email', 'value' => strtoupper($dataUsers[$keyCoordExterno]['coordinador_email'])),

                    'REPRESENTANTE_NOMBRE' => array('keyword' => 'REPRESENTANTE_NOMBRE', 'name' => 'representante nombre', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['representante']['nombres'].' '.$dataUsers[$keyCoordExterno]['institucion']['representante']['apellidos'])),
                    'REPRESENTANTE_CARGO' => array('keyword' => 'REPRESENTANTE_CARGO', 'name' => 'representante cargo', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['representante']['cargo'])),
                    'REPRESENTANTE_TELEFONO' => array('keyword' => 'REPRESENTANTE_TELEFONO', 'name' => 'representante telefono', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['representante']['telefono'])),
                    'REPRESENTANTE_EMAIL' => array('keyword' => 'REPRESENTANTE_EMAIL', 'name' => 'representante email', 'value' => strtoupper($dataUsers[$keyCoordExterno]['institucion']['representante']['repre_email'])),

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

                    'ALIANZA_ID' => array('keyword' => 'ALIANZA_ID', 'name' => 'alianza id', 'value' => strtoupper($dataAlianza['id'])),
                    'ALIANZA_TIPO_TRAMITE' => array('keyword' => 'ALIANZA_TIPO_TRAMITE', 'name' => 'alianza tipo tramite', 'value' => strtoupper($dataAlianza['tipo_tramite_nombre'])),
                    'ALIANZA_FACULTADES' => array('keyword' => 'ALIANZA_FACULTADES', 'name' => 'alianza facultades', 'value' => strtoupper(implode(", ", array_column($dataAlianza['facultades'], 'facultad_nombre')) )),
                    'ALIANZA_PROGRAMAS' => array('keyword' => 'ALIANZA_PROGRAMAS', 'name' => 'alianza programas', 'value' => strtoupper(implode(", ", array_column($dataAlianza['programas'], 'programa_nombre')) )),
                    'ALIANZA_TIPO_ALIANZA' => array('keyword' => 'ALIANZA_TIPO_ALIANZA', 'name' => 'alianza tipo alianza', 'value' => strtoupper($dataAlianza['aplicaciones'][0]['tipo_alianza_nombre'])),
                    'ALIANZA_APLICACIONES' => array('keyword' => 'ALIANZA_APLICACIONES', 'name' => 'alianza aplicaciones', 'value' => strtoupper(implode(", ", array_column($dataAlianza['aplicaciones'], 'aplicaciones_nombre')) )),
                    'ALIANZA_DURACION' => array('keyword' => 'ALIANZA_DURACION', 'name' => 'alianza duracion', 'value' => strtoupper($dataAlianza['duracion'])),
                    'ALIANZA_OBJETIVO' => array('keyword' => 'ALIANZA_OBJETIVO', 'name' => 'alianza objetivo', 'value' => strtoupper($dataAlianza['objetivo'])),
                    'ALIANZA_FECHA_INICIO' => array('keyword' => 'ALIANZA_FECHA_INICIO', 'name' => 'alianza fecha inicio', 'value' => (empty($dataAlianza['fecha_inicio']) ? $dataAlianza['fecha_inicio'] : date('Y-m-d', strtotime($dataAlianza['fecha_inicio']))) ),
                    'ALIANZA_FECHA_FIN' => array('keyword' => 'ALIANZA_FECHA_FIN', 'name' => 'alianza fecha fin', 'value' => $dataAlianza['fecha_final']),
                    'ALIANZA_FECHA_CREACION' => array('keyword' => 'ALIANZA_FECHA_CREACION', 'name' => 'alianza fecha creacion', 'value' => strtoupper($dataAlianza['created_at'])),
                    'ALIANZA_FECHA_ACTUALIZACION' => array('keyword' => 'ALIANZA_FECHA_ACTUALIZACION', 'name' => 'alianza fecha actualizacion', 'value' => strtoupper($dataAlianza['updated_at'])),
                );
                if ($showData == 'value') {
                    foreach ($keyWords as $key => $value) {
                        $datosDocumento['documento_contenido'] = str_replace('['.$key.']', $value['value'],$datosDocumento['documento_contenido']);
                    }
                }
                //para poder guardar una copia de la pre-forma editada por el usuario se cambia el id del tipo de documento asociado a la institucion por el asociado a la alianza 

                if ($documentoDe == 'institucion') {
                    $datosDocumento['documento']['tipo_documento'] = $tipo_documento->id;
                }

                $viewWith = array_merge($viewWith, $datosAlianza);
                $viewWith = array_merge($viewWith, $datosDocumento);
                $viewWith = array_merge($viewWith, ['imprimir' => true, 'copiar' => true, 'editar' => $editar,]);
                $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'ruta_guardar' => $ruta_guardar, 'keyWords' => $keyWords, 'route_back' => $route_back, 'showData' => $showData, 'menuApp' => 'InterValidations', 'submenu1App' => 'Imprimir']);
            }

        }else{
            $view = route('interalliances.validations_interalliances.show',$alianza_id);
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

    public function documents_store($alianza_id,Request $request)
    {
        //$proceso [institucion,iniciativa,inscripcion,validador],$datos [view,institucionId,origen,tipo_documento,archivo_id,archivo_nombre,archivo_contenido,archivo_input,user_id,route_error]
        $peticion = (isset($request['peticion']) ? $request['peticion'] : $this->peticion );

        $this->validate($request, [
            'tipo_documento' => 'required',
        ]);

        $errorsMsg = '';
        $okMsg = '';
        $errors = 0;
        $route = (isset($request['route']) ? $request['route'] : route('interalliances.index') );
        $route_error = route('interalliances.validations_interalliances.show',$alianza_id);
        $this->user = Auth::user();

        if ( $request->file('archivo_input') != null ) {
            $datos['nombre'] = str_replace(' ', '_', $request->file('archivo_input')->getClientOriginalName());
            $datos['archivo_formato'] = $request->file('archivo_input')->getClientOriginalExtension();
            $datos['archivo_MimeType'] = $request->file('archivo_input')->getClientMimeType();
            $request['archivo_input'] = \File::get($request->file('archivo_input'));
        }
        
        $proceso = 'alianza';
        $datos['alianzaId'] = $alianza_id;
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
     * Show the form for editing the specified PasosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($alianza_id,$paso_id)
    {
        $alianza = \App\Models\Alianza::find($alianza_id);

        if ( empty($alianza) ) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.validations_interalliances.index'));
        }else{
            $alianza_id = $alianza->id;
        }

        $pasoAlianza = $this->pasosAlianzaRepository->findWithoutFail($paso_id);

        if (empty($pasoAlianza)) {
            Flash::error('No se encontro el paso de la alianza');

            return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
        }

        if ($pasoAlianza->user_id != $this->user->id) {
            Flash::error('No puede editar esta validación');

            return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
        }

        $datosAlianza = app('App\Http\Controllers\InterAllianceController')->show($alianza_id, 'local');

        $viewWith = $this->editCreateData($alianza,$paso_id);
        if (!is_array($viewWith) && $viewWith != '' )   {
            return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
        }

        $viewWith = array_merge($viewWith,$this->viewWith);
        
        $viewWith = array_merge($viewWith, $datosAlianza);

        return view('validation.interalliances.pasos_alianzas.edit')->with($viewWith);
    }


    /**
     * Show the form for creating a new PasosAlianza.
     *
     * @return Response
     */
    public function create($alianza_id,$peticion ='')
    {
        $datosAlianza = array();
        $alianza = \App\Models\Alianza::find($alianza_id);
        
        if ($peticion != 'local') {

            if ( empty($alianza) ) {
                Flash::error('No se encontro la alianza');

                return redirect(route('interalliances.validations_interalliances.index'));
            }else{
                $alianza_id = $alianza->id;
            }

            $datosAlianza = app('App\Http\Controllers\InterAllianceController')->show($alianza_id, 'local');
        }
        $idPasoAlianza = '';
        if ($peticion == 'local') {
            $idPaso = $this->pasosAlianza->where('alianza_id',$alianza_id)->where('user_id',$this->user->id)->pluck('id');
            if (count($idPaso) > 1 || !count($idPaso)) {
                $idPasoAlianza = '';
            }else{
                $idPasoAlianza = $idPaso[0];
            }
        }

        $viewWith = $this->editCreateData($alianza,$idPasoAlianza);
        if (!is_array($viewWith) && $viewWith != '' ) {
            if ($peticion == 'local') {
                return $viewWith;
            }else{
                return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
            }
        }else{
            $viewWith = array_merge($viewWith, $this->viewWith);
            $viewWith = array_merge($viewWith, $datosAlianza);
        }
        
        if ($peticion == 'local') {
            return $viewWith;
        }else{
            return view('validation.interalliances.pasos_alianzas.create')->with($viewWith);
        }
    }

    /**
     * Show the form for editing the specified PasosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editCreateData($alianza,$paso_id ='')
    {
        $viewWith = $this->viewWith;
        $pasoAlianza = 0;
        $user_actual = $this->user;
        $alianza_id = $alianza->id;

        if ($paso_id !='') {
            $pasoAlianza = $this->pasosAlianzaRepository->findWithoutFail($paso_id);

            if (empty($pasoAlianza)) {
                Flash::error('No se encontro el paso de la alianza');

                return redirect(route('interalliances.validations_interalliances.show',[$alianza_id]));
            }
        }

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interalliance');
        $estadoAlianza = \App\Models\Estado::where('id',$alianza->estado_id)->select('id','nombre')->first();
        
        if ($estadoAlianza->nombre == 'ACTIVA') {
            Flash::error('No se pueden agregar o editar validaciones en esta alianza');

            return 'error_permitido';
        }

        //verifica si puede editar o crear un registro 
        $validarEditar = $this->validarEditar('editar',$user_actual->id,$alianza_id);
        if ($validarEditar == false) {
            Flash::error('No es su turno, aún no puede agregar o editar validaciones en esta alianza.');

            return 'error_editar';
        }

        $estados = \App\Models\Estado::where('uso','VALIDATOR');

        //verifica si tiene el rol para generar el documento
        $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
        if ( $hasAllRoles ) {
            //verificar que el validador sea el ultimo de la lista para habilitar la opcion de ACTIVA
            $tipos_pasos_array = $tipos_pasos->select('id','nombre')->get()->toArray();
            $roleValidador = Role::where('name','validador')->pluck('id');
            $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos_array, 'id') )
                        ->where('model_has_roles.role_id',$roleValidador )
                        ->orderBy('user_tipo_paso.orden','desc')
                        ->first();
            //compara si el ultimo validador es es actual para mostrarle la opcion
            if ($ultimoValidador->id != $user_actual->id) {
                $estados = $estados->whereNotIn('nombre',['GENERAR DOCUMENTO','ACTIVA']);
            }else{
                $estados = $estados->whereNotIn('nombre',['APROBADO','GENERAR DOCUMENTO','ACTIVA']);
            }
        }else{
             $estados = $estados->whereNotIn('nombre',['GENERAR DOCUMENTO','ACTIVA']);
        }

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
                Flash::error('No tiene permitido agregar validaciones en esta alianza');

                return 'error_permitido';
            }
        // }else{

        //     $validadoresXlosPasos = $validadoresXlosPasos->whereIn('user_tipo_paso.user_id',$validadores);

        //     $validadoresXlosPasos = \App\Models\Admin\Role::select(DB::raw("'Seleccione un validador' AS name, '' AS id"))->union($validadoresXlosPasos);

        //     $validadoresResultado = $validadoresXlosPasos->get();
        // }


        $tipos_pasos = $tipos_pasos->whereIn('id',array_column($validadoresResultado->toArray(), 'tipo_paso_id'))
            ->select(DB::raw("concat(replace(substr(nombre,instr(nombre,'paso')+4,2),'_',''),' - ',titulo) AS titulo"),'id')
            ->pluck('titulo','id');


        $keysTiposPasos = array_keys($tipos_pasos->toArray());

        $paso_id = $keysTiposPasos[0] ?? 0;

        //verifica si puede editar o crear un registro 
        $validarEditar = $this->validarEditar('editar',$user_actual->id,$alianza_id,$paso_id);
        if ($validarEditar == false) {
            if ($validarEditar['dondeSalio'] == 'PASOS_INCOMPLETOS') {

                Flash::error('No puede agregar o editar validaciones en esta alianza, no se han registrados los datos de todos los pasos.');

                return 'error_editar';
            }else{

                Flash::error('No es su turno, aún no puede agregar o editar validaciones en esta alianza.');

                return 'error_editar';
            }
        }

        $usersValidadores = [];
        foreach ($validadoresResultado as $key => $value) {
            $usersValidadores[$value['id']] = $value['name'];
        }
        $paso_alianza_id = 0;
        if (!empty($pasoAlianza)) {
            $paso_alianza_id = $pasoAlianza->id;
        }
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'paso_alianza_id' => $paso_alianza_id, 'pasoAlianza' => $pasoAlianza, 'alianza_id' => $alianza_id, 'tipo_paso_id' => $tipos_pasos, 'estado_id' => $estados, 'idAciva' => $idAciva, 'user_id' => $usersValidadores]);

        return $viewWith;
    }


    /**
     * Store a newly created PasosAlianza in storage.
     *
     * @param CreatePasosAlianzaRequest $request
     *
     * @return Response
     */
    public function store(CreatePasosAlianzaRequest $request)
    {
        if (isset($request['alianza']) && $request->file('archivo_input') ) {
            $estadoActiva = \App\Models\Estado::where([['uso','VALIDATOR'],['nombre','ACTIVA']])->first();
            $request['alianza_id'] = $request['alianza'];
            $request['estado_id'] = ($request['estado_id'] ?? $estadoActiva->id);
            $request['tipo_paso_id'] = ($request['tipo_paso_id'] ?? 6);
            $request['observacion'] = ($request['observacion'] ?? 'Documento final cargado.');
        }

        return $this->storeUpdate($request);
    }

    /**
     * Update the specified PasosAlianza in storage.
     *
     * @param  int              $id
     * @param UpdatePasosAlianzaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePasosAlianzaRequest $request)
    {

        return $this->storeUpdate($request,$id);
    }
    /**
     * Update the specified PasosAlianza in storage.
     *
     * @param  int              $id
     * @param UpdatePasosAlianzaRequest $request
     *
     * @return Response
     */
    public function storeUpdate($request,$id = '',$peticion = '')
    {
        
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $msg = '';

        $paso = 6;
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
        $estadoAlianzaActiva = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        $estadoAlianzaEnproceso = array_filter($estados, function($var){
            // Retorna siempre que el número entero sea par
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'EN PROCESO');
        });

        reset($estadoValidadorActiva);
        $keyEstadoActiva = key($estadoValidadorActiva);

        reset($estadoGenerarDocumento);
        $keyGenerarDocumento = key($estadoGenerarDocumento);

        reset($estadoAlianzaActiva);
        $keyAlianzaActiva = key($estadoAlianzaActiva);

        reset($estadoAlianzaEnproceso);
        $keyAlianzaEnproceso = key($estadoAlianzaEnproceso);

        if (is_array($request)) {
            $input = $request;
        }else{
            $this->validate($request, [
                'tipo_paso_id' => 'required',
                'estado_id' => 'required',
                'user_id' => 'required',
                'observacion' => 'required|max:190',
                'alianza_id' => 'required'
            ]);
            $input = $request->all();
        }
        $input['user_id'] = $user_actual->id;

        $datos = $input;


        if ($request['user_id'] != $user_actual->id) {
            Flash::error('No puede editar esta validación');

            return redirect(route('interalliances.validations_interalliances.show',[$input['alianza_id']]));
        }

        if ($peticion == '') {
            $peticion = $this->peticion;
        }
        $alianza = \App\Models\Alianza::find($input['alianza_id']);

        if ( empty($alianza) ) {
            
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.index'));
        }else{

            $alianza_id = $alianza->id;
        }

        if ($id == '' && $request['paso_alianza_id'] != 0 ) {
            $id = $request['paso_alianza_id'];
        }
        if ($id != '' ) {
            $pasosAlianza = $this->pasosAlianzaRepository->findWithoutFail($id);
            if (empty($pasosAlianza) && $peticion != 'local' ) {
                Flash::error('Validación de la alianza no encontrada.');

                return redirect(route('interalliances.validations_interalliances.show',$input['alianza_id']));
            }
        }
        $paso_id = $input['tipo_paso_id'];
        $validarEditar = $this->validarEditar('editar',$user_actual->id,$alianza_id,$paso_id);
        if ($validarEditar == false) {
            Flash::error('No es su turno, aún no se puede registrar la validación.');

            return redirect(route('interalliances.validations_interalliances.show',$input['alianza_id']));
        }
        
        $esUltimoValidador = false;
        if ($estadoValidadorActiva[$keyEstadoActiva]['id'] == $input['estado_id'] || $estadoGenerarDocumento[$keyGenerarDocumento]['id'] == $input['estado_id'] || $alianza->estado_id == $estadoAlianzaActiva[$keyAlianzaActiva]['id']) {
            //verifica si tiene el rol para generar el documento
            
            $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
            if ( $hasAllRoles ) {
                $validarEditar = $this->validarEditar('generar_documento',$user_actual->id);
                //compara si el ultimo validador es es actual para mostrarle la opcion
                if ($validarEditar == false) {
                    Flash::error('No tiene permitido realizar este tipo de validación.');

                    return redirect(route('interalliances.index'));
                }else{
                    $esUltimoValidador = true;
                }
            }else{
                Flash::error('No tiene permitido realizar este tipo de validación.');

                return redirect(route('interalliances.index'));
            }
            if ($estadoValidadorActiva[$keyEstadoActiva]['id'] == $input['estado_id'] ) {
                $this->validate($request, ['archivo_input' => 'required|mimes:pdf,jpg,png,jpeg']);
            }
        }

        if ($alianza->estado_id == $estadoAlianzaActiva[$keyAlianzaActiva]['id'] && $esUltimoValidador == false) {
            Flash::error('No se puede realizar la validación, la alianza ya esta activa.');

            return redirect(route('interalliances.validations_interalliances.show',$input['alianza_id']));
        }

        $comprobarValidacion = $this->comprobarValidacion('alianza',['campus_id' => $alianza->campus_id, 'alianzaId' => $alianza_id, 'estado_id' => $input['estado_id'], 'tipo_paso_id' => $input['tipo_paso_id'], 'paso' => $paso, 'user_id' => $input['user_id']]);
        
        if ($comprobarValidacion['ok'] === false) {
            
            if ($peticion != 'local' && $comprobarValidacion['error_msg'] != 'error_ya_registro') {
                // if ($estadoValidadorActiva[$keyEstadoActiva]['id'] != $input['estado_id'] ) {
                //     //ACTUALIZAR EL ESTADO DE LA ALIANZA
                //     $alianza->estado_id = $estadoAlianzaEnproceso[$keyAlianzaEnproceso]['id'];
                //     $alianza->save();
                // }
                Flash::error($comprobarValidacion['returnMsg']);
                // return redirect(route('interalliances.validations_interalliances.show',$input['alianza_id']));
                return redirect(route('interalliances.index'));
            }/*else{
                $msg .= $comprobarValidacion['returnMsg'].'<br>';
            }*/
        }else{

            $datos['pasos_anteriores'] = $comprobarValidacion;
        }

        DB::beginTransaction();

        $input['campus_id'] = $alianza->campus_id;

        // $buscar_registro = $this->pasosAlianza->where('tipo_paso_id',$input['tipo_paso_id'])->where('estado_id',$input['estado_id'])->where('user_id',$input['user_id'])->where('alianza_id',$input['alianza_id'])->orderBy('id','desc')->get();
        $buscar_registro = $this->pasosAlianza->where('tipo_paso_id',$input['tipo_paso_id'])->where('user_id',$input['user_id'])->where('alianza_id',$input['alianza_id'])->orderBy('id','desc')->get();
        if (count($buscar_registro)) {
            if ($id == '') {
                $id = $buscar_registro->first()->id;
            }
            $pasosAlianza = $this->pasosAlianzaRepository->update($input, $id);
            // $pasosAlianza = $this->pasosAlianzaRepository->findWithoutFail($buscar_registro[0]->id);
            // $pasosAlianza->observacion = $input['observacion'];
            // $pasosAlianza->save();
        }else{
            $pasosAlianza = $this->pasosAlianzaRepository->create($input);
        }

        //cargar el archivo de soporte

        if ( !is_array($request) && $request->file('archivo_input') ) {
            
            $request['tipo_documento'] = \App\Models\TipoDocumento::where('nombre','DOCUMENTOS FINALES ALIANZA')->pluck('id')->first();
            $request['peticion'] = 'local';
            $request['route'] = route('interalliances.index');

            $documents_store = $this->documents_store($alianza->id,$request);
            if ( is_string($documents_store)) {
                $errors += 1;
                array_push($errorsMsg, 'No se pudo procesar la carga del archivo del documento final de la alianza.');
                array_push($errorsMsg, $documents_store);
                goto end;
            }
        }

        // $datos['paso_proceso_id'] = 0;
        // if (isset($pasosAlianza->id)) {
        //     $datos['paso_proceso_id'] = $pasosAlianza->id;
        // }

        $datos['paso_proceso_id'] = $pasosAlianza->id ?? $id;


        $datos['campus_id'] = $alianza->campus_id;
        $datos['alianzaId'] = $alianza_id;
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
        // return redirect(route('interalliances.validations_interalliances.show',$input['alianza_id']));
        return redirect(route('interalliances.index'));

    }

    /**
     * Remove the specified PasosAlianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pasosAlianza = $this->pasosAlianzaRepository->findWithoutFail($id);

        if (empty($pasosAlianza)) {
            Flash::error('Pasos Alianza not found');

            // return redirect(route('interalliances.validations_interalliances.index'));
            return redirect(route('interalliances.index'));
        }

        $this->pasosAlianzaRepository->delete($id);

        Flash::success('Pasos Alianza deleted successfully.');

        // return redirect(route('interalliances.validations_interalliances.index'));
        return redirect(route('interalliances.index'));
    }

    /**
     * Remove the specified PasosAlianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function validarEditar($tipo,$user_id,$alianza_id = '',$paso_id = 0)
    {   
        
        $puedeEditar = false;
        $dondeSalio = 'VACIO';

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interalliance');
        $tipos_pasos_array = $tipos_pasos->select('id','nombre')->get()->toArray();

        if ($tipo == 'generar_documento') {
            //verificar que el validador sea el ultimo de la lista para habilitar la opcion de ACTIVA
            $roleValidador = Role::where('name','validador')->pluck('id');
            $ultimoValidador = \App\Models\Validation\UserPaso::select('users.id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos_array, 'id') )
                        ->where('model_has_roles.role_id',$roleValidador )
                        ->orderBy('user_tipo_paso.orden','desc')
                        ->first();
            //compara si el ultimo validador es es actual para mostrarle la opcion
            if ($ultimoValidador->id != $user_id) {
                $retorno = false;
                $dondeSalio = 'GENERAR_DOCUMENTO';
            }else{
                $retorno = true;
                $dondeSalio = 'GENERAR_DOCUMENTO';
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

            $registrosPasos = \App\Models\Validation\PasosAlianza::select('pasos_alianza.tipo_paso_id','pasos_alianza.estado_id','pasos_alianza.user_id','estado.uso AS estado_uso','estado.nombre AS estado_nombre','email.estado AS email_estado')
                        ->join('estado', 'pasos_alianza.estado_id', '=', 'estado.id')
                        ->leftJoin('pasos_alianza_email','pasos_alianza.id','pasos_alianza_email.pasos_alianza_id')
                        ->leftJoin('email', 'pasos_alianza_email.email_id', '=', 'email.id')
                        ->where('pasos_alianza.alianza_id',$alianza_id )
                        ->orderBy('pasos_alianza.tipo_paso_id','asc')
                        ->orderBy('pasos_alianza.id','asc')
                        ->get()->toArray();
                    // ->whereIn('estado.id',array_column($estadosValidador, 'id') )


            $hayValidaciones = 0;
            $keyAnterior = null;
            foreach ($registrosPasos as $key => $value) {

                if(in_array($registrosPasos[$key]['estado_uso'],['USER','EXTERNAL']) ){
                    if ($registrosPasos[$key]['estado_nombre'] == 'ACEPTADO'){
                        $puedeEditar = true;
                        $dondeSalio = 'ACEPTADO';
                    }elseif($registrosPasos[$key]['estado_nombre'] == 'DECLINADO'){
                        $puedeEditar = false;
                        $dondeSalio = 'DECLINADO';

                        break;
                    }
                }

                if(in_array($registrosPasos[$key]['estado_uso'],['VALIDATOR']) ){
                    $hayValidaciones = 1;
                    if(in_array($registrosPasos[$key]['estado_nombre'],['EN REVISIÓN','GENERAR DOCUMENTO']) ){
                        if ($registrosPasos[$key]['user_id'] == $user_id){
                            $puedeEditar = true;
                            $dondeSalio = 'REVISION_GENERAR';

                            break;
                        }else{
                            $puedeEditar = false;
                            $dondeSalio = 'REVISION_GENERAR';
                        }
                    }elseif(in_array($registrosPasos[$key]['estado_nombre'],['RECHAZADO']) ){
                        if ($registrosPasos[$key]['user_id'] == $user_id){
                            // $puedeEditar = true;
                            if ($keyAnterior !== null && $registrosPasos[$keyAnterior]['estado_nombre'] == 'APROBADO') {
                                // SI EL PASO ANTERIOR ES DE UN VALIDADOR
                                $puedeEditar = true;
                                $dondeSalio = 'ANTERIOR_APROBADO';
                            }elseif ($keyAnterior !== null && $registrosPasos[$keyAnterior]['estado_nombre'] == 'ACEPTADO') {
                                // SI EL PASO ANTERIOR ES DE UN COORD. EXTERNO
                                $puedeEditar = true;
                                $dondeSalio = 'ANTERIOR_ACEPTADO';
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
            }


            if ($hayValidaciones == 0) {
                //se espera que no cambie el tipo de paso de la alianza
                $tipo_paso_id = 6;
                $roleValidador = Role::where('name','validador')->pluck('id');
                $primerValidador = \App\Models\Validation\UserPaso::select('users.id')
                            ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->where('user_tipo_paso.tipo_paso_id',$tipo_paso_id)
                            ->where('model_has_roles.role_id',$roleValidador )
                            ->orderBy('user_tipo_paso.orden','asc');
                
                $primerValidador = $primerValidador->first();

                if ($primerValidador->id != $user_id) {
                    $puedeEditar = false;
                }
            }




            if ($paso_id != 0) {
                $tipo_paso_id = $paso_id;
            }else{
                $paso = 6;
                $tipo_paso_id = $this->tipoPaso->where('nombre','paso'.$paso.'_interalliance')->pluck('id')->first();
            }

            $roleValidador = Role::where('name','validador')->pluck('id');
            $validadoresPaso = \App\Models\Validation\UserPaso::select('users.id AS user_id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->where('user_tipo_paso.tipo_paso_id',$tipo_paso_id)
                        ->where('model_has_roles.role_id',$roleValidador )
                        ->orderBy('user_tipo_paso.orden','asc');
            
            $validadoresPaso = $validadoresPaso->get()->toArray();

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
                foreach ($validadoresPaso as $key => $validadorPaso) {
                    if ($validadorPaso['user_id'] == $ultimoRegistro['user_id']) {
                        $siguienteValidador = next($validadoresPaso) ?? [];
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
                $pasoRecibido = $paso_id;
                $pasos_validacion = array_filter($tipos_pasos_array, function($var) use ($pasoRecibido) {
                    return ($var['id'] < $pasoRecibido);
                });

                //obtiene el registro de los pasos registrados por el usuario (estudiante o coordinador)
                $pasos_registrados = \App\Models\Validation\PasosAlianza::join('estado','pasos_alianza.estado_id','estado.id')
                    ->where('pasos_alianza.alianza_id',$alianza_id)
                    ->where('estado.uso', 'USER')
                    ->select('pasos_alianza.tipo_paso_id')
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
        // echo $dondeSalio;

            $retorno = $puedeEditar;

        }

        return $retorno;

    }


}
