<?php

namespace App\Models\Validation;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PasosInscripcion
 * @package App\Models
 * @version September 12, 2017, 9:57 am -05
 *
 */
class PasosInscripcion extends Model
{
    use SoftDeletes;

    public $table = 'pasos_inscripcion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_paso_id',
        'estado_id',
        'user_id',
        'campus_id',
        'observacion',
        'inscripcion_id'
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
        'inscripcion_id' => 'integer'
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
    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function inscripcion()
    {
        return $this->belongsTo(\App\Models\Inscripcion::class);
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
        return $this->belongsTo(\App\User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function email()
    {
        return $this->belongsToMany('\App\Models\Email','pasos_inscripcion_email','pasos_inscripcion_id','email_id');
    }
}
