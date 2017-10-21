<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Flash;

class UserController extends \App\Http\Controllers\Controller
{
    use Authorizable;

    private $user;
    private $campusApp;
    private $campusAppId;
    private $tipoRuta;
    private $ruta;
    private $listInstituciones;

    public function __construct(){

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



        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();
        $this->campusAppId = 0;
        $this->tipoRuta = $name;
        $this->ruta = 'admin';
        if ( strpos($this->tipoRuta, 'admin.users') === false) {
            $this->ruta = 'user';
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
    public function verificarCampusApp()
    {
        print_r(session('campusApp'));
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

        return view('admin.user.index',['result' => $result, 'ruta' => $this->ruta]);
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
        $institucion = $this->listInstituciones;
        $campus = array();
        if ($ruta == 'admin') {
            $roles = Role::pluck('name', 'id');
        }

        return view('admin.user.create', compact('roles','ruta','institucion','campus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->verificarCampusApp();
        $route = 'user.index';

        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1',
            'campus' => 'required|min:1'
        ]);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // Create the user
        if ( $user = User::create($request->except('roles', 'permissions')) ) {
            if ($this->ruta == 'admin') {
                $this->syncPermissions($request, $user);
                $campus = \App\Models\Admin\Campus::find($request['campus']);
            }else{
                $campus = $this->campusAppId;
            }
            $user->campus()->syncWithoutDetaching($campus);
            flash('User has been created.');

        } else {
            flash()->error('Unable to create user.');
        }

        if ($this->ruta == 'admin') {
            $route = 'admin.users.index';
        }
        return redirect()->route($route);
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
        return view('admin.user.show', compact('user','ruta'));
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
        $this->listInstituciones();
        $user = User::find($id);
        $viewWith = ['user'=>$user];
        if ($this->ruta == 'admin') {
            $roles = Role::pluck('name', 'id');
            $permissions = Permission::all('name', 'id');
            $viewWith = array_merge($viewWith,['roles'=>$roles,'permissions'=>$permissions, 'ruta' => $this->ruta, 'institucion' => $this->listInstituciones, 'campus' => array()]);
        }

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
                'roles' => 'required|min:1',
                'campus' => 'required|min:1'
            ] );
        }

        $this->validate($request, $reglas);

        // Get the user
        $user = User::findOrFail($id);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        if ($this->ruta == 'admin') {
            // Handle the user roles
            $this->syncPermissions($request, $user);
            $campus = \App\Models\Admin\Campus::find($request['campus']);
        }else{
            $campus = $this->campusAppId;
        }
        $user->campus()->syncWithoutDetaching($campus);

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
