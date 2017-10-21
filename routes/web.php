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

Route::get('/',['as' => 'index','uses' => 'IndexController@index']);
Route::post('/campusAppSelect',['as' => 'campusAppSelect','uses' => 'IndexController@campusAppSelect']);

Route::get('/home', ['as' => 'home','uses' => 'HomeController@index']);

/*
//Route::get('/html/{pagina?}',['as' => 'pagina','uses' => 'FilesController@pagina']);

//Route::group(['prefix' => '/admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'role:administrador,access_backend'], function() {    
*/

Route::group(['prefix' => '/admin', 'as' => 'admin.', 'namespace' => 'Admin'], function() {
    Route::post('countries/listCountriesModalidad', ['as' => 'countries.listCountriesModalidad','uses' => 'CountryController@listCountriesModalidad']);
    Route::post('cities/listStates', ['as' => 'cities.listStates','uses' => 'CityController@listStates']);
    Route::post('cities/listCities', ['as' => 'cities.listCities','uses' => 'CityController@listCities']);

    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    
    Route::get('logs',['as' => 'logs.index','uses' => 'LogViewer\LogViewerController@index']);

    //Localizacion
    Route::resource('countries', 'CountryController');
    
    Route::resource('states', 'StateController');

    Route::resource('cities', 'CityController');

    //datos de la institucion

    Route::resource('institutions', 'InstitucionController');
    Route::get('institutions/{institucion_id}/documents/create', ['as' => 'institutions.documents.create','uses' => 'InstitucionController@documents_create']);
    Route::get('institutions/{institucion_id}/documents/{documento_id?}', ['as' => 'institutions.documents','uses' => 'InstitucionController@documents']);
    Route::post('institutions/{institucion_id}/documents', ['as' => 'institutions.documents.store','uses' => 'InstitucionController@documents_store']);

    Route::resource('campus', 'CampusController');
    Route::post('campus/listcampus', ['as' => 'campus.listcampus','uses' => 'CampusController@listCampus']);

    Route::resource('faculties', 'FacultadController');
    
    Route::resource('programs', 'ProgramaController');
    Route::post('programs/listPrograms', ['as' => 'programs.listPrograms','uses' => 'ProgramaController@listPrograms']);
    
    Route::resource('subjects', 'AsignaturaController');

    Route::resource('documentosInstitucion', 'DocumentosInstitucionController');

});


    // external 
    // los usuarios que reciban el email podran verificar el contenido sin tener que loguearse 
    Route::get('interalliances/subscribe/destination/{token?}',['as' => 'interalliances.destination','uses' => 'InterAllianceController@destination']);



