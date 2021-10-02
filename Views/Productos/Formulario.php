<?php if (isset($Edit) && $Edit && $Id && $Pro && is_object($Pro)):     
    $Producto=$Pro->fetch_object();
    $Url = BaseUrl ."Productos/Save&Id=$Producto->Id";?>
<h1>Editar Producto <?=$Producto->Nombre?></h1>
    <?php

    
else:
    $Url = BaseUrl . 'Productos/Save';
    ?>
<h1>Crear Productos</h1>
<?php endif; ?>





<?php if (isset($_SESSION['RegisterProductos']) && $_SESSION['RegisterProductos'] == 'Failed'): ?>
    <strong class="Alertas AlertasError">Error al registrar el producto</strong>
<?php endif;
Utils:: DeleteSession('RegisterProductos')
?>

<div class="FormContainer">
    <form action="<?= $Url ?>" method="POST" enctype="multipart/form-data">


        <?= Utils::ShowErrors('Errores-Productos-Save', 'Nombre') ?>
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre" value="<?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro))? $Producto->Nombre:''?>" required/>

        <label for="Descripcion">Descripcion</label>
        <textarea name="Descripcion"><?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro))? $Producto->Descripcion:''?></textarea>

        <?= Utils::ShowErrors('Errores-Productos-Save', 'Precio') ?>
        <label for="Precio">Precio</label>
        <input type="text" name="Precio" value="<?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro))? $Producto->Precio:''?>" required/>

        <?= Utils::ShowErrors('Errores-Productos-Save', 'Stock') ?>
        <label for="Stock">Stock</label>
        <input type="number" name="Stock" value="<?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro))? $Producto->Stock:''?>" required/>

        <label for="Oferta">Oferta</label>
        <input type="text" name="Oferta" value="<?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro))? $Producto->Oferta:''?>"/>

        <label for="Imagen">Imagen</label>
        <?php if(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro) && !empty($Producto->Image)):?>
        <image class="Miniatura" src="<?=BaseUrl?>Uploads/Images/<?=$Producto->Image?>"/>
        <?php endif;?>
        
        <input type="file" name="Imagen"/>

        <label for="Categoria">Categoria</label>
        <?php $Categorias = Utils::ShowCategorias(); ?>
        <select name="Categoria" >
            <?php while ($Cat = $Categorias->fetch_object()): ?>
            <option value="<?= $Cat->Id ?>" <?=(isset($Edit) && $Edit && $Id && $Pro && is_object($Pro) && $Cat->Id==$Producto->Categoria_Id)?'Selected':''?>><?= $Cat->Nombre ?></option>
            <?php endwhile; ?>
        </select>

        <input type="submit" value="Registrar"/>

    </form>
    <?php Utils::DeleteSession('Errores-Productos-Save'); ?>
</div>