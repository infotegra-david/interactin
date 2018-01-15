<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plantillas
 * @package App\Models
 * @version December 7, 2017, 6:13 pm -05
 *
 * @property \App\Models\Campus campus
 * @property \App\Models\TipoPlantilla tipoPlantilla
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer tipo_plantilla_id
 * @property string descripcion
 * @property string content
 * @property integer campus_id
 */
class Plantillas extends Model
{
    use SoftDeletes;

    public $table = 'plantillas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_plantilla_id',
        'descripcion',
        'content',
        'campus_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_plantilla_id' => 'integer',
        'descripcion' => 'string',
        'content' => 'string',
        'campus_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function campus()
    {
        return $this->belongsTo(\App\Models\Campus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPlantilla()
    {
        return $this->belongsTo(\App\Models\TipoPlantilla::class);
    }
}
