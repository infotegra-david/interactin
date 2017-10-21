<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentosAlianzaRequest;
use App\Http\Requests\UpdateDocumentosAlianzaRequest;
use App\Repositories\DocumentosAlianzaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DocumentosAlianzaController extends AppBaseController
{
    /** @var  DocumentosAlianzaRepository */
    private $documentosAlianzaRepository;

    public function __construct(DocumentosAlianzaRepository $documentosAlianzaRepo)
    {
        $this->documentosAlianzaRepository = $documentosAlianzaRepo;
    }

    /**
     * Display a listing of the DocumentosAlianza.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentosAlianzaRepository->pushCriteria(new RequestCriteria($request));
        $documentosAlianzas = $this->documentosAlianzaRepository->all();

        return view('documentos_alianzas.index')
            ->with('documentosAlianzas', $documentosAlianzas);
    }

    /**
     * Show the form for creating a new DocumentosAlianza.
     *
     * @return Response
     */
    public function create()
    {
        return view('documentos_alianzas.create');
    }

    /**
     * Store a newly created DocumentosAlianza in storage.
     *
     * @param CreateDocumentosAlianzaRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentosAlianzaRequest $request)
    {
        $input = $request->all();

        $documentosAlianza = $this->documentosAlianzaRepository->create($input);

        Flash::success('Documentos Alianza saved successfully.');

        return redirect(route('documentosAlianzas.index'));
    }

    /**
     * Display the specified DocumentosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $documentosAlianza = $this->documentosAlianzaRepository->findWithoutFail($id);

        if (empty($documentosAlianza)) {
            Flash::error('Documentos Alianza not found');

            return redirect(route('documentosAlianzas.index'));
        }

        return view('documentos_alianzas.show')->with('documentosAlianza', $documentosAlianza);
    }

    /**
     * Show the form for editing the specified DocumentosAlianza.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $documentosAlianza = $this->documentosAlianzaRepository->findWithoutFail($id);

        if (empty($documentosAlianza)) {
            Flash::error('Documentos Alianza not found');

            return redirect(route('documentosAlianzas.index'));
        }

        return view('documentos_alianzas.edit')->with('documentosAlianza', $documentosAlianza);
    }

    /**
     * Update the specified DocumentosAlianza in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentosAlianzaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentosAlianzaRequest $request)
    {
        $documentosAlianza = $this->documentosAlianzaRepository->findWithoutFail($id);

        if (empty($documentosAlianza)) {
            Flash::error('Documentos Alianza not found');

            return redirect(route('documentosAlianzas.index'));
        }

        $documentosAlianza = $this->documentosAlianzaRepository->update($request->all(), $id);

        Flash::success('Documentos Alianza updated successfully.');

        return redirect(route('documentosAlianzas.index'));
    }

    /**
     * Remove the specified DocumentosAlianza from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $documentosAlianza = $this->documentosAlianzaRepository->findWithoutFail($id);

        if (empty($documentosAlianza)) {
            Flash::error('Documentos Alianza not found');

            return redirect(route('documentosAlianzas.index'));
        }

        $this->documentosAlianzaRepository->delete($id);

        Flash::success('Documentos Alianza deleted successfully.');

        return redirect(route('documentosAlianzas.index'));
    }
}
