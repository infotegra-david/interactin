<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDatosPersonalesRequest;
use App\Http\Requests\UpdateDatosPersonalesRequest;
use App\Repositories\DatosPersonalesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DatosPersonalesController extends AppBaseController
{
    /** @var  DatosPersonalesRepository */
    private $datosPersonalesRepository;

    public function __construct(DatosPersonalesRepository $datosPersonalesRepo)
    {
        $this->datosPersonalesRepository = $datosPersonalesRepo;
    }

    /**
     * Display a listing of the DatosPersonales.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->datosPersonalesRepository->pushCriteria(new RequestCriteria($request));
        $datosPersonales = $this->datosPersonalesRepository->all();

        return view('datos_personales.index')
            ->with('datosPersonales', $datosPersonales);
    }

    /**
     * Show the form for creating a new DatosPersonales.
     *
     * @return Response
     */
    public function create()
    {
        return view('datos_personales.create');
    }

    /**
     * Store a newly created DatosPersonales in storage.
     *
     * @param CreateDatosPersonalesRequest $request
     *
     * @return Response
     */
    public function store(CreateDatosPersonalesRequest $request)
    {
        $input = $request->all();

        $datosPersonales = $this->datosPersonalesRepository->create($input);

        Flash::success('Datos Personales saved successfully.');

        return redirect(route('datosPersonales.index'));
    }

    /**
     * Display the specified DatosPersonales.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $datosPersonales = $this->datosPersonalesRepository->findWithoutFail($id);

        if (empty($datosPersonales)) {
            Flash::error('Datos Personales not found');

            return redirect(route('datosPersonales.index'));
        }

        return view('datos_personales.show')->with('datosPersonales', $datosPersonales);
    }

    /**
     * Show the form for editing the specified DatosPersonales.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $datosPersonales = $this->datosPersonalesRepository->findWithoutFail($id);

        if (empty($datosPersonales)) {
            Flash::error('Datos Personales not found');

            return redirect(route('datosPersonales.index'));
        }

        return view('datos_personales.edit')->with('datosPersonales', $datosPersonales);
    }

    /**
     * Update the specified DatosPersonales in storage.
     *
     * @param  int              $id
     * @param UpdateDatosPersonalesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDatosPersonalesRequest $request)
    {
        $datosPersonales = $this->datosPersonalesRepository->findWithoutFail($id);

        if (empty($datosPersonales)) {
            Flash::error('Datos Personales not found');

            return redirect(route('datosPersonales.index'));
        }

        $datosPersonales = $this->datosPersonalesRepository->update($request->all(), $id);

        Flash::success('Datos Personales updated successfully.');

        return redirect(route('datosPersonales.index'));
    }

    /**
     * Remove the specified DatosPersonales from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $datosPersonales = $this->datosPersonalesRepository->findWithoutFail($id);

        if (empty($datosPersonales)) {
            Flash::error('Datos Personales not found');

            return redirect(route('datosPersonales.index'));
        }

        $this->datosPersonalesRepository->delete($id);

        Flash::success('Datos Personales deleted successfully.');

        return redirect(route('datosPersonales.index'));
    }
}
