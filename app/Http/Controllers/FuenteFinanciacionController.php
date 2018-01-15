<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFuenteFinanciacionRequest;
use App\Http\Requests\UpdateFuenteFinanciacionRequest;
use App\Repositories\FuenteFinanciacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FuenteFinanciacionController extends AppBaseController
{
    /** @var  FuenteFinanciacionRepository */
    private $fuenteFinanciacionRepository;

    public function __construct(FuenteFinanciacionRepository $fuenteFinanciacionRepo)
    {
        $this->fuenteFinanciacionRepository = $fuenteFinanciacionRepo;
    }

    /**
     * Display a listing of the FuenteFinanciacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fuenteFinanciacionRepository->pushCriteria(new RequestCriteria($request));
        $fuenteFinanciacions = $this->fuenteFinanciacionRepository->all();

        return view('fuente_financiacions.index')
            ->with('fuenteFinanciacions', $fuenteFinanciacions);
    }

    /**
     * Show the form for creating a new FuenteFinanciacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('fuente_financiacions.create');
    }

    /**
     * Store a newly created FuenteFinanciacion in storage.
     *
     * @param CreateFuenteFinanciacionRequest $request
     *
     * @return Response
     */
    public function store(CreateFuenteFinanciacionRequest $request)
    {
        $input = $request->all();

        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->create($input);

        Flash::success('Fuente Financiacion saved successfully.');

        return redirect(route('fuenteFinanciacions.index'));
    }

    /**
     * Display the specified FuenteFinanciacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->findWithoutFail($id);

        if (empty($fuenteFinanciacion)) {
            Flash::error('Fuente Financiacion not found');

            return redirect(route('fuenteFinanciacions.index'));
        }

        return view('fuente_financiacions.show')->with('fuenteFinanciacion', $fuenteFinanciacion);
    }

    /**
     * Show the form for editing the specified FuenteFinanciacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->findWithoutFail($id);

        if (empty($fuenteFinanciacion)) {
            Flash::error('Fuente Financiacion not found');

            return redirect(route('fuenteFinanciacions.index'));
        }

        return view('fuente_financiacions.edit')->with('fuenteFinanciacion', $fuenteFinanciacion);
    }

    /**
     * Update the specified FuenteFinanciacion in storage.
     *
     * @param  int              $id
     * @param UpdateFuenteFinanciacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFuenteFinanciacionRequest $request)
    {
        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->findWithoutFail($id);

        if (empty($fuenteFinanciacion)) {
            Flash::error('Fuente Financiacion not found');

            return redirect(route('fuenteFinanciacions.index'));
        }

        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->update($request->all(), $id);

        Flash::success('Fuente Financiacion updated successfully.');

        return redirect(route('fuenteFinanciacions.index'));
    }

    /**
     * Remove the specified FuenteFinanciacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fuenteFinanciacion = $this->fuenteFinanciacionRepository->findWithoutFail($id);

        if (empty($fuenteFinanciacion)) {
            Flash::error('Fuente Financiacion not found');

            return redirect(route('fuenteFinanciacions.index'));
        }

        $this->fuenteFinanciacionRepository->delete($id);

        Flash::success('Fuente Financiacion deleted successfully.');

        return redirect(route('fuenteFinanciacions.index'));
    }
}
