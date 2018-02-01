<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Parentesco
 * @package App\Models
 * @version February 1, 2018, 4:48 pm -05
 *
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string nombre
 */
class Parentesco extends Model
{
    use SoftDeletes;

    public $table = 'parentesco';
    
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

    
}
