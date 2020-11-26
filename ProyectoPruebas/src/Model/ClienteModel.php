<?php
declare (strict_types=1);
require_once __DIR__ . '/../Core/Model.php';
require_once __DIR__ . '/../Entity/Cliente.php';

class ClienteModel extends Model{

    public function __construct(PDO $pdo, string $tableName = "cliente", string $classname = Cliente::class){

        parent::__construct($pdo, $tableName, $classname);

    }

}