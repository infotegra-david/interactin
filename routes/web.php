<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

/*
---------------------------
PARA EL MANEJO DE ROLES NO DEJAR RUTAS SIMPLES
NO: logs
SI: logs.index
---------------------------
*/

/*
---------------------------
LOS NOMBRES DE LAS RUTAS EN INGLES, EN MINUSCULAS Y EN PLURAR (O TAL COMO QUEDO EL PERMISO)
LOS NOMBRES DE LAS RUTAS EN INGLES, EN MINUSCULAS Y EN PLURAR (O TAL COMO QUEDO EL PERMISO)
LOS NOMBRES DE LAS RUTAS EN INGLES, EN MINUSCULAS Y EN PLURAR (O TAL COMO QUEDO EL PERMISO)
LOS NOMBRES DE LAS RUTAS EN INGLES, EN MINUSCULAS Y EN PLURAR (O TAL COMO QUEDO EL PERMISO)

---------------------------
*/


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');






Route::get('/1', function(){
    return view('index_prueba');
});





Route::get('/',['as' => 'index','uses' => 'IndexController@index']);
Route::post('/campusAppSelect',['as' => 'campusAppSelect','uses' => 'IndexController@campusAppSelect']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', ['as' => 'home','uses' => 'HomeController@index']);
});
/*
//Route::get('/html/{pagina?}',['as' => 'pagina','uses' => 'FilesController@pagina']);

//Route::group(['prefix' => '/admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'role:administrador,access_backend'], function() {    
*/

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'namespace' => 'Admin'], function() {
    Route::post('countries/listCountriesModalidad', ['as' => 'countries.listCountriesModalidad','uses' => 'CountryController@listCountriesModalidad']);
    Route::post('cities/listStates', ['as' => 'cities.listStates','uses' => 'CityController@listStates']);
    Route::post('cities/listCities', ['as' => 'cities.listCities','uses' => 'CityController@listCities']);

    
    Route::post('listUserCampus/{user_id}', ['as' => 'users.listUserCampus','uses' => 'UserController@listUserCampus']);
    Route::post('editCampus/{user_id}', ['as' => 'users.editCampus','uses' => 'UserController@editCampus']);
    
    Route::post('listUserIdiomas/{user_id}', ['as' => 'users.listUserIdiomas','uses' => 'UserController@listUserIdiomas']);
    Route::post('editUserIdiomas/{user_id}', ['as' => 'users.editUserIdiomas','uses' => 'UserController@editUserIdiomas']);
    
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    
    Route::get('logs',['as' => 'logs.index','uses' => 'LogViewer\LogViewerController@index']);

    //Localizacion
    Route::resource('countries', 'CountryController');
    
    Route::resource('states', 'StateController');

    Route::resource('cities', 'CityController');

    //datos de la institucion

    Route::post('institutions/listInstitutions', ['as' => 'institutions.listInstitutions','uses' => 'InstitucionController@listInstitutions']);
    Route::get('institutions/{institucion_id}/documents/create', ['as' => 'institutions.documents.create','uses' => 'InstitucionController@documents_create']);
    Route::get('institutions/{institucion_id}/documents/{documento_id?}', ['as' => 'institutions.documents','uses' => 'InstitucionController@documents']);
    Route::post('institutions/{institucion_id}/documents', ['as' => 'institutions.documents.store','uses' => 'InstitucionController@documents_store']);
    Route::resource('institutions', 'InstitucionController');

    Route::resource('campus', 'CampusController');
    Route::post('campus/listcampus', ['as' => 'campus.listcampus','uses' => 'CampusController@listCampus']);

    Route::resource('faculties', 'FacultadController');
    Route::post('faculties/listFaculties', ['as' => 'faculties.listFaculties','uses' => 'FacultadController@listFaculties']);
    
    Route::resource('programs', 'ProgramaController');
    Route::post('programs/listPrograms', ['as' => 'programs.listPrograms','uses' => 'ProgramaController@listPrograms']);
    
    Route::resource('subjects', 'AsignaturaController');

    Route::resource('documentosInstitucion', 'DocumentosInstitucionController');

});





Route::group(['middleware' => 'auth'], function() {

    Route::resource('user', 'Admin\UserController');


        
    // Route::group(['prefix' => 'interindicators', 'as' => 'interindicators.'], function() {
        Route::get('interindicators/indicators', function() {
            return redirect('/html/indicators.php');
        });
    // });
});


