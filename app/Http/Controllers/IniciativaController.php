<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIniciativaRequest;
use App\Http\Requests\UpdateIniciativaRequest;
use App\Repositories\IniciativaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class IniciativaController extends AppBaseController
{
    /** @var  IniciativaRepository */
    private $iniciativaRepository;

    public function __construct(IniciativaRepository $iniciativaRepo)
    {
        $this->iniciativaRepository = $iniciativaRepo;
    }

    /**
     * Display a listing of the Iniciativa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->iniciativaRepository->pushCriteria(new RequestCriteria($request));
        $iniciativas = $this->iniciativaRepository->all();

        return view('iniciativas.index')
            ->with('iniciativas', $iniciativas);
    }

    /**
     * Show the form for creating a new Iniciativa.
     *
     * @return Response
     */
    public function create()
    {
        return view('iniciativas.create');
    }

    /**
     * Store a newly created Iniciativa in storage.
     *
     * @param CreateIniciativaRequest $request
     *
     * @return Response
     */
    public function store(CreateIniciativaRequest $request)
    {
        $input = $request->all();

        $iniciativa = $this->iniciativaRepository->create($input);

        Flash::success('Iniciativa saved successfully.');

        return redirect(route('iniciativas.index'));
    }

    /**
     * Display the specified Iniciativa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iniciativa = $this->iniciativaRepository->findWithoutFail($id);

        if (empty($iniciativa)) {
            Flash::error('Iniciativa not found');

            return redirect(route('iniciativas.index'));
        }

        return view('iniciativas.show')->with('iniciativa', $iniciativa);
    }

    /**
     * Show the form for editing the specified Iniciativa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iniciativa = $this->iniciativaRepository->findWithoutFail($id);

        if (empty($iniciativa)) {
            Flash::error('Iniciativa not found');

            return redirect(route('iniciativas.index'));
        }

        return view('iniciativas.edit')->with('iniciativa', $iniciativa);
    }

    /**
     * Update the specified Iniciativa in storage.
     *
     * @param  int              $id
     * @param UpdateIniciativaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIniciativaRequest $request)
    {
        $iniciativa = $this->iniciativaRepository->findWithoutFail($id);

        if (empty($iniciativa)) {
            Flash::error('Iniciativa not found');

            return redirect(route('iniciativas.index'));
        }

        $iniciativa = $this->iniciativaRepository->update($request->all(), $id);

        Flash::success('Iniciativa updated successfully.');

        return redirect(route('iniciativas.index'));
    }

    /**
     * Remove the specified Iniciativa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iniciativa = $this->iniciativaRepository->findWithoutFail($id);

        if (empty($iniciativa)) {
            Flash::error('Iniciativa not found');

            return redirect(route('iniciativas.index'));
        }

        $this->iniciativaRepository->delete($id);

        Flash::success('Iniciativa deleted successfully.');

        return redirect(route('iniciativas.index'));
    }
}
