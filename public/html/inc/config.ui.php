<?php

//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_self",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)

*/

@session_start();
if (!isset($_SESSION["roles"], $_SESSION["permissions"])) {
	header("Location: ../login");
	die();
}

$isAdministrador = array_search('administrador', $_SESSION["roles"]);
$isEstudiante = array_search('estudiante', $_SESSION["roles"]);
$isValidador = array_search('validador', $_SESSION["roles"]);
$isProfesor = array_search('profesor', $_SESSION["roles"]);
$isCoordinador_interno = array_search('coordinador_interno', $_SESSION["roles"]);
$isCoordinador_externo = array_search('coordinador_externo', $_SESSION["roles"]);

$listPermissions = $_SESSION["permissions"];

$page_nav = array();
//submenu Inicio
	$InicioSub = array();
	//comprobar los permisos para cada formulario

	if($isAdministrador !== false){
		$InicioSub["Administrador"] = array(
					"icon" => "fa-gear",
					"title" => "Administrador",
					"url" => "../home"
				);
	}
	if($isEstudiante !== false){
		$InicioSub["Estudiante"] = array(
					"title" => "Estudiante",
					"icon" => "fa-graduation-cap",
					"url" => "../html/estudiante_home.php"
				);
	}
	if($isValidador !== false){
		$InicioSub["Validador"] = array(
					"title" => "Validador",
					"icon" => "fa-search",
					"url" => "../html/validador_home.php"
				);
	}
	if($isCoordinador_interno !== false){
		$InicioSub["Coordinador_int"] = array(
					"title" => "Coordinador Int.",
					"icon" => "fa-user-circle-o",
					"url" => "../html/coordinador_home.php"
				);
	}
	if($isCoordinador_externo !== false){
		$InicioSub["Coordinador_ext"] = array(
					"title" => "Coordinador Ext.",
					"icon" => "fa-user-circle-o",
					"url" => "../html/coordinador_home.php"
				);
	}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InicioSub) ) {

		$page_nav["dashboard"]["sub"] = $InicioSub;
	}

//submenu InterChange
	$InterChangeSub = array();
	//comprobar los permisos para cada formulario

	if(isset($listPermissions['view_interout'])){
		$InterChangeSub["InterOutMap"] = array(
			        "title" => "InterOutMap",
			        "icon" => "fa-map",
			        "url" => "../interchanges/interout/map"
				);
	}
	if(isset($listPermissions['add_interout'])){
		$InterChangeSub["InterOut"] = array(
					"title" => "InterOut",
					"icon" => "fa-arrow-up",
					"url" => "../interchanges/interout"
					//"url" => "../interchanges/interout/create"
				);
	}
	if(isset($listPermissions['view_interin'])){
		$InterChangeSub["InterInMap"] = array(
					"title" => "InterInMap",
					"icon" => "fa-map-o",
					"url" => "../interchanges/interin/map"
				);
	}
	if(isset($listPermissions['add_interin'])){
		$InterChangeSub["InterIn"] = array(
			        "title" => "InterIn",
			        "icon" => "fa-arrow-down",
			        "url" => "../interchanges/interin"
			        //"url" => "../interchanges/interin/create"
				);
	}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterChangeSub) ) {

		$InterChange = array(
			"InterChange" => array(
				"title" => "InterChange",
				"icon" => "fa-exchange txt-color-white",
				"sub" => $InterChangeSub
			)
		);

		$page_nav = array_merge($page_nav, $InterChange);
	}


//submenu InterAlliance
	$InterAllianceSub = array();
	//comprobar los permisos para cada formulario
	if(isset($listPermissions['view_interalliances'])){
		$InterAllianceSub["InterAllianceMap"] = array(
			        "title" => "InterAllianceMap",
			        "icon" => "fa-map-marker",
			        "url" => "../interalliances/map"
				);
		//los dos formularios comparten el mismo permisos
		$InterAllianceSub["Alliances"] = array(
			        "title" => "Alianzas",
			        "icon" => "fa-list-ul",
					"url" => "../interalliances",
				);
		
		if( isset($_SESSION["mis_alianzas"]) ){
			$InterAllianceSub["Alliances"] = array_merge($InterAllianceSub["Alliances"], [
			"label_htm" => '<span class="badge bg-color-greenLight pull-right inbox-badge">'.$_SESSION["mis_alianzas"].'</span>'
			]);
		}
	}

	if(isset($listPermissions['add_interalliances']) && ( $isProfesor !== false || $isCoordinador_interno !== false ) ){
		$InterAllianceSub["SubscribeAlliance"] = array(
					"title" => "Subscribir alianza",
					"icon" => "fa-handshake-o",
					"url" => "../interalliances/subscribe/origin"
				);
	}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterAllianceSub) ) {

		$InterAlliance = array(
			"InterAlliance" => array(
				"title" => "InterAlliance",
				"icon" => "fa-handshake-o txt-color-white",
				"raiz" => "../interalliances",
				"sub" => $InterAllianceSub
			)
		);

		$page_nav = array_merge($page_nav, $InterAlliance);
	}

