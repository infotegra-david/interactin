<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClaseDocumento
 * @package App\Models
 * @version July 10, 2017, 5:36 pm COT
 */
class ClaseDocumento extends Model
{
    use SoftDeletes;

    public $table = 'clase_documento';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tipoDocumentos()
    {
        return $this->hasMany(\App\Models\TipoDocumento::class);
    }
}
