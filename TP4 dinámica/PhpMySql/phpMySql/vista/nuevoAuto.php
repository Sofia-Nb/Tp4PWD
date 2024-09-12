<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/error.css">
    <title>Nuevo Auto</title>
</head>
<body>
<div class="blurred-background"></div>
<div class="container mt-4">
    <h4>Crear una página “NuevoAuto.php” que contenga un formulario en el que se permita cargar
todos los datos de un auto (incluso su dueño). Estos datos serán enviados a una página
“accionNuevoAuto.php” que cargue un nuevo registro en la tabla auto de la base de datos. Se debe chequear
antes que la persona dueña del auto ya se encuentre cargada en la base de datos, de no ser así mostrar un
link a la página que permite carga una nueva persona. Se debe mostrar un mensaje que indique si se pudo o
no cargar los datos Utilizar css y validaciones javaScript cuando crea conveniente. Recordar usar la capa de
control antes generada, no se puede acceder directamente a las clases del ORM.</h4><br>
    <form id="formNuevoAuto" action="./accion/accionNuevoAuto.php" method="post">
    <h1>Ingrese un nuevo auto:</h1>
    <br>
        <div class="form-group">
            <label for="patente">Ingrese una Patente:</label>
            <input type="text" id="patente" name="patente" class="form-control">
            <div id="error-message-patente" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="marca">Ingrese una Marca:</label>
            <input type="text" id="marca" name="marca" class="form-control">
            <div id="error-message-marca" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="modelo">Ingrese un Modelo:</label>
            <input type="text" id="modelo" name="modelo" class="form-control">
            <div id="error-message-modelo" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="dniDuenio">Ingrese el DNI del dueño:</label>
            <input type="text" id="dniDuenio" name="dniDuenio" class="form-control">
            <div id="error-message-dniDuenio" class="error-message"></div>
        </div>
        <button type="submit" class="btn btn-success">Cargar</button>
        <br>
        <a href="nuevaPersona.php" class="btn btn-success mt-4">Cargar una persona</a>
    <br>
    <a href="javascript:history.back()" class="btn btn-primary mt-4">Volver</a>
    </form>
</div>
<br><br><br><br>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../vista/assets/js/error4.js"></script>
</body>
</html>