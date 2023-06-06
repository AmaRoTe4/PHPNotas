<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthControllers;
use Controllers\SesionControllers;
$router = new Router();

//auth
$router->get("/" , [AuthControllers::class, "index"]);
$router->post("/" , [AuthControllers::class, "index"]);

$router->get("/auth/crear" , [AuthControllers::class, "crear"]);
$router->post("/auth/crear" , [AuthControllers::class, "crear"]);

$router->post("/auth/confirmar" , [AuthControllers::class, "crear_confirmar"]);

$router->get("/auth/olvide/correo" , [AuthControllers::class, "olvide_correo"]);
$router->post("/auth/olvide/correo" , [AuthControllers::class, "olvide_correo"]);

$router->post("/auth/olvide/confirmacion" , [AuthControllers::class, "olvide_confirmacion"]);

$router->get("/auth/olvide/password" , [AuthControllers::class, "olvide_password"]);
$router->post("/auth/olvide/password" , [AuthControllers::class, "olvide_password"]);


//sesion
$router->get("/sesion" , [SesionControllers::class, "index"]);

$router->post("/sesion/close" , [SesionControllers::class, "close"]);

$router->get("/sesion/proyectos" , [SesionControllers::class, "proyectos"]);
$router->post("/sesion/proyectos" , [SesionControllers::class, "proyectos"]);

$router->get("/sesion/proyectos/listado" , [SesionControllers::class, "listado_proyectos"]);
$router->post("/sesion/proyectos/listado" , [SesionControllers::class, "listado_proyectos"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();