<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreateUserPasoRequest;
use App\Http\Requests\Validation\UpdateUserPasoRequest;
use App\Repositories\Validation\UserPasoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use DB;
use App\Models\Validation\UserPaso;
use App\Models\Admin\Role;


class UserPasoController extends AppBaseController
{
    use Authorizable;
    /** @var  UserPasoRepository */
    private $user;
    private $userPasoRepository;
    private $userPaso;
    private $campusApp;
    private $campusAppFound;
    private $campusUser;
    private $tipos_pasos;
    private $validadores;
    private $roleValidador;
    private $tipoRuta;
    private $route_split;
    private $routeLists;
    private $proceso;
    private $peticion;
    private $viewWith = [];


    public function __construct(UserPasoRepository $userPasoRepo, UserPaso $userPasoModel, Request $request)
    {
        /*$this->middleware(function ($request, $next) {
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
        });*/

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
            }else{
                $this->campusApp = [0 => 'No pertenece a alguna institución.'];
            }

            if( session('campusApp') != null && session('campusApp') != 0 ){
                $campusAppId = session('campusApp') ?? 0;

                // if ( Auth::user() !== NULL) {
                    $this->campusAppFound = \App\Models\Admin\Campus::find($campusAppId);
                    if( !count($this->campusAppFound) ){
                        Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                        return redirect(route('home'));
                    }
                // }
            }else{
                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');
                // $campusAppId = session('campusApp');
                // return redirect(route('home'));
            }
            
            $this->viewWith = array_merge($this->viewWith,['campusApp' => $this->campusApp]);

