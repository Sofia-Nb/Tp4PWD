<?php

include_once 'BaseDatos.php';

class Auto
{
    // Atributos privados de la clase Auto
    private $patente;
    private $marca;
    private $modelo;
    private $dniDuenio;

    // Constructor: permite inicializar el objeto con valores al momento de crearlo
    public function __construct($patente = null, $marca = null, $modelo = null, $dniDuenio = null)
    {
        $this->patente = $patente;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->dniDuenio = $dniDuenio;
    }

    // Métodos getters
    public function getPatente()
    {
        return $this->patente;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function getDniDuenio()
    {
        return $this->dniDuenio;
    }

    // Métodos setters
    public function setPatente($patente)
    {
        $this->patente = $patente;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function setDniDuenio($dniDuenio)
    {
        $this->dniDuenio = $dniDuenio;
    }

    // Método para insertar un nuevo registro en la base de datos
    public function insertar()
    {
        // Se crea una instancia de la clase BaseDatos
        $baseDatos = new BaseDatos();
        // Consulta SQL para insertar un auto
        $sql = "INSERT INTO auto (Patente, Marca, Modelo, DniDuenio) VALUES (:patente, :marca, :modelo, :dniDuenio)";
        // Se prepara la consulta
        $consulta = $baseDatos->prepare($sql);

        // Asignación de valores a los placeholders
        $consulta->bindParam(':patente', $this->patente);
        $consulta->bindParam(':marca', $this->marca);
        $consulta->bindParam(':modelo', $this->modelo);
        $consulta->bindParam(':dniDuenio', $this->dniDuenio);

        // Ejecutar la consulta
        return $consulta->execute();
    }

    // Método para modificar un registro existente
    public function modificar()
    {
        // Se crea una instancia de la clase BaseDatos
        $baseDatos = new BaseDatos();
        // Consulta SQL para actualizar un auto
        $sql = "UPDATE auto SET Marca = :marca, Modelo = :modelo, DniDuenio = :dniDuenio WHERE Patente = :patente";
        // Se prepara la consulta
        $consulta = $baseDatos->prepare($sql);

        // Asignación de valores a los placeholders
        $consulta->bindParam(':patente', $this->patente);
        $consulta->bindParam(':marca', $this->marca);
        $consulta->bindParam(':modelo', $this->modelo);
        $consulta->bindParam(':dniDuenio', $this->dniDuenio);

        // Ejecutar la consulta
        return $consulta->execute();
    }

    // Método para eliminar un registro
    public function eliminar()
    {
        // Se crea una instancia de la clase BaseDatos
        $baseDatos = new BaseDatos();
        // Consulta SQL para eliminar un auto
        $sql = "DELETE FROM auto WHERE Patente = :patente";
        // Se prepara la consulta
        $consulta = $baseDatos->prepare($sql);

        // Asignación de valores a los placeholders
        $consulta->bindParam(':patente', $this->patente);

        // Ejecutar la consulta
        return $consulta->execute();
    }

    // Método estático para listar todos los registros de autos
    public static function listar($where = "")
    {
        // Se crea una instancia de la clase BaseDatos
        $baseDatos = new BaseDatos();
        // Consulta SQL para seleccionar autos
        $sql = "SELECT * FROM auto";
        if ($where != "") {
            $sql .= " WHERE $where";
        }
        // Se prepara y ejecuta la consulta
        $consulta = $baseDatos->prepare($sql);
        $consulta->execute();
        // Obtener los resultados
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        // Crear un array para los objetos Auto
        $arregloAutos = [];
        foreach ($resultado as $row) {
            $auto = new Auto($row['Patente'], $row['Marca'], $row['Modelo'], $row['DniDuenio']);
            $arregloAutos[] = $auto;
        }

        return $arregloAutos;
    }

    // Método estático para buscar autos
//     public static function buscar($patente) {
//         $baseDatos = new BaseDatos();

//         // Crear la consulta SQL con parámetros
//         $sql = "SELECT * FROM auto WHERE Patente = :patente";
//         // Preparar la consulta
//         $consulta = $baseDatos->prepare($sql);
//         // Vincular los parámetros
//         $consulta->bindParam(':patente', $patente);
//         // Ejecutar y obtener el resultado
//         $consulta->execute();
//         $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

//         // Convertir el resultado en un arreglo de objetos Auto
//         $autos = [];
//         foreach ($resultado as $row) {
//             $objAuto = new Auto(
//                 $row['Patente'],
//                 $row['Marca'],
//                 $row['Modelo'],
//                 $row['DniDuenio']
//             );
//             $autos[] = $objAuto;
//         }

//         return $autos;
//     }

}