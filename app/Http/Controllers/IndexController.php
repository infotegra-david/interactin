<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function campusAppSelect(Request $request)
    {
        $user = Auth::user();

        $campusAppSelect = \App\Models\Admin\Campus::join('user_campus','campus.id','user_campus.campus_id')
                ->join('institucion','campus.institucion_id','institucion.id')
                ->where('user_campus.user_id',$user->id)
                ->where('user_campus.campus_id',$request['campusAppSelect'])
                ->select('campus.id','campus.nombre','institucion.nombre AS institucion_nombre')->first();
        if (count($campusAppSelect)) {
            session(['campusApp' => $campusAppSelect->id ]);
            session(['campusAppNombre' => $campusAppSelect->nombre ]);
            session(['institucionAppNombre' => $campusAppSelect->institucion_nombre]);
            
            return session('campusApp');
            
        }else{
            return Response::json(['error' => 'El campus asociado al usuario no fue encontrado'], 404);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
