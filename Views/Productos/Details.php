<?php if ($Product = $Pro->fetch_object()): ?>
    <h1><?= $Product->Nombre ?></h1>
    <div class="ProductDetail">
        <?php if($Product->Image!=null):?>
        <img src="<?=BaseUrl?>Uploads/Images/<?=$Product->Image?>"/>
        <?php else:?>
        <img src="<?=BaseUrl?>assets/img/camiseta.png"/>
        <?php endif;?>
        <div class="DetailsData">
            <p class="Desc"><?=$Product->Descripcion?></p>
            <p class="Precio"><?= $Product->Precio ?> $</p>
            <a href="<?=BaseUrl?>Carrito/Add&Id=<?=$Product->Id?>" class="Boton">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El Producto No Existe</h1>
<?php endif; ?>

