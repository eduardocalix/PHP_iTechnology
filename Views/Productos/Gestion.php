<h1>Gestion de productos</h1>
<?php if (isset($_SESSION['RegisterProductos']) && $_SESSION['RegisterProductos'] == 'Complete'): ?>
    <strong class="Alertas AlertasExito">El producto se ha registrado</strong></br>
<?php endif; ?>
<?php Utils::DeleteSession('RegisterProductos') ?>
<a href="<?= BaseUrl ?>Productos/Crear" class="Boton Boton-Small BotonGreen" >Crear Productos</a>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while ($Producto = $Pro->fetch_object()): ?>
        <tr>
            <td><?= $Producto->Id ?></td>
            <td><?= $Producto->Nombre ?></td>
            <td>$ <?= $Producto->Precio ?></td>
            <td><?= $Producto->Stock ?></td>
            <td>
                <a href="<?= BaseUrl ?>Productos/Editar&Id=<?= $Producto->Id ?>" class="Boton Boton-Small BotonYellow BotonAcciones">Editar</a>
                <a href="<?= BaseUrl ?>Productos/Eliminar&Id=<?= $Producto->Id ?>" class="Boton Boton-Small BotonRojo BotonAcciones">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
