<?php declare(strict_types=1);
require 'src/Entity/Cliente.php';
require 'src/Database.php';
require 'src/Model/ClienteModel.php';

?>

<?php

$isGetMethod = true;

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (empty($id)) {

    $errors[] = "404 Not found";

} else {

    $pdo = Database::getConnection();

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('SELECT * FROM cliente WHERE id=:id');
    $stmt->bindValue("id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, Cliente::class);
    $movie = $stmt->fetch();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $isGetMethod = false;
    if (empty($errors)) {

        try {

            $pdo = Database::getConnection();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare('DELETE FROM cliente WHERE id=:id');
            $stmt->bindValue("id", $id, PDO::PARAM_INT);
            $stmt->execute();


        } catch (PDOException $PDOException) {

            echo $PDOException->getMessage();

        }
    }


}
require 'views/cliente-delete.view.php';
?>
