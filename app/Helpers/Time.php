<?php

namespace app\Helpers;

class Time{

    public function ago($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'ano',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k && $k != 'm') {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            }

            elseif($diff->$k && $k == 'm'){
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'es' : '');
            }

            else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' atrás' : 'Agora mesmo';
    }


}