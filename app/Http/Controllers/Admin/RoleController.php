<?php

namespace App\Http\Controllers\Admin;

use App\Authorizable;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use DB;

class RoleController extends \App\Http\Controllers\Controller
{
    use Authorizable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        // $roles = Role::all();
        //lista de todos los permisos
        $permissions = Permission::all();
        
        //lista de todos los roles y sus respectivos permisos
        $roles = Role::join('role_has_permissions','roles.id','role_has_permissions.role_id')
            ->leftJoin('permissions','role_has_permissions.permission_id','permissions.id')
            ->select('roles.id','roles.name','permissions.id AS permissions_id','permissions.name AS permissions_name');
        $roles = $roles->get()->toArray();

        //lista de los permisos que tenga el usario (por ahora no es necesario)
            // $model_has_permissions = DB::table('model_has_permissions')->where('model_id',$user->id)->get()->toArray();

        // print_r($roles_permisos[0]);
        // echo "<br>";
        // print_r($roles_permisos[1]);
        // echo "<br>";
        // print_r($roles_permisos[2]);


        return view('admin.role.index', compact('roles', 'permissions', 'model_has_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if( Role::create($request->only('name')) ) {
            flash('Role Added');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.role.index');
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
        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('admin.roles.index');
            }

            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);

            flash( $role->name . ' permissions has been updated.');
        } else {
            flash()->error( 'Role with id '. $id .' note found.');
        }

        return redirect()->route('admin.roles.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        
    }
}
