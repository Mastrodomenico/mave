<?php

namespace app\Libraries;


class Money{

    function toReal($valor,$cifrao = false){
        if($cifrao)
            return 'R$ '.number_format($valor,2,',','.');
        else
            return number_format($valor,2,',','.');
    }

}