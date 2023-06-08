<?php 

$subTitulo = "Recuperar Contraseña";

$formulario = "
<form method='POST'>
    <label for='password'>Password</label>
    <input type='password' name='password'>
    <label for='passwordvalidation'>Confirme Password</label>
    <input type='password' name='passwordvalidation'>
    <input type='submit' value='Validar Nueva Contraseña'>
</form>
";

$links = "
<a href='/'>Iniciar sesion</a>
<a href='/auth/crear'>Crear cuenta</a>
";

include __DIR__ . "/base.php"

?>