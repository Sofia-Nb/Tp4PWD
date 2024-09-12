<?php

/*Ejercicio 1- Crear la capa de los datos, implementando el ORM (Modelo de datos) para la base de datos
entregada. Recordar que se debe generar al menos, un clase php por cada tabla. Cada clase debe contener
las variables de instancia y sus metodos get y set; ademas de los metodos que nos permitan seleccionar,
ingresar, modificar y eliminar los datos de cada tabla.*/ 



// Define la clase BaseDatos que extiende la clase PDO de PHP.
class BaseDatos extends PDO {

    // Declaración de atributos de la clase.
    private $engine; // Motor de la base de datos, por ejemplo, 'mysql'.
    private $host; // Dirección del servidor de la base de datos, usualmente 'localhost'.
    private $database; // Nombre de la base de datos a la que se va a conectar.
    private $user; // Usuario para conectarse a la base de datos.
    private $pass; // Contraseña del usuario de la base de datos.
    private $debug; // Modo de depuración, si es true muestra detalles de errores.
    private $conec; // Estado de la conexión (true si está conectada, false si no).
    private $indice; // Índice actual para iterar sobre resultados de consultas.
    private $resultado; // Resultado de una consulta SQL ejecutada.
    private $error; // Último mensaje de error registrado.
    private $sql; // Última consulta SQL ejecutada.

