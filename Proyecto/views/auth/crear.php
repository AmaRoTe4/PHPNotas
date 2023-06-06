<?php 

$subTitulo = "Crear Usuario";

$formulario = "
<form method='POST'>
    <label for='nombre'>Nombre</label>
    <input type='text' name='nombre'>
    <label for='email'>Correo Electronico</label>
    <input type='email' name='email'>
    <label for='password'>Password</label>
    <input type='password' name='password'>
    <label for='password-validation'>Confirme Password</label>
    <input type='password' name='password-validation'>
    <input type='submit' value='Crear Cuenta'>
</form>
";

$links = "
<a href='/'>Iniciar sesion</a>
<a href='/auth/olvide/correo'>Olvide la contraseña</a>
";

include __DIR__ . "/base.php"

?>