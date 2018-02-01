<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Equivalentes
 * @package App\Models\Admin
 * @version January 22, 2018, 10:17 am -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer asignatura_origen_id
 * @property integer asignatura_destino_id
 */
class Equivalentes extends Model
{
    use SoftDeletes;

    public $table = 'equivalentes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'asignatura_origen_id',
        'asignatura_destino_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'asignatura_origen_id' => 'integer',
        'asignatura_destino_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
