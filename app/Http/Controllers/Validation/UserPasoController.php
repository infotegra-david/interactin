<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreateUserPasoRequest;
use App\Http\Requests\Validation\UpdateUserPasoRequest;
use App\Repositories\Validation\UserPasoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Validation\UserPaso;
use App\Models\Admin\Role;

class UserPasoController extends AppBaseController
{
    /** @var  UserPasoRepository */
    private $userPasoRepository;
    private $userPaso;
    private $campusApp;
    private $tipos_pasos;
    private $validadores;
    private $roleValidador;

    public function __construct(UserPasoRepository $userPasoRepo, UserPaso $userPasoModel, Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()) {
                $this->user = Auth::user();
                if (isset($this->user->campus)) {
                    $this->campusApp = $this->user->campus;
                    if (session('campusApp') == null) {
                        session(['campusApp' => ($this->campusApp->first()->id ?? 0 ) ]);
                        session(['campusAppNombre' => ($this->campusApp->first()->nombre ?? 'No pertenece a alguna institución.' )]);
                    }
                    if (count($this->campusApp)) {
                        $this->campusApp = $this->campusApp->pluck('nombre','id');
                    }else{
                        $this->campusApp = [0 => 'No pertenece a alguna institución.'];
                    }
                }else{
                    $this->campusApp = 0;
                }

            }

            $this->tipos_pasos = \App\Models\TipoPaso::select( DB::raw("concat(UPPER(SUBSTRING_INDEX(nombre, '_', -1)),' - ',replace(substr(nombre,instr(nombre,'paso')+4,2),'_',''),' - ',titulo) AS nombre"),'id');
            $this->roleValidador = Role::where('name','validador')->pluck('id');
            $this->validadores = \App\User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                        ->join('user_campus', 'users.id', '=', 'user_campus.user_id')
                        ->where('model_has_roles.role_id',$this->roleValidador )
                        ->where('user_campus.campus_id',session('campusApp') )
                        ->select(DB::raw("concat(users.name,' (',users.email,')' ) AS name"),'users.id');

            return $next($request);
        });
        $this->userPasoRepository = $userPasoRepo;
        $this->userPaso = $userPasoModel;

    }

    /**
     * Display a listing of the UserPaso.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $userPasos = $this->userPaso->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
                ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->orderBy('user_tipo_paso.id', 'asc')
                ->select('user_tipo_paso.*', DB::raw("concat(users.name,' (',users.email,')' ) AS user"), DB::raw("concat(UPPER(SUBSTRING_INDEX(tipo_paso.nombre, '_', -1)),' - ',replace(substr(tipo_paso.nombre,instr(tipo_paso.nombre,'paso')+4,2),'_',''),' - ',tipo_paso.titulo) AS tipo_paso"))
                ->get();
        
        return view('validation.assign.index')
            ->with(['campusApp' => $this->campusApp, 'userPasos' => $userPasos]);
    }

    /**
     * Show the form for creating a new UserPaso.
     *
     * @return Response
     */
    public function create()
    {
        //echo $this->validadores->toSql().'this->roleValidador:'.$this->roleValidador.' session(campusApp): '.session('campusApp');
        return view('validation.assign.create')
        ->with(['campusApp' => $this->campusApp, 'tipo_paso' => $this->tipos_pasos->pluck('nombre','id'), 'user' => $this->validadores->pluck('name','id')]);
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
        print_r($input);

        $userPaso = $this->userPasoRepository->create($input);

        Flash::success('Asignación guardada correctamente.');

        return redirect(route('intervalidation.assignments.index'));
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
        $userPaso = $this->userPaso->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
                ->join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                ->where('user_tipo_paso.id', $id)
                ->select('user_tipo_paso.*', DB::raw("concat(users.name,' (',users.email,')' ) AS user"), DB::raw("concat(UPPER(SUBSTRING_INDEX(tipo_paso.nombre, '_', -1)),' - ',tipo_paso.titulo) AS tipo_paso"))
                ->first();
        //print_r($userPaso);

        if (empty($userPaso)) {
            Flash::error('Asignación no encontrada');

            return redirect(route('intervalidation.assignments.index'));
        }

        return view('validation.assign.show')->with(['campusApp' => $this->campusApp, 'userPaso' => $userPaso]);
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
            Flash::error('Asignación no encontrada');

            return redirect(route('intervalidation.assignments.index'));
        }

        return view('validation.assign.edit')->with(['campusApp' => $this->campusApp, 'userPaso' => $userPaso, 'tipo_paso' => $this->tipos_pasos->pluck('nombre','id'), 'user' => $this->validadores->pluck('name','id')]);
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
            Flash::error('Asignación no encontrada');

            return redirect(route('intervalidation.assignments.index'));
        }

        $userPaso = $this->userPasoRepository->update($request->all(), $id);

        Flash::success('Asignación actualizada correctamente.');

        return redirect(route('intervalidation.assignments.index'));
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
            Flash::error('Asignación no encontrada');

            return redirect(route('intervalidation.assignments.index'));
        }

        $this->userPasoRepository->delete($id);

        Flash::success('Asignación eliminada correctamente.');

        return redirect(route('intervalidation.assignments.index'));
    }
}
