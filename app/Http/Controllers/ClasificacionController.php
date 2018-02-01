<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClasificacionRequest;
use App\Http\Requests\UpdateClasificacionRequest;
use App\Repositories\ClasificacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ClasificacionController extends AppBaseController
{
    /** @var  ClasificacionRepository */
    private $clasificacionRepository;

    public function __construct(ClasificacionRepository $clasificacionRepo)
    {
        $this->clasificacionRepository = $clasificacionRepo;
    }

    /**
     * Display a listing of the Clasificacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clasificacionRepository->pushCriteria(new RequestCriteria($request));
        $clasificaciones = $this->clasificacionRepository->all();

        return view('clasificacion.index')
            ->with('clasificaciones', $clasificaciones);
    }

    /**
     * Show the form for creating a new Clasificacion.
     *
     * @return Response
     */
    public function create()
    {
        return view('clasificacion.create');
    }

    /**
     * Store a newly created Clasificacion in storage.
     *
     * @param CreateClasificacionRequest $request
     *
     * @return Response
     */
    public function store(CreateClasificacionRequest $request)
    {
        $input = $request->all();

        $clasificacion = $this->clasificacionRepository->create($input);

        Flash::success('Clasificación saved successfully.');

        return redirect(route('clasificacion.index'));
    }

    /**
     * Display the specified Clasificacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clasificacion = $this->clasificacionRepository->findWithoutFail($id);

        if (empty($clasificacion)) {
            Flash::error('Clasificación not found');

            return redirect(route('clasificacion.index'));
        }

        return view('clasificacion.show')->with('clasificacion', $clasificacion);
    }

    /**
     * Show the form for editing the specified Clasificacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clasificacion = $this->clasificacionRepository->findWithoutFail($id);

        if (empty($clasificacion)) {
            Flash::error('Clasificación not found');

            return redirect(route('clasificacion.index'));
        }

        return view('clasificacion.edit')->with('clasificacion', $clasificacion);
    }

    /**
     * Update the specified Clasificacion in storage.
     *
     * @param  int              $id
     * @param UpdateClasificacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClasificacionRequest $request)
    {
        $clasificacion = $this->clasificacionRepository->findWithoutFail($id);

        if (empty($clasificacion)) {
            Flash::error('Clasificación not found');

            return redirect(route('clasificacion.index'));
        }

        $clasificacion = $this->clasificacionRepository->update($request->all(), $id);

        Flash::success('Clasificación updated successfully.');

        return redirect(route('clasificacion.index'));
    }

    /**
     * Remove the specified Clasificacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clasificacion = $this->clasificacionRepository->findWithoutFail($id);

        if (empty($clasificacion)) {
            Flash::error('Clasificación not found');

            return redirect(route('clasificacion.index'));
        }

        $this->clasificacionRepository->delete($id);

        Flash::success('Clasificación deleted successfully.');

        return redirect(route('clasificacion.index'));
    }
}
