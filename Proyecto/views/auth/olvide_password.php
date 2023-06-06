<?php 

$subTitulo = "Recuperar Contraseña";

$formulario = "
<form method='POST'>
    <label for='password'>Password</label>
    <input type='password' name='password'>
    <label for='password-validation'>Confirme Password</label>
    <input type='password' name='password-validation'>
    <input type='submit' value='Validar Nueva Contraseña'>
</form>
";

$links = "
<a href='/'>Iniciar sesion</a>
<a href='/auth/crear'>Crear cuenta</a>
";

include __DIR__ . "/base.php"

?>