<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateEquivalentesRequest;
use App\Http\Requests\Admin\UpdateEquivalentesRequest;
use App\Repositories\Admin\EquivalentesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EquivalentesController extends AppBaseController
{
    /** @var  EquivalentesRepository */
    private $equivalentesRepository;

    public function __construct(EquivalentesRepository $equivalentesRepo)
    {
        $this->equivalentesRepository = $equivalentesRepo;
    }

    /**
     * Display a listing of the Equivalentes.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->equivalentesRepository->pushCriteria(new RequestCriteria($request));
        $equivalentes = $this->equivalentesRepository->all();

        return view('admin.equivalentes.index')
            ->with('equivalentes', $equivalentes);
    }

    /**
     * Show the form for creating a new Equivalentes.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.equivalentes.create');
    }

    /**
     * Store a newly created Equivalentes in storage.
     *
     * @param CreateEquivalentesRequest $request
     *
     * @return Response
     */
    public function store(CreateEquivalentesRequest $request)
    {
        $input = $request->all();

        $equivalentes = $this->equivalentesRepository->create($input);

        Flash::success('Equivalentes saved successfully.');

        return redirect(route('admin.equivalentes.index'));
    }

    /**
     * Display the specified Equivalentes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $equivalentes = $this->equivalentesRepository->findWithoutFail($id);

        if (empty($equivalentes)) {
            Flash::error('Equivalentes not found');

            return redirect(route('admin.equivalentes.index'));
        }

        return view('admin.equivalentes.show')->with('equivalentes', $equivalentes);
    }

    /**
     * Show the form for editing the specified Equivalentes.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $equivalentes = $this->equivalentesRepository->findWithoutFail($id);

        if (empty($equivalentes)) {
            Flash::error('Equivalentes not found');

            return redirect(route('admin.equivalentes.index'));
        }

        return view('admin.equivalentes.edit')->with('equivalentes', $equivalentes);
    }

    /**
     * Update the specified Equivalentes in storage.
     *
     * @param  int              $id
     * @param UpdateEquivalentesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEquivalentesRequest $request)
    {
        $equivalentes = $this->equivalentesRepository->findWithoutFail($id);

        if (empty($equivalentes)) {
            Flash::error('Equivalentes not found');

            return redirect(route('admin.equivalentes.index'));
        }

        $equivalentes = $this->equivalentesRepository->update($request->all(), $id);

        Flash::success('Equivalentes updated successfully.');

        return redirect(route('admin.equivalentes.index'));
    }

    /**
     * Remove the specified Equivalentes from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $equivalentes = $this->equivalentesRepository->findWithoutFail($id);

        if (empty($equivalentes)) {
            Flash::error('Equivalentes not found');

            return redirect(route('admin.equivalentes.index'));
        }

        $this->equivalentesRepository->delete($id);

        Flash::success('Equivalentes deleted successfully.');

        return redirect(route('admin.equivalentes.index'));
    }
}
