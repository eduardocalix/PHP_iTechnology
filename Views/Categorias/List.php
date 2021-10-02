<?php if (isset($Cat) && $Categorias = $Cat->fetch_object()): ?>
    <h1><?= $Categorias->Nombre ?></h1>
    <?php if ($Pro->num_rows>0): ?>
        <?php require_once 'Views/Productos/List.php'; ?>
    <?php else: ?>
        <h1>No ha productos por mostrar</h1>
    <?php endif; ?>
<?php else: ?>
    <h1>La categoria que buscas no existe</h1>
<?php endif; ?>


