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
    private $campus = array();

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
                    }
                    if (count($this->campusApp)) {
                        $this->campusApp = $this->campusApp->pluck('nombre','id');
                    }else{
                        $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                    }
                }else{
                    $this->campusApp = 0;
                }
            }
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
        $this->campusRepository->pushCriteria(new RequestCriteria($request));
        $campuses = $this->campusRepository->all();

        return view('admin.campus.index')
            ->with(['campusApp' => $this->campusApp, 'campuses' => $campuses]);
    }

    /**
     * Show the form for creating a new Campus.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.campus.create');
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

        return view('admin.campus.show')->with(['campusApp' => $this->campusApp, 'campus' => $campus]);
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

        return view('admin.campus.edit')->with(['campusApp' => $this->campusApp, 'campus' => $campus]);
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

        $campus = $this->campusRepository->update($request->all(), $id);

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
