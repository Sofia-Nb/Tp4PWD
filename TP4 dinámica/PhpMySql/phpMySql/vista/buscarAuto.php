
<!-- buscarAuto.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/error.css">
    <title>Buscar Auto</title>

</head>
<body>
<div class="blurred-background" style="height: 740px;"></div>
<div class="container" style="height: 740px; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15); background-color: #c6c2decc;">
<br>
<h3>Crear una pagina "buscarAuto.php" que contenga un formulario en donde se solicite el numero
de patente de un auto, estos datos deberán ser enviados a una pagina “accionBuscarAuto.php” en donde
usando la clase de control correspondiente, se soliciten los datos completos del auto que se corresponda con
la patente ingresada y mostrar los datos en una tabla.</h3><br>
        <form id="searchForm" style="background-color: #d2d0e1d5; box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.15);" action="./accion/accionBuscarAuto.php" method="post">
        <h1>Buscar Auto por Patente</h1>
        <div class="form-group">
                <label for="patente">Ingrese el número de Patente:</label>
                <input type="text" id="patente" name="patente" class="form-control" >
                <div id="error-message" class="error-message"></div>
            </div>
            <button type="submit" class="btn btn-info">Buscar</button>
            <br>
            <a href="javascript:history.back()" class="btn btn-dark mt-4">Volver</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../vista/assets/js/error1.js"></script>

</body>
</html>
