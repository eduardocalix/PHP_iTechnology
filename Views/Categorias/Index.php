<h1>Gestionar Categorias</h1>

<?php if (isset($_SESSION['Save-Categorias']) && $_SESSION['Save-Categorias'] == 'Failed'): ?>
    <strong class="Alertas AlertasError">Error Al Guardar la Categoria</strong>
<?php elseif (isset($_SESSION['Save-Categorias']) && $_SESSION['Save-Categorias'] == 'Complete'): ?>
    <strong class="Alertas AlertasExito">La Categoria se ha registrado</strong>
<?php endif; ?>
<a href="<?= BaseUrl ?>Categoria/Create" class="Boton Boton-Small BotonGreen">Crear Categoria</a>

<?php Utils::DeleteSession('Save-Categorias');?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
    </tr>
    <?php while ($Cat = $Categoria->fetch_object()): ?>
        <tr>
            <td><?= $Cat->Id ?></td>
            <td><?= $Cat->Nombre ?></td>
        </tr>    
    <?php endwhile; ?>
</table>


