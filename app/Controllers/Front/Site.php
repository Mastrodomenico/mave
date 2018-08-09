<?php

namespace app\Controllers\Front;
use app\Views\View;

class Site{

    public function index(){
        $View = new View();
        return $View->render('Front/site.twig',[]);
    }

}