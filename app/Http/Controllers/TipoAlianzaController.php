<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoAlianzaRequest;
use App\Http\Requests\UpdateTipoAlianzaRequest;
use App\Repositories\TipoAlianzaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoAlianzaController extends AppBaseController
{
    /** @var  TipoAlianzaRepository */
    private $tipoAlianzaRepository;

    public function __construct(TipoAlianzaRepository $tipoAlianzaRepo)
    {
        $this->tipoAlianzaRepository = $tipoAlianzaRepo;
    }

    /**
     * Display a listing of the TipoAlianza.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoAlianzaRepository->pushCriteria(new RequestCriteria($request));
        $tipoAlianzas = $this->tipoAlianzaRepository->all();

        return view('tipo_alianzas.index')
            ->with('tipoAlianzas', $tipoAlianzas);
    }

    /**
     * Show the form for creating a new TipoAlianza.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_alianzas.create');
    }

    /**
     * Store a newly created TipoAlianza in storage.
     *
     * @param CreateTipoAlianzaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoAlianzaRequest $request)
    {
        $input = $request->all();

        $tipoAlianza = $this->tipoAlianzaRepository->create($input);

        Flash::success('Tipo Alianza saved successfully.');

        return redirect(route('tipoAlianzas.index'));
    }

    /**
     * Display the specified TipoAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoAlianza = $this->tipoAlianzaRepository->findWithoutFail($id);

        if (empty($tipoAlianza)) {
            Flash::error('Tipo Alianza not found');

            return redirect(route('tipoAlianzas.index'));
        }

        return view('tipo_alianzas.show')->with('tipoAlianza', $tipoAlianza);
    }

    /**
     * Show the form for editing the specified TipoAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoAlianza = $this->tipoAlianzaRepository->findWithoutFail($id);

        if (empty($tipoAlianza)) {
            Flash::error('Tipo Alianza not found');

            return redirect(route('tipoAlianzas.index'));
        }

        return view('tipo_alianzas.edit')->with('tipoAlianza', $tipoAlianza);
    }

    /**
     * Update the specified TipoAlianza in storage.
     *
     * @param  int              $id
     * @param UpdateTipoAlianzaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoAlianzaRequest $request)
    {
        $tipoAlianza = $this->tipoAlianzaRepository->findWithoutFail($id);

        if (empty($tipoAlianza)) {
            Flash::error('Tipo Alianza not found');

            return redirect(route('tipoAlianzas.index'));
        }

        $tipoAlianza = $this->tipoAlianzaRepository->update($request->all(), $id);

        Flash::success('Tipo Alianza updated successfully.');

        return redirect(route('tipoAlianzas.index'));
    }

    /**
     * Remove the specified TipoAlianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoAlianza = $this->tipoAlianzaRepository->findWithoutFail($id);

        if (empty($tipoAlianza)) {
            Flash::error('Tipo Alianza not found');

            return redirect(route('tipoAlianzas.index'));
        }

        $this->tipoAlianzaRepository->delete($id);

        Flash::success('Tipo Alianza deleted successfully.');

        return redirect(route('tipoAlianzas.index'));
    }
}
