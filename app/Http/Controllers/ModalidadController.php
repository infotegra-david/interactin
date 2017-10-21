<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModalidadRequest;
use App\Http\Requests\UpdateModalidadRequest;
use App\Repositories\ModalidadRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ModalidadController extends AppBaseController
{
    /** @var  ModalidadRepository */
    private $modalidadRepository;

    public function __construct(ModalidadRepository $modalidadRepo)
    {
        $this->modalidadRepository = $modalidadRepo;
    }

    /**
     * Display a listing of the Modalidad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->modalidadRepository->pushCriteria(new RequestCriteria($request));
        $modalidades = $this->modalidadRepository->all();

        return view('modalidades.index')
            ->with('modalidades', $modalidades);
    }

    /**
     * Show the form for creating a new Modalidad.
     *
     * @return Response
     */
    public function create()
    {
        return view('modalidades.create');
    }

    /**
     * Store a newly created Modalidad in storage.
     *
     * @param CreateModalidadRequest $request
     *
     * @return Response
     */
    public function store(CreateModalidadRequest $request)
    {
        $input = $request->all();

        $modalidad = $this->modalidadRepository->create($input);

        Flash::success('Modalidad saved successfully.');

        return redirect(route('modalidades.index'));
    }

    /**
     * Display the specified Modalidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modalidad = $this->modalidadRepository->findWithoutFail($id);

        if (empty($modalidad)) {
            Flash::error('Modalidad not found');

            return redirect(route('modalidades.index'));
        }

        return view('modalidades.show')->with('modalidad', $modalidad);
    }

    /**
     * Show the form for editing the specified Modalidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modalidad = $this->modalidadRepository->findWithoutFail($id);

        if (empty($modalidad)) {
            Flash::error('Modalidad not found');

            return redirect(route('modalidades.index'));
        }

        return view('modalidades.edit')->with('modalidad', $modalidad);
    }

    /**
     * Update the specified Modalidad in storage.
     *
     * @param  int              $id
     * @param UpdateModalidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModalidadRequest $request)
    {
        $modalidad = $this->modalidadRepository->findWithoutFail($id);

        if (empty($modalidad)) {
            Flash::error('Modalidad not found');

            return redirect(route('modalidades.index'));
        }

        $modalidad = $this->modalidadRepository->update($request->all(), $id);

        Flash::success('Modalidad updated successfully.');

        return redirect(route('modalidades.index'));
    }

    /**
     * Remove the specified Modalidad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modalidad = $this->modalidadRepository->findWithoutFail($id);

        if (empty($modalidad)) {
            Flash::error('Modalidad not found');

            return redirect(route('modalidades.index'));
        }

        $this->modalidadRepository->delete($id);

        Flash::success('Modalidad deleted successfully.');

        return redirect(route('modalidades.index'));
    }




    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listModalidades(Request $request)
    {
        $tipo_alianza_id = $request->id;
        $modalidades = $this->modalidadRepository->listModalidades($tipo_alianza_id);
        return response()->json($modalidades);
    }
}
