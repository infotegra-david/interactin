<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AlianzaInstitucion
 * @package App\Models
 * @version June 29, 2017, 5:25 pm COT
 */
class AlianzaInstitucion extends Model
{
    use SoftDeletes;

    public $table = 'alianza_institucion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'alianza_id',
        'institucion_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'alianza_id' => 'integer',
        'institucion_id' => 'integer'
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
    public function institucion()
    {
        return $this->belongsTo(\App\Models\Admin\Institucion::class);
    }
}
