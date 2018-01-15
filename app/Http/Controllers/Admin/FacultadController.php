<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateFacultadRequest;
use App\Http\Requests\Admin\UpdateFacultadRequest;
use App\Repositories\Admin\FacultadRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FacultadController extends AppBaseController
{
    /** @var  FacultadRepository */
    private $facultadRepository;

    public function __construct(FacultadRepository $facultadRepo)
    {
        $this->facultadRepository = $facultadRepo;
    }

    /**
     * Display a listing of the Facultad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facultadRepository->pushCriteria(new RequestCriteria($request));
        $facultads = $this->facultadRepository->all();

        return view('admin.facultades.index')
            ->with('facultads', $facultads);
    }

    /**
     * Show the form for creating a new Facultad.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.facultades.create');
    }

    /**
     * Store a newly created Facultad in storage.
     *
     * @param CreateFacultadRequest $request
     *
     * @return Response
     */
    public function store(CreateFacultadRequest $request)
    {
        $input = $request->all();

        $facultad = $this->facultadRepository->create($input);

        Flash::success('Facultad saved successfully.');

        return redirect(route('admin.faculties.index'));
    }

    /**
     * Display the specified Facultad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facultad = $this->facultadRepository->findWithoutFail($id);

        if (empty($facultad)) {
            Flash::error('Facultad not found');

            return redirect(route('admin.faculties.index'));
        }

        return view('admin.facultades.show')->with('facultad', $facultad);
    }

    /**
     * Show the form for editing the specified Facultad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facultad = $this->facultadRepository->findWithoutFail($id);

        if (empty($facultad)) {
            Flash::error('Facultad not found');

            return redirect(route('admin.faculties.index'));
        }

        return view('admin.facultades.edit')->with('facultad', $facultad);
    }

    /**
     * Update the specified Facultad in storage.
     *
     * @param  int              $id
     * @param UpdateFacultadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacultadRequest $request)
    {
        $facultad = $this->facultadRepository->findWithoutFail($id);

        if (empty($facultad)) {
            Flash::error('Facultad not found');

            return redirect(route('admin.faculties.index'));
        }

        $facultad = $this->facultadRepository->update($request->all(), $id);

        Flash::success('Facultad updated successfully.');

        return redirect(route('admin.faculties.index'));
    }

    /**
     * Remove the specified Facultad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facultad = $this->facultadRepository->findWithoutFail($id);

        if (empty($facultad)) {
            Flash::error('Facultad not found');

            return redirect(route('admin.faculties.index'));
        }

        $this->facultadRepository->delete($id);

        Flash::success('Facultad deleted successfully.');

        return redirect(route('admin.faculties.index'));
    }





    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listFaculties(Request $request)
    {
        $campus_id = $request->id;
        $facultades = $this->facultadRepository->listFaculties($campus_id);
        return response()->json($facultades);
    }
}
