<?php 

namespace Model;

class Usuarios extends Principal{
    protected static $tabla = 'Usuarios';
    protected static $columnasDB = ["id" , "nombre" , "email" , "password" , "token" , "confirmado"];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $token;
    public $confirmado;

    public function __construct($initial = []){
        $this->id = $initial["id"] ?? null;
        $this->nombre = $initial["nombre"] ?? "";
        $this->email = $initial["email"] ?? "";
        $this->password = $initial["password"] ?? null;
        $this->token = $initial["token"] ?? null;
        $this->confirmado = $initial["confirmado"] ?? null;
    }
}