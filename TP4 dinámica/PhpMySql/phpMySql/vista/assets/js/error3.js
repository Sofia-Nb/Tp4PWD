document.getElementById('formNuevaPersona').addEventListener('submit', function(event) {
    var dni = document.getElementById('dni').value;
    var apellido = document.getElementById('apellido').value;
    var nombre = document.getElementById('nombre').value;
    var fecha = document.getElementById('fechaNac').value;
    var telefono = document.getElementById('telefono').value;
    var direccion = document.getElementById('domicilio').value;

    var hasErrors = false;

    // Limpiar mensajes de error anteriores
    document.getElementById('error-message-dni').innerText = '';
    document.getElementById('error-message-apellido').innerText = '';
    document.getElementById('error-message-nombre').innerText = '';
    document.getElementById('error-message-fechaNac').innerText = '';
    document.getElementById('error-message-telefono').innerText = '';
    document.getElementById('error-message-domicilio').innerText = '';

    // Validaciones JavaScript
    if (!dni) {
        document.getElementById('error-message-dni').innerText = 'El DNI es obligatorio.';
        hasErrors = true;
    }
    if (!apellido) {
        document.getElementById('error-message-apellido').innerText = 'El apellido es obligatorio.';
        hasErrors = true;
    }
    if (!nombre) {
        document.getElementById('error-message-nombre').innerText = 'El nombre es obligatorio.';
        hasErrors = true;
    }
    if (!fecha) {
        document.getElementById('error-message-fechaNac').innerText = 'La fecha de nacimiento es obligatoria.';
        hasErrors = true;
    }
    if (!telefono) {
        document.getElementById('error-message-telefono').innerText = 'El teléfono es obligatorio.';
        hasErrors = true;
    }
    if (!direccion) {
        document.getElementById('error-message-domicilio').innerText = 'La dirección es obligatoria.';
        hasErrors = true;
    }

    // Previene el envío del formulario si hay errores
    if (hasErrors) {
        event.preventDefault();
    }
});

