<?php

namespace app\Libraries;


class Flash{

    public function __construct($index,$type,$message){
        $_SESSION['flash'][$index]['type'] = $type;
        $_SESSION['flash'][$index]['message'] = $message;
    }

}