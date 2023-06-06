<?php 

namespace Model;

class Proyectos extends Principal{
    protected static $tabla = 'Proyectos';
    protected static $columnasDB = ["id" , "nombre", "id_user"];

    public $id;
    public $nombre;
    public $id_user;

    public function __construct($initial = []){
        $this->id = $initial["id"] ?? null;
        $this->nombre = $initial["nombre"] ?? "";
        $this->id_user = $initial["id_user"] ?? null;
    }
}