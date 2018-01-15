<?php

namespace App\Models\Validation;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PasosAlianza
 * @package App\Models
 * @version June 28, 2017, 10:14 am COT
 */
class PasosAlianza extends Model
{
    use SoftDeletes;

    public $table = 'pasos_alianza';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_paso_id',
        'estado_id',
        'user_id',
        'campus_id',
        'observacion',
        'alianza_id'
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
        'alianza_id' => 'integer'
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
        return $this->belongsToMany('\App\Models\Email','pasos_alianza_email','pasos_alianza_id','email_id');
    }
}
