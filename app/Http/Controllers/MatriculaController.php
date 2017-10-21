<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatriculaRequest;
use App\Http\Requests\UpdateMatriculaRequest;
use App\Repositories\MatriculaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MatriculaController extends AppBaseController
{
    /** @var  MatriculaRepository */
    private $matriculaRepository;

    public function __construct(MatriculaRepository $matriculaRepo)
    {
        $this->matriculaRepository = $matriculaRepo;
    }

    /**
     * Display a listing of the Matricula.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->matriculaRepository->pushCriteria(new RequestCriteria($request));
        $matriculas = $this->matriculaRepository->all();

        return view('matriculas.index')
            ->with('matriculas', $matriculas);
    }

    /**
     * Show the form for creating a new Matricula.
     *
     * @return Response
     */
    public function create()
    {
        return view('matriculas.create');
    }

    /**
     * Store a newly created Matricula in storage.
     *
     * @param CreateMatriculaRequest $request
     *
     * @return Response
     */
    public function store(CreateMatriculaRequest $request)
    {
        $input = $request->all();

        $matricula = $this->matriculaRepository->create($input);

        Flash::success('Matricula saved successfully.');

        return redirect(route('matriculas.index'));
    }

    /**
     * Display the specified Matricula.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $matricula = $this->matriculaRepository->findWithoutFail($id);

        if (empty($matricula)) {
            Flash::error('Matricula not found');

            return redirect(route('matriculas.index'));
        }

        return view('matriculas.show')->with('matricula', $matricula);
    }

    /**
     * Show the form for editing the specified Matricula.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $matricula = $this->matriculaRepository->findWithoutFail($id);

        if (empty($matricula)) {
            Flash::error('Matricula not found');

            return redirect(route('matriculas.index'));
        }

        return view('matriculas.edit')->with('matricula', $matricula);
    }

    /**
     * Update the specified Matricula in storage.
     *
     * @param  int              $id
     * @param UpdateMatriculaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMatriculaRequest $request)
    {
        $matricula = $this->matriculaRepository->findWithoutFail($id);

        if (empty($matricula)) {
            Flash::error('Matricula not found');

            return redirect(route('matriculas.index'));
        }

        $matricula = $this->matriculaRepository->update($request->all(), $id);

        Flash::success('Matricula updated successfully.');

        return redirect(route('matriculas.index'));
    }

    /**
     * Remove the specified Matricula from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $matricula = $this->matriculaRepository->findWithoutFail($id);

        if (empty($matricula)) {
            Flash::error('Matricula not found');

            return redirect(route('matriculas.index'));
        }

        $this->matriculaRepository->delete($id);

        Flash::success('Matricula deleted successfully.');

        return redirect(route('matriculas.index'));
    }
}
