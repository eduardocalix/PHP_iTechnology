<h1>Registrarse</h1>
<?php
if(isset($_SESSION['Register'])&&$_SESSION['Register']=='Complete'):?>
<strong class="Alertas AlertasExito">El Registro se ha completado</strong>
<?php elseif(isset($_SESSION['Register'])&&$_SESSION['Register']=='Failed'):?>
<strong class="Alertas AlertasError">Error al registrar</strong>
<?php endif;?>
<?php Utils::DeleteSession('Register');
$Utils=new Utils();?>

<form action="<?=BaseUrl?>/Usuario/Save" method="POST">
    
    <?= Utils::ShowErrors('Errores-Register', 'nombre')?>
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre" />
    
    <?=Utils::ShowErrors('Errores-Register', 'apellido')?>
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" />
    
    <?=Utils::ShowErrors('Errores-Register', 'usuario')?>
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" />
    
    <?=Utils::ShowErrors('Errores-Register', 'clave')?>
    <label for="clave">Contraseña</label>
    <input type="password" name="clave"/>
    
    <input type="submit" value="Registrarse"/>
</form>
<?php Utils::DeleteSession('Errores-Register');?>