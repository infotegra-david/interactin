<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateUserIdiomasRequest;
use App\Http\Requests\Admin\UpdateUserIdiomasRequest;
use App\Repositories\Admin\UserIdiomasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserIdiomasController extends AppBaseController
{
    /** @var  UserIdiomasRepository */
    private $UserIdiomasRepository;

    public function __construct(UserIdiomasRepository $UserIdiomasRepo)
    {
        $this->UserIdiomasRepository = $UserIdiomasRepo;
    }

    /**
     * Display a listing of the UserIdiomas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->UserIdiomasRepository->pushCriteria(new RequestCriteria($request));
        $UserIdiomas = $this->UserIdiomasRepository->all();

        return view('admin.UserIdiomas.index')
            ->with('UserIdiomas', $UserIdiomas);
    }

    /**
     * Show the form for creating a new UserIdiomas.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.UserIdiomas.create');
    }

    /**
     * Store a newly created UserIdiomas in storage.
     *
     * @param CreateUserIdiomasRequest $request
     *
     * @return Response
     */
    public function store(CreateUserIdiomasRequest $request)
    {
        $input = $request->all();

        $UserIdiomas = $this->UserIdiomasRepository->create($input);

        Flash::success('UserIdiomas saved successfully.');

        return redirect(route('admin.UserIdiomas.index'));
    }

    /**
     * Display the specified UserIdiomas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $UserIdiomas = $this->UserIdiomasRepository->findWithoutFail($id);

        if (empty($UserIdiomas)) {
            Flash::error('UserIdiomas not found');

            return redirect(route('admin.UserIdiomas.index'));
        }

        return view('admin.UserIdiomas.show')->with('UserIdiomas', $UserIdiomas);
    }

    /**
     * Show the form for editing the specified UserIdiomas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $UserIdiomas = $this->UserIdiomasRepository->findWithoutFail($id);

        if (empty($UserIdiomas)) {
            Flash::error('UserIdiomas not found');

            return redirect(route('admin.UserIdiomas.index'));
        }

        return view('admin.UserIdiomas.edit')->with('UserIdiomas', $UserIdiomas);
    }

    /**
     * Update the specified UserIdiomas in storage.
     *
     * @param  int              $id
     * @param UpdateUserIdiomasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserIdiomasRequest $request)
    {
        $UserIdiomas = $this->UserIdiomasRepository->findWithoutFail($id);

        if (empty($UserIdiomas)) {
            Flash::error('UserIdiomas not found');

            return redirect(route('admin.UserIdiomas.index'));
        }

        $UserIdiomas = $this->UserIdiomasRepository->update($request->all(), $id);

        Flash::success('UserIdiomas updated successfully.');

        return redirect(route('admin.UserIdiomas.index'));
    }

    /**
     * Remove the specified UserIdiomas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $UserIdiomas = $this->UserIdiomasRepository->findWithoutFail($id);

        if (empty($UserIdiomas)) {
            Flash::error('UserIdiomas not found');

            return redirect(route('admin.UserIdiomas.index'));
        }

        $this->UserIdiomasRepository->delete($id);

        Flash::success('UserIdiomas deleted successfully.');

        return redirect(route('admin.UserIdiomas.index'));
    }
}
