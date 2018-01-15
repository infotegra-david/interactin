<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlantillasRequest;
use App\Http\Requests\UpdatePlantillasRequest;
use App\Repositories\PlantillasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PlantillasController extends AppBaseController
{
    /** @var  PlantillasRepository */
    private $plantillasRepository;

    public function __construct(PlantillasRepository $plantillasRepo)
    {
        $this->plantillasRepository = $plantillasRepo;
    }

    /**
     * Display a listing of the Plantillas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->plantillasRepository->pushCriteria(new RequestCriteria($request));
        $plantillas = $this->plantillasRepository->all();

        return view('plantillas.index')
            ->with('plantillas', $plantillas);
    }

    /**
     * Show the form for creating a new Plantillas.
     *
     * @return Response
     */
    public function create()
    {
        return view('plantillas.create');
    }

    /**
     * Store a newly created Plantillas in storage.
     *
     * @param CreatePlantillasRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantillasRequest $request)
    {
        $input = $request->all();

        $plantillas = $this->plantillasRepository->create($input);

        Flash::success('Plantillas saved successfully.');

        return redirect(route('plantillas.index'));
    }

    /**
     * Display the specified Plantillas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        return view('plantillas.show')->with('plantillas', $plantillas);
    }

    /**
     * Show the form for editing the specified Plantillas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        return view('plantillas.edit')->with('plantillas', $plantillas);
    }

    /**
     * Update the specified Plantillas in storage.
     *
     * @param  int              $id
     * @param UpdatePlantillasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantillasRequest $request)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        $plantillas = $this->plantillasRepository->update($request->all(), $id);

        Flash::success('Plantillas updated successfully.');

        return redirect(route('plantillas.index'));
    }

    /**
     * Remove the specified Plantillas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        $this->plantillasRepository->delete($id);

        Flash::success('Plantillas deleted successfully.');

        return redirect(route('plantillas.index'));
    }
}
