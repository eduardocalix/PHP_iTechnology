
    <h1>Gestionar Proveedores</h1>

    <h1>Mis Proveedores</h1>

<table>
    <tr>
        <th>Numero de Proveedor</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Estado</th>
    </tr>
    <?php while ($Proveedor = sqlsrv_fetch_array($Ped)){ ?>
        <tr>
            <td><a href="<?= BaseUrl ?>Proveedor/Details&Id=<?= $Proveedor['idProveedor'] ?>"><?= $Proveedor['idProveedor'] ?></a></td>
            <td><?= $Proveedor['nombre'] ?></td>
            <td><?= $Proveedor['elefono'] ?></td>
           
        </tr>
    <?php } ?>
</table>

