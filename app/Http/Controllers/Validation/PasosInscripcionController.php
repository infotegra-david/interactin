<?php

namespace App\Http\Controllers\Validation;

use App\Http\Requests\Validation\CreatePasosInscripcionRequest;
use App\Http\Requests\Validation\UpdatePasosInscripcionRequest;
use App\Repositories\Validation\PasosInscripcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Validation\PasosInscripcion;
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\TipoPaso;
use PDF;
use App\Http\Traits\Mails;
use App\Http\Traits\Validador;

class PasosInscripcionController extends AppBaseController
{
    use Authorizable;
    use Mails;
    use Validador;
    /** @var  PasosInscripcionRepository */
    private $pasosInscripcionRepository;
    private $pasosInscripcion;
    private $user;
    private $campusApp;
    private $tipoPaso;
    private $peticion;

    public function __construct(PasosInscripcionRepository $pasosInscripcionRepo, PasosInscripcion $pasosInscripcionModel, TipoPaso $tipoPasoModel, Request $request)
    {
        $this->middleware(function ($request, $next) {

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
            
            return $next($request);
        });

        $this->pasosInscripcionRepository = $pasosInscripcionRepo;
        $this->pasosInscripcion = $pasosInscripcionModel;
        $this->tipoPaso = $tipoPasoModel;

        //valida si es una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }
    }

    /**
     * Display a listing of the PasosInscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pasosInscripcionRepository->pushCriteria(new RequestCriteria($request));
        $pasosInscripcions = $this->pasosInscripcionRepository->paginate(20);
        
        return view('validation.interchanges.pasos_inscripcions.index')
            ->with(['campusApp' => $this->campusApp, 'pasosInscripcions' => $pasosInscripcions]);
    }

    /**
     * Display a listing of the Pasosinscripcion.
     *
     * @param Request $request
     * @return Response
     */
    public function datosNotificarValidador($request)
    {
        $returnMsg = [];
        
        //notificar a el validador en caso que este asociado al paso 
        $datos = $request;
        //recibe el id del tipo_paso (tipo_paso_id) y se busca el numero del paso sacandolo del string del nombre
        $paso = $this->tipoPaso->select(DB::raw("replace(substr(nombre,instr(nombre,'paso')+4,2),'_','') AS numero"),'id')->where('nombre','like','%_interchange')->where('id',$request['tipo_paso_id'])->first();
        $datos['paso'] = $paso->numero;
        $datos['accion'] = 'creacion';
        $datos['origen_peticion'] = 'local';
        //$datos['tipo_paso_id'] = $tipo_paso_id;
        $datos['inscripcionId'] = $request['inscripcionId'];
        $notificarValidador = $this->notificarValidador('inscripcion', $datos);
        if (isset($notificarValidador['errors'])) {
            $returnMsg['ok'] = false;
            $returnMsg['returnMsg'] = $notificarValidador['returnMsg'];
        }elseif( $notificarValidador === true ){
            $returnMsg['ok'] = true;
        }elseif( $notificarValidador != false ){
            $returnMsg['ok'] = true;
            $returnMsg['returnMsg'] = $notificarValidador;
        }

        return $returnMsg;
    }

    /**
     * Show the form for creating a new PasosInscripcion.
     *
     * @return Response
     */
    public function create($inscripcion_id)
    {
        $inscripcion = \App\Models\inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $datosInscripcion = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');

        $viewWith = $this->editCreateData($inscripcion_id,'');

        $viewWith = array_merge($viewWith, $datosInscripcion);

        return view('validation.interchanges.pasos_inscripcions.create')->with($viewWith);

    }

    /**
     * Store a newly created PasosInscripcion in storage.
     *
     * @param CreatePasosInscripcionRequest $request
     *
     * @return Response
     */
    public function store(CreatePasosInscripcionRequest $request)
    {
        $input = $request->all();

        //print_r($input);

        $inscripcion = \App\Models\Inscripcion::find($input['inscripcion_id']);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $pasosInscripcion = $this->pasosInscripcionRepository->create($input);

        
        $datos = $input;
        $datos['paso_id'] =$input['tipo_paso_id']; 
        $datos['inscripcionId'] =$inscripcion_id;


        $notificarValidador = $this->datosNotificarValidador($datos);
        print_r($notificarValidador);
        return true;
        if ($notificarValidador['ok'] === false) {
            Flash::error($notificarValidador['returnMsg']);
            return redirect(route('intervalidation.interchanges.validations.create',[$input['inscripcion_id']]));
        }

        Flash::success('El registro de la validación fue guardado correctamente.');

        return redirect(route('intervalidation.interchanges.validations.show',[$input['inscripcion_id']]));

    }