Route::group(['middleware' => 'auth'], function() {

    Route::resource('user', 'Admin\UserController');
    //InterAlliance
    //Route::resource('interalliances', 'InterAllianceController');

    // Map 
    Route::get('interalliances/map',['as' => 'interalliances.map','uses' => 'InterAllianceController@map']);

    Route::post('interalliances/list',['as' => 'interalliances.list','uses' => 'InterAllianceController@list']);

    // Subscribe 
    Route::get('interalliances/subscribe/origin',['as' => 'interalliances.origin','uses' => 'InterAllianceController@origin']);
    Route::get('interalliances/subscribe/origin/{alianza_id}/edit',['as' => 'interalliances.edit','uses' => 'InterAllianceController@edit']);
    Route::get('interalliances/subscribe/destination/{token}/{paso}/edit',['as' => 'interalliances.destination.edit','uses' => 'InterAllianceController@edit']);
    //Route::get('interalliances/subscribe/destination/{token}/edit',['as' => 'interalliances.destination.edit','uses' => 'InterAllianceController@edit']);
    Route::get('interalliances/subscribe',function(){
        return redirect()->route('interalliances.origin');
    });

    // Alliances 
    Route::get('interalliances/alliances',['as' => 'interalliances.alliances','uses' => 'InterAllianceController@index']);

    // mail 
    //Route::get('interalliances/mail',['as' => 'interalliances.mail','uses' => 'InterAllianceController@mail']);
    Route::post('interalliances/mail',['as' => 'interalliances.mail','uses' => 'InterAllianceController@mail']);
    //generar pdf
    Route::get('interalliances/{id_alliance}/pdf',['as' => 'interalliances.pdf','uses' => 'InterAllianceController@pdf']);

    Route::resource('interalliances', 'InterAllianceController');

    


    //InterChange
    //Route::resource('interChanges', 'InterChangeController');
    Route::group(['prefix' => 'interchanges', 'as' => 'interchanges.'], function() {
        //InterOut
        Route::get('interout/map',['as' => 'interout.map','uses' => 'InterChangeController@map']);
        Route::get('interin/map',['as' => 'interin.map','uses' => 'InterChangeController@map']);

        Route::post('list',['as' => 'list','uses' => 'InterChangeController@list']);

        // mail 
        Route::post('mail',['as' => 'mail','uses' => 'InterChangeController@mail']);
        //generar pdf
        Route::get('{id_interchange}/pdf',['as' => 'pdf','uses' => 'InterChangeController@pdf']);

        //Route::resource('interChanges', 'InterChangeController');
        Route::resource('interout', 'InterChangeController');
        Route::resource('interin', 'InterChangeController');
    });


    //InterAction
    // Route::group(['prefix' => 'interactions', 'as' => 'interactions.'], function() {
        Route::get('interactions/map', function() {
            return redirect('/html/interactions-map.php');
        });
        Route::get('interactions/opportunities', function() {
            return redirect('/html/opportunities.php');
        });
        Route::get('interactions/send_initiative', function() {
            return redirect('/html/initiative.php');
        });

        
    // });

        
    // Route::group(['prefix' => 'interindicators', 'as' => 'interindicators.'], function() {
        Route::get('interindicators/indicators', function() {
            return redirect('/html/indicators.php');
        });
    // });
});



Route::group(['prefix' => '/intervalidation', 'as' => 'intervalidation.', 'namespace' => 'Validation'], function() {
    //se definen las rutas como validation.{modulo}.validations para que el verificador de permisos reciba, por ejemplo, validations.create y verifique el que tenga el permiso add_validations, de lo contrario recibiria add_alliances y no seria claro para asignar permisos

    //modulo de validacion para la alianza
    Route::group(['prefix' => '/interalliances', 'as' => 'interalliances.'], function() { 
        //generar pdf
        Route::get('{alianza_id}/pdf',['as' => 'validations.pdf','uses' => 'PasosAlianzaController@pdf']);
        Route::get('{alianza_id}/print',['as' => 'validations.print','uses' => 'PasosAlianzaController@print']);
        Route::post('{alianza_id}/documents',['as' => 'validations.documents.store','uses' => 'PasosAlianzaController@documents_store']);
        //Route::get('/',['as' => 'validations.index','uses' => 'PasosAlianzaController@index']);
        Route::get('{alianza_id}/create',['as' => 'validations.create','uses' => 'PasosAlianzaController@create']);
        //Route::post('/',['as' => 'validations.store','uses' => 'PasosAlianzaController@store']);
        Route::get('{alianza_id}/{paso_id?}',['as' => 'validations.show','uses' => 'PasosAlianzaController@show']);
        Route::get('{alianza_id}/{paso_id}/edit',['as' => 'validations.edit','uses' => 'PasosAlianzaController@edit']);
        //Route::put('{paso_id}',['as' => 'validations.update','uses' => 'PasosAlianzaController@update']);
        //Route::patch('{paso_id}',['as' => 'validations.update','uses' => 'PasosAlianzaController@update']);
        //Route::delete('{paso_id}',['as' => 'validations.destroy','uses' => 'PasosAlianzaController@destroy']);
    });
    Route::resource('interalliances', 'PasosAlianzaController', ['parameters' => [
       'alliances' => 'paso_id'
    ],'names' => [
        'index' => 'interalliances.validations.index',
        'store' => 'interalliances.validations.store',
        'update' => 'interalliances.validations.update',
        'destroy' => 'interalliances.validations.destroy'
    ],'except' => [
       'create', 'show', 'edit'
    ]]);

    //modulo de validacion para la inscripcion (interchange)
    Route::group(['prefix' => '/interchanges', 'as' => 'interchanges.'], function() { 
        //generar pdf
        Route::get('{inscripcion_id}/pdf',['as' => 'validations.pdf','uses' => 'PasosInscripcionController@pdf']);
        Route::get('{inscripcion_id}/create',['as' => 'validations.create','uses' => 'PasosInscripcionController@create']);
        Route::get('{inscripcion_id}/{paso_id?}',['as' => 'validations.show','uses' => 'PasosInscripcionController@show']);
        Route::get('{inscripcion_id}/{paso_id}/edit',['as' => 'validations.edit','uses' => 'PasosInscripcionController@edit']);
    });
    Route::resource('interchanges', 'PasosInscripcionController', ['parameters' => [
       'interchanges' => 'paso_id'
    ],'names' => [
        'index' => 'interchanges.validations.index',
        'store' => 'interchanges.validations.store',
        'update' => 'interchanges.validations.update',
        'destroy' => 'interchanges.validations.destroy'
    ],'except' => [
       'create', 'show', 'edit'
    ]]);
    
    //TEMPORAL
    Route::get('interactions',['as' => 'interactions.validations.index','uses' => 'PasosAlianzaController@index']);

    //para asignar los validadores
    Route::resource('assignments', 'UserPasoController');

});


