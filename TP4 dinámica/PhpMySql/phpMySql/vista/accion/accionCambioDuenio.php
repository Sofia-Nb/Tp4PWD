<?php
include_once '../../modelo/Persona.php';
include_once '../../modelo/Auto.php';
include_once '../../control/ControlPersona.php';
include_once '../../control/ControlAuto.php';
include_once '../../utils/datasubmited.php';

// $datos = $_POST; // Obtener los datos del formulario

$datos = dataSubmitted();
$dni = isset($datos['dni']) ? $datos['dni'] : null;
$patente = $datos['patente'];

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';
echo '<div class="container mt-4">';

if ($dni && $patente) {

    $objControlPersona = new ControlPersona();
    $objControlAuto = new ControlAuto();


    $persona = $objControlPersona->buscarPersonas(['NroDni' => $dni]);
    $auto = $objControlAuto->buscarAutoPorPatente($patente);

    if (!empty($persona) && $auto != null) {
        $persona = $persona[0];
        // Mostrar los datos de la persona en una tabla
        echo "<h1>Datos cargados exitosamente!</h1>";
        echo '<br>';
        echo '<form>';
        echo '<h1>Datos del nuevo dueño:</h1>';
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
        echo '</form>';
        echo '<br><br>';


        // Mostrar los datos del auto en una tabla
        echo '<form>';
        echo '<h1>Antiguos datos del auto:</h1>';
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
        echo '</form>';
        echo '<br><br>';


        $arregloAutoModificado = array (
            'Patente' => $auto->getPatente(),
            'Marca' => $auto->getMarca(),
            'Modelo' => $auto->getModelo(),
            'DniDuenio' => $persona->getNroDni()
        );
        $objControlAuto->modificarAuto($arregloAutoModificado);
        $nuevoAutoDuenio = $objControlAuto->buscarAutoPorPatente($patente);


        // Mostrar los datos del auto en una tabla
        echo '<form>';
        echo '<h1>Nuevos datos del auto:</h1>';
        echo '<table class="table table-success table-bordered">';
        echo '<thead><tr><th>Patente</th><th>Marca</th><th>Modelo</th><th>DNI Dueño</th></tr></thead>';
        echo '<tbody>';
        
        echo '<tr>';
        echo '<td>' . htmlspecialchars($nuevoAutoDuenio->getPatente()) . '</td>';
        echo '<td>' . htmlspecialchars($nuevoAutoDuenio->getMarca()) . '</td>';
        echo '<td>' . htmlspecialchars($nuevoAutoDuenio->getModelo()) . '</td>';
        echo '<td>' . htmlspecialchars($nuevoAutoDuenio->getDniDuenio()) . '</td>';
        echo '</tr>';
        
        echo '</tbody>';
        echo '</table>';
        echo '</form>';
    }else{
        echo '<div class="alert alert-danger" role="alert">Datos inexistentes.</div>';
    }
}
echo '<a href="javascript:history.back()" class="btn btn-primary mt-4">Volver</a>';
echo '</body';