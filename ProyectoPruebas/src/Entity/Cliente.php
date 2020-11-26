<?php

declare(strict_types=1);

require_once __DIR__ . '/../Core/Entity.php';

class Cliente implements Entity{

    public ?int $id = null;
    public string $nombre;
    public string $apellido;
    public string $direccion;
   //public DateTime $fecha_nacimiento;


    public function __set(string $name, $value)
    {
        switch ($name) {
            case "fecha_nacimiento":
                $this->fecha_nacimiento = DateTime::createFromFormat('Y-m-d', $value);
                break;
        }
    }


    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param mixed $fecha_nacimiento
     */
    public function setFechaNacimiento($fecha_nacimiento): void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): Cliente
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function toArray(): array
    {
        return ["id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "direccion" => $this->getDireccion(),
            "fecha_nacimiento" => $this->getFechaNacimiento()->format('Y-m-d')];
    }



}