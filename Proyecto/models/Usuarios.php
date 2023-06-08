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

    public function encriptarPassword(){
        $this->password = password_hash($this->password , PASSWORD_BCRYPT);
    }

    public function verificarPassword($pass):array{
        $errores = [];
        if(!password_verify($pass, $this->password)) $errores[] = "Contraseña incorrecta";
        return $errores;
    }

    public function validarCreacion():array{
        $patron = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
        $errores = [];
        
        if($this->nombre == "") $errores[] = "El campo nombre es obligatorio";
        else if(strlen($this->nombre) > 60) $errores[] = "El nombre no puede tener mas de 60 caracteres";
        if($this->email == "") $errores[] = "El campo email es obligatorio";
        else if(preg_match($patron, $this->email) == 0) $errores[] = "El email no tiene el formato correspondiente";
        else if($this->where("email" , $this->email)[0]->id) $errores[] = "El email ya esta logeado, use otro o inicie sesion con este";
        if($this->password == "") $errores[] = "El campo password es obligatorio";
        else if(strlen($this->password) < 6) $errores[] = "La contraseña tiene que tener mas de 6 caracteres";

        return $errores;
    }

    public function crearToken(){
        $this->token = uniqid();
    }
}