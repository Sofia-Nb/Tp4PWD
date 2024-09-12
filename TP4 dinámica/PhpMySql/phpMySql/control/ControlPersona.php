<?php


//no incluye la clase Persona

class ControlPersona
{

    // Método para agregar una nueva persona
    public function agregarPersona($datosPersona)
    {
        $persona = new Persona();
        $persona->setear($datosPersona['NroDni'], $datosPersona['Apellido'], $datosPersona['Nombre'], $datosPersona['fechaNac'], $datosPersona['Telefono'], $datosPersona['Domicilio']);

        if ($persona->insertar()) {
            return "Persona agregada correctamente.";
        } else {
            return "Error al agregar la persona.";
        }
    }

    // Método para modificar una persona existente
    public function modificarPersona($datosPersona)
    {
        $persona = new Persona();
        $persona->setear($datosPersona['NroDni'], $datosPersona['Apellido'], $datosPersona['Nombre'], $datosPersona['fechaNac'], $datosPersona['Telefono'], $datosPersona['Domicilio']);

        if ($persona->modificar()) {
            return "Persona modificada correctamente.";
        } else {
            return "Error al modificar la persona.";
        }
    }

    // Método para eliminar una persona
    public function eliminarPersona($dni)
    {
        $persona = new Persona();
        $persona->setear($dni, "", "", "", "", "");

        if ($persona->eliminar()) {
            return "Persona eliminada correctamente.";
        } else {
            return "Error al eliminar la persona.";
        }
    }

    // Método para buscar personas
    public function buscarPersonas($criteriosBusqueda)
    {
        $personas = Persona::listar($criteriosBusqueda);
        return $personas;
    }
}
