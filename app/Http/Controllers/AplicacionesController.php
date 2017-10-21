<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAplicacionesRequest;
use App\Http\Requests\UpdateAplicacionesRequest;
use App\Repositories\AplicacionesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AplicacionesController extends AppBaseController
{
    /** @var  AplicacionesRepository */
    private $aplicacionesRepository;

    public function __construct(AplicacionesRepository $aplicacionesRepo)
    {
        $this->aplicacionesRepository = $aplicacionesRepo;
    }

    /**
     * Display a listing of the Aplicaciones.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->aplicacionesRepository->pushCriteria(new RequestCriteria($request));
        $aplicaciones = $this->aplicacionesRepository->all();

        return view('aplicaciones.index')
            ->with('aplicaciones', $aplicaciones);
    }

    /**
     * Show the form for creating a new Aplicaciones.
     *
     * @return Response
     */
    public function create()
    {
        return view('aplicaciones.create');
    }

    /**
     * Store a newly created Aplicaciones in storage.
     *
     * @param CreateAplicacionesRequest $request
     *
     * @return Response
     */
    public function store(CreateAplicacionesRequest $request)
    {
        $input = $request->all();

        $aplicaciones = $this->aplicacionesRepository->create($input);

        Flash::success('Aplicaciones saved successfully.');

        return redirect(route('aplicaciones.index'));
    }

    /**
     * Display the specified Aplicaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aplicaciones = $this->aplicacionesRepository->findWithoutFail($id);

        if (empty($aplicaciones)) {
            Flash::error('Aplicaciones not found');

            return redirect(route('aplicaciones.index'));
        }

        return view('aplicaciones.show')->with('aplicaciones', $aplicaciones);
    }

    /**
     * Show the form for editing the specified Aplicaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aplicaciones = $this->aplicacionesRepository->findWithoutFail($id);

        if (empty($aplicaciones)) {
            Flash::error('Aplicaciones not found');

            return redirect(route('aplicaciones.index'));
        }

        return view('aplicaciones.edit')->with('aplicaciones', $aplicaciones);
    }

    /**
     * Update the specified Aplicaciones in storage.
     *
     * @param  int              $id
     * @param UpdateAplicacionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAplicacionesRequest $request)
    {
        $aplicaciones = $this->aplicacionesRepository->findWithoutFail($id);

        if (empty($aplicaciones)) {
            Flash::error('Aplicaciones not found');

            return redirect(route('aplicaciones.index'));
        }

        $aplicaciones = $this->aplicacionesRepository->update($request->all(), $id);

        Flash::success('Aplicaciones updated successfully.');

        return redirect(route('aplicaciones.index'));
    }

    /**
     * Remove the specified Aplicaciones from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aplicaciones = $this->aplicacionesRepository->findWithoutFail($id);

        if (empty($aplicaciones)) {
            Flash::error('Aplicaciones not found');

            return redirect(route('aplicaciones.index'));
        }

        $this->aplicacionesRepository->delete($id);

        Flash::success('Aplicaciones deleted successfully.');

        return redirect(route('aplicaciones.index'));
    }


    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listAplicaciones(Request $request)
    {
        $tipo_alianza_id = $request->id;
        $aplicaciones = $this->aplicacionesRepository->listAplicaciones($tipo_alianza_id);
        return response()->json($aplicaciones);
    }
}
