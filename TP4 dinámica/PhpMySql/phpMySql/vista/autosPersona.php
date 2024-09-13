<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/error.css">
    <title>Buscar Persona</title>
</head>
<body>
<div class="blurred-background" style="height: 740px;"></div>
<div class="container" style="height: 740px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">
<br>
    <h3> Crear una página “autosPersona.php” que recibe un dni de una persona y muestra
los datos de la persona y un listado de los autos que tiene asociados. Recordar usar la capa de control antes
generada, no se puede acceder directamente a las clases del ORM.</h3><br>
    <form id="formAutosPersona" style="background-color: #d2d0e1d5; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);" action="./accion/accionBuscarPersona.php" method="post" >
    <h1>Buscar Autos asociados a personas por DNI</h1>
        <div class="form-group">
            <label for="dni"></label>
            <input type="text" id="dni" name="dni" class="form-control" placeholder="Ingrese documento" >
            <div id="error-message" class="error-message"></div>
        </div>
        <button type="submit" class="btn btn-info">Buscar</button>
        <br>
        <a href="./listaPersonas.php" class="btn btn-dark mt-4">Volver a la lista</a>
        <a href="../../../menu.html" class="btn btn-dark mt-4">Volver al menu</a>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../vista/assets/js/error2.js"></script>
</body>
</html>
