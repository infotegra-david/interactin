<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateCampusRequest;
use App\Http\Requests\Admin\UpdateCampusRequest;
use App\Repositories\Admin\CampusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Auth;

class CampusController extends AppBaseController
{
    /** @var  CampusRepository */
    private $campusRepository;
    private $user;
    private $campusApp;
    private $campusAppFound;
    private $campus = array();
    private $viewWith = [];

    public function __construct(CampusRepository $campusRepo)
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

        $this->campusRepository = $campusRepo;

    }

    /**
     * Display a listing of the Campus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $Campuses = \App\Models\Admin\Campus::all()->toArray();
        $Institucion = \App\Models\Admin\Institucion::whereIn('id',array_column($Campuses, 'institucion_id'))->get()->toArray();
        $Ciudad = \App\Models\Admin\City::whereIn('id',array_column($Campuses, 'ciudad_id'))->get()->toArray();
        foreach ($Campuses as $key1 => $Campus) {
            foreach ($Institucion as $key2 => $nombre) {
                if ($Campus['institucion_id'] == $nombre['id']) {
                    $Campuses[$key1]['institucion'] = $nombre;
                }
            }
            foreach ($Ciudad as $key2 => $nombreC) {
                if ($Campus['ciudad_id'] == $nombreC['id']) {
                    $Campuses[$key1]['ciudad'] = $nombreC;
                }
            }
        }
        $this->viewWith = array_merge($this->viewWith,['campuses' => $Campuses]);
        return view('admin.campus.index')
            ->with($this->viewWith);
      /*  $this->campusRepository->pushCriteria(new RequestCriteria($request));
        $campuses = $this->campusRepository->all();

        $this->viewWith = array_merge($this->viewWith,['campuses' => $campuses]);

        return view('admin.campus.index')
            ->with($this->viewWith); */
    }

    /**
     * Show the form for creating a new Campus.
     *
     * @return Response
     */
    public function create()
    {
        $ciudad = \App\Models\Admin\City::pluck('nombre','id');
        $institucion = \App\Models\Admin\Institucion::pluck('nombre','id');
        $this->viewWith = array_merge($this->viewWith,['institucion' => $institucion, 'ciudad' => $ciudad]);
        return view('admin.campus.create')
            ->with($this->viewWith);
    }

    /**
     * Store a newly created Campus in storage.
     *
     * @param CreateCampusRequest $request
     *
     * @return Response
     */
    public function store(CreateCampusRequest $request)
    {
        $input = $request->all();
        if(isset($input['principal'])){
            \App\Models\Admin\Campus::where('institucion_id', $input['institucion_id'])->update(array('principal' => 0));
        }
        $campus = $this->campusRepository->create($input);     
        Flash::success('Campus saved successfully.');

        return redirect(route('admin.campus.index'));
    }

    /**
     * Display the specified Campus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $campus = $this->campusRepository->findWithoutFail($id);

        if (empty($campus)) {
            Flash::error('Campus not found');

            return redirect(route('admin.campus.index'));
        }
        $ciudad = \App\Models\Admin\City::find($campus['ciudad_id']);
        $institucion = \App\Models\Admin\Institucion::find($campus['institucion_id']);
        $this->viewWith = array_merge($this->viewWith,['campus' => $campus, 'institucion' => $institucion, 'ciudad' => $ciudad]);
        // $this->viewWith = array_merge($this->viewWith,['campus' => $campus]);

        return view('admin.campus.show')->with($this->viewWith);
    }

    /**
     * Show the form for editing the specified Campus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $campus = $this->campusRepository->findWithoutFail($id);

        if (empty($campus)) {
            Flash::error('Campus not found');

            return redirect(route('admin.campus.index'));
        }
        $ciudad = \App\Models\Admin\City::pluck('nombre','id');
        $institucion = \App\Models\Admin\Institucion::pluck('nombre','id');
        $this->viewWith = array_merge($this->viewWith,['campus' => $campus, 'institucion' => $institucion, 'ciudad' => $ciudad]);
        return view('admin.campus.edit')->with($this->viewWith);
    }

    /**
     * Update the specified Campus in storage.
     *
     * @param  int              $id
     * @param UpdateCampusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampusRequest $request)
    {
        $campus = $this->campusRepository->findWithoutFail($id);

        if (empty($campus)) {
            Flash::error('Campus not found');

            return redirect(route('admin.campus.index'));
        }
        $input = $request->all();
        if(isset($input['principal'])){
            \App\Models\Admin\Campus::where('institucion_id', $input['institucion_id'])->update(array('principal' => 0));
        }
        $campus = $this->campusRepository->update($input, $id);
        Flash::success('Campus updated successfully.');

        return redirect(route('admin.campus.index'));
    }

    /**
     * Remove the specified Campus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $campus = $this->campusRepository->findWithoutFail($id);

        if (empty($campus)) {
            Flash::error('Campus not found');

            return redirect(route('admin.campus.index'));
        }

        $this->campusRepository->delete($id);

        Flash::success('Campus deleted successfully.');

        return redirect(route('admin.campus.index'));
    }



    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function listCampus(Request $request)
    {

        $institucion_id = isset($request->institucion_id) ? $request->institucion_id : $request->id;
        
        $this->campus = $this->campusRepository->listCampus($institucion_id);
        return $this->campus;
    }
}
