<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlianzaRequest;
use App\Http\Requests\UpdateAlianzaRequest;
use App\Repositories\AlianzaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Input;
use App\Authorizable;



use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\TipoPaso;
use App\Models\Admin\Institucion;
use App\Models\Admin\Facultad;
use App\Models\TipoAlianza;
use App\Models\TipoTramite;
use App\Models\TipoInstitucion;
use App\Models\Admin\Country;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Traits\Mails;
use App\Http\Traits\Validador;
use PDF;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class AlianzaController extends AppBaseController
{
    use Authorizable;
    use Mails;
    use Validador;
    /** @var  AlianzaRepository */
    private $alianzaRepository;

    private $user;
    private $campusApp;
    private $tipoPaso;
    private $paso_titulo;
    private $userCampus;
    private $institucion;
    private $facultad;
    private $coordinador_origen;
    private $coordinador_destino;
    private $tipoAlianza;
    private $tipoTramite;
    private $tipoInstitucion;
    private $pais;
    private $peticion;

    public function __construct(AlianzaRepository $alianzaRepo, TipoPaso $tipoPasoModel, Institucion $institucionModel, Facultad $facultadModel, User $userModel, TipoAlianza $tipoAlianzaModel, TipoTramite $tipoTramiteModel, TipoInstitucion $tipoInstitucionModel, Country $countryModel, Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()) {
                $this->user = Auth::user();
                if (isset($this->user->campus)) {
                    $this->campusApp = $this->user->campus;
                    if (session('campusApp') == null) {
                        session(['campusApp' => ($this->campusApp->first()->id ?? 0 ) ]);
                        session(['campusAppNombre' => ($this->campusApp->first()->nombre ?? 'No pertenece a alguna institución.' )]);
                    }
                    if (count($this->campusApp)) {
                        $this->campusApp = $this->campusApp->pluck('nombre','id');
                    }else{
                        $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                    }
                }else{
                    $this->campusApp = 0;
                }
            }
            return $next($request);

        });

        $this->alianzaRepository = $alianzaRepo;
        $this->tipoPaso = $tipoPasoModel;
        $this->institucion = $institucionModel;
        $this->facultad = $facultadModel;
        $this->coordinador_origen = $userModel;
        $this->coordinador_destino = $userModel;
        $this->tipoAlianza = $tipoAlianzaModel;
        $this->tipoTramite = $tipoTramiteModel;
        $this->tipoInstitucion = $tipoInstitucionModel;
        $this->pais = $countryModel;
        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        $this->paso_titulo = $this->tipoPaso->where('nombre','like','%_alianza')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');
    }

    /**
     * Display the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function notificarPaso($paso,$estado,$alianzaId)
    {
        //verificar si es necesario notificar acerca de los movimientos en el paso
    }
    public function crearPaso($paso,$estado,$alianzaId,$observacion = '')
    {
        $userId = $this->user->id;
        $tipo_paso = $this->tipoPaso->where('nombre','paso'.$paso.'_alianza')->pluck('id')->first();
        $estado = \App\Models\Estado::where('nombre',$estado)->pluck('id')->first();

        //¿siempre se crea un nuevo paso o se actualiza si existe?
            /*
            $pasoAlianza = \App\Models\Validation\PasosAlianza::where('tipo_paso_id',$tipo_paso)->where('alianza_id',$alianzaId)->where('user_id',$userId);
            $existePaso = $pasoAlianza->first();
            if ( count($existePaso) ) {
                $pasoAlianza->update(['estado_id' => $estado]);
                return $existePaso->id;
            }else{
            */
                $dataPaso['tipo_paso_id'] = $tipo_paso;
                $dataPaso['estado_id'] = $estado;
                $dataPaso['alianza_id'] = $alianzaId;
                $dataPaso['user_id'] = $userId;
                $dataPaso['observacion'] = $observacion;

                if ( $pasoAlianza = \App\Models\Validation\PasosAlianza::create($dataPaso) ){
                    $this->notificarPaso($paso,$estado,$alianzaId);


                    return $pasoAlianza;
                }else{
                    return false;
                }
            /*
            }
            */
        
    }

    /**
     * Display a listing of the Alianza.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->alianzaRepository->pushCriteria(new RequestCriteria($request));
        $alianzas = $this->alianzaRepository->all();

        return view('InterAlliance.index')
            ->with(['campusApp' => $this->campusApp, 'peticion' => $this->peticion, 'alianzas' => $alianzas]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function map()
    {
        return redirect('/html/interalliance-map.php');
    }

    /**
     * Show the form for creating a new Alianza.
     *
     * @return Response
     */
    public function create()
    {
        return redirect(route('interalliances.origin'));
        //return view('alianzas.create');

    }

    /**
     * Show the form for creating a new Alianza.
     *
     * @return Response
     */
    public function destination(Request $request, $token = '')
    {
        $_token = $token ?? '';
        $verificarToken = \App\Models\Alianza::where('token',$_token)->where('estado','0')->select('id','token')->first();

        if ( count($verificarToken) > 0 ) { 
            $viewWith = [];
            $alliance = [];
            $existeRepresentante = false;
            $alianzaId = $verificarToken->id;


            //solicita los datos de la alianza
            $datosAlianza = $this->datosAlianza($alianzaId,'destination','ver',0);

            $keyCoordExterno = $datosAlianza['keyCoordExterno'];

            //verifica y autentica al usuario externo
            if ( isset($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id'])  ) {

                $userExterno = \App\User::find($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id']);

                if ( !count($userExterno) ) {
                    return \View::make('errors.404')->with(['peticion' => $this->peticion]);
                }
                //autenticar al usuario
                Auth::login($userExterno);
                
                $userExterno->activo = 0;
                $userExterno->save();
                
            }else{
                return \View::make('errors.404')->with(['peticion' => $this->peticion]);
                
            }



            $dataAlianza['institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['id'];
            $dataAlianza['coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id'];

            $dataAlianza['tipo_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['tipo_institucion_id'];
            $dataAlianza['nombre_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['nombre'];
            $dataAlianza['direccion_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_direccion'];
            $dataAlianza['telefono_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_telefono'];
            $dataAlianza['codigo_postal_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_codigo_postal'];
            $dataAlianza['pais_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['pais_id'];
            $dataAlianza['departamento_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['departamento_id'];
            $dataAlianza['ciudad_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['ciudad_id'];

            $dataAlianza['nombre_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_nombres'];
            $dataAlianza['cargo_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_cargo'];
            $dataAlianza['telefono_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_telefono'];
            $dataAlianza['email_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_email'];
            

            //valida que el representante este inactivo para permitir modificar los datos de la institucion
            if ( isset($datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante'])  ) {

                $dataAlianza['repre_nombre'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['repre_nombre'];
                $dataAlianza['repre_cargo'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['cargo'];
                $dataAlianza['repre_telefono'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['telefono'];
                $dataAlianza['repre_email'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['repre_email'];
                $dataAlianza['repre_pais_nacimiento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['pais_id'];
                $dataAlianza['repre_tipo_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['tipo_documento_id'];
                $dataAlianza['repre_numero_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['numero_documento'];
                $dataAlianza['repre_fecha_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['fecha_expedicion'];
                $dataAlianza['repre_pais_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['pais_id'];
                $dataAlianza['repre_departamento_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['departamento_id'];
                $dataAlianza['repre_ciudad_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['ciudad_id'];

                if ( $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['usuario_activo'] == '1' ) {
                    $dataAlianza['institucion_destino'] = '999999';
                }else{
                    //verifica la existencia del representante legal y que este
                    $existeRepresentante = true;

                    $dataAlianza['tipo_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['tipo_institucion_nombre'];
                    $dataAlianza['pais_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['pais_nombre'];
                    $dataAlianza['departamento_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['departamento_nombre'];
                    $dataAlianza['ciudad_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['ciudad_nombre'];


                    $dataAlianza['repre_pais_nacimiento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['pais_nombre'];
                    $dataAlianza['repre_tipo_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['tipo_documento_nombre'];
                    $dataAlianza['repre_pais_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['pais_nombre'];
                    $dataAlianza['repre_departamento_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['departamento_nombre'];
                    $dataAlianza['repre_ciudad_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['ciudad_nombre'];
                }
            }else{
                $dataAlianza['institucion_destino'] = '999999';
            }

            //valida que el coordinador este inactivo para permitir modificar los datos del coordinador
            /*
            if ($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_activo'] == '1' ) {
                $dataAlianza['coordinador_destino'] = '999999';
            }else{
                $dataAlianza['nombre_coordinador_destino'] = '';
                $dataAlianza['cargo_coordinador_destino'] = '';
                $dataAlianza['telefono_coordinador_destino'] = '';
                $dataAlianza['email_coordinador_destino'] = '';
            }
            */


            

            if ($existeRepresentante == false) {
                //retornar el formulario desde el paso 4 al coordinador
                $tipo_institucion_destino = $this->tipoInstitucion->pluck('nombre','id');
                $pais_institucion_destino = $this->pais->pluck('nombre','id');
                $departamento_institucion_destino = \App\Models\Admin\State::where('pais_id',$dataAlianza['pais_institucion_destino'])->pluck('nombre','id');
                $ciudad_institucion_destino = \App\Models\Admin\City::where('departamento_id',$dataAlianza['departamento_institucion_destino'])->pluck('nombre','id');

                $repre_departamento_exped_documento = \App\Models\Admin\State::where('pais_id',$dataAlianza['repre_pais_exped_documento'])->pluck('nombre','id');
                $repre_ciudad_exped_documento = \App\Models\Admin\City::where('departamento_id',$dataAlianza['repre_departamento_exped_documento'])->pluck('nombre','id');
                
                $clase_documento = \App\Models\ClaseDocumento::where('nombre','IDENTIDAD')->pluck('id');
                $repre_tipo_documento = \App\Models\TipoDocumento::where('clase_documento_id',$clase_documento)->pluck('nombre','id');
            }
            


            $coordinador_destino_todos = $this->coordinador_destino
                ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                ->where('campus.institucion_id', $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['id'] )->role(['coordinador_externo','profesor'])->select('users.name','users.id');
            $coordinador_destino = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_destino_todos)->pluck('name','id');



            //datos generales
            $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'atoken' => $_token,'alianzaId' => $alianzaId, 'existeRepresentante' => $existeRepresentante, 'alliance' => $dataAlianza, 'coordinador_destino' => $coordinador_destino, 'paso_titulo' => $this->paso_titulo, 'nombre' => 'alianza', 'paso' => '4','peticion' => 'externa']);

            if ($existeRepresentante == false) {
                //datos para la institucion de destino
                $viewWith = array_merge($viewWith, ['tipo_institucion_destino' => $tipo_institucion_destino, 'pais_institucion_destino' => $pais_institucion_destino, 'departamento_institucion_destino' => $departamento_institucion_destino, 'ciudad_institucion_destino' => $ciudad_institucion_destino]);

                //datos para el representante
                $viewWith = array_merge($viewWith, ['repre_pais_nacimiento' => $pais_institucion_destino,'repre_tipo_documento' => $repre_tipo_documento, 'repre_pais_exped_documento' => $pais_institucion_destino, 'repre_departamento_exped_documento' => $repre_departamento_exped_documento, 'repre_ciudad_exped_documento' => $repre_ciudad_exped_documento]);
            }

            return view('InterAlliance.create') 
            ->with($viewWith);

        }else{
            return \View::make('errors.404')->with(['peticion' => $this->peticion]);
        }

    }

    
    /**
     * Show the form for creating a new Alianza.
     *
     * @return Response
     */
    public function origin($alianzaId = '')
    {
        //$RouteName = Route::currentRouteName();
        //echo session('campusApp');
        if( session('campusApp') != null ){
            $campusAppId = session('campusApp');
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('interalliances.index'));
        }

        $campusApp = \App\Models\Admin\Campus::find($campusAppId);
                
        //print_r($this->paso_titulo);
        $institucionId = $campusApp->institucion->id;
        
        //falta conocer a que campus pertenece el usuario y asi asociar todo a ese mismo campus
        //$userCampus = $campusApp->id mpus_id;
        $this->userCampus = 1;
        $institucion_destino_todos = $this->institucion->where('id','!=',$this->userCampus)->select('nombre','id');
        $institucion_destino = $this->institucion->select(DB::raw("'Otra' AS nombre, '999999' AS id"))->union($institucion_destino_todos)->pluck('nombre','id');;
        //agregar el campo 'Otro' para que agreguen una nueva unidad (facultad)
        $facultad_origen_todos = $this->facultad->select('nombre','id');
        $facultad_origen = $this->facultad->select(DB::raw("'Otra' AS nombre, '999999' AS id"))->union($facultad_origen_todos)->pluck('nombre','id');
        
        //-------------------------------
        //-------------------------------
        // INICIO OTRAS PRUEBAS
        //-------------------------------
        //-------------------------------
        
        /*
        $datos['to'] = [array('email' => 'uno@email.com','name' => 'uno nombre'),array('email' => 'dos@email.com','name' => 'dos nombre')];
        $separado_por_comas = implode(", ", array_column($datos['to'], 'email'));
        //$separado_por_comas = implode(", ", $datos['to']);
        echo join('<br>', array_map(
            function ($first, $last) { return "The Name: $first The e-mail: $last"; },
            array_column($datos['to'], 'name'),
            array_column($datos['to'], 'email')
        ));
        //print_r($separado_por_comas);
        $dataMail['to'] = [];
        foreach ($datos['to'] as $to) {
            array_push($dataMail['to'],array('email' => $to['email'], 'name' => $to['name'] ) );
        }
        $dataMail['to'] = json_encode($dataMail['to']);
        print_r($dataMail['to']);
        */
        //-------------------------------
        //-------------------------------
        // FIN OTRAS PRUEBAS
        //-------------------------------
        //-------------------------------

        //muestra los usuarios con el rol de profesores y coordinador_interno del campus del usuario que esta llenando el formulario
        
        $coordinador_origen_todos = $this->coordinador_origen
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->where('user_campus.campus_id',$this->userCampus)->role(['coordinador_interno','profesor'])->select('users.name','users.id');
        $coordinador_origen = $this->coordinador_origen->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_origen_todos)->pluck('name','id');
        
        //muestra los usuarios con el rol de profesores y coordinador_externo de campus de instituciones diferentes al del usuario que esta llenando el formulario
        $coordinador_destino = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->pluck('name','id');

        $tipo_alianza = $this->tipoAlianza->pluck('nombre','id');
        $tipo_tramite = $this->tipoTramite->pluck('nombre','id');
        $tipo_institucion_destino = $this->tipoInstitucion->pluck('nombre','id');
        $pais_institucion_destino = $this->pais->pluck('nombre','id');

        $IdDocumentosInstitucion =  \App\Models\DocumentosInstitucion::where('institucion_id',$institucionId)->pluck('archivo_id')->toArray();
        $enviar_documentos =  \App\Models\Archivo::whereIn('id',$IdDocumentosInstitucion)->select('nombre','id','path')->get()->toArray();


        //variables vacias para que la vista sea compatible con la creacion y edicion 
        $programa_origen = [];
        $modalidad = [];
        $departamento_institucion_destino = [];
        $ciudad_institucion_destino = [];

        $viewWith = ['campusApp' => $this->campusApp, 'paso_titulo' => $this->paso_titulo, 'institucion_destino' => $institucion_destino, 'facultad_origen' => $facultad_origen, 'programa_origen' => $programa_origen, 'coordinador_origen' => $coordinador_origen, 'coordinador_destino' => $coordinador_destino, 'tipo_alianza' => $tipo_alianza, 'modalidad' => $modalidad, 'tipo_tramite' => $tipo_tramite, 'tipo_institucion_destino' => $tipo_institucion_destino, 'pais_institucion_destino' => $pais_institucion_destino, 'departamento_institucion_destino' => $departamento_institucion_destino, 'ciudad_institucion_destino' => $ciudad_institucion_destino, 'enviar_documentos' => $enviar_documentos, 'nombre' => 'alianza', 'paso' => '1','peticion' => $this->peticion ?? 'normal'];

        if ( $alianzaId != '' ) {
            $viewWith = array_merge($viewWith,['alianzaId' => $alianzaId]);
            return $viewWith;
        }else{
            return view('InterAlliance.create')->with($viewWith);
        }
                
        

    }


    /**
     * Store a newly created Alianza in storage.
     *
     * @param CreateAlianzaRequest $request
     *
     * @return Response
     */
    //public function store(CreateAlianzaRequest $request)
    public function storeUpdate(Request $request, $tipo, $id = '')
    {
        
        $input = $request->all();
        
        //print_r($input);

        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $userId = $this->user->id;

        //hacer el campus en el que estan trabajando una variable global o tomarla de la aplicacion
        //$campusApp->id

        //el email del campus y de la institucion destino son necesarios?

        $institucionOrigen = '';
        $institucionDestino = '';
        $passwordCoordinadorOrigen;
        $passwordCoordinadorDestino;
        $alianza = '';
        $alianzaId = 0;
        $coordinadorOrigenId = 0;
        $coordinadorDestinoId = 0;
        $coordinadorDestino = '';
        $campusAppId = 0;
        $campusApp = 0;
        $campusId = 0;
        $facultadId = 0;
        $paso = 0;
        $paso_id = 0;


        //verificar la existencia de la alianza
        if ($id != '') {
            $alianzaId = $id;
        }elseif (isset($request['alianzaId'])) {
            $alianzaId = $request['alianzaId'];
        }elseif( session('alianzaId') != null ){
            $alianzaId = session('alianzaId');
        }

        if ($alianzaId != 0) {
            $alianza = $this->alianzaRepository->findWithoutFail($alianzaId);

            if (empty($alianza)) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro la alianza.');
                goto end;
            }
        }

        //verificar la existencia del id del campus, que el usuario haya seleccionado el campus que quiere usar
        if (isset($request['campusApp'])) {
            $campusAppId = $request['campusApp'];
        }elseif( session('campusApp') != null ){
            $campusAppId = session('campusApp');
        }else{
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra el campus, seleccione el campus que va a usar.');
            goto end;
        }

        $campusApp = \App\Models\Admin\Campus::find($campusAppId);

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_alianza')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS n_paso'))->pluck('titulo','n_paso');
        /*
        echo '<hr>';
        
        */

        $crearTipo = 'nuevo';
        $estadoPaso = 'PENDIENTE POR REVISIÓN';
        $rolName = 'coordinador_interno';
        $buscarCoordinadorInterno = 0;
        $buscarInstitucionOrigen = 0;
        $buscarCoordinadorExterno = 0;
        $buscarInstitucionDestino = 0;

        if ( isset($request['modificar']) && $request['paso'] ) {
            $crearTipo = 'actualizar';
            $estadoPaso = 'ACTUALIZACIÓN DE DATOS';
            
            if ( $request['paso'] == '2') {
                $rolName = 'coordinador_externo';
            }

        }

        if ($alianzaId != 0) {
            if ( $request['paso'] == '1' || $request['paso'] == '2') {
                //buscar el rol del coordinador y del representante
                $roleCoordinador = Role::where('name',$rolName)->pluck('id');
                //buscar el usuario del coordinador Interno de la alianza
                $buscarCoordinadorInterno = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('alianza.id',$alianzaId )
                    ->where('model_has_roles.role_id',$roleCoordinador )
                    ->select('users.id');
                //echo $buscarCoordinadorInterno->toSql();
                $buscarCoordinadorInterno = $buscarCoordinadorInterno->first();

                $buscarInstitucionOrigen = \App\Models\AlianzaInstitucion::join('institucion', 'alianza_institucion.institucion_id', '=', 'institucion.id')
                    ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                    ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                    ->where('alianza_institucion.alianza_id',$alianzaId )
                    ->where('user_campus.user_id',$buscarCoordinadorInterno->id )
                    ->select('institucion.nombre','campus.institucion_id','campus.id AS campus_id');
                //echo $buscarInstitucionOrigen->toSql();
                $buscarInstitucionOrigen = $buscarInstitucionOrigen->first();

            }
        }


        if ( isset($request['modificar']) && $request['paso'] ) {

            if ( $request['paso'] == '2') {
                $buscarCoordinadorExterno = $buscarCoordinadorInterno;
                $buscarInstitucionDestino = $buscarInstitucionOrigen;
            }
        }

        //print_r($request->all());

      $reglas = [];
      if ( isset($request['paso']) ) {
          if ( $request['paso'] == '1' ) {
            $reglas = [
                'tipo_tramite' => 'required',
                ];

            if ( $request['tipo_tramite'] != '' ) {
                $reglas = array_merge($reglas, [
                'facultad_origen' => 'required',
                'sera_coordinador_origen' => 'required',
                ] );
            }
            
            //en el caso de que escojan la opcion Otro
            if ( isset($request['facultad_origen']) && array_search('999999', $request['facultad_origen']) ) {
                $reglas = array_merge($reglas, [
                'facultad_origen_otro' => 'required',
                ] );
            }

            if ( $request['sera_coordinador_origen'] == 'NO' ) {
                $reglas = array_merge($reglas, [
                'coordinador_origen' => 'required',
                ] );
                //en el caso de que escojan la opcion Otro
                if ( $request['coordinador_origen'] == '999999' ) {
                    $reglas = array_merge($reglas, [
                    'nombre_coordinador_origen' => 'required',
                    'cargo_coordinador_origen' => 'required|min:1',
                    'telefono_coordinador_origen' => 'required|min:6',
                    'email_coordinador_origen' => 'required|email|unique:users,email',
                    ] );
                }
            }

            if ( $request['tipo_tramite'] != '' ) {
                $reglas = array_merge($reglas, [
                'tipo_alianza' => 'required',
                'modalidad' => 'required',
                'duracion_cant' => 'required',
                'duracion_unid' => 'required',
                'objetivo_alianza' => 'required',
                ] );
            }

          }
          if ( $request['paso'] == '2' ) {
              
            $reglas = array_merge($reglas, [
                'institucion_destino' => 'required',
                'coordinador_destino' => 'required',
            ] );
            //en el caso de que escojan la opcion Otro
            if ( $request['institucion_destino'] == '999999' ) {
                $reglas = array_merge($reglas, [
                'tipo_institucion_destino' => 'required',
                'nombre_institucion_destino' => 'required',
                'direccion_institucion_destino' => 'required',
                'telefono_institucion_destino' => 'required',
                'codigo_postal_institucion_destino' => 'required',
                'ciudad_institucion_destino' => 'required',
                ] );
            }
            //en el caso de que escojan la opcion Otro
            if ( $request['coordinador_destino'] == '999999' ) {
                $reglas = array_merge($reglas, [
                'nombre_coordinador_destino' => 'required',
                'cargo_coordinador_destino' => 'required',
                'telefono_coordinador_destino' => 'required',
                'email_coordinador_destino' => 'required|email|unique:users,email',
                ] );
            }


          }
          if ( $request['paso'] == '4' ) {
            
            $reglas = array_merge($reglas, [
                'atoken' => 'required',
                'coordinador_destino' => 'required',
                'aceptar_alianza' => 'required',
            ] );
                //en el caso de que escojan la opcion SI
            if ( $request['aceptar_alianza'] == 'SI' ) {
                if ( $request['existeRepresentante'] != '1' ) {
                    $reglas = array_merge($reglas, [
                    'tipo_institucion_destino' => 'required',
                    'institucion' => 'required',
                    'direccion_institucion_destino' => 'required',
                    'telefono_institucion_destino' => 'required',
                    'codigo_postal_institucion_destino' => 'required', 
                    'ciudad_institucion_destino' => 'required',
                    ] );
                }

                //en el caso de que escojan la opcion Otro
                if ( $request['coordinador_destino'] == '999999' ) {
                    $reglas = array_merge($reglas, [
                    'nombre_coordinador_destino' => 'required',
                    'cargo_coordinador_destino' => 'required',
                    'telefono_coordinador_destino' => 'required',
                    'email_coordinador_destino' => 'required|email|unique:users,email',
                    ] );
                }else{
                    $reglas = array_merge($reglas, [
                    'nombre_coordinador_destino' => 'required',
                    'cargo_coordinador_destino' => 'required',
                    'telefono_coordinador_destino' => 'required',
                    'email_coordinador_destino' => 'required',
                    ] );
                }
            }else{

                $reglas = array_merge($reglas, [
                'observacion_aceptar_alianza' => 'required',
                ] );
            }

          }
          if ( $request['paso'] == '5' ) {
            $reglas = array_merge($reglas, [
                'atoken' => 'required',
                'aceptar_alianza' => 'required',
            ] );
                //en el caso de que escojan la opcion SI
            if ( $request['aceptar_alianza'] == 'SI' ) {
                //en el caso de que exista el representante
                if ( $request['existeRepresentante'] != '1' ) {
                    $reglas = array_merge($reglas, [
                        'atoken' => 'required',
                        'repre_nombre' => 'required',
                        'repre_cargo' => 'required',
                        'repre_telefono' => 'required',
                        'repre_email' => 'required|email|unique:users,email',
                        'repre_pais_nacimiento' => 'required',
                        'repre_tipo_documento' => 'required',
                        'repre_numero_documento' => 'required',
                        'repre_fecha_exped_documento' => 'required',
                        'repre_ciudad_exped_documento' => 'required',
                        'archivo_documentos'       => 'required|mimes:pdf,jpg,png,jpeg',
                    ] );
                }
            }
            

          }
      }else{
        $errors += 1;
        array_push($errorsMsg, 'No se han recibido datos validos.');
        goto end;
      }

        $this->validate($request, $reglas);
        
        
        
        //las facultades de destino seran asignadas por el coordinador externo
        
        DB::beginTransaction();
        
        /*
        // POR AHORA NO HABRÁ VALIDACION POR CADA PASO, AL TERMINAR TODO EL REGISTRO SE HARA LA VALIDACION

        //valida que reciba el numero del paso y que no sea el 1
        if ( isset($request['paso']) && $request['paso']-1 <> 0 ) {
            

            if ($alianzaId != 0) {
                $datos['tipo'] = 'anterior';
                $datos['campusAppId'] = $campusAppId;
                $datos['paso'] = $request['paso']-1;
                $datos['alianzaId'] = $alianzaId;
                $verificarValidacion = $this->verificarValidacion($datos);
                if ( $verificarValidacion['retorno'] == false ) {
                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    goto end;
                }elseif( $verificarValidacion['retorno'] === 'no_continuar' ){
                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    //array_push($ errorsMsg, '<input type="hidden" class="dato_adicional" name="noNext" value="1">');
                    goto end;
                }elseif( $verificarValidacion['retorno'] == true ){
                    //array_push($okMsg,'<input type="hidden" class="dato_adicional" name="noNext" value="1">');
                }
            }
        }
        */
        /// INICIO PASO 1
        /// INICIO PASO 1
        /// INICIO PASO 1


        if ( isset($request['paso']) && $request['paso'] == '1' ) {
        //EL USUARIO QUE CREA LA ALIANZA DEBE ESTAR ASOCIADO A LA FACULTAD DE ORIGEN

        //si el usuario que crea la alianza si es el coordinador entonces asignar el usuario a tipo coordinador interno y obtener el id para asociarlo a la alianza 
            //[sera_coordinador_origen]
            //$role = Role::where('name','coordinador_interno')->get();
            

            if ( $input['sera_coordinador_origen'] == 'SI' ) {
                $coordinadorOrigen = $this->asociarUsuario('coordinador',$this->user->id,'coordinador_interno',$campusAppId,'');
                    
                if ( $coordinadorOrigen === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el coordinador del origen.');
                    goto end;
                }elseif( $coordinadorOrigen != false ){
                    $coordinadorOrigenId = $coordinadorOrigen->id;
                }
            }
        //si el usuario que crea la alianza no es el coordinador entonces validar si no existe el usuario y crear el usuario de tipo coordinador interno y obtener el id para asociarlo a la alianza 
            //nombre_coordinador_origen, cargo_coordinador_origen, telefono_coordinador_origen, email_coordinador_origen
            //generar un password
            if ( $input['sera_coordinador_origen'] == 'NO' ) {
                if ( $input['coordinador_origen'] == '999999' ) {
                    //datos del usuario
                        $dataUser['name']= $input['nombre_coordinador_origen'];
                        $dataUser['email']= $input['email_coordinador_origen'];
                        $dataUser['activo']= 1;
                        // crear password
                        $passwordCoordinadorOrigen = str_random(8);
                        //no sera encriptado hasta que se envie el email
                        //$dataUser['password']= bcrypt( $passwordCoordinadorOrigen );
                        $dataUser['password']= $passwordCoordinadorOrigen;
                    //datos personales del usuario
                        $dataDatosPersonalesOrigen['nombres']= $input['nombre_coordinador_origen'];
                        $dataDatosPersonalesOrigen['ciudad_residencia_id']= $campusApp->ciudad->id;
                        $dataDatosPersonalesOrigen['telefono']= $input['telefono_coordinador_origen'];
                        $dataDatosPersonalesOrigen['cargo']= $input['cargo_coordinador_origen'];
                        
                        //en el caso de querer modificar los datos
                        $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'coordinador_interno',$campusApp->id,$dataDatosPersonalesOrigen,'');
                        // Create the user
                        if ( $crearUsuario === 'error_usuario' ) {

                            $errors += 1;
                            array_push($errorsMsg, 'No se puede crear el coordinador interno.');
                            goto end;
                        }elseif( $crearUsuario === 'error_datos_personales' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se pueden crear los datos personales del coordinador interno.');
                            goto end;
                        }elseif( $crearUsuario != false ){
                            $coordinadorOrigenId = $crearUsuario->id;
                        }
                            
                    
                } else {
                    
                    
                    $coordinadorOrigen = $this->asociarUsuario('coordinador',$request['coordinador_origen'],'coordinador_interno',$campusApp->id,'');
                    
                    if ( $coordinadorOrigen === 'error_usuario' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se encontro el coordinador del origen.');
                        goto end;
                    }elseif( $coordinadorOrigen != false ){
                        $coordinadorOrigenId = $coordinadorOrigen->id;
                    }

                }
                        
            
            }

        //registrar la alianza: objetivo, tipo_tramite_id, duracion, responsable_arl, estado
            //objetivo_alianza, tipo_tramite, duracion_cant, duracion_unid, responsable_arl

            
            $dataAlianza['objetivo']= $input['objetivo_alianza'];
        // se debe determinar que accion tomar en cada tipo de tramite
            $dataAlianza['tipo_tramite_id']= $input['tipo_tramite'];
            $dataAlianza['duracion']= $input['duracion_cant'] .' '. $input['duracion_unid'];
            $dataAlianza['responsable_arl']= $input['responsable_arl'];
            $dataAlianza['estado']= 0; //activo
            $dataAlianza['token']= md5(hash("md2",(string)microtime())).hash("md2",(string)microtime());

            //valida si existe el id de la alianza, lo que quiere decir que se va a actualizar
            if ( $alianzaId != 0 && isset($request['modificar']) ) {
                $dataAlianza['id'] = $alianzaId;
            }

            $crearAlianza = $this->crearAlianza($crearTipo,$dataAlianza,$coordinadorOrigenId,$campusApp->id);

            if ( $crearAlianza === 'error_alianza' ) {
                $errors += 1;
                array_push($errorsMsg, 'No se puede crear la alianza.');
                goto end;
            }elseif( $crearAlianza === false ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede crear la alianza.');
                goto end;
            }elseif( $crearAlianza != false ){
                $alianza = $crearAlianza;
                $alianzaId = $crearAlianza->id;


        //asociar las facultades: alianza_facultades
            //facultad_origen[], facultad_origen_otro
            //si existe facultad_origen_otro entonces crear el nuevo registro en la facultad y que sea de tipo unidad
                
                if ( array_search('999999', $input['facultad_origen']) ) {
                    
                    $tipo_facultad = 'UNIDAD';
                    $datafacultad['nombre'] = $input['facultad_origen_otro'];
                    $datafacultad['campus_id'] = $campusApp->id;
                    $otrasfacultades = $input['facultad_origen'];

                    $crearFacultad = $this->crearFacultad('origen',$datafacultad,$tipo_facultad,$otrasfacultades,$alianza);

                    if ( $crearFacultad === 'error_facultad' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear la nueva unidad origen.');
                        goto end;
                    }elseif( $crearFacultad != false ){
                        $nuevafacultad = $crearFacultad;
                    }
                    

                }else{
                    //quitar el elemento 'Otro' que tiene el id '999999' en el caso que este
                    unset($input['facultad_origen']['999999']);
                    //asociar las facultades
                    $asociarFacultad = $this->crearFacultad('origen',false,false,$input['facultad_origen'],$alianza);
                    if ( $asociarFacultad == false ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede asociar la facultad.');
                        goto end;
                    }
                }

            //asociar los programas: alianza_programas
                //programa_origen[]
                if ( isset( $input['programa_origen'] ) ) {
                    $programas = \App\Models\Programa::find($input['programa_origen']);
                    $alianza->programa()->sync($programas);
                }



        //asociar las modalidades: alianza_modalidad
            //modalidad[]
                $modalidades = \App\Models\Modalidad::find($input['modalidad']);
                $alianza->modalidad()->sync($modalidades);

            }

            if ( isset($request['modificar']) ) {
        //quitar la asociacion del coordinador anterior con la alianza
                if ($buscarCoordinadorInterno->id != $coordinadorOrigenId) {
                    $alianza->user()->detach($buscarCoordinadorInterno->id);
                }
        //quitar la asociacion de la institucion anterior con la alianza
                if ($buscarInstitucionOrigen->institucion_id != $campusApp->institucion->id) {
                    $alianza->institucion()->detach($buscarInstitucionOrigen->institucion_id);
                }
            }
            


        //GUARDAR EL PASO
            $tipo_paso_id = 0;

            $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            $paso = $request['paso'];


        }    

        /// FIN PASO 1
        /// FIN PASO 1
        /// FIN PASO 1

        /// INICIO PASO 2
        /// INICIO PASO 2
        /// INICIO PASO 2

        if ( isset($request['paso']) && $request['paso'] == '2' ) {

            $institucionOrigen = $buscarInstitucionOrigen;
            
            /*
            $institucionOrigen = DB::table('institucion')
                ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                ->where('campus.id',[$campusApp->id ])
                ->select('institucion.id','institucion.nombre')->first();
            */
            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }


        //DATOS DE LA INSTITUCION DE DESTINO



        //crear una nueva institucion: institucion, email, tipo_institucion
            //institucion, email_coordinador_destino, tipo_institucion

            
            if ( $input['institucion_destino'] == '999999' ) {

                //datos de la nueva institucion
                
                $dataInstitucion['nombre']= $input['nombre_institucion_destino'];
                $dataInstitucion['tipo_institucion_id']= $input['tipo_institucion_destino'];

                //datos del nuevo campus
                $nombreCampus = \App\Models\Admin\City::select('nombre')->where('id',$input['ciudad_institucion_destino'])->get();
            
                
                $dataCampus['nombre']= $nombreCampus[0]->nombre;
                $dataCampus['telefono']= $input['telefono_institucion_destino'];
                $dataCampus['direccion']= $input['direccion_institucion_destino'];
                $dataCampus['codigo_postal']= $input['codigo_postal_institucion_destino'];
                $dataCampus['ciudad_id']= $input['ciudad_institucion_destino'];

                //datos de la nueva facultad
                

                /*
                $alianza = \App\Models\Alianza::find($alianzaId);
                if (!count($alianza)) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro la alianza');
                    goto end;
                }
                if ($alianza->estado == 1 ) {
                    $errors += 1;
                    array_push($errorsMsg, 'La alianza esta inactiva');
                    goto end;
                }*/
                
                $crearInstitucion = $this->crearInstitucion('nuevo',$dataInstitucion,$dataCampus,$alianza);

                if ( $crearInstitucion === 'error_institucion' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear la institucion destino.');
                    goto end;
                }elseif ( $crearInstitucion === 'error_campus' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el campus de la institucion destino.');
                    goto end;
                }elseif ( $crearInstitucion === 'error_facultad' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear la facultad de la institucion destino.');
                    goto end;
                }elseif( $crearInstitucion != false ){
                    $institucionDestino = $crearInstitucion['institucionId'];
                    $campusId = $crearInstitucion['campusId'];
                    $facultadId = $crearInstitucion['facultadId'];
                }

            } else {
                /*
                $alianza = \App\Models\Alianza::find($alianzaId);
                if (!count($alianza)) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro la alianza.');
                    goto end;
                }
                if ($alianza->estado == 1 ) {
                    $errors += 1;
                    array_push($errorsMsg, 'La alianza esta inactiva');
                    goto end;
                }*/
                
                $asociarInstitucion = $this->crearInstitucion('asociar',$input['institucion_destino'],'',$alianza);

                if ( $asociarInstitucion === 'error_institucion' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro la institucion de destino.');
                    goto end;
                }elseif( $asociarInstitucion === false ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro la institucion de destino.');
                    goto end;
                }elseif( $asociarInstitucion != false ){
                    $institucionDestino = $asociarInstitucion->id;
                    $campusId = $asociarInstitucion->campus[0]->id;
                }

                
                //hallar el id de la ciudad del campus de la institucion de destino
                $ciudad_institucion_destino = DB::table('campus')
                        ->join('institucion', 'institucion.id', '=', 'campus.institucion_id')
                        ->where('institucion.id',$input['institucion_destino'] )
                        ->select('campus.ciudad_id')->first();
                        
                $input['ciudad_institucion_destino'] = $ciudad_institucion_destino->ciudad_id;
            };



        //crear el usuario de tipo coordinador externo y obtener el id para asociarlo a la institucion
            //[el nombre del email], email_coordinador_destino, [generar un password]

            if ( $input['coordinador_destino'] == '999999' ) {
              //datos del usuario
                //$dataCoordinador['name']= strtok($input['email_coordinador_destino'], '@');
                $dataUser['name']= $input['nombre_coordinador_destino'];
                $dataUser['email']= $input['email_coordinador_destino'];
                $dataUser['activo']= 1;
                // crear password
                $passwordCoordinadorDestino = str_random(8);
                //no sera encriptado hasta que se envie el email
                //$dataUser['password']= bcrypt( $passwordCoordinadorDestino );
                $dataUser['password']= $passwordCoordinadorDestino;
              //datos personales del usuario
                $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
                $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];

                $crearUsuario = $this->crearUsuario('nuevo',$dataUser,'coordinador_externo',$campusId,$dataDatosPersonalesDestino,$alianza);
                // Create the user
                if ( $crearUsuario === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el coordinador externo.');
                    goto end;
                }elseif( $crearUsuario === 'error_datos_personales' ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se pueden crear los datos personales del coordinador externo.');
                    goto end;
                }elseif( $crearUsuario === 'error_asociar' ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede asociar el coordinador externo.');
                    goto end;
                }elseif ( $crearUsuario === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el coordinador externo.');
                    goto end;
                }elseif( $crearUsuario != false ){
                    $coordinadorDestino = $crearUsuario;
                    $coordinadorDestinoId = $crearUsuario->id;
                }


            } else {

                $coordinadorDestino = $this->asociarUsuario('coordinador',$input['coordinador_destino'],'coordinador_externo',$campusId,$alianza);
                
                if ( $coordinadorDestino === 'error_usuario' || $coordinadorDestino === false  ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el coordinador del destino.');
                    goto end;
                }elseif( $coordinadorDestino != false ){
                    $coordinadorDestinoId = $coordinadorDestino->id;
                }

            };

            if ( isset($request['modificar']) ) {
        //quitar la asociacion del coordinador anterior con la alianza
                if ($buscarCoordinadorExterno->id != $coordinadorDestinoId) {
                    $alianza->user()->detach($buscarCoordinadorExterno->id);
                }
        //quitar la asociacion de la institucion anterior con la alianza
                if ($buscarInstitucionDestino->institucion_id != $institucionDestino) {
                    $alianza->institucion()->detach($buscarInstitucionDestino->institucion_id);
                }
            }

        //GUARDAR EL PASO 2
            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }


            $dataMail = '';
            $idPaso = 0;
        //GUARDAR EL PASO 3
            $tipo_paso = $this->tipoPaso->where('nombre','paso3_alianza')->pluck('id')->first();
            if ( isset($request['modificar']) ) {
                
                $dataMail = DB::table('pasos_alianza')
                    ->join('pasos_alianza_mail', 'pasos_alianza.id', '=', 'pasos_alianza_mail.pasos_alianza_id')
                    ->join('mail', 'pasos_alianza_mail.mail_id', '=', 'mail.id')
                    ->where('pasos_alianza.alianza_id',$alianzaId )
                    ->where('pasos_alianza.tipo_paso_id',$tipo_paso )
                    ->select('pasos_alianza.id AS pasos_alianza_id','mail.id')
                    ->orderBy('mail.created_at','desc');
                //echo $dataMail->toSql().' |$alianzaId:'.$alianzaId.' |$tipo_paso:'.$tipo_paso;
                $dataMail = $dataMail->get();
                    
                $crearPaso = true;

            }else{
                $crearPaso = $this->crearPaso('3',$estadoPaso,$alianzaId);
                
                $idPaso = $crearPaso->id;
            }


            if ( $crearPaso ){
                $mail_id = 0;

                if ( isset($request['modificar']) ) {
                    if ( count($dataMail) ) {
                        $mail_id = $dataMail[0]->id;
                    }
                    $idPaso = $dataMail[0]->pasos_alianza_id;
                }
                
        //CREAR EL REGISTRO DEL MAIL

                $roleCoordinador = Role::where('name','coordinador_interno')->pluck('id');
                $roleCopiaEmails = Role::where('name','copia_oculta_email')->pluck('id');
                
                //buscar el usuario del coordinador Interno de la alianza
                $coordinadorOrigen = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('alianza.id',$alianzaId )
                    ->where('model_has_roles.role_id',$roleCoordinador )
                    ->select('users.name', 'users.email')->first();
                //buscar el email del usuario asignado para recibir una copia oculta de los emails
                $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                    ->where('model_has_roles.role_id',$roleCopiaEmails )
                    ->select('users.name', 'users.email')->first();

                $tipo_mail = 'alianza';
                $datos['crearTipo'] = $crearTipo;
                $datos['estadoPaso'] = $estadoPaso;
                $datos['id'] = $mail_id;
                $datos['paso'] = $idPaso;
                $datos['to'][0] = $coordinadorDestino;
                $datos['cc'][0] = $coordinadorOrigen;
                $datos['bcc'][0] = $copia_oculta_email;
                
                $datos['subject'] = 'Institución '.ucwords(strtolower( $institucionOrigen->nombre )) .' - Solicitud de nueva alianza';

                //solicita los datos de la alianza
                $datosContent = $this->datosAlianza($alianzaId,'crearMail','nuevo');

                $dataUsers = $datosContent['dataUsers'];
                $keyCoordExterno = $datosContent['keyCoordExterno'];
                $keyCoordInterno = $datosContent['keyCoordInterno'];

                $msj_header_text = 'Respetado '.ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_nombres'] )).' le queremos informar que la institución '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['institucion']['nombre'] )) .' de '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['institucion']['ciudad']['pais_nombre'] )) .' '.' quiere realizar una alianza con su institución. <br><br> El coordinador '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['coordinador_nombres'] )) .' '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['coordinador_apellidos'] )) .' ha iniciado el proceso y ha diligenciado la información de las instituciones de origen y destino de la alianza la cual se presenta a continuación.';

                $datos['content'] = '[{"header":"'.$msj_header_text.'", "footer":"Necesitamos su aprobación para continuar con el proceso, puede revisar los datos de su institución y aceptar la propuesta de alianza en el sitio de InterActin."}]';
                $datos['archivosAdjuntos'] = '';
                if ( isset($input['enviar_documentos']) ) {
                    $datos['archivosAdjuntos'] = $input['enviar_documentos'];
                }

                

                //$crearMail = $this->crearMail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);
                $crearMail = $this->crearMail($tipo_mail,$datos);
                
                if ( $crearMail === 'error_mail' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }elseif ( $crearMail === 'error_paso' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el paso de la alianza.');
                    goto end;
                }elseif ( $crearMail === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }elseif( $crearMail != false ){
                    
                }


            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[3].'\' de la alianza.');
                goto end;
            }

            $paso = $request['paso'];

        }

        /// FIN PASO 2
        /// FIN PASO 2
        /// FIN PASO 2


        /// INICIO PASO 3
        /// INICIO PASO 3
        /// INICIO PASO 3

        if ( isset($request['paso']) && $request['paso'] == '3' ) {

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }
        //ENVIAR EL EMAIL DEL PASO 3
            $request['origen_peticion'] = 'local';

            $enviarmail = $this->mail( $request );
            if (isset($enviarmail['errors'])) {
                $errors += 1;
                $errorsMsg = array_merge($errorsMsg, $enviarmail['returnMsg']);
                goto end;
            }else{
                array_push($okMsg,$enviarmail);
            }
        //GUARDAR EL PASO 3
            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            $paso = $request['paso'];


        }

        /// FIN PASO 3
        /// FIN PASO 3
        /// FIN PASO 3


        /// INICIO PASO 4
        /// INICIO PASO 4
        /// INICIO PASO 4

        if ( isset($request['paso']) && $request['paso'] == '4' ) {

            $existeRepresentante = false;

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }

            if ($alianza->estado == 1 ) {
                $errors += 1;
                array_push($errorsMsg, 'La alianza esta inactiva');
                goto end;
            }
            
            $verificarToken = \App\Models\Alianza::where('token',$request['atoken'])->select('id','token')->first();

            if ( count($verificarToken) > 0 ) {

                //buscar el rol del coordinador y del representante
                $roleCoordinador = Role::where('name','coordinador_externo')->pluck('id');
                $roleRepresentante = Role::where('name','representante_legal')->pluck('id');

            //buscar el usuario del coordinador externo de la alianza
                $buscarUserExterno = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                            ->join('users', 'alianza_user.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                            ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                            ->where('alianza.id',$verificarToken->id )
                            ->where('model_has_roles.role_id',$roleCoordinador )
                            ->select('users.id','campus.institucion_id','campus.id AS campus_id');
                //echo $buscarUserExterno->toSql().'$verificarToken->id:'.$verificarToken->id.'$roleCoordinador:'.$roleCoordinador;
                $buscarUserExterno = $buscarUserExterno->first();

                $campusId = $buscarUserExterno->campus_id;

        // comprobar existencia del representante
            //validar si existe representante          
                $buscarRepresentante = \App\Models\Admin\Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')
                            ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                            ->join('users', 'user_campus.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->where('institucion.id',$buscarUserExterno->institucion_id )
                            ->where('model_has_roles.role_id',$roleRepresentante )
                            ->select('users.id');
                //echo $buscarRepresentante->toSql();
                $buscarRepresentante = $buscarRepresentante->first();
        // actualizar los datos de la institucion en caso de no existir el representante

                if ( $input['aceptar_alianza'] == 'SI' ) {
                    if (!isset($input['observacion_aceptar_alianza'])) {
                        $input['observacion_aceptar_alianza'] = '';
                    }
            
                    if ( !$this->crearPaso('4','ACEPTADO',$alianzaId,$input['observacion_aceptar_alianza']) ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar la aceptación del paso \''.$tipos_pasos[4].'\' de la alianza.');
                        goto end;
                    }

                    //-------------------------
                    //-------------------------
                    //-------------------------
                    
                    /*
                    //  SOLO ACTUALIXSR EL PASO 4 PARA MOSTRAR EL REGISTRO EN EL MODULO DE VALIDACION

                    //GUARDAR EL PASO 5

                    
                    if ( !$this->crearPaso('5','ACEPTADO',$alianzaId,$input['observacion_aceptar_alianza']) ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar la aceptación del paso \''.$tipos_pasos[5].'\' de la alianza.');
                        goto end;
                    }

                    //GUARDAR EL PASO 6
                    if ( !$this->crearPaso('6','ACEPTADO',$alianzaId,$input['observacion_aceptar_alianza']) ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar la aceptación del paso \''.$tipos_pasos[6].'\' de la alianza.');
                        goto end;
                    }
                    */
                    

                    //-------------------------
                    //-------------------------
                    //-------------------------

                    array_push($okMsg,'<input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$input['aceptar_alianza'].'">');
                }elseif ( $input['aceptar_alianza'] == 'NO' ) {
                    
                    $crearPaso = $this->crearPaso('4','DECLINADO',$alianzaId,$input['observacion_aceptar_alianza']);
                    if ( $crearPaso ){
                        $mailDatos = [];
                        $idPaso = $crearPaso->id;
                    //CREAR EL REGISTRO DEL MAIL
                        $coordinadores = DB::table('users')
                                ->join('alianza_user', 'users.id', '=', 'alianza_user.user_id')
                                ->join('alianza', 'alianza_user.alianza_id', '=', 'alianza.id')
                                ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                                ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                                ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                                ->where('alianza.id',$alianzaId )
                                ->select('users.name', 'users.email', 'institucion.nombre As institucion_nombre')->orderBy('alianza_user.id','asc');
                        //echo $coordinadores->toSql();
                        $coordinadores = $coordinadores->get();

                        $coordinadorOrigen = $coordinadores[0];
                        $coordinadorDestino = $coordinadores[ count($coordinadores) -1 ];

                        $tipo_mail = 'alianza';
                        $datos['paso'] = $idPaso;
                        $datos['to'][0] = $coordinadorOrigen;
                        $datos['cc'][0] = $coordinadorDestino;
                        $datos['bcc'][0]['email'] = \Config::get('mail.from.address');
                        $datos['bcc'][0]['name'] = \Config::get('mail.from.name');
                        $datos['subject'] = ucwords(strtolower( $coordinadorOrigen->institucion_nombre )) .' - Rechazo a la Solicitud de nueva alianza';

                        //solicita los datos de la alianza
                        $datosContent = $this->datosAlianza($alianzaId,'crearMail','nuevo');
                        
                        $dataUsers = $datosContent['dataUsers'];
                        $keyCoordExterno = $datosContent['keyCoordExterno'];
                        $keyCoordInterno = $datosContent['keyCoordInterno'];

                        $msj_header_text = 'Le informamos que el coordinador '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_nombres'] )) .' '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_apellidos'] )) .' de la institución '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['nombre'] )) .' de '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['ciudad']['pais_nombre'] )).' ha <strong>rechazado</strong> la propuesta de alianza.';

                        $datos['content'] = '[{"header":"'.$msj_header_text.'", "footer":"Hemos revizado los datos registrados y rechazamos la propuesta de alianza."}]';

                        $datos['archivosAdjuntos'] = '';
                    
                    //crear el registro del email
                        $crearMail = $this->crearMail($tipo_mail,$datos);
                        
                        if ( $crearMail === 'error_mail' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se puede crear el mail del paso \''.$tipos_pasos[4].'\' de la alianza.');
                            goto end;
                        }elseif ( $crearMail === 'error_paso' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se encontro el paso de la alianza.');
                            goto end;
                        }elseif( $crearMail != false ){
                            $mailDatos['id'] = $crearMail->id;
                            $mailDatos['tokenmail'] = $crearMail->tokenmail;
                        }

                    //enviar el email registrado
                        $request['origen_peticion'] = 'local';
                        $request['mailId'] = $mailDatos['id'];
                        $request['enviar'] = true;
                        $request['tokenmail'] = $mailDatos['tokenmail'];

                        $enviarmail = $this->mail( $request );
                        if (isset($enviarmail['errors'])) {
                            $errors += 1;
                            $errorsMsg = array_merge($errorsMsg, $enviarmail['returnMsg']);
                            goto end;
                        }else{
                            array_push($okMsg,$enviarmail);
                        }

                        //actualzar el estado a 1 (inactiva)
                        $alianza->estado = 1;
                        $alianza->save();
                        Auth::logout();

                        /*
                    //ENVIAR EL MAIL
                        $request['peticion'] = 'local';
                        $request['rol_destino'] = 'coordinador_externo';
                        $request['enviar'] = true;
                        $request['tokenmail'] = $crearMail->tokenmail;
                        
                        $enviarMail = $this->mail($request);
                        //print_r($enviarMail);
                        if ( $enviarMail === true ) {
                            array_push($okMsg,'La respuesta de la peticion de alianza ya fue notificada por e-mail al coordinador de origen. <br> <input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$input['aceptar_alianza'].'">');
                        }else{
                            //print_r($enviarMail);
                            $errors += 1;
                            $errorsMsg = array_merge($errorsMsg, $enviarMail);
                            array_push($errorsMsg, 'No se puede enviar el e-mail del rechazo de la alianza.');
                            goto end;
                            
                        }
                        */

                    }else{
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar la aceptación del paso \''.$tipos_pasos[4].'\' de la alianza.');
                        goto end;
                    }
            
                    //-------------------------
                    //-------------------------
                    //-------------------------
                    

                    //GUARDAR EL PASO 5
                    /*
                    //  SOLO ACTUALIXSR EL PASO 4 PARA MOSTRAR EL REGISTRO EN EL MODULO DE VALIDACION


                    if ( !$this->crearPaso('5','DECLINADO',$alianzaId,$input['observacion_aceptar_alianza']) ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[5].'\' para la alianza.');
                        goto end;
                    }

                    //GUARDAR EL PASO 6
                    if ( !$this->crearPaso('6','DECLINADO',$alianzaId,$input['observacion_aceptar_alianza']) ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[6].'\' para la alianza.');
                        goto end;
                    }
                    */
                    

                    //-------------------------
                    //-------------------------
                    //-------------------------


                    array_push($okMsg,'La respuesta de la peticion de alianza fue registrada correctamente. <br> <input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$input['aceptar_alianza'].'"> <input type="hidden" class="dato_adicional" name="tokenmail" id="tokenmail" value="'.$crearMail->tokenmail.'"> <input type="hidden" class="dato_adicional" name="noNext" id="noNext" value="1">');
                    $paso = 4;
                    goto end;
                } 

                if ( count($buscarRepresentante) > 0 ) {
                    $existeRepresentante = true;
                }else{
                
                    $dataInstitucion['institucion_id']= $buscarUserExterno->institucion_id;
                    $dataInstitucion['tipo_institucion_id']= $input['tipo_institucion_destino'];
                    $dataInstitucion['nombre']= $input['institucion'];
                    
                    $nombreCampus = \App\Models\Admin\City::select('nombre')->where('id',$input['ciudad_institucion_destino'])->get();
                        
                    $dataCampus['nombre'] = $nombreCampus[0]->nombre;
                    $dataCampus['telefono'] = $input['telefono_institucion_destino'];
                    $dataCampus['direccion'] = $input['direccion_institucion_destino'];
                    $dataCampus['codigo_postal'] = $input['codigo_postal_institucion_destino'];
                    $dataCampus['ciudad_id'] = $input['ciudad_institucion_destino'];

                    
                    $actualizarInstitucion = $this->crearInstitucion('actualizar',$dataInstitucion,$dataCampus,$alianza);

                    if ( $actualizarInstitucion === 'error_institucion' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se encuentra la institucion.');
                        goto end;
                    }elseif ( $actualizarInstitucion === 'error_campus' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se encuentra el campus de la institucion.');
                        goto end;
                    }elseif( $actualizarInstitucion != false ){
                        $campusId = $actualizarInstitucion['campusId'];
                    }

                }

        // comprobar los datos del coordinador actual
            // actualizar el coordinador si él eligio otro
                if ( $buscarUserExterno->id != $input['coordinador_destino'] ) {
                                        
                    //crear el usuario de tipo coordinador externo y obtener el id para asociarlo a la institucion
                    //[el nombre del email], email_coordinador_destino, [generar un password]

                    if ( $input['coordinador_destino'] == '999999' ) {
                        

                        $dataUser['name']= $input['nombre_coordinador_destino'];
                        $dataUser['email']= $input['email_coordinador_destino'];
                        $dataUser['activo']= 1;
                        // crear password
                        $passwordCoordinadorDestino = str_random(8);
                        //no sera encriptado hasta que se envie el email
                        //$dataUser['password']= bcrypt( $passwordCoordinadorDestino );
                        $dataUser['password']= $passwordCoordinadorDestino;
                      //datos personales del usuario
                        $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                        $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
                        $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                        $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];

                        $crearUsuario = $this->crearUsuario('nuevo',$dataUser,'coordinador_externo',$campusId,$dataDatosPersonalesDestino,$alianza);
                        // Create the user
                        if ( $crearUsuario === 'error_usuario' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se puede crear el coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario === 'error_datos_personales' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se pueden crear los datos personales del coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario === 'error_asociar' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se puede asociar el coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario != false ){
                            $coordinadorDestinoId = $crearUsuario->id;
                        }

                    } else {

                        $coordinadorDestino = $this->asociarUsuario('cambio_coordinador',$input['coordinador_destino'],'coordinador_externo',$campusId,$alianza,$buscarUserExterno->id);
                
                        if ( $coordinadorDestino === 'error_usuario' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se encontro el coordinador del destino.');
                            goto end;
                        }elseif( $coordinadorDestino != false ){
                            $coordinadorDestinoId = $coordinadorDestino->id;
                        }
                    }

                //quitar la asociacion del coordinador anterior con la alianza
                    $alianza->user()->detach($buscarUserExterno->id);

                // si cambia el coordinador enviar un nuevo mensaje de correo al nuevo coordinador
                    //validar en el paso 6
                    //se valida por el campo activo de la tabla users


            
                }else{
            // actualizar los datos del coordinador solo si es él mismo
                // si cambia el email verificar que no este en el sistema
                    
                    $this->validate($request, [
                        'email_coordinador_destino' => 'required|email|unique:users,email,'.$buscarUserExterno->id
                    ]);


                    $dataUser['id']= $buscarUserExterno->id;
                    $dataUser['name']= $input['nombre_coordinador_destino'];
                    $dataUser['email']= $input['email_coordinador_destino'];
                    $dataUser['activo']= 0;
                  //datos personales del usuario
                    
                    $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                    if ($existeRepresentante != true) {
                        $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
                    }
                    $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                    $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];

                    $crearUsuario = $this->crearUsuario('actualizar',$dataUser,'coordinador_externo',$campusId,$dataDatosPersonalesDestino,$alianza);
                    // Create the user
                    if ( $crearUsuario === 'error_usuario' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear el coordinador externo.');
                        goto end;
                    }elseif( $crearUsuario === 'error_datos_personales' ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se pueden crear los datos personales del coordinador externo.');
                        goto end;
                    }elseif( $crearUsuario === 'error_asociar' ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede asociar el coordinador externo.');
                        goto end;
                    }elseif( $crearUsuario != false ){
                        $coordinadorDestinoId = $crearUsuario->id;
                    }

                }

            }else{

                $errors += 1;
                array_push($errorsMsg, 'El token no es valido, regargue la pagina.');
                goto end;
            }
        //GUARDAR EL PASO 4

            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            $paso = $request['paso'];


        }

        /// FIN PASO 4
        /// FIN PASO 4
        /// FIN PASO 4


        /// INICIO PASO 5
        /// INICIO PASO 5
        /// INICIO PASO 5

        if ( isset($request['paso']) && $request['paso'] == '5' ) {

            $archivoAdjunto = 0;
            $existeRepresentante = false;

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }
            if ($alianza->estado == 1 ) {
                $errors += 1;
                array_push($errorsMsg, 'La alianza esta inactiva');
                goto end;
            }

            $verificarToken = \App\Models\Alianza::where('token',$request['atoken'])->select('id','token')->first();

            if ( count($verificarToken) > 0 ) {

                //buscar el rol del coordinador y del representante
                $roleCoordinador = Role::where('name','coordinador_externo')->pluck('id');
                $roleRepresentante = Role::where('name','representante_legal')->pluck('id');

            //buscar el usuario del coordinador externo de la alianza
                $buscarUserExterno = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                            ->join('users', 'alianza_user.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                            ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                            ->where('alianza.id',$verificarToken->id )
                            ->where('model_has_roles.role_id',$roleCoordinador )
                            ->select('users.id','campus.institucion_id','campus.id AS campus_id');
                //echo $buscarUserExterno->toSql();
                $buscarUserExterno = $buscarUserExterno->first();
                //print_r($buscarUserExterno);

        // comprobar existencia del representante
            //validar si existe representante          
                $buscarRepresentante = \App\Models\Admin\Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')
                            ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                            ->join('users', 'user_campus.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->where('institucion.id',$buscarUserExterno->institucion_id )
                            ->where('model_has_roles.role_id',$roleRepresentante )
                            ->select('users.id');
                //echo $buscarRepresentante->toSql();
                $buscarRepresentante = $buscarRepresentante->first();
        /*
            //verificar Validacion
                $datos['tipo'] = 'aceptado';
                $datos['campusAppId'] = $campusAppId;
                $datos['paso'] = 4;
                $datos['alianzaId'] = $alianzaId;
                $verificarValidacion = $this->verificarValidacion($datos);
                if ( $verificarValidacion['retorno'] == false ) {
                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    goto end;
                }elseif( $verificarValidacion['retorno'] === 'no_validaron' ){
                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    array_push($errorsMsg, '<input type="hidden" class="dato_adicional" name="noNext" value="1">');
                    goto end;
                }elseif( $verificarValidacion['retorno'] === 'DECLINADO' ){
                    //actualzar el estado a 1 (inactiva)
                    $alianza->estado = 1;
                    $alianza->save();
                    Auth::logout();

                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    array_push($errorsMsg, '<input type="hidden" class="dato_adicional" name="noNext" value="1">');
                    goto end;
                }
        */
                

        // actualizar los datos de la institucion en caso de no existir el representante

                if ( count($buscarRepresentante) > 0 ) {
                    $existeRepresentante = true;
                }else{
                    
                //datos del usuario
                    $dataUser['name']= $input['repre_nombre'];
                    $dataUser['email']= $input['repre_email'];
                    $dataUser['activo']= 1;
                    // crear password
                    $passwordCoordinadorOrigen = str_random(8);
                    //no sera encriptado hasta que se envie el email
                    //$dataUser['password']= bcrypt( $passwordCoordinadorOrigen );
                    $dataUser['password']= $passwordCoordinadorOrigen;
                //datos personales del usuario
                    $dataDatosPersonalesRepre['nombres']= $input['repre_nombre'];
                    $dataDatosPersonalesRepre['nacionalidad_id']= $input['repre_pais_nacimiento']; 
                    $dataDatosPersonalesRepre['telefono']= $input['repre_telefono'];
                    $dataDatosPersonalesRepre['tipo_documento_id']= $input['repre_tipo_documento'];
                    $dataDatosPersonalesRepre['numero_documento']= $input['repre_numero_documento'];
                    $dataDatosPersonalesRepre['fecha_expedicion']= $input['repre_fecha_exped_documento'];
                    $dataDatosPersonalesRepre['lugar_expedicion_id']= $input['repre_ciudad_exped_documento'];
                    $dataDatosPersonalesRepre['cargo']= $input['repre_cargo'];
                    
                    $crearUsuario = $this->crearUsuario('nuevo',$dataUser,'representante_legal',$buscarUserExterno->campus_id,$dataDatosPersonalesRepre,'');
                    // Create the user
                    if ( $crearUsuario === 'error_usuario' ) {

                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear el representante.');
                        goto end;
                    }elseif( $crearUsuario === 'error_datos_personales' ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se pueden crear los datos personales del representante.');
                        goto end;
                    }elseif( $crearUsuario != false ){
                        $coordinadorDestinoId = $crearUsuario->id;
                    }
                        

            //cargar el archivo de soporte
                    if ( $request->file('archivo_documentos') ) {
                        $nombre = $request->file('archivo_documentos')->getClientOriginalName();
                        $formatoArchivo = $request->file('archivo_documentos')->getClientOriginalExtension();
                        $MimeType = $request->file('archivo_documentos')->getClientMimeType();
                        $path = 'alianza/'.$alianzaId.'/destination/'.hash("md2",(string)microtime()) . '.' . $nombre;
                        \Storage::disk('public')->put($path, \File::get($request->file('archivo_documentos')));
                        /*
                        echo '$nombre:'.$nombre.' <br>';
                        echo '$formato:'.$formatoArchivo.' <br>';
                        echo '$MimeType:'.$MimeType.' <br>';
                        echo '$path:'.$path.' <br>';
                        */
                        
            // guardar el archivo
                    //nombre, path, user_id, formato_id, tipo_archivo_id, permisos_archivo
                    //formato_id=[application/pdf | IMAGEN]
                    //tipo_archivo_id =SOPORTE REPRESENTANTE
                        $formato = \App\Models\Formato::where('nombre',$formatoArchivo)->select('id')->first();
                        if ($formato == '') {
                            $dataFormato['nombre'] = $formatoArchivo;
                            $formato = \App\Models\Formato::create($dataFormato);

                        }
                        $formato_id = $formato->id;

                        $tipo_archivo_id = \App\Models\TipoArchivo::where('nombre','SOPORTE REPRESENTANTE')->select('id')->first();
                    //permisos_archivo={owner:rwx,group:rw-,other:r--}
                        $dataArchivo['nombre'] = $nombre;
                        $dataArchivo['path'] = $path;
                        $dataArchivo['user_id'] = $userId;
                        $dataArchivo['formato_id'] = $formato_id;
                        $dataArchivo['tipo_archivo_id'] = $tipo_archivo_id->id;
                        $dataArchivo['permisos_archivo'] = '{owner:rwx,group:rw-,other:r--}';
                        if ($archivo = \App\Models\Archivo::create($dataArchivo) ){
                            $archivoAdjunto = $archivo->id;
            // asociar el archivo con la institucion
                            $institucion = $this->institucion::find($buscarUserExterno->institucion_id);
                            if ( count($institucion) > 0 ) {

                                $tipo_documento_id = \App\Models\TipoDocumento::where('nombre',['REPRESENTACIÓN LEGAL'])->pluck('id')->first();

                                $dataDocumentosInstitucion['institucion_id'] = $institucion->id;
                                $dataDocumentosInstitucion['archivo_id'] = $archivo->id;
                                $dataDocumentosInstitucion['tipo_documento_id'] = $tipo_documento_id;
                                

                                if ($documentosInstitucion = \App\Models\DocumentosInstitucion::create($dataDocumentosInstitucion) ){

                                }else{
                                    $errors += 1;
                                    array_push($errorsMsg, 'No se pudo asociar el archivo del soporte del representante a la institucion.');
                                    goto end;

                                }

                            }else{
                                $errors += 1;
                                array_push($errorsMsg, 'No se encontro la institucion para asociar el archivo del soporte del representante.');
                                goto end;

                            }
                        }else{
                            $errors += 1;
                            array_push($errorsMsg, 'No se pudo cargar el archivo del soporte del representante.');
                            goto end;
                                
                        }
                        
                    }else{
                        $errors += 1;
                        array_push($errorsMsg, 'No se recibio el archivo del soporte del representante.');
                        goto end;
                                
                    }


                }

            }else{

                $errors += 1;
                array_push($errorsMsg, 'El token no es valido, regargue la pagina.');
                goto end;
            }
        //GUARDAR EL PASO 5

            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }


            if ( $input['aceptar_alianza'] == 'SI' ) {

        //GUARDAR EL PASO 6

                $crearPaso = $this->crearPaso('6','INCOMPLETO',$alianzaId);
                if ( $crearPaso ){
                    $idPaso = $crearPaso->id;
        //CREAR EL REGISTRO DEL MAIL
                    $coordinadores = DB::table('users')
                            ->join('alianza_user', 'users.id', '=', 'alianza_user.user_id')
                            ->join('alianza', 'alianza_user.alianza_id', '=', 'alianza.id')
                            ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                            ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                            ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                            ->where('alianza.id',$alianzaId )
                            ->select('users.name', 'users.email', 'institucion.nombre As institucion_nombre')->orderBy('alianza_user.id','asc');
                    //echo $coordinadores->toSql();
                    $coordinadores = $coordinadores->get();

                    $coordinadorOrigen = $coordinadores[0];
                    $coordinadorDestino = $coordinadores[ count($coordinadores) -1 ];

                    
                    $tipo_mail = 'alianza';
                    $datos['crearTipo'] = 'nuevo';
                    $datos['paso'] = $idPaso;
                    $datos['to'][0] = $coordinadorOrigen;
                    $datos['cc'][0] = $coordinadorDestino;
                    $datos['bcc'][0]['email'] = \Config::get('mail.from.address');
                    $datos['bcc'][0]['name'] = \Config::get('mail.from.name');
                    $datos['subject'] = ucwords(strtolower( $coordinadorOrigen->institucion_nombre )) .' - Solicitud de nueva alianza';

                    //solicita los datos de la alianza
                    $datosContent = $this->datosAlianza($alianzaId,'crearMail','nuevo');
                    
                    $dataUsers = $datosContent['dataUsers'];
                    $keyCoordExterno = $datosContent['keyCoordExterno'];
                    $keyCoordInterno = $datosContent['keyCoordInterno'];

                    $msj_header_text = 'Le informamos que el coordinador '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_nombres'] )) .' '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_apellidos'] )) .' de la institución '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['nombre'] )) .' de '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['ciudad']['pais_nombre'] )).' ha <strong>aceptado</strong> la propuesta de alianza!';

                    $datos['content'] = '[{"header":"'.$msj_header_text.'", "footer":"Hemos revizado los datos registrados y aceptamos la propuesta de alianza."}]';

                    $datos['archivosAdjuntos'] = '';
                    if ($archivoAdjunto != 0) {
                        $datos['archivosAdjuntos'] = $archivoAdjunto;
                    }

                    

                    $crearMail = $this->crearMail($tipo_mail,$datos);
                    
                    if ( $crearMail === 'error_mail' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear el mail del paso \''.$tipos_pasos[6].'\' de la alianza.');
                        goto end;
                    }elseif ( $crearMail === 'error_paso' ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se encontro el paso de la alianza.');
                        goto end;
                    }elseif( $crearMail != false ){
                        //$userId = $crearMail->id;
                    }



                }else{
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[6].'\' de la alianza.');
                    goto end;
                }

                $paso = $request['paso'];
                    
                
            }


        }
            
        /// FIN PASO 5
        /// FIN PASO 5
        /// FIN PASO 5

                



        /// INICIO PASO 6
        /// INICIO PASO 6
        /// INICIO PASO 6

        if ( isset($request['paso']) && $request['paso'] == '6' ) {

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }


        //ENVIAR EL EMAIL DEL PASO 6
            $request['origen_peticion'] = 'local';

            $enviarmail = $this->mail( $request );
            if (isset($enviarmail['errors'])) {
                $errors += 1;
                $errorsMsg = array_merge($errorsMsg, $enviarmail['returnMsg']);
                goto end;
            }else{
                array_push($okMsg,$enviarmail);
            }
        //GUARDAR EL PASO 6

            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }
            /*
            //MOSTRAR EL MENSAJE CON LA LISTA DE VALIDADORES
            if ( isset($request['paso']) && $alianzaId != 0 ) {
                $datos['tipo'] = 'actual';
                $datos['campusAppId'] = $campusAppId;
                $datos['paso'] = $request['paso'];
                $datos['alianzaId'] = $alianzaId;
                $verificarValidacion = $this->verificarValidacion($datos);
                if ( $verificarValidacion['retorno'] == false ) {
                    $errors += 1;
                    array_push($errorsMsg, $verificarValidacion['msg']);
                    goto end;
                }elseif( $verificarValidacion['retorno'] == 'lista_validadores' ){
                    array_push($okMsg, $verificarValidacion['msg']);
                    array_push($okMsg, '<input type="hidden" class="dato_adicional" name="noNext" value="1">');
                }elseif( $verificarValidacion['retorno'] == 'sin_validadores' ){
                    
                }
            }
            */

            //validar si existe validador para el paso registrado para crear y enviar el e-mail al validador o validadores
            if ( isset($request['paso']) ) {
                //notificar a el validador en caso que este asociado al paso 
                $datos['paso'] = $request['paso'];
                $datos['accion'] = 'creacion';
                //$datos['tipo_paso_id'] = $tipo_paso_id;
                $datos['alianzaId'] = $alianzaId;
                $datos['user_name'] = $this->user->name;
                $datos['user_email'] = $this->user->email;
                $notificarValidador = $this->notificarValidador('alianza', $datos);
                if (isset($notificarValidador['errors'])) {
                    $errors += 1;
                    $errorsMsg = array_merge($errorsMsg, $notificarValidador['returnMsg']);
                    goto end;
                }elseif( $notificarValidador === true ){
                    //continua normalmente
                }elseif( $notificarValidador != false ){
                    array_push($okMsg,$notificarValidador);
                }
            }

            array_push($okMsg, 'El proceso fue completado correctamente, sera notifiado cuando haya una respuesta.');
            $paso = $request['paso'];


        }

        /// FIN PASO 6
        /// FIN PASO 6
        /// FIN PASO 6

        /*
        // POR AHORA NO HABRÁ VALIDACION POR CADA PASO, AL TERMINAR TODO EL REGISTRO SE HARA LA VALIDACION
        if ( isset($request['paso']) && $alianzaId != 0 ) {
            $datos['tipo'] = 'actual';
            $datos['campusAppId'] = $campusAppId;
            $datos['paso'] = $request['paso'];
            $datos['alianzaId'] = $alianzaId;
            $verificarValidacion = $this->verificarValidacion($datos);
            if ( $verificarValidacion['retorno'] == false ) {
                $errors += 1;
                array_push($errorsMsg, $verificarValidacion['msg']);
                goto end;
            }elseif( $verificarValidacion['retorno'] == 'lista_validadores' ){
                array_push($okMsg, $verificarValidacion['msg']);
                array_push($okMsg, '<input type="hidden" class="dato_adicional" name="noNext" value="1">');
            }elseif( $verificarValidacion['retorno'] == 'sin_validadores' ){
                
            }
        }
        */

        end:

        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ($this->peticion != 'ajax') {
                flash()->error($errorsMsg);
            }else{
                return Response::json($errorsMsg, 422);
            }
        }elseif ($paso == 0 ) {
            return Response::json(['No se recibieron datos'], 422);
        }else{
            DB::commit();
            $msg = 'Se registraron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente!';
            if ( isset($request['modificar']) ) {
                $msg = 'Se actualizaron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente!';
            }

            if ($this->peticion != 'ajax') {
                flash($msg);
            }else{
                array_push($okMsg,$msg.' <br> <input type="hidden" class="dato_adicional" name="alianzaId" value="'.$alianzaId.'"> <input type="hidden" name="modificar" value="1">');
                return Response::json($okMsg);
            }
            //echo 'correcto <br>';
        }


        
        /*
        $alianza = $this->alianzaRepository->create($input);

        Flash::success('Alianza saved successfully.');

        return redirect(route('interalliances.index'));
        */
    }
    /**
     * Store a newly created Alianza in storage.
     *
     * @param CreateAlianzaRequest $request
     *
     * @return Response
     */
    //public function store(CreateAlianzaRequest $request)
    public function store(CreateAlianzaRequest $request)
    {
        return $this->storeUpdate($request, 'store', '');
    }

    /**
     * Display the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function mail(Request $request)
    {

        //print_r($request->all());
        $tipo_paso = '';
        $coordinador = '';
        $archivosAdjuntos = '';
        $alianzaId = '';
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];

        if (isset($request['alianzaId'])) {
            $alianzaId = $request['alianzaId'];
        }elseif( session('alianzaId') != null ){
            $alianzaId = session('alianzaId');
        }else{
            
            //return '<hr> El e-mail no se encuentra, No existe la alianza.';
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra la alianza.');
            goto end;
        }


        if ( isset($request['paso']) ) {

            $tipo_paso = $this->tipoPaso->where('nombre', 'paso'.$request['paso'].'_alianza')->pluck('id');

            $roleCoordinadorExterno = Role::where('name','coordinador_externo')->pluck('id');
            $roleCoordinadorInterno = Role::where('name','coordinador_interno')->pluck('id');

            if ( isset($request['aceptar_alianza']) ) {
                $roleCoordinador = $roleCoordinadorExterno;
            }else{
                $roleCoordinador = $roleCoordinadorInterno;
            }
            
            //validar si la alianza fue declinada
            if ( isset($request['aceptar_alianza']) && $request['aceptar_alianza'] == 'SI' ) {
                    
            }elseif ( isset($request['aceptar_alianza']) && $request['aceptar_alianza'] == 'NO' ) {
                
                array_push($okMsg,'Usted ha rechazado la alianza. <br> <input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$request['aceptar_alianza'].'">');
                $paso = $request['paso'];
            } 
            //muestra los datos de los e-mails registrados y los ordena desde el ultimo registrado hacia atras
            $dataMail = DB::table('pasos_alianza')
                    ->join('pasos_alianza_mail', 'pasos_alianza.id', '=', 'pasos_alianza_mail.pasos_alianza_id')
                    ->join('mail', 'pasos_alianza_mail.mail_id', '=', 'mail.id')
                    ->join('estado', 'pasos_alianza.estado_id', '=', 'estado.id')
                    ->where('pasos_alianza.alianza_id',$alianzaId )
                    ->where('pasos_alianza.tipo_paso_id',$tipo_paso )
                    ->select('mail.*','pasos_alianza.id AS pasos_alianza_id','pasos_alianza.observacion AS paso_observacion','estado.nombre AS estado_nombre')
                    ->orderBy('mail.created_at','desc');
            //echo $dataMail->toSql().' |$alianzaId:'.$alianzaId.' |$tipo_paso:'.$tipo_paso.' |$roleCoordinador:'.$roleCoordinador;
            $dataMail = $dataMail->get();


            if ( count($dataMail) > 0 ) {
                /*
                if ($dataMail[0]->estado == '1') {
                    $errors += 1;
                    array_push($errorsMsg, 'El e-mail ya fue enviado.');
                    goto end;
                }
                */

                if ( isset($request['ver']) && !isset($request['enviar']) && !isset($request['tokenmail']) ) {
                    $msj_header_text = '';
                    $viewWith = '';
                    $vista = 'emails.alliances.show';

                    

                    if( isset($request['aceptar_alianza']) && $request['aceptar_alianza'] == 'NO' ){
                        $vista = 'emails.alliances.show_declined';

                        $viewWith = $this->datosAlianza($alianzaId,'mail','declinado',$tipo_paso);

                        $viewWith = array_merge($viewWith, ['dataMail' => $dataMail]);

                    }else{

                        $viewWith = $this->datosAlianza($alianzaId,'mail','ver',$tipo_paso);

                        $viewWith = array_merge($viewWith, ['dataMail' => $dataMail]);
                        
                    }


                    //return view('emails.alianzas.response');
                    return view($vista)->with($viewWith);

                }elseif ( isset($request['enviar']) && isset($request['tokenmail']) && isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {

                    $tipo_mail = 'alianza';
                    $request['tipo_paso_id'] = $tipo_paso;
                    $request['dataMail'] = $dataMail;

                    $datosAlianza = $this->datosAlianza($alianzaId,'mail','ver',$tipo_paso);
                    $datosAlianzaKeys = array_keys($datosAlianza);
                    //print_r($datosAlianza['dataAlianza']);
                    foreach ($datosAlianzaKeys as $key) {
                        //echo '$key:'.$key.' <br>';
                        $request[$key] = $datosAlianza[$key];
                    }

                    $enviarMail = $this->enviarMail($tipo_mail, $request);
                    return $enviarMail;

                }
                
            }else{
                $errors += 1;
                array_push($errorsMsg, 'El paso no tiene asociado algún e-mail.');
                goto end;
            }



        }else{

            $errors += 1;
            array_push($errorsMsg, 'No esta seleccionado ningún paso.');
            goto end;
        }

        //retorno de los errores
        end:

        if ($errors > 0) {
            //echo 'error <br>';

            if ( isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion != 'ajax') {
                flash()->error($errorsMsg);
            }else{
                return Response::json($errorsMsg, 422);
            }
        }

        
    }

    /**
     * Display the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id, $peticion = '')
    {
        
        $alianza = $this->alianzaRepository->findWithoutFail($id);

        if (empty($alianza)) {
            $alianza = \App\Models\Alianza::where('token',$id)->first();
        }

        $alianzaId = 0;
        $dataAlianza = '';
        $dataUsers = 0;
        $pasoAlianza = '';
        $archivosAdjuntos = '';
        $CoordinadorInterno = 0;
        $CoordinadorExterno = 0;
        $viewWith = [];

        if (empty($alianza)) {
            Flash::error('Alianza no encontrada');

            return redirect(route('interalliances.index'));
        }else{
            $alianzaId = $alianza->id;

            if ($peticion != '') {
                $this->peticion = $peticion;
            }

            $paso_titulo = $this->tipoPaso->where('nombre','like','%_alianza')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');

            $tipo_paso = $this->tipoPaso->where('nombre', 'paso3_alianza')->pluck('id');

            //solicita los datos de la alianza
            $viewWith = $this->datosAlianza($alianzaId,'show','ver',$tipo_paso);

            $view = 'InterAlliance.show';
            

            //print_r($viewWith);
            if ( $this->peticion == 'local' ) {
                return $viewWith;
            }else{
                $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp]);
                return view($view)->with($viewWith);
            }
                
        }
    }

    /**
     * Show the form for editing the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function datosAlianza($alianzaId, $destino, $filtro, $tipo_paso = 0)
    {
        
        $roleCoordinadorInterno = Role::where('name','coordinador_interno')->pluck('id')->first();
        $roleCoordinadorExterno = Role::where('name','coordinador_externo')->pluck('id')->first();
        $roleRepresentante = Role::where('name','representante_legal')->pluck('id')->first();

            $dataUsers = DB::table('alianza')
                    ->join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->leftJoin('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                    ->where('alianza.id',$alianzaId )
                    ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno,$roleCoordinadorExterno] )
                    ->select('users.id AS usuario_id','users.activo AS usuario_activo','users.name AS usuario_name','alianza.token AS token_alianza','model_has_roles.role_id','datos_personales.nombres AS coordinador_nombres','datos_personales.apellidos AS coordinador_apellidos','datos_personales.cargo AS coordinador_cargo','datos_personales.telefono AS coordinador_telefono','users.email AS coordinador_email')
                    ->orderBy('users.id','asc')
                    ->get()->toArray();

            foreach ($dataUsers as $data => $user) {
                if ($user->role_id == $roleCoordinadorInterno) {
                    $CoordinadorInterno = $user->usuario_id;
                }elseif ($user->role_id == $roleCoordinadorExterno) {
                    $CoordinadorExterno = $user->usuario_id;
                }
            }

            $institucionUsuarios = DB::table('user_campus')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                    ->join('tipo_institucion', 'institucion.tipo_institucion_id', '=', 'tipo_institucion.id')
                    ->whereIn('user_campus.user_id',[$CoordinadorInterno,$CoordinadorExterno])
                    ->select('user_campus.user_id AS usuario_id','institucion.*','tipo_institucion.nombre AS tipo_institucion_nombre','campus.direccion AS campus_direccion','campus.telefono AS campus_telefono','campus.codigo_postal AS campus_codigo_postal' )
                    ->groupBy('institucion.id')
                    ->orderBy('user_campus.id','asc')
                    ->get()->toArray();

            $ciudadesInstituciones = DB::table('campus')
                    ->join('ciudad', 'campus.ciudad_id', '=', 'ciudad.id')
                    ->join('departamento', 'ciudad.departamento_id', '=', 'departamento.id')
                    ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                    ->whereIn('campus.institucion_id',array_column($institucionUsuarios, 'id'))
                    ->groupBy('campus.institucion_id')
                    ->select('campus.institucion_id','pais.id AS pais_id','pais.nombre AS pais_nombre','departamento.id AS departamento_id','departamento.nombre AS departamento_nombre','ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre')->get()->toArray();

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' || $destino == 'destination' ) {
            //validar si existe representante          
            $buscarRepresentante = DB::table('campus')
                        ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                        ->join('users', 'user_campus.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id');

            if ($destino == 'mail' || $destino == 'show' || $destino == 'destination' ) {
                $buscarRepresentante = $buscarRepresentante->leftJoin('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                        ->leftJoin('pais', 'datos_personales.nacionalidad_id', '=', 'pais.id')
                        ->leftJoin('tipo_documento', 'datos_personales.tipo_documento_id', '=', 'tipo_documento.id');

            }

            $buscarRepresentante = $buscarRepresentante->whereIn('campus.institucion_id',array_column($institucionUsuarios, 'id') )
                        ->where('model_has_roles.role_id',$roleRepresentante )
                        ->groupBy('users.id');

            if ($destino == 'edit' ) {                
                $buscarRepresentante = $buscarRepresentante->select('campus.institucion_id','users.id AS usuario_id','users.activo AS usuario_activo');
            }else{
                $buscarRepresentante = $buscarRepresentante->select('campus.institucion_id','users.id AS usuario_id','users.activo AS usuario_activo','users.name AS repre_nombre','users.email AS repre_email','pais.id AS pais_id','pais.nombre AS pais_nombre','tipo_documento.id AS tipo_documento_id','tipo_documento.nombre AS tipo_documento_nombre','datos_personales.*');
            }

            //echo $buscarRepresentante->toSql().'array_column(institucionUsuarios, id):'.implode(',', array_column($institucionUsuarios, 'id')).'roleRepresentante:'.$roleRepresentante;
            $buscarRepresentante = $buscarRepresentante->get()->toArray();

            if ($destino == 'mail' || $destino == 'show' || $destino == 'destination' ) {
            
                $ciudadesRepresentante = DB::table('ciudad')->join('departamento', 'ciudad.departamento_id', '=', 'departamento.id')
                        ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                        ->whereIn('ciudad.id',array_column($buscarRepresentante, 'lugar_expedicion_id') )
                        ->select('pais.id AS pais_id','pais.nombre AS pais_nombre','departamento.id AS departamento_id','departamento.nombre AS departamento_nombre','ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre')->get()->toArray();
                //asociar los datos de la nacionalidad y el lugar de expedicion del documento al representante legal
                foreach ($buscarRepresentante as $data => $representante) {
                    foreach ($ciudadesRepresentante as $data => $ciudad) {
                        if ($representante->lugar_expedicion_id == $ciudad->ciudad_id) {
                            $representante->lugar_expedicion = $ciudad;
                        }
                    }
                }
            }
            //asociar los datos del representante legal a la institucion
            foreach ($institucionUsuarios as $data => $institucion) {
                foreach ($buscarRepresentante as $data => $representante) {
                    if ($institucion->id == $representante->institucion_id) {
                        $institucion->representante = $representante;
                    }
                }
            }
        }
                

            //asociar los datos de la ciudad a la institucion
            foreach ($institucionUsuarios as $data => $institucion) {
                foreach ($ciudadesInstituciones as $data => $ciudad) {
                    if ($institucion->id == $ciudad->institucion_id) {
                        $institucion->ciudad = $ciudad;
                    }
                }
            }
            //asociar los datos de la institucion al usuario
            foreach ($dataUsers as $data => $user) {
                foreach ($institucionUsuarios as $data => $institucion) {
                    if ($user->usuario_id == $institucion->usuario_id) {
                        $user->institucion = $institucion;
                    }
                }
            }


        $dataUsers = json_decode(json_encode($dataUsers),true);
        //print_r($dataUsers);
        

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' || $destino == 'destination' ) {

            $dataFacultades = DB::table('alianza')
                    ->join('alianza_facultad', 'alianza.id', '=', 'alianza_facultad.alianza_id')
                    ->join('facultad', 'alianza_facultad.facultad_id', '=', 'facultad.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('facultad.id AS facultad_id','facultad.nombre AS facultad_nombre' )
                    ->get()
                    ->toArray();
            $dataFacultades = json_decode(json_encode($dataFacultades),true);

            $dataProgramas = DB::table('alianza')
                    ->leftJoin('alianza_programa', 'alianza.id', '=', 'alianza_programa.alianza_id')
                    ->leftJoin('programa', 'alianza_programa.programa_id', '=', 'programa.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('programa.id AS programa_id','programa.nombre AS programa_nombre' )
                    ->get()
                    ->toArray();
            $dataProgramas = json_decode(json_encode($dataProgramas),true);

            $dataModalidades = DB::table('alianza')
                    ->join('alianza_modalidad', 'alianza.id', '=', 'alianza_modalidad.alianza_id')
                    ->join('modalidad', 'alianza_modalidad.modalidad_id', '=', 'modalidad.id')
                    ->join('tipo_alianza', 'modalidad.tipo_alianza_id', '=', 'tipo_alianza.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('tipo_alianza.id AS tipo_alianza_id','tipo_alianza.nombre AS tipo_alianza_nombre','modalidad.id AS modalidad_id','modalidad.nombre AS modalidad_nombre' )
                    ->get()
                    ->toArray();
            $dataModalidades = json_decode(json_encode($dataModalidades),true);
            



            $dataAlianza = DB::table('alianza')
                    ->join('tipo_tramite', 'alianza.tipo_tramite_id', '=', 'tipo_tramite.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('alianza.*','tipo_tramite.nombre AS tipo_tramite_nombre' )
                    ->first();
            $dataAlianza = json_decode(json_encode($dataAlianza),true);


            //echo $dataAlianza->toSql();
            $dataAlianza['facultades'] = $dataFacultades;
            $dataAlianza['programas'] = $dataProgramas;
            $dataAlianza['modalidades'] = $dataModalidades;
   
            $dataMail = DB::table('pasos_alianza')
                    ->join('pasos_alianza_mail', 'pasos_alianza.id', '=', 'pasos_alianza_mail.pasos_alianza_id')
                    ->join('mail', 'pasos_alianza_mail.mail_id', '=', 'mail.id')
                    ->where('pasos_alianza.alianza_id',$alianzaId )
                    ->where('pasos_alianza.tipo_paso_id',$tipo_paso )
                    ->select('pasos_alianza.id AS pasos_alianza_id','mail.id')
                    ->orderBy('mail.created_at','desc')
                    ->get();
            
            $archivosAdjuntos = '';
            if (count($dataMail)) {
                $archivosAdjuntos = DB::table('pasos_alianza')
                        ->join('pasos_alianza_mail', 'pasos_alianza.id', '=', 'pasos_alianza_mail.pasos_alianza_id')
                        ->join('mail', 'pasos_alianza_mail.mail_id', '=', 'mail.id')
                        ->join('mail_archivo', 'mail.id', '=', 'mail_archivo.mail_id')
                        ->join('archivo', 'mail_archivo.archivo_id', '=', 'archivo.id')
                        ->join('formato', 'archivo.formato_id', '=', 'formato.id')
                        ->where('pasos_alianza.id',$dataMail[0]->pasos_alianza_id) 
                        ->where('mail.id',$dataMail[0]->id) 
                        ->where('pasos_alianza.alianza_id',$alianzaId) 
                        ->orderBy('mail.id','desc')
                        ->select('archivo.*','formato.nombre AS formato_nombre');
                //echo $archivosAdjuntos->toSql().' |$dataMail[0]->pasos_alianza_id:'.$dataMail[0]->pasos_alianza_id.' |$dataMail[0]->id:'.$dataMail[0]->id.' |$alianzaId:'.$alianzaId;
                $archivosAdjuntos = $archivosAdjuntos->get()->toArray();
            }
            
        }
        
        $keyCoordExterno = array_search($CoordinadorExterno, array_column($dataUsers, 'usuario_id'));
        $keyCoordInterno = array_search($CoordinadorInterno, array_column($dataUsers, 'usuario_id'));
                
                
        $viewWith = ['alianzaId' => $alianzaId, 'dataUsers' => $dataUsers, 'CoordinadorInterno' => $CoordinadorInterno, 'CoordinadorExterno' => $CoordinadorExterno, 'keyCoordExterno' => $keyCoordExterno, 'keyCoordInterno' => $keyCoordInterno,'peticion' => $this->peticion];

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' || $destino == 'destination' ) {
            if ( $filtro == 'declinado' ) {
                return $viewWith;
            }elseif ( $filtro == 'ver' ) {

                $viewWith = array_merge($viewWith, ['paso_titulo' => $this->paso_titulo, 'dataAlianza' => $dataAlianza, 'archivosAdjuntos' => $archivosAdjuntos]);
                
                return $viewWith;
            }
        }
        if ($destino == 'crearMail' && $filtro == 'nuevo' ) {

            $viewWith = ['dataUsers' => $dataUsers, 'keyCoordExterno' => $keyCoordExterno, 'keyCoordInterno' => $keyCoordInterno];
            
            return $viewWith;
        }
    }

    /**
     * Show the form for editing the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function pdf($alianza_id, Request $request)
    {   
        
        $alianza = $this->alianzaRepository->findWithoutFail($alianza_id);

        if (empty($alianza)) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.index'));
        }
        $viewWith = [];
        $viewWith = $this->show($alianza_id, 'local');
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'limpio']);
        $view = 'InterAlliance.show';
        //$view = 'welcome';
        
        //$pdf = PDF::loadView($view, $viewWith);
        //return $pdf->download('alliance-'.$alianza_id.'.pdf');
        //return  PDF::loadView($view, $viewWith)->save( storage_path().'/alliance-'.$alianza_id.'.pdf')->stream('alliance-'.$alianza_id.'.pdf');
        if ( isset($request['tipo']) ) {
            if ( $request['tipo'] == 1 ) {
                return view($view)->with($viewWith);
            }elseif ( $request['tipo'] == 2 ) {
                return  PDF::loadView($view, $viewWith)->stream('alliance-'.$alianza_id.'.pdf');
            }elseif ( $request['tipo'] == 3 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'basico']);
                return  PDF::loadView($view, $viewWith)->stream('alliance-'.$alianza_id.'.pdf');
            }elseif ( $request['tipo'] == 4 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'ajax']);
                return  PDF::loadView($view, $viewWith)->stream('alliance-'.$alianza_id.'.pdf');
            }
        }else{
            return  PDF::loadView($view, $viewWith)->stream('alliance-'.$alianza_id.'.pdf');
        }
    }

    /**
     * Show the form for editing the specified Alianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        //return \View::make('errors.404')->with(['peticion' => $this->peticion]);

        $alianza = $this->alianzaRepository->findWithoutFail($id);

        if (empty($alianza)) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.index'));
        }
        $tipo_paso = $this->tipoPaso->where('nombre', 'paso3_alianza')->pluck('id');

        $datosAlianza = $this->datosAlianza($alianza->id,'edit','ver',$tipo_paso);
        //print_r($datosAlianza);

            $alliance['tipo_tramite'] = $datosAlianza['dataAlianza']['tipo_tramite_id'];


            $keyCoordInterno = $datosAlianza['keyCoordInterno'];
            $keyCoordExterno = $datosAlianza['keyCoordExterno'];

            $dataAlianza['alianzaId'] = $datosAlianza['dataAlianza']['id'];

            $dataAlianza['tipo_tramite'] = $datosAlianza['dataAlianza']['tipo_tramite_id'];
            $dataAlianza['facultad_origen'] = array_column($datosAlianza['dataAlianza']['facultades'], 'facultad_id');
            $dataAlianza['programa_origen'] = array_column($datosAlianza['dataAlianza']['programas'], 'programa_id');
            
            $dataAlianza['facultad_origen_otro'] = '';

            $dataAlianza['tipo_alianza'] = $datosAlianza['dataAlianza']['modalidades'][0]['tipo_alianza_id'];
            $dataAlianza['modalidad'] = array_column($datosAlianza['dataAlianza']['modalidades'], 'modalidad_id'); 
            $dataAlianza['responsable_arl'] = $datosAlianza['dataAlianza']['responsable_arl'];


            $dataAlianza['duracion_cant'] = substr($datosAlianza['dataAlianza']['duracion'], 0, strpos($datosAlianza['dataAlianza']['duracion'], " "));
            $dataAlianza['duracion_unid'] = substr($datosAlianza['dataAlianza']['duracion'], strpos($datosAlianza['dataAlianza']['duracion'], " ") +1 );  
            $dataAlianza['objetivo_alianza'] = $datosAlianza['dataAlianza']['objetivo'];

            $dataAlianza['sera_coordinador_origen'] = 'NO';


            $dataAlianza['coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['usuario_id'];
            $dataAlianza['nombre_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_nombres'];
            $dataAlianza['cargo_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_cargo'];
            $dataAlianza['telefono_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_telefono'];
            $dataAlianza['email_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_email'];
            
            //valida que el coordinador este inactivo para permitir modificar los datos del coordinador
            if ($datosAlianza['dataUsers'][$keyCoordInterno]['usuario_activo'] == '1' ) {
                $dataAlianza['coordinador_origen'] = '999999';
            }else{
                $dataAlianza['nombre_coordinador_origen'] = '';
                $dataAlianza['cargo_coordinador_origen'] = '';
                $dataAlianza['telefono_coordinador_origen'] = '';
                $dataAlianza['email_coordinador_origen'] = '';
            }

            $dataAlianza['institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['id'];
            $dataAlianza['coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id'];

            $dataAlianza['tipo_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['tipo_institucion_id'];
            $dataAlianza['nombre_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['nombre'];
            $dataAlianza['direccion_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_direccion'];
            $dataAlianza['telefono_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_telefono'];
            $dataAlianza['codigo_postal_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['campus_codigo_postal'];
            $dataAlianza['pais_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['pais_id'];
            $dataAlianza['departamento_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['departamento_id'];
            $dataAlianza['ciudad_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['ciudad_id'];

            $dataAlianza['nombre_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_nombres'];
            $dataAlianza['cargo_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_cargo'];
            $dataAlianza['telefono_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_telefono'];
            $dataAlianza['email_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_email'];

            //valida que el representante este inactivo para permitir modificar los datos de la institucion
            if ( isset($datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']) && $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['usuario_activo'] == '1' ) {
                $dataAlianza['institucion_destino'] = '999999';
            }else{
                $dataAlianza['tipo_institucion_destino'] = '';
                $dataAlianza['nombre_institucion_destino'] = '';
                $dataAlianza['direccion_institucion_destino'] = '';
                $dataAlianza['telefono_institucion_destino'] = '';
                $dataAlianza['codigo_postal_institucion_destino'] = '';
                $dataAlianza['pais_institucion_destino'] = '';
                $dataAlianza['departamento_institucion_destino'] = '';
                $dataAlianza['ciudad_institucion_destino'] = '';
            }
            //valida que el coordinador este inactivo para permitir modificar los datos del coordinador
            if ($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_activo'] == '1' ) {
                $dataAlianza['coordinador_destino'] = '999999';
            }else{
                $dataAlianza['nombre_coordinador_destino'] = '';
                $dataAlianza['cargo_coordinador_destino'] = '';
                $dataAlianza['telefono_coordinador_destino'] = '';
                $dataAlianza['email_coordinador_destino'] = '';
            }
            $documentos_seleccionados = array_column($datosAlianza['archivosAdjuntos'], 'id');
            
       
        
        //obtiene los datos iniciales para los campos de los formularios
        $viewWith = $this->origin($alianza->id);

        $viewWith['programa_origen'] = \App\Models\Programa::whereIn('facultad_id', $dataAlianza['facultad_origen'])->pluck('nombre','id');
        $viewWith['modalidad'] = \App\Models\Modalidad::where('tipo_alianza_id', $dataAlianza['tipo_alianza'])->pluck('nombre','id');

        $viewWith['departamento_institucion_destino'] = \App\Models\Admin\State::where('pais_id', $dataAlianza['pais_institucion_destino'])->pluck('nombre','id');
        $viewWith['ciudad_institucion_destino'] = \App\Models\Admin\City::where('departamento_id', $dataAlianza['departamento_institucion_destino'])->pluck('nombre','id');

        $request['rol'] = 'coordinador_destino';
        $request['id'] = $dataAlianza['institucion_destino'];
        $coordinador_destino = $this->list($request);

        $viewWith['coordinador_destino'] = $coordinador_destino;

        $viewWith = array_merge($viewWith, ['alliance' => $dataAlianza, 'documentos_seleccionados' => $documentos_seleccionados]);
        return view('InterAlliance.edit')->with($viewWith);
    }

    /**
     * Update the specified Alianza in storage.
     *
     * @param  int              $id
     * @param UpdateAlianzaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlianzaRequest $request)
    {
        $alianza = $this->alianzaRepository->findWithoutFail($id);

        if (empty($alianza)) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.index'));
        }

        return $this->storeUpdate($request, 'update', $id);
    }

    /**
     * Remove the specified Alianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alianza = $this->alianzaRepository->findWithoutFail($id);

        if (empty($alianza)) {
            Flash::error('No se encontro la alianza');

            return redirect(route('interalliances.index'));
        }

        $this->alianzaRepository->delete($id);

        Flash::success('Alianza deleted successfully.');

        return redirect(route('interalliances.index'));
    }

    /**
     * Remove the specified Alianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $listaUsuarios = [''];
        switch ($request['rol']) {
            case 'coordinador_destino':
                $coordinador_destino_todos = $this->coordinador_destino
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('campus.institucion_id', $request['id'] )->role(['coordinador_externo','profesor'])->select('users.name','users.id');
                $listaUsuarios = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_destino_todos)->pluck('name','id');;
                break;
        }
        //print_r($listaUsuarios);
        return $listaUsuarios;
    }

    public function crearUsuario($tipo,$dataUser,$rol,$campus,$datosPersonales,$alianza)
    {
        $retorno = false;
        $newUserId = 0;
        if( $tipo == 'nuevo' ){
            if ( $newUser = User::create($dataUser) ) {
                $newUserId = $newUser->id;
                
                if ($datos_personales = \App\Models\DatosPersonales::create($datosPersonales) ){

                    $newUser->datos_personales_id = $datos_personales->id;
                    $newUser->save();

                    $tipo = 'coordinador';
                    if ($rol == 'representante_legal') {
                        $tipo = 'representante';
                    }
                    $asociarUsuario = $this->asociarUsuario($tipo,$newUserId,$rol,$campus,$alianza);
                    if ( $asociarUsuario == 'error_usuario' ) {
                        $retorno = 'error_asociar';
                        goto end;
                    }
                    
                    $retorno = $newUser;

                } else {
                    $retorno = 'error_datos_personales';
                    goto end;

                };

            } else {
                $retorno = 'error_usuario';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){

            $actualizarUser = User::find($dataUser['id']);
            if ( count($actualizarUser) > 0 ) {
                if ( $actualizarUser->email != $dataUser['email'] ) {
                    $actualizarUser->activo = 1;
                }
                $actualizarUser->name = $dataUser['name'];
                $actualizarUser->email = $dataUser['email'];
                
                $actualizarUser->datos_personales->nombres = $datosPersonales['nombres'];
                if (isset($datosPersonales['ciudad_residencia_id'])) {
                    $actualizarUser->datos_personales->ciudad_residencia_id = $datosPersonales['ciudad_residencia_id'];
                }
                $actualizarUser->datos_personales->telefono = $datosPersonales['telefono'];
                $actualizarUser->datos_personales->cargo = $datosPersonales['cargo'];

                //guardar los cambios en el usuario y sus datos personales
                $actualizarUser->push(); 

            }else{
                $retorno = 'error_usuario';
                goto end;
            }

        }
        end:
        return $retorno;
    }

    public function crearAlianza($tipo,$dataAlianza,$userId,$campusId)
    {
        $retorno = false;
        if ($dataAlianza != false) {
            if( $tipo == 'nuevo' ){
                if ($alianza = \App\Models\Alianza::create($dataAlianza) ){

                //asociar el coordinador con la alianza: alianza_user
                    $alianza->user()->sync($userId);

                //asociar la institucion con la alianza: alianza_institucion
                    $institucionOrigen = DB::table('institucion')
                    ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                    ->where('campus.id', $campusId)
                    ->pluck('institucion.id')->toArray();

                    $alianza->institucion()->sync($institucionOrigen);

                    $retorno = $alianza;
                    session(['alianzaId' => $alianza->id]);
                }else{
                    $retorno = 'error_alianza';
                }
            }elseif( $tipo == 'actualizar' ){
                $actualizarAlianza = $this->alianzaRepository->findWithoutFail($dataAlianza['id']);
                if ( count($actualizarAlianza) > 0 ) {
                    // para no tener que volver a enviar el token se elimina
                    unset($dataAlianza['token']);
                    $actualizarAlianza = $this->alianzaRepository->update($dataAlianza, $dataAlianza['id']);

                    if ($actualizarAlianza){
                        $alianza = $actualizarAlianza;
                    //asociar el coordinador con la alianza: alianza_user
                        $actualizarAlianza->user()->syncWithoutDetaching ($userId);

                    //asociar la institucion con la alianza: alianza_institucion
                        $institucionOrigen = DB::table('institucion')
                        ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                        ->where('campus.id', $campusId)
                        ->pluck('institucion.id')->toArray();

                        $alianza->institucion()->syncWithoutDetaching($institucionOrigen);

                        $retorno = $alianza;
                        session(['alianzaId' => $alianza->id]);
                    }else{
                        $retorno = 'error_alianza';
                    }
                }else{
                    $retorno = 'error_alianza';
                }
            }
            
        }
        return $retorno;
        
    }

    public function crearInstitucion($tipo,$dataInstitucion,$dataCampus,$alianza)
    {
        $retorno = false;
        $campusId = 0;
        $facultadId = 0;
        if( $tipo == 'nuevo' ){
            if ( $nuevaInstitucion = \App\Models\Admin\Institucion::create($dataInstitucion) ) {

                $nuevaInstitucionId = $nuevaInstitucion->id;

                $dataCampus['institucion_id']= $nuevaInstitucionId;
                //crear el nuevo campus
                $crearCampus = $this->crearCampus('nuevo',$dataCampus);
                if ( $crearCampus == 'error_campus' ) {
                    $retorno = $crearCampus;
                    goto end;
                }elseif( $crearCampus != false ){
                    $campusId = $crearCampus->id;
                    $retorno['campusId'] = $campusId;

                    //DETERMINAR CUAL SERA EL NOMBRE DEL PRIMER CAMPUS 
                    $dataFacultad['nombre']= 'Administracion';
                    $dataFacultad['campus_id']= $campusId;
                    //crear la nueva facultad
                    $crearFacultad = $this->crearFacultad('destino',$dataFacultad,'UNIDAD',[0],$alianza);
                    if ( $crearFacultad == 'error_facultad' ) {
                        $retorno = $crearFacultad;
                        goto end;
                    }elseif( $crearFacultad != false ){
                        $facultadId = $crearFacultad->id;
                        $retorno['facultadId'] = $facultadId;
                    }

                }


                $alianza->institucion()->syncWithoutDetaching($nuevaInstitucionId);

                $retorno['institucionId'] = $nuevaInstitucion->id;
            }else{
                $retorno = 'error_institucion';
            }

        }elseif( $tipo == 'actualizar' ){
            $actualizarInstitucion = $this->institucion::find($dataInstitucion['institucion_id']);
            if ( count($actualizarInstitucion) > 0 ) {
                $actualizarInstitucion->tipo_institucion_id = $dataInstitucion['tipo_institucion_id'];
                $actualizarInstitucion->nombre = $dataInstitucion['nombre'];
                $actualizarInstitucion->save();

                $campus_id = \App\Models\Admin\Campus::select('id')->where('institucion_id',$actualizarInstitucion->id)->orderBy('id','asc')->first();
                $dataCampus['campus_id'] = $campus_id->id;
                $dataCampus['institucion_id'] = $actualizarInstitucion->id;

                $actualizarCampus = $this->crearCampus('actualizar',$dataCampus);
                
                if ( $actualizarCampus == 'error_campus' ) {
                    $retorno = $actualizarCampus;
                    goto end;
                }elseif( $actualizarCampus != false ){
                    $retorno['campusId'] = $actualizarCampus->id;
                }

                $retorno['institucionId'] = $actualizarInstitucion->id;

            }else{
                $retorno = 'error_institucion';
                goto end;
            }

        }elseif( $tipo == 'asociar' ){
            $existeInstitucion = \App\Models\Admin\Institucion::find($dataInstitucion);
            if (!count($existeInstitucion)) {
                $retorno = 'error_institucion';
                goto end;
            }
            $alianza->institucion()->syncWithoutDetaching($existeInstitucion);

            $retorno = $existeInstitucion;
        }

        end:
        return $retorno;
    }

    public function crearCampus($tipo,$dataCampus)
    {
        $retorno = false;
        if( $tipo == 'nuevo' ){
            // Create the campus
            if ( $newCampus = \App\Models\Admin\Campus::create($dataCampus) ) {

                $retorno = $newCampus;

            }else{
                $retorno = 'error_campus';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){
            $actualizarCampus = \App\Models\Admin\Campus::find($dataCampus['campus_id']);
            if ( count($actualizarCampus) > 0 ) {
                $actualizarCampus->nombre = $dataCampus['nombre'];
                $actualizarCampus->institucion_id = $dataCampus['institucion_id'];
                $actualizarCampus->telefono = $dataCampus['telefono'];
                $actualizarCampus->direccion = $dataCampus['direccion'];
                $actualizarCampus->codigo_postal = $dataCampus['codigo_postal'];
                $actualizarCampus->ciudad_id = $dataCampus['ciudad_id'];
                $actualizarCampus->save();

                $retorno = $actualizarCampus;

            }else{
                $retorno = 'error_campus';
                goto end;
            }
        }

        end:
        return $retorno;
    }

    public function crearFacultad($tipo,$dataFacultad,$tipoFacultad,$otrasfacultades,$alianza)
    {
        $retorno = false;
        $facultades = '';
        if( $dataFacultad != false ){
            //buscar tipo_facultad=UNIDAD
            $tipo_facultad = \App\Models\TipoFacultad::select('id')->where('nombre',$tipoFacultad)->get();

            //armar los datos para la nueva unidad (facultad)
            //selel asigna la primera aparicion
            $dataFacultad['tipo_facultad_id'] = $tipo_facultad[0]->id;
            //print_r($dataFacultad);
            //crear la nueva unidad (facultad)
            if ($nuevaFacultad = $this->facultad->create($dataFacultad) ){
                //quitar el elemento 'Otro' que tiene el id '999999'
                unset($otrasfacultades['999999']);
                //asociar el resto de facultades
                $facultades = $this->facultad->whereIn('id',[$nuevaFacultad->id , $otrasfacultades ])->pluck('id')->toArray();
                $retorno = $nuevaFacultad;
            }else{
                $retorno = 'error_facultad';
                goto end;
            }

        }else{
            //$facultades = $this->facultad->whereIn('id',[$otrasfacultades])->pluck('id')->toArray();
            $facultades = $this->facultad->find($otrasfacultades);
            
            $retorno = true;
        }
        if ($tipo == 'origen') {
            $alianza->facultad()->sync($facultades);
        }
        
        end:
        return $retorno;
        
    }

    public function asociarUsuario($tipo,$datos,$rol,$campus,$alianza)
    {
        $retorno = false;
        $role = Role::where('name',$rol)->get();

        $usuario = User::find($datos);
        if (!count($usuario)) {
            $retorno = 'error_usuario';
            goto end;
        }
        //ASIGNAR EL ROL DE coordinador_interno 

        if ( !$usuario->hasAllRoles($role) ) {
            $usuario->assignRole($rol);
        }

        //ASIGNAR EL campus al coordinador de origen
        $usuario->campus()->syncWithoutDetaching($campus);
        
        switch ($tipo) {
            case 'coordinador':

                if ( $alianza != '' ) {
                    $alianza->user()->syncWithoutDetaching($usuario->id);
                }

                $retorno = $usuario;
                
                break;
            case 'representante':

                $retorno = $usuario;
                
                break;        
        }

        end:
        return $retorno;
    }
}
