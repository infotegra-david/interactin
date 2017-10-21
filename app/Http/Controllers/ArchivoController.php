<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArchivoRequest;
use App\Http\Requests\UpdateArchivoRequest;
use App\Repositories\ArchivoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ArchivoController extends AppBaseController
{
    /** @var  ArchivoRepository */
    private $archivoRepository;

    public function __construct(ArchivoRepository $archivoRepo)
    {
        $this->archivoRepository = $archivoRepo;
    }

    /**
     * Display a listing of the Archivo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->archivoRepository->pushCriteria(new RequestCriteria($request));
        $archivos = $this->archivoRepository->all();

        return view('archivos.index')
            ->with('archivos', $archivos);
    }

    /**
     * Show the form for creating a new Archivo.
     *
     * @return Response
     */
    public function create()
    {
        return view('archivos.create');
    }

    /**
     * Store a newly created Archivo in storage.
     *
     * @param CreateArchivoRequest $request
     *
     * @return Response
     */
    public function store(CreateArchivoRequest $request)
    {
        $input = $request->all();

        $archivo = $this->archivoRepository->create($input);

        Flash::success('Archivo saved successfully.');

        return redirect(route('archivos.index'));
    }

    /**
     * Display the specified Archivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $archivo = $this->archivoRepository->findWithoutFail($id);

        if (empty($archivo)) {
            Flash::error('Archivo not found');

            return redirect(route('archivos.index'));
        }

        return view('archivos.show')->with('archivo', $archivo);
    }

    /**
     * Show the form for editing the specified Archivo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $archivo = $this->archivoRepository->findWithoutFail($id);

        if (empty($archivo)) {
            Flash::error('Archivo not found');

            return redirect(route('archivos.index'));
        }

        return view('archivos.edit')->with('archivo', $archivo);
    }

    /**
     * Update the specified Archivo in storage.
     *
     * @param  int              $id
     * @param UpdateArchivoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArchivoRequest $request)
    {
        $archivo = $this->archivoRepository->findWithoutFail($id);

        if (empty($archivo)) {
            Flash::error('Archivo not found');

            return redirect(route('archivos.index'));
        }

        $archivo = $this->archivoRepository->update($request->all(), $id);

        Flash::success('Archivo updated successfully.');

        return redirect(route('archivos.index'));
    }

    /**
     * Remove the specified Archivo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $archivo = $this->archivoRepository->findWithoutFail($id);

        if (empty($archivo)) {
            Flash::error('Archivo not found');

            return redirect(route('archivos.index'));
        }

        $this->archivoRepository->delete($id);

        Flash::success('Archivo deleted successfully.');

        return redirect(route('archivos.index'));
    }
}
