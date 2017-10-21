<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlianzaInstitucionRequest;
use App\Http\Requests\UpdateAlianzaInstitucionRequest;
use App\Repositories\AlianzaInstitucionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AlianzaInstitucionController extends AppBaseController
{
    /** @var  AlianzaInstitucionRepository */
    private $alianzaInstitucionRepository;

    public function __construct(AlianzaInstitucionRepository $alianzaInstitucionRepo)
    {
        $this->alianzaInstitucionRepository = $alianzaInstitucionRepo;
    }

    /**
     * Display a listing of the AlianzaInstitucion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->alianzaInstitucionRepository->pushCriteria(new RequestCriteria($request));
        $alianzaInstitucions = $this->alianzaInstitucionRepository->all();

        return view('alianza_institucions.index')
            ->with('alianzaInstitucions', $alianzaInstitucions);
    }

    /**
     * Show the form for creating a new AlianzaInstitucion.
     *
     * @return Response
     */
    public function create()
    {
        return view('alianza_institucions.create');
    }

    /**
     * Store a newly created AlianzaInstitucion in storage.
     *
     * @param CreateAlianzaInstitucionRequest $request
     *
     * @return Response
     */
    public function store(CreateAlianzaInstitucionRequest $request)
    {
        $input = $request->all();

        $alianzaInstitucion = $this->alianzaInstitucionRepository->create($input);

        Flash::success('Alianza Institucion saved successfully.');

        return redirect(route('alianzaInstitucions.index'));
    }

    /**
     * Display the specified AlianzaInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alianzaInstitucion = $this->alianzaInstitucionRepository->findWithoutFail($id);

        if (empty($alianzaInstitucion)) {
            Flash::error('Alianza Institucion not found');

            return redirect(route('alianzaInstitucions.index'));
        }

        return view('alianza_institucions.show')->with('alianzaInstitucion', $alianzaInstitucion);
    }

    /**
     * Show the form for editing the specified AlianzaInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alianzaInstitucion = $this->alianzaInstitucionRepository->findWithoutFail($id);

        if (empty($alianzaInstitucion)) {
            Flash::error('Alianza Institucion not found');

            return redirect(route('alianzaInstitucions.index'));
        }

        return view('alianza_institucions.edit')->with('alianzaInstitucion', $alianzaInstitucion);
    }

    /**
     * Update the specified AlianzaInstitucion in storage.
     *
     * @param  int              $id
     * @param UpdateAlianzaInstitucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAlianzaInstitucionRequest $request)
    {
        $alianzaInstitucion = $this->alianzaInstitucionRepository->findWithoutFail($id);

        if (empty($alianzaInstitucion)) {
            Flash::error('Alianza Institucion not found');

            return redirect(route('alianzaInstitucions.index'));
        }

        $alianzaInstitucion = $this->alianzaInstitucionRepository->update($request->all(), $id);

        Flash::success('Alianza Institucion updated successfully.');

        return redirect(route('alianzaInstitucions.index'));
    }

    /**
     * Remove the specified AlianzaInstitucion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alianzaInstitucion = $this->alianzaInstitucionRepository->findWithoutFail($id);

        if (empty($alianzaInstitucion)) {
            Flash::error('Alianza Institucion not found');

            return redirect(route('alianzaInstitucions.index'));
        }

        $this->alianzaInstitucionRepository->delete($id);

        Flash::success('Alianza Institucion deleted successfully.');

        return redirect(route('alianzaInstitucions.index'));
    }
}
