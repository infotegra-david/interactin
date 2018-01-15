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
        // return $this->hasMany(\App\Models\Matricula::class);
        return $this->belongsToMany('\App\Models\Matricula','matricula','user_id','programa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function campus()
    {
        return $this->belongsToMany('\App\Models\Admin\Campus','user_campus','user_id','campus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contacto()
    {
        return $this->belongsToMany('\App\User','user_contacto','user_id','contacto_id');
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

    public function pending($expression){
      $listTasksValidador = false;
      // get a collection of all defined roles
      $thisUser = auth()->user(); 
      $user_id = $thisUser->id;
      $roles = auth()->user()->getRoleNames()->toArray();
      $campus_id = session('campusApp');
      if ($campus_id === null || $campus_id == 0 ) {
        if (isset($thisUser->campus)) {
          $campus_id = $thisUser->campus->first()->id;
        }else{
          return false;
        }
      }
      
        switch ($expression) {
            case 'mis_alianzas':

                if ( in_array('validador', $roles) !== false ) {
                    $listTasksValidador = $this->listTasksValidador($user_id,'validador',$expression,$campus_id);
                    // return $listTasksValidador;
                }
                if ($listTasksValidador === false ) {
                  if ( in_array('coordinador_interno', $roles) !== false || in_array('coordinador_externo', $roles) !== false ) {
                    $listTasksValidador = $this->listTasksValidador($user_id,'coordinador',$expression,$campus_id);
                    // return $listTasksValidador;
                  }
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
    protected function listTasksValidador($user_id,$role,$expression,$campus_id)
    {
        switch ($expression) {
            case 'mis_alianzas':
                if ($role == 'validador') {
                  
                    $puedeValidar = \App\Models\Validation\UserPaso::join('tipo_paso','user_tipo_paso.tipo_paso_id','tipo_paso.id')
                        ->where([['user_tipo_paso.user_id',$user_id],['user_tipo_paso.campus_id',$campus_id],['tipo_paso.nombre','like','%_interalliance']])->count();

                    if ($puedeValidar == 0) {
                      return false;
                    }
                    
                    //lista de alianzas donde:
                        //el usuario hubiera rechazado o no este aprobado/activa por el usuario
                          //no hubiera aprobado aun
                        //no hubieran declinado ni este activa

                    //obtiene la lista de todos los estados
                    $estadosData = \App\Models\Estado::select('id','uso','nombre')->get()->toArray();

                    //separa solo el estado DECLINADO
                    $estadoDeclinadoData = array_filter($estadosData, function($var){
                        return ($var['uso'] == 'EXTERNAL' && $var['nombre'] == 'DECLINADO');
                    });
                    $estadoDeclinadoId = array_column($estadoDeclinadoData, 'id');

                    //separa solo los estados APROBADO
                    $estadosAprobadosData = array_filter($estadosData, function($var){
                        return ($var['nombre'] == 'APROBADO');
                    });
                    $estadosAprobadosId = array_column($estadosAprobadosData, 'id');

                    //separa solo los estados que no se permiten (DECLINADO y ACTIVA)
                    $estadosNoPermitidos = array_filter($estadosData, function($var){
                        //HAY DOS ESTADOS ACTIVA PERO NO IMPORTA EN ESTE CASO
                        return (in_array($var['nombre'], ['DECLINADO','ACTIVA']) );
                    });
                    $estadosNoPermitidosId = array_column($estadosNoPermitidos, 'id');

                    
                    // $estadosNoPermitidosId = \App\Models\Estado::whereIn('nombre',['DECLINADO','ACTIVA'])->pluck('id');

                    // $filtroAlianzaId = \App\Models\Validation\PasosAlianza::select('alianza_id')
                    //     ->where('user_id',$user_id)
                    //     ->whereIn('estado_id',$estadosNoPermitidosId)
                    //     ->pluck('alianza_id');

                    $filtroAlianzaId = \App\Models\Validation\PasosAlianza::select('alianza_id')
                        ->whereIn('estado_id',$estadosNoPermitidosId)
                        ->orWhereRaw('user_id = '. $user_id .' AND estado_id IN ('. implode(",",$estadosAprobadosId) .')')
                        ->groupBy('alianza_id');

                    // echo $filtroAlianzaId->toSql();
                    // print_r($filtroAlianzaId->getBindings());

                    $filtroAlianzaId = $filtroAlianzaId->pluck('alianza_id');


                      // $alianzasPendientesNuevas = \App\Models\Alianza::whereNotIn('id',function ($query) use ($user_id,$estadosPermitidosId) {
                      //         $query->select('alianza_id')
                      //               ->from('pasos_alianza')
                      //               ->where('user_id',$user_id)
                      //               ->whereIn('estado_id',$estadosPermitidosId);
                      //     })

                    //cuenta las que faltan por validar
                    $alianzasPendientesNuevas = \App\Models\Alianza::whereNotIn('id',$filtroAlianzaId)
                        ->whereNotIn('estado_id',$estadosNoPermitidosId)
                        ->get()->toArray();
                        // ->count();
                    

                }elseif ($role == 'coordinador') {
                    $estadoActiva = \App\Models\Estado::where([['uso','PROCESS'],['nombre','ACTIVA']])->first();
                    //cuenta las que faltan por validar
                    $alianzasPendientesNuevas = \App\Models\Alianza::join('alianza_user','alianza.id','alianza_user.alianza_id')
                        ->where('alianza_user.user_id',$user_id)
                        ->where('alianza.estado_id','<>',$estadoActiva->id)
                        ->count();
                        //->get()->toArray();

                }
                    // print_r($alianzasPendientesNuevas);

                    if (!is_int($alianzasPendientesNuevas)) {
                      $alianzasPendientesNuevas = count($alianzasPendientesNuevas);
                    }
                    @session_start();

                    if ( $alianzasPendientesNuevas > 0 ) {

                        session(['mis_alianzas' => $alianzasPendientesNuevas]);

                        //para que funcione el menu de la parte de las paginas en html
                        $_SESSION["mis_alianzas"] = session('mis_alianzas');

                        
                        return session('mis_alianzas');
                    }else{
                      
                        session(['mis_alianzas' => null]);
                        return false;
                    }
                    

                break;
            
            default:
                return false;
                break;
        }
    }
}
