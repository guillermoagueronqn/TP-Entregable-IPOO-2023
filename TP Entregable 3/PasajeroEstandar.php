<?php
include_once("Pasajero.php");
class PasajeroEstandar extends Pasajero {
    /**
     * METODO constructor de la clase PasajeroEstandar
     * @param string
     * @param string
     * @param int
     * @param int
     * @param int
     * @param int
     */
    public function __construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket){
        parent::__construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket);
    }

    /**
     * METODO que retorna un string con toda la informacion del pasajero estandar
     */
    public function __toString(){
        return "PASAJERO ESTANDAR\n" . parent::__toString();
    }

    /**Por último, para los pasajeros comunes el porcentaje de incremento es del 10 %.*/
    public function darPorcentajeIncremento(){
        $porcentajePrevio = parent::darPorcentajeIncremento();
        $porcentajePrevio = $porcentajePrevio + 10;
        return $porcentajePrevio;   
    }
}