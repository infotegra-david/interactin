<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Repositories\EmailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class EmailController extends AppBaseController
{
    use Authorizable;
    /** @var  EmailRepository */
    private $emailRepository;

    private $user;
    private $campusApp;
    private $campusAppFound;
    private $campusUser;
    private $tipoRuta;
    private $route_split;
    private $routeLists;
    private $proceso;
    private $peticion;
    private $viewWith = [];

    public function __construct(EmailRepository $emailRepo, Request $request)
    {
        

        $this->middleware(function ($request, $next) {
            if (Auth::user()) {
                $this->user = Auth::user();
                if (isset($this->user->campus)) {
                    $this->campusApp = $this->user->campus;
                    if (session('campusApp') == null) {
                        session(['campusApp' => ($this->campusApp->first()->id ?? 0 ) ]);
                        session(['campusAppNombre' => ($this->campusApp->first()->nombre ?? 'No pertenece a alguna institución.' )]);
                        session(['institucionAppNombre' => ($this->campusApp->first()->institucion->nombre ?? 'Sin institución.' )]);
                    }
                    if (count($this->campusApp)) {
                        $this->campusApp = $this->campusApp->pluck('nombre','id');
                    }else{
                        $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                    }
                }else{
                    $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                }
            }

            if( session('campusApp') != null && session('campusApp') != 0 ){
                $campusAppId = session('campusApp');
            }else{
                return redirect(route('home'));
            }
            if ( Auth::user() !== NULL) {
                $this->campusAppFound = \App\Models\Admin\Campus::find($campusAppId);
                if( !count($this->campusAppFound) ){
                    Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                    return redirect(route('home'));
                }
            }

            $this->viewWith = array_merge($this->viewWith,['campusApp' => $this->campusApp]);

            return $next($request);
        });


        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();
        if (!empty($name) ) {
            $this->tipoRuta = $name;
            $this->route_split = substr($name, 0,strrpos($name, "."));
            $this->proceso = substr($name, 0,strpos($name, "."));
            $this->routeLists = route($this->proceso.'.emails_'.$this->proceso.'.lists');
        }

//esta validacion puede ser obsoleta, no parece que llegue a entrar
        if (empty($this->campusApp)) {
            $this->user = Auth::user();
            // print_r($this->user);
            if (isset($this->user->campus)) {
                $this->campusApp = $this->user->campus;
            }else{
                $this->campusApp = \App\Models\Admin\Campus::where('institucion_id',\Config::get('options.institucion_id'));
            }
        }

        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        $this->emailRepository = $emailRepo;

        $this->viewWith = array_merge($this->viewWith,['route_split' => $this->route_split]);
    }

    /**
     * Display a listing of the Email.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->emailRepository->pushCriteria(new RequestCriteria($request));
        $emails = $this->emailRepository->paginate(10);

        $this->viewWith = array_merge($this->viewWith,['emails' => $emails]);

        return view('emails.index')
            ->with($this->viewWith);
    }

    /**
     * Show the form for creating a new Email.
     *
     * @return Response
     */
    public function create()
    {
        return view('emails.create')
            ->with($this->viewWith);
    }

    /**
     * Store a newly created Email in storage.
     *
     * @param CreateEmailRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailRequest $request)
    {
        $input = $request->all();

        $email = $this->emailRepository->create($input);

        Flash::success('Email saved successfully.');

        return redirect(route('emails.index'));
    }

    /**
     * Store a newly created Email in storage.
     *
     * @param CreateEmailRequest $request
     *
     * @return Response
     */
    public function storeUpdate(CreateEmailRequest $request)
    {
        $input = $request->all();

        $email = $this->emailRepository->create($input);

        Flash::success('Email saved successfully.');

        return redirect(route('emails.index'));
    }

    /**
     * Display the specified Email.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $email = $this->emailRepository->findWithoutFail($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['email' => $email]);

        return view('emails.show')->with($this->viewWith);
    }

    /**
     * Show the form for editing the specified Email.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $email = $this->emailRepository->findWithoutFail($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }
        
        $this->viewWith = array_merge($this->viewWith,['email' => $email]);

        return view('emails.edit')->with($this->viewWith);
    }

    /**
     * Update the specified Email in storage.
     *
     * @param  int              $id
     * @param UpdateEmailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailRequest $request)
    {
        $email = $this->emailRepository->findWithoutFail($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $email = $this->emailRepository->update($request->all(), $id);

        Flash::success('Email updated successfully.');

        return redirect(route('emails.index'));
    }

    /**
     * Remove the specified Email from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $email = $this->emailRepository->findWithoutFail($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $this->emailRepository->delete($id);

        Flash::success('Email deleted successfully.');

        return redirect(route('emails.index'));
    }


    /**
     * Display the specified Email.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function lists($id)
    {
        $email = $this->emailRepository->findWithoutFail($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['email' => $email]);

        return view('emails.show')->with($this->viewWith);
    }
}
