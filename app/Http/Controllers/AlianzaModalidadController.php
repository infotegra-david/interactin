<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlianzaModalidadRequest;
use App\Http\Requests\UpdateAlianzaModalidadRequest;
use App\Repositories\AlianzaModalidadRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AlianzaModalidadController extends AppBaseController
{
    /** @var  AlianzaModalidadRepository */
    private $alianzaModalidadRepository;

    public function __construct(AlianzaModalidadRepository $alianzaModalidadRepo)
    {
        $this->alianzaModalidadRepository = $alianzaModalidadRepo;
    }

    /**
     * Display a listing of the AlianzaModalidad.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->alianzaModalidadRepository->pushCriteria(new RequestCriteria($request));
        $alianzaModalidads = $this->alianzaModalidadRepository->all();

        return view('alianza_modalidads.index')
            ->with('alianzaModalidads', $alianzaModalidads);
    }

    /**
     * Show the form for creating a new AlianzaModalidad.
     *
     * @return Response
     */
    public function create()
    {
        return view('alianza_modalidads.create');
    }

    /**
     * Store a newly created AlianzaModalidad in storage.
     *
     * @param CreateAlianzaModalidadRequest $request
     *
     * @return Response
     */
    public function store(CreateAlianzaModalidadRequest $request)
    {
        $input = $request->all();

        $alianzaModalidad = $this->alianzaModalidadRepository->create($input);

        Flash::success('Alianza Modalidad saved successfully.');

        return redirect(route('alianzaModalidads.index'));
    }

    /**
     * Display the specified AlianzaModalidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alianzaModalidad = $this->alianzaModalidadRepository->findWithoutFail($id);

        if (empty($alianzaModalidad)) {
            Flash::error('Alianza Modalidad not found');

            return redirect(route('alianzaModalidads.index'));
        }

        return view('alianza_modalidads.show')->with('alianzaModalidad', $alianzaModalidad);
    }

    /**
     * Show the form for editing the specified AlianzaModalidad.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alianzaModalidad = $this->alianzaModalidadRepository->findWithoutFail($id);

        if (empty($alianzaModalidad)) {
            Flash::error('Alianza Modalidad not found');

            return redirect(route('alianzaModalidads.index'));
        }

        return view('alianza_modalidads.edit')->with('alianzaModalidad', $alianzaModalidad);
    }

    /**
     * Update the specified AlianzaModalidad in storage.
     *
     * @param  int              $id
     * @param UpdateAlianzaModalidadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlianzaModalidadRequest $request)
    {
        $alianzaModalidad = $this->alianzaModalidadRepository->findWithoutFail($id);

        if (empty($alianzaModalidad)) {
            Flash::error('Alianza Modalidad not found');

            return redirect(route('alianzaModalidads.index'));
        }

        $alianzaModalidad = $this->alianzaModalidadRepository->update($request->all(), $id);

        Flash::success('Alianza Modalidad updated successfully.');

        return redirect(route('alianzaModalidads.index'));
    }

    /**
     * Remove the specified AlianzaModalidad from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alianzaModalidad = $this->alianzaModalidadRepository->findWithoutFail($id);

        if (empty($alianzaModalidad)) {
            Flash::error('Alianza Modalidad not found');

            return redirect(route('alianzaModalidads.index'));
        }

        $this->alianzaModalidadRepository->delete($id);

        Flash::success('Alianza Modalidad deleted successfully.');

        return redirect(route('alianzaModalidads.index'));
    }
}
