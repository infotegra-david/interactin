<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParentescoRequest;
use App\Http\Requests\UpdateParentescoRequest;
use App\Repositories\ParentescoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ParentescoController extends AppBaseController
{
    /** @var  ParentescoRepository */
    private $parentescoRepository;

    public function __construct(ParentescoRepository $parentescoRepo)
    {
        $this->parentescoRepository = $parentescoRepo;
    }

    /**
     * Display a listing of the Parentesco.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->parentescoRepository->pushCriteria(new RequestCriteria($request));
        $parentescos = $this->parentescoRepository->all();

        return view('parentescos.index')
            ->with('parentescos', $parentescos);
    }

    /**
     * Show the form for creating a new Parentesco.
     *
     * @return Response
     */
    public function create()
    {
        return view('parentescos.create');
    }

    /**
     * Store a newly created Parentesco in storage.
     *
     * @param CreateParentescoRequest $request
     *
     * @return Response
     */
    public function store(CreateParentescoRequest $request)
    {
        $input = $request->all();

        $parentesco = $this->parentescoRepository->create($input);

        Flash::success('Parentesco saved successfully.');

        return redirect(route('parentescos.index'));
    }

    /**
     * Display the specified Parentesco.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $parentesco = $this->parentescoRepository->findWithoutFail($id);

        if (empty($parentesco)) {
            Flash::error('Parentesco not found');

            return redirect(route('parentescos.index'));
        }

        return view('parentescos.show')->with('parentesco', $parentesco);
    }

    /**
     * Show the form for editing the specified Parentesco.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $parentesco = $this->parentescoRepository->findWithoutFail($id);

        if (empty($parentesco)) {
            Flash::error('Parentesco not found');

            return redirect(route('parentescos.index'));
        }

        return view('parentescos.edit')->with('parentesco', $parentesco);
    }

    /**
     * Update the specified Parentesco in storage.
     *
     * @param  int              $id
     * @param UpdateParentescoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParentescoRequest $request)
    {
        $parentesco = $this->parentescoRepository->findWithoutFail($id);

        if (empty($parentesco)) {
            Flash::error('Parentesco not found');

            return redirect(route('parentescos.index'));
        }

        $parentesco = $this->parentescoRepository->update($request->all(), $id);

        Flash::success('Parentesco updated successfully.');

        return redirect(route('parentescos.index'));
    }

    /**
     * Remove the specified Parentesco from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $parentesco = $this->parentescoRepository->findWithoutFail($id);

        if (empty($parentesco)) {
            Flash::error('Parentesco not found');

            return redirect(route('parentescos.index'));
        }

        $this->parentescoRepository->delete($id);

        Flash::success('Parentesco deleted successfully.');

        return redirect(route('parentescos.index'));
    }
}
