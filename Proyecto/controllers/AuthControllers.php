<?php 

namespace Controllers;

use MVC\Router;

class AuthControllers{

    public static function index(Router $router){
        $router->render("auth/index" , []);
    }

    public static function crear(Router $router){
        $router->render("auth/crear" , []);
    }

    public static function olvide_correo(Router $router){
        $router->render("auth/olvide_correo" , []);
    }

    public static function olvide_password(Router $router){
        $router->render("auth/olvide_password" , []);
    }

    public static function olvide_confiramr(){

    }

    public static function crear_confiramr(){

    }
}