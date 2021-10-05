<h1>Modifica la Categoria</h1>

<form>
<label for="Descripcion">Descripcion</label>
<input type="text" name="Descripcion" value="<?=$_SESSION['Categoria']->Descripcion?>"/>
<a href="<?= BaseUrl ?>Categoria/Renovate" class="Boton Boton-Small BotonYellow">Editar Categoria</a>
<a href="<?= BaseUrl ?>Categoria/Eliminate" class="Boton Boton-Small BotonRojo">Eliminar Categoria</a>
</form>