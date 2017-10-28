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
use App\Http\Traits\AdminDocs;
use PDF;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


class InterAllianceController extends AppBaseController
{
    use Authorizable;
    use Mails;
    use Validador;
    use AdminDocs;
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
    private $tipoRuta;



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
                    $this->campusApp = [0 => 'No pertenece a alguna institución.'];
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

        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();

        $this->tipoRuta = $name;
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
    public function crearPaso($paso,$estado,$alianzaId,$userId,$observacion = '')
    {
        //$userId = $this->user->id;
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

                $pasoAlianza = \App\Models\Validation\PasosAlianza::updateOrCreate(
                    ['tipo_paso_id' => $tipo_paso, 'alianza_id' => $alianzaId, 'user_id' => $userId],
                    ['estado_id' => $estado, 'observacion' => $observacion]
                );

                if ( $pasoAlianza ){
                    //$this->notificarPaso($paso,$estado,$alianzaId);
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
        
        $this->user = Auth::user();
        $thisUserRoles = DB::table('model_has_roles')->where('model_id',$this->user->id)->pluck('role_id')->toArray();

        //obtener los datos de los coordinadores de la alianza
        $rolesUsuarios = Role::whereIn('name',['coordinador_interno','coordinador_externo','copia_oculta_email'])->select('id','name')->get()->toArray();
        $roleCoordinadorInterno = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'coordinador_interno');
        });
        $roleCoordinadorExterno = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'coordinador_externo');
        });
        $roleCopiaEmails = array_filter($rolesUsuarios, function($var){
            return ($var['name'] == 'copia_oculta_email');
        });
        reset($roleCoordinadorInterno);
        reset($roleCoordinadorExterno);
        reset($roleCopiaEmails);
        $keyRoleCoorInt = key($roleCoordinadorInterno);
        $keyRoleCoorExt = key($roleCoordinadorExterno);
        $keyRoleCopiaEmail = key($roleCopiaEmails);

        $roleCopiaEmails = $roleCopiaEmails[$keyRoleCopiaEmail]['id'];

        

        $alianzas = \App\Models\Alianza::orderByDesc('updated_at')->get()->toArray();

        if( session('campusApp') != null ){
            $campusAppId = session('campusApp');
            $campusApp = \App\Models\Admin\Campus::find($campusAppId);
            if( !count($campusApp) ){
                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                return redirect(route('home'));
            }
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('home'));
        }
        $institucionId = $campusApp->institucion->id;

        //nombre institucion destino
        //tipo institucion destino
        $institucionesData = \App\Models\Admin\Institucion::select('alianza_institucion.alianza_id AS alianza_id','institucion.id AS institucion_id','institucion.nombre AS institucion_nombre','tipo_institucion.nombre AS tipo_institucion_nombre')
            ->join('alianza_institucion','institucion.id','alianza_institucion.institucion_id')
            ->join('tipo_institucion','institucion.tipo_institucion_id','tipo_institucion.id')
            ->where('institucion.id','<>',$institucionId)
            ->whereIn('alianza_institucion.alianza_id',array_column($alianzas, 'id'))
            ->get()->toArray();

        if (count($institucionesData)) {
            $campusData = \App\Models\Admin\Institucion::select('institucion.id AS institucion_id','campus.ciudad_id AS campus_ciudad_id')
                ->join('campus','institucion.id','campus.institucion_id')
                ->where('campus.principal',1)
                ->whereIn('institucion.id',array_column($institucionesData, 'institucion_id'))
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
            foreach ($institucionesData as $keyinstitucionesData => $institucion) {
                foreach ($campusData as $keycampusData => $campus) {
                    if ($institucion['institucion_id'] == $campus['institucion_id']) {
                        $institucionesData[$keyinstitucionesData]['campus'] = $campus;
                    }
                }
            }
            //asociar los datos de la institucion a la alianza
            foreach ($alianzas as $keyalianzas => $alianza) {
                foreach ($institucionesData as $keyinstitucionesData => $institucion) {
                    if ($alianza['id'] == $institucion['alianza_id']) {
                        $alianzas[$keyalianzas]['institucion'] = $institucion;
                    }

                }
                if (!isset($alianzas[$keyalianzas]['institucion'])) {
                    $alianzas[$keyalianzas]['institucion']['institucion_nombre'] = '';
                    $alianzas[$keyalianzas]['institucion']['campus']['ciudad']['pais']['pais_nombre'] = '';
                    $alianzas[$keyalianzas]['institucion']['tipo_institucion_nombre'] = '';    
                }
            }

        }else{
            foreach ($alianzas as $keyalianzas => $alianza) {
                $alianzas[$keyalianzas]['institucion']['institucion_nombre'] = '';
                $alianzas[$keyalianzas]['institucion']['campus']['ciudad']['pais']['pais_nombre'] = '';
                $alianzas[$keyalianzas]['institucion']['tipo_institucion_nombre'] = '';
            }
        }
        $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
        //filtra las validaciones que aprobaron o activaron la alianza
        $estadoValidacionActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'VALIDATOR' && $var['nombre'] == 'ACTIVA');
        });
        $estadoAlianzaActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        reset($estadoAlianzaActiva);
        reset($estadoValidacionActiva);
        $keyEstadoAlianza = key($estadoAlianzaActiva);
        $keyEstadoValidacion = key($estadoValidacionActiva);

        //documentos de las alianzas
        $tipo_documento_id = \App\Models\TipoDocumento::where('nombre','DOCUMENTOS FINALES ALIANZA')->pluck('id');
        $documentosAlianzaData =  \App\Models\DocumentosAlianza::join('archivo','documentos_alianza.archivo_id','archivo.id')
            ->whereIn('documentos_alianza.alianza_id',array_column($alianzas, 'id'))
            ->whereIn('tipo_documento_id',$tipo_documento_id)
            ->orderBy('documentos_alianza.updated_at','desc')
            ->select('documentos_alianza.alianza_id','archivo.nombre','archivo.id','archivo.path')
            ->get()->toArray();



        $dataUsers = DB::table('alianza_user')
                ->join('users', 'alianza_user.user_id', '=', 'users.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->whereIn('alianza_user.alianza_id',array_column($alianzas, 'id') )
                ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno[$keyRoleCoorInt]['id'],$roleCoordinadorExterno[$keyRoleCoorExt]['id']] )
                ->select('alianza_user.alianza_id AS alianza_id','users.id AS usuario_id','users.name AS usuario_name','model_has_roles.role_id')
                ->orderBy('alianza_user.alianza_id','asc')
                ->get()->toArray();

        $CoordinadoresExternosId = array();
        $CoordinadoresInternosId = array();

        // if (count($dataUsers) < 2 ) {
        //     $CoordinadoresExternosId = 0;
        //     $CoordinadoresInternosId = 0;
        // }

        foreach ($dataUsers as $data => $user) {
            if ($user->role_id == $roleCoordinadorInterno[$keyRoleCoorInt]['id']) {
                $CoordinadoresInternosId[$user->alianza_id] = $user->usuario_id;
            }elseif ($user->role_id == $roleCoordinadorExterno[$keyRoleCoorExt]['id']) {
                $CoordinadoresExternosId[$user->alianza_id] = $user->usuario_id;
            }
        }

        //calcular las fechas
        foreach ($alianzas as $keyalianzas => $alianza) {
            $estadoAlianzaActual = array_search($alianzas[$keyalianzas]['estado_id'], array_column($estadosData, 'id'));
            $alianzas[$keyalianzas]['estado_nombre'] = $estadosData[$estadoAlianzaActual]['nombre'];
            // created_at sin hora
            if ( empty($alianzas[$keyalianzas]['fecha_inicio']) ) {
                $alianzas[$keyalianzas]['fecha_inicio'] = '????-??-??';
            }else{
                $alianzas[$keyalianzas]['fecha_inicio'] = date('Y-m-d', strtotime($alianzas[$keyalianzas]['fecha_inicio']));    
            }

            // $alianzas[$keyalianzas]['fecha_inicio'] = date('Y-m-d', strtotime($alianzas[$keyalianzas]['fecha_inicio']));
            $alianzas[$keyalianzas]['created_at'] = date('Y-m-d', strtotime($alianzas[$keyalianzas]['created_at']));
            $alianzas[$keyalianzas]['updated_at'] = date('Y-m-d', strtotime($alianzas[$keyalianzas]['updated_at']));

            //convertir la duracion para poderla sumar a la fecha de actualizacion
            $duracion = str_replace("MESES", "month", $alianzas[$keyalianzas]['duracion']);
            $duracion = str_replace("AÑOS", "year", $duracion);
            
            $alianzas[$keyalianzas]['fecha_final'] = '????-??-??';
            $alianzas[$keyalianzas]['tiempo_restante'] = '?';
            //calcular las fechas y obtener el documento de las alianzas activas
            if ($alianzas[$keyalianzas]['estado_id'] == $estadoAlianzaActiva[$keyEstadoAlianza]['id']) {
                foreach ($documentosAlianzaData as $keydocumentosAlianzaData => $documentoAlianza) {
                    if ($alianza['id'] == $documentoAlianza['alianza_id']) {
                        $alianzas[$keyalianzas]['archivo'] = $documentoAlianza;
                    }

                }

                // calcular fecha final: fecha_inicio + duracion 
                $alianzas[$keyalianzas]['fecha_final'] = strtotime ( '+'.$duracion , strtotime ( $alianzas[$keyalianzas]['fecha_inicio'] ) );
                $alianzas[$keyalianzas]['fecha_final'] = date('Y-m-d', $alianzas[$keyalianzas]['fecha_final'] );

                // calcular restante: fecha_inicio - duracion
                $date1 = new \DateTime('now');
                $date2 = new \DateTime($alianzas[$keyalianzas]['fecha_final']);
                $diff = $date1->diff($date2);
                
                $alianzas[$keyalianzas]['tiempo_restante'] = $this->get_format($diff);
            }
        }

        //calcular los datos de pasos y validaciones
        if (count($alianzas)) {
            //(# validadores aprobado * 100) / # validadores total 
            // $estadosData = \App\Models\Estado::where('uso','VALIDATOR')->select('id','nombre')->get()->toArray();
            // $estadoAprobadoId = array_search('APROBADO', array_column($estadosData, 'nombre') );
            $tipos_pasos = $this->tipoPaso->where('nombre','like','%_alianza')->select('id','nombre','titulo')->get()->toArray();
            
            $totalValidadores = \App\Models\Validation\UserPaso::select('users.id', 'users.name', 'users.email', 'user_tipo_paso.titulo')
                        ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->whereIn('user_tipo_paso.tipo_paso_id',array_column($tipos_pasos, 'id') )
                        ->where('model_has_roles.role_id','<>',$roleCopiaEmails )
                        ->groupBy('user_tipo_paso.id')
                        ->get()->toArray();
            
            if (count($totalValidadores)) {

                $pasosAlianzaData = \App\Models\Validation\PasosAlianza::select('pasos_alianza.id','pasos_alianza.alianza_id AS alianza_id','pasos_alianza.user_id AS user_id','pasos_alianza.tipo_paso_id AS tipo_paso_id','pasos_alianza.observacion','pasos_alianza.estado_id AS estado_id','estado.nombre AS estado_nombre','estado.uso AS estado_uso')
                    ->join('estado','pasos_alianza.estado_id','estado.id')
                    ->join('alianza','pasos_alianza.alianza_id','alianza.id')
                    ->whereIn('alianza.id',array_column($alianzas, 'id'))
                    ->whereIn('pasos_alianza.tipo_paso_id',array_column($tipos_pasos, 'id'))
                    ->orderBy('pasos_alianza.tipo_paso_id','asc');
                    //->whereIn('pasos_alianza.estado_id',array_column($estadosData, 'id'))

                // echo $pasosAlianzaData->toSql();
                // print_r( $pasosAlianzaData->getBindings() );

                $pasosAlianzaData = $pasosAlianzaData->get()->toArray();
                // print_r( $pasosAlianzaData );

                //crea un array con el id del paso y el numero del paso real
                $numero_paso = array();
                foreach ($tipos_pasos as $tipo_paso) {
                    $numero_paso[$tipo_paso['id']] = ['orden' => str_replace("_","",substr($tipo_paso['nombre'],strpos($tipo_paso['nombre'],"paso")+4,2)), 'titulo' => $tipo_paso['titulo']];
                }
                
                
                // nombre validadores aprobado
                //asociar los datos de los validadores a la alianza
                $numeroValidadoresData = 0;
                foreach ($alianzas as $keyalianzas => $alianza) {
                    $alianzas[$keyalianzas]['pasos_registrados'] = 0;
                    $alianzas[$keyalianzas]['total_pasos'] = count($tipos_pasos);
                    $alianzas[$keyalianzas]['validaciones'] = array();
                    $alianzas[$keyalianzas]['estado_actual'] = '';
                    
                    foreach ($pasosAlianzaData as $keypasosAlianzaData => $pasoAlianza) {
                        if ($alianza['id'] == $pasoAlianza['alianza_id']) {
                            if ($pasoAlianza['estado_uso'] == 'USER' || $pasoAlianza['estado_uso'] == 'EXTERNAL') {
                                //agregar a los coordinadores a la lista de validaciones
                                
                                if( $pasoAlianza['user_id'] == $CoordinadoresExternosId[$alianza['id']] ){
                                    $pasoAlianza['validador_titulo'] = 'Coordinador Externo';
                                }elseif( $pasoAlianza['user_id'] == $CoordinadoresInternosId[$alianza['id']] ){
                                    $pasoAlianza['validador_titulo'] = 'Coordinador Interno';
                                }else{
                                    $pasoAlianza['validador_titulo'] = 'Otro usuario';
                                }
                                if($pasoAlianza['tipo_paso_id'] <= 3){
                                    $keyValidacion = 1;
                                }else{
                                    $keyValidacion = 2;
                                }
                                $alianzas[$keyalianzas]['validaciones'][$keyValidacion] = $pasoAlianza;
                                
                                if ( $pasoAlianza['estado_nombre'] != 'INCOMPLETO' ) {
                                    $alianzas[$keyalianzas]['pasos_registrados'] = $numero_paso[$pasoAlianza['tipo_paso_id']]['orden'];
                                }
                                if ( $pasoAlianza['estado_uso'] == 'EXTERNAL' && in_array($pasoAlianza['estado_nombre'], ['ACEPTADO','DECLINADO']) ) {
                                    $alianzas[$keyalianzas]['validacion_coor_ext'] = $pasoAlianza['estado_nombre'].': '.$pasoAlianza['observacion'];
                                }
                            }elseif($pasoAlianza['estado_uso'] == 'VALIDATOR') {
                                $keyValidador = array_search($pasoAlianza['user_id'], array_column($totalValidadores, 'id'));
                                $pasoAlianza['validador_titulo'] = $totalValidadores[$keyValidador]['titulo'];
                                $alianzas[$keyalianzas]['validaciones'][$pasoAlianza['id']] = $pasoAlianza;
                            }
                        }
                    }
                    $keyEsValidador = array_search($this->user->id, array_column($totalValidadores, 'id'));
                    if ($keyEsValidador !== false && $alianzas[$keyalianzas]['estado_id'] != $estadoAlianzaActiva[$keyEstadoAlianza]['id']) {
                        $alianzas[$keyalianzas]['validador'] = true;
                    }elseif( $this->user->id == $CoordinadoresExternosId[$alianza['id']] || array_search($roleCoordinadorExterno[$keyRoleCoorExt]['id'], $thisUserRoles) !== false ){
                        $alianzas[$keyalianzas]['coordinador_externo'] = true;
                    }elseif( $this->user->id == $CoordinadoresInternosId[$alianza['id']] || array_search($roleCoordinadorInterno[$keyRoleCoorInt]['id'], $thisUserRoles) !== false ){
                        $alianzas[$keyalianzas]['coordinador_interno'] = true;
                    }
                    
                    //print_r($alianzas[$keyalianzas]);
                    
                    //filtra las validaciones que aprobaron o activaron la alianza
                    $validacionesAprobadas = array_filter($alianzas[$keyalianzas]['validaciones'], function($var){
                        // Retorna siempre que el número entero sea par
                        return ($var['estado_nombre'] == 'APROBADO' || $var['estado_nombre'] == 'ACTIVA');
                    });
        // print_r($alianzas[$keyalianzas]['validaciones']);
        // print_r($validacionesAprobadas);
                    if ($alianzas[$keyalianzas]['pasos_registrados'] < $alianzas[$keyalianzas]['total_pasos']) {
                        
                        $pasos_registrados = intval( $alianzas[$keyalianzas]['pasos_registrados'] )+1;
                        $alianzas[$keyalianzas]['estado_actual'] = 'Pendiente por continuar en el paso '. $pasos_registrados . ' "'. $numero_paso[$pasos_registrados]['titulo'] .'"';
                        
                        // $alianzas[$keyalianzas]['estado_actual'] = 'Pendiente por continuar en el paso '. $alianzas[$keyalianzas]['pasos_registrados']+1;
                    }else{
                    // }elseif ($alianzas[$keyalianzas]['pasos_registrados'] == $alianzas[$keyalianzas]['total_pasos']) {
                        if (count($alianzas[$keyalianzas]['validaciones'])) {
                            $ultimaValidacion = end($alianzas[$keyalianzas]['validaciones']);
                            if ($ultimaValidacion['estado_nombre'] == 'GENERAR DOCUMENTO' && $ultimaValidacion['user_id'] == $this->user->id) {
                                
                                $alianzas[$keyalianzas]['tipo_paso_id'] = $ultimaValidacion['tipo_paso_id'];
                                $alianzas[$keyalianzas]['user_id'] = $ultimaValidacion['user_id'];
                                $alianzas[$keyalianzas]['estado_id'] = $estadoValidacionActiva[$keyEstadoValidacion]['id'];
                                unset($alianzas[$keyalianzas]['archivo']);
                            }
                            $keyTotalValidadores = array_search($ultimaValidacion['user_id'], array_column($totalValidadores, 'id'));
                            $alianzas[$keyalianzas]['estado_actual'] = $ultimaValidacion['estado_nombre'].' por '.$totalValidadores[$keyTotalValidadores]['titulo'];
                        }else{
                            $alianzas[$keyalianzas]['estado_actual'] = 'Pendiente por validacion.';
                        }
                    }
                    
                    $progresoActual = intval($alianzas[$keyalianzas]['pasos_registrados']);
                    $progresoActual += count($validacionesAprobadas);
                    $progresoTotal = intval($alianzas[$keyalianzas]['total_pasos']);
                    $progresoTotal += count($totalValidadores);

                    $alianzas[$keyalianzas]['progreso'] = intval( ($progresoActual * 100 ) / $progresoTotal );
                }
            }
        }

        //print_r($alianzas);
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
        //$RouteName = Route::currentRouteName();
        //echo session('campusApp');
        if( session('campusApp') != null ){
            $campusAppId = session('campusApp');
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('interalliances.index'));
        }

        $campusApp = \App\Models\Admin\Campus::find($campusAppId);
        if( !count($campusApp) ){
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('interalliances.index'));
        }
                
        //print_r($this->paso_titulo);
        $institucionId = $campusApp->institucion->id;

        $alianzas = DB::table('alianza')->join('alianza_institucion','alianza.id','alianza_institucion.alianza_id')
            ->where('alianza_institucion.institucion_id','<>',$institucionId)
            ->whereNull('alianza.deleted_at')
            ->select(DB::raw('count(*) As conteo'),'alianza.*','alianza_institucion.institucion_id')
            ->groupBy('alianza_institucion.institucion_id')
            ->get()->toArray();

        // print_r($alianzas);
        // echo '<br> -------------------------------- <br>';

        $departamentosAlianzas = DB::table('campus')->join('ciudad','campus.ciudad_id','ciudad.id')
            ->where('campus.principal',1)
            ->whereIn('campus.institucion_id',array_column($alianzas, 'institucion_id'))
            ->select(DB::raw('count(*) As conteo'),'ciudad.departamento_id','campus.institucion_id')
            ->groupBy('campus.institucion_id')
            ->get()->toArray();

        //multiplicar la cantidad de alianzas por institucion con la cantidad por departamento
        foreach ($alianzas as $keyalianzas => $alianza) {
            foreach ($departamentosAlianzas as $keydepartamentos => $departamento) {
                if ($alianza->institucion_id == $departamento->institucion_id) {
                    $departamento->conteo_total = $alianza->conteo;
                    $departamento->alianza = $alianza;
                }
            }
        }

        // print_r($departamentosAlianzas);
        // echo '<br> -------------------------------- <br>';

        $paisesAlianzas = DB::table('pais')->join('departamento','pais.id','departamento.pais_id')
            ->whereIn('departamento.id',array_column($departamentosAlianzas, 'departamento_id'))
            ->select(DB::raw('count(*) As conteo'),'departamento.id AS departamento_id','pais.id','pais.nombre','pais.codigo_ref')
            ->groupBy('pais.id')
            ->get()->toArray();

        //multiplicar la cantidad de alianzas totales parciales con la cantidad por pais
        foreach ($paisesAlianzas as $keypaisesAlianzas => $pais) {
            $pais->conteo_total = 0;
            $pais->departamento = array();
            foreach ($departamentosAlianzas as $keydepartamentos => $departamento) {
                if ($pais->departamento_id == $departamento->departamento_id) {
                    $pais->conteo_total += $departamento->conteo_total;
                    $pais->departamento[] = $departamento;
                }
            }
        }

        // print_r($paisesAlianzas);
        // echo '<br> -------------------------------- <br>';

        return view('InterAlliance.map')
            ->with(['campusApp' => $this->campusApp, 'peticion' => $this->peticion, 'paisesAlianzas' => $paisesAlianzas]);
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
    public function destination(Request $request, $id_o_token)
    {
        $buscarAlianza = \App\Models\Alianza::where('token',$id_o_token)->select('id','token')->first();

        if ( !count($buscarAlianza) ) { 
            $buscarAlianza = $this->alianzaRepository->findWithoutFail($id_o_token);
        }

        if ( count($buscarAlianza) > 0 ) { 

            if ( Auth::guest() ) {
                if(isset($request['email'],$request['password'])) {
                    if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
                        
                        Flash::error('La autenticación es incorrecta.');

                        return redirect(route('login'));
                    }
                }else{
                    $viewWith = ['tipoRuta' => $this->tipoRuta, 'peticion' => 'normal', 'route' => route('interalliances.destination',$id_o_token)];
                    return view('auth.login')
                    ->with($viewWith);
                }
            }

            /*
            $validarAcceso = $this->validarAcceso('editar',$this->user->id,$alianzaId);

            if ($validarAcceso === 'coordinador_externo') {
                return redirect(route('interalliances.destination.edit',$alianzaId));
            }elseif($validarAcceso === false){
                Flash::error('No tiene permitido editar esta alianza');

                return redirect(route('interalliances.index'));
            }
            */
            $this->user = Auth::user();

            $viewWith = [];
            $alliance = [];
            //$existeRepresentante = false;
            $alianzaId = $buscarAlianza->id;


            //solicita los datos de la alianza
            $datosAlianza = $this->show($alianzaId, 'local');
            //$datosAlianza = $this->datosAlianza($alianzaId,'destination','ver',0);

            $keyCoordExterno = $datosAlianza['keyCoordExterno'];

            //verifica y autentica al usuario externo
            if ( isset($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id'])  ) {

                if ($this->user->id != $datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id']) {
                    Flash::error('No tiene permitido el acceso a este proceso de la alianza');

                    return redirect(route('interalliances.index'));
                }
                
            }else{
                return \View::make('errors.404')->with(['peticion' => $this->peticion]);
                
            }

            $viewWith = array_merge($viewWith, $datosAlianza); 
            //validar que el usuario sea coordinador_externo
            $role = Role::where('name','coordinador_externo')->get();
            //ASIGNAR EL ROL DE coordinador_interno 
            if ( $this->user->hasAllRoles($role) ) {
                $viewWith = array_merge($viewWith, ['ruta' => 'destination']);
            }
            $viewWith = array_merge($viewWith, ['tipoRuta' => $this->tipoRuta,'peticion' => 'normal']);

            return view('InterAlliance.show')
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
    public function origin($alianzaId = '',$origen_peticion = '')
    {
        // if ( $alianzaId != '' && $origen_peticion != 'local' && $this->peticion != 'ajax' ) {
        if ( $origen_peticion != 'local' && $this->peticion != 'ajax' ) {
            $role = Role::where('name','coordinador_externo')->get();
            //VERIFICAR EL ROL DE coordinador_externo 
            if ( $this->user->hasAllRoles($role) ) {
                //echo $alianzaId;
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                if ( $alianzaId != '' ){
                    return redirect(route('interalliances.destination',$alianzaId));
                }else{
                    Flash::error('No tiene permiso para acceder a este modulo.');

                    return redirect(route('interalliances.index'));
                }
            }
            //return \View::make('errors.404')->with(['peticion' => $this->peticion]);
        }

        //$RouteName = Route::currentRouteName();
        //echo session('campusApp');
        if( session('campusApp') != null ){
            $campusAppId = session('campusApp');
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('interalliances.index'));
        }

        $campusApp = \App\Models\Admin\Campus::find($campusAppId);
        if( !count($campusApp) ){
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('interalliances.index'));
        }
                
        //print_r($this->paso_titulo);
        $institucionId = $campusApp->institucion->id;
        
        //falta conocer a que campus pertenece el usuario y asi asociar todo a ese mismo campus
        //$userCampus = $campusApp->id mpus_id;
        $this->userCampus = $campusApp->id;
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
                    ->where('user_campus.campus_id',$this->userCampus)->role(['coordinador_interno','profesor'])->select(DB::raw('concat(users.name," (",users.email,")")'),'users.id');
        $coordinador_origen = $this->coordinador_origen->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_origen_todos)->pluck('name','id');
        
        //muestra los usuarios con el rol de profesores y coordinador_externo de campus de instituciones diferentes al del usuario que esta llenando el formulario
        $coordinador_destino = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->pluck('name','id');

        $tipo_alianza = $this->tipoAlianza->pluck('nombre','id');
        $tipo_tramite = $this->tipoTramite->pluck('nombre','id');
        $tipo_institucion_destino = $this->tipoInstitucion->pluck('nombre','id');
        $pais_institucion_destino = $this->pais->orderBy('nombre','asc')->pluck('nombre','id');


        
        $tipo_documento_id = \App\Models\TipoDocumento::where('nombre','<>','PRE-FORMAS')->pluck('id');
        $IdDocumentosInstitucion =  \App\Models\Admin\DocumentosInstitucion::where('institucion_id',$institucionId)->whereIn('tipo_documento_id',$tipo_documento_id)->pluck('archivo_id')->toArray();
        $enviar_documentos =  \App\Models\Archivo::whereIn('id',$IdDocumentosInstitucion)->select('nombre','id','path')->get()->toArray();


        //variables vacias para que la vista sea compatible con la creacion y edicion 
        $programa_origen = [];
        $aplicaciones = [];
        $departamento_institucion_destino = [];
        $ciudad_institucion_destino = [];

        $alliance = $this->getList(['id' => $this->user->id, 'rol' => 'coordinador_origen']);
        if (count($alliance)) {
            $alliance = $alliance[0];
        }
        //$alliance = ['coordinador_origen' => $this->user->id];

        $viewWith = ['campusApp' => $this->campusApp, 'alliance' => $alliance, 'tipoRuta' => $this->tipoRuta, 'paso_titulo' => $this->paso_titulo, 'institucion_destino' => $institucion_destino, 'facultad_origen' => $facultad_origen, 'programa_origen' => $programa_origen, 'coordinador_origen' => $coordinador_origen, 'coordinador_destino' => $coordinador_destino, 'tipo_alianza' => $tipo_alianza, 'aplicaciones' => $aplicaciones, 'tipo_tramite' => $tipo_tramite, 'tipo_institucion_destino' => $tipo_institucion_destino, 'pais_institucion_destino' => $pais_institucion_destino, 'departamento_institucion_destino' => $departamento_institucion_destino, 'ciudad_institucion_destino' => $ciudad_institucion_destino, 'enviar_documentos' => $enviar_documentos, 'nombre' => 'alianza', 'paso' => '1','peticion' => $this->peticion ?? 'normal'];

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
    public function store(CreateAlianzaRequest $request)
    {
        
        return $this->storeUpdate($request, 'store', '');
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
        $msg = '';

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
        $representanteDestinoId = 0;
        $campusAppId = 0;
        $campusApp = 0;
        $campusId = 0;
        $facultadId = 0;
        $paso = 0;
        $paso_id = 0;
        $redirect_url = '';


        //verificar la existencia de la alianza
        if ($id != '') {
            $alianzaId = $id;
        }elseif (isset($request['alianzaId'])) {
            $alianzaId = $request['alianzaId'];
        }
        // elseif( session('alianzaId') != null ){
        //     $alianzaId = session('alianzaId');
        // }

        if ($alianzaId != 0) {
            $alianza = $this->alianzaRepository->findWithoutFail($alianzaId);
            //echo $alianzaId.'entro';
            if (empty($alianza)) {
                $errors += 1;
                array_push($errorsMsg, 'No se encontro la alianza.');
                goto end;
            }
        }
        $estadoActiva = \App\Models\Estado::where([['uso','PROCESS'],['nombre','ACTIVA']])->first();
        if ($alianzaId != 0 && $alianza->estado_id == $estadoActiva->id ) {
            $errors += 1;
            array_push($errorsMsg, 'La alianza esta activa, no se puede modificar');
            goto end;
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

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_alianza')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');
        /*
        echo '<hr>';
        
        */

        $crearTipo = 'nuevo';
        $estadoPaso = 'PENDIENTE POR REVISIÓN';
        $rolName = 'coordinador_interno';


        //-----------------------------------------------------------------
        //-----------------------------------------------------------------

        $buscarCoordinadores = 0;
        $buscarInstituciones = 0;
        $keyDataCoorInt = 0;
        $keyDataCoorExt = 0;
        $keybuscarInstInt = 0;
        $keybuscarInstExt = 0;

        if ( isset($request['modificar']) && $request['paso'] ) {
            $crearTipo = 'actualizar';
            $estadoPaso = 'ACTUALIZACIÓN DE DATOS';
            
        }

        if ($alianzaId != 0) {


            //obtener los datos de los coordinadores de la alianza
            $rolesUsuarios = Role::whereIn('name',['coordinador_interno','coordinador_externo','representante_legal','copia_oculta_email'])->select('id','name')->get()->toArray();
            $roleCoordinadorInterno = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'coordinador_interno');
            });
            $roleCoordinadorExterno = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'coordinador_externo');
            });
            $roleRepresentante = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'representante_legal');
            });
            $roleCopiaEmails = array_filter($rolesUsuarios, function($var){
                return ($var['name'] == 'copia_oculta_email');
            });
            reset($roleCoordinadorInterno);
            reset($roleCoordinadorExterno);
            reset($roleRepresentante);
            reset($roleCopiaEmails);
            $keyRoleCoorInt = key($roleCoordinadorInterno);
            $keyRoleCoorExt = key($roleCoordinadorExterno);
            $keyRoleRepre = key($roleRepresentante);
            $keyRoleCopiaEmail = key($roleCopiaEmails);

            $roleCoordinadorInternoId = $roleCoordinadorInterno[$keyRoleCoorInt]['id'];
            $roleCoordinadorExternoId = $roleCoordinadorExterno[$keyRoleCoorExt]['id'];
            $roleRepresentanteId = $roleRepresentante[$keyRoleRepre]['id'];
            $roleCopiaEmailsId = $roleCopiaEmails[$keyRoleCopiaEmail]['id'];


            if ( in_array($request['paso'],['1','2','6'])) {
                //buscar el usuario del coordinador Interno de la alianza
                $buscarCoordinadores = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('alianza.id',$alianzaId )
                    ->whereIn('model_has_roles.role_id',[$roleCoordinadorInternoId,$roleCoordinadorExternoId] )
                    ->select('users.id AS user_id','model_has_roles.role_id','users.name','users.email');
                //echo $buscarCoordinadores->toSql();
                $buscarCoordinadores = $buscarCoordinadores->get()->toArray();
                /*
                $dataCoordinadorInterno = array_filter($buscarCoordinadores, function($var) use ($roleCoordinadorInternoId){
                    return ($var['role_id'] == $roleCoordinadorInternoId);
                });
                $dataCoordinadorExterno = array_filter($buscarCoordinadores, function($var) use ($roleCoordinadorExternoId){
                    return ($var['role_id'] == $roleCoordinadorExternoId);
                });

                reset($dataCoordinadorInterno);
                reset($dataCoordinadorExterno);
                $keyDataCoorInt = key($dataCoordinadorInterno);
                $keyDataCoorExt = key($dataCoordinadorExterno);
                */
                if (count($buscarCoordinadores)) {
                    $keyDataCoorInt = array_search($roleCoordinadorInternoId, array_column($buscarCoordinadores, 'role_id'));
                    $keyDataCoorExt = array_search($roleCoordinadorExternoId, array_column($buscarCoordinadores, 'role_id'));
                }

                $buscarInstituciones = \App\Models\Admin\Institucion::join('alianza_institucion', 'alianza_institucion.institucion_id', '=', 'institucion.id')
                    ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                    ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                    ->where('alianza_institucion.alianza_id',$alianzaId )
                    ->whereIn('user_campus.user_id',(count($buscarCoordinadores) ? array_column($buscarCoordinadores, 'user_id') : [0]) )
                    ->select('user_campus.user_id','institucion.nombre','campus.institucion_id','campus.id AS campus_id');
                // echo $buscarInstituciones->toSql();
                // print_r( $buscarInstituciones->getBindings() );
                $buscarInstituciones = $buscarInstituciones->get()->toArray();

                if (count($buscarInstituciones)) {
                    $keybuscarInstInt = array_search($buscarCoordinadores[$keyDataCoorInt]['user_id'], array_column($buscarInstituciones, 'user_id'));
                    $keybuscarInstExt = array_search($buscarCoordinadores[$keyDataCoorExt]['user_id'], array_column($buscarInstituciones, 'user_id'));
                }

            }
        }

        //-----------------------------------------------------------------
        //-----------------------------------------------------------------


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
                // 'sera_coordinador_origen' => 'required',
                ] );
            }
            
            //en el caso de que escojan la opcion Otro
            if ( isset($request['facultad_origen']) && array_search('999999', $request['facultad_origen']) ) {
                $reglas = array_merge($reglas, [
                'facultad_origen_otro' => 'required',
                ] );
            }

            // if ( $request['sera_coordinador_origen'] == 'NO' ) {
                $reglas = array_merge($reglas, [
                'coordinador_origen' => 'required',
                ] );
                //en el caso de que escojan la opcion Otro
                if ( $request['coordinador_origen'] == '999999' ) {

                    $reglas = array_merge($reglas, [
                    'nombre_coordinador_origen' => 'required|max:100',
                    'cargo_coordinador_origen' => 'required|min:1|max:45',
                    'telefono_coordinador_origen' => 'required|min:7|max:45',
                    'email_coordinador_origen' => 'required|email|max:191',
                    ] );
                }
                //en el caso de que escojan la opcion Otro
                if ( $request['coordinador_origen'] == '999999' && !isset($request['coordinadorOrigenId']) ) {
                    $reglas = array_merge($reglas, [
                    'email_coordinador_origen' => 'required|email|max:191|unique:users,email',
                    ] );
                }
                
            // }

            if ( $request['tipo_tramite'] != '' ) {
                $reglas = array_merge($reglas, [
                'tipo_alianza' => 'required',
                'aplicaciones' => 'required',
                'duracion_cant' => 'required|max:12',
                'duracion_unid' => 'required',
                'objetivo_alianza' => 'required|max:1000',
                ] );
            }

          }
          if ( $request['paso'] == '2' ) {
              
            $reglas = array_merge($reglas, [
                'institucion_destino' => 'required',
                'coordinador_destino' => 'required',
            ] );
            //en el caso de que escojan la opcion Otro
            //if ( $request['institucion_destino'] == '999999' ) {
                $reglas = array_merge($reglas, [
                'tipo_institucion_destino' => 'required',
                'nombre_institucion_destino' => 'required|max:100',
                'direccion_institucion_destino' => 'required|max:150',
                'telefono_institucion_destino' => 'required|max:45',
                'codigo_postal_institucion_destino' => 'required|max:10',
                'ciudad_institucion_destino' => 'required',
                ] );
            //}
            //en el caso de que escojan la opcion Otro
            if ( $request['coordinador_destino'] == '999999' ) {
                $reglas = array_merge($reglas, [
                'nombre_coordinador_destino' => 'required|max:100',
                'cargo_coordinador_destino' => 'required|max:45',
                'telefono_coordinador_destino' => 'required|max:45',
                'email_coordinador_destino' => 'required|email|max:191',
                ] );
            }

                //en el caso de que escojan la opcion Otro
                if ( $request['coordinador_destino'] == '999999' && !isset($request['modificar']) ) {
                    $reglas = array_merge($reglas, [
                    'email_coordinador_destino' => 'required|email|max:191|unique:users,email',
                    ] );
                }


          }
          if ( $request['paso'] == '4' ) {
            
            $reglas = array_merge($reglas, [
                'atoken' => 'required',
                'coordinador_destino' => 'required',
            ] );
            //if ( $request['existeRepresentante'] != '1' ) {
                $reglas = array_merge($reglas, [
                'tipo_institucion_destino' => 'required',
                'nombre_institucion_destino' => 'required|max:100',
                'direccion_institucion_destino' => 'required|max:150',
                'telefono_institucion_destino' => 'required|max:45',
                'codigo_postal_institucion_destino' => 'required|max:10', 
                'ciudad_institucion_destino' => 'required',
                ] );
            //}

            //en el caso de que escojan la opcion Otro
            $reglas = array_merge($reglas, [
            
            ] );

            if ( $request['coordinador_destino'] == '999999' ) {
                $reglas = array_merge($reglas, [
                'nombre_coordinador_destino' => 'required|max:100',
                'cargo_coordinador_destino' => 'required|max:45',
                'telefono_coordinador_destino' => 'required|max:45',
                'email_coordinador_destino' => 'required|email|max:191|unique:users,email',
                ] );
            }else{
            }

          }
          if ( $request['paso'] == '5' ) {
            $reglas = array_merge($reglas, [
                'atoken' => 'required',
            ] );
            //en el caso de que exista el representante
            //if ( $request['existeRepresentante'] != '1' ) {
                $reglas = array_merge($reglas, [
                    'atoken' => 'required',
                    'repre_nombre' => 'required|max:100',
                    'repre_cargo' => 'required|max:45',
                    'repre_telefono' => 'required|max:45',
                    'repre_email' => 'required|email|max:191|unique:users,email',
                    'repre_pais_nacimiento' => 'required',
                    'repre_tipo_documento' => 'required',
                    'repre_numero_documento' => 'required|max:45',
                    'repre_fecha_exped_documento' => 'required',
                    'repre_ciudad_exped_documento' => 'required',
                ] );
                if ( isset($request['modificar']) ) {
                    $reglas = array_merge($reglas, [
                        'repre_email' => 'required|email|max:191',
                    ] );
                }else{
                    $reglas = array_merge($reglas, [
                        'archivo_input'       => 'required|mimes:pdf,jpg,png,jpeg',
                    ] );
                }
            //}

          }
          if ( $request['paso'] == '6' ) {
            $reglas = array_merge($reglas, [
                'aceptar_alianza' => 'required',
                //'existeRepresentante' => 'required',
            ] );
                //en el caso de que escojan la opcion SI
            if ( $request['aceptar_alianza'] != 'SI' ) {
                $reglas = array_merge($reglas, [
                'observacion_aceptar_alianza' => 'required|max:191',
                ] );
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
                

                // if ( $input['sera_coordinador_origen'] == 'SI' ) {
                //     $coordinadorOrigen = $this->asociarUsuario('coordinador',$this->user->id,'coordinador_interno',$campusAppId,'');
                        
                //     if ( $coordinadorOrigen === 'error_usuario' ) {
                //         $errors += 1;
                //         array_push($errorsMsg, 'No se encontro el coordinador del origen.');
                //         goto end;
                //     }elseif( $coordinadorOrigen != false ){
                //         $coordinadorOrigenId = $coordinadorOrigen->id;
                //     }
                // }
            //si el usuario que crea la alianza no es el coordinador entonces validar si no existe el usuario y crear el usuario de tipo coordinador interno y obtener el id para asociarlo a la alianza 
            //nombre_coordinador_origen, cargo_coordinador_origen, telefono_coordinador_origen, email_coordinador_origen
            //generar un password
            // if ( $input['sera_coordinador_origen'] == 'NO' ) {
                $dataDatosPersonalesOrigen = [];
                if ( $input['coordinador_origen'] == '999999' ) {
                    $crearUsuarioTipo = 'nuevo';
                    //datos del usuario
                    if ( isset($request['coordinadorOrigenId']) ) {
                        $crearUsuarioTipo = 'actualizar';
                        $dataUser['id']= $request['coordinadorOrigenId'];
                    }
                    $dataUser['activo']= 1;
                    // crear password
                    $passwordCoordinadorOrigen = str_random(12);
                    //no sera encriptado hasta que se envie el email
                    //$dataUser['password']= bcrypt( $passwordCoordinadorOrigen );
                    $dataUser['password']= bcrypt($passwordCoordinadorOrigen);
                    $dataUser['remember_token']= $passwordCoordinadorOrigen;
                }else{
                    $crearUsuarioTipo = 'actualizar';
                    //datos del usuario
                    if ( isset($request['coordinadorOrigenId']) ) {
                        $dataUser['id']= $request['coordinadorOrigenId'];
                    }else{
                        $dataUser['id']= $input['coordinador_origen'];
                    }
                }
                               
                if (isset($input['nombre_coordinador_origen'],$input['cargo_coordinador_origen'],$input['telefono_coordinador_origen'],$input['email_coordinador_origen'])) {
                    
                    $dataUser['name']= $input['nombre_coordinador_origen'];
                    $dataUser['email']= $input['email_coordinador_origen'];

                    //datos personales del usuario
                    $dataDatosPersonalesOrigen['telefono']= $input['telefono_coordinador_origen'];
                    $dataDatosPersonalesOrigen['cargo']= $input['cargo_coordinador_origen'];
                //datos personales del usuario
                    $dataDatosPersonalesOrigen['nombres']= $input['nombre_coordinador_origen'];
                    $dataDatosPersonalesOrigen['ciudad_residencia_id']= $campusApp->ciudad->id;

                }else{
                    $crearUsuarioTipo = 'actualizar';
                    $dataUser['id']= $input['coordinador_origen'];
                }
                        
                        //en el caso de querer modificar los datos
                        $crearUsuario = $this->crearUsuario($crearUsuarioTipo,$dataUser,'coordinador_interno',$campusApp->id,$dataDatosPersonalesOrigen,'');
                        // Create the user
                        if ( $crearUsuario === 'error_usuario' ) {

                            $errors += 1;
                            array_push($errorsMsg, 'No se puede crear/actualizar el coordinador interno.');
                            goto end;
                        }elseif( $crearUsuario === 'error_datos_personales' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se pueden crear/actualizar los datos personales del coordinador interno.');
                            goto end;
                        }elseif( is_string($crearUsuario) || $crearUsuario === false){
                            $errors += 1;
                            array_push($errorsMsg, 'No se pueden crear/actualizar el usuario.');
                            goto end;
                        }else{
                            $coordinadorOrigenId = $crearUsuario->id;

                            //se regresa el id del coordinador creado para poder modificarlo
                            if ($this->peticion != 'ajax') {
                                array_push($okMsg,'<input type="hidden" class="dato_adicional" name="coordinadorOrigenId" value="'.$coordinadorOrigenId.'">');
                            }
                        }
                            
                /*  
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
                */
                        
            
            // }

            //registrar la alianza: objetivo, tipo_tramite_id, duracion, responsable_arl, estado
            //objetivo_alianza, tipo_tramite, duracion_cant, duracion_unid, responsable_arl

            
            $dataAlianza['objetivo']= $input['objetivo_alianza'];
            // se debe determinar que accion tomar en cada tipo de tramite
            $dataAlianza['tipo_tramite_id']= $input['tipo_tramite'];
            $dataAlianza['duracion']= $input['duracion_cant'] .' '. $input['duracion_unid'];
            $dataAlianza['responsable_arl']= $input['responsable_arl'];
            //$dataAlianza['estado']= 0; //inactivo
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
                    $programas = \App\Models\Admin\Programa::find($input['programa_origen']);
                    $alianza->programa()->sync($programas);
                }



            //asociar las aplicaciones: alianza_aplicaciones
            //aplicaciones[]
                $aplicaciones = \App\Models\Aplicaciones::find($input['aplicaciones']);
                $alianza->aplicaciones()->sync($aplicaciones);

            }

            if ( isset($request['modificar']) ) {
            //quitar la asociacion del coordinador anterior con la alianza
                if ($buscarCoordinadores[$keyDataCoorInt]['user_id'] != $coordinadorOrigenId) {
                    $alianza->user()->detach($buscarCoordinadores[$keyDataCoorInt]['user_id']);
                }
            //quitar la asociacion de la institucion anterior con la alianza
                if ($buscarInstituciones[$keybuscarInstInt]['institucion_id'] != $campusApp->institucion->id) {
                    $alianza->institucion()->detach($buscarInstituciones[$keybuscarInstInt]['institucion_id']);
                }
            }
            


            //GUARDAR EL PASO 1
            $tipo_paso_id = 0;

            $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$alianzaId,$coordinadorOrigenId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            //GUARDAR EL PASO 3
            $estadoPaso3 = 'INCOMPLETO';
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
                $crearPaso = $this->crearPaso('3',$estadoPaso3,$alianzaId,$coordinadorOrigenId);
                
                $idPaso = $crearPaso->id;
            }


            if ( $crearPaso ){
                $mail_id = 0;
                $crearTipoMail = $crearTipo;
                if ( isset($request['modificar']) ) {
                    if ( count($dataMail) ) {
                        $mail_id = $dataMail[0]->id;
                        $idPaso = $dataMail[0]->pasos_alianza_id;
                    }else{
                        $crearPaso = $this->crearPaso('3',$estadoPaso3,$alianzaId,$coordinadorOrigenId);
                
                        $idPaso = $crearPaso->id;
                        $crearTipoMail = 'nuevo';
                    }
                }
                
            //CREAR EL REGISTRO DEL MAIL

                //solo se creara el registro y se asociaran los archivos adjuntos
                $tipo_mail = 'alianza';
                $datos['crearTipo'] = $crearTipoMail;
                $datos['estadoPaso'] = $estadoPaso3;
                $datos['id'] = $mail_id;
                $datos['user_id'] = $coordinadorOrigenId;
                $datos['paso'] = $idPaso;
                $datos['to'][0] = '';
                $datos['cc'][0] = '';
                $datos['bcc'][0] = '';
                
                $datos['subject'] = '';
                $msj_header_text = '';
                $datos['content'] = '';
                
                $datos['archivosAdjuntos'] = 0;
                if ( isset($input['enviar_documentos']) ) {
                    $datos['archivosAdjuntos'] = $input['enviar_documentos'];
                }

                

                //$crearMail = $this->crearMail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);
                $crearMail = $this->crearMail($tipo_mail,$datos);
                
                if ( $crearMail === 'error_mail' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }elseif ( $crearMail === 'error_paso' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el paso de la alianza para crear el el pre-registro del mail.');
                    goto end;
                }elseif ( $crearMail == 'error_user' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'No se encuentra el usuario, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador externo.');
                    goto end;
                }elseif ( $crearMail == 'error_tipo_mail' || $crearMail == 'error_crear_tipo' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador.');
                    goto end;
                }elseif ( $crearMail === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }


            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el pre-registro del paso \''.$tipos_pasos[3].'\' de la alianza.');
                goto end;
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

            $institucionOrigen = $buscarInstituciones[$keybuscarInstInt];
            
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

            $crearInstitucionTipo = $crearTipo;
            if ( $input['institucion_destino'] == '999999' ) {
                $crearInstitucionTipo = 'nuevo';
                //datos de la institucion
                //datos del nuevo campus
                $nombreCampus = \App\Models\Admin\City::select('nombre')->where('id',$input['ciudad_institucion_destino'])->get();
                $dataCampus['nombre']= $nombreCampus[0]->nombre;
            }else{
                $crearInstitucionTipo = 'actualizar';
                $dataCampus['id']= $input['institucion_destino'];
                $dataInstitucion['institucion_id']= $input['institucion_destino'];
            }
                
                $dataInstitucion['nombre']= $input['nombre_institucion_destino'];
                $dataInstitucion['tipo_institucion_id']= $input['tipo_institucion_destino'];
                
                $dataCampus['telefono']= $input['telefono_institucion_destino'];
                $dataCampus['direccion']= $input['direccion_institucion_destino'];
                $dataCampus['codigo_postal']= $input['codigo_postal_institucion_destino'];
                $dataCampus['ciudad_id']= $input['ciudad_institucion_destino'];
                $dataCampus['principal']= 1;

                //datos de la nueva facultad
                

                /*
                $alianza = \App\Models\Alianza::find($alianzaId);
                if (!count($alianza)) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro la alianza');
                    goto end;
                }
                if ($alianza->estado == 0 ) {
                    $errors += 1;
                    array_push($errorsMsg, 'La alianza esta inactiva');
                    goto end;
                }*/
                
                $crearInstitucion = $this->crearInstitucion($crearInstitucionTipo,$dataInstitucion,$dataCampus,$alianza);

                if ( $crearInstitucion === 'error_institucion' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear/actualizar la institucion destino.');
                    goto end;
                }elseif ( $crearInstitucion === 'error_campus' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear/actualizar el campus de la institucion destino.');
                    goto end;
                }elseif ( $crearInstitucion === 'error_facultad' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear/actualizar la facultad de la institucion destino.');
                    goto end;
                }elseif( $crearInstitucion != false ){
                    //print_r($crearInstitucion);
                    $institucionDestino = $crearInstitucion['institucionId'];
                    $campusId = $crearInstitucion['campusId'];
                    if (isset($crearInstitucion['facultadId'])) {
                        $facultadId = $crearInstitucion['facultadId'];
                    }
                }

            
            if ( $input['institucion_destino'] != '999999' ) {
                
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
            $dataDatosPersonalesDestino = [];
            $crearUsuarioTipo = $crearTipo;
            if ( $input['coordinador_destino'] == '999999' ) {
                if ( !isset($request['modificar']) ) {
                    $crearUsuarioTipo = 'nuevo';
                }
                $dataUser['id']= $buscarCoordinadores[$keyDataCoorExt]['user_id'];
                $dataUser['activo']= 1;
                // crear password
                $passwordCoordinadorDestino = str_random(12);
                //no sera encriptado hasta que se envie el email
                //$dataUser['password']= bcrypt( $passwordCoordinadorDestino );
                $dataUser['password']= bcrypt($passwordCoordinadorDestino);
                $dataUser['remember_token']= $passwordCoordinadorDestino;
              //datos personales del usuario
                $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
            }else{
                $crearUsuarioTipo = 'actualizar';
                $dataUser['id']= $input['coordinador_destino'];
            }

            if (isset($input['nombre_coordinador_destino'],$input['cargo_coordinador_destino'],$input['telefono_coordinador_destino'],$input['email_coordinador_destino'])) {
                //datos del usuario
                //$dataCoordinador['name']= strtok($input['email_coordinador_destino'], '@');
                $dataUser['name']= $input['nombre_coordinador_destino'];
                $dataUser['email']= $input['email_coordinador_destino'];
                //datos personales del usuario
                $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];
            }

                $crearUsuario = $this->crearUsuario($crearUsuarioTipo,$dataUser,'coordinador_externo',$campusId,$dataDatosPersonalesDestino,$alianza);
                // Create the user
                if ( $crearUsuario === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear/actualizar el coordinador externo.');
                    goto end;
                }elseif( $crearUsuario === 'error_datos_personales' ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se pueden crear/actualizar los datos personales del coordinador externo.');
                    goto end;
                }elseif( $crearUsuario === 'error_asociar' ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede asociar el coordinador externo.');
                    goto end;
                }elseif ( $crearUsuario === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear/actualizar el coordinador externo.');
                    goto end;
                }elseif( $crearUsuario != false ){
                    $coordinadorDestino = $crearUsuario;
                    $coordinadorDestinoId = $crearUsuario->id;
                }


            

            if ( $input['coordinador_destino'] != '999999' ) {

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
                if ( isset($buscarCoordinadores[$keyDataCoorExt]['user_id']) && $buscarCoordinadores[$keyDataCoorExt]['user_id'] != $coordinadorDestinoId) {
                    $alianza->user()->detach($buscarCoordinadores[$keyDataCoorExt]['user_id']);
                }
            //quitar la asociacion de la institucion anterior con la alianza
                if ( isset($buscarInstituciones[$keybuscarInstExt]['institucion_id']) &&$buscarInstituciones[$keybuscarInstExt]['institucion_id'] != $institucionDestino) {
                    $alianza->institucion()->detach($buscarInstituciones[$keybuscarInstExt]['institucion_id']);
                }
            }

            //GUARDAR EL PASO 2
            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$alianzaId,$coordinadorDestinoId);
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
            // if ( isset($request['modificar']) ) {
                
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

            // }else{
            //     $crearPaso = $this->crearPaso('3',$estadoPaso,$alianzaId);
                
            //     $idPaso = $crearPaso->id;
            // }


            if ( count($dataMail) ){
                $mail_id = 0;
                //$crearTipoMail = $crearTipo;
                $crearTipoMail = 'actualizar';
                // if ( isset($request['modificar']) ) {
                //     if ( count($dataMail) ) {
                        $mail_id = $dataMail[0]->id;
                        $idPaso = $dataMail[0]->pasos_alianza_id;
                //     }else{
                //         $crearPaso = $this->crearPaso('3',$estadoPaso,$alianzaId);
                
                //         $idPaso = $crearPaso->id;
                //         $crearTipoMail = 'nuevo';
                //     }
                // }
                
            //CREAR EL REGISTRO DEL MAIL PARA EL PASO 3
                $estadoPaso3 = 'INCOMPLETO';
                
                
                //buscar el email del usuario asignado para recibir una copia oculta de los emails
                $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                    ->where('model_has_roles.role_id',$roleCopiaEmailsId )
                    ->select('users.name', 'users.email')->first();

                $tipo_mail = 'alianza';
                $datos['crearTipo'] = $crearTipoMail;
                $datos['estadoPaso'] = $estadoPaso3;
                $datos['id'] = $mail_id;
                $datos['user_id'] = $coordinadorDestinoId;
                $datos['paso'] = $idPaso;
                $datos['to'][0] = $coordinadorDestino;
                $datos['cc'][0] = '';
                $datos['bcc'][0] = $copia_oculta_email;
                $datos['subject'] = 'Institución '.ucwords(strtolower( $buscarInstituciones[$keybuscarInstInt]['nombre'] ) ) .' - Solicitud de nueva alianza';

                //solicita los datos de la alianza
                $datosContent = $this->datosAlianza($alianzaId,'crearMail','nuevo'); 

                $dataUsers = $datosContent['dataUsers'];
                $keyCoordExterno = $datosContent['keyCoordExterno'];
                $keyCoordInterno = $datosContent['keyCoordInterno'];

                $msj_header_text = 'Respetado '.ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_nombres'] )).' le queremos informar que la institución '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['institucion']['nombre'] )) .' de '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['institucion']['ciudad']['pais_nombre'] )) .' '.' quiere realizar una alianza con su institución. <br><br> El coordinador '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['coordinador_nombres'] )) .' '. ucwords(strtolower( $dataUsers[$keyCoordInterno]['coordinador_apellidos'] )) .' ha iniciado el proceso y ha diligenciado la información de las instituciones de origen y destino de la alianza la cual se presenta a continuación:';

                $datos['content'] = '[{"header":"'.$msj_header_text.'", "footer":"Necesitamos su aprobación para continuar con el proceso, puede revisar los datos de su institución y aceptar la propuesta de alianza en el sitio de InterActin. <br> <br> <span class=\'hide_pass\'>Puede acceder con el usuario: '.$dataUsers[$keyCoordExterno]['coordinador_email'].' <br> Su contraseña temporal es: '.$dataUsers[$keyCoordExterno]['usuario_password'].'</span>"}]';
                $datos['archivosAdjuntos'] = '';
                // if ( isset($input['enviar_documentos']) ) {
                //     $datos['archivosAdjuntos'] = $input['enviar_documentos'];
                // }

                //$crearMail = $this->crearMail($paso,$to,$cc,$bcc,$subject,$content,$archivosAdjuntos);
                $crearMail = $this->crearMail($tipo_mail,$datos);

                if ( $crearMail === 'error_mail' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }elseif ( $crearMail === 'error_paso' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el paso de la alianza para crear el el pre-registro del mail.');
                    goto end;
                }elseif ( $crearMail === 'error_user' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'No se encuentra el usuario, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador externo.');
                    goto end;
                }elseif ( $crearMail === 'error_tipo_mail' || $crearMail === 'error_crear_tipo' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el pre-registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador.');
                    goto end;
                }elseif ( $crearMail === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el pre-registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
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

            //obtener el id del usuario, en este caso del coordinador interno
            $coordinadores = DB::table('users')
                    ->join('alianza_user', 'users.id', '=', 'alianza_user.user_id')
                    ->join('alianza', 'alianza_user.alianza_id', '=', 'alianza.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('users.id')->orderBy('alianza_user.id','asc');
            //echo $coordinadores->toSql();
            $coordinadores = $coordinadores->get();

            $coordinadorOrigen = $coordinadores[0];
            $coordinadorOrigenId = $coordinadorOrigen->id;

            //GUARDAR EL PASO 3
            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId,$coordinadorOrigenId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            $paso = $request['paso'];
            if ($this->peticion == 'ajax') {
                $redirect_url = route('interalliances.show',$alianzaId);
                array_push($okMsg,' <input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.$redirect_url.'">');
            }

        }

        /// FIN PASO 3
        /// FIN PASO 3
        /// FIN PASO 3


        /// INICIO PASO 4
        /// INICIO PASO 4
        /// INICIO PASO 4

        if ( isset($request['paso']) && $request['paso'] == '4' ) {

            //$existeRepresentante = false;

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }
            
            // if ($alianza->estado == 3 ) {
            //     $errors += 1;
            //     array_push($errorsMsg, 'La alianza esta activa');
            //     goto end;
            // }
            
            $verificarToken = \App\Models\Alianza::where('token',$request['atoken'])->select('id','token')->first();

            if ( count($verificarToken) > 0 ) {


            //buscar el usuario del coordinador externo de la alianza
                $buscarUserExterno = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                            ->join('users', 'alianza_user.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                            ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                            ->where('alianza.id',$verificarToken->id )
                            ->where('model_has_roles.role_id',$roleCoordinadorExternoId )
                            ->select('users.id','campus.institucion_id','campus.id AS campus_id');
                //echo $buscarUserExterno->toSql().'$verificarToken->id:'.$verificarToken->id.'$roleCoordinadorExternoId:'.$roleCoordinadorExternoId;
                $buscarUserExterno = $buscarUserExterno->first();

                $campusId = $buscarUserExterno->campus_id;

            // comprobar existencia del representante
            //validar si existe representante
                /*
                $buscarRepresentante = \App\Models\Admin\Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')
                            ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                            ->join('users', 'user_campus.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->where('institucion.id',$buscarUserExterno->institucion_id )
                            ->where('model_has_roles.role_id',$roleRepresentanteId )
                            ->select('users.id');
                //echo $buscarRepresentante->toSql();
                $buscarRepresentante = $buscarRepresentante->first();
            // actualizar los datos de la institucion en caso de no existir el representante


                if ( count($buscarRepresentante) > 0 ) {
                    $existeRepresentante = true;
                }else{
                */
                    $dataInstitucion['institucion_id']= $buscarUserExterno->institucion_id;
                    $dataInstitucion['tipo_institucion_id']= $input['tipo_institucion_destino'];
                    $dataInstitucion['nombre']= $input['nombre_institucion_destino'];
                    
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
                    }elseif ( is_string($actualizarInstitucion) || $actualizarInstitucion === false ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear/actualizar la institucion.');
                        goto end;
                    }elseif( $actualizarInstitucion != false ){
                        $campusId = $actualizarInstitucion['campusId'];
                    }

                //}

            // comprobar los datos del coordinador actual
            // actualizar el coordinador si él eligio otro
                if ( $buscarUserExterno->id != $input['coordinador_destino'] ) {
                                        
                    //crear el usuario de tipo coordinador externo y obtener el id para asociarlo a la institucion
                    //[el nombre del email], email_coordinador_destino, [generar un password]
                    $crearUsuarioTipo = 'nuevo';
                    if ( $input['coordinador_destino'] == '999999' ) {
                        $dataUser['activo']= 1;
                        // crear password
                        $passwordCoordinadorDestino = str_random(12);
                        //no sera encriptado hasta que se envie el email
                        //$dataUser['password']= bcrypt( $passwordCoordinadorDestino );
                        $dataUser['password']= bcrypt($passwordCoordinadorDestino);
                        $dataUser['remember_token']= $passwordCoordinadorDestino;
                    } else {
                        $crearUsuarioTipo = 'actualizar';
                        $dataUser['id']= $input['coordinador_destino'];
                    }
                        if (isset($input['nombre_coordinador_destino'])) {
                            $dataUser['name']= $input['nombre_coordinador_destino'];
                        }
                        if (isset($input['email_coordinador_destino'])) {
                            $dataUser['email']= $input['email_coordinador_destino'];
                        }
                        
                      //datos personales del usuario
                        if (isset($input['nombre_coordinador_destino'])) {
                            $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                        }
                        if (isset($input['ciudad_institucion_destino'])) {
                            $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
                        }
                        if (isset($input['telefono_coordinador_destino'])) {
                            $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                        }
                        if (isset($input['cargo_coordinador_destino'])) {
                            $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];
                        }

                        $crearUsuario = $this->crearUsuario($crearUsuarioTipo,$dataUser,'coordinador_externo',$campusId,$dataDatosPersonalesDestino,$alianza);
                        // Create the user
                        if ( $crearUsuario === 'error_usuario' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se puede crear/actualizar el coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario === 'error_datos_personales' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se pueden crear/actualizar los datos personales del coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario === 'error_asociar' ){
                            $errors += 1;
                            array_push($errorsMsg, 'No se puede asociar el coordinador externo.');
                            goto end;
                        }elseif ( is_string($crearUsuario) || $crearUsuario === false ) {
                            $errors += 1;
                            array_push($errorsMsg, 'Ocurrio un error al crear/actualizar el coordinador externo.');
                            goto end;
                        }elseif( $crearUsuario != false ){
                            $coordinadorDestinoId = $crearUsuario->id;
                        }

                        /*
                        $coordinadorDestino = $this->asociarUsuario('cambio_coordinador',$input['coordinador_destino'],'coordinador_externo',$campusId,$alianza,$buscarUserExterno->id);
                
                        if ( $coordinadorDestino === 'error_usuario' ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se encontro el coordinador del destino.');
                            goto end;
                        }elseif( $coordinadorDestino != false ){
                            $coordinadorDestinoId = $coordinadorDestino->id;
                        }
                        */
                    

                //quitar la asociacion del coordinador anterior con la alianza
                    $alianza->user()->detach($buscarUserExterno->id);

                // si cambia el coordinador enviar un nuevo mensaje de correo al nuevo coordinador
                    //validar en el paso 6
                    //se valida por el campo activo de la tabla users


            
                }else{
            // actualizar los datos del coordinador solo si es él mismo
                // si cambia el email verificar que no este en el sistema
                    if (isset($input['email_coordinador_destino'])) {
                        $this->validate($request, [
                            'email_coordinador_destino' => 'required|email|unique:users,email,'.$buscarUserExterno->id
                        ]);
                    }


                    $dataUser['id']= $buscarUserExterno->id;
                    if (isset($input['nombre_coordinador_destino'])) {
                        $dataUser['name']= $input['nombre_coordinador_destino'];
                    }
                    if (isset($input['email_coordinador_destino'])) {
                        $dataUser['email']= $input['email_coordinador_destino'];
                    }
                    //$dataUser['activo']= 0;
                  //datos personales del usuario
                    
                    if (isset($input['nombre_coordinador_destino'])) {
                        $dataDatosPersonalesDestino['nombres']= $input['nombre_coordinador_destino'];
                    //if ($existeRepresentante != true) {
                    }
                    if (isset($input['ciudad_institucion_destino'])) {
                        $dataDatosPersonalesDestino['ciudad_residencia_id']= $input['ciudad_institucion_destino']; 
                    //}
                    }
                    if (isset($input['telefono_coordinador_destino'])) {
                        $dataDatosPersonalesDestino['telefono']= $input['telefono_coordinador_destino'];
                    }
                    if (isset($input['cargo_coordinador_destino'])) {
                        $dataDatosPersonalesDestino['cargo']= $input['cargo_coordinador_destino'];
                    }

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
                    }elseif( is_string($crearUsuario) || $crearUsuario === false ){
                        $errors += 1;
                        array_push($errorsMsg, 'Ocurrio un error al crear el coordinador externo.');
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
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId,$coordinadorDestinoId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }

            $this->tipoRuta = 'destination';
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
            
            
            $verificarToken = \App\Models\Alianza::where('token',$request['atoken'])->select('id','token')->first();

            if ( count($verificarToken) > 0 ) {


            //buscar el usuario del coordinador externo de la alianza
                $buscarUserExterno = \App\Models\Alianza::join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                            ->join('users', 'alianza_user.user_id', '=', 'users.id')
                            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                            ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                            ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                            ->where('alianza.id',$verificarToken->id )
                            ->where('model_has_roles.role_id',$roleCoordinadorExternoId )
                            ->select('users.id','campus.institucion_id','campus.id AS campus_id')
                            ->orderBy('alianza_user.id','desc');
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
                            ->where('model_has_roles.role_id',$roleRepresentanteId )
                            ->select('users.id');
                //echo $buscarRepresentante->toSql();
                $buscarRepresentante = $buscarRepresentante->first();
                // print_r($buscarRepresentante);

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
                $crearUsuarioTipo = 'nuevo';
                if ( count($buscarRepresentante) > 0 ) {
                    $existeRepresentante = true;
                    $dataUser['id']= $buscarRepresentante->id;
                    $crearUsuarioTipo = 'actualizar';

                }else{
                    $this->validate($request, [
                        'archivo_input'       => 'required|mimes:pdf,jpg,png,jpeg',
                        'repre_email' => 'required|email|max:191|unique:users,email',
                    ]);
                }
                //datos del usuario
                    $dataUser['name']= $input['repre_nombre'];
                    $dataUser['email']= $input['repre_email'];

                    if ($crearUsuarioTipo == 'nuevo') {
                        //actualmente es el valor para determinar que el usuario esta inactivo: 1
                        $dataUser['activo']= 1;
                    }
                    // crear password
                    $passwordCoordinadorOrigen = str_random(12);
                    //no sera encriptado hasta que se envie el email
                    //$dataUser['password']= bcrypt( $passwordCoordinadorOrigen );
                    $dataUser['password']= bcrypt($passwordCoordinadorOrigen);
                    $dataUser['remember_token']= $passwordCoordinadorOrigen;
                //datos personales del usuario
                    $dataDatosPersonalesRepre['nombres']= $input['repre_nombre'];
                    $dataDatosPersonalesRepre['nacionalidad_id']= $input['repre_pais_nacimiento']; 
                    $dataDatosPersonalesRepre['telefono']= $input['repre_telefono'];
                    $dataDatosPersonalesRepre['tipo_documento_id']= $input['repre_tipo_documento'];
                    $dataDatosPersonalesRepre['numero_documento']= $input['repre_numero_documento'];
                    $dataDatosPersonalesRepre['fecha_expedicion']= $input['repre_fecha_exped_documento'];
                    $dataDatosPersonalesRepre['lugar_expedicion_id']= $input['repre_ciudad_exped_documento'];
                    $dataDatosPersonalesRepre['cargo']= $input['repre_cargo'];
                    
                    $crearUsuario = $this->crearUsuario($crearUsuarioTipo,$dataUser,'representante_legal',$buscarUserExterno->campus_id,$dataDatosPersonalesRepre,'');
                    // Create the user
                    if ( $crearUsuario === 'error_usuario' ) {

                        $errors += 1;
                        array_push($errorsMsg, 'No se puede crear el representante.');
                        goto end;
                    }elseif( $crearUsuario === 'error_datos_personales' ){
                        $errors += 1;
                        array_push($errorsMsg, 'No se pueden crear los datos personales del representante.');
                        goto end;
                    }elseif( is_string($crearUsuario) || $crearUsuario === false ){
                        $errors += 1;
                        array_push($errorsMsg, 'Ocurrio un error, no se puede crear el representante.');
                        goto end;
                    }else{
                        $representanteDestinoId = $crearUsuario->id;
                    }
            //cargar el archivo de soporte
                    if ( $request->file('archivo_input') ) {
            
                        $request['tipo_documento'] = \App\Models\TipoDocumento::where('nombre','REPRESENTACIÓN LEGAL')->pluck('id')->first();
                        $request['archivo_contenido'] = '';
                        $request['peticion'] = 'local';
                        
                        $institucionId = $buscarUserExterno->institucion_id;

                        $route = route('admin.institutions.documents',$institucionId);

                        $this->user = Auth::user();

                        if ( $request->file('archivo_input') != null ) {
                            $datos['nombre'] = str_replace(' ', '_', $request->file('archivo_input')->getClientOriginalName());
                            $datos['archivo_formato'] = $request->file('archivo_input')->getClientOriginalExtension();
                            $datos['archivo_MimeType'] = $request->file('archivo_input')->getClientMimeType();
                            $request['archivo_input'] = \File::get($request->file('archivo_input'));
                        }


                        $proceso = 'institucion';
                        $datos['institucionId'] = $institucionId;
                        $datos['peticion'] = 'local';
                        $datos['user_id'] = $this->user->id;
                        $datos['route'] = $route;
                        $datos['nombre'] = (isset($request['nombre']) ? $request['nombre'] : $datos['nombre']);
                        $datos['archivo_contenido'] = $request['archivo_contenido'];
                        $datos['archivo_input'] = $request['archivo_input'];
                        $datos['tipo_documento'] = $request['tipo_documento'];
                        //unique se coloca si debe eliminar los demas archivos del mismo tipo, de lo contrario se omite
                        $datos['unique'] = '';
                        
                        
                        $crearDocumento = $this->datosCrearDocumento($proceso,$datos);
                        if (is_string($crearDocumento) ) {
                            $errors += 1;
                            array_push($errorsMsg, 'Ocurrio un error: '.$crearDocumento);
                            goto end;
                        }else{
                            $msg .= 'El documento fue almacenado correctamente. <br>';
                        }

                        
                        
                    }else{
                        if ( !isset($request['modificar']) ) {
                            $errors += 1;
                            array_push($errorsMsg, 'No se recibio el archivo del soporte del representante.');
                            goto end;
                        }
                                
                    }

                //}

            }else{

                $errors += 1;
                array_push($errorsMsg, 'El token no es valido, regargue la pagina.');
                goto end;
            }
            //GUARDAR EL PASO 5

            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId,$buscarUserExterno->id);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }


            $this->tipoRuta = 'destination';
            $paso = $request['paso'];
             
        }
            
        /// FIN PASO 5
        /// FIN PASO 5
        /// FIN PASO 5

                




        /// INICIO PASO 6
        /// INICIO PASO 6
        /// INICIO PASO 6

        if ( isset($request['paso']) && $request['paso'] == '6' ) {

            $role = Role::where('name','coordinador_externo')->get();
            //ASIGNAR EL ROL DE coordinador_interno 
            if ( !$this->user->hasAllRoles($role) ) {
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No tiene permiso para aceptar la alianza.');
                goto end;
            }
            //se asignara con el id del soporte del representante
            $archivoAdjunto = 0;
            $crearPaso = false;

            if ( $alianzaId == 0 ){
                
                //return '<hr> El e-mail no se encuentra, No existe la alianza.';
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra la alianza.');
                goto end;
            }
            $request['alianzaId'] = $alianzaId;
            $request['validar_estado'] = true;
            $request['origen_peticion'] == 'local';
            $validarEstadoMail = $this->mail($request);

            //se buscan a los coordinadores de la alianza y se ordenan por el alianza_user.id de forma ascendente suponiendo que se creo primero el registro del coordinador interno que el externo
            $coordinadores = DB::table('users')
                    ->join('alianza_user', 'users.id', '=', 'alianza_user.user_id')
                    ->join('alianza', 'alianza_user.alianza_id', '=', 'alianza.id')
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('users.id', 'users.name', 'users.email', 'institucion.nombre As institucion_nombre')->orderBy('alianza_user.id','asc');
            //echo $coordinadores->toSql();
            $coordinadores = $coordinadores->get();

            $coordinadorOrigen = $buscarCoordinadores[$keyDataCoorInt];
            $coordinadorDestino = $buscarCoordinadores[$keyDataCoorExt];
            $coordinadorDestinoId = $buscarCoordinadores[$keyDataCoorExt]['user_id'];

            $tipo_paso = $this->tipoPaso->where('nombre','paso'.$request['paso'].'_alianza')->pluck('id')->first();
            $estadoPaso = 'ACEPTADO';
            //print_r($validarEstadoMail);
            if ( $input['aceptar_alianza'] == 'SI' ) {

                if (!isset($input['observacion_aceptar_alianza'])) {
                    $input['observacion_aceptar_alianza'] = '';
                }

                if (count($validarEstadoMail)) {
                    //if ($validarEstadoMail->estado_nombre == 'ACEPTADO' && $validarEstadoMail->paso_observacion == $input['observacion_aceptar_alianza']) {
                    if ( isset($validarEstadoMail->estado_nombre) && $validarEstadoMail->estado_nombre == 'ACEPTADO' && $validarEstadoMail->estado == 1 ) {
                        $errors += 1;
                        array_push($errorsMsg, 'El e-mail ya fue enviado. <br> La notificación de la aceptación ya fue emitida.');
                        goto end;
                    }
                }
                
                if ( $input['existeRepresentante'] == false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede actualizar la aceptación de la alianza. <br> Los datos del representante legal son requeridos.');
                    goto end;
                }else{
                    
                    $instituciones = DB::table('alianza')
                    ->join('alianza_institucion', 'alianza.id', '=', 'alianza_institucion.alianza_id')
                    ->join('institucion', 'alianza_institucion.institucion_id', '=', 'institucion.id')
                    ->where('alianza.id',$alianzaId )
                    ->where('institucion.id','<>', \Config::get('options.institucion_id') )
                    ->select('institucion.id')
                    ->pluck('id');

                    //validar si existe representante          
                    $buscarRepresentante = DB::table('campus')
                                ->join('user_campus', 'campus.id', '=', 'user_campus.campus_id')
                                ->join('users', 'user_campus.user_id', '=', 'users.id')
                                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                ->whereIn('campus.institucion_id',$instituciones )
                                ->where('model_has_roles.role_id',$roleRepresentanteId )
                                ->groupBy('users.id')
                                ->select('campus.institucion_id','users.id AS usuario_id','users.activo AS usuario_activo');

                    //echo $buscarRepresentante->toSql().'roleRepresentanteId:'.$roleRepresentanteId;
                    $buscarRepresentante = $buscarRepresentante->first();

                    if ( !count($buscarRepresentante) ) {
                        $errors += 1;
                        array_push($errorsMsg, 'No se puede actualizar la aceptación de la alianza. <br> Los datos del representante legal son requeridos.');
                        goto end;
                    }
                    //buscar el archivo de soporte del representante
                    $buscarSoporteRepresentante = DB::table('documentos_institucion')
                                ->join('archivo', 'documentos_institucion.archivo_id', '=', 'archivo.id')
                                ->where('documentos_institucion.institucion_id',$buscarRepresentante->institucion_id )
                                ->select('documentos_institucion.institucion_id','archivo.id')
                                ->first();

                    if (count($buscarSoporteRepresentante)) {
                        $archivoAdjunto = $buscarSoporteRepresentante->id;
                    }

                }
        
                $crearPaso = $this->crearPaso($request['paso'],'ACEPTADO',$alianzaId,$coordinadorDestinoId,$input['observacion_aceptar_alianza']);
                $estadoPaso = 'ACEPTADO';
                if ( !$crearPaso ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede actualizar la aceptación de la alianza.');
                    goto end;
                }


                //array_push($okMsg,'<input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$input['aceptar_alianza'].'">');
            }elseif ( $input['aceptar_alianza'] == 'NO' ) {

                if (count($validarEstadoMail)) {
                    //if ($validarEstadoMail->estado_nombre == 'DECLINADO' && $validarEstadoMail->paso_observacion == $input['observacion_aceptar_alianza']) {
                    if ($validarEstadoMail->estado_nombre == 'DECLINADO') {
                        $errors += 1;
                        array_push($errorsMsg, 'El e-mail ya fue enviado. <br> La notificación del rechazo ya fue emitida.');
                        goto end;
                    }
                }
                $dataMail = '';
                
                /*
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
                */
                $crearPaso = $this->crearPaso($request['paso'],'DECLINADO',$alianzaId,$coordinadorDestinoId,$input['observacion_aceptar_alianza']);
                $estadoPaso = 'DECLINADO';
                $idPaso = $crearPaso->id;
                /*
                }
                */

                if ( !$crearPaso ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede actualizar el rechazo de la alianza.');
                    goto end;
                }

                
                
            }


            if ( $crearPaso ){
                $mail_id = 0;
                $mailDatos = [];
                $datos = [];
                $text_subject = 'Aceptación de';
                $text_msj_header = 'aceptado';
                $text_content = 'aceptamos';
                if ($input['aceptar_alianza'] == 'NO') {
                    $text_subject = 'Rechazo de';
                    $text_msj_header = 'rechazado';
                    $text_content = 'rechazamos';
                }

                $tipo_paso_id = $crearPaso->tipo_paso_id;
                /*
                if ( isset($request['modificar']) ) {
                    if ( count($dataMail) ) {
                        $mail_id = $dataMail[0]->id;
                        $idPaso = $dataMail[0]->pasos_alianza_id;
                        $crearTipo = 'actualizar';
                    }
                }
                */
            //CREAR EL REGISTRO DEL MAIL

                

                $tipo_mail = 'alianza';
                if ($mail_id != 0) {
                    $datos['id'] = $mail_id;
                }
                //buscar el email del usuario asignado para recibir una copia oculta de los emails
                $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                    ->where('model_has_roles.role_id',$roleCopiaEmailsId )
                    ->select('users.name', 'users.email')->first();

                $crearTipo = 'nuevo';

                $datos['crearTipo'] = $crearTipo;
                $datos['user_id'] = $coordinadorDestinoId;
                $datos['paso'] = $crearPaso->id;
                $datos['to'][0] = (object) $coordinadorOrigen;
                $datos['cc'][0] = '';
                $datos['bcc'][0] = $copia_oculta_email;
                $datos['subject'] = ucwords(strtolower( $buscarInstituciones[$keybuscarInstInt]['nombre'] )) .' - '.$text_subject.' la Solicitud de nueva alianza';

                //valida si existe el registro del email con el mismo usuario remitente y lo actualiza en lugar de crear mas registros
                $pasosAlianza_mail_id = \App\Models\Validation\PasosAlianza::join('pasos_alianza_mail','pasos_alianza.id','pasos_alianza_mail.pasos_alianza_id')
                            ->where('pasos_alianza.id',$crearPaso->id)
                            ->where('pasos_alianza_mail.user_id',$coordinadorDestinoId)
                            ->select('pasos_alianza_mail.mail_id')->pluck('mail_id');
                //agrega el id del mail y cambiar el tipo de creacion
                if ( count($pasosAlianza_mail_id) ) {
                    $datos['id'] = $pasosAlianza_mail_id;
                    $crearTipo = 'actualizar';
                }
                $datos['estadoPaso'] = $estadoPaso;

                //solicita los datos de la alianza
                $datosAlianza = $this->datosAlianza($alianzaId,'mail','ver',$tipo_paso_id);

                $dataUsers = $datosAlianza['dataUsers'];
                $keyCoordExterno = $datosAlianza['keyCoordExterno'];
                $keyCoordInterno = $datosAlianza['keyCoordInterno'];

                $msj_header_text = 'Le informamos que el coordinador '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_nombres'] )) .' '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['coordinador_apellidos'] )) .' de la institución '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['nombre'] )) .' de '. ucwords(strtolower( $dataUsers[$keyCoordExterno]['institucion']['ciudad']['pais_nombre'] )).' ha <strong>'.$text_msj_header.'</strong> la propuesta de alianza.';

                $datos['content'] = '[{"header":"'.$msj_header_text.'", "footer":"Hemos revizado los datos registrados y '.$text_content.' la propuesta de alianza."}]';

                $datos['archivosAdjuntos'] = '';

                if ($archivoAdjunto != 0) {
                    $datos['archivosAdjuntos'] = $archivoAdjunto;
                }
            //crear el registro del email
                $crearMail = $this->crearMail($tipo_mail,$datos);

                if ( $crearMail === 'error_mail' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }elseif ( $crearMail === 'error_paso' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el paso de la alianza para crear el el registro del mail.');
                    goto end;
                }elseif ( $crearMail === 'error_user' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'No se encuentra el usuario, no se puede crear el registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador interno.');
                    goto end;
                }elseif ( $crearMail === 'error_tipo_mail' || $crearMail === 'error_crear_tipo' ) {
                    $retorno = $crearMail;
                    $errors += 1;
                    array_push($returnMsg, 'Error al especificar el tipo del email a enviar, no se puede crear el registro del e-mail de notificación del paso \''.$tipos_pasos[3].'\' para el coordinador.');
                    goto end;
                }elseif ( is_string($crearMail) || $crearMail === false ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear el registro del mail del paso \''.$tipos_pasos[3].'\' de la alianza.');
                    goto end;
                }
            //enviar el email registrado
                $tipo_mail = 'alianza';
                $dataEnviarMail['origen_peticion'] = 'local';
                $dataEnviarMail['enviar'] = true;
                $dataEnviarMail['tokenmail'] = $crearMail->tokenmail;
                $dataEnviarMail['dataMail'][0] = $crearMail;

                //requiere el nombre del estado
                $dataEstado = DB::table('estado')
                    ->where('id',$crearPaso->estado_id )
                    ->select('estado.nombre AS estado_nombre')
                    ->first();
                //agrega elementos a los datos del email, se esta reemplazando el uso de la funcion mail()
                $crearMail->pasos_alianza_id = $crearPaso->id;
                $crearMail->paso_observacion = $crearPaso->observacion;
                $crearMail->estado_nombre = $dataEstado->estado_nombre;



                //se combinan los datos de la alianza a los datos a enviar en el email
                $dataEnviarMail = array_merge($dataEnviarMail,$datosAlianza);
                
                // $datosAlianzaKeys = array_keys($datosAlianza);
                // //print_r($datosAlianza['dataAlianza']);
                // foreach ($datosAlianzaKeys as $key) {
                //     //echo '$key:'.$key.' <br>';
                //     $dataEnviarMail[$key] = $datosAlianza[$key];
                // }
        

                //no es necesario enviarlo
                $dataEnviarMail['tipo_paso_id'] = $tipo_paso_id;
                $dataEnviarMail['alianzaId'] = $alianzaId;
        
   
                $enviarMail = $this->enviarMail($tipo_mail, $dataEnviarMail);

                if (is_array($enviarMail) && isset($enviarMail['errors'])) {
                    $errors += 1;
                    $errorsMsg = array_merge($errorsMsg, $enviarMail['returnMsg']);
                    goto end;
                }else{
                    array_push($okMsg,$enviarMail);
                }

                //Auth::logout();

                if ($input['aceptar_alianza'] == 'NO') {

                    //actualzar el estado a 1 (en proceso)
                    $estadoActiva = \App\Models\Estado::where([['uso','PROCESS'],['nombre','EN PROCESO']])->select('id','uso','nombre')->first();
                    $alianza->estado_id = $estadoActiva->id;
                    $alianza->save();

                    array_push($okMsg,'La respuesta de la peticion de alianza fue registrada correctamente. <br>');
                    if ($this->peticion != 'ajax') {
                        array_push($okMsg,'<input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$input['aceptar_alianza'].'"> <input type="hidden" class="dato_adicional" name="tokenmail" id="tokenmail" value="'.$crearMail->tokenmail.'"> <input type="hidden" class="dato_adicional" name="noNext" id="noNext" value="1">');
                    }

                    $paso = 6;
                }


            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar la aceptación/rechazo de la alianza.');
                goto end;
            }

            //se hace la colsulta que hara nuevamente la funcion mail() porque no se obtienen los datos 
            

            /*
            ya no se tiene que enviar, entes se creaba el registro del mail de rechazo en el paso 4, sino, se creaba el registro del mail de aceptacion en el paso 5 y se enviaba el mail de aceptacion el en paso 6 (aqui) pero ya no es necesario porque ya todo quedo en este mismo paso y ya se ejecuto
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
            //ya se esta guardando la aceptacion/rechazo de la alianza
            //$crearPaso = $this->crearPaso($request['paso'],'PENDIENTE POR REVISIÓN',$alianzaId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la alianza.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }
            */

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

            //verificar si existe validador para el paso registrado para crear y enviar el e-mail al validador o validadores
            // if ( isset($request['paso']) ) {

            //solo si acepto la solicitud se puede notificar al validador
            if ( $input['aceptar_alianza'] == 'SI' ) {
                //notificar a el validador en caso que este asociado al paso 

                //datos del ultimo registro del paso (PasosAlianza)
                $datosNotificar['paso_id'] = $crearPaso->id;
                $datosNotificar['tipo_paso_id'] = $crearPaso->tipo_paso_id;
                $datosNotificar['estado_id'] = $crearPaso->estado_id;
                $datosNotificar['alianza_id'] = $crearPaso->alianza_id;
                $datosNotificar['user_id'] = $crearPaso->user_id;
                $datosNotificar['observacion'] = $crearPaso->observacion;

                $datosNotificar['paso'] = $request['paso'];
                $datosNotificar['accion'] = 'creacion';
                //$datosNotificar['tipo_paso_id'] = $tipo_paso_id;
                $datosNotificar['alianzaId'] = $alianzaId;
                $datosNotificar['user_name'] = $this->user->name;
                $datosNotificar['user_email'] = $this->user->email;

                $notificarValidador = $this->notificarValidador('alianza', $datosNotificar);

                if (is_array($notificarValidador) && $notificarValidador['ok'] === false) {
                    $errors += 1;
                    $errorsMsg = array_merge($errorsMsg, $notificarValidador['returnMsg']);
                    goto end;
                }elseif( $notificarValidador === false ){
                    //continua normalmente
                    $errors += 1;
                    $errorsMsg = array_merge($errorsMsg, 'Ocurrio un error al notificar al validador');
                    goto end;
                }else{
                    array_push($okMsg,$notificarValidador);
                }
            }
            

            array_push($okMsg, 'Será notificado cuando haya una respuesta. <br>');
            /*
            if ($this->peticion != 'ajax') {
                $redirect_url = route('interalliances.index');
                array_push($okMsg,' <input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.$redirect_url.'">');
            }
            */
            // $this->tipoRuta = 'destination';
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
            if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                
            }
        }elseif ($paso == 0 ) {
            if ($this->peticion == 'ajax') {
                return Response::json(['No se recibieron datos'], 422);
            }else{
                Flash::error('No se recibieron datos');
            }
        }else{
            DB::commit();
            if ( isset($request['modificar']) ) {
                $msg .= 'Se actualizaron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente! <br/>';
            }else{
                $msg .= 'Se registraron los datos del paso \''.$tipos_pasos[$paso].'\' correctamente! <br/>';
            }

            if ($this->peticion != 'ajax') {
                //flash($msg);
                //$msg = implode('<p>', $msg);
                //print_r($msg);
                foreach ($okMsg as $key => $value) {
                    $pos = strpos($value, '<input');
                    if ($pos === false) { 
                        $value = str_replace('<br>', '', $value);
                        $msg .= $value.' <br>';
                    }
                }
                Flash::success($msg);
                //echo $input['tipoRuta'];
                
            }else{
                
                array_push($okMsg,$msg.'<input type="hidden" class="dato_adicional" name="alianzaId" value="'.$alianzaId.'"> <input type="hidden" name="modificar" value="1">');
                //array_push($okMsg,$msg.'<input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.route('interalliances.index').'">'); 

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
         // if ($this->peticion == 'ajaxssssssssss') {
        // if ($this->peticion != 'ajax') {
            /*if (isset($input['tipoRuta'])) {
                if ( in_array($input['tipoRuta'], ['interalliances.destination.edit','interalliances.destination']) && $errors > 0 ) {
                    return redirect(route('interalliances.destination',$alianzaId));
                }else{
                    return redirect(route('interalliances.show',$alianzaId));
                }
            }else{*/
                if ($errors > 0 || $paso == 0) {
                    if ( strpos($this->tipoRuta, 'destination') === false ) {
                        return redirect(route('interalliances.show',$alianzaId));
                    }else{
                        return redirect(route('interalliances.destination',$alianzaId));
                    }
                }else{
                    if ( strpos($this->tipoRuta, 'destination') === false ) {
                        return redirect(route('interalliances.index'));
                    }else{
                        return redirect(route('interalliances.destination',$alianzaId));
                    }
                }
            // }
        // }

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
            
            if ( !isset($request['validar_estado']) ) {
                //validar si la alianza fue declinada
                if ( isset($request['aceptar_alianza']) && $request['aceptar_alianza'] == 'SI' ) {
                        
                }elseif ( isset($request['aceptar_alianza']) && $request['aceptar_alianza'] == 'NO' ) {
                    
                    array_push($okMsg,'Usted ha rechazado la alianza. <br> <input type="hidden" class="dato_adicional" name="aceptar_alianza" value="'.$request['aceptar_alianza'].'">');
                    $paso = $request['paso'];
                } 
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
            // echo $dataMail->toSql().' |$alianzaId:'.$alianzaId.' |$tipo_paso:'.$tipo_paso;
            $dataMail = $dataMail->get();

            if ( count($dataMail) > 0 ) {

                if ( isset($request['validar_estado']) ) {
                    return $dataMail[0];
                }
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

                        $viewWith = array_merge($viewWith, ['dataMail' => $dataMail, 'omitir_adjuntos' => true]);
                        
                    }


                    //return view('emails.alianzas.response');
                    return view($vista)->with($viewWith);

                }elseif ( isset($request['enviar']) && isset($request['tokenmail']) ) {

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
        
        $alianza = \App\Models\Alianza::where('token',$id)->first();
        //print_r($alianza);
        if (empty($alianza)) {
            $alianza = $this->alianzaRepository->findWithoutFail($id);
        }

        $alianzaId = 0;
        $dataAlianza = '';
        $dataUsers = 0;
        $pasoAlianza = '';
        $archivosAdjuntos = '';
        $CoordinadorInterno = 0;
        $CoordinadorExterno = 0;
        $viewWith = [];
        $this->user = Auth::user();

        if (empty($alianza)) {
            Flash::error('Alianza no encontrada');

            return redirect(route('interalliances.index'));
        }else{
            $alianzaId = $alianza->id;
            

            if ($peticion != '') {
                $this->peticion = $peticion;
            }

            $paso_titulo = $this->tipoPaso->where('nombre','like','%_alianza')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');
            //el tipo de paso setteado es porque el la alianza estan asociados los archivos adjuntos al paso3_alianza
            $tipo_paso = $this->tipoPaso->where('nombre', 'paso3_alianza')->pluck('id');

            //solicita los datos de la alianza
            $datosAlianza = $this->datosAlianza($alianzaId,'show','ver',$tipo_paso);


            // print_r($datosAlianza);
            $keyCoordExterno = $datosAlianza['keyCoordExterno'];
            
            //evita que el coordinador externo ingrese
            if (strpos($this->tipoRuta, 'destination') === false && $this->peticion != 'local' && $keyCoordExterno !== false) {
                $CoordinadorExterno = $datosAlianza['dataUsers'][$keyCoordExterno]['usuario_id'];
                if ($this->user->id == $CoordinadorExterno) {
                    return redirect(route('interalliances.destination',$alianzaId));
                }else{
                    $viewWith = $datosAlianza;
                }
            }else{
                $viewWith = $datosAlianza;
            }

            $view = 'InterAlliance.show';
            

            // print_r($viewWith);
            if ( $this->peticion == 'local' ) {
                return $viewWith;
            }else{
                $viewWith = array_merge($viewWith, ['tipoRuta' => $this->tipoRuta, 'campusApp' => $this->campusApp]);
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
        $this->user = Auth::user();
        $roleCoordinadorInterno = Role::where('name','coordinador_interno')->pluck('id')->first();
        $roleCoordinadorExterno = Role::where('name','coordinador_externo')->pluck('id')->first();
        $roleRepresentante = Role::where('name','representante_legal')->pluck('id')->first();
        //datos de los coordinadores internos y externos que estan asociados a la alianza 
            $dataUsers = DB::table('alianza')
                    ->join('alianza_user', 'alianza.id', '=', 'alianza_user.alianza_id')
                    ->join('users', 'alianza_user.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->leftJoin('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                    ->where('alianza.id',$alianzaId )
                    ->whereIn('model_has_roles.role_id',[$roleCoordinadorInterno,$roleCoordinadorExterno] )
                    ->select('users.id AS usuario_id','users.activo AS usuario_activo','users.remember_token AS usuario_password','users.name AS usuario_name','alianza.token AS token_alianza','model_has_roles.role_id','datos_personales.nombres AS coordinador_nombres','datos_personales.apellidos AS coordinador_apellidos','datos_personales.cargo AS coordinador_cargo','datos_personales.telefono AS coordinador_telefono','users.email AS coordinador_email')
                    ->orderBy('users.id','asc')
                    ->get()->toArray();
            if (count($dataUsers) < 2 ) {
                $CoordinadorExterno = 0;
                $CoordinadorInterno = 0;
            }
            //asigna el id de cada tipo de coordinador
            foreach ($dataUsers as $data => $user) {
                if ($user->role_id == $roleCoordinadorInterno) {
                    $CoordinadorInterno = $user->usuario_id;
                }elseif ($user->role_id == $roleCoordinadorExterno) {
                    $CoordinadorExterno = $user->usuario_id;
                }
            }
            //obtiene la lista de todos los estados
            $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
            //separa solo los estados que usara el coordinador externo al aceptar / rechazar la alianza
            $estadosExternosData = array_filter($estadosData, function($var){
                return ($var['uso'] == 'EXTERNAL');
            });
            //separa solo los estados que usaran los validadores
            $estadosValidaciones = array_filter($estadosData, function($var){
                return ($var['uso'] == 'VALIDATOR');
            });
            //busca las observaciones del coordinador externo para mostrarlas
            $estadoExterno = array();
            $estadoExterno = array_column($estadosExternosData, 'id');
            // reset($estadosValidaciones);
            $keyEstadoRechazado = array_search('RECHAZADO', array_column($estadosValidaciones, 'nombre'));
            $keysEstadosValidaciones = array_keys($estadosValidaciones);
            
            //guarda el estado rechazado
            $keyEstadoRechazado = $keysEstadosValidaciones[$keyEstadoRechazado];
            // echo '|'.$keyEstadoRechazado.'|';
            // print_r($estadosValidaciones);
            //obtiene el registro del coord externo al aceptar la alianza
            $observacionCoordExterno = DB::table('pasos_alianza')
                    ->join('estado','pasos_alianza.estado_id','estado.id')
                    ->where('pasos_alianza.alianza_id',$alianzaId )
                    ->whereIn('pasos_alianza.estado_id',$estadoExterno )
                    ->select('pasos_alianza.user_id AS usuario_id','pasos_alianza.observacion','estado.nombre')
                    ->get()->toArray();

            //obtiene los datos del campus y la institucion de los coordinadores
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
                foreach ($observacionCoordExterno as $dataObservacion => $observacion) {
                    if ($user->usuario_id == $observacion->usuario_id) {
                        $user->observacion = $observacion;
                    }
                }
            }



        $dataUsers = json_decode(json_encode($dataUsers),true);
        //print_r($dataUsers);
        
        $keyCoordExterno = array_search($CoordinadorExterno, array_column($dataUsers, 'usuario_id'));
        $keyCoordInterno = array_search($CoordinadorInterno, array_column($dataUsers, 'usuario_id'));
        

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' || $destino == 'destination' ) {

            //buscar los archivos de soporte del representante legal
            $tipo_documento_id = \App\Models\TipoDocumento::where('nombre',['REPRESENTACIÓN LEGAL'])->pluck('id')->first();

            $buscarDocumentoRepresentante = DB::table('documentos_institucion')->where('tipo_documento_id',$tipo_documento_id)
                ->where('institucion_id',$dataUsers[$keyCoordExterno]['institucion']['id'])
                ->select('id','archivo_id')->get()->toArray();
            $archivosDocumentoRepresentante = 0;
            if (count($buscarDocumentoRepresentante)) {
                $archivosDocumentoRepresentante = \App\Models\Archivo::whereIn('id',array_column($buscarDocumentoRepresentante, 'archivo_id'))
                    ->select('id','nombre','path')->get();
            }

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

            $dataAplicaciones = DB::table('alianza')
                    ->join('alianza_aplicaciones', 'alianza.id', '=', 'alianza_aplicaciones.alianza_id')
                    ->join('aplicaciones', 'alianza_aplicaciones.aplicaciones_id', '=', 'aplicaciones.id')
                    ->join('tipo_alianza', 'aplicaciones.tipo_alianza_id', '=', 'tipo_alianza.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('tipo_alianza.id AS tipo_alianza_id','tipo_alianza.nombre AS tipo_alianza_nombre','aplicaciones.id AS aplicaciones_id','aplicaciones.nombre AS aplicaciones_nombre' )
                    ->get()
                    ->toArray();
            $dataAplicaciones = json_decode(json_encode($dataAplicaciones),true);
            



            $dataAlianza = DB::table('alianza')
                    ->join('tipo_tramite', 'alianza.tipo_tramite_id', '=', 'tipo_tramite.id')
                    ->join('estado', 'alianza.estado_id', '=', 'estado.id')
                    ->where('alianza.id',$alianzaId )
                    ->select('alianza.*','estado.nombre AS estado_nombre','tipo_tramite.nombre AS tipo_tramite_nombre' )
                    ->first();
            $dataAlianza = json_decode(json_encode($dataAlianza),true);

            //verifica si ya existen validadores revisando y que hayan rechazado alguna revision de la alianza para permitir editar 
            $pasosAlianza = \App\Models\Validation\PasosAlianza::where('alianza_id',$alianzaId)->whereIn('estado_id',array_column($estadosValidaciones, 'id'))->get()->toArray();
            $editar = false;
            if ( count($pasosAlianza) ) {
                $hanRechazado = array_search($estadosValidaciones[$keyEstadoRechazado]['id'], array_column($pasosAlianza, 'estado_id'));
                if ( $hanRechazado !== false && in_array($this->user->id, [$CoordinadorInterno,$CoordinadorExterno]) ) {
                    $editar = true;
                }
            }else{
                $editar = true;
            }

            //echo $dataAlianza->toSql();
            $dataAlianza['facultades'] = $dataFacultades;
            $dataAlianza['programas'] = $dataProgramas;
            $dataAlianza['aplicaciones'] = $dataAplicaciones;
   
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
                
                
        $viewWith = ['alianzaId' => $alianzaId, 'dataUsers' => $dataUsers, 'CoordinadorInterno' => $CoordinadorInterno, 'CoordinadorExterno' => $CoordinadorExterno, 'keyCoordExterno' => $keyCoordExterno, 'keyCoordInterno' => $keyCoordInterno,'peticion' => $this->peticion];

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' || $destino == 'destination' ) {
            if ( $filtro == 'declinado' ) {
                return $viewWith;
            }elseif ( $filtro == 'ver' ) {

                $viewWith = array_merge($viewWith, ['paso_titulo' => $this->paso_titulo, 'dataAlianza' => $dataAlianza, 'editar' => $editar, 'archivosAdjuntos' => $archivosAdjuntos, 'archivosDocumentoRepresentante' => $archivosDocumentoRepresentante]);
                
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
    public function edit($id_o_token,$paso = '', Request $request)
    {
        //return \View::make('errors.404')->with(['peticion' => $this->peticion]);
        $verificarToken = '';
        $viewWith = [];
        $alliance = [];
        $existeRepresentante = false;
        $alianzaId = 0;
        $tipo_paso = 0;
        $destino = 'edit';
        $existe_paso = 0;
        $datosAlianza = '';
        $keyCoordExterno = 0;
        $vista = 'InterAlliance.edit';
        $this->user = Auth::user();

        $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();
        $estadoAlianzaActiva = array_filter($estadosData, function($var){
            return ($var['uso'] == 'PROCESS' && $var['nombre'] == 'ACTIVA');
        });
        $estadosValidaciones = array_filter($estadosData, function($var){
            return ($var['uso'] == 'VALIDATOR');
        });
        reset($estadoAlianzaActiva);
        $keyEstadoAlianza = key($estadoAlianzaActiva);
        $keyEstadoValidacion = array_search('RECHAZADO', array_column($estadosValidaciones, 'nombre'));
        $keysEstadosValidaciones = array_keys($estadosValidaciones);
        $keyEstadoValidacion = $keysEstadosValidaciones[$keyEstadoValidacion];

        // $alianza = \App\Models\Alianza::where('token',$id_o_token)->where('estado','1')->select('id','token')->first();
        $alianza = \App\Models\Alianza::where('token',$id_o_token)->select('id','token')->first();

        if (empty($alianza)) {
            //si no se obtiene por el token entonces por el id
            $alianza = $this->alianzaRepository->findWithoutFail($id_o_token);
            if ( count($alianza) > 0 ) { 
                
                $viewWith = [];
                $alliance = [];
                $existeRepresentante = false;
                $alianza = $alianza;
                $alianzaId = $alianza->id;

                $validarAcceso = $this->validarAcceso('editar',$this->user->id,$alianzaId);

                if ($validarAcceso === 'coordinador_externo') {
                    return redirect(route('interalliances.destination.edit',$alianzaId));
                }elseif($validarAcceso === false){
                    Flash::error('No tiene permitido editar esta alianza');

                    return redirect(route('interalliances.index'));
                }

            }else{

                Flash::error('No se encontro la alianza o no se puede editar');

                return redirect(route('interalliances.index'));
            }
        }else{
            $alianzaId = $alianza->id;
        }

        //verifica si ya existen validadores revisando y que hayan rechazado alguna revision de la alianza para permitir editar 
        $pasosAlianza = \App\Models\Validation\PasosAlianza::where('alianza_id',$alianzaId)->whereIn('estado_id',array_column($estadosValidaciones, 'id'))->get()->toArray();
        $continuar = false;
        if ( count($pasosAlianza) ) {
            $hanRechazado = array_search($estadosValidaciones[$keyEstadoValidacion]['id'], array_column($pasosAlianza, 'estado_id'));
            if ( $hanRechazado !== false ) {
                $continuar = true;
            }
        }else{
            $continuar = true;
        }


        if ($alianza->estado_id == $estadoAlianzaActiva[$keyEstadoAlianza]['id'] || $continuar == false) {
            Flash::error('No se encontro la alianza o no se puede editar');

            return redirect(route('interalliances.index'));
        }

        if ($paso != '') {
            //echo $paso;
            //verificar si existe el paso 
            $existe_paso = $this->tipoPaso->where('nombre', 'paso'.$paso.'_alianza')->pluck('id');
            if (!count($existe_paso)) {
                Flash::error('No se encontro el paso de la alianza');

                return redirect(route('interalliances.show',$alianza->id));
            }
        }else{
            $paso = '3';
        }

        if ($this->tipoRuta == 'interalliances.destination.edit') {
            $destino = 'destination';
            
        }else{

            $tipo_paso = $this->tipoPaso->where('nombre', 'paso'.$paso.'_alianza')->pluck('id');
        }

        $datosAlianza = $this->datosAlianza($alianza->id,$destino,'ver',$tipo_paso);
        
        //print_r($datosAlianza);
        $keyCoordInterno = $datosAlianza['keyCoordInterno'];
        $keyCoordExterno = $datosAlianza['keyCoordExterno'];

        if ($datosAlianza['editar'] === false) {
            Flash::error('No se puede editar la alianza');

            return redirect(route('interalliances.index'));
        }

        $dataAlianza['alianzaId'] = $datosAlianza['dataAlianza']['id'];
        //verifica si la ruta es para edicion por parte del coordinador externo
        if ($this->tipoRuta != 'interalliances.destination.edit') {
            
            $alliance['tipo_tramite'] = $datosAlianza['dataAlianza']['tipo_tramite_id'];


            $dataAlianza['tipo_tramite'] = $datosAlianza['dataAlianza']['tipo_tramite_id'];
            $dataAlianza['facultad_origen'] = array_column($datosAlianza['dataAlianza']['facultades'], 'facultad_id');
            $dataAlianza['programa_origen'] = array_column($datosAlianza['dataAlianza']['programas'], 'programa_id');
            
            $dataAlianza['facultad_origen_otro'] = '';

            $dataAlianza['tipo_alianza'] = $datosAlianza['dataAlianza']['aplicaciones'][0]['tipo_alianza_id'];
            $dataAlianza['aplicaciones'] = array_column($datosAlianza['dataAlianza']['aplicaciones'], 'aplicaciones_id'); 
            $dataAlianza['responsable_arl'] = $datosAlianza['dataAlianza']['responsable_arl'];


            $dataAlianza['duracion_cant'] = substr($datosAlianza['dataAlianza']['duracion'], 0, strpos($datosAlianza['dataAlianza']['duracion'], " "));
            $dataAlianza['duracion_unid'] = substr($datosAlianza['dataAlianza']['duracion'], strpos($datosAlianza['dataAlianza']['duracion'], " ") +1 );  
            $dataAlianza['objetivo_alianza'] = $datosAlianza['dataAlianza']['objetivo'];

            // $dataAlianza['sera_coordinador_origen'] = 'NO';


            $dataAlianza['coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['usuario_id'];
            $dataAlianza['nombre_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_nombres'];
            $dataAlianza['cargo_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_cargo'];
            $dataAlianza['telefono_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_telefono'];
            $dataAlianza['email_coordinador_origen'] = $datosAlianza['dataUsers'][$keyCoordInterno]['coordinador_email'];
            
            //valida que el coordinador este inactivo para permitir modificar los datos del coordinador
            //if ($datosAlianza['dataUsers'][$keyCoordInterno]['usuario_activo'] == '1' ) {
                //$dataAlianza['coordinador_origen_activo'] = '999999';
                $dataAlianza['coordinador_origen_activo'] = $datosAlianza['dataUsers'][$keyCoordInterno]['usuario_activo'];
            /*}else{
                $dataAlianza['nombre_coordinador_origen'] = '';
                $dataAlianza['cargo_coordinador_origen'] = '';
                $dataAlianza['telefono_coordinador_origen'] = '';
                $dataAlianza['email_coordinador_origen'] = '';
            }
            */
            
        }
        if ($keyCoordExterno !== false) {
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

            $dataAlianza['coordinador_destino_activo'] = $datosAlianza['dataUsers'][$keyCoordExterno]['usuario_activo'];

            $dataAlianza['nombre_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_nombres'];
            $dataAlianza['cargo_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_cargo'];
            $dataAlianza['telefono_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_telefono'];
            $dataAlianza['email_coordinador_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['coordinador_email'];
        

            if ( isset($datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante'])  ) {

                $existeRepresentante = true;

                //verifica si la ruta es para edicion por parte del coordinador externo
                if ($this->tipoRuta == 'interalliances.destination.edit') {
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
                }

                //verifica la existencia del representante legal y que este activo 
                //if ( $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['usuario_activo'] == '1' ) {
                    //$dataAlianza['institucion_destino'] = '999999';
                //}else{
                    /*
                    //verifica si la ruta es para edicion por parte del coordinador externo
                    if ($this->tipoRuta == 'interalliances.destination.edit') {
                        //$existeRepresentante = true;

                        $dataAlianza['tipo_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['tipo_institucion_nombre'];
                        $dataAlianza['pais_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['pais_nombre'];
                        $dataAlianza['departamento_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['departamento_nombre'];
                        $dataAlianza['ciudad_institucion_destino'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['ciudad']['ciudad_nombre'];


                        $dataAlianza['repre_pais_nacimiento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['pais_nombre'];
                        $dataAlianza['repre_tipo_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['tipo_documento_nombre'];
                        $dataAlianza['repre_pais_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['pais_nombre'];
                        $dataAlianza['repre_departamento_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['departamento_nombre'];
                        $dataAlianza['repre_ciudad_exped_documento'] = $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['representante']['lugar_expedicion']['ciudad_nombre'];
                    }else{
                        //valida que el representante este inactivo para permitir modificar los datos de la institucion
                        $dataAlianza['tipo_institucion_destino'] = '';
                        $dataAlianza['nombre_institucion_destino'] = '';
                        $dataAlianza['direccion_institucion_destino'] = '';
                        $dataAlianza['telefono_institucion_destino'] = '';
                        $dataAlianza['codigo_postal_institucion_destino'] = '';
                        $dataAlianza['pais_institucion_destino'] = '';
                        $dataAlianza['departamento_institucion_destino'] = '';
                        $dataAlianza['ciudad_institucion_destino'] = '';
                    }
                    */
                //}
            }else{
                //$dataAlianza['institucion_destino'] = '999999';
            }
        }

        //verifica si la ruta es para edicion por parte del coordinador externo
        if ($this->tipoRuta == 'interalliances.destination.edit') {
            //if ($existeRepresentante == false ) {
                //retornar el formulario desde el paso 4 al coordinador
                $tipo_institucion_destino = $this->tipoInstitucion->pluck('nombre','id');
                $pais_institucion_destino = $this->pais->pluck('nombre','id');

                $departamento_institucion_destino = '';
                $ciudad_institucion_destino = '';
                $repre_departamento_exped_documento = '';
                $repre_ciudad_exped_documento = '';
                if (isset($dataAlianza['pais_institucion_destino'])) {
                    $departamento_institucion_destino = \App\Models\Admin\State::join('ciudad','departamento.id','=','ciudad.departamento_id')->where('departamento.pais_id',$dataAlianza['pais_institucion_destino'])->orderBy('departamento.nombre','asc')->pluck('departamento.nombre','departamento.id');
                }
                if (isset($dataAlianza['departamento_institucion_destino'])) {
                    $ciudad_institucion_destino = \App\Models\Admin\City::where('departamento_id',$dataAlianza['departamento_institucion_destino'])->orderBy('nombre','asc')->pluck('nombre','id');

                }
                if (isset($dataAlianza['repre_pais_exped_documento'])) {
                    $repre_departamento_exped_documento = \App\Models\Admin\State::join('ciudad','departamento.id','=','ciudad.departamento_id')->where('departamento.pais_id',$dataAlianza['repre_pais_exped_documento'])->orderBy('departamento.nombre','asc')->pluck('departamento.nombre','departamento.id');
                }
                if (isset($dataAlianza['repre_departamento_exped_documento'])) {
                    $repre_ciudad_exped_documento = \App\Models\Admin\City::where('departamento_id',$dataAlianza['repre_departamento_exped_documento'])->pluck('nombre','id');
                }
                
                //$repre_departamento_exped_documento = '';

                //$repre_ciudad_exped_documento = '';
                
                
                $clase_documento = \App\Models\ClaseDocumento::where('nombre','IDENTIDAD')->pluck('id');
                $repre_tipo_documento = \App\Models\TipoDocumento::where('clase_documento_id',$clase_documento)->pluck('nombre','id');
            //}
            if ($keyCoordExterno !== false) {
                $coordinador_destino_todos = $this->coordinador_destino
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('campus.institucion_id', $datosAlianza['dataUsers'][$keyCoordExterno]['institucion']['id'] )->role(['coordinador_externo','profesor'])->select('users.name','users.id');
                $coordinador_destino = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_destino_todos)->pluck('name','id');
            }else{
                $coordinador_destino = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->pluck('name','id');
            }

        }else{
            
            /*
            //valida que el coordinador este inactivo para permitir modificar los datos del coordinador
            //if ($datosAlianza['dataUsers'][$keyCoordExterno]['usuario_activo'] == '1' ) {
                $dataAlianza['coordinador_destino'] = '999999';
            }else{
            
                $dataAlianza['nombre_coordinador_destino'] = '';
                $dataAlianza['cargo_coordinador_destino'] = '';
                $dataAlianza['telefono_coordinador_destino'] = '';
                $dataAlianza['email_coordinador_destino'] = '';
            }
            */
            if ( isset($datosAlianza['archivosAdjuntos']) && is_array($datosAlianza['archivosAdjuntos']) ) {
                $documentos_seleccionados = array_column($datosAlianza['archivosAdjuntos'], 'id');
            }else{
                $documentos_seleccionados = 0;
            }
            
        }

        
        //verifica si la ruta es para edicion por parte del coordinador externo
        if ($this->tipoRuta == 'interalliances.destination.edit') {
            
            //datos generales
            $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'tipoRuta' => $this->tipoRuta, 'atoken' => $alianza->token,'alianzaId' => $alianzaId,'existeRepresentante' => $existeRepresentante, 'alliance' => $dataAlianza, 'coordinador_destino' => $coordinador_destino, 'paso_titulo' => $this->paso_titulo, 'nombre' => 'alianza', 'paso' => '4','peticion' => 'externa']);

            //if ($existeRepresentante == false) {
                //datos para la institucion de destino
                $viewWith = array_merge($viewWith, ['tipo_institucion_destino' => $tipo_institucion_destino, 'pais_institucion_destino' => $pais_institucion_destino, 'departamento_institucion_destino' => $departamento_institucion_destino, 'ciudad_institucion_destino' => $ciudad_institucion_destino]);

                //datos para el representante
                $viewWith = array_merge($viewWith, ['repre_pais_nacimiento' => $pais_institucion_destino,'repre_tipo_documento' => $repre_tipo_documento, 'repre_pais_exped_documento' => $pais_institucion_destino]);

                if ($repre_departamento_exped_documento != '' && $repre_ciudad_exped_documento != '') {
                    $viewWith = array_merge($viewWith, ['repre_departamento_exped_documento' => $repre_departamento_exped_documento, 'repre_ciudad_exped_documento' => $repre_ciudad_exped_documento]);
                }
            //}
            if (empty($existe_paso)) {
                $viewWith = array_merge($viewWith, ['editar_paso' => false]);
                $vista = 'InterAlliance.create';
            }else{
                $viewWith = array_merge($viewWith, ['editar_paso' => $paso]);
                $vista = 'InterAlliance.edit';
            }

        }else{
            //obtiene los datos iniciales para los campos de los formularios
            // se envia el origen de la peticion como 'local' para que retorne solo los datos
            $viewWith = $this->origin($alianza->id,'local');
            
            $viewWith['programa_origen'] = \App\Models\Admin\Programa::whereIn('facultad_id', $dataAlianza['facultad_origen'])->pluck('nombre','id');
            $viewWith['aplicaciones'] = \App\Models\Aplicaciones::where('tipo_alianza_id', $dataAlianza['tipo_alianza'])->pluck('nombre','id');

            if (isset($dataAlianza['pais_institucion_destino'])) {
                $viewWith['departamento_institucion_destino'] = \App\Models\Admin\State::join('ciudad','departamento.id','=','ciudad.departamento_id')->where('departamento.pais_id', $dataAlianza['pais_institucion_destino'])->orderBy('departamento.nombre','asc')->pluck('departamento.nombre','departamento.id');
            }
            if (isset($dataAlianza['departamento_institucion_destino'])) {
            $viewWith['ciudad_institucion_destino'] = \App\Models\Admin\City::where('departamento_id', $dataAlianza['departamento_institucion_destino'])->pluck('nombre','id');
            }
            if (isset($dataAlianza['institucion_destino']) ) {
                $request['rol'] = 'coordinador_destino_solo';
                $request['id'] = $dataAlianza['institucion_destino'];
                $coordinador_destino = $this->list($request);

                $viewWith['coordinador_destino'] = $coordinador_destino;
            }

            if ($documentos_seleccionados != 0) {
                $viewWith = array_merge($viewWith, ['documentos_seleccionados' => $documentos_seleccionados]);
            }

            $viewWith = array_merge($viewWith, ['tipoRuta' => $this->tipoRuta, 'alliance' => $dataAlianza,'editar_paso' => false]);
        }

        $viewWith = array_merge($viewWith, ['peticion' => 'normal']);
        return view($vista)->with($viewWith);
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
    public function getList($request)
    {
        $lista = [''];
        switch ($request['rol']) {
            //para llenar los campos de texto del paso 1
            case 'coordinador_origen':
                //el usuario coordinador_interno o profesor que pertenezca a la institucion local
                $coordinador_destino_todos = $this->coordinador_origen
                    ->join('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('users.id', $request['id'] )
                    ->where('campus.institucion_id', \Config::get('options.institucion_id') )->role(['coordinador_interno','profesor'])->select('users.id AS coordinador_origen','users.activo AS coordinador_origen_activo','users.activo AS usuario_activo','users.name AS nombre_coordinador_origen','datos_personales.cargo AS cargo_coordinador_origen','datos_personales.telefono AS telefono_coordinador_origen','users.email AS email_coordinador_origen')
                    ->groupBy('users.id');
                    
                $lista = $coordinador_destino_todos->get()->toArray();
                //$lista = $coordinador_destino_todos->pluck('nombre','cargo','telefono','email');

                break;
            case 'coordinador_destino_datos':
                //el usuario coordinador_externo o profesor que NO pertenezca a la institucion local
                $coordinador_destino_datos = $this->coordinador_destino
                    ->join('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('users.id', $request['id'] )
                    ->where('campus.institucion_id', '<>', \Config::get('options.institucion_id') )->role(['coordinador_externo','profesor'])->select('users.activo AS usuario_activo','users.name AS nombre_coordinador_destino','datos_personales.cargo AS cargo_coordinador_destino','datos_personales.telefono AS telefono_coordinador_destino','users.email AS email_coordinador_destino');
                $lista = $coordinador_destino_datos->get()->toArray();
                //$lista = $coordinador_destino_datos->pluck('nombre','cargo','telefono','email');
                break;
            case 'coordinador_destino':

                $institucion = DB::table('institucion')
                    ->join('campus', 'institucion.id', '=', 'campus.institucion_id')
                    ->join('tipo_institucion', 'institucion.tipo_institucion_id', '=', 'tipo_institucion.id')
                    ->where('institucion.id',$request['id'])
                    ->select('institucion.*','tipo_institucion.nombre AS tipo_institucion_nombre','campus.direccion AS campus_direccion','campus.telefono AS campus_telefono','campus.codigo_postal AS campus_codigo_postal' )
                    ->get()->toArray();

                $ciudadInstitucion = DB::table('campus')
                    ->join('ciudad', 'campus.ciudad_id', '=', 'ciudad.id')
                    ->join('departamento', 'ciudad.departamento_id', '=', 'departamento.id')
                    ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                    ->where('campus.institucion_id',$request['id'])
                    ->groupBy('campus.institucion_id')
                    ->select('campus.institucion_id','pais.id AS pais_id','pais.nombre AS pais_nombre','departamento.id AS departamento_id','departamento.nombre AS departamento_nombre','ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre')
                    ->get()->toArray();

                //asociar los datos de la ciudad a la institucion
                $institucion[0]->ciudad = $ciudadInstitucion[0];

                //print_r($institucion);
                //$institucion = json_decode(json_encode($institucion[0]),true);
                /*
                foreach ($institucion as $data => $institucionDatos) {
                    foreach ($ciudadInstitucion as $data => $ciudad) {
                        if ($institucionDatos->id == $ciudad->institucion_id) {
                            $institucionDatos->ciudad = $ciudad;
                        }
                    }
                }
                */
                $pais_institucion_destino = $this->pais->pluck('nombre','id');
                $departamento_institucion_destino = \App\Models\Admin\State::where('pais_id',$institucion[0]->ciudad->pais_id)->pluck('nombre','id');
                $ciudad_institucion_destino = \App\Models\Admin\City::where('departamento_id',$institucion[0]->ciudad->departamento_id)->pluck('nombre','id');

                $dataInstitucion[0]['tipo_institucion_destino'] = $institucion[0]->tipo_institucion_id;
                $dataInstitucion[0]['nombre_institucion_destino'] = $institucion[0]->nombre;
                $dataInstitucion[0]['direccion_institucion_destino'] = $institucion[0]->campus_direccion;
                $dataInstitucion[0]['telefono_institucion_destino'] = $institucion[0]->campus_telefono;
                $dataInstitucion[0]['codigo_postal_institucion_destino'] = $institucion[0]->campus_codigo_postal;
                $dataInstitucion[0]['pais_institucion_destino'] = $pais_institucion_destino;
                $dataInstitucion[0]['departamento_institucion_destino'] = $departamento_institucion_destino;
                $dataInstitucion[0]['ciudad_institucion_destino'] = $ciudad_institucion_destino;
                //al nombre se le agraga '_seleccion' para que el jquery lo identifique
                $dataInstitucion[0]['pais_institucion_destino_seleccion'] = $institucion[0]->ciudad->pais_id;
                $dataInstitucion[0]['departamento_institucion_destino_seleccion'] = $institucion[0]->ciudad->departamento_id;
                $dataInstitucion[0]['ciudad_institucion_destino_seleccion'] = $institucion[0]->ciudad->ciudad_id;


                $coordinador_destino_todos = $this->coordinador_destino
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('campus.institucion_id', $request['id'] )->role(['coordinador_externo','profesor'])->select(DB::raw('concat(users.name," (",users.email,")")'),'users.id');
                $dataInstitucion[0]['coordinador_destino'] = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_destino_todos)->pluck('name','id');

                $dataInstitucion = json_decode(json_encode($dataInstitucion),true);

                $lista = $dataInstitucion;
                break;
            case 'coordinador_destino_solo':

                $coordinador_destino_todos = $this->coordinador_destino
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                    ->where('campus.institucion_id', $request['id'] )->role(['coordinador_externo','profesor'])->select(DB::raw('concat(users.name," (",users.email,")")'),'users.id');
                $lista = $this->coordinador_destino->select(DB::raw("'Otro' AS name, '999999' AS id"))->union($coordinador_destino_todos)->pluck('name','id');
                break;
        }
        //print_r($lista);
        return $lista;
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
        $input = $request->all();
        return $this->getList($input);
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

                //datos personales
                if (isset($dataUser['name'])) {
                    $actualizarUser->name = $dataUser['name'];
                }
                if (isset($dataUser['email'])) {
                    if ( $actualizarUser->email != $dataUser['email'] ) {
                        $actualizarUser->activo = 1;
                    }
                    $actualizarUser->email = $dataUser['email'];
                }
                //datos personales
                if (isset($datosPersonales['nombres'])) {
                    $actualizarUser->datos_personales->nombres = $datosPersonales['nombres'];
                }
                if (isset($datosPersonales['ciudad_residencia_id'])) {
                    $actualizarUser->datos_personales->ciudad_residencia_id = $datosPersonales['ciudad_residencia_id'];
                }
                if (isset($datosPersonales['telefono'])) {
                    $actualizarUser->datos_personales->telefono = $datosPersonales['telefono'];
                }
                if (isset($datosPersonales['cargo'])) {
                    $actualizarUser->datos_personales->cargo = $datosPersonales['cargo'];
                }
                //guardar los cambios en el usuario y sus datos personales
                $actualizarUser->push(); 

                $tipo = 'coordinador';
                if ($rol == 'representante_legal') {
                    $tipo = 'representante';
                }
                $asociarUsuario = $this->asociarUsuario($tipo,$actualizarUser->id,$rol,$campus,$alianza);
                if ( $asociarUsuario == 'error_usuario' ) {
                    $retorno = 'error_asociar';
                    goto end;
                }

                $retorno = $actualizarUser;

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
                if (isset($dataCampus['nombre'])) {
                    $actualizarCampus->nombre = $dataCampus['nombre'];
                }
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



    /**
     * Remove the specified PasosAlianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function validarAcceso($tipo,$user_id,$alianza_id = '')
    {   
        $retorno = false;
        $institucion = 0;
        if($tipo == 'editar'){

            $rolesUsuario = DB::table('model_has_roles')->join('roles','model_has_roles.role_id','roles.id')->where('model_has_roles.model_id',$user_id )->select('roles.name')->get()->toArray();

            if (empty($rolesUsuario)) {
                return false;
            }
            //buscar los usuarios que pertenecen a la alianza (coordinadores)
            $usuarioAlianza = DB::table('alianza_user')
                        ->where('alianza_user.alianza_id',$alianza_id)
                        ->where('alianza_user.user_id',$user_id )
                        ->select('alianza_user.user_id')
                        ->first();

            //si hace parte regresar el rol del usuario
            if (!empty($usuarioAlianza)) {
                if (array_search('coordinador_externo', $rolesUsuario) !== false) {
                    return 'coordinador_externo';
                }else{
                    return 'coordinador_interno';
                }
            }else{
            //si no hacen parte de la creacion de la alianza entonces verificar que pertenezcan a la misma institucion y tengan el rol especifico para poder editar la alianza
                if (session('campusApp') == null) {
                    if ( isset($this->campusApp[0]) ) {
                        return false;
                    }elseif(count($this->campusApp)){
                        if (!$institucion = $this->campusApp->first()->institucion_id) {
                            return false;
                        }
                    }

                }else{
                    
                    $institucion = \App\Models\Admin\Campus::where('id',session('campusApp'))
                        ->select('institucion_id')
                        ->first();
                    if(empty($institucion)){
                        return false;
                    }else{
                        $institucion = $institucion->institucion_id;
                    }
                }
                
                if ($institucion != 0) {
                    $institucionAlianza = DB::table('alianza_institucion')
                        ->where('alianza_id',$alianza_id)
                        ->where('institucion_id',$institucion )
                        ->select('institucion_id')
                        ->first();

                    //si hace parte regresar el rol del usuario
                    if (!empty($institucionAlianza)) {
                        
                        if (array_search('coordinador_externo', $rolesUsuario) !== false) {
                            $retorno = 'coordinador_externo';
                        }elseif(array_search('coordinador_interno', $rolesUsuario) !== false){
                            $retorno = 'coordinador_interno';
                        }elseif(array_search('profesor', $rolesUsuario) !== false){
                            $retorno = 'profesor';
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

    public function get_format($df) {

        $str = '';
        $str .= ($df->invert == 1) ? ' - ' : '';
        if ($df->y > 0) {
            // years
            $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
        } 
        if ($df->m > 0) {
            // month
            $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
        } 
        if ($df->d > 0) {
            // days
            $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Día ';
        }else{
            $str .= ' 0 Días ';
        }
        // if ($df->h > 0) {
        //     // hours
        //     $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
        // } 
        // if ($df->i > 0) {
        //     // minutes
        //     $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
        // } 
        // if ($df->s > 0) {
        //     // seconds
        //     $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
        // }

        return $str;
    }

}
