<?php

include_once 'BaseDatos.php';

class Persona
{
    // Atributos privados de la clase Persona
    private $nroDni;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $telefono;
    private $domicilio;

    // Constructor
    public function __construct($nroDni = null, $apellido = null, $nombre = null, $fechaNac = null, $telefono = null, $domicilio = null)
    {
        $this->nroDni = $nroDni;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->fechaNac = $fechaNac;
        $this->telefono = $telefono;
        $this->domicilio = $domicilio;
    }

    // Getters
    public function getNroDni()
    {
        return $this->nroDni;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDomicilio()
    {
        return $this->domicilio;
    }

    // Setters
    public function setNroDni($nroDni)
    {
        $this->nroDni = $nroDni;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
    }

    public function setear($datDni, $datApellido, $datNombre, $datfechaNac, $datTelefono, $datDomicilio){
        $this->setNroDni($datDni);
        $this->setApellido($datApellido);
        $this->setNombre($datNombre);
        $this->setFechaNac($datfechaNac);
        $this->setTelefono($datTelefono);
        $this->setDomicilio($datDomicilio);
    }

    // Método para insertar datos en la base de datos
    public function insertar()
    {
        $baseDatos = new BaseDatos();
        $sql = "INSERT INTO persona (NroDni, Apellido, Nombre, fechaNac, Telefono, Domicilio)
                VALUES (:nroDni, :apellido, :nombre, :fechaNac, :telefono, :domicilio)";
        $consulta = $baseDatos->prepare($sql);
        $consulta->bindParam(':nroDni', $this->nroDni);
        $consulta->bindParam(':apellido', $this->apellido);
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->bindParam(':fechaNac', $this->fechaNac);
        $consulta->bindParam(':telefono', $this->telefono);
        $consulta->bindParam(':domicilio', $this->domicilio);
        return $consulta->execute();
    }

    // Método para actualizar datos en la base de datos
    public function modificar()
    {
        $baseDatos = new BaseDatos();
        $sql = "UPDATE persona
                SET Apellido = :apellido, Nombre = :nombre, fechaNac = :fechaNac, Telefono = :telefono, Domicilio = :domicilio
                WHERE NroDni = :nroDni";
        $consulta = $baseDatos->prepare($sql);
        $consulta->bindParam(':nroDni', $this->nroDni);
        $consulta->bindParam(':apellido', $this->apellido);
        $consulta->bindParam(':nombre', $this->nombre);
        $consulta->bindParam(':fechaNac', $this->fechaNac);
        $consulta->bindParam(':telefono', $this->telefono);
        $consulta->bindParam(':domicilio', $this->domicilio);
        return $consulta->execute();
    }

    // Método para eliminar un registro de la base de datos
    public function eliminar()
    {
        $baseDatos = new BaseDatos();
        $sql = "DELETE FROM persona WHERE NroDni = :nroDni";
        $consulta = $baseDatos->prepare($sql);
        $consulta->bindParam(':nroDni', $this->nroDni);
        return $consulta->execute();
    }

    // Método estático para listar registros en la base de datos

    public static function listar($where = "")
    {
        $baseDatos = new BaseDatos();
        $sql = "SELECT * FROM persona";

        // Si se pasa un array, conviértelo en una condición SQL
        if (is_array($where)) {
            $condiciones = [];
            foreach ($where as $campo => $valor) {
                // Asegúrate de escapar los valores
                $valorEscapado = $baseDatos->quote($valor);
                $condiciones[] = "$campo = $valorEscapado";
            }
            $where = implode(" AND ", $condiciones);
        }

        if (!empty($where)) {
            $sql .= " WHERE $where";
        }

        $consulta = $baseDatos->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        $arregloPersonas = [];
        foreach ($resultado as $row) {
            $persona = new Persona(
                $row['NroDni'],
                $row['Apellido'],
                $row['Nombre'],
                $row['fechaNac'],
                $row['Telefono'],
                $row['Domicilio']
            );
            $arregloPersonas[] = $persona;
        }
        return $arregloPersonas;
    }

    public static function buscar($criterios)
    {
        $baseDatos = new BaseDatos();

        // Crear la consulta SQL
        $sql = "SELECT * FROM persona WHERE ";
        $condiciones = [];
        foreach ($criterios as $campo => $valor) {
            $condiciones[] = "$campo = :$campo";
        }
        $sql .= implode(' AND ', $condiciones);

        // Preparar la consulta
        $consulta = $baseDatos->prepare($sql);

        // Bindear los parámetros
        foreach ($criterios as $campo => $valor) {
            $consulta->bindParam(":$campo", $criterios[$campo]);
        }

        // Ejecutar y obtener el resultado
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Convertir el resultado en un arreglo de objetos Persona
        $personas = [];
        foreach ($resultado as $row) {
            $persona = new Persona(
                $row['NroDni'],
                $row['Apellido'],
                $row['Nombre'],
                $row['fechaNac'],
                $row['Telefono'],
                $row['Domicilio']
            );
            $personas[] = $persona;
        }

        return $personas;
    }

}
