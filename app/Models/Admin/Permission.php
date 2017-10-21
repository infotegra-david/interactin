<?php

namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_interalliances',
            'add_interalliances',
            'edit_interalliances',
            'delete_interalliances',

            'view_interactions',
            'add_interactions',
            'edit_interactions',
            'delete_interactions',

            'view_interin',
            'add_interin',
            'edit_interin',
            'delete_interin',

            'view_interout',
            'add_interout',
            'edit_interout',
            'delete_interout',

            'view_countries',
            'add_countries',
            'edit_countries',
            'delete_countries',

            'view_states',
            'add_states',
            'edit_states',
            'delete_states',

            'view_cities',
            'add_cities',
            'edit_cities',
            'delete_cities',

            'view_pasosalianzas',
            'add_pasosalianzas',
            'edit_pasosalianzas',
            'delete_pasosalianzas',

            'view_mails',
            'add_mails',
            'edit_mails',
            'delete_mails',

            'view_logs',
            'add_logs',
            'edit_logs',
            'delete_logs',

            'view_validations',
            'add_validations',
            'edit_validations',
            'delete_validations',

            'view_destination',
            'add_destination',
            'edit_destination',
            'delete_destination',

            'view_assignments',
            'add_assignments',
            'edit_assignments',
            'delete_assignments',

            'view_institutions',
            'add_institutions',
            'edit_institutions',
            'delete_institutions',

            'view_campus',
            'add_campus',
            'edit_campus',
            'delete_campus',

            'view_faculties',
            'add_faculties',
            'edit_faculties',
            'delete_faculties',

            'view_programs',
            'add_programs',
            'edit_programs',
            'delete_programs',

            'view_subjects',
            'add_subjects',
            'edit_subjects',
            'delete_subjects',
        ];
    }
}
