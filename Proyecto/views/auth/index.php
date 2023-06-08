<?php 

$subTitulo = "Iniciar Sesion";

$email = s($usuario->email);

$formulario = "
<form action='/' method='POST'>
    <label for='email'>Correo Electronico</label>
    <input value='{$email}' type='email' name='email'>
    <label for='password'>Password</label>
    <input type='password' name='password'>
    <input type='submit' value='Iniciar Sesion'>
</form>
";

$links = "
<a href='/auth/olvide/correo'>Olvide la contraseña</a>
<a href='/auth/crear'>Crear cuenta</a>
";

include __DIR__ . "/base.php"

?>