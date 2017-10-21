<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoInstitucionRequest;
use App\Http\Requests\UpdateTipoInstitucionRequest;
use App\Repositories\TipoInstitucionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoInstitucionController extends AppBaseController
{
    /** @var  TipoInstitucionRepository */
    private $tipoInstitucionRepository;

    public function __construct(TipoInstitucionRepository $tipoInstitucionRepo)
    {
        $this->tipoInstitucionRepository = $tipoInstitucionRepo;
    }

    /**
     * Display a listing of the TipoInstitucion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoInstitucionRepository->pushCriteria(new RequestCriteria($request));
        $tipoInstitucions = $this->tipoInstitucionRepository->all();

        return view('tipo_institucions.index')
            ->with('tipoInstitucions', $tipoInstitucions);
    }

    /**
     * Show the form for creating a new TipoInstitucion.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipo_institucions.create');
    }

    /**
     * Store a newly created TipoInstitucion in storage.
     *
     * @param CreateTipoInstitucionRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoInstitucionRequest $request)
    {
        $input = $request->all();

        $tipoInstitucion = $this->tipoInstitucionRepository->create($input);

        Flash::success('Tipo Institucion saved successfully.');

        return redirect(route('tipoInstitucions.index'));
    }

    /**
     * Display the specified TipoInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoInstitucion = $this->tipoInstitucionRepository->findWithoutFail($id);

        if (empty($tipoInstitucion)) {
            Flash::error('Tipo Institucion not found');

            return redirect(route('tipoInstitucions.index'));
        }

        return view('tipo_institucions.show')->with('tipoInstitucion', $tipoInstitucion);
    }

    /**
     * Show the form for editing the specified TipoInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoInstitucion = $this->tipoInstitucionRepository->findWithoutFail($id);

        if (empty($tipoInstitucion)) {
            Flash::error('Tipo Institucion not found');

            return redirect(route('tipoInstitucions.index'));
        }

        return view('tipo_institucions.edit')->with('tipoInstitucion', $tipoInstitucion);
    }

    /**
     * Update the specified TipoInstitucion in storage.
     *
     * @param  int              $id
     * @param UpdateTipoInstitucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoInstitucionRequest $request)
    {
        $tipoInstitucion = $this->tipoInstitucionRepository->findWithoutFail($id);

        if (empty($tipoInstitucion)) {
            Flash::error('Tipo Institucion not found');

            return redirect(route('tipoInstitucions.index'));
        }

        $tipoInstitucion = $this->tipoInstitucionRepository->update($request->all(), $id);

        Flash::success('Tipo Institucion updated successfully.');

        return redirect(route('tipoInstitucions.index'));
    }

    /**
     * Remove the specified TipoInstitucion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoInstitucion = $this->tipoInstitucionRepository->findWithoutFail($id);

        if (empty($tipoInstitucion)) {
            Flash::error('Tipo Institucion not found');

            return redirect(route('tipoInstitucions.index'));
        }

        $this->tipoInstitucionRepository->delete($id);

        Flash::success('Tipo Institucion deleted successfully.');

        return redirect(route('tipoInstitucions.index'));
    }
}
