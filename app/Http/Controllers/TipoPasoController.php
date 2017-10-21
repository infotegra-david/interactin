<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoPasoRequest;
use App\Http\Requests\UpdateTipoPasoRequest;
use App\Repositories\TipoPasoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoPasoController extends AppBaseController
{
    /** @var  TipoPasoRepository */
    private $tipoPasoRepository;

    public function __construct(TipoPasoRepository $tipoPasoRepo)
    {
        $this->tipoPasoRepository = $tipoPasoRepo;
    }

    /**
     * Display a listing of the TipoPaso.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoPasoRepository->pushCriteria(new RequestCriteria($request));
        $tipoPasos = $this->tipoPasoRepository->all();

        return view('tipo_pasos.index')
            ->with('tipoPasos', $tipoPasos);
    }

    /**
     * Show the form for creating a new TipoPaso.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_pasos.create');
    }

    /**
     * Store a newly created TipoPaso in storage.
     *
     * @param CreateTipoPasoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoPasoRequest $request)
    {
        $input = $request->all();

        $tipoPaso = $this->tipoPasoRepository->create($input);

        Flash::success('Tipo Paso saved successfully.');

        return redirect(route('tipoPasos.index'));
    }

    /**
     * Display the specified TipoPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoPaso = $this->tipoPasoRepository->findWithoutFail($id);

        if (empty($tipoPaso)) {
            Flash::error('Tipo Paso not found');

            return redirect(route('tipoPasos.index'));
        }

        return view('tipo_pasos.show')->with('tipoPaso', $tipoPaso);
    }

    /**
     * Show the form for editing the specified TipoPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoPaso = $this->tipoPasoRepository->findWithoutFail($id);

        if (empty($tipoPaso)) {
            Flash::error('Tipo Paso not found');

            return redirect(route('tipoPasos.index'));
        }

        return view('tipo_pasos.edit')->with('tipoPaso', $tipoPaso);
    }

    /**
     * Update the specified TipoPaso in storage.
     *
     * @param  int              $id
     * @param UpdateTipoPasoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoPasoRequest $request)
    {
        $tipoPaso = $this->tipoPasoRepository->findWithoutFail($id);

        if (empty($tipoPaso)) {
            Flash::error('Tipo Paso not found');

            return redirect(route('tipoPasos.index'));
        }

        $tipoPaso = $this->tipoPasoRepository->update($request->all(), $id);

        Flash::success('Tipo Paso updated successfully.');

        return redirect(route('tipoPasos.index'));
    }

    /**
     * Remove the specified TipoPaso from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoPaso = $this->tipoPasoRepository->findWithoutFail($id);

        if (empty($tipoPaso)) {
            Flash::error('Tipo Paso not found');

            return redirect(route('tipoPasos.index'));
        }

        $this->tipoPasoRepository->delete($id);

        Flash::success('Tipo Paso deleted successfully.');

        return redirect(route('tipoPasos.index'));
    }
}
