<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        /*
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // disable fk constrain check
            // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");

            // enable back fk constrain check
            // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
        
    }
        //Model::unguard();
        
        */
        // $this->call(MigrationsTableSeeder::class);
        $this->call(AlianzaTableSeeder::class);
        $this->call(AlianzaAplicacionesTableSeeder::class);
        $this->call(AlianzaFacultadTableSeeder::class);
        $this->call(AlianzaInstitucionTableSeeder::class);
        $this->call(AlianzaModalidadesTableSeeder::class);
        $this->call(AlianzaProgramaTableSeeder::class);
        $this->call(AlianzaUserTableSeeder::class);
        $this->call(AplicacionesTableSeeder::class);
        $this->call(ArchivoTableSeeder::class);
        $this->call(AsignaturaTableSeeder::class);
        $this->call(CalificacionTableSeeder::class);
        $this->call(CampusTableSeeder::class);
        $this->call(CiudadTableSeeder::class);
        $this->call(ClaseDocumentoTableSeeder::class);
        $this->call(DatosPersonalesTableSeeder::class);
        $this->call(DepartamentoTableSeeder::class);
        $this->call(DocumentosAlianzaTableSeeder::class);
        $this->call(DocumentosIniciativaTableSeeder::class);
        $this->call(DocumentosInscripcionTableSeeder::class);
        $this->call(DocumentosInstitucionTableSeeder::class);
        $this->call(DocumentosOportunidadTableSeeder::class);
        $this->call(EquivalenteTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(EvaluacionTableSeeder::class);
        $this->call(FacultadTableSeeder::class);
        $this->call(FinanciacionTableSeeder::class);
        $this->call(FormatoTableSeeder::class);
        $this->call(FuenteFinanciacionTableSeeder::class);
        $this->call(IdiomasTableSeeder::class);
        $this->call(IniciativaTableSeeder::class);
        $this->call(IniciativaActorTableSeeder::class);
        $this->call(InscripcionTableSeeder::class);
        $this->call(InscripcionAsignaturaTableSeeder::class);
        $this->call(InstitucionTableSeeder::class);
        $this->call(MailTableSeeder::class);
        $this->call(MailArchivoTableSeeder::class);
        $this->call(MatriculaTableSeeder::class);
        $this->call(ModalidadesTableSeeder::class);
        // $this->call(ModelHasPermissionsTableSeeder::class);
        // $this->call(ModelHasRolesTableSeeder::class);
        $this->call(MultimediaTableSeeder::class);
        $this->call(NivelTableSeeder::class);
        $this->call(OportunidadTableSeeder::class);
        $this->call(OportunidadActorTableSeeder::class);
        $this->call(OportunidadModalidadesTableSeeder::class);
        $this->call(PaginaTableSeeder::class);
        $this->call(PaisTableSeeder::class);
        $this->call(PasosAlianzaTableSeeder::class);
        $this->call(PasosAlianzaMailTableSeeder::class);
        $this->call(PasosIniciativaTableSeeder::class);
        $this->call(PasosIniciativaMailTableSeeder::class);
        $this->call(PasosInscripcionTableSeeder::class);
        $this->call(PasosInscripcionMailTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PeriodoTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        $this->call(PersonaContactoTableSeeder::class);
        $this->call(PostulacionTableSeeder::class);
        $this->call(ProgramaTableSeeder::class);
        $this->call(RolIniciativaTableSeeder::class);
        // $this->call(RoleHasPermissionsTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        $this->call(SeccionTableSeeder::class);
        $this->call(TipoActorTableSeeder::class);
        $this->call(TipoAlianzaTableSeeder::class);
        $this->call(TipoArchivoTableSeeder::class);
        $this->call(TipoDocumentoTableSeeder::class);
        $this->call(TipoFacultadTableSeeder::class);
        $this->call(TipoIdiomaTableSeeder::class);
        $this->call(TipoInstitucionTableSeeder::class);
        $this->call(TipoPasoTableSeeder::class);
        $this->call(TipoTramiteTableSeeder::class);
        $this->call(UserCampusTableSeeder::class);
        $this->call(UserTipoPasoTableSeeder::class);
        $this->call(UserTipoPasoMailTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // lista de roles
        $list_roles = "administrador,director_programa,coordinador_externo,coordinador_interno,profesor,validador,representante_legal,creador_iniciativa,aliado_iniciativa,estudiante,particular,copia_oculta_email,generar_documento";

        $list_permissions = "view_users,add_users,edit_users,delete_users,view_roles,add_roles,edit_roles,delete_roles,view_interalliances,add_interalliances,edit_interalliances,delete_interalliances,view_interactions,add_interactions,edit_interactions,delete_interactions,view_interin,add_interin,edit_interin,delete_interin,view_interout,add_interout,edit_interout,delete_interout,view_countries,add_countries,edit_countries,delete_countries,view_states,add_states,edit_states,delete_states,view_cities,add_cities,edit_cities,delete_cities,view_pasosalianzas,add_pasosalianzas,edit_pasosalianzas,delete_pasosalianzas,view_mails,add_mails,edit_mails,delete_mails,view_logs,add_logs,edit_logs,delete_logs,view_validations,add_validations,edit_validations,delete_validations,view_destination,add_destination,edit_destination,delete_destination,view_assignments,add_assignments,edit_assignments,delete_assignments,view_institutions,add_institutions,edit_institutions,delete_institutions,view_campus,add_campus,edit_campus,delete_campus,view_faculties,add_faculties,edit_faculties,delete_faculties,view_programs,add_programs,edit_programs,delete_programs,view_subjects,add_subjects,edit_subjects,delete_subjects,view_user,add_user,edit_user,delete_user";

        //SELECT model_has_roles.model_id, roles.name FROM model_has_roles inner join roles on (model_has_roles.role_id = roles.id) ORDER BY model_has_roles.model_id asc
        $list_model_has_roles = array(
            array( "id" => 1, "rol" => "coordinador_interno"),
            array( "id" => 1, "rol" => "validador"),
            array( "id" => 1, "rol" => "administrador"),
            array( "id" => 1, "rol" => "generar_documento"),
            array( "id" => 2, "rol" => "director_programa"),
            array( "id" => 3, "rol" => "coordinador_externo"),
            array( "id" => 4, "rol" => "coordinador_interno"),
            array( "id" => 5, "rol" => "profesor"),
            array( "id" => 6, "rol" => "validador"),
            array( "id" => 6, "rol" => "generar_documento"),
            array( "id" => 7, "rol" => "representante_legal"),
            array( "id" => 8, "rol" => "creador_iniciativa"),
            array( "id" => 9, "rol" => "aliado_iniciativa"),
            array( "id" => 10, "rol" => "estudiante"),
            array( "id" => 11, "rol" => "particular"),
            array( "id" => 12, "rol" => "copia_oculta_email"),
            array( "id" => 13, "rol" => "validador"),
            array( "id" => 14, "rol" => "validador"),
            array( "id" => 15, "rol" => "validador"),
            array( "id" => 16, "rol" => "administrador"),
            array( "id" => 17, "rol" => "administrador"),
            array( "id" => 18, "rol" => "validador"),
            array( "id" => 19, "rol" => "validador"),
        );


        //SELECT roles.name, permissions.name FROM role_has_permissions INNER join permissions on (role_has_permissions.permission_id = permissions.id) INNER JOIN roles on (role_has_permissions.role_id=roles.id) ORDER BY `roles`.`name` ASC, permissions.name Asc
        
        $list_role_has_permissions = array(
            'administrador' => array('add_cities','add_countries','add_interactions','add_interalliances','add_interin','add_interout','add_logs','add_mails','add_pasosalianzas','add_roles','add_states','add_users','add_validations','delete_cities','delete_countries','delete_interactions','delete_interalliances','delete_interin','delete_interout','delete_logs','delete_mails','delete_pasosalianzas','delete_roles','delete_states','delete_users','delete_validations','edit_cities','edit_countries','edit_interactions','edit_interalliances','edit_interin','edit_interout','edit_logs','edit_mails','edit_pasosalianzas','edit_roles','edit_states','edit_users','edit_validations','view_cities','view_countries','view_interactions','view_interalliances','view_interin','view_interout','view_logs','view_mails','view_pasosalianzas','view_roles','view_states','view_users','view_validations','view_destination','add_destination','edit_destination','delete_destination','view_assignments','add_assignments','edit_assignments','delete_assignments','view_institutions','add_institutions','edit_institutions','delete_institutions','view_campus','add_campus','edit_campus','delete_campus','view_faculties','add_faculties','edit_faculties','delete_faculties','view_programs','add_programs','edit_programs','delete_programs','view_subjects','add_subjects','edit_subjects','delete_subjects','view_user','add_user','edit_user','delete_user'),
            'aliado_iniciativa' => array('view_cities','view_countries','view_states','view_user','add_user','edit_user','delete_user'),
            'coordinador_externo' => array('add_interalliances','add_interin','add_interout','add_mails','delete_interin','delete_interout','edit_interalliances','edit_interin','edit_interout','view_cities','view_countries','view_interactions','view_interalliances','view_interin','view_interout','view_mails','view_states','view_users','view_destination','add_destination','edit_destination','delete_destination','view_user','add_user','edit_user','delete_user'),
            'coordinador_interno' => array('add_interalliances','delete_interalliances','edit_interalliances','view_cities','view_countries','view_interalliances','view_mails','view_states','view_user','add_user','edit_user','delete_user'),
            'copia_oculta_email' => array('view_cities','view_countries','view_interactions','view_interalliances','view_interin','view_interout','view_mails','view_pasosalianzas','view_states','view_user','add_user','edit_user','delete_user'),
            'creador_iniciativa' => array('view_cities','view_countries','view_states','view_user','add_user','edit_user','delete_user'),
            'director_programa' => array('view_cities','view_countries','view_interactions','view_interalliances','view_interin','view_interout','view_states','view_users','view_user','add_user','edit_user','delete_user'),
            'estudiante' => array('add_interactions','add_interout','delete_interactions','delete_interout','edit_interactions','edit_interout','view_cities','view_countries','view_interactions','view_interout','view_states','view_user','add_user','edit_user','delete_user'),
            'generar_documento' => array('view_pasosalianzas','view_validations','view_user','add_user','edit_user','delete_user'),
            'particular' => array('view_cities','view_countries','view_interactions','view_interin','view_interout','view_states','view_user','add_user','edit_user','delete_user'),
            'profesor' => array('add_interalliances','edit_interalliances','view_cities','view_countries','view_interalliances','view_mails','view_states','view_user','add_user','edit_user','delete_user'),
            'representante_legal' => array('view_cities','view_countries','view_states','view_destination','add_destination','edit_destination','delete_destination','view_user','add_user','edit_user','delete_user'),
            'validador' => array('add_pasosalianzas','add_validations','delete_pasosalianzas','delete_validations','edit_pasosalianzas','edit_validations','view_cities','view_countries','view_interactions','view_interalliances','view_interin','view_interout','view_mails','view_pasosalianzas','view_states','view_validations','view_user','add_user','edit_user','delete_user')    
       );


       //--------------------------------------------------------------
        //--------------------------------------------------------------
        //--------------------------------------------------------------
        //--------------------------------------------------------------
        // Reset cached roles and permissions
        /*
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');
        $role->givePermissionTo('delete articles');

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('publish articles');
        $role->givePermissionTo('unpublish articles');
        */
        //--------------------------------------------------------------
        //--------------------------------------------------------------
        //--------------------------------------------------------------
        //--------------------------------------------------------------

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        \DB::table('role_has_permissions')->delete();
        \DB::table('model_has_roles')->delete();
        \DB::table('permissions')->delete();
        \DB::table('roles')->delete();

        // Seed the permissions
        $permissions = explode(',', $list_permissions);

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Permisos ' . $list_permissions . ' creados correctamente');

        // Explode roles
        $roles_array = explode(',', $list_roles);

        // add roles
        foreach($roles_array as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);

            if (isset($list_role_has_permissions[$role->name])) {
                $role_permissions = $list_role_has_permissions[$role->name];
                if (count($role_permissions)) {
                    $role->syncPermissions(Permission::whereIn('name', $role_permissions)->get());
                    $this->command->info('Se le asignaron los permisos al rol '.$role->name);
                }
            }
            /*
            if( $role->name == 'administrador' ) {
                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('Se le asignaron todos los permisos al administrador');
            }
            */
            // create one user for each role
            $this->assignUser($role,$list_model_has_roles);
        }

        $this->command->info('Roles ' . $list_roles . ' creados correctamente');


    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function assignUser($role,$list_model_has_roles)
    {
                
        $array_keys_ =  array_keys(array_column($list_model_has_roles, 'rol'), $role->name);

        //$id_users = array();
        foreach ($array_keys_ as $key => $value) {
            //s$id_users[] = $list_model_has_roles[$value]['id'];
            $users = User::find($list_model_has_roles[$value]['id']);
            $users->assignRole($role->name);
            
            $this->command->info('Al usuario '.$users->email.' le fue asignado el rol '.$role->name);
        }


    }
}