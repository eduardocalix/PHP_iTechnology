<?php if (isset($_SESSION['User'])): ?>
    <h1>Datos de envio</h1>
    <a href="<?= BaseUrl ?>Carrito/Index">Revisar los Productos</a>
    <h2>Direccion de envio</h2>
    <form method="POST" action="<?=BaseUrl?>Pedido/Add">
        
        <label for="Provincia">Provincia</label>
        <input type="text" name="Provincia" required/>
        
        <label for="Localidad">Localidad</label>
        <input type="text" name="Localidad" reuqired/>
        
        <label for="Direccion">Direccion</label>
        <input type="text" name="Direccion" required/>
        
        <input type="submit" value="Confirmar Pedido"/>
    </form>


<?php else: ?>
    <h1>Debes identificarte Primero</h1>
<?php endif; ?>

