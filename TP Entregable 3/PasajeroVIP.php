<?php
include_once("Pasajero.php");

class PasajeroVIP extends Pasajero {
    private $numeroViajeroFrecuente;
    private $cantidadMillas;

    /**
     * METODO constructor de la clase PasajeroVIP
     * @param string
     * @param string
     * @param int
     * @param int
     * @param int
     * @param int
     * @param int
     * @param int
     */
    public function __construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket, $vNumeroViajeroFrecuente, $vCantidadMillas){
        parent::__construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket);
        $this->numeroViajeroFrecuente = $vNumeroViajeroFrecuente;
        $this->cantidadMillas = $vCantidadMillas;
    }

    /**
     * METODO que retorna el numero de viajero frecuente del pasajero vip
     * @return int
     */
    public function getNumeroViajeroFrecuente(){
        return $this->numeroViajeroFrecuente;
    }

    /**
     * METODO que retorna el numero de millas del pasajero vip
     * @return int
     */
    public function getCantidadMillas(){
        return $this-> cantidadMillas;
    }

    /**
     * METODO que setea el numero de viajero frecuente del pasajero vip
     * @param int
     */
    public function setNumeroViajeroFrecuente($nuevoNumeroViajeroFrecuente){
        $this->numeroViajeroFrecuente = $nuevoNumeroViajeroFrecuente;
    }
    /**
     * METODO que setea el numero de millas del pasajero vip
     * @param int
     */
    public function setCantidadMillas($nuevaCantidadMillas){
        $this->cantidadMillas = $nuevaCantidadMillas;
    }

    /**
     * METODO que retorna un string con toda la informacion del pasajero vip
     */
    public function __toString(){
        return "PASAJERO VIP:\n" . parent::__toString() . "NUMERO DE VIAJERO FRECUENTE: " . $this->getNumeroViajeroFrecuente() . "\n" . 
        "CANTIDAD DE MILLAS DEL VIAJERO: " . $this->getCantidadMillas() . "\n";
    }

    /**Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas se realiza un incremento del 30%.*/
    public function darPorcentajeIncremento(){
        $porcentajePrevio = parent::darPorcentajeIncremento();
        $porcentajePrevio = $porcentajePrevio + 35;
        $millasAcumuladas = $this->getCantidadMillas();
        if ($millasAcumuladas > 300){
            $porcentajePrevio = 30;
        }
        return $porcentajePrevio;
    }
}