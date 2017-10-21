<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPasoRequest;
use App\Http\Requests\UpdateUserPasoRequest;
use App\Repositories\UserPasoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserPasoController extends AppBaseController
{
    /** @var  UserPasoRepository */
    private $userPasoRepository;

    public function __construct(UserPasoRepository $userPasoRepo)
    {
        $this->userPasoRepository = $userPasoRepo;
    }

    /**
     * Display a listing of the UserPaso.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userPasoRepository->pushCriteria(new RequestCriteria($request));
        $userPasos = $this->userPasoRepository->all();

        return view('user_pasos.index')
            ->with('userPasos', $userPasos);
    }

    /**
     * Show the form for creating a new UserPaso.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_pasos.create');
    }

    /**
     * Store a newly created UserPaso in storage.
     *
     * @param CreateUserPasoRequest $request
     *
     * @return Response
     */
    public function store(CreateUserPasoRequest $request)
    {
        $input = $request->all();

        $userPaso = $this->userPasoRepository->create($input);

        Flash::success('User Paso saved successfully.');

        return redirect(route('userPasos.index'));
    }

    /**
     * Display the specified UserPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('User Paso not found');

            return redirect(route('userPasos.index'));
        }

        return view('user_pasos.show')->with('userPaso', $userPaso);
    }

    /**
     * Show the form for editing the specified UserPaso.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('User Paso not found');

            return redirect(route('userPasos.index'));
        }

        return view('user_pasos.edit')->with('userPaso', $userPaso);
    }

    /**
     * Update the specified UserPaso in storage.
     *
     * @param  int              $id
     * @param UpdateUserPasoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserPasoRequest $request)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('User Paso not found');

            return redirect(route('userPasos.index'));
        }

        $userPaso = $this->userPasoRepository->update($request->all(), $id);

        Flash::success('User Paso updated successfully.');

        return redirect(route('userPasos.index'));
    }

    /**
     * Remove the specified UserPaso from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userPaso = $this->userPasoRepository->findWithoutFail($id);

        if (empty($userPaso)) {
            Flash::error('User Paso not found');

            return redirect(route('userPasos.index'));
        }

        $this->userPasoRepository->delete($id);

        Flash::success('User Paso deleted successfully.');

        return redirect(route('userPasos.index'));
    }
}