Route::resource('aplicaciones', 'AplicacionesController');

Route::post('aplicaciones/listAplicaciones', ['as' => 'aplicaciones.listAplicaciones','uses' => 'AplicacionesController@listAplicaciones']);



//Route::get('send/{postId}', ['as' => 'send','uses' => 'PostController@send']);

Route::get('send/{postId}', ['as' => 'mails.sendMail', 'uses' => 'MailController@sendMail'] );
Route::get('send', ['as' => 'mails.index', 'uses' => 'MailController@index'] );


Route::resource('tipoAlianzas', 'TipoAlianzaController');

Route::resource('tipoTramites', 'TipoTramiteController');




Route::resource('inscripcions', 'InscripcionController');

Route::resource('tipoAlianzas', 'TipoAlianzaController');

Route::resource('tipoInstitucions', 'TipoInstitucionController');

Route::resource('datosPersonales', 'DatosPersonalesController');

Route::resource('tipoFacultads', 'TipoFacultadController');

Route::resource('mails', 'MailController');

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





Route::get('validation/pasosIniciativas', ['as'=> 'validation.pasosIniciativas.index', 'uses' => 'Validation\PasosIniciativaController@index']);
Route::post('validation/pasosIniciativas', ['as'=> 'validation.pasosIniciativas.store', 'uses' => 'Validation\PasosIniciativaController@store']);
Route::get('validation/pasosIniciativas/create', ['as'=> 'validation.pasosIniciativas.create', 'uses' => 'Validation\PasosIniciativaController@create']);
Route::put('validation/pasosIniciativas/{pasosIniciativas}', ['as'=> 'validation.pasosIniciativas.update', 'uses' => 'Validation\PasosIniciativaController@update']);
Route::patch('validation/pasosIniciativas/{pasosIniciativas}', ['as'=> 'validation.pasosIniciativas.update', 'uses' => 'Validation\PasosIniciativaController@update']);
Route::delete('validation/pasosIniciativas/{pasosIniciativas}', ['as'=> 'validation.pasosIniciativas.destroy', 'uses' => 'Validation\PasosIniciativaController@destroy']);
Route::get('validation/pasosIniciativas/{pasosIniciativas}', ['as'=> 'validation.pasosIniciativas.show', 'uses' => 'Validation\PasosIniciativaController@show']);
Route::get('validation/pasosIniciativas/{pasosIniciativas}/edit', ['as'=> 'validation.pasosIniciativas.edit', 'uses' => 'Validation\PasosIniciativaController@edit']);