//INTERALLIANCE INICIO
//INTERALLIANCE INICIO
//INTERALLIANCE INICIO
//INTERALLIANCE INICIO
//INTERALLIANCE INICIO

// external 
// los usuarios que reciban el email podran verificar el contenido sin tener que loguearse 
Route::get('interalliances/subscribe/destination/{token}',['as' => 'interalliances.destination','uses' => 'InterAllianceController@destination']);
Route::post('interalliances/subscribe/destination/{token}',['as' => 'interalliances.destination','uses' => 'InterAllianceController@destination']);

Route::group(['prefix' => '/interalliances', 'as' => 'interalliances.', 'middleware' => 'auth'], function() {


    //VALIDATIONS INICIO
    //VALIDATIONS INICIO
    
    Route::group(['namespace' => 'Validation'], function() {

        //se definen las rutas como [proceso].validations_[proceso] para que el verificador de permisos reciba, por ejemplo, validations_alliances.create y verifique el que tenga el permiso add_validations_alliances
        //modulo de validacion para la alianza
        // Route::group(['prefix' => '/validations', 'as' => 'interalliances.'], function() { 
            //generar pdf
            Route::get('validations/{alianza_id}/pdf',['as' => 'validations_interalliances.pdf','uses' => 'PasosAlianzaController@pdf']);
            Route::get('validations/{alianza_id}/print',['as' => 'validations_interalliances.print','uses' => 'PasosAlianzaController@print']);
            Route::post('validations/{alianza_id}/documents',['as' => 'validations_interalliances.documents.store','uses' => 'PasosAlianzaController@documents_store']);
            //Route::get('validations/',['as' => 'validations_interalliances.index','uses' => 'PasosAlianzaController@index']);
            Route::get('validations/{alianza_id}/create',['as' => 'validations_interalliances.create','uses' => 'PasosAlianzaController@create']);
            //Route::post('validations/',['as' => 'validations_interalliances.store','uses' => 'PasosAlianzaController@store']);
            Route::get('validations/{alianza_id}/{paso_id?}',['as' => 'validations_interalliances.show','uses' => 'PasosAlianzaController@show']);
            Route::get('validations/{alianza_id}/{paso_id}/edit',['as' => 'validations_interalliances.edit','uses' => 'PasosAlianzaController@edit']);
            //Route::put('validations/{paso_id}',['as' => 'validations_interalliances.update','uses' => 'PasosAlianzaController@update']);
            //Route::patch('validations/{paso_id}',['as' => 'validations_interalliances.update','uses' => 'PasosAlianzaController@update']);
            //Route::delete('validations/{paso_id}',['as' => 'validations_interalliances.destroy','uses' => 'PasosAlianzaController@destroy']);
        // });
        Route::resource('validations', 'PasosAlianzaController', ['parameters' => [
           'alliances' => 'paso_id'
        ],'names' => [
            'index' => 'validations_interalliances.index',
            'store' => 'validations_interalliances.store',
            'update' => 'validations_interalliances.update',
            'destroy' => 'validations_interalliances.destroy'
        ],'except' => [
           'create', 'show', 'edit'
        ]]);

        //SE DEFINE UNA RUTA PARA PERDIR LOS DATOS DE LOS VALIDADORES POR CAMPUS Y EL ORDEN POR PASO

        Route::post('assignments/lists',['as' => 'assignments_interalliances.lists','uses' => 'UserPasoController@lists']);
        Route::post('assignments/storeupdate',['as' => 'assignments_interalliances.storeupdate','uses' => 'UserPasoController@storeUpdate']);

        //para asignar los validadores
        Route::resource('assignments', 'UserPasoController',['names' => [
            'index' => 'assignments_interalliances.index',
            'store' => 'assignments_interalliances.store',
            'create' => 'assignments_interalliances.create',
            'show' => 'assignments_interalliances.show',
            'update' => 'assignments_interalliances.update',
            'destroy' => 'assignments_interalliances.destroy',
            'edit' => 'assignments_interalliances.edit'
        ]]);


    });

    //VALIDATIONS FIN
    //VALIDATIONS FIN


    //InterAlliance

    //SE DEFINE UNA RUTA PARA ADMINISTRAR LOS EMAILS DEL PROCESO

    Route::post('emails/lists',['as' => 'emails_interalliances.lists','uses' => 'EmailController@lists']);
    Route::post('emails/storeupdate',['as' => 'emails_interalliances.storeupdate','uses' => 'EmailController@storeUpdate']);

    //para asignar los validadores
    Route::resource('emails', 'EmailController',['names' => [
        'index' => 'emails_interalliances.index',
        'store' => 'emails_interalliances.store',
        'create' => 'emails_interalliances.create',
        'show' => 'emails_interalliances.show',
        'update' => 'emails_interalliances.update',
        'destroy' => 'emails_interalliances.destroy',
        'edit' => 'emails_interalliances.edit'
    ]]);

    //Route::resource('interalliances', 'InterAllianceController');

    // Map 
    Route::get('map',['as' => 'map','uses' => 'InterAllianceController@map']);

    Route::post('list',['as' => 'list','uses' => 'InterAllianceController@list']);

    // Subscribe 
    Route::get('subscribe/origin',['as' => 'origin','uses' => 'InterAllianceController@origin']);
    Route::get('subscribe/origin/{alianza_id}',['as' => 'show','uses' => 'InterAllianceController@show']);
    Route::get('subscribe/origin/{alianza_id}/{paso}/edit',['as' => 'origin.edit','uses' => 'InterAllianceController@edit']);
    Route::get('subscribe/destination/{token}/{paso}/edit',['as' => 'destination.edit','uses' => 'InterAllianceController@edit']);
    //Route::get('subscribe/destination/{token}/edit',['as' => 'destination.edit','uses' => 'InterAllianceController@edit']);
    Route::get('subscribe',function(){
        return redirect()->route('origin');
    });

    // Alliances 
    Route::get('alliances',['as' => 'alliances','uses' => 'InterAllianceController@index']);

    // email 
    //Route::get('email',['as' => 'email','uses' => 'InterAllianceController@email']);
    Route::post('email',['as' => 'email','uses' => 'InterAllianceController@email']);
    //generar pdf
    Route::get('{id_alliance}/pdf',['as' => 'pdf','uses' => 'InterAllianceController@pdf']);


});

