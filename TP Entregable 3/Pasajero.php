<?php
/**Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos 
nombre, apellido, numero de documento y teléfono.*/

class Pasajero {
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;
    private $numeroAsiento;
    private $numeroTicket;

    /**
     * METODO constructor de la clase pasajero
     * @param string
     * @param string
     * @param int
     * @param int
     */
    public function __construct($pNombre, $pApellido, $pNroDocumento, $pTelefono, $pNumeroAsiento, $pNumeroTicket){
        $this -> nombre = $pNombre;
        $this -> apellido = $pApellido;
        $this -> nroDocumento = $pNroDocumento;
        $this -> telefono = $pTelefono;
        $this -> numeroAsiento = $pNumeroAsiento;
        $this -> numeroTicket = $pNumeroTicket;

    }

    /**
     * METODO para obtener el nombre del pasajero
     * @return string
     */
    public function getNombre (){
        return $this -> nombre;
    }

    /**
     * METODO para obtener el apellido del pasajero
     * @return string
     */
    public function getApellido (){
        return $this -> apellido;
    }

    /**
     * METODO para obtener el numero de documento del pasajero
     * @return int
     */
    public function getNroDocumento (){
        return $this -> nroDocumento;
    }

    /**
     * METODO para obtener el telefono del pasajero
     * @return int
     */
    public function getTelefono (){
        return $this -> telefono;
    }

    /**
     * METODO para obtener el numero de asiento
     * @return int
     */
    public function getNumeroAsiento(){
        return $this -> numeroAsiento;
    }

    /**
     *  METODO para obtener el numero de ticket
     * @return int
     */
    public function getNumeroTicket(){
        return $this -> numeroTicket;
    }

    /**
     * METODO para setear el nombre del pasajero
     * @param string
     */
    public function setNombre ($nuevoNombre){
        $this -> nombre = $nuevoNombre;
    }

    /**
     * METODO para setear el apellido del pasajero
     * @param string
     */
    public function setApellido ($nuevoApellido){
        $this -> apellido = $nuevoApellido;
    }

    /**
     * METODO para setear el numero de documento del pasajero
     * @param int
     */
    public function setNroDocumento ($nuevoNroDocumento){
        $this -> nroDocumento = $nuevoNroDocumento;
    }

    /**
     * METODO para setear el telefono del pasajero
     * @param int
     */
    public function setTelefono ($nuevoTelefono){
        $this -> telefono = $nuevoTelefono;
    }

    /**
     * METODO para setear el numero de asiento
     * @param int
     */
    public function setNumeroAsiento($nuevoNumeroAsiento){
        $this -> numeroAsiento = $nuevoNumeroAsiento;
    }

    /**
     * METODO para setear el numero de ticket
     * @param int
     */
    public function setNumeroTicket($nuevoNumeroTicket){
        $this -> numeroTicket = $nuevoNumeroTicket;
    }

    /**
     * METODO que retorna un string con toda la información del pasajero
     */
    public function __toString(){
        return "INFORMACIÓN DEL PASAJERO:\n" . 
        "NOMBRE: " . $this->getNombre() . "\n" . 
        "APELLIDO: " . $this->getApellido() . "\n" . 
        "NUMERO DE DOCUMENTO: " . $this->getNroDocumento() . "\n" . 
        "TELEFONO: " . $this->getTelefono() . "\n" . 
        "NUMERO DE ASIENTO: " . $this->getNumeroAsiento() . "\n" . 
        "NUMERO DE TICKET: " . $this->getNumeroTicket() . "\n";
    }

    /**
     * Implementar el método darPorcentajeIncremento() que retorne el porcentaje que debe aplicarse como incremento según las características del pasajero.
     */
    public function darPorcentajeIncremento(){
        $porcentajeIncremento = 0;
        return $porcentajeIncremento;
    }
}