    /**
     * Display the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($inscripcion_id,$paso_id ='',$peticion ='')
    {
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        $inscripcionId = 0;
        $dataInscripcion = '';
        $dataUsers = 0;
        $pasosInscripcion = '';
        $archivosAdjuntos = '';
        $viewWith = [];

        if ( empty($inscripcion) ) {
            Flash::error('Inscripcion no encontrada');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcionId = $inscripcion->id;
        }

        //$pasosInscripcion = $this->pasosInscripcion->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
        $pasosInscripcion = DB::table('pasos_inscripcion')->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                    ->join('tipo_paso', 'pasos_inscripcion.tipo_paso_id', '=', 'tipo_paso.id')
                    ->join('users', 'pasos_inscripcion.user_id', '=','users.id' )
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->leftJoin('user_tipo_paso', 'users.id', '=', 'user_tipo_paso.user_id')
                    ->where('pasos_inscripcion.inscripcion_id', $inscripcionId);

        if ( $peticion !='' ) {
            $this->peticion = $peticion;
        }
        if ( $paso_id !='' ) {

            $pasosInscripcion = $pasosInscripcion->where('pasos_inscripcion.id', $paso_id)
                ->select('pasos_inscripcion.*','estado.nombre As estado_nombre','tipo_paso.titulo AS tipo_paso_titulo','users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
                //echo $pasosInscripcion->toSql();
                $pasosInscripcion = $pasosInscripcion->first();

            if ( empty($pasosInscripcion) ) {
                Flash::error('No se ha encontrado el registro del paso.');
                return redirect(route('intervalidation.interchanges.validations.show',[$inscripcion_id]));
            }else{
                $viewWith = ['pasosInscripcion' => $pasosInscripcion];
                $view = 'validation.interchanges.pasos_inscripcions.show';
            }


        }else{
            
            $viewWith = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');

            //lista de registros con el mismo tipo de paso
            $pasosInscripcion = $pasosInscripcion->orderBy('tipo_paso.id','asc')
                    ->orderBy('pasos_inscripcion.id','asc')
                    ->groupBy('pasos_inscripcion.id')
                    ->select('pasos_inscripcion.*','estado.nombre As estado_nombre','tipo_paso.titulo AS tipo_paso_titulo','users.name AS user_name','users.email AS user_email','roles.name AS role_name','user_tipo_paso.titulo');
            //echo $pasosInscripcion->toSql();
            $pasosInscripcion = $pasosInscripcion->paginate(20);
            //$pasosInscripcion = json_decode(json_encode($pasosInscripcion),true);

            
            $user_actual = \App\User::find($this->user->id);
            //Validar EL ROL DE generar_documento 
            $GenerarDocumento = false;
            $hasAllRoles = $user_actual->hasAllRoles('generar_documento');
            if ( $hasAllRoles ) {
                $GenerarDocumento = true;
            }

            $view = 'validation.interchanges.show';
            
            $viewWith = array_merge($viewWith, ['pasosInscripcion' => $pasosInscripcion, 'GenerarDocumento' => $GenerarDocumento]);
                
        }

        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => $this->peticion, 'inscripcionId' => $inscripcionId]);
        //print_r($viewWith);
        if ( $peticion == 'local' ) {
            return $viewWith;
        }else{
            return view($view)->with($viewWith);
        }
    }

    /**
     * Show the form for editing the specified Pasosinscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
     public function pdf($inscripcion_id, Request $request)
    {   
        
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $viewWith = [];
        $viewWith = $this->show($inscripcion_id,'', 'local');
        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'limpio']);
        $view = 'validation.interchanges.show';
        //$view = 'welcome';
        
        //$pdf = PDF::loadView($view, $viewWith);
        //return $pdf->download('interchange-'.$inscripcion_id.'.pdf');
        //return  PDF::loadView($view, $viewWith)->save( storage_path().'/interchange-'.$inscripcion_id.'.pdf')->stream('interchange-'.$inscripcion_id.'.pdf');
        if ( isset($request['tipo']) ) {
            if ( $request['tipo'] == 1 ) {
                return view($view)->with($viewWith);
            }elseif ( $request['tipo'] == 2 ) {
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }elseif ( $request['tipo'] == 3 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'basico']);
                //return view($view)->with($viewWith);
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }elseif ( $request['tipo'] == 4 ) {
                $viewWith = array_merge($viewWith, ['peticion' => 'ajax']);
                return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
            }
        }else{
            return  PDF::loadView($view, $viewWith)->stream('validation-interchange-'.$inscripcion_id.'.pdf');
        }
    }

    /**
     * Show the form for editing the specified PasosInscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($inscripcion_id,$paso_id)
    {
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($paso_id);

        if (empty($pasosInscripcion)) {
            Flash::error('No se encontro el paso de la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.show',[$inscripcion_id]));
        }

        $datosInscripcion = app('App\Http\Controllers\InterChangeController')->show($inscripcion_id, 'local');

        $viewWith = $this->editCreateData($inscripcion_id,$paso_id);
        
        $viewWith = array_merge($viewWith, $datosInscripcion);

        return view('validation.interchanges.pasos_inscripcions.edit')->with($viewWith);

    }
    /**
     * Show the form for editing the specified Pasosinscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function editCreateData($inscripcion_id,$paso_id ='')
    {
        $viewWith = [];
        $pasosInscripcion = '';
        $inscripcion = \App\Models\Inscripcion::find($inscripcion_id);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        if ($paso_id !='') {
            $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($paso_id);

            if (empty($pasosInscripcion)) {
                Flash::error('No se encontro el paso de la inscripcion');

                return redirect(route('intervalidation.interchanges.validations.show',[$inscripcion_id]));
            }
        }

        $tipos_pasos = $this->tipoPaso->where('nombre','like','%_interchange');
        $estados = \App\Models\Estado::where('uso','VALIDATOR')->pluck('nombre','id');

        $campusAppId = session('campusApp');
        if (session('campusApp') == null) {
            $keys = array_keys($this->campusApp);
            $campusAppId = $this->campusApp[$keys[0]];
        }

        //los validadores estaban filtrados por los que pertenezcan al mismo campus que el usuario logueado
        //se quito esa condicion para que se permita a todos los que esten asignados por base de datos (user_tipo_paso)
        $validadores = \App\Models\Admin\Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->where('roles.name','validador')
            ->pluck('users.id');

        $tipos_pasos_id = $tipos_pasos->pluck('id');
        $validadoresXlosPasos = \App\Models\Admin\Role::join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->join('user_tipo_paso', 'users.id', '=', 'user_tipo_paso.user_id')
            ->join('tipo_paso', 'user_tipo_paso.tipo_paso_id', '=', 'tipo_paso.id')
            ->whereIn('user_tipo_paso.tipo_paso_id',$tipos_pasos_id)
            ->orderBy('user_tipo_paso.orden','asc')
            ->select(DB::raw('CONCAT(user_tipo_paso.titulo,\' - \', users.email,\' (\',REPLACE(roles.name, \'_\', \' \'),\')\') AS name'),'users.id' );

        //buscar el rol administrador
        $role = Role::where('name','administrador')->get();
        //validar si tiene  el rol administrador y filtrar los demas usuarios
        if ( !$this->user->hasAllRoles($role) ) {
            $validadoresXlosPasos = $validadoresXlosPasos->where('users.id',$this->user->id);
            $filtrovalidadores = $validadoresXlosPasos->pluck('name','id');
            if (empty($filtrovalidadores)) {
                Flash::error('No tiene permitido editar el paso de esta inscripcion');

                return redirect(route('intervalidation.interchanges.validations.show',[$inscripcion_id]));
            }
        }else{

            $validadoresXlosPasos = $validadoresXlosPasos->whereIn('user_tipo_paso.user_id',$validadores);


            $validadoresXlosPasos = \App\Models\Admin\Role::select(DB::raw("'Seleccione un validador' AS name, '' AS id"))->union($validadoresXlosPasos);
        }

        $tipos_pasos = $tipos_pasos->select(DB::raw("concat(replace(substr(nombre,instr(nombre,'paso')+4,2),'_',''),' - ',titulo) AS titulo"),'id')->pluck('titulo','id');
        $validadores = $validadoresXlosPasos->pluck('name','id');

        $viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'pasosInscripcion' => $pasosInscripcion, 'inscripcion_id' => $inscripcion_id, 'tipo_paso_id' => $tipos_pasos, 'estado_id' => $estados, 'user_id' => $validadores]);

        if (!empty($pasosInscripcion)) {
            $viewWith = array_merge($viewWith, ['pasosInscripcion' => $pasosInscripcion]);
        }

        return $viewWith;
    }

    /**
     * Update the specified PasosInscripcion in storage.
     *
     * @param  int              $id
     * @param UpdatePasosInscripcionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePasosInscripcionRequest $request)
    {
        $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($id);
        $input = $request->all();

        if (empty($pasosInscripcion)) {
            Flash::error('Validación de la inscripcion no encontrada');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }

        $pasosInscripcion = $this->pasosInscripcionRepository->update($input, $id);

        $inscripcion = \App\Models\Inscripcion::find($input['inscripcion_id']);

        if ( empty($inscripcion) ) {
            Flash::error('No se encontro la inscripcion');

            return redirect(route('intervalidation.interchanges.validations.index'));
        }else{
            $inscripcion_id = $inscripcion->id;
        }

        $datos = $input;
        $datos['inscripcionId'] = $inscripcion_id;
        $notificarValidador = $this->datosNotificarValidador($datos);
        if ($notificarValidador['ok'] === false) {
            $error_msg = implode("<br> ", $notificarValidador['returnMsg']);
            
            Flash::error($error_msg);
            return redirect(route('intervalidation.interchanges.validations.edit',[$input['inscripcion_id'], $id]));
        }

        Flash::success('El registro de la validación fue actualizado correctamente.');

        return redirect(route('intervalidation.interchanges.validations.show',[$input['inscripcion_id']]));

    }

    /**
     * Remove the specified PasosInscripcion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pasosInscripcion = $this->pasosInscripcionRepository->findWithoutFail($id);

        if (empty($pasosInscripcion)) {
            Flash::error('Pasos Inscripcion not found');

            return redirect(route('pasosInscripcions.index'));
        }

        $this->pasosInscripcionRepository->delete($id);

        Flash::success('Pasos Inscripcion deleted successfully.');

        return redirect(route('pasosInscripcions.index'));
    }
}
