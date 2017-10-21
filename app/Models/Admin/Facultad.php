<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Facultad
 * @package App\Models\Admin
 * @version September 26, 2017, 12:00 pm -05
 *
 * @property string nombre
 * @property integer campus_id
 * @property integer tipo_facultad_id
 */
class Facultad extends Model
{
    use SoftDeletes;

    public $table = 'facultad';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'campus_id',
        'tipo_facultad_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'campus_id' => 'integer',
        'tipo_facultad_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
