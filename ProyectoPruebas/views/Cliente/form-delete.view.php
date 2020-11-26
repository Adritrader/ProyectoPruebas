<form action="" method="post" enctype="multipart/form-data" novalidate>

    <input type="hidden" name="id" value="<?= $cliente->getId() ?>">
    <div class="form-group">

        <label for="nombre">Nombre: </label>
        <h5><?= $cliente->getNombre()?></h5>

    </div>
    <div class="form-group">

        <label for="apellido">Apellido: </label>
        <h5><?= $cliente->getTagline() ?></h5>

    </div>

    <div class="form-group">

        <label for="direccion">Direccion: </label>
        <h5><?= $cliente->getDireccion() ?></h5>

    </div>

    <div class="form-group text-right">

        <p>Are you sure you want to delete <?= $cliente->getNombre() . "?"?></p>
        <a href="films.php" class="btn btn-primary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</form>
