<?php 

namespace Controllers;

use MVC\Router;
use Model\Proyectos;
use Model\Usuarios;
use Model\Tareas;

class SesionControllers{

    public static function index(Router $router){
        $router->render("sesion/index" , []);
    }

    public static function close(Router $router){
    }

    public static function proyectos(Router $router){
        $proyectos = Proyectos::all();

        $router->render("sesion/proyectos" , [
            "proyectos" => $proyectos
        ]);
    }

    public static function listado_proyectos(Router $router){
        session_start();

        $id_user = $_SESSION["id"] ?? 1;
        $id_proyecto = $_GET["id"] ?? 1;
        
        $nombreProyecto = Usuarios::find($id_user)->nombre;
        $tareas = Tareas::where("id_proyecto" , $id_proyecto);

        $router->render("sesion/listado" , [
            "nombreProyecto" => $nombreProyecto,
            "tareas" => $tareas
        ]);
    }
}