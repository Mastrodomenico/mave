<?php

use Aura\Router\RouterContainer;
use Zend\Diactoros\ServerRequestFactory;
use Illuminate\Database\Capsule\Manager as Eloquent;
use app\Controllers\Controller;
use app\Routes;

/*
Importando configurações
*/
$config = require('Config.php');
define('CONFIG',$config['development']);
date_default_timezone_set('America/Sao_Paulo');
session_start();

/*
Configurando o Eloquent como ORM
*/
$Eloquent = new Eloquent();
$Eloquent->addConnection(CONFIG['database']);
$Eloquent->bootEloquent();
$Eloquent->setAsGlobal();

/*
Criando um servior de Request para as rotas
*/
$Routes = new Routes;
$Routes->request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);
$Routes->RouterContainer = new RouterContainer();
$Routes->Controller = new Controller(CONFIG['controller']);

/*
Regirstrando rotas do módulo Sistema
*/
$Routes->registerRoute(require('Controllers/API/Routes.php'));
$Routes->registerRoute(require('Controllers/Admin/Routes.php'));
$Routes->registerRoute(require('Controllers/Front/Routes.php'));

/*
Bootstrap
*/
$Routes->go();

