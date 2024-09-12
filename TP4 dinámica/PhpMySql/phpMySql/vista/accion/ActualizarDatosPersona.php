<?php
include_once '../../modelo/Persona.php';
include_once '../../control/ControlPersona.php';
include_once '../../utils/datasubmited.php';

$datos = dataSubmitted();

$dni = isset($datos['dni']) ? $datos['dni'] : null;
$apellido = $datos['nuevoApellido'];
$nombre = $datos['nuevoNombre'];
$fechaNac = $datos['nuevaFechaNac'];
$telefono = $datos['nuevoTelefono'];
$domicilio = $datos['nuevoDomicilio'];

$arregloNuevaPersona = array (
    'NroDni' => $dni,
    'Apellido' => $apellido, 
    'Nombre' => $nombre, 
    'fechaNac' => $fechaNac, 
    'Telefono' => $telefono, 
    'Domicilio' => $domicilio
);

$objControlPersona = new ControlPersona();
$objControlPersona->modificarPersona($arregloNuevaPersona);
$persona = $objControlPersona->buscarPersonas(['NroDni' => $dni]);


if (!empty($persona)) {
    $persona = $persona[0];
    // Incluye Bootstrap CSS
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';
echo '<div class="container mt-4">';
        echo '<form>';
        echo '<h2>Nuevos datos de la Persona:</h2>';
        echo '<table class="table table-success table-bordered">';
        echo '<thead><tr><th>Nro DNI</th><th>Apellido</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Teléfono</th><th>Domicilio</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . htmlspecialchars($persona->getNroDni()) . '</td>';
        echo '<td>' . htmlspecialchars($persona->getApellido()) . '</td>';
        echo '<td>' . htmlspecialchars($persona->getNombre()) . '</td>';
        echo '<td>' . htmlspecialchars($persona->getFechaNac()) . '</td>';
        echo '<td>' . htmlspecialchars($persona->getTelefono()) . '</td>';
        echo '<td>' . htmlspecialchars($persona->getDomicilio()) . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<a href="javascript:history.back()" class="btn btn-primary mt-4">Volver</a>';
        echo '</form>';
        echo '<br><br>';
        echo '</div>';
}
echo '</body>';