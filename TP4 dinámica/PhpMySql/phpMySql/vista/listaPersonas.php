<?php
include_once '../modelo/Persona.php';

// Obtener todas las personas
$personas = Persona::listar("1=1"); // Ajusta la consulta según la implementación

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="./assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';

echo "<div class='container mt-4'>";

echo " <h1>Crear una página listaPersonas.php que muestre un listado con las personas que se
encuentran cargadas</h1> <br> ";
echo "<h2>Listado de Personas Cargadas</h2> <br>";

if (empty($personas)) {
    echo "<div class='alert alert-warning' role='alert'>No hay personas cargadas.</div>";
} else {
    // Mostrar las personas en una tabla
    echo "<table class='table table-success table-bordered mt-3'>";
    echo "<thead><tr><th>Nro DNI</th><th>Apellido</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Teléfono</th><th>Domicilio</th></tr></thead>";
    echo "<tbody>";

    foreach ($personas as $persona) {
        // Mostrar los datos de la persona
        echo "<tr>";
        echo "<td>{$persona->getNroDni()}</td>";
        echo "<td>{$persona->getApellido()}</td>";
        echo "<td>{$persona->getNombre()}</td>";
        echo "<td>{$persona->getFechaNac()}</td>";
        echo "<td>{$persona->getTelefono()}</td>";
        echo "<td>{$persona->getDomicilio()}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}
echo '<a href="autosPersona.php" class="btn btn-success mt-4">Ver Autos por Persona</a>';
echo '<br>';
echo '<a href="../../../menu.html" class="btn btn-primary mt-4">Volver</a>';

echo "</div>";
echo '</body>';
?>
