<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoPlantillaRequest;
use App\Http\Requests\UpdateTipoPlantillaRequest;
use App\Repositories\TipoPlantillaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoPlantillaController extends AppBaseController
{
    /** @var  TipoPlantillaRepository */
    private $tipoPlantillaRepository;

    public function __construct(TipoPlantillaRepository $tipoPlantillaRepo)
    {
        $this->tipoPlantillaRepository = $tipoPlantillaRepo;
    }

    /**
     * Display a listing of the TipoPlantilla.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoPlantillaRepository->pushCriteria(new RequestCriteria($request));
        $tipoPlantillas = $this->tipoPlantillaRepository->all();

        return view('tipo_plantillas.index')
            ->with('tipoPlantillas', $tipoPlantillas);
    }

    /**
     * Show the form for creating a new TipoPlantilla.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_plantillas.create');
    }

    /**
     * Store a newly created TipoPlantilla in storage.
     *
     * @param CreateTipoPlantillaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPlantillaRequest $request)
    {
        $input = $request->all();

        $tipoPlantilla = $this->tipoPlantillaRepository->create($input);

        Flash::success('Tipo Plantilla saved successfully.');

        return redirect(route('tipoPlantillas.index'));
    }

    /**
     * Display the specified TipoPlantilla.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoPlantilla = $this->tipoPlantillaRepository->findWithoutFail($id);

        if (empty($tipoPlantilla)) {
            Flash::error('Tipo Plantilla not found');

            return redirect(route('tipoPlantillas.index'));
        }

        return view('tipo_plantillas.show')->with('tipoPlantilla', $tipoPlantilla);
    }

    /**
     * Show the form for editing the specified TipoPlantilla.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoPlantilla = $this->tipoPlantillaRepository->findWithoutFail($id);

        if (empty($tipoPlantilla)) {
            Flash::error('Tipo Plantilla not found');

            return redirect(route('tipoPlantillas.index'));
        }

        return view('tipo_plantillas.edit')->with('tipoPlantilla', $tipoPlantilla);
    }

    /**
     * Update the specified TipoPlantilla in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPlantillaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPlantillaRequest $request)
    {
        $tipoPlantilla = $this->tipoPlantillaRepository->findWithoutFail($id);

        if (empty($tipoPlantilla)) {
            Flash::error('Tipo Plantilla not found');

            return redirect(route('tipoPlantillas.index'));
        }

        $tipoPlantilla = $this->tipoPlantillaRepository->update($request->all(), $id);

        Flash::success('Tipo Plantilla updated successfully.');

        return redirect(route('tipoPlantillas.index'));
    }

    /**
     * Remove the specified TipoPlantilla from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoPlantilla = $this->tipoPlantillaRepository->findWithoutFail($id);

        if (empty($tipoPlantilla)) {
            Flash::error('Tipo Plantilla not found');

            return redirect(route('tipoPlantillas.index'));
        }

        $this->tipoPlantillaRepository->delete($id);

        Flash::success('Tipo Plantilla deleted successfully.');

        return redirect(route('tipoPlantillas.index'));
    }
}
