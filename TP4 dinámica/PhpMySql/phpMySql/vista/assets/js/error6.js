document.getElementById('searchForm').addEventListener('submit', function(event) {
    var dni = document.getElementById('dni').value;
    var hasErrors = false;
    var errorMessage = '';

    document.getElementById('error-message-dni').innerText = '';

    // Validaciones JavaScript
    if (!dni) {
        document.getElementById('error-message-dni').innerText = 'El campo es obligatorio.';
        hasErrors = true;
    }

    if (hasErrors) {
        event.preventDefault();
    }
});
