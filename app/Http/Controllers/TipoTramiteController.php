<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoTramiteRequest;
use App\Http\Requests\UpdateTipoTramiteRequest;
use App\Repositories\TipoTramiteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoTramiteController extends AppBaseController
{
    /** @var  TipoTramiteRepository */
    private $tipoTramiteRepository;

    public function __construct(TipoTramiteRepository $tipoTramiteRepo)
    {
        $this->tipoTramiteRepository = $tipoTramiteRepo;
    }

    /**
     * Display a listing of the TipoTramite.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoTramiteRepository->pushCriteria(new RequestCriteria($request));
        $tipoTramites = $this->tipoTramiteRepository->all();

        return view('tipo_tramites.index')
            ->with('tipoTramites', $tipoTramites);
    }

    /**
     * Show the form for creating a new TipoTramite.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_tramites.create');
    }

    /**
     * Store a newly created TipoTramite in storage.
     *
     * @param CreateTipoTramiteRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoTramiteRequest $request)
    {
        $input = $request->all();

        $tipoTramite = $this->tipoTramiteRepository->create($input);

        Flash::success('Tipo Tramite saved successfully.');

        return redirect(route('tipoTramites.index'));
    }

    /**
     * Display the specified TipoTramite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoTramite = $this->tipoTramiteRepository->findWithoutFail($id);

        if (empty($tipoTramite)) {
            Flash::error('Tipo Tramite not found');

            return redirect(route('tipoTramites.index'));
        }

        return view('tipo_tramites.show')->with('tipoTramite', $tipoTramite);
    }

    /**
     * Show the form for editing the specified TipoTramite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoTramite = $this->tipoTramiteRepository->findWithoutFail($id);

        if (empty($tipoTramite)) {
            Flash::error('Tipo Tramite not found');

            return redirect(route('tipoTramites.index'));
        }

        return view('tipo_tramites.edit')->with('tipoTramite', $tipoTramite);
    }

    /**
     * Update the specified TipoTramite in storage.
     *
     * @param  int              $id
     * @param UpdateTipoTramiteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoTramiteRequest $request)
    {
        $tipoTramite = $this->tipoTramiteRepository->findWithoutFail($id);

        if (empty($tipoTramite)) {
            Flash::error('Tipo Tramite not found');

            return redirect(route('tipoTramites.index'));
        }

        $tipoTramite = $this->tipoTramiteRepository->update($request->all(), $id);

        Flash::success('Tipo Tramite updated successfully.');

        return redirect(route('tipoTramites.index'));
    }

    /**
     * Remove the specified TipoTramite from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoTramite = $this->tipoTramiteRepository->findWithoutFail($id);

        if (empty($tipoTramite)) {
            Flash::error('Tipo Tramite not found');

            return redirect(route('tipoTramites.index'));
        }

        $this->tipoTramiteRepository->delete($id);

        Flash::success('Tipo Tramite deleted successfully.');

        return redirect(route('tipoTramites.index'));
    }
}
