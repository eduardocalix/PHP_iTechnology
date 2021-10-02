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
    
    <?= Utils::ShowErrors('Errores-Register', 'Nombre')?>
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre" />
    
    <?=Utils::ShowErrors('Errores-Register', 'Apellido')?>
    <label for="Apellidos">Apellidos</label>
    <input type="text" name="Apellidos" />
    
    <?=Utils::ShowErrors('Errores-Register', 'Email')?>
    <label for="Email">Email</label>
    <input type="email" name="Email" />
    
    <?=Utils::ShowErrors('Errores-Register', 'Password')?>
    <label for="Password">Contraseña</label>
    <input type="password" name="Password"/>
    
    <input type="submit" value="Registrarse"/>
</form>
<?php Utils::DeleteSession('Errores-Register');?>