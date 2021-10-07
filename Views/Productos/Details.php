<?php if ($Product = sqlsrv_fetch_arrayy($Pro)): ?>
    <h1><?= $Product['descripcion'] ?></h1>
    <div class="ProductDetail">
        <?php if($Product['imagen']!=null):?>
        <img src="<?=BaseUrl?>Uploads/Images/<?=$Product['imagen']?>"/>
        <?php else:?>
        <img src="<?=BaseUrl?>assets/img/camiseta.png"/>
        <?php endif;?>
        <div class="DetailsData">
            <p class="Desc"><?=$Product['descripcion']?></p>
            <p class="Precio"><?= $Product['precioVenta'] ?> $</p>
            <a href="<?=BaseUrl?>Carrito/Add&Id=<?=$Product['idProducto']?>" class="Boton">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El Producto No Existe</h1>
<?php endif; ?>

