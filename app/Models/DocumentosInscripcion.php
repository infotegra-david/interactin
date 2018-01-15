<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentosInscripcion
 * @package App\Models
 * @version November 24, 2017, 4:07 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer inscripcion_id
 * @property integer archivo_id
 * @property integer tipo_documento_id
 */
class DocumentosInscripcion extends Model
{
    use SoftDeletes;

    public $table = 'documentos_inscripcion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'inscripcion_id',
        'archivo_id',
        'tipo_documento_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'inscripcion_id' => 'integer',
        'archivo_id' => 'integer',
        'tipo_documento_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
