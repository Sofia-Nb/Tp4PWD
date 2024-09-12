document.getElementById('formCambioDuenio').addEventListener('submit', function(event) {
    var patente = document.getElementById('patente').value;
    var dni = document.getElementById('dni').value;
    var hasErrors = false;
    var errorMessage = '';

    document.getElementById('error-message-patente').innerText = '';
    document.getElementById('error-message-dni').innerText = '';

    // Validaciones JavaScript
    if (!patente) {
        document.getElementById('error-message-patente').innerText = 'La patente es obligatoria.';
        hasErrors = true;
    }
    if (!dni) {
        document.getElementById('error-message-dni').innerText = 'El DNI es obligatorio.';
        hasErrors = true;
    }

    if (hasErrors) {
        event.preventDefault();
    }
});
