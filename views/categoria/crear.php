<h1>Crear nueva categoría</h1>

<form action="<?=base_url?>categoria/save" method="POST">
    <label for="nombre">Nombre de la categoría</label>
    <input type="text" name="nombre" required>
    <input type="submit" value="Guardar">
</form>