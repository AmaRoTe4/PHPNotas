<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthControllers;
use Controllers\SesionControllers;
use Controllers\ApiControllers;
$router = new Router();

//auth
$router->get("/" , [AuthControllers::class, "index"]);
$router->post("/" , [AuthControllers::class, "index"]);

$router->get("/auth/crear" , [AuthControllers::class, "crear"]);
$router->post("/auth/crear" , [AuthControllers::class, "crear"]);

$router->get("/auth/confirmar" , [AuthControllers::class, "crear_confirmar"]);

$router->get("/auth/olvide/correo" , [AuthControllers::class, "olvide_correo"]);
$router->post("/auth/olvide/correo" , [AuthControllers::class, "olvide_correo"]);

$router->get("/auth/olvide/password" , [AuthControllers::class, "olvide_password"]);
$router->post("/auth/olvide/password" , [AuthControllers::class, "olvide_password"]);


//sesion
$router->get("/sesion" , [SesionControllers::class, "index"]);

$router->get("/sesion/close" , [SesionControllers::class, "close"]);

$router->get("/sesion/proyectos" , [SesionControllers::class, "proyectos"]);
$router->post("/sesion/proyectos" , [SesionControllers::class, "proyectos"]);

$router->get("/sesion/proyectos/listado" , [SesionControllers::class, "listado_proyectos"]);
$router->post("/sesion/proyectos/listado" , [SesionControllers::class, "listado_proyectos"]);

//api
$router->get("/api/proyectos/data" ,   [ApiControllers::class, "pyts"]);
$router->post("/api/proyectos/update" , [ApiControllers::class, "pyts_upd"]);
$router->post("/api/proyectos/create" , [ApiControllers::class, "pyts_crt"]);
$router->post("/api/proyectos/delete" , [ApiControllers::class, "pyts_del"]);

$router->get("/api/tareas/data" ,            [ApiControllers::class, "trs"]);
$router->post("/api/tareas/update" ,    [ApiControllers::class, "trs_upd"]);
$router->post("/api/tareas/create" ,    [ApiControllers::class, "trs_crt"]);
$router->post("/api/tareas/delete" ,    [ApiControllers::class, "trs_del"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();