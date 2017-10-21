<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInscripcionRequest;
use App\Http\Requests\UpdateInscripcionRequest;
use App\Repositories\InscripcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Input;
use App\Authorizable;



use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\TipoPaso;
use App\Models\Admin\Institucion;
use App\Models\Admin\Facultad;
use App\Models\Admin\Country;
use DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Traits\Mails;
use App\Http\Traits\Validador;
use PDF;

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class InterChangeController extends AppBaseController
{
    use Authorizable;
    use Mails;
    use Validador;
    
    /** @var  InterChangeRepository */    
    private $interChangeRepository;

    private $user;
    private $campusApp;
    private $tipoPaso;
    private $paso_titulo;
    private $userCampus;
    private $institucion;
    private $facultad;
    private $tipoInstitucion;
    private $pais;
    private $peticion;
    private $tipoInterChange;

    public function __construct(InscripcionRepository $interChangeRepo, TipoPaso $tipoPasoModel, Institucion $institucionModel, Facultad $facultadModel, Country $countryModel, Request $request)
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
            return $next($request);
        });

        $this->interChangeRepository = $interChangeRepo;
        $this->tipoPaso = $tipoPasoModel;
        $this->institucion = $institucionModel;
        $this->facultad = $facultadModel;
        $this->pais = $countryModel;
        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }
        
        $this->paso_titulo = $this->tipoPaso->where('nombre','like','%_interchange')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');

        //diferentes formas de obtener la ruta
        //$route = Route::current();

        $name = Route::currentRouteName();

        //$action = Route::currentRouteAction();

        $this->tipoInterChange = $name;
    }

    public function crearPaso($paso,$estado,$interchangeId,$observacion = '')
    {
        $userId = $this->user->id;
        $tipo_paso = $this->tipoPaso->where('nombre','paso'.$paso.'_interchange')->pluck('id')->first();
        $estado = \App\Models\Estado::where('nombre',$estado)->pluck('id')->first();

        //¿siempre se crea un nuevo paso o se actualiza si existe?
            /*
            $pasoinscripcion = \App\Models\Validation\Pasosinscripcion::where('tipo_paso_id',$tipo_paso)->where('inscripcion_id',$interchangeId)->where('user_id',$userId);
            $existePaso = $pasoinscripcion->first();
            if ( count($existePaso) ) {
                $pasoinscripcion->update(['estado_id' => $estado]);
                return $existePaso->id;
            }else{
            */
                $dataPaso['tipo_paso_id'] = $tipo_paso;
                $dataPaso['estado_id'] = $estado;
                $dataPaso['inscripcion_id'] = $interchangeId;
                $dataPaso['user_id'] = $userId;
                $dataPaso['observacion'] = $observacion;

                if ( $pasoInscripcion = \App\Models\Validation\PasosInscripcion::create($dataPaso) ){
                    //$this->notificarPaso($paso,$estado,$interchangeId);


                    return $pasoInscripcion;
                }else{
                    return false;
                }
            /*
            }
            */
        
    }

    /**
     * Display a listing of the InterChange.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->interChangeRepository->pushCriteria(new RequestCriteria($request));
        $interChanges = $this->interChangeRepository->all();

        return view('InterChange.index')
            ->with(['interChanges', $interChanges, 'campusApp' => $this->campusApp, 'peticion' => $this->peticion]);
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function map(Request $request)
    {
        return redirect('/html/interout-map.php');
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function list(Request $request)
    {
        return view('InterChange.create');
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function mail(Request $request)
    {
        
        //print_r($request->all());
        $tipo_paso = '';
        $archivosAdjuntos = '';
        $inscripcionId = '';
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $viewWith = '';
        $vista = 'emails.inscripcion.show';

        if (isset($request['interchangeId'])) {
            $inscripcionId = $request['interchangeId'];
        }elseif( session('interchangeId') != null ){
            $inscripcionId = session('interchangeId');
        }else{
            
            //return '<hr> El e-mail no se encuentra, No existe la inscripcion.';
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra la incripción.');
            goto end;
        }


        if ( isset($request['paso']) ) {

            $tipo_paso = $this->tipoPaso->where('nombre', 'paso'.$request['paso'].'_interchange')->pluck('id');


            //muestra los datos de los e-mails registrados y los ordena desde el ultimo registrado hacia atras
            $dataMail = DB::table('pasos_inscripcion')
                    ->join('pasos_inscripcion_mail', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_mail.pasos_inscripcion_id')
                    ->join('mail', 'pasos_inscripcion_mail.mail_id', '=', 'mail.id')
                    ->join('estado', 'pasos_inscripcion.estado_id', '=', 'estado.id')
                    ->where('pasos_inscripcion.inscripcion_id',$inscripcionId )
                    ->where('pasos_inscripcion.tipo_paso_id',$tipo_paso )
                    ->select('mail.*','pasos_inscripcion.id AS pasos_inscripcion_id','pasos_inscripcion.observacion AS paso_observacion','estado.nombre AS estado_nombre')
                    ->orderBy('mail.created_at','desc');
            //echo $dataMail->toSql().' |$inscripcionId:'.$inscripcionId;
            $dataMail = $dataMail->get();


            if ( count($dataMail) > 0 ) {
                /*
                if ($dataMail[0]->estado == '1') {
                    $errors += 1;
                    array_push($errorsMsg, 'El e-mail ya fue enviado.');
                    goto end;
                }
                */

                if ( isset($request['ver']) && !isset($request['enviar']) ) {
                    $msj_header_text = '';
                    $viewWith = '';
                    $vista = 'emails.inscripcion.show_mail';

                    $viewWith = $this->datosInscripcion($inscripcionId,'mail','ver',$tipo_paso);

                    $viewWith = array_merge($viewWith, ['dataMail' => $dataMail]);
                    

                    //return view('emails.inscripcions.response');
                    return view($vista)->with($viewWith);

                }elseif ( isset($request['enviar']) && isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {

                    $tipo_mail = 'inscripcion';
                    $request['tipo_paso_id'] = $tipo_paso;
                    $request['dataMail'] = $dataMail;

                    $datosInscripcion = $this->datosInscripcion($inscripcionId,'mail','ver',$tipo_paso);
                    $datosInscripcionKeys = array_keys($datosInscripcion);
                    //print_r($datosInscripcion['datainscripcion']);
                    foreach ($datosInscripcionKeys as $key) {
                        //echo '$key:'.$key.' <br>';
                        $request[$key] = $datosInscripcion[$key];
                    }

                    $enviarMail = $this->enviarMail($tipo_mail, $request);
                    return $enviarMail;

                }
                
            }else{

                $vista = 'emails.inscripcion.show_data';
                $tipo_paso = 0;

                $viewWith = $this->datosInscripcion($inscripcionId,'mail','ver',$tipo_paso);

                //print_r($viewWith);

                return view($vista)->with($viewWith);

            }



        }else{

            $errors += 1;
            array_push($errorsMsg, 'No esta seleccionado ningún paso.');
            goto end;
        }

        //retorno de los errores
        end:

        if ($errors > 0) {
            //echo 'error <br>';

            if ( isset($request['origen_peticion']) && $request['origen_peticion'] == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion != 'ajax') {
                flash()->error($errorsMsg);
            }else{
                return Response::json($errorsMsg, 422);
            }
        }
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function pdf($id_interchange, Request $request)
    {
        return view('InterChange.create');
    }

    /**
     * Show the form for creating a new InterChange.
     *
     * @return Response
     */
    public function create($interchangeId = '')
    {
        $tipoInterChange = 'InterOut';
        $tipoModalidad = 0;
        if ($this->tipoInterChange == 'interchanges.interin.create') {
            $tipoInterChange = 'InterIn';
            $tipoModalidad = 1;
        }
        
        $clase_documento = \App\Models\ClaseDocumento::where('nombre','IDENTIDAD')->pluck('id');
        $estudiante_tipo_documento = \App\Models\TipoDocumento::where('clase_documento_id',$clase_documento)->pluck('nombre','id');
        if (session('campusApp') == null) {
            session(['campusApp' => $this->campusApp->first()->id]);
        }
        $estudiante_facultad = $this->facultad->where('campus_id',session('campusApp'))->pluck('nombre','id');
        $estudiante_programa =[];
        $movilidad_periodo = \App\Models\Periodo::where('vigente','0')->pluck('nombre','id');
        $movilidad_modalidad =\App\Models\Modalidades::where('tipo',$tipoModalidad)->select('nombre','id')->pluck('nombre','id');
        $movilidad_institucion =[];
        $movilidad_pais =[];


        $viewWith = ['tipoInterChange' => $tipoInterChange, 'paso' => '1','peticion' => $this->peticion ?? 'normal', 'campusApp' => $this->campusApp, 'paso_titulo' => $this->paso_titulo, 'estudiante_tipo_documento' => $estudiante_tipo_documento, 'estudiante_facultad' => $estudiante_facultad, 'estudiante_programa' => $estudiante_programa, 'movilidad_periodo' => $movilidad_periodo, 'movilidad_modalidad' => $movilidad_modalidad, 'movilidad_institucion' => $movilidad_institucion, 'movilidad_pais' => $movilidad_pais]; 

        if ( $interchangeId != '' ) {
            $viewWith = array_merge($viewWith,['interchangeId' => $interchangeId]);
            return $viewWith;
        }else{
            return view('InterChange.create')->with($viewWith);
        }
    }

    /**
     * Store a newly created InterChange in storage.
     *
     * @param CreateInterChangeRequest $request
     *
     * @return Response
     */
    public function storeUpdate(Request $request, $tipo, $id = '',$tipoInterChange)
    {
        
        $input = $request->all();
        
        //print_r($input);

        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];
        $userId = $this->user->id;

        $interchange = '';
        $dataInscripcion = array();
        $interchangeId = 0;
        $estudianteId = 0;
        $estudiante = '';
        $campusAppId = 0;
        $campusApp = 0;
        $campusId = 0;
        $paso = 0;
        $paso_id = 0;

        $tipos_pasos = $this->paso_titulo;

        $rolUsuario = 'estudiante';
        $crearTipo = 'nuevo';
        $estadoPaso = 'PENDIENTE POR REVISIÓN';
        $buscarPostulante = 0;

        //arreglar lo de las movilidades para la inscripcion y para la inscripcion
        //- por ahora se separo en aplicaciones (antigua modalidad) y modalidades

        //verificar la ruta (interin o interout)
        if ($tipoInterChange == 'InterOut') {
            
        }elseif($tipoInterChange == 'InterIn'){

        }

        //verificar la existencia del intercambio
        if ($id != '') {
            $interchangeId = $id;
        }elseif (isset($request['interchangeId'])) {
            $interchangeId = $request['interchangeId'];
        }elseif( session('interchangeId') != null ){
            $interchangeId = session('interchangeId');
        }

        if ($interchangeId != 0) {
            
            $interChange = $this->interChangeRepository->findWithoutFail($interchangeId);

            if (!empty($interChange)) {
                $crearTipo = 'actualizar';
                $interchangeId = $interChange->id;
                $estudianteId = $interChange->user_id;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
                goto end;
            }
        }


        if ( isset($request['modificar']) && isset($request['paso']) ) {
            $crearTipo = 'actualizar';
            $estadoPaso = 'ACTUALIZACIÓN DE DATOS';
            
            if( $interchangeId == 0 ){
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
                goto end;
            }
        }

        if ( isset($request['paso']) && $request['paso'] != 1 && $interchangeId == 0 ) {
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra el registro del intercambio, recargue la pagina.');
            goto end;
        }

        //verificar la existencia del id del campus, que el usuario haya seleccionado el campus que quiere usar
        if (isset($request['campusApp'])) {
            $campusAppId = $request['campusApp'];
        }elseif( session('campusApp') != null ){
            $campusAppId = session('campusApp');
        }else{
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra el campus, seleccione el campus que va a usar.');
            goto end;
        }

        $campusApp = \App\Models\Admin\Campus::find($campusAppId);
        if (empty($campusApp)) {
            $errors += 1;
            array_push($errorsMsg, 'No se encuentra el campus, seleccione el campus que va a usar.');
            goto end;
        }

        //verificar el rol del usuario, si es estudiante o coordinador_externo (si no es estudiante puede ser cualquiera que tenga los permisos para inscribir a un estudiante)

        $rolePostulante = Role::where('name',$rolUsuario)->get();
        if ( !$this->user->hasAllRoles($rolePostulante) ) {
            $rolUsuario = 'coordinador';
            
        }

        //no se si lo necesite
        //puede servir para exigir que solo el usuario que realizo la postulacion sea el que la pueda editar
            // aunque deberia permitirse al coordinador y al estudiante
        /*
        if ($interchangeId != 0) {
            if ( $request['paso'] == '1' || $request['paso'] == '2') {
                //buscar el rol del coordinador y del estudiante
                $rolePostulante = Role::where('name',$rolUsuario)->pluck('id');
                //buscar el usuario del estudiante del intercambio
                $buscarPostulante = \App\Models\Postulacion::join('users', 'postulacion.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('postulacion.inscripcion_id',$interchangeId )
                    ->where('model_has_roles.role_id',$rolePostulante )
                    ->select('users.id');
                //echo $buscarPostulante->toSql();
                $buscarPostulante = $buscarPostulante->first();

            }
        }
        */

        //verificar el paso

        $reglas = [];
        if ( isset($request['paso']) ) {
          if ( $request['paso'] == '1' ) {
            $reglas = [
                'estudiante_nombres' => 'required',
                'estudiante_apellidos' => 'required',
                'estudiante_tipo_documento' => 'required',
                'estudiante_numero_documento' => 'required',
                'estudiante_email_personal' => 'required',
                'estudiante_codigo_institucion' => 'required',
                ];

            if ( isset($request['modificar']) ) {
                $reglas = array_merge($reglas, [
                'estudiante_email_institucion' => 'required',
                ] );
            }else{
                $reglas = array_merge($reglas, [
                'estudiante_email_institucion' => 'required|email|unique:users,email',
                ] );
            }
          }
          if ( $request['paso'] == '2' ) {
              
            $reglas = array_merge($reglas, [
                'estudiante_facultad' => 'required',
                'estudiante_programa' => 'required',
                'estudiante_promedio' => 'required|between:0.0,9.9',
                'estudiante_porcentaje_creditos' => 'required|between:0.0,9.9',
            ] );


          }
          if ( $request['paso'] == '3' ) {
              
            $reglas = array_merge($reglas, [
                'movilidad_periodo' => 'required',
                'movilidad_modalidad' => 'required',
                'movilidad_pais' => 'required',
                'movilidad_institucion' => 'required',
            ] );


          }
          if ( $request['paso'] == '4' ) {
            
            $reglas = array_merge($reglas, [
                'interchangeId' => 'required',
            ] );

          }
          if ( $request['paso'] == '5' ) {
            $reglas = array_merge($reglas, [
                'atoken' => 'required',
                'aceptar_inscripcion' => 'required',
            ] );
            

          }
        }else{
            $errors += 1;
            array_push($errorsMsg, 'No se han recibido datos validos.');
            goto end;
        }

        $this->validate($request, $reglas);
        
        
        
        //las facultades de destino seran asignadas por el coordinador externo
        
        DB::beginTransaction();


        /// INICIO PASO 1
        /// INICIO PASO 1
        /// INICIO PASO 1

        //pre-registro
        if ( isset($request['paso']) && $request['paso'] == '1' ) {
            //registrar el nuevo usuario [paso 1]
        
            //registrar/actualizar los datos personales del estudiante [paso 1/5]

                if ( $estudianteId != 0 ) {
                    $dataUser['id']= $estudianteId;
                }

                $dataUser['name']= $input['estudiante_nombres'];
                $dataUser['email']= $input['estudiante_email_institucion'];
                $dataUser['activo']= 1;
                // crear password
                $passwordEstudiante = str_random(8);
                //no sera encriptado hasta que se envie el email
                //$dataUser['password']= bcrypt( $passwordEstudiante );
                $dataUser['password']= $passwordEstudiante;
            //datos personales del usuario
                $dataDatosPersonalesOrigen['nombres']= $input['estudiante_nombres'];
                $dataDatosPersonalesOrigen['apellidos']= $input['estudiante_apellidos'];
                $dataDatosPersonalesOrigen['tipo_documento_id']= $input['estudiante_tipo_documento'];
                $dataDatosPersonalesOrigen['numero_documento']= $input['estudiante_numero_documento'];
                $dataDatosPersonalesOrigen['email_personal']= $input['estudiante_email_personal'];
                $dataDatosPersonalesOrigen['codigo_institucion']= $input['estudiante_codigo_institucion'];
                
            //verificar si ya es estudiante
            if ( $rolUsuario == 'estudiante' ) {

                $crearTipo = 'actualizar';
                
            }

            //en el caso de querer modificar los datos
            $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'estudiante',$campusApp->id,$dataDatosPersonalesOrigen,'');
            // Create the user

            if ( $crearUsuario === 'error_usuario' ) {

                $errors += 1;
                array_push($errorsMsg, 'No se puede crear el estudiante.');
                goto end;
            }elseif( $crearUsuario === 'error_datos_personales' ){
                $errors += 1;
                array_push($errorsMsg, 'No se pueden crear los datos personales del estudiante.');
                goto end;
            }elseif( $crearUsuario != false ){
                $estudianteId = $crearUsuario->id;
            }


            if ( $rolUsuario == 'coordinador' ){

                $estudiante = $this->asociarUsuario('estudiante',$estudianteId,'estudiante',$campusAppId,'');
                    
                if ( $estudiante === 'error_usuario' ) {
                    $errors += 1;
                    array_push($errorsMsg, 'No se encontro el estudiante.');
                    goto end;
                }elseif( $estudiante != false ){
                    $estudianteId = $estudiante->id;
                }


            }

            //datos para crear/actualizar la inscripcion (interchange)
            if ( $interchangeId != 0 ) {
                $dataInscripcion['id']= $interchangeId;
            }
            $dataInscripcion['user_id']= $estudianteId;
            

            
            $paso = $request['paso'];


        }


        /// FIN PASO 1
        /// FIN PASO 1
        /// FIN PASO 1

        /// INICIO PASO 2
        /// INICIO PASO 2
        /// INICIO PASO 2

        if ( isset($request['paso']) && $request['paso'] == '2' ) {
            //registrar/actualizar la informacion academica del nuevo estudiante [paso 2/7]


            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            //datos personales del usuario
            $dataDatosPersonalesOrigen['promedio_acumulado']= $input['estudiante_promedio'];
            $dataDatosPersonalesOrigen['porcentaje_aprobado']= $input['estudiante_porcentaje_creditos'];

            //datos para asociar al estudiante a un programa
            $dataUser['programa_id']= $input['estudiante_programa'];
            

            //en el caso de querer modificar los datos
            $crearUsuario = $this->crearUsuario($crearTipo,$dataUser,'estudiante',$campusApp->id,$dataDatosPersonalesOrigen,'');

            if ( $crearUsuario === 'error_usuario' ) {

                $errors += 1;
                array_push($errorsMsg, 'No se puede crear el estudiante.');
                goto end;
            }elseif( $crearUsuario === 'error_datos_personales' ){
                $errors += 1;
                array_push($errorsMsg, 'No se pueden crear los datos personales del estudiante.');
                goto end;
            }elseif( $crearUsuario != false ){
                $estudianteId = $crearUsuario->id;
            }


            //datos para actualizar la inscripcion (interchange)
            if ( $interchangeId != 0 ) {
                $dataInscripcion['id']= $interchangeId;
            }
            $dataInscripcion['user_id']= $estudianteId;
            $dataInscripcion['programa_origen_id']= $input['estudiante_programa'];
  

            $paso = $request['paso'];


        }
        /// FIN PASO 2
        /// FIN PASO 2
        /// FIN PASO 2

        /// INICIO PASO 3
        /// INICIO PASO 3
        /// INICIO PASO 3

        if ( isset($request['paso']) && $request['paso'] == '3' ) {
            //registrar/actualizar la informacion de movilidad [paso 3/8]
            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            //datos para actualizar la inscripcion
            if ( $interchangeId != 0 ) {
                $dataInscripcion['id']= $interchangeId;
            }

            //hallar el campus al que se va a asociar la inscripcion
            $ciudades = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')->where('departamento.pais_id', $input['movilidad_pais'])->pluck('ciudad.id');
            $campus = Institucion::join('campus', 'institucion.id', '=', 'campus.institucion_id')->where('institucion.id', $input['movilidad_institucion'])->whereIn('campus.ciudad_id', $ciudades);
            //se entrega como un array normal
            $campus = $campus->pluck('campus.id');
            //se escoje el primer campus
            $campusMovilidad = $campus[0];

            $dataInscripcion['user_id']= $dataUser['id'];
            $dataInscripcion['periodo_id']= $input['movilidad_periodo'];
            $dataInscripcion['campus_id']= $campusMovilidad;
            $dataInscripcion['modalidades_id']= $input['movilidad_modalidad'];
  

            $paso = $request['paso'];


        }
        /// FIN PASO 3
        /// FIN PASO 3
        /// FIN PASO 3

        /// INICIO PASO 4
        /// INICIO PASO 4
        /// INICIO PASO 4

        if ( isset($request['paso']) && $request['paso'] == '4' ) {
            //enviar el email al validador 1 (Director de Programa) [paso 4]
        
            if ( $estudianteId != 0 ) {
                $dataUser['id']= $estudianteId;
            }else{
                $errors += 1;
                array_push($errorsMsg, 'No se encuentra al estudiante.');
                goto end;
            }

            $tipo_paso_id = 0;
            $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$interchangeId);
            if ( !$crearPaso ){
                $errors += 1;
                array_push($errorsMsg, 'No se puede actualizar el paso \''.$tipos_pasos[$request['paso']].'\' de la inscripcion.');
                goto end;
            }else{
                $tipo_paso_id = $crearPaso->tipo_paso_id;
                
            }
            //para que no guarde dos veces el paso
            $paso_id = 0;


            
                /*
        //se usara para el ultimo paso

            //crear el registro del email
            $tipo_paso = $this->tipoPaso->where('nombre','paso'.$request['paso'].'_interchange')->pluck('id')->first();
            if ( isset($request['modificar']) ) {
                $dataMail = DB::table('pasos_inscripcion')
                    ->join('pasos_inscripcion_mail', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_mail.pasos_inscripcion_id')
                    ->join('mail', 'pasos_inscripcion_mail.mail_id', '=', 'mail.id')
                    ->where('pasos_inscripcion.inscripcion_id',$interchangeId )
                    ->where('pasos_inscripcion.tipo_paso_id',$tipo_paso )
                    ->select('pasos_inscripcion.id AS pasos_inscripcion_id','mail.id')
                    ->orderBy('mail.created_at','desc');
                //echo $dataMail->toSql().' |$inscripcionId:'.$inscripcionId.' |$tipo_paso:'.$tipo_paso;
                $dataMail = $dataMail->get();
                    
                $crearPaso = true;

            }else{
                $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$interchangeId);
                $paso_id = $crearPaso->id;
            }


            if ( $crearPaso ){
                $mail_id = 0;

                if ( isset($request['modificar']) ) {
                    if ( count($dataMail) ) {
                        $mail_id = $dataMail[0]->id;
                        $paso_id = $dataMail[0]->pasos_inscripcion_id;
                    }
                }

            //CREAR EL REGISTRO DEL MAIL

                $roleDirector = Role::where('name','director_programa')->pluck('id');

                $roleCopiaEmails = Role::where('name','copia_oculta_email')->pluck('id');


                //buscar la inscripcion
                $datosInscripcion = \App\Models\Inscripcion::where('id',$interchangeId )->first();

                //buscar el usuario del validador 1 (director_programa) de la inscripcion
                $validadorInscripcion = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                    ->where('model_has_roles.role_id',$roleDirector )
                    ->select('users.name', 'users.email')->first();
                
                //buscar el usuario del estudiante de la inscripcion
                $estudianteInscripcion = Users::where('users.id',$datosInscripcion->user_id )
                    ->select('users.name', 'users.email')->first();

                //buscar el usuario del postulante (coordinador) de la inscripcion
                $postulanteInscripcion = \App\Models\Postulacion::join('users', 'postulacion.user_id', '=', 'users.id')
                    ->where('postulacion.inscripcion_id',$interchangeId )
                    ->select('users.name', 'users.email')->first();

                //buscar el email del usuario asignado para recibir una copia oculta de los emails
                $copia_oculta_email = \App\Models\Validation\UserPaso::join('users', 'user_tipo_paso.user_id', '=', 'users.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('user_tipo_paso.tipo_paso_id',$tipo_paso )
                    ->where('model_has_roles.role_id',$roleCopiaEmails )
                    ->select('users.name', 'users.email')->first();

                $tipo_mail = 'inscripcion';
                $datos['crearTipo'] = $crearTipo;
                $datos['estadoPaso'] = $estadoPaso;
                $datos['id'] = $mail_id;
                $datos['paso'] = $paso_id;
                $datos['to'][0] = $validadorInscripcion;
                $datos['cc'][0] = $estudianteInscripcion;
                //si el postulante NO es el mismo estudiante entonces enviar copia del email
                if ($estudianteInscripcion->email != $postulanteInscripcion->email) {
                    $datos['cc'][1] = $postulanteInscripcion;
                }
                $datos['bcc'][0] = $copia_oculta_email;
                
                //nombre de la institucion del usuario
                $institucionUsuario = '';
                if (session('campusApp') == null) {
                    $institucionUsuario = $this->user->campus->first()->institucion->nombre;
                }else{
                    $institucionUsuario = $this->institucion->join('campus','institucion.id','campus.institucion_id')
                            ->where('campus.id',session('campusApp'))
                            ->select('institucion.nombre')->first();
                }

                $datos['subject'] = 'Institución '.ucwords(strtolower( $institucionUsuario->nombre )) .' - Nueva inscripcion en '.$tipoInterChange;


                //---------------------------
                //---------------------------
                //---------------------------

                */

                //notificar a el validador en caso que este asociado al paso 

                //datos del ultimo registro del paso (Pasosinscripcion)
                $datos['paso_id'] = $crearPaso->id;
                $datos['tipo_paso_id'] = $crearPaso->tipo_paso_id;
                $datos['estado_id'] = $crearPaso->estado_id;
                $datos['inscripcion_id'] = $crearPaso->inscripcion_id;
                $datos['user_id'] = $crearPaso->user_id;
                $datos['observacion'] = $crearPaso->observacion;

                if ( isset($request['modificar']) ) {
                    $datos['modificar'] = $request['modificar'];                    
                }

                $datos['paso'] = $request['paso'];
                $datos['accion'] = 'creacion';
                //$datos['tipo_paso_id'] = $tipo_paso_id;
                $datos['inscripcionId'] = $interchangeId;
                $datos['user_name'] = $this->user->name;
                $datos['user_email'] = $this->user->email;
                $notificarValidador = $this->notificarValidador('inscripcion', $datos);
                if (isset($notificarValidador['errors'])) {
                    $errors += 1;
                    $errorsMsg = array_merge($errorsMsg, $notificarValidador['returnMsg']);
                    goto end;
                }elseif( $notificarValidador === true ){
                    //continua normalmente
                }elseif( $notificarValidador != false ){
                    array_push($okMsg,$notificarValidador);
                }

            
            $paso = $request['paso'];

            //}


        }
        /// FIN PASO 4
        /// FIN PASO 4
        /// FIN PASO 4


            //registrar/actualizar los datos de contacto del estudiante [paso 6]

        //registrar/actualizar la informacion academica del nuevo estudiante [paso 2/7]

        //registrar/actualizar la informacion de movilidad [paso 3/8]

            //registrar/actualizar las asignaturas a cursar (equivalentes) [paso 8]

        //enviar el email al Director de Programa (validador 1)  [paso 4]

        

        //registro

        //registrar/actualizar los datos de contacto en caso de emergencia del estudiante [paso 9]

        //registrar/actualizar las fuentes de financiacion (nacional/internacional) [paso 10]

        //registrar/actualizar el presupuesto [paso 11]
        
        //registrar/actualizar el archivo con los documentos de soporte (solo uno) [paso 12]

        //registrar/actualizar la foto [paso 13]

        //enviar el email al Director de Programa (validador 2) [paso 14]
            // si aprueba el Director de Programa se envia un email a la ORII (validador 3)
                // si aprueba la ORII se envia un email a la Universidad/Institución de destino (validador 4)
                    // si aprueba la Universidad/Institución de destino se envia un email a todos los anteriores y el estudiante podra cargar los documentos finales para legalizar la movilidad y se notifica a la ORII (validador 3)
                        // si aprueba la ORII se envia un email a la Vicerrectoría Académica (VRAC) (validador 5)
                            // si aprueba la VRAC se envia un email a la Oficina de Admisiones y Registro (OAR) (validador 6) (tal vez la OAR no sea un validador, solo se notifica y ya)
                                // FIN, se envia un email a todos los interesados, el estudiante puede ir a hacer su movilidad


            //si alguno no aprueba o pide modificacion se envia correo de respuesta a todos los interesados

        //link para generar pdf con el resumen de la postulacion [paso 14]





        if ( isset($request['paso']) && $paso != 0 && $estudianteId != 0 ) {

            if ( count($dataInscripcion) > 0 ) {
            
                //se crea/actualiza la inscripcion con los datos disponibles
                $crearInscripcion = $this->crearInscripcion($crearTipo,$dataInscripcion,$rolUsuario);

                if ( $crearInscripcion === 'error_inscripcion' ) {

                    $errors += 1;
                    array_push($errorsMsg, 'No se puede crear la inscripción.');
                    goto end;
                }elseif( $crearInscripcion != false ){
                    $interchangeId = $crearInscripcion->id;
                }
            }

            //GUARDAR EL PASO
            if ($paso_id == 0) {
                $tipo_paso_id = 0;

                $crearPaso = $this->crearPaso($request['paso'],$estadoPaso,$interchangeId);
                if ( !$crearPaso ){
                    $errors += 1;
                    array_push($errorsMsg, 'No se puede guardar el paso \''.$tipos_pasos[$request['paso']].'\' del intercambio.');
                    goto end;
                }else{
                    $tipo_paso_id = $crearPaso->tipo_paso_id;
                    
                }
            }

            //se regresa el id del usuario estudiante creado para poder modificarlo
            array_push($okMsg,'<input type="hidden" class="dato_adicional" name="interchangeId" value="'.$interchangeId.'">');
        }

        end:

        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();
            if ($this->peticion != 'ajax') {
                flash()->error($errorsMsg);
            }else{
                return Response::json($errorsMsg, 422);
            }
        }elseif ($paso == 0 ) {
            return Response::json(['No se recibieron datos'], 422);
        }else{

            DB::commit();
            $accion = 'registraron';
            if ( isset($request['modificar']) ) {
                $accion = 'actualizaron';
            }
            $msg = 'Se '.$accion.' los datos del paso \''.$tipos_pasos[$paso].'\' correctamente!';
            
            if ($this->peticion != 'ajax') {
                flash($msg);
            }else{
                //por no tener la clase dato_adicional solo estara en el formulario actual y no en el siguiente
                array_push($okMsg,$msg.' <br> <input type="hidden" name="modificar" value="1">');
                return Response::json($okMsg);
            }
            //echo 'correcto <br>';
        }
    }

    /**
     * Store a newly created InterChange in storage.
     *
     * @param CreateInterChangeRequest $request
     *
     * @return Response
     */
    public function store(CreateInscripcionRequest $request)
    {
        /*
        $input = $request->all();

        $interChange = $this->interChangeRepository->create($input);

        Flash::success('Inter Change saved successfully.');

        return redirect(route('interChanges.index'));
        */
        $tipoInterChange = 'InterOut';
        if($this->tipoInterChange == 'interchanges.interin.store'){
            $tipoInterChange = 'InterIn';
        }

        return $this->storeUpdate($request, 'store', '',$tipoInterChange);
    }


    /**
     * Display the specified InterChange.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id, $peticion = '')
    {

        $inscripcionId = 0;
        $dataInscripcion = '';
        $dataUsers = 0;
        $pasoInscripcion = '';
        $archivosAdjuntos = '';
        $estudiante = 0;
        $viewWith = [];

        $tipoInterChange = 'InterOut';
        if ($this->tipoInterChange == 'interchanges.interin.create') {
            $tipoInterChange = 'InterIn';
        }

        $inscripcion = $this->interChangeRepository->findWithoutFail($id);

        if (empty($inscripcion)) {
            Flash::error('Inscripcion no encontrada');

            return redirect(route('interChanges.'.strtolower($tipoInterChange).'.index'));
        }else{
            $inscripcionId = $inscripcion->id;

            if ($peticion != '') {
                $this->peticion = $peticion;
            }

            $paso_titulo = $this->tipoPaso->where('nombre','like','%_inscripcion')->select('titulo',DB::raw('replace(substr(nombre,instr(nombre,"paso")+4,2),"_","") AS orden'))->pluck('titulo','orden');
            //se tiene que definir cual es el paso que tendra asociado archivos adjuntos y settearlo aqui
            $tipo_paso = $this->tipoPaso->where('nombre', 'paso4_inscripcion')->pluck('id');

            //solicita los datos de la inscripcion
            $viewWith = $this->datosInscripcion($inscripcionId,'show','ver',$tipo_paso);

            $view = 'InterChanges.show';
            

            //print_r($viewWith);
            if ( $this->peticion == 'local' ) {
                return $viewWith;
            }else{
                $viewWith = array_merge($viewWith, ['tipoInterChange' => $tipoInterChange, 'campusApp' => $this->campusApp]);
                return view($view)->with($viewWith);
            }
                
        }

    }

    /**
     * Show the form for editing the specified InterChange.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoInterChange = 'InterOut';
        $rutaError = route('interChanges.interout.index');
        //el paso es 1 o 5 (pre registro y registro)
        $paso = '1';

        //verifica que ruta se esta usando, interin o interout
        if ($this->tipoInterChange == 'interchanges.interin.edit') {
            $tipoInterChange = 'InterIn';
            $rutaError = route('interChanges.interin.index');
        }
        //busca la inscripcion
        $interChange = $this->interChangeRepository->findWithoutFail($id);

        if (empty($interChange)) {
            Flash::error('No se encuentra el registro del intercambio, recargue la pagina.');

            return redirect($rutaError);
        }

        //obtiene los datos iniciales para los campos de los formularios, como los selects
        $viewWith = $this->create($interChange->id);

        //el tipo de paso enviado sera para mostrar los datos del email registrado
        $tipo_paso = 0;
        //$tipo_paso = $this->tipoPaso->where('nombre', 'paso14_interchange')->pluck('id');

        //obtiene los datos de la inscripcion que ya estan almacenados para los campos de los formularios
        $datosInscripcion = $this->datosInscripcion($interChange->id,'edit','ver',$tipo_paso);

        print_r($dataInscripcion);
        return 'hello';
        //migra los datos en un solo array para poder llenar bien todos los campos 
        $dataInterChange['tipo_tramite'] = $datosInscripcion['datainscripcion']['tipo_tramite_id'];

        //FALTAN LOS DATOS PARA LOS PASOS 5 EN ADELANTE


        $viewWith = array_merge($viewWith, ['interChange' => $dataInterChange, 'paso' => $paso]);

        return view('InterChange.edit')->with($viewWith);
    }

    /**
     * Update the specified InterChange in storage.
     *
     * @param  int              $id
     * @param UpdateInterChangeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInscripcionRequest $request)
    {
        
        $interChange = $this->interChangeRepository->findWithoutFail($id);

        if (empty($interChange)) {
            Flash::error('No se encontro la movilidad');

            return redirect(route('interChanges.index'));
        }
        /*
        $interChange = $this->interChangeRepository->update($request->all(), $id);

        Flash::success('Inter Change updated successfully.');

        return redirect(route('interChanges.index'));
        */

        $tipoInterChange = 'InterOut';
        if($this->tipoInterChange == 'interchanges.interin.store'){
            $tipoInterChange = 'InterIn';
        }

        return $this->storeUpdate($request, 'update', '',$tipoInterChange);
    }

    /**
     * Remove the specified InterChange from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $interChange = $this->interChangeRepository->findWithoutFail($id);

        if (empty($interChange)) {
            Flash::error('Inter Change not found');

            return redirect(route('interChanges.index'));
        }

        $this->interChangeRepository->delete($id);

        Flash::success('Inter Change deleted successfully.');

        return redirect(route('interChanges.index'));
    }


    /**
     * Show the form for editing the specified inscripcion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function datosInscripcion($inscripcionId, $destino, $filtro, $tipo_paso = 0)
    {
        $datosInscripcion = \App\Models\Inscripcion::where('id',$inscripcionId )->first();

        //$roleEstudiante = Role::where('name','estudiante')->pluck('id')->first();

        //buscar el usuario del postulante (coordinador) de la inscripcion
        $postulanteInscripcion = \App\Models\Postulacion::where('postulacion.inscripcion_id',$datosInscripcion->id )
            ->select('postulacion.user_id')->first();

        $inscripcionId = $datosInscripcion->id;
        $postulanteId = $postulanteInscripcion->user_id;
        $estudianteId = $datosInscripcion->user_id;
        
        //buscar el usuario del estudiante de la inscripcion
        $dataUsers = DB::table('users')
                ->leftJoin('datos_personales', 'users.datos_personales_id', '=', 'datos_personales.id')
                ->whereIn('users.id',[ $postulanteId,$estudianteId ])
                ->select('users.id AS usuario_id','users.activo AS usuario_activo','users.name AS usuario_name','users.email AS usuario_email','datos_personales.*')
                ->orderBy('users.id','asc')
                ->get()->toArray();

        $tipoDocumentoUsuarios = DB::table('datos_personales')
                ->join('tipo_documento', 'datos_personales.tipo_documento_id', '=', 'tipo_documento.id')
                ->whereIn('datos_personales.id',array_column($dataUsers, 'id'))
                ->select('datos_personales.id AS datos_personales_id','tipo_documento.id AS tipo_documento_id','tipo_documento.nombre AS tipo_documento_nombre' )
                ->get()->toArray();

        $programaUsuarios = DB::table('matricula')
                ->join('programa', 'matricula.programa_id', '=', 'programa.id')
                ->join('facultad', 'programa.facultad_id', '=', 'facultad.id')
                ->whereIn('matricula.user_id',[$postulanteId,$estudianteId])
                ->select('matricula.user_id AS usuario_id','programa.id AS programa_id','programa.nombre AS programa_nombre','facultad.id AS facultad_id','facultad.nombre AS facultad_nombre' )
                ->groupBy('programa.id')
                ->orderBy('matricula.user_id','asc')
                ->get()->toArray();
        //print_r($programaUsuarios);

        $institucionUsuarios = DB::table('user_campus')
                ->join('campus', 'user_campus.campus_id', '=', 'campus.id')
                ->join('institucion', 'campus.institucion_id', '=', 'institucion.id')
                ->whereIn('user_campus.user_id',[$postulanteId,$estudianteId])
                ->select('user_campus.user_id AS usuario_id','campus.id AS campus_id','campus.ciudad_id AS campus_ciudad_id','institucion.id AS institucion_id','institucion.nombre AS institucion_nombre' )
                ->groupBy('institucion.id')
                ->orderBy('user_campus.user_id','asc')
                ->get()->toArray();

        $ciudadesInstituciones = DB::table('campus')
                ->join('ciudad', 'campus.ciudad_id', '=', 'ciudad.id')
                ->join('departamento', 'ciudad.departamento_id', '=', 'departamento.id')
                ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                ->whereIn('campus.institucion_id',array_column($institucionUsuarios, 'institucion_id'))
                ->groupBy('campus.institucion_id')
                ->select('campus.institucion_id','pais.id AS pais_id','pais.nombre AS pais_nombre','ciudad.id AS ciudad_id','ciudad.nombre AS ciudad_nombre')
                ->get()->toArray();


        //asociar los datos de la ciudad a la institucion
        foreach ($institucionUsuarios as $data => $institucion) {
            foreach ($ciudadesInstituciones as $data => $ciudad) {
                if ($institucion->institucion_id == $ciudad->institucion_id) {
                    $institucion->ciudad = $ciudad;
                }
            }
        }

        foreach ($dataUsers as $data => $user) {
            //asociar los datos de la institucion al usuario
            foreach ($institucionUsuarios as $data => $institucion) {
                if ($user->usuario_id == $institucion->usuario_id) {
                    $user->institucion = $institucion;
                }
            }
            //asociar los datos del tipo de documento al usuario
            foreach ($tipoDocumentoUsuarios as $data => $tipoDocumento) {
                if ($user->id == $tipoDocumento->datos_personales_id) {
                    $user->tipoDocumento = $tipoDocumento;
                }
            }
            //asociar los datos del programa al usuario
            foreach ($programaUsuarios as $data => $programa) {
                if ($user->usuario_id == $programa->usuario_id) {
                    $user->programa = $programa;
                }
            }
        }

        $dataUsers = json_decode(json_encode($dataUsers),true);
        //print_r($dataUsers);

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' ) {

            $dataInscripcion = json_decode(json_encode($datosInscripcion),true);

            $dataPeriodo = \App\Models\Inscripcion::join('periodo', 'inscripcion.periodo_id', '=', 'periodo.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('periodo.id AS periodo_id','periodo.nombre AS periodo_nombre' )
                    ->first()
                    ->toArray();

            $dataPeriodo = json_decode(json_encode($dataPeriodo),true);

            $dataModalidades = \App\Models\Inscripcion::join('modalidades', 'inscripcion.modalidades_id', '=', 'modalidades.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('modalidades.id AS modalidades_id','modalidades.nombre AS modalidades_nombre' )
                    ->first()
                    ->toArray();
            $dataModalidades = json_decode(json_encode($dataModalidades),true);

            $dataCampus = \App\Models\Inscripcion::join('campus', 'inscripcion.campus_id', '=', 'campus.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('campus.id AS campus_id','campus.ciudad_id AS campus_ciudad_id','campus.institucion_id AS campus_institucion_id' )
                    ->first();

            $dataInstitucion = \App\Models\Admin\Institucion::where('institucion.id', $dataCampus->campus_institucion_id)
                    ->select('institucion.id AS institucion_id','institucion.nombre AS institucion_nombre')
                    ->first()
                    ->toArray();
            $dataInstitucion = json_decode(json_encode($dataInstitucion),true);

            $dataPaises = \App\Models\Admin\State::join('ciudad', 'departamento.id', '=', 'ciudad.departamento_id')
                    ->join('pais', 'departamento.pais_id', '=', 'pais.id')
                    ->where('ciudad.id', $dataCampus->campus_ciudad_id)
                    ->select('pais.id AS pais_id','pais.nombre AS pais_nombre')
                    ->first()
                    ->toArray();
            $dataPaises = json_decode(json_encode($dataPaises),true);

            $dataProgramaOrigen = \App\Models\Inscripcion::join('programa', 'inscripcion.programa_origen_id', '=', 'programa.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('programa.id AS programa_id','programa.nombre AS programa_nombre' )
                    ->get()
                    ->toArray();
            $dataProgramaOrigen = json_decode(json_encode($dataProgramaOrigen),true);

            $dataProgramaDestino = \App\Models\Inscripcion::join('programa', 'inscripcion.programa_destino_id', '=', 'programa.id')
                    ->where('inscripcion.id',$inscripcionId )
                    ->select('programa.id AS programa_id','programa.nombre AS programa_nombre' )
                    ->get()
                    ->toArray();
            $dataProgramaDestino = json_decode(json_encode($dataProgramaDestino),true);

            $dataInscripcion['periodo'] = $dataPeriodo;
            $dataInscripcion['modalidades'] = $dataModalidades;
            $dataInscripcion['paises'] = $dataPaises;
            $dataInscripcion['institucion'] = $dataInstitucion;
            $dataInscripcion['programaOrigen'] = $dataProgramaOrigen;
            $dataInscripcion['programaDestino'] = $dataProgramaDestino;

            
            if ( !empty($tipo_paso) && count($tipo_paso) ) {
                $tipo_paso = (int) implode('', $tipo_paso);
                
                $dataMail = DB::table('pasos_inscripcion')
                        ->join('pasos_inscripcion_mail', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_mail.pasos_inscripcion_id')
                        ->join('mail', 'pasos_inscripcion_mail.mail_id', '=', 'mail.id')
                        ->where('pasos_inscripcion.inscripcion_id',$inscripcionId )
                        ->where('pasos_inscripcion.tipo_paso_id',$tipo_paso )
                        ->select('pasos_inscripcion.id AS pasos_inscripcion_id','mail.id')
                        ->orderBy('mail.created_at','desc')
                        ->get();
                
                $archivosAdjuntos = '';
                if (count($dataMail)) {
                    $archivosAdjuntos = DB::table('pasos_inscripcion')
                            ->join('pasos_inscripcion_mail', 'pasos_inscripcion.id', '=', 'pasos_inscripcion_mail.pasos_inscripcion_id')
                            ->join('mail', 'pasos_inscripcion_mail.mail_id', '=', 'mail.id')
                            ->join('mail_archivo', 'mail.id', '=', 'mail_archivo.mail_id')
                            ->join('archivo', 'mail_archivo.archivo_id', '=', 'archivo.id')
                            ->join('formato', 'archivo.formato_id', '=', 'formato.id')
                            ->where('pasos_inscripcion.id',$dataMail[0]->pasos_inscripcion_id) 
                            ->where('mail.id',$dataMail[0]->id) 
                            ->where('pasos_inscripcion.inscripcion_id',$inscripcionId) 
                            ->orderBy('mail.id','desc')
                            ->select('archivo.*','formato.nombre AS formato_nombre');
                    //echo $archivosAdjuntos->toSql().' |$dataMail[0]->pasos_inscripcion_id:'.$dataMail[0]->pasos_inscripcion_id.' |$dataMail[0]->id:'.$dataMail[0]->id.' |$inscripcionId:'.$inscripcionId;
                    $archivosAdjuntos = $archivosAdjuntos->get()->toArray();
                }
            }

            
        }

        $keyPostulanteId = array_search($postulanteId, array_column($dataUsers, 'usuario_id'));
        $keyEstudianteId = array_search($estudianteId, array_column($dataUsers, 'usuario_id'));   


        $viewWith = ['inscripcionId' => $inscripcionId, 'dataInscripcion' => $dataInscripcion, 'dataUsers' => $dataUsers, 'postulanteId' => $postulanteId, 'estudianteId' => $estudianteId, 'keyPostulanteId' => $keyPostulanteId, 'keyEstudianteId' => $keyEstudianteId,'peticion' => $this->peticion];

        if ($destino == 'mail' || $destino == 'show' || $destino == 'edit' ) {
            if ( $filtro == 'declinado' ) {
                return $viewWith;
            }elseif ( $filtro == 'ver' ) {

                $viewWith = array_merge($viewWith, ['paso_titulo' => $this->paso_titulo]);
            }
        }
        if ($destino == 'crearMail' && $filtro == 'nuevo' ) {

            $viewWith = ['dataUsers' => $dataUsers, 'keyPostulanteId' => $keyPostulanteId, 'keyEstudianteId' => $keyEstudianteId];
            
        }

        if (!empty($tipo_paso) && count($tipo_paso)) {

            $viewWith = array_merge($viewWith, ['archivosAdjuntos' => $archivosAdjuntos]);
            
        }
        
        return $viewWith;
    }

    public function crearInscripcion($tipo,$dataInscripcion,$rol)
    {
        $retorno = false;
        $inscripcionId = 0;
        $inscripcionFind = '';

        if( $tipo == 'nuevo' ){
            if ( $newInscripcion = \App\Models\Inscripcion::create($dataInscripcion) ) {
                $inscripcionId = $newInscripcion->id;
                
                //if ( $rol == 'coordinador' ){

                    //crear el registro de quien hizo la postulacion del estudiante para el intercambio
                    $postulacion = \App\Models\Postulacion::create(['user_id' => $this->user->id, 'inscripcion_id' => $inscripcionId]);
                    
                    $retorno = $newInscripcion;
                    //$inscripcionFind = $newInscripcion;

                //};

            } else {
                $retorno = 'error_inscripcion';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){
            $actualizarInscripcion = \App\Models\Inscripcion::find($dataInscripcion['id']);
            if ( count($actualizarInscripcion) > 0 ) {
                $inscripcionId = $actualizarInscripcion->id;

                if (isset($dataInscripcion['user_id'])) {
                    $actualizarInscripcion->user_id = $dataInscripcion['user_id'];
                }
                if (isset($dataInscripcion['fecha'])) {
                    $actualizarInscripcion->fecha = $dataInscripcion['fecha'];
                }
                if (isset($dataInscripcion['periodo_id'])) {
                    $actualizarInscripcion->periodo_id = $dataInscripcion['periodo_id'];
                }
                if (isset($dataInscripcion['campus_id'])) {
                    $actualizarInscripcion->campus_id = $dataInscripcion['campus_id'];
                }
                if (isset($dataInscripcion['modalidades_id'])) {
                    $actualizarInscripcion->modalidades_id = $dataInscripcion['modalidades_id'];
                }
                if (isset($dataInscripcion['programa_origen_id'])) {
                    $actualizarInscripcion->programa_origen_id = $dataInscripcion['programa_origen_id'];
                }
                if (isset($dataInscripcion['programa_destino_id'])) {
                    $actualizarInscripcion->programa_destino_id = $dataInscripcion['programa_destino_id'];
                }
                if (isset($dataInscripcion['fecha_inicio'])) {
                    $actualizarInscripcion->fecha_inicio = $dataInscripcion['fecha_inicio'];
                }
                if (isset($dataInscripcion['fecha_fin'])) {
                    $actualizarInscripcion->fecha_fin = $dataInscripcion['fecha_fin'];
                }
                if (isset($dataInscripcion['presupuesto_hospedaje'])) {
                    $actualizarInscripcion->presupuesto_hospedaje = $dataInscripcion['presupuesto_hospedaje'];
                }
                if (isset($dataInscripcion['presupuesto_alimentacion'])) {
                    $actualizarInscripcion->presupuesto_alimentacion = $dataInscripcion['presupuesto_alimentacion'];
                }
                if (isset($dataInscripcion['presupuesto_transporte'])) {
                    $actualizarInscripcion->presupuesto_transporte = $dataInscripcion['presupuesto_transporte'];
                }
                if (isset($dataInscripcion['presupuesto_otros'])) {
                    $actualizarInscripcion->presupuesto_otros = $dataInscripcion['presupuesto_otros'];
                }

                //guardar los cambios en el usuario y sus datos personales
                $actualizarInscripcion->push(); 

                $retorno = $actualizarInscripcion;
                //$inscripcionFind = $actualizarInscripcion;

            }else{
                $retorno = 'error_inscripcion';
                goto end;
            }

        }
        end:
        return $retorno;
    }

    public function crearUsuario($tipo,$dataUser,$rol,$campus,$datosPersonales,$interchange)
    {
        $retorno = false;
        $userId = 0;
        $userFind = '';

        if( $tipo == 'nuevo' ){
            if ( $newUser = User::create($dataUser) ) {
                $userId = $newUser->id;
                
                if ($datos_personales = \App\Models\DatosPersonales::create($datosPersonales) ){

                    $newUser->datos_personales_id = $datos_personales->id;
                    $newUser->save();

                    $tipo = 'estudiante';
                    
                    $asociarUsuario = $this->asociarUsuario($tipo,$userId,$rol,$campus,$interchange);
                    if ( $asociarUsuario == 'error_usuario' ) {
                        $retorno = 'error_asociar';
                        goto end;
                    }
                    
                    $retorno = $newUser;
                    //$userFind = $newUser;

                } else {
                    $retorno = 'error_datos_personales';
                    goto end;

                };

            } else {
                $retorno = 'error_usuario';
                goto end;
            }
        }elseif( $tipo == 'actualizar' ){
            $actualizarUser = User::find($dataUser['id']);
            if ( count($actualizarUser) > 0 ) {
                $userId = $actualizarUser->id;

                if (isset($dataUser['name'])) {
                    $actualizarUser->name = $dataUser['name'];
                }
                if (isset($dataUser['email'])) {
                    if ( $actualizarUser->email != $dataUser['email'] ) {
                        $actualizarUser->activo = 1;
                    }

                    $actualizarUser->email = $dataUser['email'];

                }

                
                if (isset($datosPersonales['nombres'])) {
                    $actualizarUser->datos_personales->nombres = $datosPersonales['nombres'];
                }
                if (isset($datosPersonales['apellidos'])) {
                    $actualizarUser->datos_personales->apellidos = $datosPersonales['apellidos'];
                }
                if (isset($datosPersonales['tipo_documento_id'])) {
                    $actualizarUser->datos_personales->tipo_documento_id = $datosPersonales['tipo_documento_id'];
                }
                if (isset($datosPersonales['numero_documento'])) {
                    $actualizarUser->datos_personales->numero_documento = $datosPersonales['numero_documento'];
                }
                if (isset($datosPersonales['ciudad_residencia_id'])) {
                    $actualizarUser->datos_personales->ciudad_residencia_id = $datosPersonales['ciudad_residencia_id'];
                }
                if (isset($datosPersonales['email_personal'])) {
                    $actualizarUser->datos_personales->email_personal = $datosPersonales['email_personal'];
                }
                if (isset($datosPersonales['codigo_institucion'])) {
                    $actualizarUser->datos_personales->codigo_institucion = $datosPersonales['codigo_institucion'];
                }
                if (isset($datosPersonales['telefono'])) {
                    $actualizarUser->datos_personales->telefono = $datosPersonales['telefono'];
                }
                if (isset($datosPersonales['cargo'])) {
                    $actualizarUser->datos_personales->cargo = $datosPersonales['cargo'];
                }
                if (isset($datosPersonales['promedio_acumulado'])) {
                    $actualizarUser->datos_personales->promedio_acumulado = $datosPersonales['promedio_acumulado'];
                }
                if (isset($datosPersonales['porcentaje_aprobado'])) {
                    $actualizarUser->datos_personales->porcentaje_aprobado = $datosPersonales['porcentaje_aprobado'];
                }

                //guardar los cambios en el usuario y sus datos personales
                $actualizarUser->push(); 


                //asociar al estudiante con el programa a travez de la matricula
                if (isset($dataUser['programa_id'])) {
                    
                    //en caso de no estar activo (ser nuevo usuario)
                    if ($actualizarUser->activo == 1) {
                        //crear una nueva matricula
                        $matricula = \App\Models\Matricula::firstOrCreate(['user_id' => $userId, 'programa_id' => $dataUser['programa_id']]);
                        //$actualizarUser->matricula->delete();
                        //quitar todas las demas matriculas
                        $matriculas = \App\Models\Matricula::where('user_id',$userId)->where('programa_id','<>',$dataUser['programa_id'])->delete();
                    }else{
                        //agregar una matricula
                        $matricula = \App\Models\Matricula::firstOrCreate(['user_id' => $userId, 'programa_id' => $dataUser['programa_id']]);
                    }
                }

                $retorno = $actualizarUser;
                //$userFind = $actualizarUser;

            }else{
                $retorno = 'error_usuario';
                goto end;
            }

        }
        end:
        return $retorno;
    }

    public function asociarUsuario($tipo,$datos,$rol,$campus,$interchange)
    {
        $retorno = false;
        $role = Role::where('name',$rol)->get();

        $usuario = User::find($datos);
        if (!count($usuario)) {
            $retorno = 'error_usuario';
            goto end;
        }
        //ASIGNAR EL ROL DE estudiante 

        if ( !$usuario->hasAllRoles($role) ) {
            $usuario->assignRole($rol);
        }

        //ASIGNAR EL campus al estudiante
        $usuario->campus()->syncWithoutDetaching($campus);
        
        switch ($tipo) {
            case 'estudiante':

                $retorno = $usuario;
                
                break;
            case 'coordinador_externo':

                $retorno = $usuario;
                
                break;        
        }

        end:
        return $retorno;
    }
}
