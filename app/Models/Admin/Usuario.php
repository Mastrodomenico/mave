<?php

namespace app\Models\Admin;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Hashing\BcryptHasher;

class Usuario extends Eloquent{

    protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];


    public function setSenhaAttribute($value){
        $BcryptHasher = new BcryptHasher();
        $this->attributes['senha'] = $BcryptHasher->make($value);
    }

}