Route::group(['middleware' => 'auth'], function() {

    Route::resource('interalliances', 'InterAllianceController');

});


//INTERALLIANCE FIN
//INTERALLIANCE FIN
//INTERALLIANCE FIN
//INTERALLIANCE FIN
//INTERALLIANCE FIN



//INTERCHANGES INICIO
//INTERCHANGES INICIO
//INTERCHANGES INICIO
//INTERCHANGES INICIO
//INTERCHANGES INICIO

Route::group(['prefix' => '/interchanges', 'as' => 'interchanges.', 'middleware' => 'auth'], function() {


    //VALIDATIONS INICIO
    //VALIDATIONS INICIO

    
    Route::group(['namespace' => 'Validation'], function() {

        //modulo de validacion para la inscripcion (interchange)
        // Route::group(['prefix' => '/interchanges', 'as' => 'interchanges.'], function() { 
            //generar pdf
            Route::get('validations/{inscripcion_id}/pdf',['as' => 'validations_interchanges.pdf','uses' => 'PasosInscripcionController@pdf']);
            Route::get('validations/{inscripcion_id}/create',['as' => 'validations_interchanges.create','uses' => 'PasosInscripcionController@create']);
            Route::get('validations/{inscripcion_id}/{paso_id?}',['as' => 'validations_interchanges.show','uses' => 'PasosInscripcionController@show']);
            Route::get('validations/{inscripcion_id}/{paso_id}/edit',['as' => 'validations_interchanges.edit','uses' => 'PasosInscripcionController@edit']);
        // });

        Route::resource('validations', 'PasosInscripcionController', ['parameters' => [
           'interchanges' => 'paso_id'
        ],'names' => [
            'index' => 'validations_interchanges.index',
            'store' => 'validations_interchanges.store',
            'update' => 'validations_interchanges.update',
            'destroy' => 'validations_interchanges.destroy'
        ],'except' => [
           'create', 'show', 'edit'
        ]]);
        
        //SE DEFINE UNA RUTA PARA PERDIR LOS DATOS DE LOS VALIDADORES POR CAMPUS Y EL ORDEN POR PASO

        Route::post('assignments/lists',['as' => 'assignments_interchanges.lists','uses' => 'UserPasoController@lists']);
        Route::post('assignments/storeupdate',['as' => 'assignments_interchanges.storeupdate','uses' => 'UserPasoController@storeUpdate']);

        //para asignar los validadores
        Route::resource('assignments', 'UserPasoController',['names' => [
            'index' => 'assignments_interchanges.index',
            'store' => 'assignments_interchanges.store',
            'create' => 'assignments_interchanges.create',
            'show' => 'assignments_interchanges.show',
            'update' => 'assignments_interchanges.update',
            'destroy' => 'assignments_interchanges.destroy',
            'edit' => 'assignments_interchanges.edit'
        ]]);

    });

    //VALIDATIONS FIN
    //VALIDATIONS FIN

    
    
    //SE DEFINE UNA RUTA PARA ADMINISTRAR LOS EMAILS DEL PROCESO

    Route::post('emails/lists',['as' => 'emails_interchanges.lists','uses' => 'EmailController@lists']);
    Route::post('emails/storeupdate',['as' => 'emails_interchanges.storeupdate','uses' => 'EmailController@storeUpdate']);

    //para asignar los validadores
    Route::resource('emails', 'EmailController',['names' => [
        'index' => 'emails_interchanges.index',
        'store' => 'emails_interchanges.store',
        'create' => 'emails_interchanges.create',
        'show' => 'emails_interchanges.show',
        'update' => 'emails_interchanges.update',
        'destroy' => 'emails_interchanges.destroy',
        'edit' => 'emails_interchanges.edit'
    ]]);

    //InterChange


    //Route::resource('interChanges', 'InterChangeController');

    //Map
    Route::get('interout/map',['as' => 'interout.map','uses' => 'InterChangeController@map']);
    Route::get('interin/map',['as' => 'interin.map','uses' => 'InterChangeController@map']);

    //Pdf
    Route::get('interout/{inscripcion_id}/pdf',['as' => 'interout.pdf','uses' => 'InterChangeController@pdf']);
    Route::get('interin/{inscripcion_id}/pdf',['as' => 'interin.pdf','uses' => 'InterChangeController@pdf']);

    //Edit
    Route::get('interout/{inscripcion_id}/{paso}/edit',['as' => 'interout.editStep','uses' => 'InterChangeController@edit']);
    Route::get('interin/{inscripcion_id}/{paso}/edit',['as' => 'interin.editStep','uses' => 'InterChangeController@edit']);

    Route::post('list',['as' => 'list','uses' => 'InterChangeController@list']);

    // email 
    Route::post('email',['as' => 'email','uses' => 'InterChangeController@email']);
    //generar pdf
    Route::get('{id_interchange}/pdf',['as' => 'pdf','uses' => 'InterChangeController@pdf']);

    //Route::resource('interChanges', 'InterChangeController');
    Route::resource('interout', 'InterChangeController');
    Route::resource('interin', 'InterChangeController');

    Route::get('/',['as' => 'index',function(){
        return view('validation.interchanges.pasos_inscripcions.index', ['peticion' => 'normal']);
    }]);

});



