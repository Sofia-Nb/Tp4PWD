<?php
include_once '../../modelo/Auto.php'; 
include_once '../../utils/datasubmited.php'; 
include_once '../../control/ControlAuto.php'; 

// Incluye Bootstrap CSS
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';

$datos = dataSubmitted();
$patente = isset($datos['patente']) ? $datos['patente'] : null;

echo '<div class="container mt-4">';

// Verificar si se recibió la patente
if ($patente) {
    // Crear una instancia de la clase ControlAuto
    $controlAuto = new ControlAuto();
    
    // Buscar el auto en la base de datos usando la patente
    $auto = $controlAuto->buscarAutoPorPatente($patente);
    
    if ($auto) {
        // Mostrar los datos en una tabla
        echo '<h1>Resultados de la Búsqueda</h1>';
        echo '<table class="table table-success table-bordered">';
        echo '<thead><tr><th>Patente</th><th>Marca</th><th>Modelo</th><th>DNI Dueño</th></tr></thead>';
        echo '<tbody>';
        
        echo '<tr>';
        echo '<td>' . htmlspecialchars($auto->getPatente()) . '</td>';
        echo '<td>' . htmlspecialchars($auto->getMarca()) . '</td>';
        echo '<td>' . htmlspecialchars($auto->getModelo()) . '</td>';
        echo '<td>' . htmlspecialchars($auto->getDniDuenio()) . '</td>';
        echo '</tr>';
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-danger" role="alert">No se encontró ningún auto con la patente proporcionada.</div>';
    }
} 

//botón para volver a la página anterior
echo '<a href="javascript:history.back()" class="btn btn-success mt-4">Volver</a>';
echo '</div>';
echo '</body>';


?>
