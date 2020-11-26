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

        <div class="col-4">
            <div class="col-12">

                <h1>Nuevo Cliente</h1>
                <?php

                if(!empty($errors) || ($isGetMethod)) : ?>
                    <?php if(!empty($errors)): ?>

                        <ul>

                        <?php foreach ($errors as $error) : ?>

                            <li><?= $error?></li>
                        <?php endforeach;?>

                        </ul><?php endif;?>
                    <?php require 'views/Cliente/form-create.view.php'; ?>

                <?php else:?>
                    <h2>El cliente se ha insertado correctamente</h2>



                <?php endif; ?>

            </div>
        </div>
    </div>


</div>
<?php require 'partials/footer.partial.php'?>
</body>
</html>