<?php
include_once '../../control/ControlPersona.php';
include_once '../../utils/datasubmited.php';
include_once '../../modelo/Persona.php';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';
echo '<div class="container mt-4">';
$objControlPersona = new ControlPersona();
$datos = dataSubmitted();
$apellido = $datos['apellido'];
$nombre = $datos['nombre'];
$fechaNac = $datos['fechaNac'];
$telefono = $datos['telefono'] ;
$direccion = $datos['domicilio'] ?? '';

$dni = isset($datos['dni']) ? $datos['dni'] : null;
$persona = $objControlPersona->buscarPersonas(['NroDni' => $dni]);

if (empty($persona)){
    $arregloNuevaPersona = array(
        'NroDni' => $dni,
        'Apellido' => $apellido,
        'Nombre' => $nombre,
        'fechaNac' => $fechaNac,
        'Telefono' => $telefono,
        'Domicilio' => $direccion,
    );    
    $objControlPersona->agregarPersona($arregloNuevaPersona);
    $nuevaPersona = $objControlPersona->buscarPersonas(['NroDni' => $dni]);
foreach ($nuevaPersona as $objPersona){
    echo '<form>';
    echo "<h1>Datos cargados exitosamente!</h1>";
    echo "<br><br>";
    echo '<table class="table table-success table-bordered">';
        echo '<thead><tr><th>NroDni</th><th>Apellido</th><th>Nombre</th><th>fechaNac</th><th>Telefono</th><th>Domicilio</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . htmlspecialchars($objPersona->getNroDni()) . '</td>';
        echo '<td>' . htmlspecialchars($objPersona->getApellido()) . '</td>';
        echo '<td>' . htmlspecialchars($objPersona->getNombre()) . '</td>';
        echo '<td>' . htmlspecialchars($objPersona->getFechaNac()) . '</td>';
        echo '<td>' . htmlspecialchars($objPersona->getTelefono()) . '</td>';
        echo '<td>' . htmlspecialchars($objPersona->getDomicilio()) . '</td>';
        echo '</tr>';
        
        echo '</tbody>';
        echo '</table>';
        echo '<br>';
        echo '<a href="javascript:history.back()" class="btn btn-primary mt-4">Volver</a>';
        echo '</form>';
        echo '</div>';
}

}else{
    echo '<div class="alert alert-danger" role="alert">La persona ingresada ya está cargada en la base de datos.</div>';
}
echo '</body>';
