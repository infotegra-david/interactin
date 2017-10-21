<?php

namespace App\Models\Validation;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserPaso
 * @package App\Models
 * @version July 13, 2017, 5:59 pm COT
 */
class UserPaso extends Model
{
    use SoftDeletes;

    public $table = 'user_tipo_paso';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipo_paso_id',
        'user_id',
        'orden',
        'titulo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_paso_id' => 'integer',
        'user_id' => 'integer',
        'orden' => 'integer',
        'titulo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_paso_id' => 'required|integer',
        'user_id' => 'required|integer',
        'orden' => 'required|integer',
        'titulo' => 'required|string'
    ];

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
    public function mail()
    {
        return $this->belongsToMany('\App\Models\Mail','user_tipo_paso_mail','user_tipo_paso_id','mail_id');
    }
}
