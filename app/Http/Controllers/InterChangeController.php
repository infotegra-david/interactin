<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInscripcionRequest;
use App\Http\Requests\UpdateInscripcionRequest;
use App\Repositories\InscripcionRepository;
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
use App\Models\Admin\Country;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Traits\Emails;
use App\Http\Traits\Validador;
use App\Http\Traits\AdminDocs;
use App\Http\Traits\Formats;
use PDF;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class InterChangeController extends AppBaseController
{
    use Authorizable;
    use Emails;
    use Validador;
    use AdminDocs;
    use Formats;
    
    /** @var  InscripcionRepository */    
    private $inscripcionRepository;

    private $user;
    private $campusApp;
    private $campusAppFound;
    private $tipoPaso;
    private $paso_titulo;
    private $numeros_pasos;
    private $tipos_pasos;
    private $userCampus;
    private $institucion;
    private $facultad;
    private $tipoInstitucion;
    private $pais;
    private $peticion;
    private $tipoRuta;
    private $tipoInterChange;
    private $viewWith = [];

    public function __construct(InscripcionRepository $inscripcionRepo, TipoPaso $tipoPasoModel, Institucion $institucionModel, Facultad $facultadModel, Country $countryModel, Request $request)
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

        $this->inscripcionRepository = $inscripcionRepo;
        $this->tipoPaso = $tipoPasoModel;
        $this->institucion = $institucionModel;
        $this->facultad = $facultadModel;
        $this->pais = $countryModel;
        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        $roleValidador = Role::where('name','validador')->pluck('id');
        
        $this->tipos_pasos = $this->tipoPaso->leftjoin('user_tipo_paso','tipo_paso.id','user_tipo_paso.tipo_paso_id')
            ->leftjoin('model_has_roles','user_tipo_paso.user_id','model_has_roles.model_id')
            ->where('nombre','like','%_interchange')
            ->where(function ($query) use ($roleValidador) {
                $query->whereNull('model_has_roles.role_id')
                    ->orWhere('model_has_roles.role_id',$roleValidador); 
            })
            ->select('user_tipo_paso.user_id', 'tipo_paso.id', 'tipo_paso.nombre','tipo_paso.titulo','tipo_paso.seccion','tipo_paso.reglas', DB::raw('replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,"paso")+4,2),"_","") AS orden'))
            ->get()->toArray();

        foreach ($this->tipos_pasos as $key => $value) {
            $this->paso_titulo[$value['orden']] = $value['titulo'];
            //crea un array con el numero del paso 
            $this->numeros_pasos[$value['orden']] = $value;
        }

        //diferentes formas de obtener la ruta
        //$route = Route::current();

        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();

        $this->tipoRuta = $name;
        $this->route_split = substr($name, 0,strrpos($name, "."));

        $this->tipoInterChange = '';
        if ( strpos($this->tipoRuta, 'interin') !== false ) {
            $this->tipoInterChange = 'InterIn';
        }elseif ( strpos($this->tipoRuta, 'interout') !== false ) {
            $this->tipoInterChange = 'InterOut';
        }
        //se define por defecto un paso maximo inicial y a medida que se va avanzando en la inscripcion se ira modificando
        $pasoMaximo = 4;
        $this->viewWith = array_merge($this->viewWith,['route_split' => $this->route_split, 'tipoInterChange' => $this->tipoInterChange, 'pasoMaximo' => $pasoMaximo]);

        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }

    }

    public function crearPaso($paso,$estado,$inscripcionId,$campus_id,$observacion = '')
    {
        $userId = $this->user->id;
        $tipo_paso = $this->tipoPaso->where('nombre','paso'.$paso.'_interchange')->pluck('id')->first();
        $estado = \App\Models\Estado::where('nombre',$estado)->pluck('id')->first();

        //¿siempre se crea un nuevo paso o se actualiza si existe?
            /*
            $pasoinscripcion = \App\Models\Validation\Pasosinscripcion::where('tipo_paso_id',$tipo_paso)->where('inscripcion_id',$inscripcionId)->where('user_id',$userId);
            $existePaso = $pasoinscripcion->first();
            if ( count($existePaso) ) {
                $pasoinscripcion->update(['estado_id' => $estado]);
                return $existePaso->id;
            }else{
            */
                $dataPaso['tipo_paso_id'] = $tipo_paso;
                $dataPaso['estado_id'] = $estado;
                $dataPaso['inscripcion_id'] = $inscripcionId;
                $dataPaso['user_id'] = $userId;
                $dataPaso['campus_id'] = $campus_id;
                $dataPaso['observacion'] = $observacion;

                $pasoInscripcion = \App\Models\Validation\PasosInscripcion::updateOrCreate(
                    ['tipo_paso_id' => $tipo_paso, 'inscripcion_id' => $inscripcionId, 'user_id' => $userId, 'campus_id' => $campus_id],
                    ['estado_id' => $estado, 'observacion' => $observacion]
                );

                if ( $pasoInscripcion ){
                    //$this->notificarPaso($paso,$estado,$inscripcionId);
                    return $pasoInscripcion;
                }else{
                    return false;
                }
            /*
            }
            */
        
    }

    /**
     * Display a listing of the InterChange.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ( strpos($this->tipoRuta, 'interout') !== false ) {
            $tipoInscripcion = 0;
            // return redirect(route($this->route_split.'.create'));
        }elseif ( strpos($this->tipoRuta, 'interin') !== false ) {
            $tipoInscripcion = 1;
            // return redirect(route($this->route_split.'.create'));
        }


        // $this->inscripcionRepository->pushCriteria(new RequestCriteria($request));
        // $inscripcions = $this->inscripcionRepository->all();

        // return view('InterChange.index')
        //     ->with(['interChanges', $inscripcions, 'campusApp' => $this->campusApp, 'peticion' => $this->peticion]);



        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }
        // $thisUserRoles = DB::table('model_has_roles')->where('model_id',$this->user->id)->pluck('role_id')->toArray();
        $thisUserRoles = $this->user->getRoleNames()->toArray();

        //obtener los datos de los coordinadores de la inscripcion
        $rolesUsuarios = Role::whereIn('name',['coordinador_interno','coordinador_externo','estudiante','copia_oculta_email'])->select('id','name')->get()->toArray();
        $roleCoordinadorInterno = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'coordinador_interno');
        });
        $roleCoordinadorExterno = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'coordinador_externo');
        });
        $roleEstudiante = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'estudiante');
        });
        $roleCopiaEmails = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'copia_oculta_email');
        });
        reset($roleCoordinadorInterno);
        reset($roleCoordinadorExterno);
        reset($roleEstudiante);
        reset($roleCopiaEmails);
        $keyRoleCoorInt = key($roleCoordinadorInterno);
        $keyRoleCoorExt = key($roleCoordinadorExterno);
        $keyRoleEstudiante = key($roleEstudiante);
        $keyRoleCopiaEmail = key($roleCopiaEmails);

        $roleCoordinadorInternoId = $roleCoordinadorInterno[$keyRoleCoorInt]['id'];
        $roleCoordinadorExternoId = $roleCoordinadorExterno[$keyRoleCoorExt]['id'];
        $roleEstudianteId = $roleEstudiante[$keyRoleEstudiante]['id'];
        $roleCopiaEmailsId = $roleCopiaEmails[$keyRoleCopiaEmail]['id'];


        //obtener todos los estados
        $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
        //filtra las validaciones que aprobaron o activaron la inscripcion
        $estadoValidacionActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'VALIDATOR' && $var['nombre'] == 'ACTIVA');
        });
        $estadoInscripcionActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        $estadoRechazadoDeclinado = array_filter($estadosData, function($var){
            return ($var['nombre'] == 'RECHAZADO' || $var['nombre'] == 'DECLINADO');
        });
        reset($estadoInscripcionActiva);
        reset($estadoValidacionActiva);
        // reset($estadoRechazadoDeclinado);
        $keyEstadoInscripcionActiva = key($estadoInscripcionActiva);
        $keyEstadoValidacion = key($estadoValidacionActiva);
        // $keyEstadoRechazadoDeclinado = key($estadoRechazadoDeclinado);
        
        $campusApp = $this->campusAppFound;

        //array con los filtros a mostrar
        $select_filter = ['pendings' => 'Pendientes','participate' => 'Participo','not_rejected' => 'Sin rechazar','rejected' => 'Rechazadas','all' => 'Todas'];
        $filter = 'pendings';


        //realizar los filtros para listar las inscripciones
        $inscripciones = \App\Models\Inscripcion::orderByDesc('inscripcion.updated_at')
            ->where('tipo',$tipoInscripcion)
            ->groupBy('inscripcion.id');

        $inscripcion_campus_id = ['inscripcion.campus_id',$campusApp->id];

        $esValidador = array_search('validador', $thisUserRoles);
        $esEstudiante = array_search('estudiante', $thisUserRoles);
        $esCoordInterno = array_search('coordinador_interno', $thisUserRoles);
        $esCoordExterno = array_search('coordinador_externo', $thisUserRoles);

        if (isset($request['filter'])) {
            if ($request['filter'] == 'all') {
                $filter = $request['filter'];
                $inscripcion_campus_id = ['inscripcion.campus_id','<>',0];
                //no se ejecutan acciones, se mostraran todas las inscripciones
            }elseif($request['filter'] == 'pendings' || $request['filter'] == 'participate'){
                $filter = $request['filter'];

                if ($esCoordInterno !== false || $esCoordExterno !== false) {
                    $inscripciones = $inscripciones->join('pasos_inscripcion','inscripcion.id','pasos_inscripcion.inscripcion_id')
                                ->where('pasos_inscripcion.user_id',$this->user->id);

                    if($request['filter'] == 'pendings'){
                        $inscripciones = $inscripciones->where('inscripcion.estado_id','<>',$estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id']);
                    }

                }elseif ($esEstudiante !== false) {
                    $inscripciones = $inscripciones->where('inscripcion.user_id',$this->user->id);
                }elseif ($esValidador !== false) {
                    
                }
            }elseif($request['filter'] == 'not_rejected' || $request['filter'] == 'rejected'){
                $filter = $request['filter'];

                $inscripcionesRechazadasDeclinadas = \App\Models\Validation\PasosInscripcion::whereIn('estado_id',array_column($estadoRechazadoDeclinado, 'id'))->groupBy('inscripcion_id')->pluck('inscripcion_id');

                if($request['filter'] == 'not_rejected'){
                // if ($esValidador !== false) {
                    
                // }elseif ($esCoordInterno !== false || $esCoordExterno !== false) {
                    $inscripciones = $inscripciones->whereNotIn('id',$inscripcionesRechazadasDeclinadas);
                // }
                }elseif($request['filter'] == 'rejected'){
                // if ($esValidador !== false) {
                    
                // }elseif ($esCoordInterno !== false || $esCoordExterno !== false) {
                    $inscripciones = $inscripciones->whereIn('id',$inscripcionesRechazadasDeclinadas);
                // }
                }
            }
        }else{
            //por defecto los filtra por los pendientes del usuario
            
            if ($esCoordInterno !== false || $esCoordExterno !== false) {
                $inscripciones = $inscripciones->join('pasos_inscripcion','inscripcion.id','pasos_inscripcion.inscripcion_id')
                            ->where('pasos_inscripcion.user_id',$this->user->id);
            }elseif ($esEstudiante !== false) {
                $inscripciones = $inscripciones->where('inscripcion.user_id',$this->user->id);
            }elseif ($esValidador !== false) {
                
            }
        }

        $inscripciones = $inscripciones->where([$inscripcion_campus_id]);

        $inscripciones = $inscripciones->select('inscripcion.*')->get()->toArray();

        $institucionId = $campusApp->institucion->id;

        //nombre institucion destino
        //tipo institucion destino
        // $programasDestino = array_column($inscripciones, 'programa_destino_id');

        // $facultadesDestino = \App\Models\Admin\Facultad::select('facultad.campus_id','programa.id AS programa_id')
        //     ->join('programa','facultad.id','programa.facultad_id')
        //     ->whereIn('programa.id',$programasDestino)
        //     ->get()->toArray();

        $instituciones_destinoData = \App\Models\Admin\Institucion::select('institucion.id AS institucion_id','institucion.nombre AS institucion_nombre','tipo_institucion.nombre AS tipo_institucion_nombre')
            ->join('tipo_institucion','institucion.tipo_institucion_id','tipo_institucion.id')
            ->whereIn('institucion.id',array_column($inscripciones, 'institucion_destino_id'))
            ->get()->toArray();

        if (count($instituciones_destinoData)) {

            $campusData = \App\Models\Admin\Institucion::select('institucion.id AS institucion_id','campus.ciudad_id AS campus_ciudad_id')
                ->join('campus','institucion.id','campus.institucion_id')
                ->where('campus.principal',1)
                ->whereIn('institucion.id',array_column($instituciones_destinoData, 'institucion_id'))
                ->groupBy('institucion.id')
                ->get()->toArray();

            $ciudadData = \App\Models\Admin\City::select('ciudad.id AS ciudad_id','ciudad.departamento_id AS ciudad_departamento_id')
                ->whereIn('ciudad.id',array_column($campusData, 'campus_ciudad_id'))
                ->groupBy('ciudad.departamento_id')
                ->get()->toArray();

            //pais institucion destino
            $paisesData = \App\Models\Admin\Country::select('departamento.id AS departamento_id','pais.id AS pais_id','pais.nombre AS pais_nombre')
                ->join('departamento','pais.id','departamento.pais_id')
                ->whereIn('departamento.id',array_column($ciudadData, 'ciudad_departamento_id'))
                ->groupBy('pais.id')
                ->get()->toArray();

            //asociar los datos del pais a la ciudad
            foreach ($ciudadData as $keyciudadData => $ciudad) {
                foreach ($paisesData as $keypaisesData => $pais) {
                    if ($ciudad['ciudad_departamento_id'] == $pais['departamento_id']) {
                        $ciudadData[$keyciudadData]['pais'] = $pais;
                    }
                }
            }
            //asociar los datos de la ciudad al campus
            foreach ($campusData as $keycampusData => $campus) {
                foreach ($ciudadData as $keyciudadData => $ciudad) {
                    if ($campus['campus_ciudad_id'] == $ciudad['ciudad_id']) {
                        $campusData[$keycampusData]['ciudad'] = $ciudad;
                    }
                }
            }
            //asociar los datos del campus a la institucion
            foreach ($instituciones_destinoData as $keyinstituciones_destinoData => $institucion) {
                foreach ($campusData as $keycampusData => $campus) {
                    if ($institucion['institucion_id'] == $campus['institucion_id']) {
                        $instituciones_destinoData[$keyinstituciones_destinoData]['campus'] = $campus;
                    }
                }
            }
            //asociar los datos de la institucion a la inscripcion
            foreach ($inscripciones as $keyinscripciones => $inscripcion) {
                foreach ($instituciones_destinoData as $keyinstituciones_destinoData => $institucion) {
                    if ($inscripcion['institucion_destino_id'] == $institucion['institucion_id']) {
                        $inscripciones[$keyinscripciones]['institucion_destino'] = $institucion;
                    }

                }
                if (!isset($inscripciones[$keyinscripciones]['institucion_destino'])) {
                    $inscripciones[$keyinscripciones]['institucion_destino']['institucion_nombre'] = '';
                    $inscripciones[$keyinscripciones]['institucion_destino']['campus']['ciudad']['pais']['pais_nombre'] = '';
                    $inscripciones[$keyinscripciones]['institucion_destino']['tipo_institucion_nombre'] = '';    
                }
            }

        }else{
            foreach ($inscripciones as $keyinscripciones => $inscripcion) {
                $inscripciones[$keyinscripciones]['institucion_destino']['institucion_nombre'] = '';
                $inscripciones[$keyinscripciones]['institucion_destino']['campus']['ciudad']['pais']['pais_nombre'] = '';
                $inscripciones[$keyinscripciones]['institucion_destino']['tipo_institucion_nombre'] = '';
            }
        }

        //documentos de las inscripciones
        $tipo_documento_id = \App\Models\TipoDocumento::where('nombre','DOCUMENTOS FINALES INSCRIPCION')->pluck('id');
        $documentosInscripcionData =  \App\Models\DocumentosInscripcion::join('archivo','documentos_inscripcion.archivo_id','archivo.id')
            ->whereIn('documentos_inscripcion.inscripcion_id',array_column($inscripciones, 'id'))
            ->whereIn('tipo_documento_id',$tipo_documento_id)
            ->orderBy('documentos_inscripcion.updated_at','desc')
            ->select('documentos_inscripcion.inscripcion_id','archivo.nombre','archivo.id','archivo.path')
            ->get()->toArray();



        $dataUsers = DB::table('pasos_inscripcion')
                ->join('users', 'pasos_inscripcion.user_id', '=', 'users.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->whereIn('pasos_inscripcion.inscripcion_id',array_column($inscripciones, 'id') )
                ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno[$keyRoleCoorInt]['id'],$roleCoordinadorExterno[$keyRoleCoorExt]['id'],$roleEstudiante[$keyRoleEstudiante]['id']] )
                ->select('pasos_inscripcion.inscripcion_id AS inscripcion_id','users.id AS user_id','users.name AS usuario_name','model_has_roles.role_id')
                ->orderBy('pasos_inscripcion.inscripcion_id','asc')
                ->get()->toArray();

        $CoordinadoresExternosId = array();
        $CoordinadoresInternosId = array();
        $EstudiantesId = array();

        // if (count($dataUsers) < 2 ) {
        //     $CoordinadoresExternosId = 0;
        //     $CoordinadoresInternosId = 0;
        // }

        foreach ($dataUsers as $data => $user) {
            if ($user->role_id == $roleCoordinadorInterno[$keyRoleCoorInt]['id']) {
                $CoordinadoresInternosId[$user->inscripcion_id] = $user->user_id;
            }elseif ($user->role_id == $roleCoordinadorExterno[$keyRoleCoorExt]['id']) {
                $CoordinadoresExternosId[$user->inscripcion_id] = $user->user_id;
            }elseif ($user->role_id == $roleEstudiante[$keyRoleEstudiante]['id']) {
                $EstudiantesId[$user->inscripcion_id] = $user->user_id;
            }
        }

        //calcular las fechas
        foreach ($inscripciones as $keyinscripciones => $inscripcion) {
            $estadoInscripcionActual = array_search($inscripciones[$keyinscripciones]['estado_id'], array_column($estadosData, 'id'));
            $inscripciones[$keyinscripciones]['estado_nombre'] = $estadosData[$estadoInscripcionActual]['nombre'];
            // created_at sin hora
            if ( empty($inscripciones[$keyinscripciones]['fecha_inicio']) ) {
                $inscripciones[$keyinscripciones]['fecha_inicio'] = '????-??-??';
            }else{
                $inscripciones[$keyinscripciones]['fecha_inicio'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['fecha_inicio']));    
            }
            if ( empty($inscripciones[$keyinscripciones]['fecha_fin']) ) {
                $inscripciones[$keyinscripciones]['fecha_fin'] = '????-??-??';
            }else{
                $inscripciones[$keyinscripciones]['fecha_fin'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['fecha_fin']));    
            }


            // $inscripciones[$keyinscripciones]['fecha_inicio'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['fecha_inicio']));
            // $inscripciones[$keyinscripciones]['fecha_fin'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['fecha_fin']));
            $inscripciones[$keyinscripciones]['created_at'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['created_at']));
            $inscripciones[$keyinscripciones]['updated_at'] = date('Y-m-d', strtotime($inscripciones[$keyinscripciones]['updated_at']));

            //convertir la duracion para poderla sumar a la fecha de actualizacion
            // $duracion = str_replace("MESES", "month", $inscripciones[$keyinscripciones]['duracion']);
            // $duracion = str_replace("AÑOS", "year", $duracion);
            //cambiar el texto de la duracion 
            // $inscripciones[$keyinscripciones]['duracion'] = str_replace("MESES", "Mes(es)", $inscripciones[$keyinscripciones]['duracion']);
            // $inscripciones[$keyinscripciones]['duracion'] = str_replace("AÑOS", "Año(s)", $inscripciones[$keyinscripciones]['duracion']);
            if ($inscripciones[$keyinscripciones]['fecha_inicio'] != '????-??-??' && $inscripciones[$keyinscripciones]['fecha_fin'] != '????-??-??') {
                $date_fecha_inicio = new \DateTime($inscripciones[$keyinscripciones]['fecha_inicio']);
                $datefecha_fin = new \DateTime($inscripciones[$keyinscripciones]['fecha_fin']);
                $diffFechas = $date_fecha_inicio->diff($datefecha_fin);
                $inscripciones[$keyinscripciones]['duracion'] = $this->get_format($diffFechas);
                
            }else{
                $inscripciones[$keyinscripciones]['duracion'] = '?';
                
            }

            
            $inscripciones[$keyinscripciones]['tiempo_restante'] = '?';
            //calcular las fechas y obtener el documento de las inscripciones activas
            if ($inscripciones[$keyinscripciones]['estado_id'] == $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id']) {
                foreach ($documentosInscripcionData as $keydocumentosInscripcionData => $documentoInscripcion) {
                    if ($inscripcion['id'] == $documentoInscripcion['inscripcion_id']) {
                        $inscripciones[$keyinscripciones]['archivo'] = $documentoInscripcion;
                    }

                }

                // calcular fecha final: fecha_inicio + duracion 
                // $inscripciones[$keyinscripciones]['fecha_fin'] = strtotime ( '+'.$duracion , strtotime ( $inscripciones[$keyinscripciones]['fecha_inicio'] ) );
                // $inscripciones[$keyinscripciones]['fecha_fin'] = date('Y-m-d', $inscripciones[$keyinscripciones]['fecha_fin'] );

                // calcular restante: fecha_inicio - duracion
                $date1 = new \DateTime('now');
                $date2 = new \DateTime($inscripciones[$keyinscripciones]['fecha_fin']);
                $diff = $date1->diff($date2);
                
                $inscripciones[$keyinscripciones]['tiempo_restante'] = $this->get_format($diff);
            }
        }
        //calcular los datos de pasos y validaciones
        if (count($inscripciones)) {
            //(# validadores aprobado * 100) / # validadores total 
            // $estadosData = \App\Models\Estado::where('uso','VALIDATOR')->select('id','nombre')->get()->toArray();
            // $estadoAprobadoId = array_search('APROBADO', array_column($estadosData, 'nombre') );
            
            // $tipos_pasos = $this->tipoPaso->where([['nombre','like','%_interchange']])->select('id','nombre','titulo')->get()->toArray();
            $tipos_pasos = $this->tipos_pasos;
// echo 'tipos_pasos:';
// print_r($tipos_pasos);
            
            $totalValidadores = \App\Models\Validation\UserPaso::select('users.id AS user_id', 'users.name', 'users.email', 'user_tipo_paso.titulo', 'user_tipo_paso.campus_id', 'user_tipo_paso.tipo_paso_id')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos, 'id') )
                        ->where('model_has_roles.role_id','<>',$roleCopiaEmailsId )
                        ->whereIn('user_tipo_paso.campus_id',array_column($inscripciones, 'campus_id'))
                        ->groupBy('user_tipo_paso.id')
                        ->get()->toArray();
        // print_r($inscripciones);

            $unique_campus_id = array_unique(array_column($inscripciones,'campus_id'));
            $totalValidadoresXInscripcion = [];

            if (count($totalValidadores)) {
                foreach ($unique_campus_id as $key => $value) {
                    $totalValidadoresXInscripcion[$value] = array_filter($totalValidadores, function($var) use ($value){
                        return ($var['campus_id'] == $value);
                    });
                }
                reset($totalValidadoresXInscripcion);
                // print_r($totalValidadoresXInscripcion);
            }

                $pasosInscripcionData = \App\Models\Validation\PasosInscripcion::select('pasos_inscripcion.id','pasos_inscripcion.inscripcion_id AS inscripcion_id','pasos_inscripcion.user_id AS user_id','pasos_inscripcion.tipo_paso_id AS tipo_paso_id','pasos_inscripcion.observacion','pasos_inscripcion.estado_id AS estado_id','estado.nombre AS estado_nombre','estado.uso AS estado_uso')
                    ->join('estado','pasos_inscripcion.estado_id','estado.id')
                    ->join('inscripcion','pasos_inscripcion.inscripcion_id','inscripcion.id')
                    ->whereIn('inscripcion.id',array_column($inscripciones, 'id'))
                    ->whereIn('pasos_inscripcion.tipo_paso_id',array_column($tipos_pasos, 'id'))
                    ->orderBy('pasos_inscripcion.inscripcion_id','asc')
                    ->orderBy('pasos_inscripcion.tipo_paso_id','asc')
                    ->orderBy('pasos_inscripcion.created_at','asc');
                    //->whereIn('pasos_inscripcion.estado_id',array_column($estadosData, 'id'))
                    // no va en este caso porque no muestra las validaciones de los coordinadores externos
                    // ->where('pasos_inscripcion.campus_id',$campusAppId)

                // echo $pasosInscripcionData->toSql();
                // print_r( $pasosInscripcionData->getBindings() );

                $pasosInscripcionData = $pasosInscripcionData->get()->toArray();
                // print_r( $pasosInscripcionData );

                //crea un array con el id del paso y el numero del paso real
                $numero_paso = array();
                foreach ($tipos_pasos as $tipo_paso) {
                    $numero_paso[$tipo_paso['id']] = $tipo_paso;
                }

                $keys_numero_paso = array_keys($numero_paso);

                // nombre validadores aprobado
                //asociar los datos de los validadores a la inscripcion
                $numeroValidadoresData = 0;

                foreach ($inscripciones as $keyinscripciones => $inscripcion) {
                    //se debe reiniciar en cada inscripcion
                    $continuarPaso = true;
                    $campus_id_inscripcion = $inscripciones[$keyinscripciones]['campus_id'];

                    $totalValidadoresXI = ($totalValidadoresXInscripcion[$campus_id_inscripcion] ?? []);

                    $inscripciones[$keyinscripciones]['pasos_registrados'] = 0;
                    // $inscripciones[$keyinscripciones]['total_pasos'] = count($tipos_pasos);
                    $inscripciones[$keyinscripciones]['total_pasos'] = count($numero_paso);
                    $inscripciones[$keyinscripciones]['pasos_inscripcion'] = array();
                    $inscripciones[$keyinscripciones]['estado_actual'] = '';
                    //esta variable es usada para señalar cuales inscripciones van a estar resaltadas debido a que son tareas pendientes del usuario
// echo 'totalValidadoresXI:';
// print_r($totalValidadoresXI);
                    if (count($totalValidadoresXI) >= 1) {
                        $keyEsValidador = array_search($this->user->id, array_column($totalValidadoresXI, 'user_id'));
                        
                        
                    }else{
                        $keyEsValidador = false;
                    }

                    $task_pending = '';
                    $yaValido = 0;
                    $pasoQueYaValido = 0;
                    foreach ($pasosInscripcionData as $keypasosInscripcionData => $pasoInscripcion) {
                        if ($inscripcion['id'] == $pasoInscripcion['inscripcion_id']) {

                            //busca si existen validadores asignados en cada paso y agrega los validadores del paso al indice 'validadoresXelPaso' 
                            $validadoresXelPaso = [];
                            $tiposPasosValidadoresXI = array_column($totalValidadoresXI, 'tipo_paso_id');
                            if (array_search($pasoInscripcion['tipo_paso_id'], $tiposPasosValidadoresXI) !== false) {
                                $tipo_paso_actual = $pasoInscripcion['tipo_paso_id'];
                                $validadoresXelPaso = array_filter($totalValidadoresXI, function($var) use ($tipo_paso_actual){
                                    return ($var['tipo_paso_id'] == $tipo_paso_actual);
                                });
                                $inscripciones[$keyinscripciones]['validadoresXelPaso'][$pasoInscripcion['tipo_paso_id']] = $validadoresXelPaso;

// echo '<br> entro: inscripcion:'.$inscripcion['id'].'|pasoInscripcion[tipo_paso_id]:'.$pasoInscripcion['tipo_paso_id'].'<br>';
                            }


                            if ($pasoInscripcion['estado_uso'] == 'USER' || $pasoInscripcion['estado_uso'] == 'EXTERNAL') {
                                //agregar el titulo de los usuarios a la lista de registros
        // if ($inscripcion['id'] == 16) {
            // echo '2 pasoInscripcion:';
            // print_r($pasoInscripcion);
            // echo '2 totalValidadoresXI:';
            // print_r($totalValidadoresXI);
            // if (isset($inscripciones[$keyinscripciones]['validadoresXelPaso'])) {
            //     echo 'inscripciones[$ keyinscripciones][validadoresXelPaso]:';
            //     print_r($inscripciones[$keyinscripciones]['validadoresXelPaso']);
            // }
        // }
        // if ($inscripcion['id'] == 12) {         
        //     echo 'pasoInscripcion[tipo_paso_id]:';
        //     print_r($pasoInscripcion['tipo_paso_id']);
        // }
                                
                                if( isset($EstudiantesId[$inscripcion['id']]) && $pasoInscripcion['user_id'] == $EstudiantesId[$inscripcion['id']] ){
                                    $pasoInscripcion['user_titulo'] = 'Estudiante';
                                }elseif( isset($CoordinadoresExternosId[$inscripcion['id']]) && $pasoInscripcion['user_id'] == $CoordinadoresExternosId[$inscripcion['id']] ){
                                    $pasoInscripcion['user_titulo'] = 'Coordinador Externo';
                                }elseif( isset($CoordinadoresInternosId[$inscripcion['id']]) && $pasoInscripcion['user_id'] == $CoordinadoresInternosId[$inscripcion['id']] ){
                                    $pasoInscripcion['user_titulo'] = 'Coordinador Interno';
                                }else{
                                    $pasoInscripcion['user_titulo'] = 'Otro usuario';
                                }
                                /*
                                if($pasoInscripcion['tipo_paso_id'] <= 4){
                                    $keyValidacion = 1;
                                }else{
                                    $keyValidacion = 2;
                                }
                                */
                                
                                if ( $pasoInscripcion['estado_nombre'] != 'INCOMPLETO' ) {
                                    $inscripciones[$keyinscripciones]['pasos_registrados'] = $numero_paso[$pasoInscripcion['tipo_paso_id']]['orden'];
                                }
                                // if ( $pasoInscripcion['estado_uso'] == 'EXTERNAL' && in_array($pasoInscripcion['estado_nombre'], ['ACEPTADO','DECLINADO']) ) {
                                //     $inscripciones[$keyinscripciones]['validacion_coor_ext'] = $pasoInscripcion['estado_nombre'].': '.$pasoInscripcion['observacion'];
                                // }

                            }elseif($pasoInscripcion['estado_uso'] == 'VALIDATOR') {

                                if (count($totalValidadoresXI) >= 1) {
                                    $keyValidador = array_search($pasoInscripcion['user_id'], array_column($totalValidadoresXI, 'user_id'));
                                    $pasoInscripcion['user_titulo'] = $totalValidadoresXI[$keyValidador]['titulo'];
                                    
                                }else{
                                    $pasoInscripcion['user_titulo'] = 'VALIDADOR INDEFINIDO';
                                }
                                //agrega un elemento nuevo en el indice de validaciones de cada paso
                                // $inscripciones[$keyinscripciones]['pasos_inscripcion'][] = $pasoInscripcion;
                            }

                            //se obtiene la seccion a la que pertenece el paso registrado 
                            $pasoInscripcion['seccion'] = $numero_paso[$pasoInscripcion['tipo_paso_id']]['seccion'];
                            
                            //se registran y sobreescriben los registros por cada usuario quedando al final el ultimo 
                            // $inscripciones[$keyinscripciones]['pasos_inscripcion'][$pasoInscripcion['user_id']] = $pasoInscripcion; 
                            
                            $inscripciones[$keyinscripciones]['pasos_inscripcion'][] = $pasoInscripcion; 
                            

                            $ultimoRegistroPasos = $pasoInscripcion;


                            //asigna el nombre de la clase css para resaltar las inscripciones que son tareas pendientes para el usuario
                            if ($pasoInscripcion['user_id'] == $this->user->id) {
                                if ($pasoInscripcion['estado_uso'] == 'VALIDATOR' && in_array($pasoInscripcion['estado_nombre'], ['EN REVISIÓN','GENERAR DOCUMENTO','RECHAZADO'])) {
                                    $task_pending = 'task_pending';
                                }elseif( $pasoInscripcion['estado_uso'] != 'VALIDATOR' && $inscripciones[$keyinscripciones]['estado_id'] != $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id'] ){
                                    $task_pending = 'task_pending';
                                }else{
                                    $task_pending = '';
                                }
                                $yaValido = 1;
                                $pasoQueYaValido = $pasoInscripcion['tipo_paso_id'];

                            }elseif( $inscripciones[$keyinscripciones]['estado_id'] != $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id'] ){
                                // es validador pero no ha validado
                                if( $keyEsValidador !== false && $pasoInscripcion['estado_nombre'] == 'DECLINADO' ){
                                    $task_pending = '';
                                }elseif ( $keyEsValidador !== false && $yaValido == 0) {
                                    $task_pending = 'task_pending';
                                }elseif ( $keyEsValidador !== false && count($validadoresXelPaso) >= 1) {
                        
                                    //busca si existe el tipo_paso_id del registro del paso ($pasoInscripcion) en la lista de los validadores asignados al paso actual ($validadoresXelPaso)
                                    $existePasoAsignado = array_search($this->user->id, array_column($validadoresXelPaso, 'user_id'));

                                    //si el validador esta asignado al paso actual y no lo ha validado entonces tiene una tarea pendiente
                                    if ($existePasoAsignado !== false && $pasoQueYaValido != $pasoInscripcion['tipo_paso_id']) {
                                        $task_pending = 'task_pending';
                                    }elseif ($existePasoAsignado !== false && $pasoQueYaValido == $pasoInscripcion['tipo_paso_id']) {
                                        $task_pending = '';
                                    }

                                }elseif(  isset($CoordinadoresExternosId[$inscripcion['id']]) && isset($CoordinadoresInternosId[$inscripcion['id']]) ){
                                    if( $this->user->id == $CoordinadoresExternosId[$inscripcion['id']] || $this->user->id == $CoordinadoresInternosId[$inscripcion['id']] ){
                                        $task_pending = 'task_pending';
                                    }
                                }

                            }
                        }
                    }

                    //agrega el elemento task_pending al array de cada inscripcion para saber si resaltarlo o no
                    
                    $inscripciones[$keyinscripciones]['task_pending'] = $task_pending;
                    

                    if ($keyEsValidador !== false && $inscripciones[$keyinscripciones]['estado_id'] != $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id']) {
                        

                        $inscripciones[$keyinscripciones]['validador'] = true;
                    // }elseif( $this->user->id == $CoordinadoresExternosId[$inscripcion['id']] || array_search($roleCoordinadorExterno[$keyRoleCoorExt]['id'], $thisUserRoles) !== false ){
                    }elseif( isset($CoordinadoresExternosId[$inscripcion['id']]) && $this->user->id == $CoordinadoresExternosId[$inscripcion['id']] ){
                        $inscripciones[$keyinscripciones]['coordinador_externo'] = true;
                    // }elseif( $this->user->id == $CoordinadoresInternosId[$inscripcion['id']] || array_search($roleCoordinadorInterno[$keyRoleCoorInt]['id'], $thisUserRoles) !== false ){
                    }elseif( isset($CoordinadoresInternosId[$inscripcion['id']]) &&  $this->user->id == $CoordinadoresInternosId[$inscripcion['id']] ){
                        $inscripciones[$keyinscripciones]['coordinador_interno'] = true;
                    }elseif( isset($EstudiantesId[$inscripcion['id']]) &&  $this->user->id == $EstudiantesId[$inscripcion['id']] ){
                        $inscripciones[$keyinscripciones]['estudiante'] = true;
                    }
                    
                    //print_r($inscripciones[$keyinscripciones]);
                    
                    //filtra las validaciones que aprobaron o activaron la inscripcion
                    $validacionesAprobadas = array_filter($inscripciones[$keyinscripciones]['pasos_inscripcion'], function($var){
                        // Retorna siempre que el número entero sea par
                        return ($var['estado_nombre'] == 'APROBADO' || $var['estado_nombre'] == 'ACTIVA');
                    });


                    // obtiene el ultimo registro de los pasos de la inscripcion
                    if (count($inscripciones[$keyinscripciones]['pasos_inscripcion'])) {
                            // $ultimoRegistroPasos = end($inscripciones[$keyinscripciones]['pasos_inscripcion']);
// if ($inscripcion['id'] == 17) {
//     echo 'inscripciones[$keyinscripciones][pasos_inscripcion]:';
//     print_r($inscripciones[$keyinscripciones]['pasos_inscripcion']);
//     echo 'ultimoRegistroPasos:';
//     print_r($ultimoRegistroPasos);
// }

                            if ($ultimoRegistroPasos['estado_uso'] == 'USER') {
                                //busca si en el ultimo paso registrado por el estudiante hay validadores
                                // $keyHayValidadores = array_search($ultimoRegistroPasos['tipo_paso_id'], array_column($totalValidadoresXI, 'tipo_paso_id'));

                                if (isset($inscripciones[$keyinscripciones]['validadoresXelPaso'][$ultimoRegistroPasos['tipo_paso_id']])) {
                                    $continuarPaso = false;

                                }
                            }elseif ($ultimoRegistroPasos['estado_uso'] == 'VALIDATOR' ) {

                                if (!in_array($ultimoRegistroPasos['estado_nombre'], ['APROBADO','ACTIVA'])) {
                                    
                                    $continuarPaso = false;

                                }else{
                                    $validadoresPasoActual = $inscripciones[$keyinscripciones]['validadoresXelPaso'][$ultimoRegistroPasos['tipo_paso_id']] ?? [];
                                    $ultimoValidadorPasoActual = end($validadoresPasoActual);

// if ($inscripcion['id'] == 17) {
//     echo 'ultimoValidadorPasoActual:';
//     print_r($ultimoValidadorPasoActual);
// }
                                    if (count($validadoresPasoActual) && isset($ultimoValidadorPasoActual['user_id']) && $ultimoValidadorPasoActual['user_id'] != $ultimoRegistroPasos['user_id']) {
                                        
                                        $continuarPaso = false;
                                    }
                                }
                            }
                    }


        // echo '$ultimoRegistroPasos:';
        // print_r($ultimoRegistroPasos);
        // echo '$inscripciones[$keyinscripciones]["pasos_inscripcion"]:';
        // print_r($inscripciones[$keyinscripciones]['pasos_inscripcion']);
        // echo '$validacionesAprobadas:';
        // print_r($validacionesAprobadas);
            // $keyTotalValidadores = array_search($ultimoRegistroPasos['user_id'], array_column($totalValidadoresXI, 'id'));

                    if ($inscripciones[$keyinscripciones]['pasos_registrados'] < $inscripciones[$keyinscripciones]['total_pasos'] && $continuarPaso) {
                        
                        $paso_siguiente = intval( $inscripciones[$keyinscripciones]['pasos_registrados'] )+1;
                        $keyPasoSig = array_search($paso_siguiente, array_column($numero_paso, 'orden'));
                        
                        $inscripciones[$keyinscripciones]['estado_actual'] = 'Pendiente por continuar en el paso '. $paso_siguiente . ' "'. $numero_paso[$keys_numero_paso[$keyPasoSig]]['titulo'] .'"';
                        
                        // $inscripciones[$keyinscripciones]['estado_actual'] = 'Pendiente por continuar en el paso '. $inscripciones[$keyinscripciones]['pasos_registrados']+1;
                    }else{
                    // }elseif ($inscripciones[$keyinscripciones]['pasos_registrados'] == $inscripciones[$keyinscripciones]['total_pasos']) {

                        //si existen validadores asignados en este paso
                        if (isset($inscripciones[$keyinscripciones]['validadoresXelPaso'][$ultimoRegistroPasos['tipo_paso_id']])) {

                            $validadoresUltimoRegistro = $inscripciones[$keyinscripciones]['validadoresXelPaso'][$ultimoRegistroPasos['tipo_paso_id']];
// echo 'validadoresUltimoRegistro:';
// print_r($validadoresUltimoRegistro);
                            // echo 'pasoInscripcion[id]:'.$pasoInscripcion['inscripcion_id'].'<br>';
                            // print_r($inscripciones[$keyinscripciones]['pasos_inscripcion']);
                            if ($ultimoRegistroPasos['estado_nombre'] == 'GENERAR DOCUMENTO' && $ultimoRegistroPasos['user_id'] == $this->user->id) {
                                
                                $inscripciones[$keyinscripciones]['tipo_paso_id'] = $ultimoRegistroPasos['tipo_paso_id'];
                                $inscripciones[$keyinscripciones]['user_id'] = $ultimoRegistroPasos['user_id'];
                                $inscripciones[$keyinscripciones]['estado_id'] = $estadoValidacionActiva[$keyEstadoValidacion]['id'];
                                unset($inscripciones[$keyinscripciones]['archivo']);
                            }

                            // if (count($totalValidadoresXI) >= 1) {
                                $registroUnValidador = array_search($ultimoRegistroPasos['user_id'], array_column($validadoresUltimoRegistro, 'user_id'));
                                $keysValidadoresUltimoRegistro = array_keys($validadoresUltimoRegistro);

                                if ($registroUnValidador !== false) {
                                    $keyValidadoresUR = $keysValidadoresUltimoRegistro[$registroUnValidador];
                                    $inscripciones[$keyinscripciones]['estado_actual'] = $ultimoRegistroPasos['estado_nombre'].' por '.$validadoresUltimoRegistro[$keyValidadoresUR]['titulo'];
                                    
                                }else{
                                    $inscripciones[$keyinscripciones]['estado_actual'] = 'Pendiente por validación.';
                                }
                            // }else{
                            //     $inscripciones[$keyinscripciones]['estado_actual'] = $ultimoRegistroPasos['estado_nombre'].' por VALIDADOR INDEFINIDO';
                            // }
                            
                        }else{
                            $inscripciones[$keyinscripciones]['estado_actual'] = 'Pendiente por continuar.';
                        }
                    }
                    
                    $progresoActual = intval($inscripciones[$keyinscripciones]['pasos_registrados']);
                    $progresoActual += count($validacionesAprobadas);

                    $progresoTotal = intval($inscripciones[$keyinscripciones]['total_pasos']);
                    $progresoTotal += count($totalValidadoresXI);

                    $inscripciones[$keyinscripciones]['pasos_registrados'] = $progresoActual;
                    $inscripciones[$keyinscripciones]['total_pasos'] = $progresoTotal;

                    $inscripciones[$keyinscripciones]['progreso'] = intval( ($progresoActual * 100 ) / $progresoTotal );


                    foreach ($inscripciones[$keyinscripciones]['pasos_inscripcion'] as $key => $pasoRegistrado) {
                        if ($pasoRegistrado['estado_uso'] == 'USER' ) {
                            $inscripciones[$keyinscripciones]['participaciones']['USER'] = $pasoRegistrado;
                        }else{
                            $inscripciones[$keyinscripciones]['participaciones'][] = $pasoRegistrado;
                        }
                    }
                    // print_r($inscripciones[$keyinscripciones]['participaciones']);
                }
            // }
        }

        
        // print_r($inscripciones);

        $this->viewWith = array_merge($this->viewWith,['peticion' => $this->peticion, 'inscripciones' => $inscripciones, 'filter' => $filter, 'select_filter' => $select_filter]);
        
        // print_r($this->viewWith);

        return view('InterChange.index')
            ->with($this->viewWith);

    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function map(Request $request)
    {
        
        if ( strpos($this->tipoRuta, 'interout') !== false ) {
            return redirect('/html/interout-map.php');
        }
        if ( strpos($this->tipoRuta, 'interin') !== false ) {
            return redirect('/html/interin-map.php');
        }
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function list(Request $request)
    {
        return view('InterChange.create');
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function email(Request $request)
    {
        //EN REALIDAD NO ENVIARA E-MAILS, SOLO MOSTRARA INFORMACION Y EL PROCESO DE ENVIO DE E-MAILS SERA DE PARTE DEL TRAIT DE VALIDATOR

        //print_r($request->all());
        $tipo_paso = [];
        $archivosAdjuntos = '';
        $inscripcionId = '';
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $viewWith = $this->viewWith;
        $vista = 'emails.inscription.show';

        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }


        if (isset($request['inscripcionId'])) {

            $inscripcionId = $request['inscripcionId'];
        // }elseif( session('inscripcionId') != null ){
        //     $inscripcionId = session('inscripcionId');
        }else{
            
            //return '<hr> El e-mail no se encuentra, No existe la inscripcion.';
            $errors += 1;
            array_push($errorsMsg,'No se encuentra la inscripción.');
            goto end;
        }


        $inscripcion = $this->inscripcionRepository->findWithoutFail($inscripcionId);

        if (empty($inscripcion)) {
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra la inscripción.');
            goto end;
        }

        if ( isset($request['paso']) ) {

            $pasos_validacion = array_filter($this->tipos_pasos, function($var){
                return ($var['user_id'] != '');
            });

            $tipo_paso = [];

            foreach ($pasos_validacion as $key => $value) {

                if (count($tipo_paso) >= 1) {
                    $existe = array_search($value['id'], array_column($tipo_paso, 'id'));
                }else{
                    $existe = false;
                }
                if ($existe === false) {
                    $tipo_paso[] = $value;
                }
            }

        /*

            $tipo_paso = $this->tipoPaso->where('nombre', 'paso'.$request['paso'].'_interchange')->pluck('id');

            //muestra los datos de los e-mails registrados y los ordena desde el ultimo registrado hacia atras
            $dataEmail = DB::table('pasos_inscripcion')
                    ->join('pasos_inscripcion_email', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_email.pasos_inscripcion_id')
                    ->join('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
                    ->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                    ->where('pasos_inscripcion.inscripcion_id',$inscripcionId )
                    ->where('pasos_inscripcion.tipo_paso_id',$tipo_paso )
                    ->select('email.*','pasos_inscripcion.id AS pasos_inscripcion_id','pasos_inscripcion.observacion AS paso_observacion','estado.nombre AS estado_nombre')
                    ->orderBy('email.created_at','desc');
            //echo $dataEmail->toSql().' |$inscripcionId:'.$inscripcionId;
            $dataEmail = $dataEmail->get();


            if ( count($dataEmail) > 0 ) {
                if ( isset($request['enviar']) && !isset($request['tokenemail']) ) {
                    $request['tokenemail'] = $dataEmail[0]->tokenemail;
                }
        */
                
                // if ($dataEmail[0]->estado == '1') {
                //     $errors += 1;
                    // array_push($errorsMsg, 'El e-mail ya fue enviado.');
                //     goto end;
                // }
                
                
                // if ( isset($request['validar_estado']) ) {
                //     return $dataEmail[0];
                // }


                if ( isset($request['ver']) && !isset($request['enviar']) ) {
                    
                    // $vista = 'emails.inscription.show';
                    
                    $viewWith = array_merge($viewWith,$this->datosInscripcion($inscripcionId,'email','ver',$tipo_paso));
                    // $viewWith = array_merge($viewWith,$this->show($inscripcionId,'local'));

                    $viewWith = array_merge($viewWith, ['omitir_adjuntos' => true, 'omitir_collapse' => true, 'pasoMaximo' => $request['paso']]);
                    
                    if ($viewWith['estudianteId'] == $this->user->id){
                        $viewWith = array_merge($viewWith, ['editar_paso' => true]);
                    }elseif ($viewWith['postulanteId'] == $this->user->id){
                        $viewWith = array_merge($viewWith, ['editar_paso' => true]);
                    }

                    
                    return view($vista)->with($viewWith);

                }elseif ( isset($request['enviar']) && isset($request['tokenemail']) ) {
                    //no se va a usar esta funcion
        /*
                    $tipo_email = 'inscripcion';
                    $request['tipo_paso_id'] = $tipo_paso;
                    $request['dataEmail'] = $dataEmail;

                    $datosInscripcion = $this->datosInscripcion($inscripcionId,'email','ver',$tipo_paso);
                    $datosInscripcionKeys = array_keys($datosInscripcion);
                    //print_r($datosInscripcion['datainscripcion']);
                    foreach ($datosInscripcionKeys as $key) {
                        //echo '$key:'.$key.' <br>';
                        $request[$key] = $datosInscripcion[$key];
                    }

                    $enviarEmail = $this->enviarEmail($tipo_email, $request);
                    return $enviarEmail;
        */
                    return 'email() interchange enviar & tokenemail';
                }
        /*                
            }else{

                // $vista = 'emails.inscription.show_data';
                // $tipo_paso = 0;

                // $viewWith = $this->datosInscripcion($inscripcionId,'email','ver',$tipo_paso);

                // //print_r($viewWith);

                // return view($vista)->with($viewWith);
                // -----//-----

                $errors += 1;
                array_push($errorsMsg, 'El paso no tiene asociado algún e-mail.');
                goto end;

            }
        */


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
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function pdf($inscripcionId, Request $request)
    {
        $inscripcion = \App\Models\Inscripcion::find($inscripcionId);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripción');

            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        }else{
            $inscripcionId = $inscripcion->id;
        }

        $viewWith = $this->viewWith;
        $viewWith = array_merge($viewWith,$this->show($inscripcionId,'local'));
        $viewWith = array_merge($viewWith, ['peticion' => 'limpio']);
        $view = 'InterChange.show';
        //$view = 'welcome';
        
        //$pdf = PDF::loadView($view, $viewWith);
        //return $pdf->download('alliance-'.$inscripcionId.'.pdf');
        //return  PDF::loadView($view, $viewWith)->save( storage_path().'/alliance-'.$inscripcionId.'.pdf')->stream('alliance-'.$inscripcionId.'.pdf');
        if ( isset($request['tipo']) ) {
            if ( $request['tipo'] == 1 ) {
                return view($view)->with($viewWith);
            }elseif ( $request['tipo'] == 2 ) {
                return  PDF::loadView($view, $viewWith)->stream($this->tipoInterChange.'-'.$inscripcionId.'.pdf');
            }elseif ( $request['tipo'] == 3 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'basico']);
                //return view($view)->with($viewWith);
                return  PDF::loadView($view, $viewWith)->stream($this->tipoInterChange.'-'.$inscripcionId.'.pdf');
            }elseif ( $request['tipo'] == 4 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'ajax']);
                return  PDF::loadView($view, $viewWith)->stream($this->tipoInterChange.'-'.$inscripcionId.'.pdf');
            }
        }else{
            return  PDF::loadView($view, $viewWith)->stream($this->tipoInterChange.'-'.$inscripcionId.'.pdf');
        }
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function create($inscripcionId = '')
    {
        
        if ( strpos($this->tipoRuta, 'interout') !== false ) {
            // return redirect('/html/interout.php');
        }
        if ( strpos($this->tipoRuta, 'interin') !== false ) {
            // return redirect('/html/interin.php');
        }



        $tipoModalidad = 0;
        if ($this->tipoRuta == 'interchanges.interin.create') {
            $tipoModalidad = 1;
        }
        
        $clase_documento = \App\Models\ClaseDocumento::where('nombre','IDENTIDAD')->pluck('id');
        $estudiante_tipo_documento = \App\Models\TipoDocumento::where('clase_documento_id',$clase_documento)->pluck('nombre','id');
        if (session('campusApp') == null) {
            session(['campusApp' => $this->campusApp->first()->id]);
        }
        $estudiante_facultad = $this->facultad->where('campus_id',session('campusApp'))->pluck('nombre','id');
        $estudiante_programa =[];
        $inscripcion_periodo = \App\Models\Periodo::where('vigente','1')->pluck('nombre','id');
        $inscripcion_modalidad =\App\Models\Modalidades::where('tipo',$tipoModalidad)->select('nombre','id')->pluck('nombre','id');
        $inscripcion_institucion_destino =[];
        $inscripcion_pais =[];


        $viewWith = array_merge($this->viewWith,['paso' => '1','peticion' => $this->peticion ?? 'normal', 'paso_titulo' => $this->paso_titulo, 'estudiante_tipo_documento' => $estudiante_tipo_documento, 'estudiante_facultad' => $estudiante_facultad, 'estudiante_programa' => $estudiante_programa, 'inscripcion_periodo' => $inscripcion_periodo, 'inscripcion_modalidad' => $inscripcion_modalidad, 'inscripcion_institucion_destino' => $inscripcion_institucion_destino, 'inscripcion_pais' => $inscripcion_pais]); 

        if ( $inscripcionId != '' ) {
            $viewWith = array_merge($viewWith,['inscripcionId' => $inscripcionId]);
            return $viewWith;
        }else{
            return view('InterChange.create')->with($viewWith);
        }
    }

    /**
     * Store a newly created InterChange in storage.
     *
     * @param CreateInterChangeRequest $request
     *
     * @return Response
     */
    public function storeUpdate(Request $request, $tipo, $id = '',$tipoInterChange)
    {
        
        $input = $request->all();
        
        //print_r($input);

        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }
        $userId = $this->user->id;
        $msg = '';

        $inscripcion = '';
        $dataInscripcion = array();
        $inscripcionId = 0;
        $estudianteId = 0;
        $estudiante = '';
        $campusAppId = 0;
        $campusApp = 0;
        $campusId = 0;
        $paso = 0;
        $paso_id = 0;
        $redirect_url = '';
        $inscripcion_campus_id = 0;

        $tipos_pasos = $this->paso_titulo;

        $rolUsuario = 'estudiante';
        $crearTipo = 'nuevo';
        $estadoPaso = 'PENDIENTE POR REVISIÓN';
        $buscarPostulante = 0;
        $pasos_validacion = [];

        //arreglar lo de las movilidades para la inscripcion y para la inscripcion
        //- por ahora se separo en aplicaciones (antigua modalidad) y modalidades

        //verificar la ruta (interin o interout)
        if ($tipoInterChange == 'InterOut') {
            
        }elseif($tipoInterChange == 'InterIn'){

        }

        //verificar la existencia del intercambio
        if ($id != '') {
            $inscripcionId = $id;
        }elseif (isset($request['inscripcionId'])) {
            $inscripcionId = $request['inscripcionId'];
        }
        // elseif( session('inscripcionId') != null ){
        //     $inscripcionId = session('inscripcionId');
        // }

        if ($inscripcionId != 0) {
            
            $inscripcion = $this->inscripcionRepository->findWithoutFail($inscripcionId);

            if (!empty($inscripcion)) {
                $crearTipo = 'actualizar';
                $inscripcionId = $inscripcion->id;
                $estudianteId = $inscripcion->user_id;
                $inscripcion_campus_id = $inscripcion->campus_id;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
                goto end;
            }
        }
        $estadoActiva = \App\Models\Estado::where([['uso','PROCESS'],['nombre','ACTIVA']])->first();
        if ($inscripcionId != 0 && $inscripcion->estado_id == $estadoActiva->id ) {
            $errors += 1;
            array_push($errorsMsg, 'La movilidad esta activa, no se puede modificar');
            goto end;
        }

        $campusApp = $this->campusAppFound;

        if ( isset($request['modificar']) && isset($request['paso']) ) {
            $crearTipo = 'actualizar';
            $estadoPaso = 'ACTUALIZACIÓN DE DATOS';
            
            if( $inscripcionId == 0 ){
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
                goto end;
            }
        }

        if ( isset($request['paso']) && $request['paso'] != 1 && $inscripcionId == 0 ) {
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
            goto end;
        }

        $pasos_validacion = array_filter($this->tipos_pasos, function($var){
            return ($var['user_id'] != '');
        });

        $pasos_validacion_orden = array_unique(array_column($pasos_validacion, 'orden'));

        //verificar el rol del usuario, si es estudiante o coordinador_externo (si no es estudiante puede ser cualquiera que tenga los permisos para inscribir a un estudiante)

        // $rolePostulante = Role::where('name',$rolUsuario)->get();
        // if ( !$this->user->hasAllRoles($rolePostulante) ) {
        //     $rolUsuario = 'coordinador';
        // }


        if ($inscripcionId != 0) {


            //obtener los datos de los coordinadores de la inscripcion
            $rolesUsuarios = Role::whereIn('name',['coordinador_interno','coordinador_externo','estudiante','copia_oculta_email'])->select('id','name')->get()->toArray();
            $roleCoordinadorInterno = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'coordinador_interno');
            });
            $roleCoordinadorExterno = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'coordinador_externo');
            });
            $roleEstudiante = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'estudiante');
            });
            $roleCopiaEmails = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'copia_oculta_email');
            });
            reset($roleCoordinadorInterno);
            reset($roleCoordinadorExterno);
            reset($roleEstudiante);
            reset($roleCopiaEmails);
            $keyRoleCoorInt = key($roleCoordinadorInterno);
            $keyRoleCoorExt = key($roleCoordinadorExterno);
            $keyRoleEstudiante = key($roleEstudiante);
            $keyRoleCopiaEmail = key($roleCopiaEmails);

            $roleCoordinadorInternoId = $roleCoordinadorInterno[$keyRoleCoorInt]['id'];
            $roleCoordinadorExternoId = $roleCoordinadorExterno[$keyRoleCoorExt]['id'];
            $roleEstudianteId = $roleEstudiante[$keyRoleEstudiante]['id'];
            $roleCopiaEmailsId = $roleCopiaEmails[$keyRoleCopiaEmail]['id'];
            
            if ( $this->user->hasAllRoles($roleEstudianteId) ) {
                $rolUsuario = 'estudiante';
            }elseif ( $this->user->hasAllRoles($roleCoordinadorInternoId) ) {
                $rolUsuario = 'coordinador_interno';
            }elseif ( $this->user->hasAllRoles($roleCoordinadorExternoId) ) {
                $rolUsuario = 'coordinador_externo';
            }

            //---------------------------------
            //---------------------------------
            //---------------------------------
            //---------------------------------
            //SE QUITO EL CODIGO
            //---------------------------------
            //---------------------------------
            //---------------------------------
            //---------------------------------
            //---------------------------------
        }

        //verificar el paso

        $reglas = [];
        if ( isset($request['paso']) ) {

            $reglas_pasos = [];
            foreach ($this->numeros_pasos as $key => $numero_paso) {
                $numero_paso['reglas'] = json_decode($numero_paso['reglas'],true);
                $reglas_pasos[$key] = $numero_paso;
                
            }

          if ( $request['paso'] == '1' ) {
            $reglas = [
                'estudiante_nombres' => 'required|max:100',
                'estudiante_apellidos' => 'required|max:100',
                'estudiante_tipo_documento' => 'required',
                'estudiante_numero_documento' => 'required|max:45',
                'estudiante_email_personal' => 'required|max:191',
                'estudiante_codigo_institucion' => 'required|max:20',
                ];

            if ( isset($request['modificar']) ) {
                $reglas = array_merge($reglas, [
                'estudiante_email_institucion' => 'required|email|max:191',
                ] );
            }else{
                $reglas = array_merge($reglas, [
                'estudiante_email_institucion' => 'required|max:191|email|unique:users,email',
                ] );
            }
          }
          if ( $request['paso'] == '2' ) {
            
            $reglas = array_merge($reglas, [
                'estudiante_facultad' => 'required',
                'estudiante_programa' => 'required',
                'estudiante_promedio' => 'required|numeric|'.$reglas_pasos[$request['paso']]['reglas']['estudiante_promedio'] ?? '',
                'estudiante_porcentaje_creditos' => 'required|numeric|'.$reglas_pasos[$request['paso']]['reglas']['estudiante_porcentaje_creditos'] ?? '',
            ] );


          }
          if ( $request['paso'] == '3' ) {
              
            $reglas = array_merge($reglas, [
                'inscripcion_periodo' => 'required',
                'inscripcion_modalidad' => 'required',
                'inscripcion_pais' => 'required',
                'inscripcion_institucion_destino' => 'required',
            ] );


          }
          if ( $request['paso'] == '4' ) {
            
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
            ] );

          }
          if ( $request['paso'] == '5' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'estudiante_genero' => 'required|between:1,3',
                'estudiante_nacionalidad' => 'required',
                'estudiante_pasaporte' => 'required|max:45',
                'estudiante_exp_pasaporte' => 'required|date',
                'estudiante_vence_pasaporte' => 'required|date',
                'estudiante_telefono' => 'required|min:7|max:45',
                'estudiante_celular' => 'required|min:10|max:45',
                'estudiante_ciudad_residencia' => 'required',
                'estudiante_direccion' => 'required|max:150',
                'estudiante_codigo_postal' => 'required|integer|max:999999999999',
            ] );
            

          }
          if ( $request['paso'] == '6' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                // 'idioma' => 'required',
                // 'certificado' => 'required',
                // 'nombre_examen' => 'required',
                // 'nivel_alcanzado' => 'required',
            ] );
            

          }
          if ( $request['paso'] == '7' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'inscripcion_campus_destino' => 'required',
                'inscripcion_facultad_destino' => 'required',
                'inscripcion_programa_destino' => 'required',

/*
                'asignatura_local' => 'required',
                'codigo_asignatura_local' => 'required',
                'creditos_asignatura_local' => 'required',
                'asignatura_destino' => 'required',
                'codigo_asignatura_destino' => 'required',
                'creditos_asignatura_destino' => 'required',
*/
            ] );
            /*    
            //en el caso de que escojan la opcion Otro
            if ( $request['campus_destino'] == '999999' ) {

                $reglas = array_merge($reglas, [
                'campus_destino_otro' => 'required|max:100',
                ] );
            }
            //en el caso de que escojan la opcion Otro
            if ( $request['facultad_destino'] == '999999' ) {

                $reglas = array_merge($reglas, [
                'facultad_destino_otro' => 'required|max:100',
                ] );
            }
            //en el caso de que escojan la opcion Otro
            if ( $request['programa_destino'] == '999999' ) {

                $reglas = array_merge($reglas, [
                'programa_destino_otro' => 'required|max:100',
                ] );
            }
            */

          }
          if ( $request['paso'] == '8' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'contacto_nombres' => 'required|max:100',
                'contacto_apellidos' => 'required|max:100',
                'contacto_parentesco' => 'required|max:100',
                'contacto_email_personal' => 'required|email|max:191',
                'contacto_telefono' => 'required|min:7|max:45',
                'contacto_celular' => 'required|min:10|max:45',
                'contacto_ciudad_residencia' => 'required',
                'contacto_direccion' => 'required|max:150',
                'contacto_codigo_postal' => 'required|integer|max:999999999999',
            ] );
            

          }
          if ( $request['paso'] == '9' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'fuente_financia_nacional' => 'required|integer',
                'monto_financia_nacional' => 'required|integer',
                'incluye_fuente_internacional' => 'required',
                
            ] );

            if ($request['incluye_fuente_internacional'] == 'SI') {
                $reglas = array_merge($reglas, [
                    'fuente_financia_internacional' => 'required|integer',
                    'monto_financia_internacional' => 'required|integer',
                    
                ] );
                //en el caso de que escojan la opcion Otro
                if ( $request['fuente_financia_internacional'] == '999999' ) {

                    $reglas = array_merge($reglas, [
                    'fuente_financia_internacional_otro' => 'required|max:100',
                    ] );
                }
            }

          }
          if ( $request['paso'] == '10' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'presupuesto_hospedaje' => 'required|integer',
                'presupuesto_alimentacion' => 'required|integer',
                'presupuesto_transporte' => 'required|integer',
                'presupuesto_otros' => 'required|integer',
            ] );
            

          }
          if ( $request['paso'] == '11' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'archivo_documentos_soporte' => 'required|mimes:pdf,zip,rar',
            ] );
            

          }
          if ( $request['paso'] == '12' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
                'archivo_foto' => 'required|mimes:png,jpeg,jpg,bmp,svg,tif,tiff',
            ] );
            

          }
          if ( $request['paso'] == '13' ) {
            $reglas = array_merge($reglas, [
                'inscripcionId' => 'required',
            ] );
            

          }
        }else{
            $errors += 1;
            array_push($errorsMsg, 'No se han recibido datos validos.');
            goto end;
        }

        $this->validate($request, $reglas);
        
        
        
        //las facultades de destino seran asignadas por el coordinador externo
        
        DB::beginTransaction();


        /// INICIO PASO 1 
        /// INICIO PASO 1
        /// INICIO PASO 1

        /// INICIO PASO 5 
        /// INICIO PASO 5
        /// INICIO PASO 5

        //pre-registro
        if ( isset($request['paso']) && ($request['paso'] == '1' || $request['paso'] == '5') ) {
            //registrar el nuevo usuario [paso 1]
        
            //registrar/actualizar los datos personales del estudiante [paso 1/5]

                if ( $estudianteId != 0 ) {
                    $dataUser['id']= $estudianteId;
                }

                if ($request['paso'] == '1') {
                    
                    $dataUser['name']= $input['estudiante_nombres'];
                    $dataUser['email']= $input['estudiante_email_institucion'];
                    $dataUser['activo']= 0;
                    // crear password
                    $passwordEstudiante = str_random(8);
                    //no sera encriptado hasta que se envie el email
                    //$dataUser['password']= bcrypt( $passwordEstudiante );

                    $dataUser['password']= bcrypt($passwordEstudiante);
                    $dataUser['remember_token']= $passwordEstudiante;
                //datos personales del usuario
                    $dataDatosPersonalesOrigen['nombres']= $input['estudiante_nombres'];
                    $dataDatosPersonalesOrigen['apellidos']= $input['estudiante_apellidos'];
                    $dataDatosPersonalesOrigen['tipo_documento_id']= $input['estudiante_tipo_documento'];
                    $dataDatosPersonalesOrigen['numero_documento']= $input['estudiante_numero_documento'];
                    $dataDatosPersonalesOrigen['email_personal']= $input['estudiante_email_personal'];
                    $dataDatosPersonalesOrigen['codigo_institucion']= $input['estudiante_codigo_institucion'];

                }elseif ($request['paso'] == '5') {
                //datos personales del usuario

                    $dataDatosPersonalesOrigen['genero']= $input['estudiante_genero'];
                    $dataDatosPersonalesOrigen['nacionalidad_id']= $input['estudiante_nacionalidad'];
                    $dataDatosPersonalesOrigen['nro_pasaporte']= $input['estudiante_pasaporte'];
                    $dataDatosPersonalesOrigen['fecha_expedicion_pasaporte']= $input['estudiante_exp_pasaporte'];
                    $dataDatosPersonalesOrigen['fecha_vencimiento_pasaporte']= $input['estudiante_vence_pasaporte'];

                    $dataDatosPersonalesOrigen['telefono']= $input['estudiante_telefono'];
                    $dataDatosPersonalesOrigen['celular']= $input['estudiante_celular'];
                    $dataDatosPersonalesOrigen['ciudad_residencia_id']= $input['estudiante_ciudad_residencia'];
                    $dataDatosPersonalesOrigen['direccion']= $input['estudiante_direccion'];
                    $dataDatosPersonalesOrigen['codigo_postal']= $input['estudiante_codigo_postal'];
                }
                
            //verificar si ya es estudiante
            if ( $rolUsuario == 'estudiante' && isset($dataUser['id']) ) {

                $crearTipo = 'actualizar';
                
            }

            //en el caso de querer modificar los datos
            $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'estudiante',$campusApp->id,$dataDatosPersonalesOrigen,'');
            // Create the user

            if ( $crearUsuario === 'error_usuario' ) {

                $errors += 1;
                array_push($errorsMsg, 'No se puede crear el estudiante.');
                goto end;
            }elseif( $crearUsuario === 'error_datos_personales' ){
                $errors += 1;
                array_push($errorsMsg, 'No se pueden crear los datos personales del estudiante.');
                goto end;
            }elseif( $crearUsuario != false ){
                $estudianteId = $crearUsuario->id;
            }


            if ( in_array($rolUsuario, ['coordinador_interno','coordinador_externo']) ){

                $estudiante = $this->asociarUsuario('estudiante',$estudianteId,'estudiante',$campusAppId,'');
                    
                if ( $estudiante === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el estudiante.');
                    goto end;
                }elseif( $estudiante != false ){
                    $estudianteId = $estudiante->id;
                }


            }

            //datos para crear/actualizar la inscripcion (interchange)
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $dataInscripcion['tipo']= 0;
            if ($this->tipoInterChange == 'InterIn') {
                $dataInscripcion['tipo']= 1;
            }

            $dataInscripcion['user_id']= $estudianteId;
            $dataInscripcion['campus_id']= $campusApp->id;
            

            
            $paso = $request['paso'];


        }


        /// FIN PASO 1
        /// FIN PASO 1
        /// FIN PASO 1

        /// FIN PASO 5
        /// FIN PASO 5
        /// FIN PASO 5

        /// INICIO PASO 2
        /// INICIO PASO 2
        /// INICIO PASO 2

        if ( isset($request['paso']) && $request['paso'] == '2' ) {
            //registrar/actualizar la informacion academica del nuevo estudiante [paso 2/6]


            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            //datos personales del usuario
            $dataDatosPersonalesOrigen['promedio_acumulado']= $input['estudiante_promedio'];
            $dataDatosPersonalesOrigen['porcentaje_aprobado']= $input['estudiante_porcentaje_creditos'];
            $dataDatosPersonalesOrigen['estudiante_programa']= $input['estudiante_programa'];

            //datos para asociar al estudiante a un programa
            // $dataUser['programa_id'] = $input['estudiante_programa'];
            

            //en el caso de querer modificar los datos
            $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'estudiante',$campusApp->id,$dataDatosPersonalesOrigen,'');

            if ( $crearUsuario === 'error_usuario' ) {

                $errors += 1;
                array_push($errorsMsg, 'No se puede crear el estudiante.');
                goto end;
            }elseif( $crearUsuario === 'error_datos_personales' ){
                $errors += 1;
                array_push($errorsMsg, 'No se pueden crear los datos personales del estudiante.');
                goto end;
            }elseif( $crearUsuario === 'error_programa' ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede asociar el programa al estudiante.');
                goto end;
            }elseif( $crearUsuario != false ){
                $estudianteId = $crearUsuario->id;
            }


            //datos para actualizar la inscripcion (interchange)
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }
            $dataInscripcion['campus_id']= $campusApp->id;
            $dataInscripcion['user_id']= $estudianteId;
            $dataInscripcion['programa_origen_id']= $input['estudiante_programa'];
  

            $paso = $request['paso'];


        }
        /// FIN PASO 2
        /// FIN PASO 2
        /// FIN PASO 2

        /// INICIO PASO 3
        /// INICIO PASO 3
        /// INICIO PASO 3

        if ( isset($request['paso']) && $request['paso'] == '3' ) {
            //registrar/actualizar la informacion de movilidad [paso 3/7]
            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            // hallar el campus al que se va a asociar la inscripcion
            // $ciudades = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')->where('departamento.pais_id', $input['inscripcion_pais'])->pluck('ciudad.id');
            // $campus = Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')->where('institucion.id', $input['inscripcion_institucion_destino'])->whereIn('campus.ciudad_id', $ciudades);
            // se entrega como un array normal
            // $campus = $campus->pluck('campus.id');
            // se escoje el primer campus
            // $campusMovilidad = $campus[0];

            $inscripcion_periodo = \App\Models\Periodo::where([['vigente','1'],['id',$input['inscripcion_periodo']]])
                ->first();

            if (empty($inscripcion_periodo)) {
                $errors += 1;
                array_push($errorsMsg, 'El periodo escogido no es valido.');
                goto end;
            }else{
                $dataInscripcion['fecha_inicio'] = $inscripcion_periodo->fecha_desde;
                $dataInscripcion['fecha_fin'] = $inscripcion_periodo->fecha_hasta;
                
            }


            // $dataInscripcion['user_id']= $dataUser['id'];
            $dataInscripcion['periodo_id'] = $input['inscripcion_periodo'];
            // $dataInscripcion['campus_id']= $campusMovilidad;
            $dataInscripcion['institucion_destino_id'] = $input['inscripcion_institucion_destino'];
            $dataInscripcion['modalidad_id'] = $input['inscripcion_modalidad'];
  

            $paso = $request['paso'];


        }
        /// FIN PASO 3
        /// FIN PASO 3
        /// FIN PASO 3

        /// INICIO PASO 4
        /// INICIO PASO 4
        /// INICIO PASO 4

        /// INICIO PASO 13
        /// INICIO PASO 13
        /// INICIO PASO 13

        if ( isset($request['paso']) && ($request['paso'] == '4' || $request['paso'] == '13') ) {
            //enviar el email al validador 1 (Director de Programa) [paso 4]
            //enviar el email al validador 2 (Director de Programa) [paso 13]
        
            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            //filtra los pasos hasta antes del paso actual, $this->tipos_pasos es un query de la tabla tipo_paso con left join a user_tipo_paso y a model_has_roles para mostrar los validadores asociados
            $pasoRecibido = $request['paso'];
            $pasos_validacion = array_filter($this->tipos_pasos, function($var) use ($pasoRecibido) {
                return ($var['orden'] < $pasoRecibido);
            });

            //obtiene el registro de los pasos registrados por el usuario (estudiante o coordinador)
            $pasos_registrados = \App\Models\Validation\PasosInscripcion::join('estado','pasos_inscripcion.estado_id','estado.id')
                ->where('pasos_inscripcion.inscripcion_id',$inscripcionId)
                ->where('estado.uso', 'USER')
                ->select('pasos_inscripcion.tipo_paso_id')
                ->get()
                ->toArray();

            $tipos_pasos_registrados = array_column($pasos_registrados, 'tipo_paso_id');

            // si no se han registrado todos los pasos anteriores devuelve un mensaje de error
            foreach ($pasos_validacion as $key => $value) {

                $estaRegistrado = array_search($value['id'], $tipos_pasos_registrados);

                if ($estaRegistrado === false) {
                    $errors += 1;
                    array_push($errorsMsg, 'No ha registrado toda la información, es necesario que complete los datos que faltan.');
                    array_push($errorsMsg, 'El paso #'.$value['orden'].' - \''.$value['titulo'].'\' no aparece registrado.');
                    goto end;
                }
            }

            //ENVIAR EL EMAIL DEL PASO 4 O 13
            $request['origen_peticion'] = 'local';

            $enviarEmail = $this->email( $request );
            if (isset($enviarEmail['errors'])) {
                $errors += 1;
                $errorsMsg = array_merge($errorsMsg, $enviarEmail['returnMsg']);
                goto end;
            }else{
                array_push($okMsg,$enviarEmail);
            }

            
            
            if ($this->peticion == 'ajax') {
                $redirect_url = route('interchanges.'.strtolower($this->tipoInterChange).'.show',$inscripcionId);
                array_push($okMsg,' <input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.$redirect_url.'">');
            }

            // array_push($okMsg, 'Será notificado cuando haya una respuesta. <br>');

            
            $paso = $request['paso'];

        }
        /// FIN PASO 4
        /// FIN PASO 4
        /// FIN PASO 4

        /// FIN PASO 13
        /// FIN PASO 13
        /// FIN PASO 13


        /// INICIO PASO 6
        /// INICIO PASO 6
        /// INICIO PASO 6

        
        if ( isset($request['paso']) && $request['paso'] == '6' ) {
            //registrar/actualizar la informacion academica del nuevo estudiante [paso 2/6]
            
             $userIdiomas = \App\Models\Admin\UserIdiomas::join('tipo_idioma','user_idiomas.tipo_idioma_id','tipo_idioma.id')
                ->join('nivel','user_idiomas.nivel_id','nivel.id')
                ->where('user_idiomas.user_id',$estudianteId)->select('user_idiomas.*')
                ->get()->toArray();

            if (empty($userIdiomas)) {
                $errors += 1;
                array_push($errorsMsg, 'El estudiante no tiene idiomas registrados, es necesario que registre por lo menos uno.');
                goto end;
            }


            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }        

        /// FIN PASO 6
        /// FIN PASO 6
        /// FIN PASO 6



        /// INICIO PASO 7
        /// INICIO PASO 7
        /// INICIO PASO 7

        //registrar/actualizar la informacion de movilidad [paso 7]

        if ( isset($request['paso']) && $request['paso'] == '7' ) {
            

            $programa = \App\Models\Admin\Programa::find($request['inscripcion_programa_destino']);

            if (empty($programa)) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro el programa enviado, es necesario que escoja un programa valido.');
                goto end;
            }

            $dataInscripcion['programa_destino_id']= $programa->id;

            //registrar/actualizar las asignaturas a cursar (equivalentes) [paso 7]









            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }


        

        /// FIN PASO 7
        /// FIN PASO 7
        /// FIN PASO 7

        //registro
        /// INICIO PASO 7
        /// INICIO PASO 7
        /// INICIO PASO 7

        //registrar/actualizar la informacion de movilidad [paso 7]

        if ( isset($request['paso']) && $request['paso'] == '7' ) {
            

            $programa = \App\Models\Admin\Programa::find($request['inscripcion_programa_destino']);

            if (empty($programa)) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro el programa enviado, es necesario que escoja un programa valido.');
                goto end;
            }

            $dataInscripcion['programa_destino_id']= $programa->id;

            //registrar/actualizar las asignaturas a cursar (equivalentes) [paso 7]









            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }


        

        /// FIN PASO 7
        /// FIN PASO 7
        /// FIN PASO 7

        

        /// INICIO PASO 8
        /// INICIO PASO 8
        /// INICIO PASO 8

        
        if ( isset($request['paso']) && $request['paso'] == '8' ) {
            //registrar/actualizar los datos de contacto en caso de emergencia del estudiante [paso 8]
                // if ( $estudianteId != 0 ) {
                //     $dataUser['id']= $estudianteId;
                // }

            if ( $estudianteId != 0 && $inscripcionId != 0 ) {

                $contacto = DB::table('user_contacto')->join('inscripcion','user_contacto.user_id','inscripcion.user_id')
                    ->where('inscripcion.user_id',$estudianteId)
                    ->where('inscripcion.id',$inscripcionId)
                    ->select('user_contacto.*')->first();
                
                if (isset($contacto->contacto_id)) {
                    $dataUser['id'] = $contacto->contacto_id;
                    $crearTipo = 'actualizar';
                }else{
                    $crearTipo = 'nuevo';
                }

            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante o la inscripción para crear el contacto.');
                goto end;
            }

            $dataUser['user_id'] = $estudianteId;
            $dataUser['name']= $input['contacto_nombres'].' '.$input['contacto_apellidos'];
            $dataUser['email']= $input['contacto_email_personal'];
            $dataUser['activo']= 0;
            // crear password
            $passwordContacto = str_random(8);
            //no sera encriptado hasta que se envie el email
            //$dataUser['password']= bcrypt( $passwordContacto );

            $dataUser['password']= bcrypt($passwordContacto);
            $dataUser['remember_token']= $passwordContacto;
            

            //datos personales del usuario
            
            $dataDatosPersonalesOrigen['nombres']= $input['contacto_nombres'];
            $dataDatosPersonalesOrigen['apellidos']= $input['contacto_apellidos'];
            $dataDatosPersonalesOrigen['email_personal']= $input['contacto_email_personal'];
            $dataDatosPersonalesOrigen['telefono']= $input['contacto_telefono'];
            $dataDatosPersonalesOrigen['celular']= $input['contacto_celular'];
            $dataDatosPersonalesOrigen['ciudad_residencia_id']= $input['contacto_ciudad_residencia'];
            $dataDatosPersonalesOrigen['direccion']= $input['contacto_direccion'];
            $dataDatosPersonalesOrigen['codigo_postal']= $input['contacto_codigo_postal'];

            $dataDatosPersonalesOrigen['contacto_parentesco']= $input['contacto_parentesco'];

            //en el caso de querer modificar los datos
            $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'contacto',$campusApp->id,$dataDatosPersonalesOrigen,'');
            // Create the user

            if ( $crearUsuario === 'error_usuario' ) {

                $errors += 1;
                array_push($errorsMsg, 'No se puede crear al contacto.');
                goto end;
            }elseif( $crearUsuario === 'error_datos_personales' ){
                $errors += 1;
                array_push($errorsMsg, 'No se pueden crear los datos personales del contacto.');
                goto end;
            }elseif ( $contacto === 'error_asociar' ) {
                $errors += 1;
                array_push($errorsMsg, 'No se pueden asociar los datos del contacto al estudiante.');
                goto end;
            }elseif ( $contacto === 'error_contacto' ) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro al contacto.');
                goto end;
            }elseif( $crearUsuario != false ){
                $contactoId = $crearUsuario->id;
            }


            if ($crearTipo == 'actualizar') {
                $datos['user_id'] = $estudianteId;
                $datos['contacto_id'] = $contactoId;
                $datos['contacto_parentesco'] = $input['contacto_parentesco'];
                $contacto = $this->asociarUsuario('contacto',$datos,'contacto',$campusAppId,'');
                    
                if ( $contacto === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro al estudiante.');
                    goto end;
                }elseif ( $contacto === 'error_contacto' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro al contacto.');
                    goto end;
                }elseif( $contacto != false ){
                    $contactoId = $contacto->id;
                }
            }
            

            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }        

        /// FIN PASO 8
        /// FIN PASO 8
        /// FIN PASO 8



        /// INICIO PASO 9
        /// INICIO PASO 9
        /// INICIO PASO 9

        
        if ( isset($request['paso']) && $request['paso'] == '9' ) {
            //registrar/actualizar las fuentes de financiacion (nacional/internacional) [paso 9]
            
            //registrar la fuente de financiacion nacional
            $fuenteFinanciacionNac = \App\Models\FuenteFinanciacion::where([['id',$input['fuente_financia_nacional'],['tipo',0]]])->first();

            if (empty($fuenteFinanciacionNac)) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro la fuente de financiación nacional escogida.');
                goto end;
            }

            //busca las fuentes de financiacion registradas previamente en la inscripcion
            $financiacionesExistentes = \App\Models\Financiacion::join('fuente_financiacion','financiacion.fuente_financiacion_id','fuente_financiacion.id')->where('inscripcion_id',$inscripcionId)->select('financiacion.id AS financiacion_id','fuente_financiacion.*')->get()->toArray();

            $financiacionNacionalId = 0;
            $financiacionInternacionalId = 0;
            //obtiene los id's de los registros de las fuentes nacional e internacional en la tabla financiacion
            if (!empty($financiacionesExistentes)) {
                foreach ($financiacionesExistentes as $key => $financiacion) {
                    if ($financiacion['tipo'] == 0 ) {
                        $financiacionNacionalId = $financiacion['financiacion_id'];
                    }elseif ($financiacion['tipo'] == 1 ) {
                        $financiacionInternacionalId = $financiacion['financiacion_id'];
                    }
                }
            }
            //actualiza o crea el registro con los datos de la fuente de financiacion nacional
            $financiacionNac = \App\Models\Financiacion::updateOrCreate( 
                ['id' => $financiacionNacionalId, 'inscripcion_id' => $inscripcionId],
                ['fuente_financiacion_id' => $fuenteFinanciacionNac->id, 'monto' => $input['monto_financia_nacional']]
            );


            if ( $financiacionNac ){
                // return $financiacionNac;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se pudo registrar la financiación nacional.');
                goto end;
            }

            //registrar la fuente de financiacion internacional
            if ($request['incluye_fuente_internacional'] == 'SI') {
                //busca o crea el registro de la fuente de financiacion internacional
                if ($input['fuente_financia_internacional'] != '999999') {
                    $fuenteFinanciacionInter = \App\Models\FuenteFinanciacion::find($input['fuente_financia_internacional']);
                }else{
                    $fuenteFinanciacionInter = \App\Models\FuenteFinanciacion::create(['nombre' => $input['fuente_financia_internacional_otro'], 'tipo' => 1]);
                }

                if (empty($fuenteFinanciacionInter)) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se pudo encontrar o crear la fuente de financiación internacional escogida.');
                    goto end;
                }

                //actualiza o crea el registro con los datos de la fuente de financiacion internacional

                $financiacionInter = \App\Models\Financiacion::updateOrCreate( 
                    ['id' => $financiacionInternacionalId, 'inscripcion_id' => $inscripcionId],
                    ['fuente_financiacion_id' => $fuenteFinanciacionInter->id, 'monto' => $input['monto_financia_internacional']]
                );

                if ( $financiacionInter ){
                    // return $financiacionInter;
                }else{
                    $errors += 1;
                    array_push($errorsMsg, 'No se pudo registrar la financiación nacional.');
                    goto end;
                }
            }


            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }        

        /// FIN PASO 9
        /// FIN PASO 9
        /// FIN PASO 9
        
        /// INICIO PASO 10
        /// INICIO PASO 10
        /// INICIO PASO 10

        //registrar/actualizar el presupuesto [paso 10]

        if ( isset($request['paso']) && $request['paso'] == '10' ) {
            

            $dataInscripcion['presupuesto_hospedaje'] = $input['presupuesto_hospedaje'];
            $dataInscripcion['presupuesto_alimentacion'] = $input['presupuesto_alimentacion'];
            $dataInscripcion['presupuesto_transporte'] = $input['presupuesto_transporte'];
            $dataInscripcion['presupuesto_otros'] = $input['presupuesto_otros'];

            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }

       

        /// FIN PASO 10
        /// FIN PASO 10
        /// FIN PASO 10

        

        
        /// INICIO PASO 11
        /// INICIO PASO 11
        /// INICIO PASO 11

        /// INICIO PASO 12
        /// INICIO PASO 12
        /// INICIO PASO 12

        /// INICIO PASO 14
        /// INICIO PASO 14
        /// INICIO PASO 14


        if ( isset($request['paso']) && ($request['paso'] == '11' || $request['paso'] == '12' || $request['paso'] == '14') ) {
            //registrar/actualizar el archivo con los documentos de soporte (solo uno) [paso 11]
            //registrar/actualizar la foto [paso 12]

            if ($request['paso'] == '11') {
                $tipo_documento_nombre = 'DOCUMENTOS SOPORTE';
                // $archvo_input = $request['archivo_documentos_soporte'];
                $nombre_archvo_input = 'archivo_documentos_soporte';
            }elseif ($request['paso'] == '12') {
                $tipo_documento_nombre = 'FOTO';
                // $archvo_input = $request['archivo_foto'];
                $nombre_archvo_input = 'archivo_foto';
            }elseif ($request['paso'] == '14') {
                $tipo_documento_nombre = 'DOCUMENTOS FINALES INSCRIPCION';
                // $archvo_input = $request['archivo_foto'];
                $nombre_archvo_input = 'archivo_documentos_finales';
            }
            
            $tipo_documento = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                ->where([['tipo_documento.nombre',$tipo_documento_nombre],['clase_documento.nombre','INSCRIPCION']])
                ->pluck('tipo_documento.id')->first();

            //cargar el archivo de soporte
            if ( $request->file($nombre_archvo_input) ) {

    
                $request['tipo_documento'] = $tipo_documento;
                $request['archivo_contenido'] = '';
                $request['peticion'] = 'local';

                $route = route('admin.institutions.documents',$inscripcionId);

                $this->user = Auth::user();

                $datos['nombre'] = str_replace(' ', '_', $request->file($nombre_archvo_input)->getClientOriginalName());
                $datos['archivo_formato'] = $request->file($nombre_archvo_input)->getClientOriginalExtension();
                $datos['archivo_MimeType'] = $request->file($nombre_archvo_input)->getClientMimeType();

                if ($request['paso'] == '11') {
                    $request['archivo_documentos_soporte'] = \File::get($request->file($nombre_archvo_input));
                }elseif ($request['paso'] == '12') {
                    $request['archivo_foto'] = \File::get($request->file($nombre_archvo_input));
                }

                $proceso = 'inscripcion';
                $datos['inscripcionId'] = $inscripcionId;
                $datos['peticion'] = 'local';
                $datos['user_id'] = $this->user->id;
                $datos['route'] = $route;
                $datos['nombre'] = $request['nombre'] ?? $datos['nombre'];
                $datos['archivo_contenido'] = $request['archivo_contenido'];

                //si no se envia el archivo desde el $request no lo toma bien, lo toma como string
                if ($request['paso'] == '11') {
                    $datos['archivo_input'] = $request['archivo_documentos_soporte'];
                }elseif ($request['paso'] == '12') {
                    $datos['archivo_input'] = $request['archivo_foto'];
                }elseif ($request['paso'] == '14') {
                    $datos['archivo_input'] = $request['archivo_documentos_finales'];
                }

                $datos['tipo_documento'] = $request['tipo_documento'];
                //unique se coloca si debe eliminar los demas archivos del mismo tipo, de lo contrario se omite
                $datos['unique'] = true;
                
                
                $crearDocumento = $this->datosCrearDocumento($proceso,$datos);
                if (is_string($crearDocumento) ) {
                    $errors += 1;
                    array_push($errorsMsg, 'Ocurrio un error: '.$crearDocumento);
                    goto end;
                }else{
                    if ($request['paso'] == '11') {
                        $msg .= 'El documento fue almacenado correctamente. <br>';
                    }elseif ($request['paso'] == '12'){
                        $msg .= 'La foto fue almacenada correctamente. <br>';
                    }elseif ($request['paso'] == '14'){
                        $msg .= 'El documento fue almacenado correctamente. <br>';
                    }
                }

                
                
            }else{

                $existeArchivoSoporte = \App\Models\DocumentosInscripcion::join('archivo','documentos_inscripcion.archivo_id','archivo.id')->where([['documentos_inscripcion.inscripcion_id',$inscripcionId],['documentos_inscripcion.tipo_documento_id',$tipo_documento]])->select('documentos_inscripcion.id')->first();

                if ( !count($existeArchivoSoporte) ) {
                    $errors += 1;
                    if ($request['paso'] == '11') {
                        array_push($errorsMsg, 'No se recibio el archivo con los documentos de soporte.');
                    }elseif ($request['paso'] == '12'){
                        array_push($errorsMsg, 'No se recibio el archivo con la foto.');
                    }elseif ($request['paso'] == '14'){
                        array_push($errorsMsg, 'No se recibio el archivo con los documentos finales.');
                    }
                    goto end;
                }
                        
            }

            if ($this->peticion == 'ajax' && $request['paso'] == '14' ) {
                $redirect_url = route('interchanges.'.strtolower($this->tipoInterChange).'.index');
                array_push($okMsg,' <input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.$redirect_url.'">');
            }

            //datos para actualizar la inscripcion
            if ( $inscripcionId != 0 ) {
                $dataInscripcion['id']= $inscripcionId;
            }

            $paso = $request['paso'];

        }

       

        /// FIN PASO 11
        /// FIN PASO 11
        /// FIN PASO 11

        /// FIN PASO 12
        /// FIN PASO 12
        /// FIN PASO 12

        /// FIN PASO 14
        /// FIN PASO 14
        /// FIN PASO 14

        //enviar el email al Director de Programa (validador 2) [paso 13]
            //SE ESTA EJECUTANDO EN EL MISMO LUGAR DEL PASO 4 ↑↑↑↑

            // si aprueba el Director de Programa se envia un email a la ORII (validador 3)
                // si aprueba la ORII se envia un email a la Universidad/Institución de destino (validador 4)
                    // si aprueba la Universidad/Institución de destino se envia un email a todos los anteriores y el estudiante podra cargar los documentos finales para legalizar la movilidad y se notifica a la ORII (validador 3)

        //el estudiante podra cargar los documentos finales [paso 14]
            //SE ESTA EJECUTANDO EN EL MISMO LUGAR DEL PASO 11 y 12 ↑↑↑↑


                        // si aprueba la ORII se envia un email a la Vicerrectoría Académica (VRAC) (validador 5)
                            // si aprueba la VRAC se envia un email a la Oficina de Admisiones y Registro (OAR) (validador 6) (tal vez la OAR no sea un validador, solo se notifica y ya)
                                // FIN, se envia un email a todos los interesados, el estudiante puede ir a hacer su movilidad


            //si alguno no aprueba o pide modificacion se envia correo de respuesta a todos los interesados

        //link para generar pdf con el resumen de la postulacion [paso 15]





        if ( isset($request['paso']) && $paso != 0 && $estudianteId != 0 ) {

            if ( count($dataInscripcion) > 0 ) {
            
                //se crea/actualiza la inscripcion con los datos disponibles
                $crearInscripcion = $this->crearInscripcion($crearTipo,$dataInscripcion,$rolUsuario);

                if ( $crearInscripcion === 'error_inscripcion' ) {

                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear la inscripción.');
                    goto end;
                }elseif( $crearInscripcion != false ){
                    $inscripcionId = $crearInscripcion->id;
                }
            }




            // if (!in_array($request['paso'], [4,12,13,14])) {

                //GUARDAR EL PASO
                if ($paso_id == 0) {
                    $tipo_paso_id = 0;

                    $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$inscripcionId,$campusApp->id);
                    if ( !$crearPaso ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede guardar el paso \''.$tipos_pasos[$request['paso']].'\' del intercambio.');
                        goto end;
                    }else{
                        $tipo_paso_id = $crearPaso->tipo_paso_id;
                        
                    }
                }

            // }else

            // if (!in_array($request['paso'], [3,12])) {
                
            //     //GUARDAR EL PASO 
            //     $estadoPaso = 'INCOMPLETO';
            //     //los pasos que deben tener validadores son 4 y 15 y se crea en el 3 y 14 por eso se suma 1
            //     $numero_paso = intval($request['paso']) + 1;
            //     $tipo_paso = $this->tipoPaso->where('nombre','paso'.$numero_paso.'_interchange')->pluck('id')->first();
            //     if ( isset($request['modificar']) ) {
                    
            //         $dataEmail = DB::table('pasos_inscripcion')
            //             ->join('pasos_inscripcion_email', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_email.pasos_inscripcion_id')
            //             ->join('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
            //             ->where('pasos_inscripcion.inscripcion_id',$inscripcionId )
            //             ->where('pasos_inscripcion.tipo_paso_id',$tipo_paso )
            //             ->select('pasos_inscripcion.id AS pasos_inscripcion_id','email.id')
            //             ->orderBy('email.created_at','desc');
            //         //echo $dataEmail->toSql().' |$inscripcionId:'.$inscripcionId.' |$tipo_paso:'.$tipo_paso;
            //         $dataEmail = $dataEmail->get();
                                    
            //         $crearPaso = true;

            //     }else{
            //         $crearPaso = $this->crearPaso($numero_paso,$estadoPaso,$inscripcionId,$campusApp->id);
                    
            //         $idPaso = $crearPaso->id;

            //     }


            //     if ( $crearPaso ){

            //         $email_id = 0;
            //         $crearTipoMail = $crearTipo;
            //         if ( isset($request['modificar']) ) {
            //             if ( count($dataEmail) ) {
            //                 $email_id = $dataEmail[0]->id;
            //                 $idPaso = $dataEmail[0]->pasos_inscripcion_id;
            //             }else{
            //                 $crearPaso = $this->crearPaso($numero_paso,$estadoPaso,$inscripcionId,$campusApp->id);
                    
            //                 $idPaso = $crearPaso->id;
            //                 $crearTipoMail = 'nuevo';
            //             }
            //         }
            //         //notificar al validador en caso que este asociado al paso 

            //         $validadorId = \App\Models\Validation\UserPaso::where([['campus_id',$campusApp->id],['tipo_paso_id',$crearPaso->tipo_paso_id],['orden',1])->pluck('user_id')->first();

            //         //solo se creara el registro y se asociaran los archivos adjuntos
            //         $tipo_email = 'inscripcion';
            //         $datos['crearTipo'] = $crearTipoMail;
            //         $datos['estadoPaso'] = $estadoPaso;
            //         $datos['id'] = $email_id;
            //         $datos['user_id'] = $validadorId;
            //         $datos['paso'] = $idPaso;
            //         $datos['to'][0] = '';
            //         $datos['cc'][0] = '';
            //         $datos['bcc'][0] = '';
                    
            //         $datos['subject'] = '';
            //         $msj_header_text = '';
            //         $datos['content'] = '';
                    
            //         $datos['archivosAdjuntos'] = 0;
            //         if ( isset($input['enviar_documentos']) ) {
            //             $datos['archivosAdjuntos'] = $input['enviar_documentos'];
            //         }

                    

            //         //$crearEmail = $this->crearEmail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);
            //         $crearEmail = $this->crearEmail($tipo_email,$datos);
                    
            //         if ( $crearEmail === 'error_email' ) {
            //             $errors += 1;
            //             array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la inscripción.');
            //             goto end;
            //         }elseif ( $crearEmail === 'error_paso' ) {
            //             $errors += 1;
            //             array_push($errorsMsg, 'No se encontro el paso de la inscripción para crear el el pre-registro del mail.');
            //             goto end;
            //         }elseif ( $crearEmail == 'error_user' ) {
            //             $retorno = $crearEmail;
            //             $errors += 1;
            //             array_push($returnMsg, 'No se encuentra el usuario, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador externo.');
            //             goto end;
            //         }elseif ( $crearEmail == 'error_tipo_email' || $crearEmail == 'error_crear_tipo' ) {
            //             $retorno = $crearEmail;
            //             $errors += 1;
            //             array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador.');
            //             goto end;
            //         }elseif ( $crearEmail === false ) {
            //             $errors += 1;
            //             array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la inscripción.');
            //             goto end;
            //         }


            //     }else{
            //         $errors += 1;
            //         array_push($errorsMsg, 'No se puede actualizar el pre-registro del paso \''.$tipos_pasos[$request['paso']].'\' de la inscripcion.');
            //         goto end;
            //     }

            // }else
            if (in_array($request['paso'], $pasos_validacion_orden)) {
                

                //cualquier validacion
                if ( $crearPaso ){
                    //notificar a el validador en caso que este asociado al paso 

                    //datos del ultimo registro del paso (Pasosinscripcion)
                    $datosNotificar['paso_id'] = $crearPaso->id;
                    $datosNotificar['paso_proceso_id'] = $crearPaso->id;
                    $datosNotificar['tipo_paso_id'] = $crearPaso->tipo_paso_id;
                    $datosNotificar['estado_id'] = $crearPaso->estado_id;
                    $datosNotificar['inscripcion_id'] = $crearPaso->inscripcion_id;
                    $datosNotificar['user_id'] = $crearPaso->user_id;
                    $datosNotificar['observacion'] = $crearPaso->observacion;

                    $datosNotificar['paso'] = $request['paso'];
                    $datosNotificar['accion'] = 'creacion';
                    //$datosNotificar['tipo_paso_id'] = $tipo_paso_id;
                    $datosNotificar['campus_id'] = $inscripcion_campus_id;
                    $datosNotificar['inscripcionId'] = $inscripcionId;
                    $datosNotificar['user_name'] = $this->user->name;
                    $datosNotificar['user_email'] = $this->user->email;

                    $notificarValidador = $this->notificarValidador('inscripcion', $datosNotificar);

                    if (is_array($notificarValidador) && $notificarValidador['ok'] === false) {
                        $errors += 1;
                        $errorsMsg = array_merge($errorsMsg, $notificarValidador['returnMsg']);
                        goto end;
                    }elseif( $notificarValidador === false ){
                        //continua normalmente
                        $errors += 1;
                        $errorsMsg = array_merge($errorsMsg, 'Ocurrio un error al notificar al validador');
                        goto end;
                    }
                    
                    array_push($okMsg,$notificarValidador);
                    

                    array_push($okMsg, 'Será notificado cuando haya una respuesta. <br>');


                }else{
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede actualizar el pre-registro del paso \''.$tipos_pasos[3].'\' de la inscripcion.');
                    goto end;
                }
            }

            //se regresa el id del usuario estudiante creado para poder modificarlo
            array_push($okMsg,'<input type=\'hidden\' class=\'dato_adicional\' name=\'inscripcionId\' value=\''.$inscripcionId.'\'> <input type=\'hidden\' name=\'modificar\' value=\'1\'>');
        }

        end:

        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();
            if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                flash()->error($errorsMsg);
            }
        }elseif ($paso == 0 ) {
            if ($this->peticion == 'ajax') {
                return Response::json(['No se recibieron datos'], 422);
            }else{
                Flash::error('No se recibieron datos');
            }
        }else{
            //simplemente se actualiza un campo cualquiera para que cambie la fecha de actualizacion
            $actualizar_inscripcion = \App\Models\Inscripcion::where('id',$inscripcionId)->update(['id' => $inscripcionId]);

            DB::commit();

            if ( isset($request['modificar']) ) {
                $msg .= 'Se actualizaron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente! <br/>';
            }else{
                $msg .= 'Se registraron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente! <br/>';
            }
            array_push($okMsg,$msg);
            
            if ($this->peticion != 'ajax') {
                foreach ($okMsg as $key => $value) {
                    $pos = strpos($value, '<input');
                    if ($pos === false) { 
                        $value = str_replace('<br>', '', $value);
                        $msg .= $value.' <br>';
                    }
                }
                Flash::success($msg);
            }else{
                //por no tener la clase dato_adicional solo estara en el formulario actual y no en el siguiente
                
                $msgFlash = '';
                if ($redirect_url != '') {
                    foreach ($okMsg as $key => $value) {
                        $pos = strpos($value, '<input');
                        if ($pos === false) { 
                            $value = str_replace('<br>', '', $value);
                            $msgFlash .= $value.' <br>';
                        }
                    }
                    Flash::success($msgFlash);
                }
                return Response::json($okMsg);
            }
            //echo 'correcto <br>';
        }


        //LLEGARA AQUI SI NO ES DE TIPO AJAX LA PETICION
        if ($errors > 0 || $paso == 0) {
            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.show',$inscripcionId));
        }else{
            if ( in_array($request['paso'],$pasos_validacion_orden) ) {
                return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
            }else{
                return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.show',$inscripcionId));
            }
        }
    }

    /**
     * Store a newly created InterChange in storage.
     *
     * @param CreateInterChangeRequest $request
     *
     * @return Response
     */
    public function store(CreateInscripcionRequest $request)
    {
        /*
        $input = $request->all();

        $inscripcion = $this->inscripcionRepository->create($input);

        Flash::success('Inter Change saved successfully.');

        return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        */

        return $this->storeUpdate($request, 'store', '',$this->tipoInterChange);
    }


    /**
     * Display the specified InterChange.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id, $peticion = '')
    {


        if ( strpos($this->tipoRuta, 'interout') !== false ) {
            // return redirect('/html/interout.php');
        }
        if ( strpos($this->tipoRuta, 'interin') !== false ) {
            // return redirect('/html/interin.php');
        }

        $inscripcionId = 0;
        $dataInscripcion = '';
        $dataUsers = 0;
        $pasoInscripcion = '';
        $archivosAdjuntos = '';
        $estudiante = 0;
        $viewWith = $this->viewWith ;

        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            if ($this->peticion != 'local') {
                Flash::error('Inscripcion no encontrada');

                return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
                
            }else{
                return 'error_inscripcion';
            }
        }else{
            $inscripcionId = $inscripcion->id;

            if ($this->tipoInterChange == '') {
                $tipoInterChange = ($inscripcion->tipo == 0 ? 'InterOut' : 'InterIn');
                $viewWith = array_merge($viewWith, ['tipoInterChange' => $tipoInterChange]);
            }

            if ($peticion != '') {
                $this->peticion = $peticion;
            }


            //se tiene que definir cual es el paso que tendra asociado archivos adjuntos en el email y settearlo aqui


            $pasos_validacion = array_filter($this->tipos_pasos, function($var){
                return ($var['user_id'] != '');
            });

            $tipo_paso = [];

            foreach ($pasos_validacion as $key => $value) {

                if (count($tipo_paso) >= 1) {
                    $existe = array_search($value['id'], array_column($tipo_paso, 'id'));
                }else{
                    $existe = false;
                }
                if ($existe === false) {
                    $tipo_paso[] = $value;
                }
            }

            $validarAcceso = $this->validarAcceso('editar',$this->user->id,$inscripcionId);
            // print_r($validarAcceso);
            // print_r($tipo_paso);

            $pasoMaximo = 4;
            $editar = false;

            // if($validarAcceso['ok'] === true){
                if (isset($validarAcceso['paso_incompleto'])) {
                    $keyTipo_paso = array_search($validarAcceso['paso_incompleto'], array_column($tipo_paso, 'id'));
                    // replace(substr(nombre,instr(nombre,"paso")+4,2),"_","")

                    $nombre = $tipo_paso[$keyTipo_paso]['nombre'];
                    
                    $pasoMaximo = str_replace('_', '', substr($nombre, strpos($nombre, 'paso')+4,2));

                }elseif (isset($validarAcceso['tipo_paso_id'])) {
                    $keyTipo_paso = array_search($validarAcceso['tipo_paso_id'], array_column($tipo_paso, 'id'));
                    
                    $nombre = $tipo_paso[$keyTipo_paso]['nombre'];
                    
                    $pasoMaximo = str_replace('_', '', substr($nombre, strpos($nombre, 'paso')+4,2));
                }
            // }

            if($validarAcceso['ok'] === true){
                $editar = true;
            }

            //solicita los datos de la inscripcion
            $viewWith = array_merge($viewWith,$this->datosInscripcion($inscripcionId,'show','ver',$tipo_paso));



            $viewWith = array_merge($viewWith, ['editar_paso' => $editar, 'pasoMaximo' => $pasoMaximo]);
        // print_r($viewWith);

            $view = 'InterChange.show';
            

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
     * Show the form for editing the specified InterChange.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$paso = '', Request $request)
    {
        
        if ( strpos($this->tipoRuta, 'interout') !== false ) {
            // return redirect('/html/interout.php');
        }
        if ( strpos($this->tipoRuta, 'interin') !== false ) {
            // return redirect('/html/interin.php');
        }

        $viewWith = $this->viewWith;
        $alliance = [];
        $inscripcionId = 0;
        $destino = 'edit';
        $existe_paso = 0;
        $datosInscripcion = '';
        $vista = 'InterChange.edit';
        $this->user = Auth::user();

        $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
        $estadoInscripcionActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        $estadosValidaciones = array_filter($estadosData, function($var){
            return ($var['uso'] == 'VALIDATOR');
        });
        reset($estadoInscripcionActiva);
        $keyEstadoInscripcionActiva = key($estadoInscripcionActiva);
        $keyEstadoValidacion = array_search('RECHAZADO', array_column($estadosValidaciones, 'nombre'));
        $keysEstadosValidaciones = array_keys($estadosValidaciones);
        $keyValidacionRechazada = $keysEstadosValidaciones[$keyEstadoValidacion];
        

        $rutaError = route('interchanges.'.strtolower($this->tipoInterChange).'.index');
        //el paso es 1 o 5 (pre registro y registro)
        // $paso = '1';

        //busca la inscripcion
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('No se encuentra el registro del intercambio, recargue la pagina.');

            return redirect($rutaError);
        }
        $inscripcionId = $inscripcion->id;


        $pasos_validacion = array_filter($this->tipos_pasos, function($var){
            return ($var['user_id'] != '');
        });

        $tipo_paso = [];

        foreach ($pasos_validacion as $key => $value) {

            if (count($tipo_paso) >= 1) {
                $existe = array_search($value['id'], array_column($tipo_paso, 'id'));
            }else{
                $existe = false;
            }
            if ($existe === false) {
                $tipo_paso[] = $value;
            }
        }

        reset($tipo_paso);
        $currentTipo_paso = current($tipo_paso);
        $pasoMaximo = $currentTipo_paso['orden'];
        $editar = false;
        $validarAcceso = $this->validarAcceso('editar',$this->user->id,$inscripcionId);
        // print_r($validarAcceso);
        // return 1;
        if($validarAcceso['ok'] === true){
            if (isset($validarAcceso['paso_incompleto'])) {
                $keyTipo_paso = array_search($validarAcceso['paso_incompleto'], array_column($tipo_paso, 'id'));
                
                $nombre = $tipo_paso[$keyTipo_paso]['nombre'];
                
                $pasoMaximo = str_replace('_', '', substr($nombre, strpos($nombre, 'paso')+4,2));
            }elseif (isset($validarAcceso['tipo_paso_id'])) {
                $keyTipo_paso = array_search($validarAcceso['tipo_paso_id'], array_column($tipo_paso, 'id'));
                
                $nombre = $tipo_paso[$keyTipo_paso]['nombre'];
                
                $pasoMaximo = str_replace('_', '', substr($nombre, strpos($nombre, 'paso')+4,2));
            }
            $editar = true;
        }else{

            Flash::error('No tiene permitido editar esta inscripción');

            return redirect($rutaError);
        }

        
        $pasoMinimo = (($pasoMaximo <= 4) ? 1 : (($pasoMaximo >= 14) ? 14 : 5));
        

        if ($paso != ''){

            if ($pasoMinimo > $paso) {
                Flash::error('No tiene permitido editar este paso de esta inscripción');

                return redirect($rutaError);
            }else{
                $pasoMinimo = $paso;
                $pasoMaximo = $paso;
                
            }
        }

        


        //verifica si ya existen validadores revisando y que hayan rechazado alguna revision de la inscripcion para permitir editar 
        // $pasosInscripcion = \App\Models\Validation\PasosInscripcion::where('inscripcion_id',$inscripcionId)->whereIn('estado_id',array_column($estadosValidaciones, 'id'))->get()->toArray();
        // $continuar = false;
        // if ( count($pasosInscripcion) ) {
        //     $hanRechazado = array_search($estadosValidaciones[$keyValidacionRechazada]['id'], array_column($pasosInscripcion, 'estado_id'));
        //     if ( $hanRechazado !== false ) {
        //         $continuar = true;
        //     }
        // }else{
        //     $continuar = true;
        // }

        // if ($inscripcion->estado_id == $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id'] || $continuar == false) {
        if ($inscripcion->estado_id == $estadoInscripcionActiva[$keyEstadoInscripcionActiva]['id'] ) {
            Flash::error('No se puede editar la inscripción');

            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        }

        if ($paso == ''){
            $paso = '4';
        }

        $tipo_paso = $this->tipoPaso->where('nombre', 'paso'.$paso.'_interchange')
            ->select('id', 'nombre', DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))
            ->get()->toArray();

        if (!count($tipo_paso)) {
            Flash::error('No se encontro el paso de la inscripción');

            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.show',$inscripcion->id));
        }

        $datosInscripcion = $this->datosInscripcion($inscripcion->id,$destino,'ver',$tipo_paso);
        // print_r($datosInscripcion);
        // echo '$pasoMaximo:'.$pasoMaximo;
        $dataInscripcion['inscripcionId'] = $datosInscripcion['dataInscripcion']['id'];
        $keyEstudianteId = $datosInscripcion['keyEstudianteId'];

        //paso 1 || 5
        $dataInscripcion['estudiante_nombres'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['nombres'] ?? '';
        $dataInscripcion['estudiante_apellidos'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['apellidos'] ?? '';
        if ($pasoMaximo > 4 ) {
            $dataInscripcion['estudiante_tipo_documento'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['tipoDocumento']['tipo_documento_nombre'] ?? 0;
        }else{
            $dataInscripcion['estudiante_tipo_documento'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['tipoDocumento']['tipo_documento_id'] ?? 0;
        }
        $dataInscripcion['estudiante_numero_documento'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['numero_documento'] ?? '';
        $dataInscripcion['estudiante_email_institucion'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['usuario_email'] ?? '';
        $dataInscripcion['estudiante_email_personal'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['email_personal'] ?? '';
        $dataInscripcion['estudiante_codigo_institucion'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['codigo_institucion'] ?? '';
        //desde el paso 5 en adelante
        $dataInscripcion['estudiante_genero'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['genero'] ?? '';
        $dataInscripcion['estudiante_nacionalidad'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['nacionalidad_id'] ?? '';
        $dataInscripcion['estudiante_pasaporte'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['nro_pasaporte'] ?? '';
        $dataInscripcion['estudiante_exp_pasaporte'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['fecha_expedicion_pasaporte'] ?? '';
        $dataInscripcion['estudiante_vence_pasaporte'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['fecha_vencimiento_pasaporte'] ?? '';

        $dataInscripcion['estudiante_telefono'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['telefono'] ?? '';
        $dataInscripcion['estudiante_celular'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['celular'] ?? '';
        $dataInscripcion['estudiante_departamento_residencia'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['ciudad_residencia']['departamento_id'] ?? '';
        $dataInscripcion['estudiante_ciudad_residencia'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['ciudad_residencia_id'] ?? '';
        $dataInscripcion['estudiante_direccion'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['direccion'] ?? '';
        $dataInscripcion['estudiante_codigo_postal'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['codigo_postal'] ?? '';

        //paso 2 || 6 
        if (isset($datosInscripcion['dataUsers'][$keyEstudianteId]['programa'])) {
            $keyProgramaOrigen = array_search($datosInscripcion['dataInscripcion']['programa_origen_id'], array_column($datosInscripcion['dataUsers'][$keyEstudianteId]['programa'], 'programa_id'));
        }else{
            $keyProgramaOrigen = NULL;
        }
        if ($pasoMaximo > 4 ) {
            $dataInscripcion['estudiante_facultad'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['programa'][$keyProgramaOrigen]['facultad_nombre'] ?? 0;
            $dataInscripcion['estudiante_programa'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['programa'][$keyProgramaOrigen]['programa_nombre'] ?? 0;
        }else{
            $dataInscripcion['estudiante_facultad'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['programa'][$keyProgramaOrigen]['facultad_id'] ?? 0;
            $dataInscripcion['estudiante_programa'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['programa'][$keyProgramaOrigen]['programa_id'] ?? 0;
        }

        $dataInscripcion['estudiante_promedio'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['promedio_acumulado'] ?? '';
        $dataInscripcion['estudiante_porcentaje_creditos'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['porcentaje_aprobado'] ?? '';

        //paso 3 || 7
        if ($pasoMaximo > 4 ) {
            $dataInscripcion['inscripcion_periodo'] = $datosInscripcion['dataInscripcion']['periodo'][0]['periodo_nombre'] ?? 0;
            $dataInscripcion['inscripcion_modalidad'] = $datosInscripcion['dataInscripcion']['modalidad'][0]['modalidad_nombre'] ?? 0;
            $dataInscripcion['inscripcion_pais'] = $datosInscripcion['dataInscripcion']['paises'][0]['pais_nombre'] ?? 0;
        }else{
            $dataInscripcion['inscripcion_periodo'] = $datosInscripcion['dataInscripcion']['periodo'][0]['periodo_id'] ?? 0;
            $dataInscripcion['inscripcion_modalidad'] = $datosInscripcion['dataInscripcion']['modalidad'][0]['modalidad_id'] ?? 0;
            $dataInscripcion['inscripcion_pais'] = $datosInscripcion['dataInscripcion']['paises'][0]['pais_id'] ?? 0;
        }

        $dataInscripcion['inscripcion_institucion_destino'] = $datosInscripcion['dataInscripcion']['institucion_destino'][0]['institucion_nombre'] ?? 0;
        
        $dataInscripcion['inscripcion_campus_destino'] = $datosInscripcion['dataInscripcion']['programa_destino'][0]['facultad_destino'][0]['campus_destino'][0]['campus_id'] ?? 0;
        
        $dataInscripcion['inscripcion_facultad_destino'] = $datosInscripcion['dataInscripcion']['programa_destino'][0]['facultad_destino'][0]['facultad_id'] ?? 0;

        $dataInscripcion['inscripcion_programa_destino'] = $datosInscripcion['dataInscripcion']['programa_destino'][0]['programa_id'] ?? 0;

        //paso 8

        $dataInscripcion['contacto_nombres'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_nombres'] ?? '' ;
        $dataInscripcion['contacto_apellidos'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_apellidos'] ?? '' ;
        $dataInscripcion['contacto_parentesco'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['parentesco'] ?? '' ;
        $dataInscripcion['contacto_email_personal'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_email'] ?? '' ;
        $dataInscripcion['contacto_telefono'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_telefono'] ?? '' ;
        $dataInscripcion['contacto_celular'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_celular'] ?? '' ;
        $dataInscripcion['contacto_departamento_residencia'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['ciudad_residencia']['departamento']['departamento_id'] ?? '' ;
        $dataInscripcion['contacto_ciudad_residencia'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['ciudad_residencia']['ciudad_id'] ?? '' ;
        $dataInscripcion['contacto_direccion'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_direccion'] ?? '' ;
        $dataInscripcion['contacto_codigo_postal'] = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_codigo_postal'] ?? '' ;

        //paso 9
        $dataInscripcion['fuente_financia_nacional'] = $datosInscripcion['dataInscripcion']['financiacion']['nacional']['fuente_financiacion_id'] ?? 0;
        $dataInscripcion['monto_financia_nacional'] = $datosInscripcion['dataInscripcion']['financiacion']['nacional']['financiacion_monto'] ?? '';
        
        $dataInscripcion['fuente_financia_internacional'] = $datosInscripcion['dataInscripcion']['financiacion']['internacional']['fuente_financiacion_id'] ?? 0;
        $dataInscripcion['monto_financia_internacional'] = $datosInscripcion['dataInscripcion']['financiacion']['internacional']['financiacion_monto'] ?? '';

        if ($dataInscripcion['fuente_financia_internacional'] != 0 && $dataInscripcion['monto_financia_internacional'] != '') {
            $dataInscripcion['incluye_fuente_internacional'] = 'SI';
        }


        //paso 10
        $dataInscripcion['presupuesto_hospedaje'] = $datosInscripcion['dataInscripcion']['presupuesto_hospedaje'] ?? '';
        $dataInscripcion['presupuesto_alimentacion'] = $datosInscripcion['dataInscripcion']['presupuesto_alimentacion'] ?? '';
        $dataInscripcion['presupuesto_transporte'] = $datosInscripcion['dataInscripcion']['presupuesto_transporte'] ?? '';
        $dataInscripcion['presupuesto_otros'] = $datosInscripcion['dataInscripcion']['presupuesto_otros'] ?? '';

        //paso 11
        $lista_documentos_soporte = $datosInscripcion['lista_documentos_soporte'] ?? [];
        $lista_documentos_finales = $datosInscripcion['lista_documentos_finales'] ?? [];

        $dataInscripcion['archivo_documentos_soporte'] = $datosInscripcion['dataInscripcion']['archivo_documentos_soporte'] ?? '';
        $dataInscripcion['archivo_foto'] = $datosInscripcion['dataInscripcion']['archivo_foto'] ?? '';
        $dataInscripcion['archivo_documentos_finales'] = $datosInscripcion['dataInscripcion']['archivo_documentos_finales'] ?? '';

        //obtiene los datos iniciales para los campos de los formularios, como los selects
        $viewWith = array_merge($viewWith,$this->create($inscripcion->id));

        $estudiante_programa = \App\Models\Admin\Programa::where('facultad_id',$dataInscripcion['estudiante_facultad'])->pluck('nombre','id');
        $inscripcion_pais = app('App\Repositories\Admin\CountryRepository')->listCountriesModalidad($dataInscripcion['inscripcion_modalidad']);


        $institucion_id = \Config::get('options.institucion_id');
        if (!empty($this->campusAppFound)) {
            $institucion_id = $this->campusAppFound->institucion->id;
        }

        $pais_id = $dataInscripcion['inscripcion_pais'];
        $modalidad_id = $dataInscripcion['inscripcion_modalidad'];
        
        $inscripcion_institucion_destino = app('App\Repositories\Admin\InstitucionRepository')->listInstitutions($institucion_id,$pais_id,$modalidad_id);
        
        //INICIO DATOS DEL PASO 5 EN ADELANTE
        //INICIO DATOS DEL PASO 5 EN ADELANTE
        //INICIO DATOS DEL PASO 5 EN ADELANTE

        if ($pasoMaximo > 4) {
            $estudiante_nacionalidad =\App\Models\Admin\Country::where('nacionalidad','<>','')->select('nacionalidad','id')->orderBy('nacionalidad','asc')->pluck('nacionalidad','id');

//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
            if (isset($datosInscripcion['dataUsers'][$keyEstudianteId]['contacto'])) {
                $ciudad_residencia_id = $datosInscripcion['dataUsers'][$keyEstudianteId]['contacto']['contacto_ciudad_residencia_id'];
                $pais_contacto_residencia = \App\Models\Admin\State::join('ciudad','departamento.id','ciudad.departamento_id')->where('ciudad.id',$ciudad_residencia_id)->select('departamento.pais_id','departamento.id AS departamento_id')->first()->toArray();

                $contacto_departamento_residencia =\App\Models\Admin\State::where('pais_id',$pais_contacto_residencia['pais_id'] )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');

                $contacto_ciudad_residencia =\App\Models\Admin\City::where('departamento_id',$pais_contacto_residencia['departamento_id'] )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');
            }else{
                if (isset($datosInscripcion['dataUsers'][$keyEstudianteId]['institucion']['ciudad']['pais_id']) ) {
                    $pais_contacto_residencia = $datosInscripcion['dataUsers'][$keyEstudianteId]['institucion']['ciudad']['pais_id'];
                }else{
                    $pais_contacto_residencia = \App\Models\Admin\State::join('ciudad','departamento.id','ciudad.departamento_id')->where('ciudad.id',$this->campusAppFound->ciudad_id)->select('pais_id')->pluck('pais_id')->first();
                }
                $contacto_departamento_residencia =\App\Models\Admin\State::where('pais_id',$pais_contacto_residencia )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');

                $contacto_ciudad_residencia = [];

            }
            if (!empty($datosInscripcion['dataUsers'][$keyEstudianteId]['ciudad_residencia_id'])) {
                $ciudad_residencia_id = $datosInscripcion['dataUsers'][$keyEstudianteId]['ciudad_residencia_id'];
                $pais_estudiante_residencia = \App\Models\Admin\State::join('ciudad','departamento.id','ciudad.departamento_id')->where('ciudad.id',$ciudad_residencia_id)->select('departamento.pais_id','departamento.id AS departamento_id')->first()->toArray();

                $estudiante_departamento_residencia =\App\Models\Admin\State::where('pais_id',$pais_estudiante_residencia['pais_id'] )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');

                $estudiante_ciudad_residencia =\App\Models\Admin\City::where('departamento_id',$pais_estudiante_residencia['departamento_id'] )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');
            }else{
                if (isset($datosInscripcion['dataUsers'][$keyEstudianteId]['institucion']['ciudad']['pais_id']) ) {
                    $pais_estudiante_residencia = $datosInscripcion['dataUsers'][$keyEstudianteId]['institucion']['ciudad']['pais_id'];
                }else{
                    $pais_estudiante_residencia = \App\Models\Admin\State::join('ciudad','departamento.id','ciudad.departamento_id')->where('ciudad.id',$this->campusAppFound->ciudad_id)->select('pais_id')->pluck('pais_id')->first();
                }
                $estudiante_departamento_residencia =\App\Models\Admin\State::where('pais_id',$pais_estudiante_residencia )->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');

                $estudiante_ciudad_residencia = [];

            }
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS
//OPTIMIZAR ESTOS QUERYES PARA NO REPETIR LAS CONSULTAS

            $idiomas = \App\Models\Admin\TipoIdioma::select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');
            $niveles = \App\Models\Admin\Nivel::select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id');
            $user_id = $datosInscripcion['dataUsers'][$keyEstudianteId]['user_id'];

            $dataInscripcion_programa_destino = \App\Models\Admin\Programa::where('id',$datosInscripcion['dataInscripcion']['programa_destino_id'])->first();


            //la lista de programas, facultades y campus se obtienen a partir del campo programa_destino_id de lo contrario se carga la lista de campus a partir de la institucion
            if (!empty($dataInscripcion_programa_destino)) {
                
                $inscripcion_programa_destino_todos = \App\Models\Admin\Programa::where('facultad_id',$dataInscripcion_programa_destino->facultad_id)->select('nombre','id')->orderBy('nombre','asc');

                // $inscripcion_programa_destino = \App\Models\Admin\Programa::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->union($inscripcion_programa_destino_todos)->pluck('nombre','id')->toArray();
                $inscripcion_programa_destino = $inscripcion_programa_destino_todos->pluck('nombre','id')->toArray();

            }else{
                // $inscripcion_programa_destino = \App\Models\Admin\Programa::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->pluck('nombre','id')->toArray();
                $inscripcion_programa_destino = [];
            }

            if (!empty($inscripcion_programa_destino) && count($inscripcion_programa_destino) ) {
                $facultad_destino = \App\Models\Admin\Facultad::where('id',$dataInscripcion_programa_destino->facultad_id)->first()->toArray();

                $inscripcion_facultad_destino_todos = \App\Models\Admin\Facultad::where('campus_id',$facultad_destino['campus_id'])->select('nombre','id')->orderBy('nombre','asc');
            
                // $inscripcion_facultad_destino = \App\Models\Admin\Facultad::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->union($inscripcion_facultad_destino_todos)->pluck('nombre','id')->toArray();
                $inscripcion_facultad_destino = $inscripcion_facultad_destino_todos->pluck('nombre','id')->toArray();

            }else{
                // $inscripcion_facultad_destino = \App\Models\Admin\Facultad::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->pluck('nombre','id')->toArray();
                $inscripcion_facultad_destino = [];
            }

            if (!empty($inscripcion_facultad_destino) && count($inscripcion_facultad_destino) ) {

                $campus_destino = \App\Models\Admin\Campus::where('id',$facultad_destino['campus_id'])->first()->toArray();

                $inscripcion_campus_destino_todos = \App\Models\Admin\Campus::where('institucion_id',$campus_destino['institucion_id'])->select('nombre','id')->orderBy('nombre','asc');
            
                // $inscripcion_campus_destino = \App\Models\Admin\Campus::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->union($inscripcion_campus_destino_todos)->pluck('nombre','id')->toArray();
                $inscripcion_campus_destino = $inscripcion_campus_destino_todos->pluck('nombre','id')->toArray();

            }else{
                // se carga la lista de campus a partir de la institucion
                
                // $inscripcion_campus_destino = \App\Models\Admin\Campus::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->pluck('nombre','id')->toArray();
                $inscripcion_campus_destino = \App\Models\Admin\Campus::where('institucion_id',$datosInscripcion['dataInscripcion']['institucion_destino_id'])->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id')->toArray();
            }

            $fuente_financia_nacional = \App\Models\FuenteFinanciacion::where('tipo',0)->select('nombre','id')->orderBy('nombre','asc')->pluck('nombre','id')->toArray();

            $fuente_financia_internacional_todos = \App\Models\FuenteFinanciacion::where('tipo',1)->select('nombre','id')->orderBy('nombre','asc');

            $fuente_financia_internacional = \App\Models\FuenteFinanciacion::select(DB::raw("'Otro' AS nombre, '999999' AS id"))->union($fuente_financia_internacional_todos)->pluck('nombre','id')->toArray();

            $viewWith = array_merge($viewWith, ['estudiante_nacionalidad' => $estudiante_nacionalidad, 'estudiante_departamento_residencia' => $estudiante_departamento_residencia, 'estudiante_ciudad_residencia' => $estudiante_ciudad_residencia, 'idiomas' => $idiomas, 'niveles' => $niveles, 'user_id' => $user_id, 'inscripcion_campus_destino' => $inscripcion_campus_destino, 'inscripcion_facultad_destino' => $inscripcion_facultad_destino, 'inscripcion_programa_destino' => $inscripcion_programa_destino, 'contacto_departamento_residencia' => $contacto_departamento_residencia, 'contacto_ciudad_residencia' => $contacto_ciudad_residencia, 'fuente_financia_nacional' => $fuente_financia_nacional, 'fuente_financia_internacional' => $fuente_financia_internacional ]);


        }
        // echo '$pasoMaximo:'.$pasoMaximo;

        //FIN DATOS DEL PASO 5 EN ADELANTE
        //FIN DATOS DEL PASO 5 EN ADELANTE
        //FIN DATOS DEL PASO 5 EN ADELANTE






        $viewWith = array_merge($viewWith, ['estudiante_programa' => $estudiante_programa,'inscripcion_pais' => $inscripcion_pais,'inscripcion_institucion_destino' => $inscripcion_institucion_destino]);

        // print_r($dataInscripcion);
        $viewWith = array_merge($viewWith, ['tipoRuta' => $this->tipoRuta, 'interchange' => $dataInscripcion,'lista_documentos_soporte' => $lista_documentos_soporte,'lista_documentos_finales' => $lista_documentos_finales, 'editar_paso' => false]);

        if (!empty($existe_paso)) {
            $viewWith = array_merge($viewWith, ['editar_paso' => $paso]);
        }else{
            $viewWith = array_merge($viewWith, ['editar_paso' => true]);
        }

        //FALTAN LOS DATOS PARA LOS PASOS 5 EN ADELANTE

        $viewWith = array_merge($viewWith, ['peticion' => 'normal', 'paso' => (($pasoMaximo <= 4) ? 1 : 5), 'pasoMaximo' => $pasoMaximo, 'pasoMinimo' => $pasoMinimo ]);
        
        // print_r($viewWith);

        return view($vista)->with($viewWith);
    }

    /**
     * Update the specified InterChange in storage.
     *
     * @param  int              $id
     * @param UpdateInterChangeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInscripcionRequest $request)
    {
        
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('No se encontro la inscripción');

            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        }
        /*
        $inscripcion = $this->inscripcionRepository->update($request->all(), $id);

        Flash::success('Inter Change updated successfully.');

        return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        */


        return $this->storeUpdate($request, 'update', $id, $this->tipoInterChange);
    }

    /**
     * Remove the specified InterChange from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inter Change not found');

            return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
        }

        $this->inscripcionRepository->delete($id);

        Flash::success('Inter Change deleted successfully.');

        return redirect(route('interchanges.'.strtolower($this->tipoInterChange).'.index'));
    }


    /**
     * Show the form for editing the specified inscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function datosInscripcion($inscripcionId, $destino, $filtro, $tipo_paso = [])
    {
        if (!isset($this->user->id)) {
            $this->user = Auth::user();
        }

        $datosInscripcion = \App\Models\Inscripcion::join('estado', 'inscripcion.estado_id', '=', 'estado.id')
            ->where('inscripcion.id',$inscripcionId)
            ->select('inscripcion.*','estado.nombre AS estado_nombre' )
            ->first();


        //$roleEstudiante = Role::where('name','estudiante')->pluck('id')->first();

        //buscar el usuario del postulante (coordinador) de la inscripcion
        $postulanteInscripcion = \App\Models\Postulacion::where('postulacion.inscripcion_id',$datosInscripcion->id )
            ->select('postulacion.user_id')->first();

        $inscripcionId = $datosInscripcion->id;
        $postulanteId = $postulanteInscripcion->user_id;
        $estudianteId = $datosInscripcion->user_id;
        
        //buscar el usuario del estudiante de la inscripcion
        $dataUsers = DB::table('users')
                ->leftJoin('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                ->whereIn('users.id',[ $postulanteId,$estudianteId ])
                ->select('users.id AS user_id','users.activo AS usuario_activo','users.name AS usuario_name','users.email AS usuario_email','datos_personales.*')
                ->orderBy('users.id','asc')
                ->get()->toArray();

        $tipoDocumentoUsuarios = DB::table('datos_personales')
                ->join('tipo_documento', 'datos_personales.tipo_documento_id', '=', 'tipo_documento.id')
                ->whereIn('datos_personales.id',array_column($dataUsers, 'id'))
                ->select('datos_personales.id AS datos_personales_id','tipo_documento.id AS tipo_documento_id','tipo_documento.nombre AS tipo_documento_nombre' )
                ->get()->toArray();

        $programaUsuarios = DB::table('matricula')
                ->join('programa', 'matricula.programa_id', '=', 'programa.id')
                ->join('facultad', 'programa.facultad_id', '=', 'facultad.id')
                ->whereIn('matricula.user_id',[$postulanteId,$estudianteId])
                ->select('matricula.user_id AS user_id','programa.id AS programa_id','programa.nombre AS programa_nombre','facultad.id AS facultad_id','facultad.nombre AS facultad_nombre' )
                ->groupBy('programa.id')
                ->orderBy('matricula.user_id','asc')
                ->get()->toArray();
        // print_r($programaUsuarios);

        $institucionUsuarios = DB::table('user_campus')
                ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                ->whereIn('user_campus.user_id',[$postulanteId,$estudianteId])
                ->select('user_campus.user_id AS user_id','campus.id AS campus_id','campus.ciudad_id AS campus_ciudad_id','institucion.id AS institucion_id','institucion.nombre AS institucion_nombre' )
                ->groupBy('user_campus.user_id')
                ->orderBy('user_campus.user_id','asc')
                ->get()->toArray();
        

        $ciudadesInstituciones = DB::table('campus')
                ->join('ciudad', 'campus.ciudad_id', '=', 'ciudad.id')
                ->join('departamento', 'ciudad.departamento_id', '=', 'departamento.id')
                ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                ->whereIn('campus.institucion_id',array_column($institucionUsuarios, 'institucion_id'))
                ->groupBy('campus.institucion_id')
                ->select('campus.institucion_id','pais.id AS pais_id','pais.nombre AS pais_nombre','ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre')
                ->get()->toArray();

        $nacionalidadUsuarios = DB::table('pais')
                ->whereIn('pais.id',array_column($dataUsers, 'nacionalidad_id'))
                ->select('pais.id AS nacionalidad_id','pais.nacionalidad AS nacionalidad_nombre' )
                ->get()->toArray();

        $contactoUsuarios = DB::table('user_contacto')
                ->join('users', 'user_contacto.contacto_id', '=', 'users.id')
                ->join('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                ->whereIn('user_contacto.user_id',array_column($dataUsers, 'user_id'))
                ->select('user_contacto.*','users.id AS contacto_id','datos_personales.nombres AS contacto_nombres','datos_personales.apellidos AS contacto_apellidos','datos_personales.email_personal AS contacto_email','datos_personales.telefono AS contacto_telefono','datos_personales.celular AS contacto_celular','datos_personales.ciudad_residencia_id AS contacto_ciudad_residencia_id','datos_personales.direccion AS contacto_direccion','datos_personales.codigo_postal AS contacto_codigo_postal' )
                ->get()->toArray();

        $ciudadesResidenciaUsuariosId = array_merge(array_column($dataUsers, 'ciudad_residencia_id'),array_column($contactoUsuarios, 'contacto_ciudad_residencia_id'));

        $ciudadResidenciaUsuarios = DB::table('ciudad')
                ->whereIn('ciudad.id',$ciudadesResidenciaUsuariosId)
                ->select('ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre','ciudad.departamento_id' )
                ->get()->toArray();

        $departamentoResidenciaUsuarios = DB::table('departamento')
                ->whereIn('id',array_column($ciudadResidenciaUsuarios,'departamento_id') )
                ->select('departamento.id AS departamento_id','departamento.nombre AS departamento_nombre','departamento.pais_id' )
                ->get()->toArray();

        $userIdiomas = DB::table('user_idiomas')->join('tipo_idioma', 'user_idiomas.tipo_idioma_id', '=', 'tipo_idioma.id')
                ->join('nivel', 'user_idiomas.nivel_id', '=', 'nivel.id')
                ->whereIn('user_idiomas.user_id',[$postulanteId,$estudianteId])
                ->select('user_idiomas.id AS idioma_id', 'user_idiomas.user_id AS user_id', 'user_idiomas.tipo_idioma_id AS tipo_idioma_id', 'tipo_idioma.nombre AS tipo_idioma_nombre', DB::raw('case user_idiomas.certificado when false then "NO" when true then "SI" end as certificado'), 'user_idiomas.nombre_examen AS nombre_examen', 'user_idiomas.nivel_id AS nivel_id', 'nivel.nombre AS nivel_nombre' )
                ->get()->toArray();

        //asociar los datos de la ciudad a la institucion
        foreach ($institucionUsuarios as $data => $institucion) {
            foreach ($ciudadesInstituciones as $data => $ciudad) {
                if ($institucion->institucion_id == $ciudad->institucion_id) {
                    $institucion->ciudad = $ciudad;
                }
            }
        }

        //asociar los datos de los departamentos a las ciudades de residencia de los usuarios
        foreach ($ciudadResidenciaUsuarios as $data => $ciudad) {
            //asociar los datos de las ciudades al usuario
            foreach ($departamentoResidenciaUsuarios as $data => $departamento) {
                if ($ciudad->departamento_id == $departamento->departamento_id) {
                    $ciudad->departamento = $departamento;
                }
            }
        }

        //asociar los datos de las ciudades a los contactos de los usuarios
        foreach ($contactoUsuarios as $data => $contacto) {
            //asociar los datos de las ciudades al usuario
            foreach ($ciudadResidenciaUsuarios as $data => $ciudad) {
                if ($contacto->contacto_ciudad_residencia_id == $ciudad->ciudad_id) {
                    $contacto->ciudad_residencia = $ciudad;
                }
            }
        }

        foreach ($dataUsers as $data => $user) {
            //asociar los datos de la institucion al usuario
            foreach ($institucionUsuarios as $data => $institucion) {
                if ($user->user_id == $institucion->user_id) {
                    $user->institucion = $institucion;
                }
            }
            //asociar los datos del tipo de documento al usuario
            foreach ($tipoDocumentoUsuarios as $data => $tipoDocumento) {
                if ($user->id == $tipoDocumento->datos_personales_id) {
                    $user->tipoDocumento = $tipoDocumento;
                }
            }
            //asociar los datos del programa al usuario
            foreach ($programaUsuarios as $data => $programa) {
                if ($user->user_id == $programa->user_id) {
                    $user->programa[] = $programa;
                }
            }

            //asociar los datos de la nacionalidad al usuario
            foreach ($nacionalidadUsuarios as $data => $nacionalidad) {
                if ($user->nacionalidad_id == $nacionalidad->nacionalidad_id) {
                    $user->nacionalidad = $nacionalidad;
                }
            }
            //asociar los datos del contacto al usuario
            foreach ($contactoUsuarios as $data => $contacto) {
                if ($user->user_id == $contacto->user_id) {
                    $user->contacto = $contacto;
                }
            }
            //asociar los datos de las ciudades al usuario
            foreach ($ciudadResidenciaUsuarios as $data => $ciudad) {
                if ($user->ciudad_residencia_id == $ciudad->ciudad_id) {
                    $user->ciudad_residencia = $ciudad;
                }
            }
            //asociar los datos de los idiomas al usuario
            foreach ($userIdiomas as $data => $idioma) {
                if ($user->user_id == $idioma->user_id) {
                    $user->idiomas[] = $idioma;
                }
            }
        }

        $dataUsers = json_decode(json_encode($dataUsers),true);
        //print_r($dataUsers);

        if ($destino == 'email' || $destino == 'show' || $destino == 'edit' ) {

            $dataInscripcion = json_decode(json_encode($datosInscripcion),true);

            $dataPeriodo = \App\Models\Inscripcion::join('periodo', 'inscripcion.periodo_id', '=', 'periodo.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('periodo.id AS periodo_id','periodo.nombre AS periodo_nombre' )
                    ->get()
                    ->toArray();

            $dataPeriodo = json_decode(json_encode($dataPeriodo),true);

            $dataModalidad = \App\Models\Inscripcion::join('modalidades', 'inscripcion.modalidad_id', '=', 'modalidades.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('modalidades.id AS modalidad_id','modalidades.nombre AS modalidad_nombre' )
                    ->get()
                    ->toArray();
            $dataModalidad = json_decode(json_encode($dataModalidad),true);

            $dataInstitucion_destino = \App\Models\Admin\Institucion::join('inscripcion', 'institucion.id', '=', 'inscripcion.institucion_destino_id') 
                    ->where('inscripcion.id', $inscripcionId)
                    ->select('institucion.id AS institucion_id','institucion.nombre AS institucion_nombre')
                    ->get()
                    ->toArray();


            $dataCampus = \App\Models\Admin\Campus::whereIn('campus.institucion_id', array_column($dataInstitucion_destino, 'institucion_id') ?? [0])
                    ->select('campus.id AS campus_id','campus.ciudad_id AS campus_ciudad_id','campus.institucion_id AS campus_institucion_id' )
                    ->first();

            $dataInstitucion_destino = json_decode(json_encode($dataInstitucion_destino),true);

            $dataPaises = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')
                    ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                    ->where('ciudad.id', $dataCampus->campus_ciudad_id ?? 0)
                    ->select('pais.id AS pais_id','pais.nombre AS pais_nombre')
                    ->groupBy('pais.id')
                    ->get()
                    ->toArray();
            $dataPaises = json_decode(json_encode($dataPaises),true);

            $dataProgramaOrigen = \App\Models\Inscripcion::join('programa', 'inscripcion.programa_origen_id', '=', 'programa.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('programa.id AS programa_id','programa.nombre AS programa_nombre' )
                    ->get()
                    ->toArray();
            $dataProgramaOrigen = json_decode(json_encode($dataProgramaOrigen),true);

            $dataProgramaDestino = \App\Models\Inscripcion::join('programa', 'inscripcion.programa_destino_id', '=', 'programa.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('programa.id AS programa_id','programa.nombre AS programa_nombre','programa.facultad_id' )
                    ->get()
                    ->toArray();

            if (!empty($dataProgramaDestino)) {
                $dataFacultadDestino = \App\Models\Admin\Facultad::where('id',$dataProgramaDestino[0]['facultad_id'] )
                    ->select('id AS facultad_id','nombre AS facultad_nombre', 'campus_id' )
                    ->get()
                    ->toArray();


                if (!empty($dataFacultadDestino)) {
                    $dataProgramaDestino[0]['facultad_destino'] = $dataFacultadDestino;

                    $dataCampusDestino = \App\Models\Admin\Campus::where('id',$dataFacultadDestino[0]['campus_id'] )
                        ->select('id AS campus_id','nombre AS campus_nombre', 'institucion_id' )
                        ->get()
                        ->toArray();

                    if (!empty($dataCampusDestino)) {
                        $dataProgramaDestino[0]['facultad_destino'][0]['campus_destino'] = $dataCampusDestino;
                    }
                }

            }

            $dataProgramaDestino = json_decode(json_encode($dataProgramaDestino),true);

            $listaFinanciaciones = \App\Models\Financiacion::join('fuente_financiacion', 'financiacion.fuente_financiacion_id', '=', 'fuente_financiacion.id')
                    ->where('financiacion.inscripcion_id',$inscripcionId )
                    ->select('financiacion.id AS financiacion_id','financiacion.inscripcion_id AS inscripcion_id','financiacion.monto AS financiacion_monto','fuente_financiacion.tipo AS tipo','fuente_financiacion.id AS fuente_financiacion_id','fuente_financiacion.nombre AS fuente_financiacion_nombre' )
                    ->get()
                    ->toArray();

            $dataFinanciaciones = [];

            foreach ($listaFinanciaciones as $key => $financiacion) {
                if ($financiacion['tipo'] == 0 ) {
                    $dataFinanciaciones['nacional'] = $financiacion;
                }elseif ($financiacion['tipo'] == 1 ) {
                    $dataFinanciaciones['internacional'] = $financiacion;
                }
            }

            //la lista de documentos esta guardada como tipo json en el campo 'descripcion '
            $tipos_documentos_inscripcion = \App\Models\TipoDocumento::join('clase_documento','tipo_documento.clase_documento_id','clase_documento.id')
                ->whereIn('tipo_documento.nombre',['DOCUMENTOS SOPORTE','FOTO','DOCUMENTOS FINALES INSCRIPCION'])
                ->where('clase_documento.nombre','INSCRIPCION')
                ->select('tipo_documento.*')
                ->get()->toArray();

            $documentos_soporte = [];
            $foto = [];
            $documentos_finales = [];
            //separa los tipos de documentos 
            foreach ($tipos_documentos_inscripcion as $key => $value) {
                if ($value['nombre'] == 'DOCUMENTOS SOPORTE') {
                    $documentos_soporte = $value;
                }elseif ($value['nombre'] == 'FOTO') {
                    $foto = $value;
                }elseif ($value['nombre'] == 'DOCUMENTOS FINALES INSCRIPCION') {
                    $documentos_finales = $value;
                }
            }

            //obtiene el json del campo 'descripcion' que tiene la lista de los documentos necesarios para cada caso
            $lista_documentos_soporte = json_decode($documentos_soporte['descripcion'],true) ?? [];
            $lista_documentos_finales = json_decode($documentos_finales['descripcion'],true) ?? [];

            //obtiene los id del tipo de documento
            $tipo_documentos = array_column($tipos_documentos_inscripcion, 'id') ?? [];

            //obtiene todos los registros de documentos de la inscripcion
            $IdDocumentosInscripcion =  \App\Models\DocumentosInscripcion::where('inscripcion_id',$inscripcionId)
                ->whereIn('tipo_documento_id',$tipo_documentos)
                ->select('archivo_id','tipo_documento_id')
                ->get()->toArray();
            //separa los registros por los tres tipos diferentes de documentos
            $IdDocumentosSoporte = array_filter($IdDocumentosInscripcion, function($var) use ($documentos_soporte) {
                return ($var['tipo_documento_id'] == $documentos_soporte['id'] ?? 0);
            });
            $IdFoto = array_filter($IdDocumentosInscripcion, function($var) use ($foto) {
                return ($var['tipo_documento_id'] == $foto['id'] ?? 0);
            });
            $IdDocumentosFinales = array_filter($IdDocumentosInscripcion, function($var) use ($documentos_finales) {
                return ($var['tipo_documento_id'] == $documentos_finales['id'] ?? 0);
            });

            //obtiene los registros de los archivos de los tres tipos diferentes de documentos
            $dataArchivoDocumentosSoporte =  \App\Models\Archivo::whereIn('id',array_column($IdDocumentosSoporte, 'archivo_id'))
                ->select('nombre','id','path')->get()->toArray();

            $dataArchivoFoto =  \App\Models\Archivo::whereIn('id',array_column($IdFoto, 'archivo_id'))
                ->select('nombre','id','path')->get()->toArray();

            $dataArchivoDocumentosFinales =  \App\Models\Archivo::whereIn('id',array_column($IdDocumentosFinales, 'archivo_id'))
                ->select('nombre','id','path')->get()->toArray(); 

            $dataInscripcion['periodo'] = $dataPeriodo;
            $dataInscripcion['modalidad'] = $dataModalidad;
            $dataInscripcion['paises'] = $dataPaises;
            $dataInscripcion['institucion_destino'] = $dataInstitucion_destino;
            $dataInscripcion['programa_origen'] = $dataProgramaOrigen;
            $dataInscripcion['programa_destino'] = $dataProgramaDestino;
            $dataInscripcion['financiacion'] = $dataFinanciaciones;
            $dataInscripcion['archivo_documentos_soporte'] = $dataArchivoDocumentosSoporte[0] ?? [];
            $dataInscripcion['archivo_foto'] = $dataArchivoFoto[0] ?? [];
            $dataInscripcion['archivo_documentos_finales'] = $dataArchivoDocumentosFinales[0] ?? [];
            
            $dataInscripcion['enviar_solicitud'] = '';

            if ( !empty($tipo_paso) && count($tipo_paso) ) {

                $dataEmail = DB::table('pasos_inscripcion')
                    ->join('pasos_inscripcion_email', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_email.pasos_inscripcion_id')
                    ->join('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
                    ->where('pasos_inscripcion.inscripcion_id',$inscripcionId )
                    ->whereIn('pasos_inscripcion.user_id',array_column($dataUsers, 'user_id') )
                    ->whereIn('pasos_inscripcion.tipo_paso_id',array_column($tipo_paso, 'id') )
                    ->select('pasos_inscripcion.id AS pasos_inscripcion_id','pasos_inscripcion.tipo_paso_id','pasos_inscripcion.user_id','email.id','email.estado')
                    ->orderBy('email.created_at','asc')
                    ->get()
                    ->toArray();

                // print_r($dataEmail);
                // print_r($tipo_paso);
                // $tipo_paso = (int) implode('', $tipo_paso);
                        
                $archivosAdjuntos = '';
                if (count($dataEmail)) {
                    $dataInscripcion['enviar_solicitud'] = [];
                    foreach ($tipo_paso as $key => $value) {
                        $keyEmailCreado = array_search($value['id'], array_column($dataEmail, 'tipo_paso_id'));
                        $estadoEmail = ($keyEmailCreado !== false) ? $dataEmail[$keyEmailCreado]->estado : '';
                        $dataInscripcion['enviar_solicitud'][$value['orden']] = (in_array($estadoEmail, ['',0,false]))    ? 'No ha sido enviada' :  'Ya fue enviada';
                    }
                    // $dataInscripcion['enviar_solicitud'] = $dataEmail->toArray();


                    /*
                    $archivosAdjuntos = DB::table('pasos_inscripcion')
                            ->join('pasos_inscripcion_email', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_email.pasos_inscripcion_id')
                            ->join('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
                            ->join('email_archivo', 'email.id', '=', 'email_archivo.email_id')
                            ->join('archivo', 'email_archivo.archivo_id', '=', 'archivo.id')
                            ->join('formato', 'archivo.formato_id', '=', 'formato.id')
                            ->where('pasos_inscripcion.id',$dataEmail[0]->pasos_inscripcion_id) 
                            ->where('email.id',$dataEmail[0]->id) 
                            ->where('pasos_inscripcion.inscripcion_id',$inscripcionId) 
                            ->orderBy('email.id','desc')
                            ->select('archivo.*','formato.nombre AS formato_nombre');
                    //echo $archivosAdjuntos->toSql().' |$dataEmail[0]->pasos_inscripcion_id:'.$dataEmail[0]->pasos_inscripcion_id.' |$dataEmail[0]->id:'.$dataEmail[0]->id.' |$inscripcionId:'.$inscripcionId;
                    $archivosAdjuntos = $archivosAdjuntos->get()->toArray();
                    */
                }
            }

            
        }

        $keyPostulanteId = array_search($postulanteId, array_column($dataUsers, 'user_id'));
        $keyEstudianteId = array_search($estudianteId, array_column($dataUsers, 'user_id'));   
        
        $keyProgramaOrigen = '';
        if (isset($dataUsers[$keyEstudianteId]['programa'])) {
            $keyProgramaOrigen = array_search($dataInscripcion['programa_origen_id'], array_column($dataUsers[$keyEstudianteId]['programa'], 'programa_id'));
        }


        $viewWith = ['inscripcionId' => $inscripcionId, 'dataInscripcion' => $dataInscripcion, 'lista_documentos_soporte' => $lista_documentos_soporte, 'lista_documentos_finales' => $lista_documentos_finales, 'dataUsers' => $dataUsers, 'postulanteId' => $postulanteId, 'estudianteId' => $estudianteId, 'keyPostulanteId' => $keyPostulanteId, 'keyEstudianteId' => $keyEstudianteId, 'keyProgramaOrigen' => $keyProgramaOrigen, 'peticion' => $this->peticion];


        if ($this->tipoInterChange == '') {
            $tipoInterChange = ($datosInscripcion->tipo == 0 ? 'InterOut' : 'InterIn');
            $viewWith = array_merge($viewWith, ['tipoInterChange' => $tipoInterChange]);
        }

        if ($destino == 'email' || $destino == 'show' || $destino == 'edit' ) {
            if ( $filtro == 'declinado' ) {
                return $viewWith;
            }elseif ( $filtro == 'ver' ) {

                $viewWith = array_merge($viewWith, ['paso_titulo' => $this->paso_titulo]);
            }
        }
        if ($destino == 'crearEmail' && $filtro == 'nuevo' ) {

            $viewWith = ['dataUsers' => $dataUsers, 'keyPostulanteId' => $keyPostulanteId, 'keyEstudianteId' => $keyEstudianteId];
            
        }

        if (!empty($tipo_paso) && count($tipo_paso)) {

            $viewWith = array_merge($viewWith, ['archivosAdjuntos' => $archivosAdjuntos]);
            
        }
        
        return $viewWith;
    }

    public function crearInscripcion($tipo,$dataInscripcion,$rol)
    {
        $retorno = false;
        $inscripcionId = 0;
        $inscripcionFind = '';

        if( $tipo == 'nuevo' ){
            if ( $newInscripcion = \App\Models\Inscripcion::create($dataInscripcion) ) {
                $inscripcionId = $newInscripcion->id;
                
                //if ( $rol == 'coordinador' ){

                    //crear el registro de quien hizo la postulacion del estudiante para el intercambio
                    $postulacion = \App\Models\Postulacion::create(['user_id' => $this->user->id, 'inscripcion_id' => $inscripcionId]);
                    
                    $retorno = $newInscripcion;
                    //$inscripcionFind = $newInscripcion;

                //};

            } else {
                $retorno = 'error_inscripcion';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){
            $actualizarInscripcion = \App\Models\Inscripcion::find($dataInscripcion['id']);
            if ( count($actualizarInscripcion) > 0 ) {
                $inscripcionId = $actualizarInscripcion->id;
                
                //guardar los cambios en el usuario y sus datos personales

                $updateInscripcion = \App\Models\Inscripcion::where('id',$inscripcionId)->update($dataInscripcion);
    
                if ($updateInscripcion == 0) {
                    $actualizarInscripcion = 'error_inscripcion';
                }

                $retorno = $actualizarInscripcion;
                //$inscripcionFind = $actualizarInscripcion;

            }else{
                $retorno = 'error_inscripcion';
                goto end;
            }

        }
        end:
        return $retorno;
    }

    public function crearUsuario($tipo,$dataUser,$rol,$campus,$datosPersonales,$inscripcion)
    {
        $retorno = false;
        $userId = 0;
        $estudianteId = 0;
        $contactoId = 0;
        $userFind = '';
        $createUser = '';
        $estudiante_programa = '';
        $contacto_parentesco = '';
        $datos = [];

        if (isset($datosPersonales['estudiante_programa'])) {
            $estudiante_programa = $datosPersonales['estudiante_programa'];
            unset($datosPersonales['estudiante_programa']);
        }
        if (isset($datosPersonales['contacto_parentesco'])) {
            $datos['contacto_parentesco'] = $datosPersonales['contacto_parentesco'];
            unset($datosPersonales['contacto_parentesco']);
        }
        
        
        if( $rol == 'contacto' ){
            //se intercambian
            $datos['user_id'] = $dataUser['user_id'];
            unset($dataUser['user_id']);
        }
        if( $tipo == 'nuevo' ){
            
            if ( $createUser = User::create($dataUser) ) {
                $userId = $createUser->id;
                
                if ($datos_personales = \App\Models\DatosPersonales::create($datosPersonales) ){

                    $createUser->datos_personales_id = $datos_personales->id;
                    $createUser->save();

                    $tipo = 'estudiante';
                    if ($rol == 'contacto') {
                        $tipo = 'contacto';
                    }
                    // se intercambian, la posicion 'contacto_id' guarda al usuario creado y 'user_id' guarda al estudiante o usuario que tendra asociado al contacto
                    if( $rol == 'contacto' ){
                        $datos['contacto_id'] = $userId;
                    }else{
                        $datos['user_id'] = $userId;
                    }
                    
                    $asociarUsuario = $this->asociarUsuario($tipo,$datos,$rol,$campus,$inscripcion);
                    if ( $asociarUsuario == 'error_usuario' ) {
                        $retorno = 'error_asociar';
                        goto end;
                    }if ( $asociarUsuario == 'error_contacto' ) {
                        $retorno = 'error_contacto';
                        goto end;
                    }
                    
                    $retorno = $createUser;
                    //$userFind = $createUser;

                } else {
                    $retorno = 'error_datos_personales';
                    goto end;

                };

            } else {
                $retorno = 'error_usuario';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){
            $createUser = User::find($dataUser['id']);
            // print_r($createUser);
            if ( count($createUser) > 0 ) {
                $userId = $createUser->id;

                // if (isset($dataUser['name'])) {
                //     $createUser->name = $dataUser['name'];
                // }
                if (isset($dataUser['email'])) {
                    if ( $createUser->email != $dataUser['email'] ) {
                        // $createUser->activo = 1;
                        $dataUser['activo'] = 0;
                    }

                    // $createUser->email = $dataUser['email'];

                }


                $updateUser = User::where('id',$userId)->update($dataUser);
                // var_dump($updateUser);
                if ($updateUser == 0) {
                    $createUser = 'error_usuario1';
                    $retorno = $createUser;
                    goto end;
                }
                // if (isset($createUser->activo) ){
                    $updateUser = \App\Models\DatosPersonales::where('id',$createUser->datos_personales_id)->update($datosPersonales);

                    if ($updateUser == 0) {
                        $createUser = 'error_usuario2';
                        $retorno = $createUser;
                        echo "no paso";
                        goto end;
                    }
                // }

                /*
                //asociar al estudiante con el programa a travez de la matricula
                if (isset($dataUser['programa_id'])) {
                    
                    //en caso de no estar activo (ser nuevo usuario)
                    if (isset($createUser->activo) && $createUser->activo == 1) {
                        //crear una nueva matricula
                        $matricula = \App\Models\Matricula::firstOrCreate(['user_id' => $userId, 'programa_id' => $dataUser['programa_id']]);
                        //$createUser->matricula->delete();
                        //quitar todas las demas matriculas
                        $matriculas = \App\Models\Matricula::where('user_id',$userId)->where('programa_id','<>',$dataUser['programa_id'])->delete();
                    }else{
                        //agregar una matricula
                        $matricula = \App\Models\Matricula::firstOrCreate(['user_id' => $userId, 'programa_id' => $dataUser['programa_id']]);
                    }
                }
                */
                $retorno = $createUser;
                
                //$userFind = $createUser;

            }else{
                $retorno = 'error_usuario3';
                goto end;
            }

        }

        if (!empty($estudiante_programa)) {
            
            $programa = \App\Models\Admin\Programa::find($estudiante_programa);

            if ( count($programa) > 0 ) {
                $estudiante_programa = \App\Models\Matricula::join('programa', 'matricula.programa_id', '=', 'programa.id')
                    ->where('matricula.user_id',$createUser->id)
                    ->where('matricula.programa_id',$programa->id)
                    ->select('matricula.id')->first();

                if ( !count($estudiante_programa) > 0 ) {
                    $createUser->matricula()->syncWithoutDetaching($programa->id);
                }

            }else{
                $retorno = 'error_programa';
                goto end;
            }
            
        }


        end:
        // var_dump($retorno);
        return $retorno;
    }

    public function asociarUsuario($tipo,$datos,$rol,$campus,$inscripcion)
    {
        $retorno = false;
        $role = Role::where('name',$rol)->get();


        if ($rol == 'contacto') {
            $user_id = $datos['contacto_id']; 
        }else{
            $user_id = $datos['user_id']; 
        }

        $usuario = User::find($user_id);
        if (!count($usuario)) {

            if ($rol == 'contacto') {
                $retorno = 'error_contacto';
            }else{
                $retorno = 'error_usuario';
            }
            goto end;
        }
        //ASIGNAR EL ROL DE estudiante 

        if ( !$usuario->hasAllRoles($role) ) {
            $usuario->assignRole($rol);
        }

        //ASIGNAR EL campus al estudiante
        $usuario->campus()->syncWithoutDetaching($campus);

        if ($rol == 'contacto') {
            $usuario_principal = User::find($datos['user_id']);
            if (!count($usuario_principal)) {
                $retorno = 'error_usuario';
                goto end;
            }
            $usuario_principal->contacto()->sync([$usuario->id => ['parentesco' => $datos['contacto_parentesco']]]);
        }

        switch ($tipo) {
            case 'estudiante':

                $retorno = $usuario;
                
                break;
            case 'contacto':

                $retorno = $usuario;
                
                break;
            case 'coordinador_externo':

                $retorno = $usuario;
                
                break;        
        }

        end:
        return $retorno;
    }



    /**
     * Remove the specified PasosInscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function validarAcceso($tipo,$user_id,$inscripcion_id = '')
    {   


        $retorno = [];
        $retorno['ok'] = false;
        $institucion = 0;
        if($tipo == 'editar'){

            $rolesUsuario = DB::table('model_has_roles')->join('roles','model_has_roles.role_id','roles.id')->where('model_has_roles.model_id',$user_id )->pluck('roles.name')->toArray();

            //filtra los pasos en los que estan asociados validadores, $this->tipos_pasos es un query de la tabla tipo_paso con left join a user_tipo_paso y a model_has_roles para mostrar los validadores asociados
            $pasos_validacion = array_filter($this->tipos_pasos, function($var){
                return ($var['user_id'] != '');
            });
            // print_r($pasos_validacion);
            $tipo_paso = [];

            //como pueden haber varios validadores asociados a un mismo paso, $tipo_paso se crea mediante este ciclo filtrando los pasos sin repeticion
            foreach ($pasos_validacion as $key => $value) {

                if (count($tipo_paso) >= 1) {
                    $existe = array_search($value['id'], array_column($tipo_paso, 'id'));
                }else{
                    $existe = false;
                }
                if ($existe === false) {
                    $tipo_paso[] = $value;
                }
            }
            // print_r($tipo_paso);
            //si el usuario no tiene roles devuelve false
            if (empty($rolesUsuario)) {
                $retorno['ok'] = false;
                goto end;
            }
            //buscar si el usuario pertenece a la inscripcion (coordinador o estudiante)
            $usuarioInscripcion = DB::table('inscripcion')
                        ->where('inscripcion.id',$inscripcion_id)
                        ->where('inscripcion.user_id',$user_id )
                        ->select('inscripcion.user_id')
                        ->first();

            if (empty($usuarioInscripcion) && (array_search('coordinador_externo', $rolesUsuario) !== false || array_search('coordinador_interno', $rolesUsuario) !== false)) {
                //busca a los estudiantes
                $usuarioInscripcion = DB::table('postulacion')
                        ->where('postulacion.inscripcion_id',$inscripcion_id)
                        ->where('postulacion.user_id',$user_id )
                        ->select('postulacion.user_id')
                        ->first();
            }

            
            //este if se movio mas abajo debido a que cuando consultan para previsualizar los datos  o desde la parte de validacion no va a poder entrar aqui y no se mostraran todos los datos
            // if (!empty($usuarioInscripcion)) {
                // $registrosPasos = \App\Models\Validation\PasosInscripcion::where('inscripcion_id',$inscripcion_id)->select('id','user_id','estado_id','tipo_paso_id')->orderBy('tipo_paso_id','asc')->get()->toArray();

                //obtiene la lista de todos los estados
                $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
                
                $estadosValidatorData = array_filter($estadosData, function($var){
                    return ($var['uso'] == 'VALIDATOR');
                });


                reset($estadosValidatorData);


                //
                $keySearchAprobado = array_search('APROBADO', array_column($estadosValidatorData,'nombre') );
                $keySearchActiva = array_search('ACTIVA', array_column($estadosValidatorData,'nombre') );
                $keySearchRechazado = array_search('RECHAZADO', array_column($estadosValidatorData,'nombre') );
                $keySearchEnRevision = array_search('EN REVISIÓN', array_column($estadosValidatorData,'nombre') );
                $keySearchGenerar = array_search('GENERAR DOCUMENTO', array_column($estadosValidatorData,'nombre') );

                $keysEstadosValidador = array_keys($estadosValidatorData);

                $keyEstadoAprobado = $keysEstadosValidador[$keySearchAprobado];
                $keyEstadoActiva = $keysEstadosValidador[$keySearchActiva];
                $keyEstadoRechazado = $keysEstadosValidador[$keySearchRechazado];
                $keyEstadoEnRevision = $keysEstadosValidador[$keySearchEnRevision];
                $keyEstadoGenerar = $keysEstadosValidador[$keySearchGenerar];
                /*
                $estaRechazado = array_search($estadosValidatorData[$keyEstadoRechazado]['id'], array_column($registrosPasos,'estado_id'));
                $estaEnRevision = array_search($estadosValidatorData[$keyEstadoEnRevision]['id'], array_column($registrosPasos,'estado_id'));
                $estaGenerar = array_search($estadosValidatorData[$keyEstadoGenerar]['id'], array_column($registrosPasos,'estado_id'));
                */
                $estaAprobadoId = $estadosValidatorData[$keyEstadoAprobado]['id'];
                $estaActivaId = $estadosValidatorData[$keyEstadoActiva]['id'];
                $estaRechazadoId = $estadosValidatorData[$keyEstadoRechazado]['id'];
                $estaEnRevisionId = $estadosValidatorData[$keyEstadoEnRevision]['id'];
                $estaGenerarId = $estadosValidatorData[$keyEstadoGenerar]['id'];

                // $estaRechazado = array_search($estadosValidatorData[$keyEstadoRechazado]['id'], array_column($registrosPasos,'estado_id'));

//esto tiene que ser dinamico debido a que no hay solo un punto de validacion
                /*
            $paso = 4;
                $tipo_paso = $this->tipoPaso->where('nombre','paso'.$paso.'_interchange')->pluck('id')->first();
                $keyPasoInscripcion = array_search($tipo_paso, array_column($registrosPasos, 'tipo_paso_id') );
                */

                //obtiene el registro de los pasos en donde esta asociado algun validador y si existe un email  muestra los datos tambien
                $dataEmail = \App\Models\Validation\PasosInscripcion::leftJoin('pasos_inscripcion_email','pasos_inscripcion.id','pasos_inscripcion_email.pasos_inscripcion_id')
                    ->leftJoin('email', 'pasos_inscripcion_email.email_id', '=', 'email.id')
                    ->where('pasos_inscripcion.inscripcion_id',$inscripcion_id)
                    ->whereIn('pasos_inscripcion.tipo_paso_id', array_column($tipo_paso, 'id') )
                    ->select('email.*','pasos_inscripcion.id AS pasos_inscripcion_id','pasos_inscripcion.user_id','pasos_inscripcion.estado_id','pasos_inscripcion.tipo_paso_id')
                    ->orderBy('email.created_at','asc');

                // echo $dataEmail->toSql().' |inscripcion_id:'.$inscripcion_id.' |$tipo_paso:'.implode(',', array_column($tipo_paso, 'id'));
                $dataEmail = $dataEmail->get()->toArray();
                // echo 'dataEmail:';
                // print_r($dataEmail);
                
                foreach ($dataEmail as $key => $value) {
                    $keyEstadoDelPaso = array_search($value['estado_id'], array_column($estadosData, 'id'));
                    $estadoDelPaso = $estadosData[$keyEstadoDelPaso];
                    $registrosDelPaso = array_filter($dataEmail, function($var) use ($value) {
                        return ($var['tipo_paso_id'] == $value['tipo_paso_id']);
                    });
                    $retorno['tipo_paso_id'] = $value['tipo_paso_id'];
// print_r('estadoDelPaso:');
// print_r($estadoDelPaso);
// print_r('retorno[ok]:');
// var_dump($retorno['ok']);
                    // if ($value['estado'] == 1 && count($dataEmail) == ($key+1) && !in_array($value['estado_id'],[$estaRechazadoId,$estaEnRevisionId,$estaGenerarId])) {

                    //VALIDAR TODO A PARTIR DEL USO DEL TIPO DE ESTADO DEL USUARIO 
                    if ($estadoDelPaso['uso'] == 'USER') {
                        //si el estado del email es 1 (enviado) retorna: false porque tiene que esperar una respuesta del correo enviado para poder continuar
                        if ($value['estado'] == 1 ){
                            $retorno['ok'] = false;
                            $retorno['paso_incompleto'] = $value['tipo_paso_id'];
                        }else{
                            $retorno['ok'] = true;
                            $retorno['paso_incompleto'] = $value['tipo_paso_id'];
        // echo "string salio por aqui:".$retorno['paso_incompleto'];
                        }
                    }elseif ($estadoDelPaso['uso'] == 'VALIDATOR') {
                        //si ha sido rechazado retorna: true porque puede editar los datos para volverlos a enviar
                        if (in_array($value['estado_id'],[$estaRechazadoId]) ) {
                            if ($retorno['ok'] === true) {
                                $retorno['ok'] = true;
                                $retorno['paso_incompleto'] = $value['tipo_paso_id'];
                                goto end;
                                break;
                            }
                        //si esta en revision o se genero el documento final retorna: false porque no puede editar los datos
                        }elseif (in_array($value['estado_id'],[$estaEnRevisionId,$estaGenerarId]) ) {

                            $retorno['ok'] = false;
                            $retorno['paso_incompleto'] = $value['tipo_paso_id'];

                        //si esta aprobado retorna: true y si es el ultimo registro 
                        }elseif ($value['estado_id'] == $estaAprobadoId ) {
                            
                        // echo "string salio por aqui, estado_id:".$value['estado_id']."|estaAprobadoId:".$estaAprobadoId.'retorno[ok]:'.$retorno['ok'].'|';
                            /*
                            //esto validaba si estaba aprobado y si todo estaba bien, pero se salia antes de los necesario
                            if ($retorno['ok'] === true) {
                                $retorno['ok'] = true;
                                $retorno['paso_incompleto'] = $value['tipo_paso_id'];
                                goto end;
                                break;
                            }else{
                            */
                            // echo ' se metio aqui';
                                $ultimoPaso = end($tipo_paso);
                                $ultimoRegistro = end($dataEmail);
                                // si el ultimo registro en los pasos de validacion en la tabla pasos_inscripcion es menor al ultimo paso posible por registrar entonces retorna: true
                                if ($ultimoRegistro['tipo_paso_id'] < $ultimoPaso['id'] ) {
                                    $retorno['ok'] = true;
                                    $keyPasoSiguiente = array_search($value['tipo_paso_id'], array_column($tipo_paso, 'id'));
                                    $retorno['paso_incompleto'] = $tipo_paso[intval($keyPasoSiguiente) +1]['id'];
                                    if (count($dataEmail) == ($key+1)) {
                                        // echo ' y aqui termino';
                                        // goto end;
                                        break;
                                    }
                                }else{
                                    $retorno['ok'] = false;
                                    $retorno['paso_incompleto'] = $value['tipo_paso_id'];
                                }
                            // }
                        }
                    }
                }

                if (count($dataEmail) && $retorno['ok'] === false) {
                    // echo ' y aqui termino';
                    goto end;
                }

            if (!empty($usuarioInscripcion)) {
                // $ultimaValidacion = end($dataEmail);

                if ( count($dataEmail) > 0 || empty($dataEmail) ) {
                    if (array_search('coordinador_externo', $rolesUsuario) !== false) {

                        $retorno['ok'] = true;
                        $retorno['user_actual_role'] = 'coordinador_externo';
                        goto end;
                        
                    }elseif (array_search('coordinador_interno', $rolesUsuario) !== false) {

                        $retorno['ok'] = true;
                        $retorno['user_actual_role'] = 'coordinador_interno';
                        goto end;

                    }elseif (array_search('estudiante', $rolesUsuario) !== false) {

                        $retorno['ok'] = true;
                        $retorno['user_actual_role'] = 'estudiante';
                        goto end;

                    }
                }

            }else{
            //si no hacen parte de la creacion de la inscripcion entonces verificar que pertenezcan a la misma institucion y tengan el rol especifico para poder editar la inscripcion
        //POR AHORA NO VA A PERMITIR ESTO (SOLAMENTE LOS QUE PERTENEZCAN)
                
                $retorno['ok'] = false;
                goto end;

                if (session('campusApp') == null) {
                    if ( isset($this->campusApp[0]) ) {
                        return false;
                    }elseif(count($this->campusApp)){
                        if (!$institucion = $this->campusApp->first()->institucion_id) {
                            return false;
                        }
                    }

                }else{
                    
                    $institucionId = \App\Models\Admin\Campus::where('id',session('campusApp'))
                        ->select('institucion_id')
                        ->first();
                    if(empty($institucionId)){
                        return false;
                    }else{
                        $institucionId = $institucionId->institucion_id;
                    }
                }
                
                if ($institucionId != 0) {
                    $institucionInscripcion = DB::table('inscripcion')
                        ->join('campus','inscripcion.campus_id','campus.id')
                        ->where('campus.institucion_id',$institucionId)
                        ->where('inscripcion.id',$inscripcion_id )
                        ->select('campus.institucion_id')
                        ->first();

                    //si hace parte regresar el rol del usuario
                    if (!empty($institucionInscripcion)) {
                        
                        if (array_search('coordinador_externo', $rolesUsuario) !== false) {
                            $retorno = 'coordinador_externo';
                        }elseif(array_search('coordinador_interno', $rolesUsuario) !== false){
                            $retorno = 'coordinador_interno';
                        }elseif(array_search('profesor', $rolesUsuario) !== false){
                            $retorno = 'profesor';
                        }elseif(array_search('estudiante', $rolesUsuario) !== false){
                            $retorno = 'estudiante';
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }
            }


        }

        end:
        return $retorno;

    }
}
