<?php while ($Producto = sqlsrv_fetch_array($Pro)){ ?>
    <div class="Product">
        <a href="<?=BaseUrl?>Productos/Details&Id=<?=$Producto['idProducto']?>">
            <?php if ($Producto['imagen'] != null): ?>
                <img src="<?= BaseUrl ?>Uploads/Images/<?=$Producto['imagen']?>"/>
            <?php else: ?>
                <img src="<?= BaseUrl ?>assets/img/konoha.jpg"/>
            <?php endif; ?>
            <h2><?=$Producto['descripcion']?></h2>
        </a>
        <p>L.  <?=$Producto['precioVenta']?></p>
        <a href="<?=BaseUrl?>Carrito/Add&Id=<?=$Producto['idProducto']?>" class="Boton">Comprar</a>
    </div>
<?php }?>
