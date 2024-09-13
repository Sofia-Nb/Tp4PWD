<?php
include_once '../../control/ControlAuto.php';
include_once '../../control/ControlPersona.php';
include_once '../../utils/datasubmited.php';
include_once '../../modelo/Persona.php';
include_once '../../modelo/Auto.php';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<link rel="stylesheet" href="../assets/css/error.css">';
echo '<body>';
echo '<div class="blurred-background" style="height: 740px;"></div>';
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
    echo '<div class="container" style="height: 740px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">';
    echo '<form style="background-color: #d2d0e1d5;">';
    echo "<h1>Datos cargados exitosamente!</h1>";
    echo '<table class="table table-dark table-bordered">';
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
        echo '<a href="javascript:history.back()" class="btn btn-secondary mt-4">Volver</a>';
        echo '</form>';
}else if(empty($persona)){
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-danger" role="alert">No existe una persona con el DNI ingresado.</div>';
    echo '<a href="javascript:history.back()" class="btn btn-secondary mt-4">Volver</a>';
}else{
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-danger" role="alert">El auto ingresado ya existe.</div>';
    echo '<a href="javascript:history.back()" class="btn btn-secondary mt-4">Volver</a>';
}
echo '</div>';
echo '</body>';