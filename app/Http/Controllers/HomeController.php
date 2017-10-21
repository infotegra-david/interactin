<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $user;
    private $campusApp;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();
            //para compatibilidad con la version html
            
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

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.administrador')->with(['campusApp' => $this->campusApp]);
    }
}