//INTERCHANGES FIN
//INTERCHANGES FIN
//INTERCHANGES FIN
//INTERCHANGES FIN
//INTERCHANGES FIN



//INTERACTIONS INICIO
//INTERACTIONS INICIO
//INTERACTIONS INICIO
//INTERACTIONS INICIO
//INTERACTIONS INICIO


Route::group(['prefix' => '/interactions', 'as' => 'interactions.', 'middleware' => 'auth'], function() {
    
    // VALIDATIONS INICIO
    // VALIDATIONS INICIO

    Route::group(['namespace' => 'Validation'], function() {

        //modulo de validacion para la inscripcion (interchange)
        // Route::group(['prefix' => '/interchanges', 'as' => 'interchanges.'], function() { 
            //generar pdf
            Route::get('validations/{iniciativa_id}/pdf',['as' => 'validations_interactions.pdf','uses' => 'PasosIniciativaController@pdf']);
            Route::get('validations/{iniciativa_id}/create',['as' => 'validations_interactions.create','uses' => 'PasosIniciativaController@create']);
            Route::get('validations/{iniciativa_id}/{paso_id?}',['as' => 'validations_interactions.show','uses' => 'PasosIniciativaController@show']);
            Route::get('validations/{iniciativa_id}/{paso_id}/edit',['as' => 'validations_interactions.edit','uses' => 'PasosIniciativaController@edit']);
        // });

        Route::resource('validations', 'PasosIniciativaController', ['parameters' => [
           'interactions' => 'paso_id'
        ],'names' => [
            'index' => 'validations_interactions.index',
            'store' => 'validations_interactions.store',
            'update' => 'validations_interactions.update',
            'destroy' => 'validations_interactions.destroy'
        ],'except' => [
           'create', 'show', 'edit'
        ]]);
        
        //SE DEFINE UNA RUTA PARA PERDIR LOS DATOS DE LOS VALIDADORES POR CAMPUS Y EL ORDEN POR PASO

        Route::post('assignments/lists',['as' => 'assignments_interactions.lists','uses' => 'UserPasoController@lists']);
        Route::post('assignments/storeupdate',['as' => 'assignments_interactions.storeupdate','uses' => 'UserPasoController@storeUpdate']);

        //para asignar los validadores
        Route::resource('assignments', 'UserPasoController',['names' => [
            'index' => 'assignments_interactions.index',
            'store' => 'assignments_interactions.store',
            'create' => 'assignments_interactions.create',
            'show' => 'assignments_interactions.show',
            'update' => 'assignments_interactions.update',
            'destroy' => 'assignments_interactions.destroy',
            'edit' => 'assignments_interactions.edit'
        ]]);



    });


    //VALIDATIONS FIN
    //VALIDATIONS FIN

    
    
    //SE DEFINE UNA RUTA PARA ADMINISTRAR LOS EMAILS DEL PROCESO

    Route::post('emails/lists',['as' => 'emails_interactions.lists','uses' => 'EmailController@lists']);
    Route::post('emails/storeupdate',['as' => 'emails_interactions.storeupdate','uses' => 'EmailController@storeUpdate']);

    //para asignar los validadores
    Route::resource('emails', 'EmailController',['names' => [
        'index' => 'emails_interactions.index',
        'store' => 'emails_interactions.store',
        'create' => 'emails_interactions.create',
        'show' => 'emails_interactions.show',
        'update' => 'emails_interactions.update',
        'destroy' => 'emails_interactions.destroy',
        'edit' => 'emails_interactions.edit'
    ]]);


    //InterAction
    Route::get('map', function() {
        return redirect('/html/interactions-map.php');
    });
    Route::get('opportunities', function() {
        return redirect('/html/opportunities.php');
    });
    Route::get('send_initiative', function() {
        return redirect('/html/initiative.php');
    });


    Route::resource('iniciative', 'IniciativaController');

});

