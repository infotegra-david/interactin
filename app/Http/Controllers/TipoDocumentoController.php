<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoDocumentoRequest;
use App\Http\Requests\UpdateTipoDocumentoRequest;
use App\Repositories\TipoDocumentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoDocumentoController extends AppBaseController
{
    /** @var  TipoDocumentoRepository */
    private $tipoDocumentoRepository;

    public function __construct(TipoDocumentoRepository $tipoDocumentoRepo)
    {
        $this->tipoDocumentoRepository = $tipoDocumentoRepo;
    }

    /**
     * Display a listing of the TipoDocumento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoDocumentoRepository->pushCriteria(new RequestCriteria($request));
        $tipoDocumentos = $this->tipoDocumentoRepository->all();

        return view('tipo_documentos.index')
            ->with('tipoDocumentos', $tipoDocumentos);
    }

    /**
     * Show the form for creating a new TipoDocumento.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_documentos.create');
    }

    /**
     * Store a newly created TipoDocumento in storage.
     *
     * @param CreateTipoDocumentoRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoDocumentoRequest $request)
    {
        $input = $request->all();

        $tipoDocumento = $this->tipoDocumentoRepository->create($input);

        Flash::success('Tipo Documento saved successfully.');

        return redirect(route('tipoDocumentos.index'));
    }

    /**
     * Display the specified TipoDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoDocumento = $this->tipoDocumentoRepository->findWithoutFail($id);

        if (empty($tipoDocumento)) {
            Flash::error('Tipo Documento not found');

            return redirect(route('tipoDocumentos.index'));
        }

        return view('tipo_documentos.show')->with('tipoDocumento', $tipoDocumento);
    }

    /**
     * Show the form for editing the specified TipoDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoDocumento = $this->tipoDocumentoRepository->findWithoutFail($id);

        if (empty($tipoDocumento)) {
            Flash::error('Tipo Documento not found');

            return redirect(route('tipoDocumentos.index'));
        }

        return view('tipo_documentos.edit')->with('tipoDocumento', $tipoDocumento);
    }

    /**
     * Update the specified TipoDocumento in storage.
     *
     * @param  int              $id
     * @param UpdateTipoDocumentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoDocumentoRequest $request)
    {
        $tipoDocumento = $this->tipoDocumentoRepository->findWithoutFail($id);

        if (empty($tipoDocumento)) {
            Flash::error('Tipo Documento not found');

            return redirect(route('tipoDocumentos.index'));
        }

        $tipoDocumento = $this->tipoDocumentoRepository->update($request->all(), $id);

        Flash::success('Tipo Documento updated successfully.');

        return redirect(route('tipoDocumentos.index'));
    }

    /**
     * Remove the specified TipoDocumento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoDocumento = $this->tipoDocumentoRepository->findWithoutFail($id);

        if (empty($tipoDocumento)) {
            Flash::error('Tipo Documento not found');

            return redirect(route('tipoDocumentos.index'));
        }

        $this->tipoDocumentoRepository->delete($id);

        Flash::success('Tipo Documento deleted successfully.');

        return redirect(route('tipoDocumentos.index'));
    }
}
