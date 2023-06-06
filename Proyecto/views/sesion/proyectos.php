<?php 
include __DIR__ . "/base-sup.php";
?>

<div class="titulo-proyecto">
    <h2>
        Proyectos
    </h2>
</div>

<form action="" class="form-proyecto">
    <button>Agregar Nueva Proyecto</button>
</form>

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
include __DIR__ . "/base-inf.php"
?>