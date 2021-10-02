
<?php if (isset($Carrito) && $Carrito != null): ?>
    <h1>Carrito de la Compra</h1>
    <table id="TableCarrito">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach ($Carrito as $Indice => $Elements):
            $Product = $Elements['Product'];
            ?>
            <tr>

                <td>
                    <?php if ($Product->Image != null):
                        ?>
                        <img src="<?= BaseUrl ?>Uploads/Images/<?= $Product->Image ?>"/>
                    <?php else: ?>
                        <img src="<?= BaseUrl ?>/assets/img/camiseta.png"/>
                    <?php endif; ?>

                </td>
                <td> <a href="<?= BaseUrl ?>Productos/Details&Id=<?= $Product->Id ?>"><?= $Product->Nombre ?></a></td>
                <td><?= $Elements['ProductPrice'] ?></td>

                <td>
                    <div id="Unit">
                        <a href="<?=BaseUrl?>Carrito/Up&Index=<?=$Indice?>"class="Boton  Boton-Verde BotonUnit">+</a>
                        <?= $Elements['ProductUnit'] ?>
                        <a href="<?=BaseUrl?>Carrito/Down&Index=<?=$Indice?>"class="Boton  Boton-Verde BotonUnit">-</a>
                    </div>

                </td>
                <td><a href="<?= BaseUrl ?>Carrito/Remove&Index=<?= $Indice ?>" class="Boton BotonRojo Boton-Small" id="BotonEliminarCarrito" >Eliminar Producto</a></td>


            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <h1>Carrito Vacio</h1>
<?php endif; ?>
<?php $Stats = Utils::StatsCarrito() ?>
<a href="<?= BaseUrl ?>Carrito/DeleteAll" class="Boton Boton-Small BotonRojo" id="CarritoBoton">Vaciar Carrito</a>
<a href="<?= BaseUrl ?>Pedido/Index" class="Boton Boton-Small" id="CarritoBoton">Realizar Pedido</a>
<h3 id="CarritoTotal">El total es <?= $Stats['Total'] ?>$</h3>
