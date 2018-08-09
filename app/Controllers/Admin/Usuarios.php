<?php

namespace app\Controllers\Adm;
use app\Models\Admin\Usuario;
use app\Views\View;

class Usuarios{

    public function __construct(){

    }

    public function index(){

        $View = new View();
        $Usuario = new Usuario();
       
        return $View->render('Admin/Usuarios/index.twig',[
            'usuarios' => $Usuario->all(),
            'pagina' => 'usuarios'
        ]);
    }

    public function novo($request){
        $View = new View();
        $Usuario = new Usuario();

        $post = $request->getParsedBody();
    
        $Usuario->create($post);

        $View->redirect('/admin/usuarios');

    }

    public function atualizar($request){

        $View = new View();
        $Usuario = new Usuario();
        $id = $request->getAttribute('id');
        $post = $request->getParsedBody();
    
        $Usuario->find($id)->fill($post)->save();

        $View->redirect('/admin/usuarios');
    }

    public function deletar($request){
        
        $View = new View();
        $Usuario = new Usuario();
        $id = $request->getAttribute('id');
    
        $Usuario->destroy($id);

        $View->redirect('/admin/usuarios');
    }

}