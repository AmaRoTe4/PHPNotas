<main class="content-index-auth">
    <div>
        <h1>PHP Notas</h1>
        <h3><?php echo $subTitulo ?></h3>
        <?php foreach($errores as $error): ?>
            <p><?php echo s($error) ?></p>
        <?php endforeach;?>
    </div>
    <?php echo $formulario ?>
    <section>
        <?php echo $links ?>
    </section>
</main>