//submenu InterActions
	$InterActionsSub = array();
	//comprobar los permisos para cada formulario
	if(isset($listPermissions['view_interactions'])){
		$InterActionsSub["InterActionsMap"] = array(
			        "title" => "InterActionsMap",
			        "icon" => "fa-flag",
			        "url" => "../html/interactions-map.php"
				);
		//los dos formularios comparten el mismo permisos
		$InterActionsSub["Opportunities"] = array(
					"title" => "Oportunidades",
					"icon" => "fa-child",
					"url" => "../html/opportunities.php"
				);
	}
	if(isset($listPermissions['add_interactions'])){
		$InterActionsSub["InterIniciative"] = array(
			        "title" => "Enviar inicativa",
			        "icon" => "fa-lightbulb-o",
			        "url" => "../html/initiative.php"
				);
	}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterActionsSub) ) {

		$InterActions = array(
			"InterActions" => array(
				"title" => "InterActions",
				"icon" => "fa-globe txt-color-white",
				"sub" => $InterActionsSub
			)
		);

		$page_nav = array_merge($page_nav, $InterActions);
	}

//submenu InterIndicators
	$InterIndicatorsSub = array();
	//comprobar los permisos para cada formulario
	//if(isset($listPermissions['view_indicators'])){
		$InterIndicatorsSub["Indicators"] = array(
					"title" => "Indicadores",
					"icon" => "fa-bar-chart",
					"url" => "../html/indicators.php"
				);
	//}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterIndicatorsSub) ) {

		$InterIndicators = array(
			"InterIndicators" => array(
				"title" => "InterIndicators",
				"icon" => "fa-line-chart txt-color-white",
				"sub" => $InterIndicatorsSub
			)
		);

		$page_nav = array_merge($page_nav, $InterIndicators);
	}

//submenu InterValidations
	$InterValidationsSub = array();
	//comprobar los permisos para cada formulario
	if(isset($listPermissions['view_validationsssssssss'])){
		//los formularios comparten el mismo permiso
		$InterValidationsSub["InterChanges"] = array(
			        "title" => "InterChanges",
			        "icon" => "fa-exchange	",
			        "url" => "../intervalidation/interchanges"
				);
		$InterValidationsSub["InterAlliances"] = array(
			        "title" => "InterAlliances",
			        "icon" => "fa-handshake-o	",
			        "url" => "../intervalidation/interalliances"
				);
		$InterValidationsSub["InterActions"] = array(
			        "title" => "InterActions",
			        "icon" => "fa-globe	",
			        "url" => "../intervalidation/interactions"
				);
	}
	if(isset($listPermissions['view_assignments'])){
		//los formularios comparten el mismo permiso
		$InterValidationsSub["Assignments"] = array(
			        "title" => "Assignments",
			        "icon" => "fa-user-plus",
			        "url" => "../intervalidation/assignments"
				);
	}

	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterValidationsSub) ) {

		$InterValidations = array(
			"InterValidations" => array(
				"title" => "InterValidations",
				"icon" => "fa-check-square txt-color-white",
				"sub" => $InterValidationsSub
			)
		);

		$page_nav = array_merge($page_nav, $InterValidations);
	}