    // Constructor de la clase, inicializa atributos y establece la conexión.
    public function __construct() {
        // Inicialización de atributos con valores predeterminados.
        $this->engine = 'mysql'; // Establece el motor de base de datos a 'mysql'.
        $this->host = 'localhost'; // Establece el host a 'localhost'.
        $this->database = 'infoautos'; // Nombre de la base de datos.
        $this->user = 'root'; // Usuario de la base de datos.
        $this->pass = ''; // Contraseña del usuario.
        $this->debug = true; // Modo de depuración activado.
        $this->error = ""; // Inicializa el mensaje de error vacío.
        $this->sql = ""; // Inicializa la consulta SQL vacía.
        $this->indice = 0; // Inicializa el índice a 0.

       

        // Construye el DSN (Data Source Name) para PDO.
        $dns = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host;

        try {
            // Llama al constructor de la clase padre (PDO) para establecer la conexión.
            parent::__construct($dns, $this->user='root', $this->pass='', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $this->conec = true; // Conexión exitosa, establece conec a true.
        } catch (PDOException $e) {
            // Si ocurre un error en la conexión, captura la excepción y guarda el mensaje de error.
            $this->sql = $e->getMessage();
            $this->conec = false; // Establece conec a false indicando que la conexión falló.
        }
    }

    /**
     * Inicia la conexión con el servidor y la base de datos.
     * Retorna true si la conexión fue exitosa, false en caso contrario.
     */
    public function Iniciar() {
        return $this->getConec(); // Retorna el estado de la conexión.
    }

    // Retorna el estado actual de la conexión (true o false).
    public function getConec() {
        return $this->conec;
    }

    // Establece el modo de depuración.
    public function setDebug($debug) {
        $this->debug = $debug; // Asigna el valor de debug al atributo $debug.
    }

    // Retorna el estado actual del modo de depuración.
    public function getDebug() {
        return $this->debug;
    }

    /**
     * Establece un mensaje de error.
     * @param $e Mensaje de error.
     */
    public function setError($e) {
        $this->error = $e; // Guarda el mensaje de error en el atributo $error.
    }

    /**
     * Retorna el último mensaje de error registrado.
     * @return string Mensaje de error.
     */
    public function getError() {
        return "\n" . $this->error; // Retorna el mensaje de error con un salto de línea.
    }

    /**
     * Establece la última consulta SQL ejecutada.
     * @param $e La consulta SQL.
     */
    public function setSQL($e) {
        return "\n" . $this->sql = $e; // Guarda la consulta SQL en el atributo $sql y la retorna.
    }

    /**
     * Retorna la última consulta SQL ejecutada.
     * @return string Consulta SQL.
     */
    public function getSQL() {
        return "\n" . $this->sql; // Retorna la última consulta SQL con un salto de línea.
    }

    // Ejecuta una consulta SQL y llama al método adecuado basado en el tipo de operación.
    public function Ejecutar($sql) {
        $this->setError(""); // Resetea el mensaje de error.
        $this->setSQL($sql); // Guarda la consulta SQL.

        // Determina el tipo de operación SQL y ejecuta el método correspondiente.
        if (stristr($sql, "insert")) { // Si la consulta es un INSERT.
            $resp = $this->EjecutarInsert($sql);
        }

        if (stristr($sql, "update") OR stristr($sql, "delete")) { // Si es un UPDATE o DELETE.
            $resp = $this->EjecutarDeleteUpdate($sql);
        }

        if (stristr($sql, "select")) { // Si es un SELECT.
            $resp = $this->EjecutarSelect($sql);
        }

        return $resp; // Retorna el resultado de la operación.
    }

    /**
     * Ejecuta una consulta de tipo INSERT.
     * Retorna el ID del último registro insertado o -1 si no hay columna autoincremental.
     * @param $sql Consulta SQL.
     * @return int ID del registro insertado o -1.
     */
    private function EjecutarInsert($sql) {
        $resultado = parent::query($sql); // Ejecuta la consulta SQL usando el método query de PDO.
        if (!$resultado) { // Si la consulta falla.
            $this->analizarDebug(); // Analiza el error si está en modo depuración.
            $id = 0; // ID de inserción fallida.
        } else {
            $id = $this->lastInsertId(); // Obtiene el último ID insertado.
            if ($id == 0) {
                $id = -1; // Si no hay autoincremento, retorna -1.
            }
        }
        return $id; // Retorna el ID del registro insertado.
    }

    /**
     * Ejecuta una consulta de tipo UPDATE o DELETE.
     * Retorna el número de filas afectadas.
     * @param $sql Consulta SQL.
     * @return int Número de filas afectadas o -1 en caso de error.
     */
    private function EjecutarDeleteUpdate($sql) {
        $cantFilas = -1; // Inicializa la cantidad de filas afectadas a -1.
        $resultado = parent::query($sql); // Ejecuta la consulta SQL.
        if (!$resultado) { // Si la consulta falla.
            $this->analizarDebug(); // Analiza el error si está en modo depuración.
        } else {
            $cantFilas = $resultado->rowCount(); // Obtiene la cantidad de filas afectadas.
        }
        return $cantFilas; // Retorna la cantidad de filas afectadas.
    }

    /**
     * Ejecuta una consulta de tipo SELECT.
     * Retorna la cantidad de filas obtenidas por la consulta.
     * @param $sql Consulta SQL.
     * @return int Cantidad de filas obtenidas o -1 en caso de error.
     */
    private function EjecutarSelect($sql) {
        $cant = -1; // Inicializa la cantidad de filas obtenidas a -1.
        $resultado = parent::query($sql); // Ejecuta la consulta SQL.
        if (!$resultado) { // Si la consulta falla.
            $this->analizarDebug(); // Analiza el error si está en modo depuración.
        } else {
            $arregloResult = $resultado->fetchAll(); // Obtiene todos los resultados de la consulta.
            $cant = count($arregloResult); // Cuenta la cantidad de resultados.
            $this->setIndice(0); // Resetea el índice a 0 para iterar sobre los resultados.
            $this->setResultado($arregloResult); // Guarda los resultados en el atributo $resultado.
        }
        echo " La cantidad es " . $cant; // Imprime la cantidad de filas obtenidas.
        return $cant; // Retorna la cantidad de filas obtenidas.
    }

    /**
     * Devuelve un registro de los resultados de una consulta SELECT.
     * Desplaza el puntero al siguiente registro.
     * @return array Registro actual o false si no hay más registros.
     */
    public function Registro() {
        $filaActual = false; // Inicializa el registro actual a false.
        $indiceActual = $this->getIndice(); // Obtiene el índice actual.
        if ($indiceActual >= 0) { // Si el índice es válido.
            $filas = $this->getResultado(); // Obtiene los resultados de la consulta.
            if ($indiceActual < count($filas)) { // Si el índice está dentro del rango.
                $filaActual = $filas[$indiceActual]; // Obtiene el registro actual.
                $this->setIndice($indiceActual + 1); // Incrementa el índice para el próximo registro.
            }
        }
        return $filaActual; // Retorna el registro actual o false si no hay más.
    }

    // Establece el índice para los resultados de la consulta.
    public function setIndice($valor) {
        $this->indice = $valor; // Asigna el índice al valor dado.
    }

    // Retorna el índice actual de los resultados de la consulta.
    public function getIndice() {
        return $this->indice;
    }

    // Establece los resultados de la consulta.
    public function setResultado($arreglo) {
        $this->resultado = $arreglo; // Guarda el arreglo de resultados.
    }

    // Retorna los resultados actuales de la consulta.
    public function getResultado() {
        return $this->resultado;
    }

    // Analiza y muestra detalles de errores si el modo de depuración está activado.
    private function analizarDebug() {
        $e = $this->errorInfo(); // Obtiene información del error.
        $this->setError($e[2]); // Guarda el mensaje de error.
        if ($this->getDebug()) { // Si el modo de depuración está activado.
            echo "<pre>";
            print_r($e); // Imprime información del error.
            echo "</pre>";
        }
    }
}
?>
