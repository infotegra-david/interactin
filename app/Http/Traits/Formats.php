<?php

namespace App\Http\Traits;
// use DB;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Storage;

use Flash;

trait Formats{
    

    
    /**
     * @param $df
     * @return mixed
     */

    public function get_format($df) {

        $str = '';
        $str .= ($df->invert == 1) ? ' - ' : '';
        if ($df->y > 0) {
            // years
            $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
        } 
        if ($df->m > 0) {
            // month
            $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
        } 
        if ($df->d > 0) {
            // days
            $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Día ';
        }else{
            $str .= ' 0 Días ';
        }
        // if ($df->h > 0) {
        //     // hours
        //     $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
        // } 
        // if ($df->i > 0) {
        //     // minutes
        //     $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
        // } 
        // if ($df->s > 0) {
        //     // seconds
        //     $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
        // }

        return $str;
    }
    
}

