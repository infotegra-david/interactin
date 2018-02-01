<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InscripcionAsignaturas
 * @package App\Models\Admin
 * @version January 22, 2018, 10:03 am -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer inscripcion_id
 * @property integer equivalentes_id
 */
class InscripcionAsignaturas extends Model
{
    use SoftDeletes;

    public $table = 'inscripcion_asignaturas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'inscripcion_id',
        'equivalentes_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inscripcion_id' => 'integer',
        'equivalentes_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
