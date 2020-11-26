<?php

declare(strict_types=1);
require 'src/Entity/Cliente.php';
require 'src/Entity/Producto.php';
require 'src/Database.php';
require 'src/Model/ClienteModel.php';
require 'src/Model/ProductoModel.php';


$title = "Movie FX";

try {

    //Conexion BD

    $pdo = Database::getConnection();

    // Creacion de objetos

    $clienteModel = new ClienteModel($pdo);
    $productoModel = new ProductoModel($pdo);

    //Metodos findAll aplicados

    $clientes = $clienteModel->findAll();
    $productos = $productoModel->findAll();


    //Excepciones

} catch (PDOException $PDOException ){

    echo $PDOException->getMessage();

} catch (Exception $exception ){

    echo $exception->getMessage();

}


require 'views/index.view.php';?>



