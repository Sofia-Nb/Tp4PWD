document.getElementById('formAutosPersona').addEventListener('submit', function(event) {
    var dni = document.getElementById('dni').value;
    var errorMessage = '';

    // Validaciones JavaScript
    if (!dni) {
        errorMessage = 'El campo es obligatorio.';
       
    }

    if (errorMessage) {
        event.preventDefault(); // Detener el envío del formulario
        document.getElementById('error-message').innerText = errorMessage;
    }
});
