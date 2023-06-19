<?php 
include __DIR__ . "/base-sup.php";
?>

<div id="titulo_proyecto" class="titulo-proyecto">
    <h2>
        Proyectos
    </h2>
</div>

<!-- aca esta los errores -->

<span action="" class="form-proyecto">
    <button id="btnAgregarProyecto">Agregar Nueva Proyecto</button>
</span>

<ul id="lista_proyectos" class="lista-proyecto">
    <!--aca adentro van todos los proyectos-->
</ul>

<?php 
include __DIR__ . "/base-inf.php";
$script = "<script src='/build/js/proyectos.js'></script>"
?>