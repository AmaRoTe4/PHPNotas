<?php 

namespace Controllers;

use MVC\Router;
use Model\Proyectos;
use Model\Usuarios;
use Model\Tareas;

class SesionControllers{

    public static function index(Router $router){
        session_start();
        isAuth();
        
        $router->render("sesion/index" , [
            "nombre" => $_SESSION["nombre"]
        ]);
    }

    public static function close(){
        session_start();
        isAuth();
        $_SESSION = [];
        header("Location: /?action=1");
    }

    public static function proyectos(Router $router){
        session_start();
        isAuth();

        $router->render("sesion/proyectos");
    }

    public static function listado_proyectos(Router $router){
        session_start();
        isAuth();

        $id_user = $_SESSION["id"];
        $id_proyecto = $_GET["id"];

        if(is_null($id_user)) header("Location: /?action=101");
        else if(is_null($id_proyecto)) header("Location: /?action=51");

        $id_user_proyecto = Proyectos::where("id", $id_proyecto)[0]->id_user;
        if($id_user_proyecto != $id_user) header("Location: /?action=50");

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $action = $_GET["action"];

            if(isset($action)){
                $id_tarea = $_POST["id"];
                if($action == 1){
                    $tarea = Tareas::find($id_tarea);
                    $tarea->estado = boolval($tarea->estado) ? 0 : 1;
                    $tarea->guardar();
                }else{
                    $tarea = Tareas::find($id_tarea);
                    $tarea->eliminar();
                }
            }else{
                if($_POST["tarea"] == ""){
                    $errores[] = "El formulario no puede estar vacio";
                }else{
                    $proyecto = new Tareas($_POST);
                    $proyecto->id_proyecto = $id_proyecto;
                    $proyecto->estado = 0;
                    $proyecto->guardar();
                }
            }
        }

        $proyecto = Proyectos::find($id_proyecto);
        $tareas = Tareas::where("id_proyecto" , $id_proyecto);

        $router->render("sesion/listado" , [
            "proyecto" => $proyecto,
            "tareas" => $tareas
        ]);
    }
}