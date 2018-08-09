<?php

namespace app\Libraries;

class StringTo{
	public static function URL($string){
        $string = str_replace(' ','-',$string);
        $string = str_replace('.','',$string);
        $string = str_replace(',','',$string);
        $string = str_replace('?','',$string);
        $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(Ç|ç)/"),explode(" ","a A e E i I o O u U n N c"),$string);
        $string = strtolower($string);
        return $string;        
    }	
}
