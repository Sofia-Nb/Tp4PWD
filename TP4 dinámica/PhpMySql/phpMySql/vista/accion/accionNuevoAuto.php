<?php
include_once '../../control/ControlAuto.php';
include_once '../../control/ControlPersona.php';
include_once '../../utils/datasubmited.php';
include_once '../../modelo/Persona.php';
include_once '../../modelo/Auto.php';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background"></div>';
echo '<div class="container mt-4">';
$datos = dataSubmitted();
$objControlAuto = new ControlAuto();
$objControlPersona = new ControlPersona();
$patente = $datos['patente'];
$marca = $datos['marca'];
$modelo = $datos['modelo'];
$dniDuenio = isset($datos['dniDuenio']) ? $datos['dniDuenio'] : null;


$auto = $objControlAuto->buscarAutoPorPatente($patente);
$persona = $objControlPersona->buscarPersonas(['NroDni' => $dniDuenio]);

if ((!empty($persona)) && ($auto == null)){
    $arregloAuto = array (
        'Patente' => $patente,
        'Marca' => $marca,
        'Modelo' => $modelo,
        'DniDuenio' => $dniDuenio,
    );
    $objControlAuto->agregarAuto($arregloAuto);
    $objAuto = $objControlAuto->buscarAutoPorPatente($patente);
    echo '<form>';
    echo "<h1>Datos cargados exitosamente!</h1>";
    echo '<table class="table table-success table-bordered">';
        echo '<thead><tr><th>Patente</th><th>Marca</th><th>Modelo</th><th>DNI del Dueño</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . htmlspecialchars($objAuto->getPatente()) . '</td>';
        echo '<td>' . htmlspecialchars($objAuto->getMarca()) . '</td>';
        echo '<td>' . htmlspecialchars($objAuto->getModelo()) . '</td>';
        echo '<td>' . htmlspecialchars($objAuto->getDniDuenio()) . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<a href="javascript:history.back()" class="btn btn-primary mt-4">Volver</a>';
        echo '</form>';
        echo '</div>';
}else if(empty($persona)){
    echo '<div class="alert alert-danger" role="alert">No existe una persona con el DNI ingresado.</div>';
}else{
    echo '<div class="alert alert-danger" role="alert">El auto ingresado ya existe.</div>';
}
echo '</body>';