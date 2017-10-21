<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClaseDocumentoRequest;
use App\Http\Requests\UpdateClaseDocumentoRequest;
use App\Repositories\ClaseDocumentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ClaseDocumentoController extends AppBaseController
{
    /** @var  ClaseDocumentoRepository */
    private $claseDocumentoRepository;

    public function __construct(ClaseDocumentoRepository $claseDocumentoRepo)
    {
        $this->claseDocumentoRepository = $claseDocumentoRepo;
    }

    /**
     * Display a listing of the ClaseDocumento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->claseDocumentoRepository->pushCriteria(new RequestCriteria($request));
        $claseDocumentos = $this->claseDocumentoRepository->all();

        return view('clase_documentos.index')
            ->with('claseDocumentos', $claseDocumentos);
    }

    /**
     * Show the form for creating a new ClaseDocumento.
     *
     * @return Response
     */
    public function create()
    {
        return view('clase_documentos.create');
    }

    /**
     * Store a newly created ClaseDocumento in storage.
     *
     * @param CreateClaseDocumentoRequest $request
     *
     * @return Response
     */
    public function store(CreateClaseDocumentoRequest $request)
    {
        $input = $request->all();

        $claseDocumento = $this->claseDocumentoRepository->create($input);

        Flash::success('Clase Documento saved successfully.');

        return redirect(route('claseDocumentos.index'));
    }

    /**
     * Display the specified ClaseDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $claseDocumento = $this->claseDocumentoRepository->findWithoutFail($id);

        if (empty($claseDocumento)) {
            Flash::error('Clase Documento not found');

            return redirect(route('claseDocumentos.index'));
        }

        return view('clase_documentos.show')->with('claseDocumento', $claseDocumento);
    }

    /**
     * Show the form for editing the specified ClaseDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $claseDocumento = $this->claseDocumentoRepository->findWithoutFail($id);

        if (empty($claseDocumento)) {
            Flash::error('Clase Documento not found');

            return redirect(route('claseDocumentos.index'));
        }

        return view('clase_documentos.edit')->with('claseDocumento', $claseDocumento);
    }

    /**
     * Update the specified ClaseDocumento in storage.
     *
     * @param  int              $id
     * @param UpdateClaseDocumentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClaseDocumentoRequest $request)
    {
        $claseDocumento = $this->claseDocumentoRepository->findWithoutFail($id);

        if (empty($claseDocumento)) {
            Flash::error('Clase Documento not found');

            return redirect(route('claseDocumentos.index'));
        }

        $claseDocumento = $this->claseDocumentoRepository->update($request->all(), $id);

        Flash::success('Clase Documento updated successfully.');

        return redirect(route('claseDocumentos.index'));
    }

    /**
     * Remove the specified ClaseDocumento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $claseDocumento = $this->claseDocumentoRepository->findWithoutFail($id);

        if (empty($claseDocumento)) {
            Flash::error('Clase Documento not found');

            return redirect(route('claseDocumentos.index'));
        }

        $this->claseDocumentoRepository->delete($id);

        Flash::success('Clase Documento deleted successfully.');

        return redirect(route('claseDocumentos.index'));
    }
}
