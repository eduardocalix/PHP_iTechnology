<?php if(isset($_SESSION['AddPedido']) && $_SESSION['AddPedido']):?>
<h1>Tu pedido se ha confirmado</h1>
<p>Tu pedido ha sido Guardado con exito, una vez que realices la transferencia 
    bancaria 546A4SD6548D8WA con el costo total del producto sera enviado</p>
<?php if(isset($Ped)):?>
<h4>Datos del Pedido</h4>
<ul class="ListData">
    <li>Numero de Pedido: <?=$Ped->Id?></li>
    <li>Total a Pagar: <?=$Ped->Coste?></li>
    <li>Productos:</li>
</ul>
<?php endif;?>
<?php if(isset($Produ)):?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <?php while ($Pro=$Produ->fetch_object()):?>
    <tr>
        <td>
            <?php if($Pro->Image!=NULL):?>
            <img src="<?=BaseUrl?>Uploads/Images/<?=$Pro->Image?>">
            <?php else:?>
            <img src="<?=BaseUrl?>assets/img/camiseta.png">
            <?php endif?>
            
        </td>
        <td><?=$Pro->Nombre?></td>
        <td><?=$Pro->Precio?></td>
        <td><?=$Pro->Unidades?></td>
    </tr>
    <?php endwhile;?>
</table>
<?php endif;?>
<?php elseif(isset($_SESSION['Pedido']) && !$_SESSION['Pedido']):?>
<h1>Tu Pedido NO ha Podido Procesarce</h1>
<?php endif; ?>

