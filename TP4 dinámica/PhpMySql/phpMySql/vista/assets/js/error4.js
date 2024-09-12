document.getElementById('formNuevoAuto').addEventListener('submit', function(event) {
    var patente = document.getElementById('patente').value;
    var marca = document.getElementById('marca').value;
    var modelo = document.getElementById('modelo').value;
    var dniDuenio = document.getElementById('dniDuenio').value;


    var hasErrors = false;

    // Limpiar mensajes de error anteriores
    document.getElementById('error-message-patente').innerText = '';
    document.getElementById('error-message-marca').innerText = '';
    document.getElementById('error-message-modelo').innerText = '';
    document.getElementById('error-message-dniDuenio').innerText = '';

    // Validaciones JavaScript
    if (!patente) {
        document.getElementById('error-message-patente').innerText = 'La patente es obligatoria.';
        hasErrors = true;
    }
    if (!marca) {
        document.getElementById('error-message-marca').innerText = 'La marca es obligatoria.';
        hasErrors = true;
    }
    if (!modelo) {
        document.getElementById('error-message-modelo').innerText = 'El modelo es obligatorio.';
        hasErrors = true;
    }
    if (!dniDuenio) {
        document.getElementById('error-message-dniDuenio').innerText = 'El DNI es obligatorio.';
        hasErrors = true;
    }

    // Previene el envío del formulario si hay errores
    if (hasErrors) {
        event.preventDefault();
    }
});

