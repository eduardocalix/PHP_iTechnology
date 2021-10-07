<h1>Gestion de productos</h1>
<?php if (isset($_SESSION['RegisterProductos']) && $_SESSION['RegisterProductos'] == 'Complete'): ?>
    <strong class="Alertas AlertasExito">El producto se ha registrado</strong></br>
<?php endif; ?>
<?php Utils::DeleteSession('RegisterProductos') ?>
<a href="<?= BaseUrl ?>Productos/Crear" class="Boton Boton-Small BotonGreen" >Crear Productos</a>
<table>
    <tr>
        <th>Id</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while ($Producto = sqlsrv_fetch_array($Pro)): ?>
        <tr>
            <td><?= $Producto['idProducto']?></td>
            <td><?= $Producto['descripcion'] ?></td>
            <td>L. <?= $Producto['precioVenta'] ?></td>
            <td><?= $Producto['stock'] ?></td>
            <td>
                <a href="<?= BaseUrl ?>Productos/Editar&Id=<?= $Producto['idProducto']?>" class="Boton Boton-Small BotonYellow BotonAcciones">Editar</a>
                <a href="<?= BaseUrl ?>Productos/Eliminar&Id=<?= $Producto['idProducto'] ?>" class="Boton Boton-Small BotonRojo BotonAcciones">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
