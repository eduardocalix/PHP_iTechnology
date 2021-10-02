<?php if(isset($_SESSION['SinStock'])):?>
<h1>Stock No Suficiente</h1>
<?php foreach($_SESSION['SinStock'] as $Index=>$Elements):?>
<div class="ProductDetail">
        <?php if($Elements['Product']->Image!=null):?>
        <img src="<?=BaseUrl?>Uploads/Images/<?=$Elements['Product']->Image?>"/>
        <?php else:?>
        <img src="<?=BaseUrl?>assets/img/camiseta.png"/>
        <?php endif;?>
        <div class="DetailsData">
            <p class="Desc">Stock Real: <?=$Elements['Stock']?></p>
            <p class="Desc">Unidades Solicitadas: <?=$Elements['Unit'] ?></p>
        </div>
    </div>
<?php endforeach;?>
<a class="Boton Boton-Small" href="<?=BaseUrl?>Carrito/Index">Regresar al Carrito</a>
<?php endif; Utils::DeleteSession('SinStock')?>
