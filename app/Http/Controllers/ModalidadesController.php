<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModalidadesRequest;
use App\Http\Requests\UpdateModalidadesRequest;
use App\Repositories\ModalidadesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ModalidadesController extends AppBaseController
{
    /** @var  ModalidadesRepository */
    private $modalidadesRepository;

    public function __construct(ModalidadesRepository $modalidadesRepo)
    {
        $this->modalidadesRepository = $modalidadesRepo;
    }

    /**
     * Display a listing of the Modalidades.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->modalidadesRepository->pushCriteria(new RequestCriteria($request));
        $modalidades = $this->modalidadesRepository->all();

        return view('modalidades.index')
            ->with('modalidades', $modalidades);
    }

    /**
     * Show the form for creating a new Modalidades.
     *
     * @return Response
     */
    public function create()
    {
        return view('modalidades.create');
    }

    /**
     * Store a newly created Modalidades in storage.
     *
     * @param CreateModalidadesRequest $request
     *
     * @return Response
     */
    public function store(CreateModalidadesRequest $request)
    {
        $input = $request->all();

        $modalidades = $this->modalidadesRepository->create($input);

        Flash::success('Modalidades saved successfully.');

        return redirect(route('modalidades.index'));
    }

    /**
     * Display the specified Modalidades.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modalidades = $this->modalidadesRepository->findWithoutFail($id);

        if (empty($modalidades)) {
            Flash::error('Modalidades not found');

            return redirect(route('modalidades.index'));
        }

        return view('modalidades.show')->with('modalidades', $modalidades);
    }

    /**
     * Show the form for editing the specified Modalidades.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modalidades = $this->modalidadesRepository->findWithoutFail($id);

        if (empty($modalidades)) {
            Flash::error('Modalidades not found');

            return redirect(route('modalidades.index'));
        }

        return view('modalidades.edit')->with('modalidades', $modalidades);
    }

    /**
     * Update the specified Modalidades in storage.
     *
     * @param  int              $id
     * @param UpdateModalidadesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModalidadesRequest $request)
    {
        $modalidades = $this->modalidadesRepository->findWithoutFail($id);

        if (empty($modalidades)) {
            Flash::error('Modalidades not found');

            return redirect(route('modalidades.index'));
        }

        $modalidades = $this->modalidadesRepository->update($request->all(), $id);

        Flash::success('Modalidades updated successfully.');

        return redirect(route('modalidades.index'));
    }

    /**
     * Remove the specified Modalidades from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modalidades = $this->modalidadesRepository->findWithoutFail($id);

        if (empty($modalidades)) {
            Flash::error('Modalidades not found');

            return redirect(route('modalidades.index'));
        }

        $this->modalidadesRepository->delete($id);

        Flash::success('Modalidades deleted successfully.');

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
