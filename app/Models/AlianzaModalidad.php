<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AlianzaModalidad
 * @package App\Models
 * @version June 29, 2017, 5:26 pm COT
 */
class AlianzaModalidad extends Model
{
    use SoftDeletes;

    public $table = 'alianza_modalidad';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'alianza_id',
        'modalidad_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'alianza_id' => 'integer',
        'modalidad_id' => 'integer'
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
    public function alianza()
    {
        return $this->belongsTo(\App\Models\Alianza::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function modalidad()
    {
        return $this->belongsTo(\App\Models\Modalidad::class);
    }
}
