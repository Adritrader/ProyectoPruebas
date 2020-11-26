<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" novalidate>
    <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input id="nombre" class="form-control" type="text" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido: </label>
        <input id="apellido" class="form-control" type="text" name="apellido" required>
    </div>
    <div class="form-group">
        <label for="direccion">Direccion: </label>
        <input id="direccion" class="form-control" type="text" name="direccion" required>
    </div>
    <div class="form-group">
        <label for="fecha_nacimiento">Fecha de nacimiento: </label>
        <input id="fecha_nacimiento" class="form-control" type="date" name="fecha_nacimiento" required>
    </div>


    <div class="form-group text-right">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>


</form>