Route::group(['middleware' => 'auth'], function() {

    // Route::resource('interactions', 'InterActionsController');

});




//INTERACTIONS FIN
//INTERACTIONS FIN
//INTERACTIONS FIN
//INTERACTIONS FIN
//INTERACTIONS FIN



Route::resource('aplicaciones', 'AplicacionesController');

Route::post('aplicaciones/listAplicaciones', ['as' => 'aplicaciones.listAplicaciones','uses' => 'AplicacionesController@listAplicaciones']);



//Route::get('send/{postId}', ['as' => 'send','uses' => 'PostController@send']);

Route::get('send/{postId}', ['as' => 'emails.sendEmail', 'uses' => 'EmailController@sendEmail'] );
Route::get('send', ['as' => 'emails.index', 'uses' => 'EmailController@index'] );


Route::resource('tipoAlianzas', 'TipoAlianzaController');

Route::resource('tipoTramites', 'TipoTramiteController');




Route::resource('inscripcion', 'InscripcionController');

Route::resource('tipoAlianzas', 'TipoAlianzaController');

Route::resource('tipoInstitucions', 'TipoInstitucionController');

Route::resource('datosPersonales', 'DatosPersonalesController');

Route::resource('tipoFacultads', 'TipoFacultadController');

// Route::resource('emails', 'EmailController');

Route::resource('tipoPasos', 'TipoPasoController');

Route::resource('estados', 'EstadoController');

Route::resource('archivos', 'ArchivoController');

Route::resource('tipoArchivos', 'TipoArchivoController');



Route::resource('claseDocumentos', 'ClaseDocumentoController');

Route::resource('tipoDocumentos', 'TipoDocumentoController');

Route::resource('modalidades', 'ModalidadesController');

Route::resource('periodos', 'PeriodoController');

Route::resource('matriculas', 'MatriculaController');

Route::resource('documentosAlianzas', 'DocumentosAlianzaController');






Route::resource('documentosInscripcion', 'DocumentosInscripcionController');

