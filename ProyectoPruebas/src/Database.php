<?php


class Database{

    private PDO $connection;

    public function __construct(){

        //var_dump(__DIR__);
        $config = require __DIR__ . '/../config/config.php';
        $pdo = new PDO($config["database"]["connection"], $config["database"]["username"], $config["database"]["password"], $config["database"]["options"]);

        //

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);


        $this->connection = $pdo;


    }

    /**
     * @return PDO
     */

    public static function getConnection(): PDO{

        //En los metodos estaticos al no instanciar la clase la pseudovariable $this no podra utilizarse

        $DB = new Database();
        return $DB->connection;

    }

}