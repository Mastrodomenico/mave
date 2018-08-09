<?php

namespace app\Views;
use Twig_Function;
use function var_dump;
use Zend\Diactoros\Response;


class View{

	public $TwigEnvironment;

	public function __construct(){
		$loader = new \Twig_Loader_Filesystem(__DIR__.'/Templates');
		$this->TwigEnvironment = new \Twig_Environment($loader);
        $flash = new Twig_Function('flash_alert', function ($index) {
            $bodyAlert = '';
            if(!empty($_SESSION['flash'][$index])) {
                $bodyAlert = '
                    <div class="alert alert-' . $_SESSION['flash'][$index]['type'] . '">
                    ' . $_SESSION['flash'][$index]['message'] . '
                    </div>
                ';
            }
            echo $bodyAlert;
            unset($_SESSION['flash'][$index]);
        });
        $flashsweetalert = new Twig_Function('flashsweetalert', function ($index) {
            $body = '';
            if(!empty($_SESSION['flash'][$index])) {
                $body = "
                    swal({
                        title : '".$_SESSION['flash'][$index]['titulo']."',
                        text : '".$_SESSION['flash'][$index]['texto']."',
                        confirmButtonText: '".$_SESSION['flash'][$index]['botao']."',
                        type: '".$_SESSION['flash'][$index]['type']."',
                    }); 
                ";
            }
            echo $body;
            unset($_SESSION['flash']);
        });
        $dump = new Twig_Function('dump', function ($var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        });

        $urlEncode = new Twig_Function('urlencode', function ($var) {
            echo urlencode($var);
        });

        $this->TwigEnvironment->addFunction($flash);
        $this->TwigEnvironment->addFunction($flashsweetalert);
        $this->TwigEnvironment->addFunction($dump);
        $this->TwigEnvironment->addFunction($urlEncode);
	}

	public function render($template,$context){
	    $context['config'] = CONFIG;
        $context['session'] = $this->getSession();
	    $result = $this->TwigEnvironment->render($template,$context);
		$response = new Response();
		$response->getBody()->write($result);
		return $response;
	}

	public function redirect($uri){
		header('Location:'.$uri);
	}

	public function response(){
        $response = new Response();
        return $response;
    }

    public function getSession(){
	    if(isset($_SESSION)){
	        return $_SESSION;
        }
        return false;
    }

}