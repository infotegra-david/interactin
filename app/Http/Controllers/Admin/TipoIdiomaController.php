<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateTipoIdiomaRequest;
use App\Http\Requests\Admin\UpdateTipoIdiomaRequest;
use App\Repositories\Admin\TipoIdiomaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TipoIdiomaController extends AppBaseController
{
    /** @var  TipoIdiomaRepository */
    private $tipoIdiomaRepository;

    public function __construct(TipoIdiomaRepository $tipoIdiomaRepo)
    {
        $this->tipoIdiomaRepository = $tipoIdiomaRepo;
    }

    /**
     * Display a listing of the TipoIdioma.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tipoIdiomaRepository->pushCriteria(new RequestCriteria($request));
        $tipoIdiomas = $this->tipoIdiomaRepository->all();

        return view('admin.tipo_idiomas.index')
            ->with('tipoIdiomas', $tipoIdiomas);
    }

    /**
     * Show the form for creating a new TipoIdioma.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tipo_idiomas.create');
    }

    /**
     * Store a newly created TipoIdioma in storage.
     *
     * @param CreateTipoIdiomaRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoIdiomaRequest $request)
    {
        $input = $request->all();

        $tipoIdioma = $this->tipoIdiomaRepository->create($input);

        Flash::success('Tipo Idioma saved successfully.');

        return redirect(route('admin.tipoIdiomas.index'));
    }

    /**
     * Display the specified TipoIdioma.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoIdioma = $this->tipoIdiomaRepository->findWithoutFail($id);

        if (empty($tipoIdioma)) {
            Flash::error('Tipo Idioma not found');

            return redirect(route('admin.tipoIdiomas.index'));
        }

        return view('admin.tipo_idiomas.show')->with('tipoIdioma', $tipoIdioma);
    }

    /**
     * Show the form for editing the specified TipoIdioma.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoIdioma = $this->tipoIdiomaRepository->findWithoutFail($id);

        if (empty($tipoIdioma)) {
            Flash::error('Tipo Idioma not found');

            return redirect(route('admin.tipoIdiomas.index'));
        }

        return view('admin.tipo_idiomas.edit')->with('tipoIdioma', $tipoIdioma);
    }

    /**
     * Update the specified TipoIdioma in storage.
     *
     * @param  int              $id
     * @param UpdateTipoIdiomaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoIdiomaRequest $request)
    {
        $tipoIdioma = $this->tipoIdiomaRepository->findWithoutFail($id);

        if (empty($tipoIdioma)) {
            Flash::error('Tipo Idioma not found');

            return redirect(route('admin.tipoIdiomas.index'));
        }

        $tipoIdioma = $this->tipoIdiomaRepository->update($request->all(), $id);

        Flash::success('Tipo Idioma updated successfully.');

        return redirect(route('admin.tipoIdiomas.index'));
    }

    /**
     * Remove the specified TipoIdioma from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoIdioma = $this->tipoIdiomaRepository->findWithoutFail($id);

        if (empty($tipoIdioma)) {
            Flash::error('Tipo Idioma not found');

            return redirect(route('admin.tipoIdiomas.index'));
        }

        $this->tipoIdiomaRepository->delete($id);

        Flash::success('Tipo Idioma deleted successfully.');

        return redirect(route('admin.tipoIdiomas.index'));
    }
}
