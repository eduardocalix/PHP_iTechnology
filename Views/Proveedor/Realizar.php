    <h1>Datos de envio</h1>
    <a href="<?= BaseUrl ?>Carrito/Index">Revisar los Productos</a>
    <h2>Direccion de envio</h2>
    <form method="POST" action="<?=BaseUrl?>Proveedor/Add">
        
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" required/>
        
        <label for="Telefono">Telefono</label>
        <input type="text" name="Telefono" reuqired/>
        
        <label for="Direccion">Direccion</label>
        <input type="text" name="Direccion" required/>
        
        <input type="submit" value="Confirmar Proveedor"/>
    </form>


