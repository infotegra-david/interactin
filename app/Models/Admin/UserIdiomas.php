<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserIdiomas
 * @package App\Models\Admin
 * @version December 22, 2017, 11:16 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property integer tipo_idioma_id
 * @property boolean certificado
 * @property string nombre_examen
 * @property integer nivel_id
 */
class UserIdiomas extends Model
{
    use SoftDeletes;

    public $table = 'user_idiomas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'tipo_idioma_id',
        'certificado',
        'nombre_examen',
        'nivel_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        // 'tipo_idioma_id' => 'integer',
        // 'certificado' => 'boolean',
        'nombre_examen' => 'string',
        // 'nivel_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
