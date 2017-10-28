<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\DatosPersonales;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'genero' => 'required|integer',
            'cargo' => 'required|string|max:45',
            'telefono' => 'required|string|max:45',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = false;

        $datosPersonales = DatosPersonales::create([
            'nombres' => $data['firstname'],
            'apellidos' => $data['lastname'],
            'genero' => $data['genero'],
            'cargo' => $data['cargo'],
            'telefono' => $data['telefono'],
        ]);

        if ($datosPersonales) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'datos_personales_id' => $datosPersonales->id,
                'password' => bcrypt($data['password']),
                'activo' => 1,
            ]);

            if ($user) {
                $campus = \App\Models\Admin\Campus::where('institucion_id',\Config::get('options.institucion_id'))->first();
                $user->campus()->sync($campus->id);

                $user->assignRole('particular');
            }
            
        }


        return $user;
    }

}
