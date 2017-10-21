<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreatePasosIniciativaRequest;
use App\Http\Requests\Validation\UpdatePasosIniciativaRequest;
use App\Repositories\Validation\PasosIniciativaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PasosIniciativaController extends AppBaseController
{
    /** @var  PasosIniciativaRepository */
    private $pasosIniciativaRepository;

    public function __construct(PasosIniciativaRepository $pasosIniciativaRepo)
    {
        $this->pasosIniciativaRepository = $pasosIniciativaRepo;
    }

    /**
     * Display a listing of the PasosIniciativa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pasosIniciativaRepository->pushCriteria(new RequestCriteria($request));
        $pasosIniciativas = $this->pasosIniciativaRepository->all();

        return view('validation.pasos_iniciativas.index')
            ->with('pasosIniciativas', $pasosIniciativas);
    }

    /**
     * Show the form for creating a new PasosIniciativa.
     *
     * @return Response
     */
    public function create()
    {
        return view('validation.pasos_iniciativas.create');
    }

    /**
     * Store a newly created PasosIniciativa in storage.
     *
     * @param CreatePasosIniciativaRequest $request
     *
     * @return Response
     */
    public function store(CreatePasosIniciativaRequest $request)
    {
        $input = $request->all();

        $pasosIniciativa = $this->pasosIniciativaRepository->create($input);

        Flash::success('Pasos Iniciativa saved successfully.');

        return redirect(route('validation.pasosIniciativas.index'));
    }

    /**
     * Display the specified PasosIniciativa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pasosIniciativa = $this->pasosIniciativaRepository->findWithoutFail($id);

        if (empty($pasosIniciativa)) {
            Flash::error('Pasos Iniciativa not found');

            return redirect(route('validation.pasosIniciativas.index'));
        }

        return view('validation.pasos_iniciativas.show')->with('pasosIniciativa', $pasosIniciativa);
    }

    /**
     * Show the form for editing the specified PasosIniciativa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pasosIniciativa = $this->pasosIniciativaRepository->findWithoutFail($id);

        if (empty($pasosIniciativa)) {
            Flash::error('Pasos Iniciativa not found');

            return redirect(route('validation.pasosIniciativas.index'));
        }

        return view('validation.pasos_iniciativas.edit')->with('pasosIniciativa', $pasosIniciativa);
    }

    /**
     * Update the specified PasosIniciativa in storage.
     *
     * @param  int              $id
     * @param UpdatePasosIniciativaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePasosIniciativaRequest $request)
    {
        $pasosIniciativa = $this->pasosIniciativaRepository->findWithoutFail($id);

        if (empty($pasosIniciativa)) {
            Flash::error('Pasos Iniciativa not found');

            return redirect(route('validation.pasosIniciativas.index'));
        }

        $pasosIniciativa = $this->pasosIniciativaRepository->update($request->all(), $id);

        Flash::success('Pasos Iniciativa updated successfully.');

        return redirect(route('validation.pasosIniciativas.index'));
    }

    /**
     * Remove the specified PasosIniciativa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pasosIniciativa = $this->pasosIniciativaRepository->findWithoutFail($id);

        if (empty($pasosIniciativa)) {
            Flash::error('Pasos Iniciativa not found');

            return redirect(route('validation.pasosIniciativas.index'));
        }

        $this->pasosIniciativaRepository->delete($id);

        Flash::success('Pasos Iniciativa deleted successfully.');

        return redirect(route('validation.pasosIniciativas.index'));
    }
}
