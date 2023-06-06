<?php 
include __DIR__ . "/base-sup.php";
?>

<div class="titulo-proyecto">
    <h2>
        Tareas de <?php echo $nombreProyecto ?>
    </h2>
</div>

<form action="" class="form-proyecto">
    <button>Agregar Nueva Tarea</button>
</form>

<ul class="lista-tareas">
    <?php foreach($tareas as $tarea): ?>
        <li>
            <p>
                <?php echo $tarea->tarea ?>
            </p>
            <div>
                <?php 
                    echo $tarea->estado == 0 
                    ?   "<button class='noHecha'>no hecha</button>" 
                    :   "<button class='hecha'>hecha</button>"
                ?>
                <button class="eliminar">eliminar</button>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php 
include __DIR__ . "/base-inf.php"
?>