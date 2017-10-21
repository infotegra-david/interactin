<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateProgramaRequest;
use App\Http\Requests\Admin\UpdateProgramaRequest;
use App\Repositories\Admin\ProgramaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProgramaController extends AppBaseController
{
    /** @var  ProgramaRepository */
    private $programaRepository;

    public function __construct(ProgramaRepository $programaRepo)
    {
        $this->programaRepository = $programaRepo;
    }

    /**
     * Display a listing of the Programa.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->programaRepository->pushCriteria(new RequestCriteria($request));
        $programas = $this->programaRepository->all();

        return view('admin.programas.index')
            ->with('programas', $programas);
    }

    /**
     * Show the form for creating a new Programa.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.programas.create');
    }

    /**
     * Store a newly created Programa in storage.
     *
     * @param CreateProgramaRequest $request
     *
     * @return Response
     */
    public function store(CreateProgramaRequest $request)
    {
        $input = $request->all();

        $programa = $this->programaRepository->create($input);

        Flash::success('Programa saved successfully.');

        return redirect(route('admin.programs.index'));
    }

    /**
     * Display the specified Programa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $programa = $this->programaRepository->findWithoutFail($id);

        if (empty($programa)) {
            Flash::error('Programa not found');

            return redirect(route('admin.programs.index'));
        }

        return view('admin.programas.show')->with('programa', $programa);
    }

    /**
     * Show the form for editing the specified Programa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $programa = $this->programaRepository->findWithoutFail($id);

        if (empty($programa)) {
            Flash::error('Programa not found');

            return redirect(route('admin.programs.index'));
        }

        return view('admin.programas.edit')->with('programa', $programa);
    }

    /**
     * Update the specified Programa in storage.
     *
     * @param  int              $id
     * @param UpdateProgramaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProgramaRequest $request)
    {
        $programa = $this->programaRepository->findWithoutFail($id);

        if (empty($programa)) {
            Flash::error('Programa not found');

            return redirect(route('admin.programs.index'));
        }

        $programa = $this->programaRepository->update($request->all(), $id);

        Flash::success('Programa updated successfully.');

        return redirect(route('admin.programs.index'));
    }

    /**
     * Remove the specified Programa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $programa = $this->programaRepository->findWithoutFail($id);

        if (empty($programa)) {
            Flash::error('Programa not found');

            return redirect(route('admin.programs.index'));
        }

        $this->programaRepository->delete($id);

        Flash::success('Programa deleted successfully.');

        return redirect(route('admin.programs.index'));
    }



    /**
     * Lista los registros segun el id pasado por parametro.
     *
     * @param  int 
     *
     * @return Response
     */
    public function listPrograms(Request $request)
    {
        $facultad_id = $request->id;
        $programas = $this->programaRepository->listPrograms($facultad_id);
        return response()->json($programas);
    }
}
