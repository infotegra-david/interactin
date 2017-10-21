<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modalidades
 * @package App\Models
 * @version September 10, 2017, 6:49 pm COT
 *
 * @property string nombre
 */
class Modalidades extends Model
{
    use SoftDeletes;

    public $table = 'modalidades';
    
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function alianza()
    {
        return $this->belongsToMany(\App\Models\Alianza::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function alianzaModalidades()
    {
        return $this->hasMany(\App\Models\AlianzaModalidade::class);
    }
}
