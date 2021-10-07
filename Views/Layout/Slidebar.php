<!--Barra Lateral-->
<aside id="Lateral">
    <div Id="Carrito" class="Block_Asile" >
        <h3>Mi Carrito</h3>
        <ul>
            <li><a href="<?=BaseUrl?>Carrito/Index">Productos (<?= Utils::StatsCarrito()['Unidades']?>)</a></li>
            <li><a href="<?=BaseUrl?>Carrito/Index">Total: <?= Utils::StatsCarrito()['Total'] ?>$</a></li>
            <li><a href="<?=BaseUrl?>Carrito/Index">Ver el Carrito</a></li>
        </ul>
    </div>
    <div id="Login" class="BlockAsile">

        <?php if (isset($_SESSION['LogIn']) && $_SESSION['LogIn'] == 'Failed'): ?>
            <strong class="Alertas AlertasError">Error al iniciar Sesion</strong>
            <?php
        endif;
        //Utils::DeleteSession('LogIn');
        $Utils = new Utils();
        ?>
        <?php if (!isset($_SESSION['User']) && !isset($_SESSION['LogIn'])): ?>
            <h3>Entra a la Web</h3>
            <form action="<?= BaseUrl ?>Usuarios/Login" method="POST">
                <?= $Utils->ShowErrors('Errores-Login', 'Usuario') ?>
                <label for="Usuario">Usuario</label>
                <input type="text" name="Usuario">

                <?= $Utils->ShowErrors('Errores-Login', 'Clave') ?>
                <label for="Clave">Contraseña</label>
                <input type="password" name="Clave">

                <input type="submit" value="Enviar"/>
            </form>
        <?php else: ?>
            <h3><?= $_SESSION['User']['nombre'] ?> <?= $_SESSION['User']['apellido'] ?></h3>
        <?php endif; ?>
        <?php/*  Utils::DeleteSession('Errores-Login'); */ ?>
        <ul>
            <?php /*if (isset($_SESSION['Admin'])): */ ?>
                <li><a href="<?=BaseUrl?>Views/Categorias/Index.php">Gestionar Categorias</a></li>    
                <li><a href="<?=BaseUrl?>Views/Productos/Gestion.php">Gestionar Productos</a></li>
                <li><a href="<?=BaseUrl?>Views/Proveedores/crear.php">Gestionar Proveedores</a></li>
                <li><a href="<?=BaseUrl?>Views/Pedido/GestionarPedidos.php">Gestionar Compras</a></li>
            <?php /* endif; */ ?>
            <?php if (isset($_SESSION['User'])): ?>
                <li><a href="<?=BaseUrl?>Pedido/MisPedidos">Mis Pedidos</a></li>
                <li><a href="<?= BaseUrl ?>Usuarios/LogOut">Cerrar Sesion</a></li>
            <?php else: ?>
                <li><a href="<?=BaseUrl?>Views/Usuarios/Registro.php">Registrate Aqui</a></li>
            <?php endif; ?>

        </ul>

    </div>
</aside>
<!--Contenido Central-->
<div id="Central">