<?php
include_once '../../modelo/Persona.php';
include_once '../../modelo/Auto.php';
include_once '../../control/ControlPersona.php';
include_once '../../control/ControlAuto.php';
include_once '../../utils/datasubmited.php';


$datos = dataSubmitted();
$dni = isset($datos['dni']) ? $datos['dni'] : null;

echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<script src="error.js"></script>';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';


// Verificar si se recibió el DNI
if ($dni) {
    // Crear una instancia de la clase ControlPersona
    $controlPersona = new ControlPersona();

    // Buscar la persona en la base de datos usando el DNI
    $persona = $controlPersona->buscarPersonas(['NroDni' => $dni]);

    if (!empty($persona)) {
        $persona = $persona[0]; // Obtener el primer resultado solo si existe
        echo '<div class="container" style="height: 1331px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">';
        echo '<br>';
        echo '<h1>Resultados de la Búsqueda</h1>';

        // Mostrar los datos de la persona en una tabla
        echo '<form style="background-color: #d2d0e1d5;">';
        echo '<h2>Datos de la Persona:</h2>';
        echo '<table class="table table-dark table-bordered">';
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
        echo '<form id="searchForm" action="ActualizarDatosPersona.php" method="post" style="background-color: #d2d0e1d5;">';
        echo '<h2>Modificar datos:</h2>';
        echo '<table class="table table-dark table-bordered">';
        echo '<thead><tr><th>Nro DNI</th><th>Apellido</th><th>Nombre</th><th>Fecha de Nacimiento</th><th>Teléfono</th><th>Domicilio</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td><input type="text" value="' . htmlspecialchars($persona->getNroDni()) . '" name="dni" class="form-control" readonly></td>';
        echo '<td><input type="text" id="nuevoApellido" name="nuevoApellido" class="form-control"></td>';
        echo '<td><input type="text" id="nuevoNombre" name="nuevoNombre" class="form-control"></td>';
        echo '<td><input type="date" id="nuevaFechaNac" name="nuevaFechaNac" class="form-control"></td>';
        echo '<td><input type="number" id="nuevoTelefono" name="nuevoTelefono" class="form-control"></td>';
        echo '<td><input type="text" id="nuevoDomicilio" name="nuevoDomicilio" class="form-control"></td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<button type="submit" class="btn btn-info">Cargar</button>';
        echo '</form>';


        // Crear una instancia de la clase ControlAuto
        $controlAuto = new ControlAuto();

        // Buscar los autos asociados al DNI de la persona
        $autos = $controlAuto->listar("DniDuenio = '$dni'");

        if (!empty($autos)) {
            // Mostrar los autos en una tabla
            echo '<h2>Autos Asociados:</h2>';
            echo '<table class="table table-dark table-bordered mt-3">';
            echo '<thead><tr><th>Patente</th><th>Marca</th><th>Modelo</th></tr></thead>';
            echo '<tbody>';

            foreach ($autos as $auto) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($auto->getPatente()) . '</td>';
                echo '<td>' . htmlspecialchars($auto->getMarca()) . '</td>';
                echo '<td>' . htmlspecialchars($auto->getModelo()) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">No hay autos asociados a este DNI.</div>';
        }




    } else {
        echo '<div class="container mt-4">';
        echo '<div class="alert alert-danger" role="alert">No se encontró ninguna persona con el DNI proporcionado.</div>';
    }
}
echo '<a href="javascript:history.back()" class="btn btn-secondary mt-4">Volver</a>';
echo '</div>';
echo '</body>';
