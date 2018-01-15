<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateNivelRequest;
use App\Http\Requests\Admin\UpdateNivelRequest;
use App\Repositories\Admin\NivelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class NivelController extends AppBaseController
{
    /** @var  NivelRepository */
    private $nivelRepository;

    public function __construct(NivelRepository $nivelRepo)
    {
        $this->nivelRepository = $nivelRepo;
    }

    /**
     * Display a listing of the Nivel.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->nivelRepository->pushCriteria(new RequestCriteria($request));
        $nivels = $this->nivelRepository->all();

        return view('admin.nivels.index')
            ->with('nivels', $nivels);
    }

    /**
     * Show the form for creating a new Nivel.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.nivels.create');
    }

    /**
     * Store a newly created Nivel in storage.
     *
     * @param CreateNivelRequest $request
     *
     * @return Response
     */
    public function store(CreateNivelRequest $request)
    {
        $input = $request->all();

        $nivel = $this->nivelRepository->create($input);

        Flash::success('Nivel saved successfully.');

        return redirect(route('admin.nivels.index'));
    }

    /**
     * Display the specified Nivel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nivel = $this->nivelRepository->findWithoutFail($id);

        if (empty($nivel)) {
            Flash::error('Nivel not found');

            return redirect(route('admin.nivels.index'));
        }

        return view('admin.nivels.show')->with('nivel', $nivel);
    }

    /**
     * Show the form for editing the specified Nivel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nivel = $this->nivelRepository->findWithoutFail($id);

        if (empty($nivel)) {
            Flash::error('Nivel not found');

            return redirect(route('admin.nivels.index'));
        }

        return view('admin.nivels.edit')->with('nivel', $nivel);
    }

    /**
     * Update the specified Nivel in storage.
     *
     * @param  int              $id
     * @param UpdateNivelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNivelRequest $request)
    {
        $nivel = $this->nivelRepository->findWithoutFail($id);

        if (empty($nivel)) {
            Flash::error('Nivel not found');

            return redirect(route('admin.nivels.index'));
        }

        $nivel = $this->nivelRepository->update($request->all(), $id);

        Flash::success('Nivel updated successfully.');

        return redirect(route('admin.nivels.index'));
    }

    /**
     * Remove the specified Nivel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $nivel = $this->nivelRepository->findWithoutFail($id);

        if (empty($nivel)) {
            Flash::error('Nivel not found');

            return redirect(route('admin.nivels.index'));
        }

        $this->nivelRepository->delete($id);

        Flash::success('Nivel deleted successfully.');

        return redirect(route('admin.nivels.index'));
    }
}
