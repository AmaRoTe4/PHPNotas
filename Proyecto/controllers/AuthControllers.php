<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuarios;
use General\Email;

class AuthControllers{

    public static function index(Router $router){
        $usuario = new Usuarios;
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $usuario = Usuarios::where("email" , $email)[0];

            if(!$usuario) $errores[] = "El email no esta registrado";
            else{
                $errores = $usuario->verificarPassword($password);
                if($usuario->confirmado == 0) $errores[] = "El usuario no esta validado";
                if(!isset($errores)){
                    session_start();
                    $_SESSION["id"] = $usuario->id;
                    $_SESSION["login"] = true;
                    $_SESSION["nombre"] = $usuario->nombre;
                    $_SESSION["email"] = $usuario->email;

                    header("Location: /sesion");
                }
            }
        }
        
        $router->render("auth/index" , [
            "errores" => $errores,
            "usuario" => $usuario,
        ]);
    }

    public static function crear(Router $router){
        $usuario = new Usuarios;
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = new Usuarios($_POST);
            $passwordValidation = $_POST["passwordValidation"];

            $errores = $usuario->validarCreacion();

            if(empty($errores)){
                if($usuario->password == $passwordValidation){
                    $usuario->encriptarPassword();
                    $usuario->crearToken();
                    $usuario->confirmado = 0;

                    $email = new Email;
                    $email->mensaje = "Este es el link para confirmar tu cuenta: <a href='http://localhost:3000/auth/confirmar?token={$usuario->token}'>Link</a>";
                    $email->destino = $usuario->email;
                    $email->subject = "confirmacion de cuenta";

                    $email->enviarEmail();
                    $usuario->guardar();

                    header("Location: /");
                }else $errores[] = "Los password debe ser iguales";
            }                
        }

        $router->render("auth/crear" , [
            "errores" => $errores,
            "usuario" => $usuario,
        ]);
    }

    public static function olvide_correo(Router $router){
        $errores = [];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];

            $usuario = Usuarios::where("email" , $email)[0];

            if(isset($usuario)){
                $usuario->crearToken();
                $usuario->guardar();

                $email = new Email;
                $email->mensaje = "Este es el link para confirmar el cambio de tu password: <a href='http://localhost:3000//auth/olvide/password?token={$usuario->token}'>Link</a>";
                $email->destino = $usuario->email;
                $email->subject = "cambio de password";
                
                $email->enviarEmail();
                header("Location: /?action=20");
            }else $errores[] = "El correo no esta resgistrado";
        }

        $router->render("auth/olvide_correo" , [
            "errores" => $errores,
        ]);
    }

    public static function olvide_password(Router $router){
        $token = $_GET["token"];
        $usuario = new Usuarios;
        $usuario = $usuario::where("token" , $token)[0];
        $errores = [];

        if(!isset($usuario)) header("Location: /?action=100");
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $passwordvalidation = $_POST["passwordvalidation"];
            $password = $_POST["password"];

            if($password == "") $errores[] = "El password es obligatorio";
            else if(strlen($password) < 6) $errores[] = "El password tiene que tener como minimo 6 caracteres";
            else if($password != $passwordvalidation) $errores[] = "Los passwords ingresados no son iguales";
            else{
                $usuario->password = $password;
                $usuario->encriptarPassword();
                $usuario->token = "";
                $usuario->confirmado = 1;
                $usuario->guardar();
                header("Location: /?action=21");
            }
        }

        $router->render("auth/olvide_password" , [
            "errores" => $errores,
        ]);
    }

    public static function crear_confirmar(){
        $token = $_GET["token"];
        $usuario = new Usuarios;
        $usuario = $usuario::where("token" , $token)[0];
        
        if(isset($usuario)){
            $usuario->token = "";
            $usuario->confirmado = 1;
            $usuario->guardar();
            header("Location: /?action=11");
        }else header("Location: /?action=100");
    }
}