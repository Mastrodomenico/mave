<?php

namespace app\Controllers\API;
use app\Views\View;

class Ususarios{

    

    public function createUser($request){

        $PreAgentes = new PreAgentes();
        $Agentes = new Agentes();

        $fields = [
            'cpf',
            'nome',
            'email',
            'telefone'
        ];

        $post = $request->getParsedBody();

        if($Agentes->where('cpf',$post['cpf'])->count() > 0){
            return $this->response(false,"CPF já cadastrado",['']);
        }

        if($Agentes->where('email',$post['email'])->count() > 0){
            return $this->response(false,"Email já cadastrado",['']);
        }

        if($PreAgentes->where('cpf',$post['cpf'])->count() > 0){
            return $this->response(false,"CPF já cadastrado",['']);
        }

        if($PreAgentes->where('email',$post['email'])->count() > 0){
            return $this->response(false,"Email já cadastrado",['']);
        }

        if(!$this->verifyFields($fields, $post)['exist']){
            $field = $this->verifyFields($fields, $post)['field'];
            return $this->response(false,"necessario passar o $field",['']);
        }else{
            $PreAgentes->create($post);
            return $this->response(true,'usuario cadastrado',['usuario' => $user]);
        }

    }

    public function updateUser($request){

        $Agentes = new Agentes();
        $post = $request->getParsedBody();

        $fields = [
            'id'
        ];

        if(!$this->verifyFields($fields, $post)['exist']) {
            $field = $this->verifyFields($fields, $post)['field'];
            return $this->response(false, "necessario passar o $field", ['']);
        }else{
            if($Agentes->find($post['id'])){
                if($Agentes->find($post['id'])->update($post)){
                    return $this->response(true,'usuario atualizado',['usuario' => $Agentes->find($post['id'])]);
                }else{
                    return $this->response(false,'erro ao atualizar usuario',[]);
                }
            }else{
                return $this->response(false,'usuario nao existe',[]);
            }
        }
    }

   









    /*
     * Classes de apoio
     * */

    public function response(Bool $status, String $message, Array $data){
        $View = new View();

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        echo json_encode($response);

        return $View->response()
            ->withHeader('Content-Type', 'application/json;charset=utf-8');
    }

    public function verifyFields(Array $fields,Array $get){

        foreach($fields as $field){
            if(!array_key_exists($field,$get) || empty($get[$field])){
                return ['exist' => false,'field' => $field];
            }
        }

        return ['exist' => true];

    }


}