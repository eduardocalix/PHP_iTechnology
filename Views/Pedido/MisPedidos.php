
<?php if (isset($Admin)): ?>
    <h1>Gestionar Pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>
<table>
    <tr>
        <th>Numero de Pedido</th>
        <th>Costo</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    <?php while ($Pedido = $Ped->fetch_object()): ?>
        <tr>
            <td><a href="<?= BaseUrl ?>Pedido/Details&Id=<?= $Pedido->Id ?>"><?= $Pedido->Id ?></a></td>
            <td><?= $Pedido->Coste ?></td>
            <td><?= $Pedido->Fecha ?></td>
            <td><?= Utils::ShowEstados($Pedido->Estado)?></td>
        </tr>
    <?php endwhile ?>
</table>

