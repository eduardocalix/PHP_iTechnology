<?php if (isset($Pro) && isset($Ped) && $Pedido=$Ped->fetch_object()): ?>
<h1>Detalles del Pedido <?=$Pedido->Id?></h1>
<?php if(isset($Admin)&& $Admin):?>
<form action="<?=BaseUrl?>Pedido/Estado" method="POST">
    <h3>Cambier el estado</h3>
    <input type="hidden" value='<?=$Pedido->Id?>' name="PedidoId"/>
    <select name="Estado">
        <option value="Confirm">Pendiente</option>
        <option value="Preparation">En Preparacion</option>
        <option value="Ready">Preparado para enviar</option>
        <option value="Sended">Enviado</option>
    </select>
    
    <input type="submit" value="Cambiar Estado"/>
</form>
<h4>Datos Del Usuario</h4>
<ul class="ListData">
    <li>Nombre: <?=$Pedido->Nombre?></li>
    <li>Apellidos <?=$Pedido->Apellidos?></li>
    <li>Email: <?=$Pedido->Email?></li>
</ul>
<?php  

?>
<?php endif;?>
<h4>Direccion de envio</h4>
<ul class="ListData">
    <li>Provincia: <?=$Pedido->Provincia?></li>
        <li>Ciudad: <?=$Pedido->Localidad?></li>
    <li>Direccion: <?=$Pedido->Direccion?></li>
</ul>
<h4>Datos del Pedido</h4>
<ul class="ListData">
    <li>Numero de Pedido: <?=$Pedido->Id?></li>
    <li>Estado: <?= Utils::ShowEstados($Pedido->Estado)?></li>
    <li>Total a pagar: <?=$Pedido->Coste?> $</li>
    <li>Productos:</li>
</ul>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <?php while($Product=$Pro->fetch_object()):?>
    <tr>
        <td>
            <?php if($Product->Image!=Null):?>
            <img src='<?=BaseUrl?>Uploads/Images/<?=$Product->Image?>'>
            <?php else:?>
            <img src="<?=BaseUrl?>assets/img/camiseta.png">
            <?php endif;?>
        </td>
        <td><a href="<?=BaseUrl?>Productos/Details&Id=<?=$Product->Id?>"><?=$Product->Nombre?></a></td>
        <td><?=$Product->Precio?></td>
        <td><?=$Product->Unidades?></td>
    </tr>
    <?php endwhile;?>
</table>
<?php endif; ?>
