<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoFacultadRequest;
use App\Http\Requests\UpdateTipoFacultadRequest;
use App\Repositories\TipoFacultadRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoFacultadController extends AppBaseController
{
    /** @var  TipoFacultadRepository */
    private $tipoFacultadRepository;

    public function __construct(TipoFacultadRepository $tipoFacultadRepo)
    {
        $this->tipoFacultadRepository = $tipoFacultadRepo;
    }

    /**
     * Display a listing of the TipoFacultad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoFacultadRepository->pushCriteria(new RequestCriteria($request));
        $tipoFacultads = $this->tipoFacultadRepository->all();

        return view('tipo_facultads.index')
            ->with('tipoFacultads', $tipoFacultads);
    }

    /**
     * Show the form for creating a new TipoFacultad.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_facultads.create');
    }

    /**
     * Store a newly created TipoFacultad in storage.
     *
     * @param CreateTipoFacultadRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoFacultadRequest $request)
    {
        $input = $request->all();

        $tipoFacultad = $this->tipoFacultadRepository->create($input);

        Flash::success('Tipo Facultad saved successfully.');

        return redirect(route('tipoFacultads.index'));
    }

    /**
     * Display the specified TipoFacultad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoFacultad = $this->tipoFacultadRepository->findWithoutFail($id);

        if (empty($tipoFacultad)) {
            Flash::error('Tipo Facultad not found');

            return redirect(route('tipoFacultads.index'));
        }

        return view('tipo_facultads.show')->with('tipoFacultad', $tipoFacultad);
    }

    /**
     * Show the form for editing the specified TipoFacultad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoFacultad = $this->tipoFacultadRepository->findWithoutFail($id);

        if (empty($tipoFacultad)) {
            Flash::error('Tipo Facultad not found');

            return redirect(route('tipoFacultads.index'));
        }

        return view('tipo_facultads.edit')->with('tipoFacultad', $tipoFacultad);
    }

    /**
     * Update the specified TipoFacultad in storage.
     *
     * @param  int              $id
     * @param UpdateTipoFacultadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoFacultadRequest $request)
    {
        $tipoFacultad = $this->tipoFacultadRepository->findWithoutFail($id);

        if (empty($tipoFacultad)) {
            Flash::error('Tipo Facultad not found');

            return redirect(route('tipoFacultads.index'));
        }

        $tipoFacultad = $this->tipoFacultadRepository->update($request->all(), $id);

        Flash::success('Tipo Facultad updated successfully.');

        return redirect(route('tipoFacultads.index'));
    }

    /**
     * Remove the specified TipoFacultad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoFacultad = $this->tipoFacultadRepository->findWithoutFail($id);

        if (empty($tipoFacultad)) {
            Flash::error('Tipo Facultad not found');

            return redirect(route('tipoFacultads.index'));
        }

        $this->tipoFacultadRepository->delete($id);

        Flash::success('Tipo Facultad deleted successfully.');

        return redirect(route('tipoFacultads.index'));
    }
}
