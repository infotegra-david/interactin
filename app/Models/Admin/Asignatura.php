<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asignatura
 * @package App\Models\Admin
 * @version September 26, 2017, 12:15 pm -05
 *
 * @property string nombre
 * @property string codigo
 * @property integer nro_creditos
 * @property integer programa_id
 */
class Asignatura extends Model
{
    use SoftDeletes;

    public $table = 'asignatura';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'codigo',
        'nro_creditos',
        'programa_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'codigo' => 'string',
        'nro_creditos' => 'integer',
        'programa_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
