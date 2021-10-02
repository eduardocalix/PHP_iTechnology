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
        Utils::DeleteSession('LogIn');
        $Utils = new Utils();
        ?>
        <?php if (!isset($_SESSION['User']) && !isset($_SESSION['LogIn'])): ?>
            <h3>Entra a la Web</h3>
            <form action="<?= BaseUrl ?>Usuario/Login" method="POST">
                <?= $Utils->ShowErrors('Errores-Login', 'Email') ?>
                <label for="Email">Email</label>
                <input type="email" name="Email">

                <?= $Utils->ShowErrors('Errores-Login', 'Password') ?>
                <label for="Password">Contraseña</label>
                <input type="password" name="Password">

                <input type="submit" value="Enviar"/>
            </form>
        <?php else: ?>
            <h3><?= $_SESSION['User']->Nombre ?> <?= $_SESSION['User']->Apellidos ?></h3>
        <?php endif; ?>
        <?php Utils::DeleteSession('Errores-Login'); ?>
        <ul>
            <?php if (isset($_SESSION['Admin'])): ?>
                <li><a href="<?=BaseUrl?>Categoria/Index">Gestionar Categorias</a></li>    
                <li><a href="<?=BaseUrl?>Productos/Gestion">Gestionar Productos</a></li>
                <li><a href="<?=BaseUrl?>Pedido/GestionarPedidos">Gestionar Pedidos</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['User'])): ?>
                <li><a href="<?=BaseUrl?>Pedido/MisPedidos">Mis Pedidos</a></li>
                <li><a href="<?= BaseUrl ?>Usuario/LogOut">Cerrar Sesion</a></li>
            <?php else: ?>
                <li><a href="<?=BaseUrl?>Usuario/Registro">Registrate Aqui</a></li>
            <?php endif; ?>

        </ul>

    </div>
</aside>
<!--Contenido Central-->
<div id="Central">