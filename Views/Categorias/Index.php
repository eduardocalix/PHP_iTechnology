<h1>Gestionar Categorias</h1>

<?php if (isset($_SESSION['Save-Categorias']) && $_SESSION['Save-Categorias'] == 'Failed'): ?>
    <strong class="Alertas AlertasError">Error Al Guardar la Categoria</strong>
<?php elseif (isset($_SESSION['Save-Categorias']) && $_SESSION['Save-Categorias'] == 'Complete'): ?>
    <strong class="Alertas AlertasExito">La Categoria se ha registrado</strong>
<?php endif; ?>
<a href="<?= BaseUrl ?>Categoria/Create" class="Boton Boton-Small BotonGreen">Crear Categoria</a>

<?php 
    
    /* Utils::DeleteSession('Save-Categorias'); */?>
<table>
    <tr>
        <th>IdCategoria</th>
        <th>Descripcion</th>
    </tr>
    <?php require 'Models/Categoria.php';
    $Categoria1 = new Categoria();
    $Cat = $Categoria1->getAll();
    while ($Cate = sqlsrv_fetch_array($Cat)){?>
        <tr>
            <td><?=$Cate['idCategoria'] ?></td>
            <td><?=$Cate['descripcion'] ?></td>
        </tr>    
    <?php } ?>
</table>


