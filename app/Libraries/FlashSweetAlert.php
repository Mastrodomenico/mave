<?php

namespace app\Libraries;


class FlashSweetAlert{

    public function __construct($index, $titulo, $texto, $botao, $type){
        $_SESSION['flash'][$index]['type'] = $type;
        $_SESSION['flash'][$index]['texto'] = $texto;
        $_SESSION['flash'][$index]['botao'] = $botao;
        $_SESSION['flash'][$index]['titulo'] = $titulo;
    }

}