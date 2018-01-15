<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateDocumentosInstitucionRequest;
use App\Http\Requests\Admin\UpdateDocumentosInstitucionRequest;
use App\Repositories\Admin\DocumentosInstitucionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\Admin\Institucion;
use App\Models\TipoDocumento;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\Http\Traits\AdminDocs;

class DocumentosInstitucionController extends AppBaseController
{
    
    use AdminDocs;

    /** @var  DocumentosInstitucionRepository */
    private $documentosInstitucionRepository;


    private $user;
    private $campusApp;
    private $campusAppFound;
    private $institucion;
    private $tipo_documento;
    private $peticion;
    private $viewWith;

    public function __construct(DocumentosInstitucionRepository $documentosInstitucionRepo, User $userModel, Institucion $institucionModel, TipoDocumento $tipoDocumentoModel, Request $request)
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


        $this->documentosInstitucionRepository = $documentosInstitucionRepo;

        //$this->user = $userModel;
        $this->institucion = $institucionModel;
        $this->tipo_documento = $tipoDocumentoModel;
        //va a mostrar la vista 'tables' en el caso de ser una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }


    }

    /**
     * Display a listing of the DocumentosInstitucion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentosInstitucionRepository->pushCriteria(new RequestCriteria($request));
        $documentosInstitucions = $this->documentosInstitucionRepository->all();

        $this->viewWith = array_merge($this->viewWith,['documentosInstitucions' => $documentosInstitucions]);

        return view('admin.documentos_institucion.index')
            ->with($this->viewWith);
    }

    /**
     * Show the form for creating a new DocumentosInstitucion.
     *
     * @return Response
     */
    public function create()
    {
        
        if (isset($this->user->campus)) {
            $campusId = $this->user->campus;
            //$RouteName = Route::currentRouteName();
            //echo session('campusApp');
            
        }elseif( session('campusApp') != null ){
            $campusAppId = session('campusApp');
            $campusApp = \App\Models\Admin\Campus::find($campusAppId);
            if( !count($campusApp) ){
                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                return redirect(route('admin.documentos_institucion.index'));
            }
            $campusId = [$campusApp->id];
        }else{
            Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

            return redirect(route('admin.documentos_institucion.index'));
        }

                
        //print_r($this->paso_titulo);
        
        $institucion_todos = $this->institucion->join('campus','institucion.id','campus.institucion_id')->whereIn('campus.institucion_id',$campusId)->select('institucion.nombre','institucion.id');
        $institucion = $this->institucion->select(DB::raw("'Otra' AS nombre, '999999' AS id"))->union($institucion_todos)->pluck('nombre','id');
        //agregar el campo 'Otro' para que agreguen una nueva unidad (tipo_documento)
        $tipo_documento = $this->tipo_documento->select(DB::raw("'Otro' AS nombre, '999999' AS id"))->pluck('nombre','id');

        $this->viewWith = array_merge($this->viewWith,['institucion' => $institucion,'tipo_documento' => $tipo_documento]);

        return view('admin.documentos_institucion.create')->with($this->viewWith);
    }

    /**
     * Store a newly created DocumentosInstitucion in storage.
     *
     * @param CreateDocumentosInstitucionRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentosInstitucionRequest $request)
    {
        $errors = 0;
        $errorsMsg = [];
        $okMsg = [];

        $input = $request->all();

        if (isset($input['tipo_documento']) ) {
            if ($input['tipo_documento'] == 'PRE-FORMAS') {
                
            }

            $existeRepresentante == false;
            if ( $existeRepresentante == true ) {
                        
                $tipo_documento_id = \App\Models\TipoDocumento::where('nombre',['REPRESENTACIÓN LEGAL'])->pluck('id')->first();
                $institucion = $this->institucion::find($buscarUserExterno->institucion_id);

                $buscarDocumentoRepresentante = DB::table('documentos_institucion')->where('tipo_documento_id',$tipo_documento_id)
                    ->where('institucion_id',$institucion->id)
                    ->select('id','archivo_id')->get()->toArray();


                if (count($buscarDocumentoRepresentante)) {
                    $archivoDocumentoRepresentante = DB::table('archivo')->whereIn('id',array_column($buscarDocumentoRepresentante, 'archivo_id'))
                        ->select('id','path')->get()->toArray();
                    //print_r($archivoDocumentoRepresentante);
                    if (count($archivoDocumentoRepresentante)) {
                        $nombreArchivo = array_column($archivoDocumentoRepresentante, 'path');
                        \Storage::disk('public')->delete($nombreArchivo);

                        $eliminarDocumentosInstitucion = \App\Models\DocumentosInstitucion::destroy(array_column($buscarDocumentoRepresentante, 'id'));
                        $eliminarArchivo = \App\Models\Archivo::destroy(array_column($archivoDocumentoRepresentante, 'id'));
                    }
                }


            }

            if ( $request->file('archivo_documentos') ) {

                //\Storage::url($enviar_documento['path'])
                $nombre = $request->file('archivo_documento')->getClientOriginalName();
                $formatoArchivo = $request->file('archivo_documento')->getClientOriginalExtension();
                $MimeType = $request->file('archivo_documento')->getClientMimeType();
                $path = 'alianza/'.$alianzaId.'/destination';
                $nombre_archivo = md5($nombre . microtime()). '.' . $formatoArchivo;
                // \Storage::disk('public')->put($path, \File::get($request->file('archivo_documento')));
                $path = Storage::disk('public')->putFileAs(
                    $path, \File::get($request->file('archivo_documentos')), $nombre_archivo
                );
            }elseif($input['archivo_documentos']){

            }

            $formato = \App\Models\Formato::where('nombre',$formatoArchivo)->select('id')->first();
            if ($formato == '') {
                $dataFormato['nombre'] = $formatoArchivo;
                $formato = \App\Models\Formato::create($dataFormato);

            }
            $formato_id = $formato->id;

            $tipo_archivo_id = \App\Models\TipoArchivo::where('nombre','PRE-FORMA')->select('id')->first();
        //permisos_archivo={owner:rwx,group:rw-,other:r--}
            
            DB::beginTransaction();

            foreach ($archivos as $key => $archivo) {
                
                
                $posFirst = strpos($archivo, 'os/'); //Only return first match
                $posSecond = strpos($archivo, '.'); //Only return first match
                
                $nombre = substr($archivo, $posFirst +3, $posSecond - ($posFirst+3) );

                $dataArchivo['nombre'] = $nombre;
                $dataArchivo['path'] = $archivo;
                $dataArchivo['user_id'] = $this->user->id;
                $dataArchivo['formato_id'] = $formato_id;
                $dataArchivo['tipo_archivo_id'] = $tipo_archivo_id->id;
                $dataArchivo['permisos_archivo'] = '{owner:rwx,group:rw-,other:r--}';

                //print_r($dataArchivo);
                
                if ($archivo = \App\Models\Archivo::create($dataArchivo) ){
                    $archivoAdjunto = $archivo->id;
        // asociar el archivo con la institucion
                    $institucion = \App\Models\Admin\Institucion::find(\Config::get('options.institucion_id'));
                    if ( count($institucion) > 0 ) {

                        $tipo_documento_id = \App\Models\TipoDocumento::where('nombre','PRE-FORMAS')->pluck('id')->first();

                        $dataDocumentosInstitucion['institucion_id'] = $institucion->id;
                        $dataDocumentosInstitucion['archivo_id'] = $archivo->id;
                        $dataDocumentosInstitucion['tipo_documento_id'] = $tipo_documento_id;
                        

                        if ($documentosInstitucion = \App\Models\DocumentosInstitucion::create($dataDocumentosInstitucion) ){

                        }else{
                            $errors += 1;
                            array_push($errorsMsg, 'No se pudo asociar el archivo del soporte del representante a la institucion.');
                            goto end;

                        }

                    }else{
                        $errors += 1;
                        array_push($errorsMsg, 'No se encontro la institucion para asociar el archivo del soporte del representante.');
                        goto end;

                    }
                }else{
                    $errors += 1;
                    array_push($errorsMsg, 'No se pudo cargar el archivo del soporte del representante.');
                    goto end;
                        
                }
                
                

            }







        }else{
            if (isset($input['url_origen'])) {
                Flash::error('Documentos Institucion not found');

                return redirect($input['url_origen']);
            }
        }

        end:
        if ($errors > 0) {
            //echo 'error <br>';
            DB::rollBack();

            if ( $request['peticion'] == 'local' ) {
                return $errorsMsg;
            }else if ($this->peticion != 'ajax') {
                flash()->error($errorsMsg);
            }else{
                return Response::json($errorsMsg, 422);
            }
        }else{
            DB::commit();

            return view($view)->with($this->viewWith);
        }

        // $documentosInstitucion = $this->documentosInstitucionRepository->create($input);

        // Flash::success('Documentos Institucion saved successfully.');

        // return redirect(route('admin.documentosInstitucion.index'));
    }

    /**
     * Display the specified DocumentosInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $documentosInstitucion = $this->documentosInstitucionRepository->findWithoutFail($id);

        if (empty($documentosInstitucion)) {
            Flash::error('Documentos Institucion not found');

            return redirect(route('admin.documentosInstitucion.index'));
        }

        $this->viewWith = array_merge($this->viewWith,['documentosInstitucion' => $documentosInstitucion]);

        return view('admin.documentos_institucion.show')->with($this->viewWith);
    }

    /**
     * Show the form for editing the specified DocumentosInstitucion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $documentosInstitucion = $this->documentosInstitucionRepository->findWithoutFail($id);

        if (empty($documentosInstitucion)) {
            Flash::error('Documentos Institucion not found');

            return redirect(route('admin.documentosInstitucion.index'));
        }

        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = 'files.editor_word_drag_drop';
        $viewWith = $this->viewWith;

        $tipo_documento = \App\Models\TipoDocumento::find($documentosInstitucion->tipo_documento_id);

        if (empty($tipo_documento) ) {
            $view = route('admin.documentosInstitucion.show',$id);
            $errors += 1;
            $errorsMsg = 'No se encontro el tipo de documento.';
            goto end;
        }

        //$viewWith = array_merge($viewWith, ['campusApp' => $this->campusApp, 'peticion' => 'normal']);

        $archivo_id = $tipo_documento->archivo_id;
        $tipo_documento_nombre = $tipo_documento->nombre;
        $institucionId = $tipo_documento->institucion_id;

        if ( $tipo_documento->nombre == 'PRE-FORMAS' ) {
            
            $viewError = 'admin.documentosInstitucion.index';

            $datosDocumento = $this->verDocumento('insitucion',['tipo_documento' => $tipo_documento_nombre, 'archivo_id' => $archivo_id, 'institucionId' => $institucionId, 'view' => $viewError, 'peticion' => 'local' ]);

            if ( is_string($datosDocumento) && $datosDocumento === 'error_documento' ) {

                $view = route('admin.documentosInstitucion.show',$id);
                $errors += 1;
                $errorsMsg = 'No se encontro el documento.';
                goto end;
            }elseif ( is_string($datosDocumento) && $datosDocumento === 'seleccione_documento' ) {

                $view = route('admin.documentosInstitucion.show',$id);
                $errors += 1;
                $errorsMsg = 'Seleccione un documento.';
                goto end;
            }else{

                // opciones para mostrar request ['keyword','value']
                $showData = 'keyword';

                $keyWords = array(
                    'coordinador_interno_nombre' => array('keyword' => 'coordinador_interno_nombre', 'name' => 'coordinador interno nombre'),
                    'coordinador_interno_cargo' => array('keyword' => 'coordinador_interno_cargo', 'name' => 'coordinador interno cargo'),
                    'coordinador_interno_telefono' => array('keyword' => 'coordinador_interno_telefono', 'name' => 'coordinador interno telefono'),
                    'coordinador_interno_email' => array('keyword' => 'coordinador_interno_email', 'name' => 'coordinador interno email'),

                    'coordinador_externo_nombre' => array('keyword' => 'coordinador_externo_nombre', 'name' => 'coordinador externo nombre'),
                    'coordinador_externo_cargo' => array('keyword' => 'coordinador_externo_cargo', 'name' => 'coordinador externo cargo'),
                    'coordinador_externo_telefono' => array('keyword' => 'coordinador_externo_telefono', 'name' => 'coordinador externo telefono'),
                    'coordinador_externo_email' => array('keyword' => 'coordinador_externo_email', 'name' => 'coordinador externo email'),

                    'representante_nombre' => array('keyword' => 'representante_nombre', 'name' => 'representante nombre'),
                    'representante_cargo' => array('keyword' => 'representante_cargo', 'name' => 'representante cargo'),
                    'representante_telefono' => array('keyword' => 'representante_telefono', 'name' => 'representante telefono'),
                    'representante_email' => array('keyword' => 'representante_email', 'name' => 'representante email'),

                    'institucion_origen_tipo' => array('keyword' => 'institucion_origen_tipo', 'name' => 'institucion origen tipo'),
                    'institucion_origen_nombre' => array('keyword' => 'institucion_origen_nombre', 'name' => 'institucion origen nombre'),
                    'institucion_origen_direccion_campus_p' => array('keyword' => 'institucion_origen_direccion_campus_p', 'name' => 'institucion origen direccion campus principal'),
                    'institucion_origen_telefono_campus_p' => array('keyword' => 'institucion_origen_telefono_campus_p', 'name' => 'institucion origen telefono campus principal'),
                    'institucion_origen_postal_campus_p' => array('keyword' => 'institucion_origen_postal_campus_p', 'name' => 'institucion origen postal campus principal'),
                    'institucion_origen_pais_campus_p' => array('keyword' => 'institucion_origen_pais_campus_p', 'name' => 'institucion origen_pais campus principal'),
                    'institucion_origen_ciudad_campus_p' => array('keyword' => 'institucion_origen_ciudad_campus_p', 'name' => 'institucion origen ciudad campus principal'),

                    'institucion_destino_tipo' => array('keyword' => 'institucion_destino_tipo', 'name' => 'institucion destino tipo'),
                    'institucion_destino_nombre' => array('keyword' => 'institucion_destino_nombre', 'name' => 'institucion destino nombre'),
                    'institucion_destino_direccion_campus_p' => array('keyword' => 'institucion_destino_direccion_campus_p', 'name' => 'institucion destino direccion campus principal'),
                    'institucion_destino_telefono_campus_p' => array('keyword' => 'institucion_destino_telefono_campus_p', 'name' => 'institucion destino telefono campus principal'),
                    'institucion_destino_postal_campus_p' => array('keyword' => 'institucion_destino_postal_campus_p', 'name' => 'institucion destino postal campus principal'),
                    'institucion_destino_pais_campus_p' => array('keyword' => 'institucion_destino_pais_campus_p', 'name' => 'institucion destino pais campus principal'),
                    'institucion_destino_ciudad_campus_p' => array('keyword' => 'institucion_destino_ciudad_campus_p', 'name' => 'institucion destino ciudad campus principal'),

                    'alianza_id' => array('keyword' => 'alianza_id', 'name' => 'alianza id'),
                    'alianza_tipo_tramite' => array('keyword' => 'alianza_tipo_tramite', 'name' => 'alianza tipo tramite'),
                    'alianza_facultades' => array('keyword' => 'alianza_facultades', 'name' => 'alianza facultades'),
                    'alianza_programas' => array('keyword' => 'alianza_programas', 'name' => 'alianza programas'),
                    'alianza_tipo_alianza' => array('keyword' => 'alianza_tipo_alianza', 'name' => 'alianza tipo alianza'),
                    'alianza_aplicaciones' => array('keyword' => 'alianza_aplicaciones', 'name' => 'alianza aplicaciones'),
                    'alianza_duracion' => array('keyword' => 'alianza_duracion', 'name' => 'alianza duracion'),
                    'alianza_objetivo' => array('keyword' => 'alianza_objetivo', 'name' => 'alianza objetivo'),
                    'alianza_fecha_creacion' => array('keyword' => 'alianza_fecha_creacion', 'name' => 'alianza fecha creacion'),
                    'alianza_fecha_actualizacion' => array('keyword' => 'alianza_fecha_actualizacion', 'name' => 'alianza fecha actualizacion'),
                );

                $viewWith = array_merge($viewWith, $datosDocumento);
                $viewWith = array_merge($viewWith, ['keyWords' => $keyWords, 'showData' => $showData]);
                
            }

        }else{
            $documentoInstitucion =  \App\Models\Admin\DocumentosInstitucion::join('tipo_documento','documentos_institucion.tipo_documento_id','tipo_documento.id')
                                ->join('archivo','documentos_institucion.archivo_id','archivo.id')
                                ->where('documentos_institucion.institucion_id',$institucionId)
                                ->where('documentos_institucion.tipo_documento_id',$tipo_documento_id)
                                ->where('archivo.id',$archivo_id)
                                ->select('archivo.nombre','archivo.path')->first();
            if (empty($documentoInstitucion)) {
                $view = route('admin.documentosInstitucion.show',$id);
                $errors += 1;
                $errorsMsg = 'No se encontro el documento.';
                goto end;
            }

            $viewWith = array_merge($viewWith, ['documento_nombre' => $documentoInstitucion->nombre, 'documento_path' => $documentoInstitucion->path]);
        }

        $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'documentosInstitucion' => $documentosInstitucion]);

        //return view('files.editor')->with($viewWith);
        if (isset($request['tipo_editor'])) {
            if ($request['tipo_editor'] == 1) {
                $view = 'files.editor';
            }elseif ($request['tipo_editor'] == 2) {
                $view = 'files.editor_drag_drop';
            }elseif ($request['tipo_editor'] == 3) {
                $view = 'files.editor_word_drag_drop';
            }
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

            if ( $this->peticion == 'local' ) {
                return $viewWith;
            }else if ($this->peticion == 'ajax') {
                return $viewWith;
            }else{
                if ( !empty($okMsg) ) {
                    Flash::success($okMsg);
                }
                return view($view)->with($viewWith);
            }
        }

        //return view('admin.documentos_institucion.edit')->with('documentosInstitucion', $documentosInstitucion);
    }

    /**
     * Update the specified DocumentosInstitucion in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentosInstitucionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentosInstitucionRequest $request)
    {
        $documentosInstitucion = $this->documentosInstitucionRepository->findWithoutFail($id);

        if (empty($documentosInstitucion)) {
            Flash::error('Documentos Institucion not found');

            return redirect(route('admin.documentosInstitucion.index'));
        }

        $documentosInstitucion = $this->documentosInstitucionRepository->update($request->all(), $id);

        Flash::success('Documentos Institucion updated successfully.');

        return redirect(route('admin.documentosInstitucion.index'));
    }

    /**
     * Remove the specified DocumentosInstitucion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $documentosInstitucion = $this->documentosInstitucionRepository->findWithoutFail($id);

        if (empty($documentosInstitucion)) {
            Flash::error('Documentos Institucion not found');

            return redirect(route('admin.documentosInstitucion.index'));
        }

        $this->documentosInstitucionRepository->delete($id);

        Flash::success('Documentos Institucion deleted successfully.');

        return redirect(route('admin.documentosInstitucion.index'));
    }
}
