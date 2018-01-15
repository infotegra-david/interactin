<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateInstitucionRequest;
use App\Http\Requests\Admin\UpdateInstitucionRequest;
use App\Repositories\Admin\InstitucionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\AdminDocs;

class InstitucionController extends AppBaseController
{
    use AdminDocs;

    /** @var  InstitucionRepository */
    private $institucionRepository;
    private $instituciones = array(null => null);

    private $user;
    private $campusApp;
    private $campusAppFound;
    private $peticion;
    private $viewWith;

    public function __construct(InstitucionRepository $institucionRepo, Request $request)
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
            
            $this->viewWith = ['campusApp' => $this->campusApp];

            return $next($request);
        });

        $this->institucionRepository = $institucionRepo;
        //valida si es una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

    }

    /**
     * Display a listing of the Institucion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->institucionRepository->pushCriteria(new RequestCriteria($request));
        $institucions = $this->institucionRepository->all();

        $this->viewWith = array_merge($this->viewWith,['institucions' => $institucions]);

        return view('admin.instituciones.index')
            ->with($this->viewWith);
    }

    /**
     * Show the form for creating a new Institucion.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.instituciones.create');
    }

    /**
     * Store a newly created Institucion in storage.
     *
     * @param CreateInstitucionRequest $request
     *
     * @return Response
     */
    public function store(CreateInstitucionRequest $request)
    {
        $input = $request->all();

        $institucion = $this->institucionRepository->create($input);

        Flash::success('Institucion saved successfully.');

        return redirect(route('admin.institutions.index'));
    }

    /**
     * Display the specified Institucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $institucion = $this->institucionRepository->findWithoutFail($id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['institucion' => $institucion]);

        return view('admin.instituciones.show')->with($this->viewWith);
    }

    /**
     * Show the form for editing the specified Institucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $institucion = $this->institucionRepository->findWithoutFail($id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['institucion' => $institucion]);

        return view('admin.instituciones.edit')->with($this->viewWith);
    }

    /**
     * Update the specified Institucion in storage.
     *
     * @param  int              $id
     * @param UpdateInstitucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInstitucionRequest $request)
    {
        $institucion = $this->institucionRepository->findWithoutFail($id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }

        $institucion = $this->institucionRepository->update($request->all(), $id);

        Flash::success('Institucion updated successfully.');

        return redirect(route('admin.institutions.index'));
    }

    /**
     * Remove the specified Institucion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $institucion = $this->institucionRepository->findWithoutFail($id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }

        $this->institucionRepository->delete($id);

        Flash::success('Institucion deleted successfully.');

        return redirect(route('admin.institutions.index'));
    }

    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function listInstitutions(Request $request)
    {
        $institucion_id = \Config::get('options.institucion_id');
        if (!empty($this->campusApp)) {
            $institucion_id = $this->user->campus[0]->institucion->id;
        }

        $pais_id = $request->pais_id ?? $request->id;
        $modalidad_id = $request->modalidad_id ?? $request->inscripcion_modalidad ?? $request->val_extra;
        
        $this->instituciones = $this->institucionRepository->listInstitutions($institucion_id,$pais_id,$modalidad_id);
        return $this->instituciones;
    }

    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function documents($institucion_id,$documento_id = '',Request $request)
    {
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $this->user = Auth::user();
        $user_actual = $this->user->id;
        $viewWith = $this->viewWith;
        $showData = '';
        $keyWords = '';
        
        $institucion = $this->institucionRepository->findWithoutFail($institucion_id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }
        $institucionId = $institucion->id;
        $route_default = route('admin.institutions.documents',$institucionId);
        
        $view = 'files.show';
        $route_back = $route_default;
        $route_new = route('admin.institutions.documents.create',$institucionId);

        if ($documento_id != '') {
            $archivo_id = $documento_id;

            $archivo = \App\Models\Archivo::join('tipo_archivo','archivo.tipo_archivo_id','tipo_archivo.id')
                ->select('archivo.id','archivo.nombre','archivo.path','tipo_archivo.nombre AS tipo_archivo_nombre')
                ->where('archivo.id',$archivo_id)
                ->first();


            if ( count($archivo) ) {
                if ( $archivo->tipo_archivo_nombre == 'PRE-FORMA') {
                    $view = 'files.editor_word_drag_drop';
                }else{
                    $view = 'files.editor';
                }
                $tipo_archivo = $archivo->tipo_archivo_nombre;

                $viewError = 'admin.institutions.index';

                $datosDocumento = $this->verDocumento('institucion',['tipo_archivo' => $tipo_archivo, 'archivo_id' => $archivo_id, 'institucionId' => $institucionId, 'view' => $viewError, 'peticion' => 'local' ]);

                if ( $datosDocumento === 'error_documento' ) {

                    $view = $route_default;
                    $errors += 1;
                    $errorsMsg = 'No se encontro el documento.';
                    goto end;
                }elseif ( $datosDocumento === 'seleccione_documento' ) {

                    $view = $route_default;
                    $errors += 1;
                    $errorsMsg = 'Seleccione un documento.';
                    goto end;
                }elseif ( is_string($datosDocumento) ) {

                    $view = $route_default;
                    $errors += 1;
                    $errorsMsg = 'Ocurrio un error: '.$datosDocumento;
                    goto end;
                }

            
                if ( $archivo->tipo_archivo_nombre == 'PRE-FORMA') {
                    $showData = 'keyword';
                    $keyWords = $this->keyWordsData();
                }

                $viewWith = array_merge($viewWith, $datosDocumento);
                $ruta_guardar = ['admin.institutions.documents.store',$institucionId];
                $editar = ['nombre' => true, 'tipo_documento' => true];
                $clase_documento = \App\Models\ClaseDocumento::whereIn('nombre',['INSTITUCION'])->pluck('id')->toArray();
                $tipo_documento = \App\Models\TipoDocumento::whereIn('clase_documento_id',$clase_documento)
                    ->select('id','nombre')
                    ->orderby('clase_documento_id','asc')
                    ->orderby('nombre','asc')
                    ->pluck('nombre','id');

                $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'ruta_guardar' => $ruta_guardar, 'editar' => $editar, 'tipo_archivo' => $tipo_archivo, 'tipo_documento' => $tipo_documento, 'keyWords' => $keyWords, 'route_back' => $route_back, 'showData' => $showData, 'menuApp' => 'Institutions', 'submenu1App' => 'Editar Documento']);

                
            }else{
                $view = $route_default;
                $errors += 1;
                $errorsMsg = 'Sin acciones.';
                goto end;
            }
        }else{
            $archivos = \App\Models\Archivo::join('documentos_institucion','archivo.id','documentos_institucion.archivo_id')
                ->join('tipo_archivo','archivo.tipo_archivo_id','tipo_archivo.id')
                ->join('tipo_documento','documentos_institucion.tipo_documento_id','tipo_documento.id')
                ->select('archivo.id','archivo.nombre','archivo.path','tipo_archivo.id AS tipo_archivo_id','tipo_archivo.nombre AS tipo_archivo_nombre','tipo_documento.nombre AS tipo_documento_nombre')
                ->where('documentos_institucion.institucion_id',$institucionId);

            $select_filter = ['all' => 'Todos','pre-formas' => 'Pre-formas','documentos' => 'Documentos'];
            $filter = 'all';

            if (isset($request['filter'])) {
                if ($request['filter'] == 'all') {
                    $filter = $request['filter'];
                    //no se ejecutan acciones, se mostraran todos los documentos
                }elseif($request['filter'] == 'pre-formas'){
                    $filter = $request['filter'];
                    $tipo_archivo = \App\Models\TipoArchivo::where('nombre','PRE-FORMA')->first();
                    
                    $archivos = $archivos->where('tipo_archivo.id',$tipo_archivo->id);
                }elseif($request['filter'] == 'documentos'){
                    $filter = $request['filter'];
                    $tipo_archivo = \App\Models\TipoArchivo::where('nombre','DOCUMENTO')->first();

                    $archivos = $archivos->where('tipo_archivo.id',$tipo_archivo->id);
                }
            }
            
            $archivos = $archivos->get();

            foreach ($archivos as $key => $value) {
                $value->url_edit = route('admin.institutions.documents',[$institucionId,$value->id]);
            }
            
            $route_back = route('admin.institutions.index');
            $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'archivos' => $archivos, 'institucionId' => $institucionId, 'filter' => $filter, 'select_filter' => $select_filter, 'route_back' => $route_back, 'route_new' => $route_new, 'proceso' => 'Institución', 'menuApp' => 'Institutions', 'submenu1App' => 'Archivos']);
        }

        
        //print_r($viewWith);

        end:
        if ($errors > 0) {
            //echo 'error <br>';

            if ( $this->peticion == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                return redirect($view);
            }
        }else{

            if ( $this->peticion == 'local' || $this->peticion == 'ajax') {
                return $viewWith;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return view($view)->with($viewWith);
            }
        }
    }

    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function documents_create($institucion_id)
    {
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = 'files.editor_word_drag_drop';
        $this->user = Auth::user();
        $user_actual = $this->user->id;
        $viewWith = $this->viewWith;
        $showData = '';
        $keyWords = '';
        
        $institucion = $this->institucionRepository->findWithoutFail($institucion_id);

        if (empty($institucion)) {
            Flash::error('Institucion not found');

            return redirect(route('admin.institutions.index'));
        }
        $institucionId = $institucion->id;

        $route_back = route('admin.institutions.documents',$institucionId);

        
        $showData = 'keyword';
        $keyWords = $this->keyWordsData();

        $viewWith = array_merge($viewWith, ['documento' => ['id' => 0, 'nombre' => 'Nuevo documento', 'formato' => '*']]);
        $ruta_guardar = ['admin.institutions.documents.store',$institucionId];
        $editar = ['nombre' => true, 'tipo_documento' => true, 'archivo_input' => true];
        $clase_documento = \App\Models\ClaseDocumento::whereIn('nombre',['INSTITUCION'])->pluck('id')->toArray();
        $tipo_documento = \App\Models\TipoDocumento::whereIn('clase_documento_id',$clase_documento)
            ->select('id','nombre')
            ->orderby('clase_documento_id','asc')
            ->orderby('nombre','asc')
            ->pluck('nombre','id');
        
        $pre_forma = $tipo_documento->toArray();
        $pre_forma_id = array_search('PRE-FORMAS',$pre_forma);

        $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'ruta_guardar' => $ruta_guardar, 'editar' => $editar, 'pre_forma_id' => $pre_forma_id, 'tipo_archivo' => '', 'tipo_documento' => $tipo_documento, 'route_back' => $route_back, 'keyWords' => $keyWords, 'showData' => $showData, 'proceso' => 'Institución', 'menuApp' => 'InterAdmin', 'submenu1App' => 'Crear Documento']);
        
        //print_r($viewWith);

        end:
        if ($errors > 0) {
            //echo 'error <br>';

            if ( $this->peticion == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                return redirect($view);
            }
        }else{

            if ( $this->peticion == 'local' || $this->peticion == 'ajax') {
                return $viewWith;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return view($view)->with($viewWith);
            }
        }
    }

    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function documents_store($institucion_id,Request $request)
    {
        //$proceso [institucion,iniciativa,inscripcion,validador],$datos [view,institucionId,origen,tipo_documento,archivo_id,archivo_nombre,archivo_contenido,archivo_input,user_id,route_error]
        $peticion = (isset($request['peticion']) ? $request['peticion'] : $this->peticion );
        // return $request->all();
        $this->validate($request, [
            'tipo_documento' => 'required',
        ]);
        
        $errorsMsg = '';
        $okMsg = '';
        $errors = 0;
        $route = (isset($request['route']) ? $request['route'] : route('admin.institutions.documents',$institucion_id) );
        $route_error = route('admin.institutions.documents',$institucion_id);

        $this->user = Auth::user();

        if ( $request->file('archivo_input') != null ) {
            $this->validate($request, [
                'archivo_input' => 'required|mimes:pdf,jpg,png,jpeg',
            ]);
            $datos['nombre'] = str_replace(' ', '_', $request->file('archivo_input')->getClientOriginalName());
            $datos['archivo_formato'] = $request->file('archivo_input')->getClientOriginalExtension();
            $datos['archivo_MimeType'] = $request->file('archivo_input')->getClientMimeType();
            $request['archivo_input'] = \File::get($request->file('archivo_input'));
        }

        $proceso = 'institucion';
        $datos['institucionId'] = $institucion_id;
        $datos['peticion'] = 'local';
        $datos['user_id'] = $this->user->id;
        $datos['route'] = $route;
        $datos['route_error'] = $route_error;
        $datos['nombre'] = (isset($request['nombre']) ? $request['nombre'] : $datos['nombre']);
        $datos['archivo_id'] = (isset($request['archivo_id']) ? $request['archivo_id'] : 0);;
        $datos['archivo_contenido'] = $request['archivo_contenido'];
        $datos['archivo_input'] = (isset($request['archivo_input']) ? $request['archivo_input'] : '');
        $datos['tipo_documento'] = $request['tipo_documento'];

        $tipo_documento = \App\Models\TipoDocumento::where('id',$datos['tipo_documento'])
                    ->select('id','nombre')->first();

        //unique se coloca si debe eliminar los demas archivos del mismo tipo, de lo contrario se omite
        if ($tipo_documento->nombre != 'PRE-FORMAS') {
            $datos['unique'] = true;
        }
        
        // print_r($request->all());
        // return 1;
        
        $crearDocumento = $this->datosCrearDocumento($proceso,$datos);
        if (is_string($crearDocumento) ) {
            $errors += 1;
            $errorsMsg = 'Ocurrio un error: '.$crearDocumento;
            goto end;
        }else{
            $okMsg = 'El documento fue almacenado correctamente.';
        }

        
        end:
        // return $crearDocumento;

        if( isset($request['peticion']) && $request['peticion'] == 'local' ){
            if ($errors == 0) {
                $okMsg = $crearDocumento;
            }
        }

        
        // return $crearDocumento;
        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ( $peticion == 'local' ) {
                return $errorsMsg;
            }else if ($peticion == 'ajax') {
                return Response::json($errorsMsg, 422);
            }else{
                Flash::error($errorsMsg);
                return redirect($route_error);
            }
        }else{
            DB::commit();
            
            if ( $peticion == 'local' || $peticion == 'ajax') {
                return $okMsg;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return redirect($route);
            }
        }

    }

    
    /**
     * Lista los departamentos segun el id del pais pasado por parametro.
     *
     * @param  int $id_pais
     *
     * @return Response
     */
    public function keyWordsData()
    {
        
        $keyWords = array(
            'COORDINADOR_INTERNO_NOMBRE' => array('keyword' => 'COORDINADOR_INTERNO_NOMBRE', 'name' => 'coordinador interno nombre'),
            'COORDINADOR_INTERNO_CARGO' => array('keyword' => 'COORDINADOR_INTERNO_CARGO', 'name' => 'coordinador interno cargo'),
            'COORDINADOR_INTERNO_TELEFONO' => array('keyword' => 'COORDINADOR_INTERNO_TELEFONO', 'name' => 'coordinador interno telefono'),
            'COORDINADOR_INTERNO_EMAIL' => array('keyword' => 'COORDINADOR_INTERNO_EMAIL', 'name' => 'coordinador interno email'),

            'COORDINADOR_EXTERNO_NOMBRE' => array('keyword' => 'COORDINADOR_EXTERNO_NOMBRE', 'name' => 'coordinador externo nombre'),
            'COORDINADOR_EXTERNO_CARGO' => array('keyword' => 'COORDINADOR_EXTERNO_CARGO', 'name' => 'coordinador externo cargo'),
            'COORDINADOR_EXTERNO_TELEFONO' => array('keyword' => 'COORDINADOR_EXTERNO_TELEFONO', 'name' => 'coordinador externo telefono'),
            'COORDINADOR_EXTERNO_EMAIL' => array('keyword' => 'COORDINADOR_EXTERNO_EMAIL', 'name' => 'coordinador externo email'),

            'REPRESENTANTE_NOMBRE' => array('keyword' => 'REPRESENTANTE_NOMBRE', 'name' => 'representante nombre'),
            'REPRESENTANTE_CARGO' => array('keyword' => 'REPRESENTANTE_CARGO', 'name' => 'representante cargo'),
            'REPRESENTANTE_TELEFONO' => array('keyword' => 'REPRESENTANTE_TELEFONO', 'name' => 'representante telefono'),
            'REPRESENTANTE_EMAIL' => array('keyword' => 'REPRESENTANTE_EMAIL', 'name' => 'representante email'),

            'INSTITUCION_ORIGEN_TIPO' => array('keyword' => 'INSTITUCION_ORIGEN_TIPO', 'name' => 'institucion origen tipo'),
            'INSTITUCION_ORIGEN_NOMBRE' => array('keyword' => 'INSTITUCION_ORIGEN_NOMBRE', 'name' => 'institucion origen nombre'),
            'INSTITUCION_ORIGEN_DIRECCION_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_DIRECCION_CAMPUS_P', 'name' => 'institucion origen direccion campus principal'),
            'INSTITUCION_ORIGEN_TELEFONO_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_TELEFONO_CAMPUS_P', 'name' => 'institucion origen telefono campus principal'),
            'INSTITUCION_ORIGEN_POSTAL_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_POSTAL_CAMPUS_P', 'name' => 'institucion origen postal campus principal'),
            'INSTITUCION_ORIGEN_PAIS_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_PAIS_CAMPUS_P', 'name' => 'institucion origen_pais campus principal'),
            'INSTITUCION_ORIGEN_CIUDAD_CAMPUS_P' => array('keyword' => 'INSTITUCION_ORIGEN_CIUDAD_CAMPUS_P', 'name' => 'institucion origen ciudad campus principal'),

            'INSTITUCION_DESTINO_TIPO' => array('keyword' => 'INSTITUCION_DESTINO_TIPO', 'name' => 'institucion destino tipo'),
            'INSTITUCION_DESTINO_NOMBRE' => array('keyword' => 'INSTITUCION_DESTINO_NOMBRE', 'name' => 'institucion destino nombre'),
            'INSTITUCION_DESTINO_DIRECCION_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_DIRECCION_CAMPUS_P', 'name' => 'institucion destino direccion campus principal'),
            'INSTITUCION_DESTINO_TELEFONO_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_TELEFONO_CAMPUS_P', 'name' => 'institucion destino telefono campus principal'),
            'INSTITUCION_DESTINO_POSTAL_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_POSTAL_CAMPUS_P', 'name' => 'institucion destino postal campus principal'),
            'INSTITUCION_DESTINO_PAIS_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_PAIS_CAMPUS_P', 'name' => 'institucion destino pais campus principal'),
            'INSTITUCION_DESTINO_CIUDAD_CAMPUS_P' => array('keyword' => 'INSTITUCION_DESTINO_CIUDAD_CAMPUS_P', 'name' => 'institucion destino ciudad campus principal'),

            'ALIANZA_ID' => array('keyword' => 'ALIANZA_ID', 'name' => 'alianza id'),
            'ALIANZA_TIPO_TRAMITE' => array('keyword' => 'ALIANZA_TIPO_TRAMITE', 'name' => 'alianza tipo tramite'),
            'ALIANZA_FACULTADES' => array('keyword' => 'ALIANZA_FACULTADES', 'name' => 'alianza facultades'),
            'ALIANZA_PROGRAMAS' => array('keyword' => 'ALIANZA_PROGRAMAS', 'name' => 'alianza programas'),
            'ALIANZA_TIPO_ALIANZA' => array('keyword' => 'ALIANZA_TIPO_ALIANZA', 'name' => 'alianza tipo alianza'),
            'ALIANZA_APLICACIONES' => array('keyword' => 'ALIANZA_APLICACIONES', 'name' => 'alianza aplicaciones'),
            'ALIANZA_DURACION' => array('keyword' => 'ALIANZA_DURACION', 'name' => 'alianza duracion'),
            'ALIANZA_OBJETIVO' => array('keyword' => 'ALIANZA_OBJETIVO', 'name' => 'alianza objetivo'),
            'ALIANZA_FECHA_INICIO' => array('keyword' => 'ALIANZA_FECHA_INICIO', 'name' => 'alianza fecha inicio'),
            'ALIANZA_FECHA_FIN' => array('keyword' => 'ALIANZA_FECHA_FIN', 'name' => 'alianza fecha fin'),
            'ALIANZA_FECHA_CREACION' => array('keyword' => 'ALIANZA_FECHA_CREACION', 'name' => 'alianza fecha creacion'),
            'ALIANZA_FECHA_ACTUALIZACION' => array('keyword' => 'ALIANZA_FECHA_ACTUALIZACION', 'name' => 'alianza fecha actualizacion'),
        );
        
        
        return $keyWords;
    }
}
