<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Institucion
 * @package App\Models\Admin
 * @version September 26, 2017, 10:40 am -05
 *
 * @property string nombre
 * @property string email
 * @property integer tipo_institucion_id
 */
class Institucion extends Model
{
    use SoftDeletes;

    public $table = 'institucion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'email',
        'tipo_institucion_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'email' => 'string',
        'tipo_institucion_id' => 'integer'
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
    public function tipoInstitucion()
    {
        return $this->belongsTo(\App\Models\TipoInstitucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function campus()
    {
        return $this->hasMany(\App\Models\Admin\Campus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosInstitucion()
    {
        return $this->hasMany(\App\Models\DocumentosInstitucion::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function alianza()
    {
        return $this->belongsToMany('\App\Models\Alianza','alianza_institucion','institucion_id','alianza_id');
    }
    
}
