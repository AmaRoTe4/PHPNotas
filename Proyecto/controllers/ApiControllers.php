<?php 

namespace Controllers;

use Model\Proyectos;
use Model\Tareas;
use MVC\Router;

class ApiControllers{

    public static function pyts(){
        session_start();
        $id = $_GET["id"] ?? null;
        $usuario_id = $_SESSION["id"] ?? 1;
        $data = null;

        if($usuario_id){
            if($id){
                $newData = Proyectos::where("id" , $id)[0];
                if($newData->id_user == $usuario_id) $data = $newData; 
            }else{
                $data = Proyectos::where("id_user" , $usuario_id);
            }
        }

        echo json_encode($data);
    }

    public static function pyts_upd(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $id_proyecto = $_POST["id"] ?? null;
        $nombre = $_POST["nombre"];

        if($usuario_id && $id_proyecto && $nombre){
            $proyecto = Proyectos::where("id" , $id_proyecto)[0];
            
            if($proyecto->id_user != $usuario_id){
                echo "Accion denegada";
                return;
            }

            $proyecto->nombre = $nombre;
            $resultado = $proyecto->guardar();
            if(!$resultado){
                echo "Error al editar";
            }
            
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Editado con exito";
    }

    public static function pyts_crt(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $nombre = $_POST["nombre"];

        if($usuario_id && $nombre){
            $proyecto = new Proyectos;
            $proyecto->id_user = $usuario_id;
            $proyecto->nombre = $nombre;

            $resultado = $proyecto->guardar();
            if(!$resultado){
                echo "Error al crear";
            }
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Creado con exito";
    }

    public static function pyts_del(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $id_proyecto = $_POST["id"] ?? null;
        
        if($usuario_id && $id_proyecto){
            $proyecto = Proyectos::where("id" , $id_proyecto)[0];
            
            if($proyecto->id_user != $usuario_id){
                echo "Accion denegada";
                return;
            }
            
            $resultado = $proyecto->eliminar();
            if(!$resultado){
                echo "Error al eliminar";
            }
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Eliminado con exito";
    }

    public static function trs(){
        session_start();
        $id = $_GET["id"] ?? null;
        $id_proyecto = $_GET["proyecto"] ?? null;
        $usuario_id = $_SESSION["id"] ?? 1;
        $data = null;

        if($usuario_id){
            $proyecto = Proyectos::where("id" , $id_proyecto)[0];
            
            if($proyecto->id_user == $usuario_id){
                if($id){
                    $data = Tareas::where("id" , $id)[0]; 
                }else{
                    $data = Tareas::where("id_proyecto" , $id_proyecto);
                }
            }
        }

        echo json_encode($data);
    }

    public static function trs_upd(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $id_tarea = $_POST["id"] ?? null;
        $id_proyecto = $_POST["id_proyecto"] ?? null;
        $tarea_text = $_POST["tarea"];
        $estado = $_POST["estado"];

        if($usuario_id && $id_tarea && $estado && $id_proyecto){
            $proyecto = Proyectos::get($id_proyecto);

            if($proyecto->id_user != $usuario_id){
                echo "Accion denegada";
                return;
            }

            $tarea = Tareas::where("id", $id_tarea)[0];
            $tarea->estado = $estado;
            $tarea->tarea = $tarea_text == "" ? $tarea->tarea : $tarea_text ;
            $resultado = $tarea->guardar();

            if(!$resultado){
                echo "Error al editar";
            }
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Editado con exito";
    }

    public static function trs_crt(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $id_proyecto = $_POST["id_proyecto"] ?? null;
        $tarea_text = $_POST["tarea"];

        if($usuario_id && $tarea_text && $id_proyecto){
            $proyecto = Proyectos::get($id_proyecto);

            if($proyecto->id_user != $usuario_id){
                echo "Accion denegada";
                return;
            }

            $tarea = new Tareas;
            $tarea->estado = 0;
            $tarea->tarea = $tarea_text;
            $tarea->id_proyecto = $id_proyecto;
            $resultado = $tarea->guardar();

            if(!$resultado){
                echo "Error al editar";
            }
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Creado con exito";
    }

    public static function trs_del(){
        session_start();
        $usuario_id = $_SESSION["id"] ?? 1;
        $id_tarea = $_POST["id"] ?? null;
        
        if($usuario_id && $id_tarea){
            $tarea = Tareas::where("id" , $id_tarea)[0];
            $proyecto = Proyectos::get($tarea->id_proyecto);

            if($proyecto->id_user != $usuario_id){
                echo "Accion denegada";
                return;
            }

            $resultado = $tarea->eliminar();

            if(!$resultado){
                echo "Error al editar";
            }
        }else {
            echo "Accion denegada";
            return;
        }

        echo "Eliminado con exito";
    }

    public static function user(){
        session_start();
        $data = $_SESSION ?? null;
        
        echo json_encode($data);
    }

}