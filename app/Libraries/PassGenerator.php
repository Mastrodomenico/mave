<?php

namespace app\Libraries;

class PassGenerator{

    public function generator($tamanho){
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
       
        $senha .= str_shuffle($mi);
        $senha .= str_shuffle($nu);

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
      }
}