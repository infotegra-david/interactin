<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDocumentosInscripcionRequest;
use App\Http\Requests\UpdateDocumentosInscripcionRequest;
use App\Repositories\DocumentosInscripcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DocumentosInscripcionController extends AppBaseController
{
    /** @var  DocumentosInscripcionRepository */
    private $documentosInscripcionRepository;

    public function __construct(DocumentosInscripcionRepository $documentosInscripcionRepo)
    {
        $this->documentosInscripcionRepository = $documentosInscripcionRepo;
    }

    /**
     * Display a listing of the DocumentosInscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentosInscripcionRepository->pushCriteria(new RequestCriteria($request));
        $documentosInscripcion = $this->documentosInscripcionRepository->all();

        return view('documentos_inscripcion.index')
            ->with('documentosInscripcion', $documentosInscripcion);
    }

    /**
     * Show the form for creating a new DocumentosInscripcion.
     *
     * @return Response
     */
    public function create()
    {
        return view('documentos_inscripcion.create');
    }

    /**
     * Store a newly created DocumentosInscripcion in storage.
     *
     * @param CreateDocumentosInscripcionRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentosInscripcionRequest $request)
    {
        $input = $request->all();

        $documentosInscripcion = $this->documentosInscripcionRepository->create($input);

        Flash::success('Documentos Inscripcion saved successfully.');

        return redirect(route('documentosInscripcion.index'));
    }

    /**
     * Display the specified DocumentosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $documentosInscripcion = $this->documentosInscripcionRepository->findWithoutFail($id);

        if (empty($documentosInscripcion)) {
            Flash::error('Documentos Inscripcion not found');

            return redirect(route('documentosInscripcion.index'));
        }

        return view('documentos_inscripcion.show')->with('documentosInscripcion', $documentosInscripcion);
    }

    /**
     * Show the form for editing the specified DocumentosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $documentosInscripcion = $this->documentosInscripcionRepository->findWithoutFail($id);

        if (empty($documentosInscripcion)) {
            Flash::error('Documentos Inscripcion not found');

            return redirect(route('documentosInscripcion.index'));
        }

        return view('documentos_inscripcion.edit')->with('documentosInscripcion', $documentosInscripcion);
    }

    /**
     * Update the specified DocumentosInscripcion in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentosInscripcionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentosInscripcionRequest $request)
    {
        $documentosInscripcion = $this->documentosInscripcionRepository->findWithoutFail($id);

        if (empty($documentosInscripcion)) {
            Flash::error('Documentos Inscripcion not found');

            return redirect(route('documentosInscripcion.index'));
        }

        $documentosInscripcion = $this->documentosInscripcionRepository->update($request->all(), $id);

        Flash::success('Documentos Inscripcion updated successfully.');

        return redirect(route('documentosInscripcion.index'));
    }

    /**
     * Remove the specified DocumentosInscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $documentosInscripcion = $this->documentosInscripcionRepository->findWithoutFail($id);

        if (empty($documentosInscripcion)) {
            Flash::error('Documentos Inscripcion not found');

            return redirect(route('documentosInscripcion.index'));
        }

        $this->documentosInscripcionRepository->delete($id);

        Flash::success('Documentos Inscripcion deleted successfully.');

        return redirect(route('documentosInscripcion.index'));
    }
}
