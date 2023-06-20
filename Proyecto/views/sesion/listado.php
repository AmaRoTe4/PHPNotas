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

<ul id="lista-tareas" class="lista-tareas">
    <!-- aca van las tareas -->
</ul>

<?php 
include __DIR__ . "/base-inf.php";
$script = "<script src='/build/js/tarea.js'></script>"
?>