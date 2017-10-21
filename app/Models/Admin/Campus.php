<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Campus
 * @package App\Models\Admin
 * @version September 26, 2017, 11:46 am -05
 *
 * @property string nombre
 * @property integer institucion_id
 * @property string telefono
 * @property string direccion
 * @property string codigo_postal
 * @property string email
 * @property integer ciudad_id
 */
class Campus extends Model
{
    use SoftDeletes;

    public $table = 'campus';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'institucion_id',
        'telefono',
        'direccion',
        'codigo_postal',
        'email',
        'ciudad_id',
        'principal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'institucion_id' => 'integer',
        'telefono' => 'string',
        'direccion' => 'string',
        'codigo_postal' => 'string',
        'email' => 'string',
        'ciudad_id' => 'integer',
        'principal' => 'integer'
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
    public function ciudad()
    {
        return $this->belongsTo(\App\Models\Admin\City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function institucion()
    {
        return $this->belongsTo(\App\Models\Admin\Institucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function facultad()
    {
        return $this->hasMany(\App\Models\Admin\Facultad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsToMany('\App\User','user_campus','campus_id','user_id');
    }
    
}
