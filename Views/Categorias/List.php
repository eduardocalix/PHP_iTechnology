<?php if (isset($Cat) && $Categorias = sqlsrv_fetch_array($Cat)): ?>
    <h1><?= $Categorias['descripcion']?></h1>
    <?php if ($Pro['num_rows']>0): ?>
        <?php require_once 'Views/Productos/List.php'; ?>
    <?php else: ?>
        <h1>No ha productos por mostrar</h1>
    <?php endif; ?>
<?php else: ?>
    <h1>La categoria que buscas no existe</h1>
<?php endif; ?>


