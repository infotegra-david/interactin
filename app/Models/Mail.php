<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mail
 * @package App\Models
 * @version July 4, 2017, 3:47 pm COT
 */
class Mail extends Model
{
    use SoftDeletes;

    public $table = 'mail';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'to',
        'cc',
        'bcc',
        'replyto',
        'subject',
        'content',
        'estado',
        'tokenmail'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'to' => 'string',
        'cc' => 'string',
        'bcc' => 'string',
        'replyto' => 'string',
        'subject' => 'string',
        'content' => 'string',
        'estado' => 'integer',
        'tokenmail' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function archivo()
    {
        return $this->belongsToMany('\App\Models\Archivo','mail_archivo','mail_id','archivo_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function pasos_alianza()
    {
        return $this->belongsToMany('\App\Models\Validation\PasosAlianza','pasos_alianza_mail','mail_id','pasos_alianza_id');
    }
}
