<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Flash;
use DB;

class UserController extends \App\Http\Controllers\Controller
{
    use Authorizable;

    private $user;
    private $peticion;
    private $campusApp;
    private $campusAppId;
    private $campusAppFound;
    private $tipoRuta;
    private $ruta;
    private $metodo;
    private $listInstituciones;
    private $listUserCampus;
    private $listUserIdiomas;
    private $viewWith;

    public function __construct(Request $request){

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




        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();
        $this->campusAppId = 0;
        $this->tipoRuta = $name;
        $this->ruta = 'admin';
        if ( strpos($this->tipoRuta, 'admin.users') === false) {
            $this->ruta = 'user';
        }
        $this->metodo = substr($this->tipoRuta, strrpos($name, ".")+1);

        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listInstituciones()
    {
        if ($this->ruta == 'admin') {
            $this->listInstituciones = \App\Models\Admin\Institucion::join('campus','institucion.id','campus.institucion_id')
            ->groupBy('institucion.id')->pluck('institucion.nombre','institucion.id');
        }else{
            $this->listInstituciones = '';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listUserCampus($id)
    {
        if ($this->ruta == 'admin') {
            
            $userCampus = \App\Models\Admin\Institucion::join('campus','institucion.id','campus.institucion_id')
                ->join('user_campus','campus.id','user_campus.campus_id')
                ->where('user_campus.user_id',$id)->select('user_campus.id','user_campus.id AS user_campus_id','institucion.nombre AS institucion','institucion.id AS institucion_id','campus.id AS campus_id','campus.nombre AS campus')
                ->get()->toArray();


            $this->listUserCampus = $userCampus;

            if ($this->peticion == "ajax") {
                return json_encode($this->listUserCampus);
            }

        }else{
            $this->listUserCampus = '';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listUserIdiomas($id)
    {
        if ($this->ruta == 'admin') {
            
            $userIdiomas = \App\Models\Admin\UserIdiomas::join('tipo_idioma','user_idiomas.tipo_idioma_id','tipo_idioma.id')
                ->join('nivel','user_idiomas.nivel_id','nivel.id')
                ->where('user_idiomas.user_id',$id)->select('user_idiomas.id', 'user_idiomas.user_id', 'tipo_idioma.nombre AS tipo_idioma_id', DB::raw('case user_idiomas.certificado when false then "NO" when true then "SI" end as certificado'), 'user_idiomas.nombre_examen', 'nivel.nombre AS nivel_id')
                ->get()->toArray();

            $this->listUserIdiomas = $userIdiomas;

            if ($this->peticion == "ajax") {
                return json_encode($this->listUserIdiomas);
            }

        }else{
            $this->listUserIdiomas = '';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verificarCampusApp()
    {
        // print_r(session('campusApp'));
        $route = 'user.index';
        if ($this->ruta == 'admin') {
            $route = 'admin.users.index';
        }
        if( session('campusApp') != null ){
            $campusAppId = session('campusApp');
            $campusApp = \App\Models\Admin\Campus::find($campusAppId);
            if( !count($campusApp) ){
                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                return redirect(route($route));
            }
            $this->campusAppId = $campusApp->id;
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route($route));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$result = User::latest()->paginate();
        $result = User::paginate();
        $usersArray = $result->toArray();
        $usersRoles = \App\Models\Admin\Role::join('model_has_roles','roles.id','model_has_roles.role_id')
            ->whereIn('model_has_roles.model_id',array_column($usersArray['data'], 'id'))
            ->select('model_has_roles.model_id','roles.name')
            ->get();
        foreach ($result as $key => $value) {
            $arrayRoles = array();
            foreach ($usersRoles as $keyusersRoles => $valueusersRoles) {
                if ($value->id == $valueusersRoles->model_id) {
                    $arrayRoles[] = ['model_id' => $valueusersRoles->model_id, 'name' => $valueusersRoles->name];
                }
            }
            $value->listRoles = $arrayRoles;
        }

        $this->viewWith = array_merge($this->viewWith,['result' => $result, 'ruta' => $this->ruta, 'metodo' => $this->metodo]);

        return view('admin.user.index')
            ->with($this->viewWith);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->listInstituciones();
        $roles = '';
        $ruta = $this->ruta;
        $metodo = $this->metodo;
        $institucion = $this->listInstituciones;
        $campus = array();

        if ($ruta == 'admin') {
            $roles = Role::pluck('name', 'id');
        }

        $this->viewWith = array_merge($this->viewWith,['roles' => $roles, 'ruta' => $ruta, 'metodo' => $metodo, 'institucion' => $institucion, 'campus' => $campus]);

        return view('admin.user.create')
            ->with($this->viewWith);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editCampus($user_id, Request $request)
    {
        // $retorno = ['id' => 2];
        // return response()->json($retorno);
         // return $request->all();

        if (isset($request['metodo']) && $request['metodo'] == 'create') {
            if (isset($request['campus']) && $request['campus'] == 0) {
                return response()->json('Seleccione un campus', 422);
            }
            return json_encode($request->all());
        }

        if (isset($request['id'], $request['oper']) && $request['oper'] == 'del' &&  strpos($request['id'], 'jqg') !== false && $user_id == 0 ) {
            return 1;
        }

        $retorno = false;
        $user = User::find($user_id);

        if (empty($user)) {
            return response()->json('No se encontro al usuario.', 422);
        }

        if (isset($request['id'], $request['oper'])) {

            if($request['oper'] == 'add' || $request['oper'] == 'edit' ) {
                if (isset($request['campus']) && $request['campus'] != 0) {
                    if ($request['oper'] == 'edit') {

                        $campus = DB::table('user_campus')->where('id',$request['id'])
                            ->update(['user_id' => $user->id,'campus_id' => $request['campus'] ]);

                        return $campus;

                    }else{

                        $campus = \App\Models\Admin\Campus::find($request['campus']);

                        if (empty($campus)) {
                            return response()->json('No se encontro el campus.', 422);
                        }


                        // $idSync = DB::table('user_campus')->insertGetId(
                        //     ['user_id' => $user->id,'campus_id' => $campus->id]
                        // );

                        $idSync = \App\Models\Admin\UserCampus::updateOrCreate(
                            ['user_id' => $user->id,'campus_id' => $campus->id]
                        );
                        
                        // $idSync = $user->campus()->syncWithoutDetaching($campus);
                        
                        return ['id' => $idSync->id];
                    }

                }else{
                    return response()->json('Seleccione un campus', 422);
                }
            }elseif ($request['oper'] == 'del') {
                // $ids = explode(',', $request['id']);
                $numCampusUser = $user->campus()->count();
                if ($numCampusUser == 1) {
                    // return response()->json(['error' => 'El usuario debe tener asociado al menos un campus'],490);
                    return response()->json(["Record Not Found!",false]);
                }

                // $eliminar = $user->campus()->detach([$request['id']]);
                $eliminar = \App\Models\Admin\UserCampus::whereIn('id',[$request['id']])->forceDelete();

                return $eliminar;
            }else{
                return response()->json('Seleccione un campus', 422);
            }

            
        }else{
            return response()->json('Seleccione un campus', 422);
        }

        return $retorno;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editUserIdiomas($user_id, Request $request)
    {
        // $retorno = ['id' => 2];
        // return response()->json($retorno);
         // return $request->all();



        if (isset($request['metodo']) && $request['metodo'] == 'create') {
            if (isset($request['tipo_idioma_id']) && $request['tipo_idioma_id'] == '') {
                return response()->json(['Seleccione un tipo de idioma'], 422);
            }
            return json_encode($request->all());
        }

        if (isset($request['id'], $request['oper']) && $request['oper'] == 'del' &&  strpos($request['id'], 'jqg') !== false && $user_id == 0 ) {
            return 1;
        }

        $retorno = false;
        $user = User::find($user_id);

        if (empty($user)) {
            return response()->json(['No se encontro al usuario.'], 422);
        }


        if (isset($request['id'], $request['oper'])) {

            if($request['oper'] == 'add' || $request['oper'] == 'edit' ) {

                $reglas = [
                    'user_id' => 'required',
                    'tipo_idioma_id' => 'required',
                    'nombre_examen' => 'required',
                    'nivel_id' => 'required',
                    'certificado' => 'required',
                ];

                $this->validate($request, $reglas);

                if (isset($request['certificado']) && in_array($request['certificado'], ['SI','NO'])) {
                    $request['certificado'] = ($request['certificado'] == 'SI' ? 1 : 0 );
                    
                }else{
                    return response()->json(['Seleccione si tiene certificado.'], 422);
                }

                if (isset($request['tipo_idioma_id']) && $request['tipo_idioma_id'] != 0) {
                    if ($request['oper'] == 'edit') {

                        $user_idiomas = DB::table('user_idiomas')->where('id',$request['id'])
                            ->update(['user_id' => $user->id,'tipo_idioma_id' => $request['tipo_idioma_id'],'nombre_examen' => $request['nombre_examen'],'nivel_id' => $request['nivel_id'],'certificado' => $request['certificado'] ]);

                        return $user_idiomas;

                    }else{

                        $tipo_idioma = \App\Models\Admin\TipoIdioma::find($request['tipo_idioma_id']);

                        if (empty($tipo_idioma)) {
                            return response()->json(['No se encontro el tipo de idioma.'], 422);
                        }


                        // $idSync = DB::table('user_campus')->insertGetId(
                        //     ['user_id' => $user->id,'campus_id' => $campus->id]
                        // );

                        $idSync = \App\Models\Admin\UserIdiomas::updateOrCreate(
                            ['user_id' => $user->id,'tipo_idioma_id' => $request['tipo_idioma_id'],'nombre_examen' => $request['nombre_examen'],'nivel_id' => $request['nivel_id'],'certificado' => $request['certificado']
                            ]
                        );
                        
                        // $idSync = $user->campus()->syncWithoutDetaching($campus);
                        
                        return ['id' => $idSync->id];
                    }

                }else{
                    return response()->json(['Seleccione un tipo de idioma'], 422);
                }
            }elseif ($request['oper'] == 'del') {
                // $ids = explode(',', $request['id']);

                // $eliminar = $user->campus()->detach([$request['id']]);
                $eliminar = \App\Models\Admin\UserIdiomas::whereIn('id',[$request['id']])->forceDelete();

                return $eliminar;
            }else{
                return response()->json(['Seleccione un idioma'], 422);
            }

            
        }else{
            return response()->json(['Seleccione un idioma'], 422);
        }

        return $retorno;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        DB::beginTransaction();
        $msg = 'El usuario fue creado correctamente';

        $this->verificarCampusApp();
        $route = 'user.index';

        $rules = [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1',
            'campus_asignados' => 'required',
        ];

        $this->validate($request, $rules);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // Create the user
        if ( $user = User::create($request->except('roles', 'permissions')) ) {
            if ($this->ruta == 'admin') {
                $this->syncPermissions($request, $user);
                $request['campus_asignados'] = json_decode($request['campus_asignados'],true);
                $campus = \App\Models\Admin\Campus::find(array_column($request['campus_asignados'], 'campus_id'));
            }else{
                $campus = $this->campusAppId;
            }
            $user->campus()->syncWithoutDetaching($campus);
            flash($msg);

        } else {
            
            DB::rollBack();

            if ($this->peticion == "ajax") {
                return response()->json('No se pudo crear el usuario', 422);
            }else{
                flash()->error('No se pudo crear el usuario.');
            }
        }

        if ($this->ruta == 'admin') {
            $route = 'admin.users.index';
        }
        
        DB::commit();

        if ($this->peticion == "ajax") {
            return response()->json([$msg, '<input type="hidden" class="" name="redirect_url" id="redirect_url" value="'.route($route).'">']);
        }else{
            return redirect()->route($route);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $ruta = $this->ruta;
        $metodo = $this->metodo;

        $this->viewWith = array_merge($this->viewWith,['user' => $user, 'ruta' => $ruta, 'metodo' => $metodo]);

        return view('admin.user.show')
            ->with($this->viewWith);
        //return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $viewWith = $this->viewWith;
        $route = ( ($this->ruta == 'admin') ? 'admin.users.index' : 'user.index' );
        $user = User::find($id);

        if (empty($user)) {
            flash()->error('No se encontro al usuario.');
            return redirect()->route($route);
        }

        $this->listInstituciones();
        $this->listUserCampus($id);

        if ($this->ruta == 'admin') {

            $roles = Role::pluck('name', 'id');
            $permissions = Permission::all('name', 'id');

            $this->userCampus = $user->campus;
            $campus = $this->userCampus->pluck('nombre','id');

            
            $viewWith = array_merge($viewWith,['roles'=>$roles,'permissions'=>$permissions, 'listUserCampus' => $this->listUserCampus, 'institucion' => $this->listInstituciones, 'campus' => [] ]);
        }

        $viewWith = array_merge($viewWith,['user'=>$user, 'ruta' => $this->ruta, 'metodo' => $this->metodo]);

        return view('admin.user.edit')->with($viewWith);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->verificarCampusApp();
        $route = 'user.index';
        $reglas = [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            ];

        if ($this->ruta == 'admin') {
            $route = 'admin.users.index';
            $reglas = array_merge($reglas, [
                'roles' => 'required|min:1'
            ] );
        }

        $this->validate($request, $reglas);

        // Get the user
        $user = User::findOrFail($id);

        $campusAsignados = \App\Models\Admin\UserCampus::where('user_id',$user->id)->count();

        if (!$campusAsignados > 0) {
            $reglas = [
                'campus_asignados' => 'required',
                ];

            $this->validate($request, $reglas);
        }

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        if ($this->ruta == 'admin') {
            // Handle the user roles
            $this->syncPermissions($request, $user);
            // $campus = \App\Models\Admin\Campus::find($request['campus']);
        }else{
            // $campus = $this->campusAppId;
        }

        // $user->campus()->syncWithoutDetaching($campus);

        $user->save();

        flash()->success('User has been updated.');

        return redirect()->route($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function destroy($id)
    {
        if ( Auth::user()->id == $id ) {
            flash()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if( User::findOrFail($id)->delete() ) {
            flash()->success('User has been deleted');
        } else {
            flash()->success('User not deleted');
        }

        return redirect()->back();
    }

    /**
     * Sync roles and permissions
     *
     * @param Request $request
     * @param $user
     * @return string
     */
    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }
}
