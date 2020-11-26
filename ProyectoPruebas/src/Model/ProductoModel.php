<?php
declare (strict_types=1);
require_once __DIR__ . '/../Core/Model.php';
require_once __DIR__ . '/../Entity/Producto.php';

class ProductoModel extends Model{

    public function __construct(PDO $pdo, string $tableName = "productos", string $classname = Producto::class){

        parent::__construct($pdo, $tableName, $classname);

    }

}