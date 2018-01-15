<?php

namespace App\Models\Validation;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PasosIniciativa
 * @package App\Models\Validation
 * @version October 2, 2017, 2:44 pm -05
 *
 * @property integer tipo_paso_id
 * @property integer estado_id
 * @property integer user_id
 * @property string observacion
 * @property integer iniciativa_id
 */
class PasosIniciativa extends Model
{
    use SoftDeletes;

    public $table = 'pasos_iniciativa';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_paso_id',
        'estado_id',
        'user_id',
        'campus_id',
        'observacion',
        'iniciativa_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_paso_id' => 'integer',
        'estado_id' => 'integer',
        'user_id' => 'integer',
        'campus_id' => 'integer',
        'observacion' => 'string',
        'iniciativa_id' => 'integer'
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
    public function iniciativa()
    {
        return $this->belongsTo(\App\Models\Iniciativa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoPaso()
    {
        return $this->belongsTo(\App\Models\TipoPaso::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function email()
    {
        return $this->belongsToMany('\App\Models\Email','pasos_iniciativa_email','pasos_inicitativa_id','email_id');
    }
}