            return $next($request);
        });

        $this->userPasoRepository = $userPasoRepo;
        $this->userPaso = $userPasoModel;


        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();
        if (!empty($name) ) {
            $this->tipoRuta = $name;
            $this->route_split = substr($name, 0,strrpos($name, "."));
            $this->proceso = substr($name, 0,strpos($name, "."));
            $this->routeLists = route($this->proceso.'.assignments_'.$this->proceso.'.lists');
        }

        if (empty($this->campusUser)) {
            $this->user = Auth::user();
            print_r($this->user);
            if (isset($this->user->campus)) {
                $this->campusUser = $this->user->campus;
            }else{
                $this->campusUser = \App\Models\Admin\Campus::where('institucion_id',\Config::get('options.institucion_id'));
            }
        }

        $this->tipos_pasos = \App\Models\TipoPaso::select( DB::raw("concat('#',replace(substr(nombre,instr(nombre,'paso')+4,2),'_',''),' - ',titulo) AS nombre"),'id');

        switch ($this->proceso) {
            case 'interalliances':
                $this->tipos_pasos = $this->tipos_pasos->where('nombre','like','%_interalliance');
                break;
            case 'interchanges':
                $this->tipos_pasos = $this->tipos_pasos->where('nombre','like','%_interchange');
                break;
            case 'interactions':
                $this->tipos_pasos = $this->tipos_pasos->where('nombre','like','%_interaction');
                break;
        }

        $this->roleValidador = Role::where('name','validador')->pluck('id');

        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        $this->viewWith = array_merge($this->viewWith,['route_split' => $this->route_split, 'routeData' => $this->tipoRuta, 'routeLists' => $this->routeLists]);
    }

    /**
     * Display a listing of the UserPaso.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $viewWith = $this->viewWith;
        $userPasos = [];
        $tipo_paso_default = 1;

        if ($this->peticion != "ajax") {
            goto end;
        }
        $usersCopiaEmails = DB::table('model_has_roles')->join('roles','model_has_roles.role_id','roles.id')
            ->where('roles.name','copia_oculta_email')
            ->pluck('model_has_roles.model_id');

        $tipo_paso_id = "concat('#',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso_id";
        if ($this->proceso == 'interalliances') {
            $tipo_paso_id = "tipo_paso.id AS tipo_paso_id";
        }

        $userPasos = $this->userPaso->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
                ->join('campus', 'user_tipo_paso.campus_id', '=', 'campus.id')
                ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->orderBy('user_tipo_paso.campus_id', 'asc')
                ->orderBy('user_tipo_paso.tipo_paso_id', 'asc')
                ->orderBy('user_tipo_paso.orden', 'asc')
                ->orderBy('user_tipo_paso.id', 'asc')
                ->whereNotIn('user_tipo_paso.user_id',$usersCopiaEmails)
                ->where('user_tipo_paso.campus_id',$this->campusAppFound->id)
                ->select('user_tipo_paso.id', 'user_tipo_paso.orden', 'user_tipo_paso.titulo', 'campus.nombre AS campus_id', DB::raw("concat(users.name,' (',users.email,')' ) AS user_id"), DB::raw($tipo_paso_id), 'user_tipo_paso.id as accion');
        
        switch ($this->proceso) {
            case 'interalliances':
                $userPasos = $userPasos->where('tipo_paso.nombre','like','%_interalliance');
                break;
            case 'interchanges':
                $userPasos = $userPasos->where('tipo_paso.nombre','like','%_interchange');
                break;
            case 'interactions':
                $userPasos = $userPasos->where('tipo_paso.nombre','like','%_interaction');
                break;
        }

        $userPasos = $userPasos->get();

        if ($this->peticion == "ajax") {
            return json_encode($userPasos);
        }

        end:

        if($this->proceso == 'interalliances') {
            $tipo_paso_default = 6;
            $viewWith = array_merge($viewWith, ['omitir_tipo_paso' => true]);
        }

        $orden = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15];
        $orden = ['' => 'Seleccione el orden de validación'];
                // ->select('user_tipo_paso.*', DB::raw("concat(users.name,' (',users.email,')' ) AS user"), DB::raw("concat(UPPER(SUBSTRING_INDEX(tipo_paso.nombre, '_', -1)),' - ',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso"))
        $viewWith = array_merge($viewWith, ['userPasos' => $userPasos, 'campus' => $this->campusUser->pluck('nombre','id'), 'user' => ['' => 'Seleccione al validador'], 'tipo_paso' => $this->tipos_pasos->pluck('nombre','id'), 'tipo_paso_default' => $tipo_paso_default, 'orden' => $orden]);
        return view('validation.assign.index')
            ->with($viewWith);
    }

    /**
     * Show the form for creating a new UserPaso.
     *
     * @return Response
     */
    public function create()
    {
        //echo $this->validadores->toSql().'this->roleValidador:'.$this->roleValidador.' session(campusApp): '.session('campusApp');
        $orden = ['' => 'Seleccione el orden de validación'];

        $this->viewWith = array_merge($this->viewWith, ['campus' => $this->campusUser->pluck('nombre','id'), 'user' => ['' => 'Seleccione primero un campus'], 'tipo_paso' => $this->tipos_pasos->pluck('nombre','id'), 'orden' => $orden]);
        
        return view('validation.assign.create')
        ->with($this->viewWith);
    }

    /**
     * Store a newly created UserPaso in storage.
     *
     * @param CreateUserPasoRequest $request
     *
     * @return Response
     */
    // public function storeUpdate(CreateUserPasoRequest $request)
    public function storeUpdate(Request $request)
    {
        
        if (isset($request['id'], $request['oper'])) {

            if($request['oper'] == 'add' || $request['oper'] == 'edit' ) {
                
                $this->validate($request, $this->userPaso::$rules);

                $registrosDelPaso = $this->userPaso->where([['campus_id',$request['campus_id']],['tipo_paso_id',$request['tipo_paso_id']]])
                    ->orderBy('orden','asc')
                    ->get()->toArray();

                //validar el orden
                $ordenMaximo = $this->userPaso->where([['campus_id',$request['campus_id']],['tipo_paso_id',$request['tipo_paso_id']]])
                    ->max('orden');
                
                $ordenMaximo += 1;

                if ($ordenMaximo < $request['orden']) {
                    return response()->json(['error' => 'El orden no puede ser mayor a '.$ordenMaximo], 200);
                }

                //validar si esta duplicado
                $existenDuplicados = $this->userPaso->where('id','<>',$request['id'])
                    ->where([['campus_id',$request['campus_id']],['tipo_paso_id',$request['tipo_paso_id']],['orden', $request['orden']]])
                    ->pluck('id');

                if (count($existenDuplicados) >= 1) {
                    return response()->json(['error' => 'Existe otro registro con el mismo orden'], 200);
                }
                //si estan editando el registro
                if ($request['oper'] == 'edit') {

                        
                    $userPaso = $this->userPasoRepository->findWithoutFail($request['id']);

                    if (empty($userPaso)) {
                        Flash::error('Asignación no encontrada');

                        return redirect(route($this->route_split.'.index'));
                    }

                    $userPaso = $this->userPasoRepository->update($request->all(), $request['id']);

                    return $userPaso;
                //si es un registro nuevo
                }else{


                    $idSync = $this->userPaso::create($request->all());
                    
                    // $idSync = $user->campus()->syncWithoutDetaching($campus);
                    
                    return ['id' => $idSync->id];
                }
            }elseif ($request['oper'] == 'del') {

                $this->validate($request, ['id' => 'required']);

                $maxPasoAsignaciones = $this->userPaso->join('tipo_paso','user_tipo_paso.tipo_paso_id','tipo_paso.id');

                switch ($this->proceso) {
                    case 'interalliances':
                        $maxPasoAsignaciones = $maxPasoAsignaciones->where('tipo_paso.nombre','like','%_interalliance');
                        break;
                    case 'interchanges':
                        $maxPasoAsignaciones = $maxPasoAsignaciones->where('tipo_paso.nombre','like','%_interchange');
                        break;
                    case 'interactions':
                        $maxPasoAsignaciones = $maxPasoAsignaciones->where('tipo_paso.nombre','like','%_interaction');
                        break;
                }

                $maxPasoAsignaciones = $maxPasoAsignaciones->max('user_tipo_paso.tipo_paso_id');

                $asignacionActual = $this->userPaso->find($request['id']);

                if (!count($asignacionActual) ) {
                    return response()->json(['error' => 'No se encuentra al validador actual'], 200);
                }

                if ($asignacionActual->tipo_paso_id == $maxPasoAsignaciones) {
                    //validar si existe quien genere el documento
                    $validadoresAsignados = $this->userPaso->join('model_has_roles','user_tipo_paso.user_id','model_has_roles.model_id')
                        ->where('id','<>',$request['id'])
                        ->where([['campus_id',$asignacionActual->campus_id],['tipo_paso_id',$asignacionActual->tipo_paso_id]])
                        ->select('user_tipo_paso.*','model_has_roles.role_id')
                        ->get()->toArray();

                    $ordenMayor = max(array_column($validadoresAsignados, 'orden'));
                    $roleGenerarDocumento = Role::where('name','generar_documento')->pluck('id')->first();

                    $existeGenerarDocumento = array_filter($validadoresAsignados, function($var) use($ordenMayor,$roleGenerarDocumento){
                        // Retorna siempre que el número entero sea par
                        return ($var['orden'] == $ordenMayor || $var['role_id'] == $roleGenerarDocumento);
                    });

                    if (!count($existeGenerarDocumento) ) {
                        return response()->json(['error' => 'No hay mas validadores que puedan generar el documento final, asigne primero uno que tenga el rol: generar_documento'], 200);
                    }
                }

                
                $eliminar = $this->userPaso->whereIn('id',[$request['id']])->forceDelete();
                // $eliminar = $this->userPaso->whereIn('id',[$request['id']])->delete();

                return $eliminar;
            }else{
                return response()->json('Seleccione un registro', 422);
            }

            
        }else{
            return response()->json('Seleccione un registro', 422);
        }











        return response()->json(['error' => 'no se puede actualizar'], 200);
        return response()->json(['success' => 'si se puede actualizar'], 200);
        $assignments = json_decode($request['assignments']);
        foreach ($assignments as $key => $value) {
            
        }
        print_r($assignments);
        return response()->json('Error calculado', 422);

        $userPaso = $this->userPasoRepository->create($input);

        Flash::success('Asignación guardada correctamente.');

        return redirect(route($this->route_split.'.index'));
    }

    /**
     * Store a newly created UserPaso in storage.
     *
     * @param CreateUserPasoRequest $request
     *
     * @return Response
     */
    public function store(CreateUserPasoRequest $request)
    {
        $input = $request->all();

        $userPaso = $this->userPasoRepository->create($input);

        Flash::success('Asignación guardada correctamente.');

        return redirect(route($this->route_split.'.index'));
    }

    /**
     * Display the specified UserPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userPaso = $this->userPaso->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
                ->join('campus', 'user_tipo_paso.campus_id', '=', 'campus.id')
                ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->where('user_tipo_paso.id', $id)
                ->select('user_tipo_paso.*', 'campus.nombre AS campus_nombre', DB::raw("concat(users.name,' (',users.email,')' ) AS user"), DB::raw("concat('#',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso"))
                ->first();
        //print_r($userPaso);

        if (empty($userPaso)) {
            Flash::error('Asignación no encontrada');

            return redirect(route($this->route_split.'.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['userPaso' => $userPaso]);

        return view('validation.assign.show')->with($this->viewWith);
    }

    /**
     * Show the form for editing the specified UserPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('Asignación no encontrada');

            return redirect(route($this->route_split.'.index'));
        }

        $this->validadores = \App\User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                    ->where('model_has_roles.role_id',$this->roleValidador )
                    ->where('user_campus.campus_id',$userPaso->campus_id )
                    ->select(DB::raw("concat(users.name,' (',users.email,')' ) AS name"),'users.id');

        $this->viewWith = array_merge($this->viewWith,['userPaso' => $userPaso, 'campus' => $this->campusUser->pluck('nombre','id'), 'tipo_paso' => $this->tipos_pasos->pluck('nombre','id'), 'user' => $this->validadores->pluck('name','id')]);

        return view('validation.assign.edit')->with($this->viewWith);

    }

    /**
     * Update the specified UserPaso in storage.
     *
     * @param  int              $id
     * @param UpdateUserPasoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserPasoRequest $request)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('Asignación no encontrada');

            return redirect(route($this->route_split.'.index'));
        }

        $userPaso = $this->userPasoRepository->update($request->all(), $id);

        Flash::success('Asignación actualizada correctamente.');

        return redirect(route($this->route_split.'.index'));
    }

    /**
     * Remove the specified UserPaso from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('Asignación no encontrada');

            return redirect(route($this->route_split.'.index'));
        }

        $this->userPasoRepository->delete($id);

        Flash::success('Asignación eliminada correctamente.');

        return redirect(route($this->route_split.'.index'));
    }


    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function lists(Request $request)
    {
        // print_r($request->all());
        if (isset($request['type'])) {
            switch ($request['type']) {
                case 'validador':
                    $this->validadores = \App\User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                        ->where('model_has_roles.role_id',$this->roleValidador )
                        ->where('user_campus.campus_id',$request['id'] )
                        ->select(DB::raw("concat(users.name,' (',users.email,')' ) AS name"),'users.id')
                        ->orderBy('users.name','asc');

                    return $this->validadores->pluck('name','id');

                    break;
                case 'orden':
                    $campus_id = (isset($request['campus_id']) ? $request['campus_id'] : $request['val_extra'] );
                    $ordenMaximo = $this->userPaso->where([['campus_id',$campus_id],['tipo_paso_id',$request['id']]]);
                    
                    $ordenMaximo = $ordenMaximo->max('orden');
                    // echo '|'.$ordenMaximo.'|';

                    $orden = [];
                    $i = 1;
                    do {
                        $orden[$i] = $i;
                        $i += 1;
                    } while ($i <= intval( $ordenMaximo ) );

                    if (intval( $ordenMaximo ) >= 1) {
                        $orden[intval( $ordenMaximo )+1] = intval( $ordenMaximo )+1;
                    }

                    return $orden;

                    break;
                
                default:
                    return 0;
                    break;
            }
        }
    }
}
