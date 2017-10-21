<?php

namespace App;

use Log;
/*
 * A trait to handle authorization based on users permissions for given controller
 */

trait Authorizable
{
    /**
     * Abilities
     *
     * @var array
     */
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',        
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
        /*interalliance*/
        'map' => 'view',
        'subscribe' => 'add',
        'origin' => 'add',
        //'destination' => 'edit',
        'alliances' => 'view',
        /*localizacion*/
        'listStates' => 'view',
        'listCities' => 'view',
        /* metodo sendMail*/
        'sendMail' => 'add'
    ];

    /**
     * Override of callAction to perform the authorization before it calls the action
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if( $ability = $this->getAbility($method) ) {
            Log::info('Authorizable, 1 callAction (verificar permiso), Metodo: '. $method .' - ability: '. $ability );
            
            $this->authorize($ability);

        }
        Log::info('Authorizable, 2 callAction (permiso correcto), Metodo: '. $method .' - parametros: '. json_encode($parameters) );
        return parent::callAction($method, $parameters);
    }

    /**
     * Get ability
     *
     * @param $method
     * @return null|string
     */
    public function getAbility($method)
    {
        $routeName = explode('.', \Request::route()->getName());
        $action = array_get($this->getAbilities(), $method);

        $penultimaPosicion = count($routeName) > 1 ? count($routeName)-2 : 0;
        $return = $action ? $action . '_' . $routeName[ $penultimaPosicion ] : null;
        
        Log::info('Authorizable, getAbility (obtener permiso), Metodo: '. $method .' - Nombre de la ruta: '. json_encode($routeName) .' - Action: ' . $action .' - return: ' . $return .' - prueba routeName: ' . $routeName[$penultimaPosicion] );
        
        return $return;
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @param array $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}