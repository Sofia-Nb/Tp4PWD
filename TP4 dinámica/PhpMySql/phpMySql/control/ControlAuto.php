<?php
// no lleva la clase auto   
class ControlAuto
{

    // Método para agregar un nuevo auto
    public function agregarAuto($datosAuto)
    {
        $auto = new Auto();
        $auto->setPatente($datosAuto['Patente']);
        $auto->setMarca($datosAuto['Marca']);
        $auto->setModelo($datosAuto['Modelo']);
        $auto->setDniDuenio($datosAuto['DniDuenio']);

        if ($auto->insertar()) {
            return "Auto agregado correctamente.";
        } else {
            return "Error al agregar el auto.";
        }
    }

    // Método para modificar un auto existente
    public function modificarAuto($datosAuto)
    {
        $auto = new Auto();
        $auto->setPatente($datosAuto['Patente']);
        $auto->setMarca($datosAuto['Marca']);
        $auto->setModelo($datosAuto['Modelo']);
        $auto->setDniDuenio($datosAuto['DniDuenio']);

        if ($auto->modificar()) {
            return "Auto modificado correctamente.";
        } else {
            return "Error al modificar el auto.";
        }
    }

    // Método para eliminar un auto
    public function eliminarAuto($patente)
    {
        $auto = new Auto();
        $auto->setPatente($patente);

        if ($auto->eliminar()) {
            return "Auto eliminado correctamente.";
        } else {
            return "Error al eliminar el auto.";
        }
    }

    // Método para buscar un auto por patente
    public function buscarAutoPorPatente($patente)
    {
        $where = "Patente = '$patente'";
        $autos = Auto::listar($where);

        // Asumimos que solo debe haber un auto con esta patente
        if (count($autos) > 0) {
            return $autos[0]; // Devuelve solo el primer (y único) auto
        } else {
            return null; // Si no se encuentra el auto
        }
    }

    public function listar($where = "") {
        return Auto::listar($where);
    }
}
