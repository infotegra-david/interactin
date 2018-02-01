<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlantillasRequest;
use App\Http\Requests\UpdatePlantillasRequest;
use App\Repositories\PlantillasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Authorizable;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Spatie\ArrayToXml\ArrayToXml;

class PlantillasController extends AppBaseController
{
    /** @var  PlantillasRepository */
    private $plantillasRepository;


    private $user;
    private $campusApp;
    private $campusAppFound;
    private $tipoRuta;
    private $route_split;
    private $proceso;
    private $peticion;
    private $viewWith = [];

    public function __construct(PlantillasRepository $plantillasRepo, Request $request)
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
            }else{
                $this->campusApp = [0 => 'No pertenece a alguna institución.'];
            }

            if( session('campusApp') != null && session('campusApp') != 0 ){
                $campusAppId = session('campusApp') ?? 0;

                // if ( Auth::user() !== NULL) {
                    $this->campusAppFound = \App\Models\Admin\Campus::find($campusAppId);
                    if( !count($this->campusAppFound) ){
                        Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                        return redirect(route('home'));
                    }
                // }
            }else{
                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');
                // $campusAppId = session('campusApp');
                // return redirect(route('home'));
            }
            
            $this->viewWith = array_merge($this->viewWith,['campusApp' => $this->campusApp]);

            return $next($request);
        });

        $name = Route::currentRouteName();

        // $action = Route::currentRouteAction();
        
        if (!empty($name) ) {
            $this->tipoRuta = $name;
            $this->route_split = substr($name, 0,strrpos($name, "."));
            $this->proceso = substr($name, 0,strpos($name, "."));
            // $this->routeLists = route($this->proceso.'.registros_emails_'.$this->proceso.'.lists');

            // echo $this->tipoRuta.' <br>';
            // echo $this->route_split.' <br>';
            // echo $this->proceso.' <br>';
        }

        //valida si es una peticion de tipo ajax
        if ($request->ajax() || $request->peticion == "ajax") {
            $this->peticion = "ajax";
        }else{
            $this->peticion = "normal";
        }

        $this->plantillasRepository = $plantillasRepo;

        $this->viewWith = array_merge($this->viewWith,['peticion' => $this->peticion, 'route_split' => $this->route_split, 'proceso' => $this->proceso]);
    }

    /**
     * Display a listing of the Plantillas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $clasificacion_nombre = '';
        $proceso = '';
        $menuAppRoute = [];

        $tipo_plantilla = \App\Models\TipoPlantilla::select('id');

        switch ($this->proceso) {
            case 'interalliances':
                $clasificacion_nombre = 'ALIANZA';
                $proceso = 'InterAlliance';
                $menuAppRoute[ "InterAlliance" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;
                break;
            case 'interchanges':
                $clasificacion_nombre = 'INSCRIPCION';
                $proceso = 'InterChange';
                $menuAppRoute[ "InterChange" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;

                $tipo_plantilla = $tipo_plantilla->where('nombre','like','EMAIL%');

                break;
            case 'interactions':
                $clasificacion_nombre = 'INICIATIVA';
                $proceso = 'InterAction';
                $menuAppRoute[ "InterAction" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;
                break;
                // INSTITUCION
                // OPORTUNIDAD
                // MULTIMEDIA
                // IDENTIDAD
                // USUARIO
            default:
                
                break;
        }
        $clasificacion = \App\Models\Clasificacion::where('nombre',$clasificacion_nombre)->pluck('id')->toArray();
        $tipo_plantilla = $tipo_plantilla->whereIn('clasificacion_id',$clasificacion)
            ->pluck('id')->toArray();

        // $this->plantillasRepository->pushCriteria(new RequestCriteria($request));
        $plantillas = \App\Models\Plantillas::whereIn('tipo_plantilla_id',$tipo_plantilla)->get();

        return view('plantillas.index')
            ->with('plantillas', $plantillas);
    }

    /**
     * Show the form for creating a new Plantillas.
     *
     * @return Response
     */
    // public function create($plantilla_id)
    public function create()
    {
        $errors = 0;
        $errorsMsg = '';
        $okMsg = '';
        $view = 'plantillas.create';
        $this->user = Auth::user();
        $user_actual = $this->user->id;
        $viewWith = $this->viewWith;
        $showData = '';
        $keyWords = '';
        
        // $plantilla = $this->plantillasRepository->findWithoutFail($plantilla_id);

        // if (empty($plantilla)) {
        //     Flash::error('Plantilla no encontrada');

        //     return redirect(route($this->route_split.'.index'));
        // }
        // $plantillaId = $plantilla->id;

        $route_back = route($this->route_split.'.index');

        
        $showData = 'keyword';
        $keyWords = $this->keyWordsData();

        $viewWith = array_merge($viewWith, ['plantilla' => ['id' => 0, 'nombre' => 'Nueva plantilla', 'formato' => '*']]);
        // $ruta_guardar = [$this->route_split.'.store',$plantillaId];
        $ruta_guardar = [$this->route_split.'.store'];
        $editar = ['nombre' => true, 'tipo_plantilla' => true, 'descripcion' => true, 'asunto' => true];
        
        $clasificacion_nombre = '';
        $proceso = '';
        $menuAppRoute = [];

        $tipo_plantilla = \App\Models\TipoPlantilla::select('id','nombre')
            ->orderby('clasificacion_id','asc');
            // ->orderby('nombre','asc');

        switch ($this->proceso) {
            case 'interalliances':
                $clasificacion_nombre = 'ALIANZA';
                $proceso = 'InterAlliance';
                $menuAppRoute[ "InterAlliance" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;
                break;
            case 'interchanges':
                $clasificacion_nombre = 'INSCRIPCION';
                $proceso = 'InterChange';
                $menuAppRoute[ "InterChange" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;

                $tipo_plantilla = $tipo_plantilla->where('nombre','like','EMAIL%');

                break;
            case 'interactions':
                $clasificacion_nombre = 'INICIATIVA';
                $proceso = 'InterAction';
                $menuAppRoute[ "InterAction" ]["sub"][ "Emails" ]["sub"][ "Plantillas" ]["active"] = true;
                break;
                // INSTITUCION
                // OPORTUNIDAD
                // MULTIMEDIA
                // IDENTIDAD
                // USUARIO
            default:
                
                break;
        }
        $clasificacion = \App\Models\Clasificacion::whereIn('nombre',[$clasificacion_nombre])->pluck('id')->toArray();
        $tipo_plantilla = $tipo_plantilla->whereIn('clasificacion_id',$clasificacion)
            ->pluck('nombre','id');
        /*
        $pre_forma = $tipo_plantilla->toArray();
        $pre_forma_id = array_search('PRE-FORMAS',$pre_forma);
        $viewWith = array_merge($viewWith, ['pre_forma_id' => $pre_forma_id]);
        */

        $viewWith = array_merge($viewWith, ['peticion' => $this->peticion, 'ruta_guardar' => $ruta_guardar, 'editar' => $editar, 'tipo_archivo' => '', 'tipo_plantilla' => $tipo_plantilla, 'route_back' => $route_back, 'keyWords' => $keyWords, 'showData' => $showData, 'proceso' => $proceso, 'menuAppRoute' => $menuAppRoute ]);
        
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
     * Store a newly created Plantillas in storage.
     *
     * @param CreatePlantillasRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        

        $reglas = [
                'tipo_plantilla_id' => 'required',
                'descripcion' => 'required',
                'asunto' => 'required',
                'plantilla_contenido' => 'required',
                ];

        $this->validate($request, $reglas);   

        if( !count($this->campusAppFound) ){
            $campusAppId = session('campusApp') ?? 0;

            $this->campusAppFound = \App\Models\Admin\Campus::find($campusAppId);

            if( !count($this->campusAppFound) ){

                Flash::error('No se encuentra el campus, seleccione el campus que va a usar.');

                return redirect(route('plantillas.index'));
            }
        }

        $input = $request->all();

        $contenido = [
            'subject' => [
                $input['asunto']
            ],
            'content' => [
                $input['plantilla_contenido']
            ]
        ];

        $input['contenido'] = ArrayToXml::convert($contenido);
        $input['campus_id'] = $this->campusAppFound->id;

        unset($input['plantilla_id']);
        unset($input['asunto']);
        unset($input['plantilla_contenido']);

        $plantillas = $this->plantillasRepository->create($input);

        Flash::success('Plantilla guardada correctamente.');

        return redirect(route('plantillas.index'));
    }

    /**
     * Display the specified Plantillas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        return view('plantillas.show')->with('plantillas', $plantillas);
    }

    /**
     * Show the form for editing the specified Plantillas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        return view('plantillas.edit')->with('plantillas', $plantillas);
    }

    /**
     * Update the specified Plantillas in storage.
     *
     * @param  int              $id
     * @param UpdatePlantillasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantillasRequest $request)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        $plantillas = $this->plantillasRepository->update($request->all(), $id);

        Flash::success('Plantillas updated successfully.');

        return redirect(route('plantillas.index'));
    }

    /**
     * Remove the specified Plantillas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plantillas = $this->plantillasRepository->findWithoutFail($id);

        if (empty($plantillas)) {
            Flash::error('Plantillas not found');

            return redirect(route('plantillas.index'));
        }

        $this->plantillasRepository->delete($id);

        Flash::success('Plantillas deleted successfully.');

        return redirect(route('plantillas.index'));
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
