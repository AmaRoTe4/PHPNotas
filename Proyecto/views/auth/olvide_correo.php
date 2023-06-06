<?php 

$subTitulo = "Recuperar Contraseña";

$formulario = "
<form method='POST'>
    <label for='email'>Correo Electronico</label>
    <input type='email' name='email'>
    <input type='submit' value='Validar Correo'>
</form>
";

$links = "
<a href='/'>Iniciar sesion</a>
<a href='/auth/crear'>Crear cuenta</a>
";

include __DIR__ . "/base.php"

?>