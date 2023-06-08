<?php 
include __DIR__ . "/base-sup.php";
?>

<div class="titulo-proyecto">
    <h2>
        Proyectos
    </h2>
</div>

<?php foreach($errores as $error): ?>
    <h4 style="color: red"><?php echo $error ?></h4>
<?php endforeach; ?>

<span action="" class="form-proyecto">
    <button id="btnAgregarProyecto">Agregar Nueva Proyecto</button>
</span>

<ul class="lista-proyecto">
    <?php foreach($proyectos as $proyecto): ?>
        <li>
            <a href="/sesion/proyectos/listado?id=<?php echo $proyecto->id ?>">
                <?php echo $proyecto->nombre ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php 
include __DIR__ . "/base-inf.php";
$script = "<script src='/build/js/proyectos.js'></script>"
?>