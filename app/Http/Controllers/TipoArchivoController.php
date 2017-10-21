<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoArchivoRequest;
use App\Http\Requests\UpdateTipoArchivoRequest;
use App\Repositories\TipoArchivoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoArchivoController extends AppBaseController
{
    /** @var  TipoArchivoRepository */
    private $tipoArchivoRepository;

    public function __construct(TipoArchivoRepository $tipoArchivoRepo)
    {
        $this->tipoArchivoRepository = $tipoArchivoRepo;
    }

    /**
     * Display a listing of the TipoArchivo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoArchivoRepository->pushCriteria(new RequestCriteria($request));
        $tipoArchivos = $this->tipoArchivoRepository->all();

        return view('tipo_archivos.index')
            ->with('tipoArchivos', $tipoArchivos);
    }

    /**
     * Show the form for creating a new TipoArchivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_archivos.create');
    }

    /**
     * Store a newly created TipoArchivo in storage.
     *
     * @param CreateTipoArchivoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoArchivoRequest $request)
    {
        $input = $request->all();

        $tipoArchivo = $this->tipoArchivoRepository->create($input);

        Flash::success('Tipo Archivo saved successfully.');

        return redirect(route('tipoArchivos.index'));
    }

    /**
     * Display the specified TipoArchivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoArchivo = $this->tipoArchivoRepository->findWithoutFail($id);

        if (empty($tipoArchivo)) {
            Flash::error('Tipo Archivo not found');

            return redirect(route('tipoArchivos.index'));
        }

        return view('tipo_archivos.show')->with('tipoArchivo', $tipoArchivo);
    }

    /**
     * Show the form for editing the specified TipoArchivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoArchivo = $this->tipoArchivoRepository->findWithoutFail($id);

        if (empty($tipoArchivo)) {
            Flash::error('Tipo Archivo not found');

            return redirect(route('tipoArchivos.index'));
        }

        return view('tipo_archivos.edit')->with('tipoArchivo', $tipoArchivo);
    }

    /**
     * Update the specified TipoArchivo in storage.
     *
     * @param  int              $id
     * @param UpdateTipoArchivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoArchivoRequest $request)
    {
        $tipoArchivo = $this->tipoArchivoRepository->findWithoutFail($id);

        if (empty($tipoArchivo)) {
            Flash::error('Tipo Archivo not found');

            return redirect(route('tipoArchivos.index'));
        }

        $tipoArchivo = $this->tipoArchivoRepository->update($request->all(), $id);

        Flash::success('Tipo Archivo updated successfully.');

        return redirect(route('tipoArchivos.index'));
    }

    /**
     * Remove the specified TipoArchivo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoArchivo = $this->tipoArchivoRepository->findWithoutFail($id);

        if (empty($tipoArchivo)) {
            Flash::error('Tipo Archivo not found');

            return redirect(route('tipoArchivos.index'));
        }

        $this->tipoArchivoRepository->delete($id);

        Flash::success('Tipo Archivo deleted successfully.');

        return redirect(route('tipoArchivos.index'));
    }
}