Route::resource('plantillas', 'PlantillasController');

Route::resource('plantillas', 'PlantillasController');



Route::get('admin/tipoIdiomas', ['as'=> 'admin.tipoIdiomas.index', 'uses' => 'Admin\TipoIdiomaController@index']);
Route::post('admin/tipoIdiomas', ['as'=> 'admin.tipoIdiomas.store', 'uses' => 'Admin\TipoIdiomaController@store']);
Route::get('admin/tipoIdiomas/create', ['as'=> 'admin.tipoIdiomas.create', 'uses' => 'Admin\TipoIdiomaController@create']);
Route::put('admin/tipoIdiomas/{tipoIdiomas}', ['as'=> 'admin.tipoIdiomas.update', 'uses' => 'Admin\TipoIdiomaController@update']);
Route::patch('admin/tipoIdiomas/{tipoIdiomas}', ['as'=> 'admin.tipoIdiomas.update', 'uses' => 'Admin\TipoIdiomaController@update']);
Route::delete('admin/tipoIdiomas/{tipoIdiomas}', ['as'=> 'admin.tipoIdiomas.destroy', 'uses' => 'Admin\TipoIdiomaController@destroy']);
Route::get('admin/tipoIdiomas/{tipoIdiomas}', ['as'=> 'admin.tipoIdiomas.show', 'uses' => 'Admin\TipoIdiomaController@show']);
Route::get('admin/tipoIdiomas/{tipoIdiomas}/edit', ['as'=> 'admin.tipoIdiomas.edit', 'uses' => 'Admin\TipoIdiomaController@edit']);


Route::get('admin/nivels', ['as'=> 'admin.nivels.index', 'uses' => 'Admin\NivelController@index']);
Route::post('admin/nivels', ['as'=> 'admin.nivels.store', 'uses' => 'Admin\NivelController@store']);
Route::get('admin/nivels/create', ['as'=> 'admin.nivels.create', 'uses' => 'Admin\NivelController@create']);
Route::put('admin/nivels/{nivels}', ['as'=> 'admin.nivels.update', 'uses' => 'Admin\NivelController@update']);
Route::patch('admin/nivels/{nivels}', ['as'=> 'admin.nivels.update', 'uses' => 'Admin\NivelController@update']);
Route::delete('admin/nivels/{nivels}', ['as'=> 'admin.nivels.destroy', 'uses' => 'Admin\NivelController@destroy']);
Route::get('admin/nivels/{nivels}', ['as'=> 'admin.nivels.show', 'uses' => 'Admin\NivelController@show']);
Route::get('admin/nivels/{nivels}/edit', ['as'=> 'admin.nivels.edit', 'uses' => 'Admin\NivelController@edit']);




Route::get('admin/UserIdiomas', ['as'=> 'admin.UserIdiomas.index', 'uses' => 'Admin\UserIdiomasController@index']);
Route::post('admin/UserIdiomas', ['as'=> 'admin.UserIdiomas.store', 'uses' => 'Admin\UserIdiomasController@store']);
Route::get('admin/UserIdiomas/create', ['as'=> 'admin.UserIdiomas.create', 'uses' => 'Admin\UserIdiomasController@create']);
Route::put('admin/UserIdiomas/{UserIdiomas}', ['as'=> 'admin.UserIdiomas.update', 'uses' => 'Admin\UserIdiomasController@update']);
Route::patch('admin/UserIdiomas/{UserIdiomas}', ['as'=> 'admin.UserIdiomas.update', 'uses' => 'Admin\UserIdiomasController@update']);
Route::delete('admin/UserIdiomas/{UserIdiomas}', ['as'=> 'admin.UserIdiomas.destroy', 'uses' => 'Admin\UserIdiomasController@destroy']);
Route::get('admin/UserIdiomas/{UserIdiomas}', ['as'=> 'admin.UserIdiomas.show', 'uses' => 'Admin\UserIdiomasController@show']);
Route::get('admin/UserIdiomas/{UserIdiomas}/edit', ['as'=> 'admin.UserIdiomas.edit', 'uses' => 'Admin\UserIdiomasController@edit']);


Route::resource('financiacions', 'FinanciacionController');

Route::resource('fuenteFinanciacions', 'FuenteFinanciacionController');

Route::resource('financiacions', 'FinanciacionController');

Route::resource('financiacions', 'FinanciacionController');
