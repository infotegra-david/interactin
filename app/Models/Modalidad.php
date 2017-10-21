<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modalidad
 * @package App\Models
 * @version June 28, 2017, 10:07 am COT
 */
class Modalidad extends Model
{
    use SoftDeletes;

    public $table = 'modalidad';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'tipo_alianza_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'tipo_alianza_id' => 'integer'
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
    public function tipoAlianza()
    {
        return $this->belongsTo(\App\Models\TipoAlianza::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function alianza()
    {
        return $this->belongsToMany('\App\Models\Alianza','alianza_modalidades','modalidad_id','alianza_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function alianzaModalidades()
    {
        return $this->belongsToMany(\App\Models\AlianzaModalidad::class);
    }
}
