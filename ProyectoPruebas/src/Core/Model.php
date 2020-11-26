<?php
declare(strict_types=1);
require_once __DIR__ . '/./Entity.php';


abstract class Model
{

    protected string $tableName;
    protected string $classname;
    protected PDO $pdo;

    /**
     * Model constructor.
     * @param PDO $pdo
     * @param string $tableName
     * @param string $classname
     *
     */

    public function __construct(PDO $pdo, string $tableName, string $classname)
    {

        $this->pdo = $pdo;
        $this->tableName = $tableName;
        $this->classname = $classname;

    }

    /**
     * Find all instaces of className
     * @return array
     * @throws Exception
     */

    public function findAll(array $order = []): array
    {
        try {

            if (empty($order)) {

                $stmt = $this->pdo->query("SELECT * from {$this->tableName}");
            } else {


                $orderByClause = array_map(function ($v, $k) {

                    return "$k $v";

                }, $order, array_keys($order));

                $orderBy = implode(",", $orderByClause);
                $stmt = $this->pdo->query("SELECT * from {$this->tableName} ORDER BY $orderBy");


            }
            return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classname);
        } catch (Exception $exception) {

            throw new Exception("Model error" . $exception->getMessage());
        }
    }

    /** Returns an instance by its id.
     * @param int $id
     * @return Entity
     * @throws NotFoundException
     */

    public function find(int $id): Entity
    {

        //CONSULTA PREPARADA

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id=:id");
        $stmt->bindValue("id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classname);

        //No hace falta hacer el fetchall porque no queremos obtener un array de tipada,
        // nos devolvera un elemento o nada, porque no hay 2 elementos en la tabla con la ID repetida

        $e = $stmt->fetch();

        if (empty($e)) {

            throw new NotFoundException("Cannot find a {$this->classname} entity with id=$id");

        }

        return $e;

    }

    /*Generate functions*/

    /**
     * @param string $tableName
     * @param array $tableFields
     * @return string
     */

    private function generateSQLInsert(string $tableName, array $tableFields): string
    {

        $sqlSentence = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $tableName, implode(", ", array_keys($tableFields)), ":" . implode(", :", array_keys($tableFields)));

        return $sqlSentence;

    }

    /**
     * @param string $tableName
     * @param array $tableFields
     * @param int $id
     * @return string
     */

    private function generateSQLUpdate(string $tableName, array $tableFields, int $id): string
    {

        unset($tableFields['id']);
        $orderByClause = array_map(function ($k) {
            return "$k=:$k";
        }, array_keys($tableFields));
        $tableFields = implode(",", $orderByClause);

        //var_dump($tableFields);

        $sqlSentence = sprintf("UPDATE %s SET %s WHERE id=:id", $tableName, $tableFields, $id);
        //var_dump($sqlSentence);

        return $sqlSentence;

    }


    //SQL functions

    /**
     * @param Entity $entity
     * @return bool
     * @throws Exception
     */

    public function save(Entity $entity)
    {

        $parameters = $entity->toArray();
        try {
            $SQLInsert = $this->generateSQLInsert($this->tableName, $parameters);

            $stmt = $this->pdo->prepare($SQLInsert);

            $stmt->execute($parameters);

            if ($stmt->rowCount() !== 1) {

                return false;
            }

            return true;

        } catch (Exception $e) {

            throw new Exception("Model error: " . $e->getMessage());
        }
    }

    /**
     * @param Entity $entity
     * @return bool
     * @throws Exception
     */

    public function update(Entity $entity)
    {

        $parameters = $entity->toArray();

        try {

            $id = $parameters->getId();
            $SQLUpdate = $this->generateSQLUpdate($this->tableName, $parameters, $id);

            $stmt = $this->pdo->prepare($SQLUpdate);

            $stmt->execute($parameters);

            if ($stmt->rowCount() !== 1) {

                return false;
            }

            return true;

        } catch (Exception $e) {

            throw new Exception("Model error: " . $e->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */

    public function delete(int $id)
    {

        try {

            $stmt = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id=:id");
            $stmt->bindValue("id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;

        } catch (Exception $e) {

            throw new Exception("Model error: " . $e->getMessage());
        }
    }

    //Execute functions

    /**
     * @param string $sql
     * @param array $text
     * @return array
     */

    public function executeQuery(string $sql, array $text): array
    {


        $stmt = $this->pdo->prepare($sql);
        //var_dump($text);
        $stmt->execute($text);

        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->classname);

    }

    /**
     * @param callable $fnExecuteQuerys
     */

    public function executeTransaction(callable $fnExecuteQuerys) {

        try {

            $this->pdo->beginTransaction();
            $fnExecuteQuerys();
            $this->pdo->commit();

        } catch (PDOException $PDOException) {

            $this->pdo->rollBack();
            throw new Exception("Model exception: " . $PDOException->getMessage());

        }

    }


}