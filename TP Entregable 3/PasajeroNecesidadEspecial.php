<?php
include_once("Pasajero.php");
/**La clase Pasajeros con necesidades especiales se refiere a pasajeros que pueden requerir
 * servicios especiales como sillas de ruedas, asistencia para el embarque o desembarque, 
 * o comidas especiales para personas con alergias o restricciones alimentarias.  */

class PasajeroNecesidadEspecial extends Pasajero {
    private $requiereSillaDeRuedas;
    private $requiereAsistencia;
    private $requiereComidaEspecial;

    /**
     * METODO constructor de la clase PasajeroNecesidadEspecial
     * @param string
     * @param string
     * @param int
     * @param int
     * @param int
     * @param int
     * @param string
     * @param string
     * @param string
     */
    public function __construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket, $vRequiereSillaDeRuedas, $vRequiereAsistencia, $vRequiereComidaEspecial){
        parent::__construct($vNombre, $vApellido, $vNroDocumento, $vTelefono, $vNumeroAsiento, $vNumeroTicket);
        $this->requiereSillaDeRuedas = $vRequiereSillaDeRuedas;
        $this->requiereAsistencia = $vRequiereAsistencia;
        $this->requiereComidaEspecial = $vRequiereComidaEspecial;
    }

    /**
     * METODO que retorna si el pasajero requiere silla de ruedas
     * @return string
     */
    public function getRequiereSillaDeRuedas(){
        return $this->requiereSillaDeRuedas;
    }
    /**
     * METODO que retorna si el pasajero requiere asistencia en el embarque o desembarque
     * @return string
     */
    public function getRequiereAsistencia(){
        return $this->requiereAsistencia;
    }
    /**
     * METODO que retorna si el pasajero requiere comida especial
     * @return string
     */
    public function getRequiereComidaEspecial(){
        return $this->requiereComidaEspecial;
    }

    /**
     * METODO que setea si el pasajero requiere silla de ruedas
     * @param string
     */
    public function setRequiereSillaDeRuedas($nuevoRequiereSillaDeRuedas){
        $this->requiereSillaDeRuedas = $nuevoRequiereSillaDeRuedas;
    }
    /**
     * METODO que setea si el pasajero requiere asistencia en el embarque o desembarque
     * @param string
     */
    public function setRequiereAsistencia($nuevoRequiereAsistencia){
        $this->requiereAsistencia = $nuevoRequiereAsistencia;
    }
    /**
     * METODO que setea si el pasajero requiere comida especial
     * @param string
     */
    public function setRequiereComidaEspecial($nuevoRequiereComidaEspecial){
        $this->requiereComidaEspecial = $nuevoRequiereComidaEspecial;
    }

    /**
     * METODO que retorna un string con toda la informacion del pasajero con necesidades especiales
     */
    public function __toString(){
        return "INFORMACION DEL PASAJERO CON NECESIDADES ESPECIALES:\n" . parent::__toString() . "REQUIERE SILLA DE RUEDAS: " . $this->getRequiereSillaDeRuedas() . "\n" . 
        "REQUIERE ASISTENCIA PARA EL EMBARQUE O DESEMBARQUE: " . $this->getRequiereAsistencia() . "\n" . 
        "REQUIERE COMIDA ESPECIAL: " . $this->getRequiereComidaEspecial() . "\n";
    }

    /**Si el pasajero tiene necesidades especiales y requiere silla de ruedas, asistencia y comida especial
     *  entonces el pasaje tiene un incremento del 30%; si solo requiere uno de los servicios
     *  prestados entonces el incremento es del 15%. */
    public function darPorcentajeIncremento(){
        $porcentajePrevio = parent::darPorcentajeIncremento();
        $requiereComidaEspecial = $this->getRequiereComidaEspecial();
        $requiereSillaDeRuedas = $this->getRequiereSillaDeRuedas();
        $requiereAsistencia = $this->getRequiereAsistencia();
        $contadorDeRequerimientos = 0;
        if($requiereSillaDeRuedas == "si"){
            $contadorDeRequerimientos = $contadorDeRequerimientos + 1;
        }
        if($requiereAsistencia == "si"){
            $contadorDeRequerimientos = $contadorDeRequerimientos + 1;
        }
        if($requiereComidaEspecial == "si"){
            $contadorDeRequerimientos = $contadorDeRequerimientos + 1;
        }
        if ($contadorDeRequerimientos == 1){
            $porcentajePrevio = $porcentajePrevio + 15;
        } elseif ($contadorDeRequerimientos == 2 || $contadorDeRequerimientos == 3){
            $porcentajePrevio = $porcentajePrevio + 30;
        }
        return $porcentajePrevio;
    }
}