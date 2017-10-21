<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInscripcionRequest;
use App\Http\Requests\UpdateInscripcionRequest;
use App\Repositories\InscripcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InscripcionController extends AppBaseController
{
    /** @var  InscripcionRepository */
    private $inscripcionRepository;

    public function __construct(InscripcionRepository $inscripcionRepo)
    {
        $this->inscripcionRepository = $inscripcionRepo;
    }

    /**
     * Display a listing of the Inscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inscripcionRepository->pushCriteria(new RequestCriteria($request));
        $inscripcions = $this->inscripcionRepository->all();

        return view('inscripcions.index')
            ->with('inscripcions', $inscripcions);
    }

    /**
     * Show the form for creating a new Inscripcion.
     *
     * @return Response
     */
    public function create()
    {
        return view('inscripcions.create');
    }

    /**
     * Store a newly created Inscripcion in storage.
     *
     * @param CreateInscripcionRequest $request
     *
     * @return Response
     */
    public function store(CreateInscripcionRequest $request)
    {
        $input = $request->all();

        $inscripcion = $this->inscripcionRepository->create($input);

        Flash::success('Inscripcion saved successfully.');

        return redirect(route('inscripcions.index'));
    }

    /**
     * Display the specified Inscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inscripcion not found');

            return redirect(route('inscripcions.index'));
        }

        return view('inscripcions.show')->with('inscripcion', $inscripcion);
    }

    /**
     * Show the form for editing the specified Inscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inscripcion not found');

            return redirect(route('inscripcions.index'));
        }

        return view('inscripcions.edit')->with('inscripcion', $inscripcion);
    }

    /**
     * Update the specified Inscripcion in storage.
     *
     * @param  int              $id
     * @param UpdateInscripcionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInscripcionRequest $request)
    {
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inscripcion not found');

            return redirect(route('inscripcions.index'));
        }

        $inscripcion = $this->inscripcionRepository->update($request->all(), $id);

        Flash::success('Inscripcion updated successfully.');

        return redirect(route('inscripcions.index'));
    }

    /**
     * Remove the specified Inscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inscripcion = $this->inscripcionRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inscripcion not found');

            return redirect(route('inscripcions.index'));
        }

        $this->inscripcionRepository->delete($id);

        Flash::success('Inscripcion deleted successfully.');

        return redirect(route('inscripcions.index'));
    }
}
