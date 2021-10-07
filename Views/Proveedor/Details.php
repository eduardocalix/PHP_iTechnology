<?php if (isset($Pro) && isset($Ped) && $Proveedor=sqlsrv_fetch_array($Ped)): ?>
<h1>Detalles del Proveedor <?=$Proveedor['idProveedor']?></h1>
<?php if(isset($Admin)&& $Admin):?>
<form action="<?=BaseUrl?>Proveedor/Estado" method="POST">
    <h3>Cambier el estado</h3>
    <input type="hidden" value='<?=$Proveedor['idProveedor']?>' name="IdProveedor"/>
    <select name="Estado">
        <option value="Confirm">Pendiente</option>
        <option value="Preparation">En Preparacion</option>
        <option value="Ready">Preparado para enviar</option>
        <option value="Sended">Enviado</option>
    </select>
    
    <input type="submit" value="Cambiar Estado"/>
</form>

<?php  

?>
<?php endif;?>
<h4>Direccion de envio</h4>
<ul class="ListData">
    <li>Nombre: <?=$Proveedor['nombre']?></li>
        <li>Telefono: <?=$Proveedor['telefono']?></li>
    <li>Direccion: <?=$Proveedor['direccion']?></li>
</ul>
<h4>Datos del Proveedor</h4>
<ul class="ListData">
    <li>Numero de Proveedor: <?=$Proveedor['idProveedor']?></li>
    <li>Total a pagar: <?=$Proveedor['costo']?> $</li>
    <li>Productos:</li>
</ul>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>
    <?php while($Product=sqlsrv_fetch_array($Pro)):?>
    <tr>
        <td>
            <?php if($Product['imagen']!=Null):?>
            <img src='<?=BaseUrl?>Uploads/Images/<?=$Product['imagen']?>'>
            <?php else:?>
            <img src="<?=BaseUrl?>assets/img/camiseta.png">
            <?php endif;?>
        </td>
        <td><a href="<?=BaseUrl?>Productos/Details&Id=<?=$Product['idProducto']?>"><?=$Product['descripcion']?></a></td>
        <td><?=$Product['precioVenta']?></td>
        <td><?=$Product['stock']?></td>
    </tr>
    <?php endwhile;?>
</table>
<?php endif; ?>
