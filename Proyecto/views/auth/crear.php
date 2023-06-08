<?php 

$subTitulo = "Crear Usuario";

$nombre = s($usuario->nombre);
$email = s($usuario->email);

$formulario = "
<form method='POST'>
    <label for='nombre'>Nombre</label>
    <input value='{$nombre}' type='text' name='nombre'>
    <label for='email'>Correo Electronico</label>
    <input value='{$email}' type='email' name='email'>
    <label for='password'>Password</label>
    <input type='password' name='password'>
    <label for='password-validation'>Confirme Password</label>
    <input type='password' name='passwordValidation'>
    <input type='submit' value='Crear Cuenta'>
</form>
";

$links = "
<a href='/'>Iniciar sesion</a>
<a href='/auth/olvide/correo'>Olvide la contraseña</a>
";

include __DIR__ . "/base.php"

?>