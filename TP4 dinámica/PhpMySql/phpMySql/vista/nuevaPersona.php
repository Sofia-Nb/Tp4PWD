<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/error.css">
    <title>Nueva Persona</title>
</head>
<body>
<div class="blurred-background"></div>
<div class="container" style="height: 1331px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">
<br>
    <h4>Crear una página “NuevaPersona.php” que contenga un formulario que permita solicitar todos los datos de una persona. Estos datos serán enviados a una página “accionNuevaPersona.php” que cargue un nuevo registro en la tabla persona de la base de datos. Se debe mostrar un mensaje que indique si se pudo o no cargar los datos de la persona. Utilizar css y validaciones javaScript cuando crea conveniente. Recordar usar la capa de control antes generada, no se puede acceder directamente a las clases del ORM.</h4><br>
    <form id="formNuevaPersona" style="background-color: #d2d0e1d5; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);" action="./accion/accionNuevaPersona.php" method="post">
    <h1>Ingrese una nueva persona:</h1>
    <br>
        <div class="form-group">
            <label for="dni">Ingrese un DNI:</label>
            <input type="text" id="dni" name="dni" class="form-control">
            <div id="error-message-dni" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="apellido">Ingrese un Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control">
            <div id="error-message-apellido" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="nombre">Ingrese un Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
            <div id="error-message-nombre" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="fechaNac">Ingrese una Fecha de nacimiento:</label>
            <input type="date" id="fechaNac" name="fechaNac" class="form-control">
            <div id="error-message-fechaNac" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="telefono">Ingrese un Télefono:</label>
            <input type="number" id="telefono" name="telefono" class="form-control">
            <div id="error-message-telefono" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="domicilio">Ingrese una Dirección:</label>
            <input type="text" id="domicilio" name="domicilio" class="form-control">
            <div id="error-message-domicilio" class="error-message"></div>
        </div>
        <button type="submit" class="btn btn-info">Cargar</button>
        <br>
        <a href="javascript:history.back()" class="btn btn-dark mt-4">Volver</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../vista/assets/js/error3.js"></script>
</body>
</html>
