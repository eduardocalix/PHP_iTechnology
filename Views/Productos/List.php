<?php while ($Producto = $Pro->fetch_object()): ?>
<?php if($Producto->Stock>=1):?>
    <div class="Product">
        <a href="<?=BaseUrl?>Productos/Details&Id=<?=$Producto->Id?>">
            <?php if ($Producto->Image != null): ?>
                <img src="<?= BaseUrl ?>Uploads/Images/<?= $Producto->Image ?>"/>
            <?php else: ?>
                <img src="<?= BaseUrl ?>assets/img/camiseta.png"/>
            <?php endif; ?>
            <h2><?=$Producto->Nombre?></h2>
        </a>
        <p><?= $Producto->Precio ?> Euros</p>
        <a href="<?=BaseUrl?>Carrito/Add&Id=<?=$Producto->Id?>" class="Boton">Comprar</a>
    </div>
<?php endif;?>
<?php endwhile; ?>
