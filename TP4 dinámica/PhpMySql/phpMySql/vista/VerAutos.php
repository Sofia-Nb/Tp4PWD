<?php
include_once '../modelo/Auto.php';
include_once '../modelo/Persona.php';

// Obtener todos los autos
$autos = Auto::listar("1=1");  // Ajusta la consulta según la implementación

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="./assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background" style="height: 740px;"></div>';
echo '<div class="container" style="height: 740px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">';
echo '<br>';
echo "<h2>Crear una página PHP “VerAutos.php”, en ella usando la capa de control correspondiente mostrar todos los datos de los autos que se encuentran cargados, de los dueños mostrar nombre y apellido. En caso de que no se encuentre ningún auto cargado en la base mostrar un mensaje indicando que no hay autos cargados.</h2>";

if (empty($autos)) {
    echo "<div class='alert alert-warning' role='alert'>No hay autos cargados.</div>";
} else {
    // Mostrar los autos en una tabla
    echo "<table class='table table-dark table-bordered mt-3'>";
    echo "<thead><tr><th>Patente</th><th>Marca</th><th>Modelo</th><th>Dueño</th></tr></thead>";
    echo "<tbody class='bg-dark-custom'>";

    foreach ($autos as $auto) {
        // Buscar el dueño del auto
        $dueno = Persona::buscar(['NroDni' => $auto->getDniDuenio()]);
        $nombreDueño = $dueno ? $dueno[0]->getNombre() . " " . $dueno[0]->getApellido() : "Sin dueño";

        // Mostrar los datos del auto y del dueño
        echo "<tr>";
        echo "<td>{$auto->getPatente()}</td>";
        echo "<td>{$auto->getMarca()}</td>";
        echo "<td>{$auto->getModelo()}</td>";
        echo "<td>{$nombreDueño}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
echo '<a href="javascript:history.back()" class="btn btn-secondary mt-4">Volver</a>';

echo "</div>";
echo '</body>';
?>