//submenu InterAdmin
	$InterAdminSub = array();
	//comprobar los permisos para cada formulario
	if(isset($listPermissions['edit_users'])){
		$InterAdminSub["Users"] = array(
					"title" => "Usuarios",
					"icon" => "fa-users",
					"url" => "../admin/users"
				);
	}
	if(isset($listPermissions['edit_roles'])){
		$InterAdminSub["Roles"] = array(
					"title" => "Roles",
					"icon" => "fa-users",
					"url" => "../admin/roles"
				);
	}
	if(isset($listPermissions['edit_logs'])){
		$InterAdminSub["Logs"] = array(
					"title" => "Logs",
					"icon" => "fa-users",
					"url" => "../admin/logs"
				);
	}

	//sub menu InterAdmin Settings
	$InterAdminSettingsSub = array();

	//sub menu de InterAdmin Settings Institution
	$InterAdminSettingsInstitutionSub = array();

	if(isset($listPermissions['edit_institutions'])){
		$InterAdminSettingsInstitutionSub["InstitutionsSettings"] = array(
			            "title" => "Instituciones",
			            "icon" => "fa-university",
			            "url" => "../admin/institutions"
        );
	}
	if(isset($listPermissions['edit_campus'])){
		$InterAdminSettingsInstitutionSub["CampusSettings"] = array(
			            "title" => "Campus",
			            "icon" => "fa-building",
			            "url" => "../admin/campus"
        );
	}
	if(isset($listPermissions['edit_faculties'])){
		$InterAdminSettingsInstitutionSub["FacultiesSettings"] = array(
			            "title" => "Facultades",
			            "icon" => "fa-building-o",
			            "url" => "../admin/faculties"
        );
	}
	if(isset($listPermissions['edit_programs'])){
		$InterAdminSettingsInstitutionSub["ProgramsSettings"] = array(
			            "title" => "Programas",
			            "icon" => "fa-graduation-cap",
			            "url" => "../admin/programs"
        );
	}
	if(isset($listPermissions['edit_subjects'])){
		$InterAdminSettingsInstitutionSub["SubjectsSettings"] = array(
			            "title" => "Asignaturas",
			            "icon" => "fa-book",
			            "url" => "../admin/subjects"
        );
	}

	if ( count($InterAdminSettingsInstitutionSub) ) {
		//submenu settings
		$InterAdminSettingsSub["InstitutionSettings"] = array(
				        "title" => "Institución",
				        "icon" => "fa-university",
				        "sub" => $InterAdminSettingsInstitutionSub
						);
	}

	//sub menu de InterAdmin Settings Location
	$InterAdminSettingsLocationSub = array();

	if(isset($listPermissions['edit_countries'])){
		$InterAdminSettingsLocationSub["CountriesSettings"] = array(
			            "title" => "Países",
			            "icon" => "fa-flag",
			            "url" => "../admin/countries"
        );
	}
	if(isset($listPermissions['edit_states'])){
		$InterAdminSettingsLocationSub["StatesSettings"] = array(
			            "title" => "Departamentos / Estados",
			            "icon" => "fa-flag-o",
			            "url" => "../admin/states"
        );
	}
	if(isset($listPermissions['edit_cities'])){
		$InterAdminSettingsLocationSub["CitiesSettings"] = array(
			            "title" => "Ciudades",
			            "icon" => "fa-flag-o",
			            "url" => "../admin/cities"
        );
	}

	if ( count($InterAdminSettingsLocationSub) ) {
		//submenu settings
		$InterAdminSettingsSub["LocationSettings"] = array(
				        "title" => "Localización",
				        "icon" => "fa-cogs",
				        "sub" => $InterAdminSettingsLocationSub
						);
	}


	//sub menu de prueba de InterAdmin Settings
	$InterAdminSettingsSub["UserSettings"] = array(
			            "title" => "Usuarios template",
			            "icon" => "fa-user-plus",
			            "url" => "../html/users.php"
        );
	
	// agregar la opcion de menu en el caso de que tenga permiso para algun formulario
	if ( count($InterAdminSub) ) {

		if ( count($InterAdminSettingsSub) ) {
			//submenu settings
			$InterAdminSub += $InterAdminSettingsSub;
			// $InterAdminSub["Settings"] = array(
			//         "title" => "Parametros",
			//         "icon" => "fa-cogs",
			//         "sub" => $InterAdminSettingsSub
			// 		);
		}

		$InterAdmin = array(
			"InterAdmin" => array(
				"title" => "InterAdmin",
				"icon" => "fa-cog txt-color-white",
				"sub" => $InterAdminSub
			)
		);

		$page_nav = array_merge($page_nav, $InterAdmin);
	}




//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and index.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>