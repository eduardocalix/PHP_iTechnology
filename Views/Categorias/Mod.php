<h1>Modifica la Categoria</h1>

<form>
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" value="<?=$_SESSION['Categoria']->Nombre?>"/>
<a href="<?= BaseUrl ?>Categoria/Renovate" class="Boton Boton-Small BotonYellow">Editar Categoria</a>
<a href="<?= BaseUrl ?>Categoria/Eliminate" class="Boton Boton-Small BotonRojo">Eliminar Categoria</a>
</form>