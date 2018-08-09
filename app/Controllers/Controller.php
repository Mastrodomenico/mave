<?php 

namespace app\Controllers;

use app\Views\System\Erros;

class Controller{

	public $basePath;
	public $module;
	public $controller;
	public $action;
	public $request;

	public function __construct($config){
        $this->basePath = $config['basePathControllers'];
    }

	public function run($request = null){


	    if(class_exists($this->basePath.$this->module.'\\'.'Broadcast')){
            $broad = $this->basePath.$this->module.'\\'.'Broadcast';
            new $broad;
        }

        $Erros = new Erros();

		$obj = $this->basePath.$this->module.'\\'.$this->controller;
		if(class_exists($obj)){
            $Controller = new $obj;
            $action = $this->action;
            if(method_exists($Controller,$action)){
                return $Controller->$action($request);
            }else{
                $Erros->telaazul('Método "'.$this->action.'()" não existe no controller "'.$this->controller.'"');
            }
        }else{
            $Erros->telaazul('Controller "'.$this->controller.'" não existe');
        }
        exit;
	}

	public function module($module){
		$this->module = $module;
	}

	public function controller($controller){
		$this->controller = $controller;
	}

	public function action($action){
		$this->action = $action;
	}






}
