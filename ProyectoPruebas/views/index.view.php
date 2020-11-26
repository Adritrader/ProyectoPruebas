<!DOCTYPE html>
<html lang="en">
<head>

    <?php require 'partials/head.partial.php';?>

</head>
<body>
<header>
    <?php require 'partials/header.partial.php';?>
</header>
<div class="container">
    <div class="row">

        <div class="col-lg-3">

            <h2 class="my-4">Genres</h2>
            <div class="list-group">



            </div>

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                </ol>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>

            <div class="row">
                <div class="col-12">
                    <form class="form-inline justify-content-center my-4">
                        <input name="text" class="form-control w-75 mr-sm-4" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        <div class="text-right mb-3"><a class="btn btn-primary" href="cliente-create.php"
                                                        title="create a new film"?><i class="fa fa-plus"></i> Nuevo Cliente</a>

                    </form>
                </div>
            </div>
            <h2>Clientes</h2>

                <?php


                foreach ($clientes as $cliente){
                    ?>

                    <div class="col col-lg-6">

                            <table border="1">
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Direccion</th>
                                <th>Fecha Nacimiento</th>
                                <th>Accion</th>

                            <tr><td><em><?=$cliente->getNombre()?></em></td>
                            <td><?=$cliente->getApellido()?></td>
                                <td><?=$cliente->getDireccion()?></td>
                                <td><?=$cliente->getFechaNacimiento() -> format("Y-m-d")?></td>
                            <td><a class="btn btn-danger" href="cliente-delete.php?id=<?=$cliente->getId()?>"><i class="fas fa-trash-alt"></i>Delete</a></td></tr>

                            </table>


                        </div>

                <?php } ?>

    <section id="partner">
        <div class="container">
                    <h2>Productos</h2>


                        <?php foreach ($productos as $producto){
                        ?>

                        <div class="col-lg-3 col-md-6 mb-4">

                            <table border="1">
                                <th>Nombre</th>
                                <th>Proveedor</th>
                                <th>Descripcion</th>

                                <tr><td><em><?=$producto->getNombre()?></em></td>
                                    <td><?=$producto->getProveedor()?></td>
                                    <td><?=$producto->getDescripcion()?></td></tr>

                            </table>

                    </div>
                    <?php } ?>
        </div>

    </section>


    <!-- /.row -->
</div>
<?php require 'partials/footer.partial.php'?>
</body>
</html>