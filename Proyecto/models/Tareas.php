<?php 

namespace Model;

class Tareas extends Principal{
    protected static $tabla = 'Tareas';
    protected static $columnasDB = ["id" , "tarea" , "estado" , "id_proyecto"];

    public $id;
    public $tarea;
    public $estado;
    public $id_proyecto;

    public function __construct($initial = []){
        $this->id = $initial["id"] ?? null;
        $this->tarea = $initial["tarea"] ?? "";
        $this->estado = $initial["estado"] ?? 0;
        $this->id_proyecto = $initial["id_proyecto"] ?? null;
    }
}