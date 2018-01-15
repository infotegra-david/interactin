<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFinanciacionRequest;
use App\Http\Requests\UpdateFinanciacionRequest;
use App\Repositories\FinanciacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FinanciacionController extends AppBaseController
{
    /** @var  FinanciacionRepository */
    private $financiacionRepository;

    public function __construct(FinanciacionRepository $financiacionRepo)
    {
        $this->financiacionRepository = $financiacionRepo;
    }

    /**
     * Display a listing of the Financiacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->financiacionRepository->pushCriteria(new RequestCriteria($request));
        $financiacions = $this->financiacionRepository->all();

        return view('financiacions.index')
            ->with('financiacions', $financiacions);
    }

    /**
     * Show the form for creating a new Financiacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('financiacions.create');
    }

    /**
     * Store a newly created Financiacion in storage.
     *
     * @param CreateFinanciacionRequest $request
     *
     * @return Response
     */
    public function store(CreateFinanciacionRequest $request)
    {
        $input = $request->all();

        $financiacion = $this->financiacionRepository->create($input);

        Flash::success('Financiacion saved successfully.');

        return redirect(route('financiacions.index'));
    }

    /**
     * Display the specified Financiacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $financiacion = $this->financiacionRepository->findWithoutFail($id);

        if (empty($financiacion)) {
            Flash::error('Financiacion not found');

            return redirect(route('financiacions.index'));
        }

        return view('financiacions.show')->with('financiacion', $financiacion);
    }

    /**
     * Show the form for editing the specified Financiacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $financiacion = $this->financiacionRepository->findWithoutFail($id);

        if (empty($financiacion)) {
            Flash::error('Financiacion not found');

            return redirect(route('financiacions.index'));
        }

        return view('financiacions.edit')->with('financiacion', $financiacion);
    }

    /**
     * Update the specified Financiacion in storage.
     *
     * @param  int              $id
     * @param UpdateFinanciacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFinanciacionRequest $request)
    {
        $financiacion = $this->financiacionRepository->findWithoutFail($id);

        if (empty($financiacion)) {
            Flash::error('Financiacion not found');

            return redirect(route('financiacions.index'));
        }

        $financiacion = $this->financiacionRepository->update($request->all(), $id);

        Flash::success('Financiacion updated successfully.');

        return redirect(route('financiacions.index'));
    }

    /**
     * Remove the specified Financiacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $financiacion = $this->financiacionRepository->findWithoutFail($id);

        if (empty($financiacion)) {
            Flash::error('Financiacion not found');

            return redirect(route('financiacions.index'));
        }

        $this->financiacionRepository->delete($id);

        Flash::success('Financiacion deleted successfully.');

        return redirect(route('financiacions.index'));
    }
}
