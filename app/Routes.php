<?php

namespace app;

use app\Views\System\Erros;

class Routes{

    public $request;
    public $RouterContainer;
    public $Controller;
    public $routeRegistries = [];


    public function routes($map,$Controller){

        foreach($this->routeRegistries as $routeRegistry){

            foreach($routeRegistry['controllers'] as $keyControllers => $controllers){


                foreach($controllers['routes'] as $keyRoutes => $routes){
                    $type = $routes['method'];
                    if(is_array($routes['route'])){
                        foreach ($routes['route'] as $route){
                            if(preg_match('/(\/)$/',$route) == 1){
                                $map->$type($keyRoutes.md5($route), $route, function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                    $Controller->module($routeRegistry['name']);
                                    $Controller->controller($keyControllers);
                                    $Controller->action($routes['action']);
                                    return $Controller->run($request);
                                });

                                $route = preg_replace('/(\/)$/','', $route);
                                $map->$type($keyRoutes.md5($route), $route, function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                    $Controller->module($routeRegistry['name']);
                                    $Controller->controller($keyControllers);
                                    $Controller->action($routes['action']);
                                    return $Controller->run($request);
                                });

                            }else{
                                $map->$type($keyRoutes.md5($route), $route, function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                    $Controller->module($routeRegistry['name']);
                                    $Controller->controller($keyControllers);
                                    $Controller->action($routes['action']);
                                    return $Controller->run($request);
                                });

                                $route = $route.'/';
                                $map->$type($keyRoutes.md5($route), $route, function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                    $Controller->module($routeRegistry['name']);
                                    $Controller->controller($keyControllers);
                                    $Controller->action($routes['action']);
                                    return $Controller->run($request);
                                });
                            }
                        }
                    }else{

                        if(preg_match('/(\/)$/',$routes['route']) == 1){
                            $map->$type($keyRoutes.md5($routes['route']), $routes['route'], function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                $Controller->module($routeRegistry['name']);
                                $Controller->controller($keyControllers);
                                $Controller->action($routes['action']);
                                return $Controller->run($request);
                            });

                            $routes['route'] = preg_replace('/(\/)$/','', $routes['route']);
                            $map->$type($keyRoutes.md5($routes['route']), $routes['route'], function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                $Controller->module($routeRegistry['name']);
                                $Controller->controller($keyControllers);
                                $Controller->action($routes['action']);
                                return $Controller->run($request);
                            });

                        }else{
                            $map->$type($keyRoutes.md5($routes['route']), $routes['route'], function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                $Controller->module($routeRegistry['name']);
                                $Controller->controller($keyControllers);
                                $Controller->action($routes['action']);
                                return $Controller->run($request);
                            });

                            $routes['route'] = $routes['route'].'/';
                            $map->$type($keyRoutes.md5($routes['route']), $routes['route'], function ($request) use ($Controller,$routeRegistry,$keyControllers,$routes){
                                $Controller->module($routeRegistry['name']);
                                $Controller->controller($keyControllers);
                                $Controller->action($routes['action']);
                                return $Controller->run($request);
                            });
                        }
                    }

                }
            }
        }



    }

    public function go(){

        $request = $this->request;
        $routerContainer = $this->RouterContainer;
        $map = $routerContainer->getMap();
        $this->routes($map,$this->Controller);

        $matcher = $routerContainer->getMatcher();

        $route = $matcher->match($request);
        if (! $route) {
            $Erros = new Erros();
            $Erros->telaazul("Página não encontrada");
            exit;
        }

        foreach ($route->attributes as $key => $val) {
            $request = $request->withAttribute($key, $val);
        }

        // dispatch the request to the route handler.
        // (consider using https://github.com/auraphp/Aura.Dispatcher
        // in place of the one callable below.)
        $callable = $route->handler;
        $response = $callable($request);

        // emit the response
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        echo $response->getBody();

    }

    public function registerRoute(Array $route){
        array_push($this->routeRegistries,$route);
    }


}

