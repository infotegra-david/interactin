<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable, SoftDeletes;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function alianza()
    {
        return $this->belongsToMany('\App\Models\Alianza','alianza_user','user_id','alianza_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function datos_personales()
    {
        return $this->belongsTo(\App\Models\DatosPersonales::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function matricula()
    {
        return $this->hasMany(\App\Models\Matricula::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function campus()
    {
        return $this->belongsToMany('\App\Models\Admin\Campus','user_campus','user_id','campus_id');
    }
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosAlianzas()
    {
        return $this->hasMany(\App\Models\Validation\PasosAlianza::class);
    }
    /*
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    */

    public function todo($expression){
        switch ($expression) {
            case 'mis_alianzas':
                if (auth()->user()->hasRole('validador')) {
                    return $this->listTasksValidador(auth()->user()->id,$expression);
                }

                break;
            
            default:
                return false;
                break;
        }
    }

    /**
     * Checks if the given string looks like a fully qualified class name.
     *
     * @param  string  $value
     * @return bool
     */
    protected function listTasksValidador($user_id,$expression)
    {
        switch ($expression) {
            case 'mis_alianzas':
                $puedeValidar = \App\Models\Validation\UserPaso::join('tipo_paso','user_tipo_paso.tipo_paso_id','tipo_paso.id')
                    ->where([['user_tipo_paso.user_id',$user_id],['tipo_paso.nombre','like','%_alianza']])->count();

                if ($puedeValidar > 0) {
                    //cuenta las que faltan por validar
                    
                    $estadosPermitidosId = \App\Models\Estado::whereIn('nombre',['APROBADO','RECHAZADO','ACTIVA'])->pluck('id');
                    $alianzasPendientesNuevas = \App\Models\Alianza::whereNotIn('id',function ($query) use ($user_id,$estadosPermitidosId) {
                            $query->select('alianza_id')
                                  ->from('pasos_alianza')
                                  ->where('user_id',$user_id)
                                  ->whereIn('estado_id',$estadosPermitidosId);
                        })
                        ->get()->toArray();

                    if (count($alianzasPendientesNuevas)) {
                        session(['mis_alianzas' => count($alianzasPendientesNuevas)]);
                        // return session('mis_alianzas');
                        return $alianzasPendientesNuevas;
                    }else{
                        $forget = session::forget('mis_alianzas');
                        return false;
                    }
                    
                }

                break;
            
            default:
                return false;
                break;
        }
    }
}
