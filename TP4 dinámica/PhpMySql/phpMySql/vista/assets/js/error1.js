document.getElementById('searchForm').addEventListener('submit', function(event) {
    var patente = document.getElementById('patente').value;
    var errorMessage = '';

    // Validaciones JavaScript
    if (!patente) {
        errorMessage = 'El campo número de patente es obligatorio.';
       
    }

    if (errorMessage) {
        event.preventDefault(); // Detener el envío del formulario
        document.getElementById('error-message').innerText = errorMessage;
    }
});
