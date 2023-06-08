<?php 
include __DIR__ . "/base-sup.php";
?>

<div class="titulo-proyecto">
    <h2>
        <?php echo s($proyecto->nombre) ?>
    </h2>
</div>

<form class="form-proyecto">
    <input type="hidden" id="id_general" name="id" value="<?php echo $proyecto->id ?>">            
    <button id="btnAgregarTarea">Agregar Nueva Tarea</button>
</form>

<ul class="lista-tareas">
    <?php foreach($tareas as $tarea): ?>
        <li>
            <p>
                <?php echo s($tarea->tarea) ?>
            </p>
            <form action="/sesion/proyectos/listado?id=<?php echo $proyecto->id ?>&action=1" method="POST">
                <input type="hidden" name="id" value="<?php echo $tarea->id ?>">
                <?php 
                    echo $tarea->estado == 0 
                    ?   "<input type='submit' id='btnEstado' class='noHecha' value='no hecha'/>" 
                    :   "<input type='submit' id='btnEstado' class='hecha' value='hecha'/>"
                ?>
            </form>
            <form action="/sesion/proyectos/listado?id=<?php echo $proyecto->id ?>&action=2" method="POST">
                <input type="hidden" name="id" value="<?php echo $tarea->id ?>">
                <input type='submit' id='btnEliminar' class="eliminar" value="eliminar" />
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php 
include __DIR__ . "/base-inf.php";
$script = "<script src='/build/js/tarea.js'></script>"
?>