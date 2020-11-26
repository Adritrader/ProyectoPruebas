<?php declare(strict_types=1);
require 'src/Entity/Cliente.php';
require 'src/Database.php';
require 'src/Model/ClienteModel.php';

?>

<?php

$isGetMethod = true;
$errors = [];
$pdo = Database::getConnection();

try{

    $clienteModel = new ClienteModel($pdo);
    $clientes = $clienteModel->findAll();

} catch (PDOException $e){

    $errors[] = 'Error' . $e->getMessage();

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $isGetMethod = false;


    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($nombre)) {

        $errors[] = "The title must be valid";

    }

    $apellido = filter_input(INPUT_POST, "apellido", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($apellido)) {

        $errors[] = "Tagline is a must";

    }

    $direccion = filter_input(INPUT_POST, "direccion", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($direccion)) {

        $errors[] = "Direccion es obligatoria";

    }

    if (empty($_POST['fecha_nacimiento'])){

        $errors[] = "La fecha es obligatoria";

    } else {

        $fecha = $_POST['fecha_nacimiento'];

    }




    if(empty($errors)){

        try {

            $pdo = Database::getConnection();

            //Creacion de objetos

            $cliente = new Cliente();


            //Setters

            $cliente->setNombre($nombre);
            $cliente->setApellido($apellido);
            $cliente->setDireccion($direccion);
            $cliente->setFechaNacimiento($fecha);

            //MovieModel

            $clienteModel = new ClienteModel($pdo);
            $clienteModel->save($cliente);


        } catch (PDOException $PDOException) {

            echo $PDOException->getMessage();
        }
    }
}
require 'views/cliente-create.view.php';
?>
