<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagina($pagina = '')
    {
        if ($pagina == '') {
            $pagina == 'index1.php';
        }
        //$pagina = '\\'.$pagina;
        $existePagina = Storage::disk('local')->exists('public/html/'.$pagina);
        /*
        echo '<br> |'.storage_path('app\public\html').$pagina.'|';
        $pathFile = str_replace('/', '\\', Storage::disk('local')->url('public\html\\'.$pagina));
        echo '<br> |'.$pathFile.'|';
        */
        if ($existePagina) {
            return response()->download(storage_path('app\public\html\\').$pagina, null, [], null);
            //return response()->file(storage_path('app\public\html').$pagina);
            //return response()->download(public_path(Storage::disk('local')->url('public/html/'.$pagina)));
            //return Storage::disk('local')->get('public/html/'.$pagina);
        }else{
            return \View::make('errors.404');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
