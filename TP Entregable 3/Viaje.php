<?php

class Viaje {
    private $codigo;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $pasajeros;
    private $personaResponsable;
    private $costoViaje;
    private $sumaCostosAbonados;

    /**
     * METODO constructor de la clase
     * @param int
     * @param string
     * @param int
     * @param array
     */
    public function __construct($cod, $dest, $cantMax, $pasaj, $pPersonaResponsable, $pCostoViaje){
        $this -> codigo = $cod;
        $this -> destino = $dest;
        $this -> cantidadMaximaPasajeros = $cantMax;
        $this -> pasajeros = $pasaj;
        $this -> personaResponsable = $pPersonaResponsable;
        $this -> costoViaje = $pCostoViaje;
        $this -> sumaCostosAbonados = 0;
    }

    /**
     * METODO para obtener el valor del codigo del viaje
     * @return int
     */
    public function getCodigo (){
        return $this -> codigo;
    }

    /**
     * METODO para obtener el destino del viaje
     * @return string
     */
    public function getDestino (){
        return $this -> destino;
    }

    /**
     * METODO para obtener la cantidad maxima de pasajeros del viaje
     * @return int
     */
    public function getCantidadMaximaPasajeros (){
        return $this -> cantidadMaximaPasajeros;
    }

    /**
     * METODO para obtener un array con los datos de los pasajeros
     * @return array
     */
    public function getPasajeros (){
        return $this -> pasajeros;
    }

    /**
     * METODO para obtener un objeto con los datos de la persona responsable
     * @return object
     */
    public function getPersonaResponsable (){
        return $this -> personaResponsable;
    }

    /**
     *  METODO para obtener el costo del viaje
     * @return int
     */
    public function getCostoViaje(){
        return $this->costoViaje;
    }

    /**
     * METODO para obtener el total de los costos abonados por los pasajeros
     * @return int
     */
    public function getSumaCostosAbonados(){
        return $this->sumaCostosAbonados;
    }

    /**
     * METODO para setear el codigo del viaje
     * @param int
     */
    public function setCodigo ($nuevoCodigo){
        $this -> codigo = $nuevoCodigo;
    }

    /**
     * METODO para setear el destino del viaje
     * @param string
     */
    public function setDestino ($nuevoDestino){
        $this -> destino = $nuevoDestino;
    }

    /**
     * METODO para setear la cantidad maxima de pasajeros del viaje
     * @param int
     */
    public function setCantidadMaximaPasajeros ($nuevaCantidadMaxima){
        $this -> cantidadMaximaPasajeros = $nuevaCantidadMaxima;
    }

    /**
     * METODO para setear los pasajeros del viaje
     * @param array
     */
    public function setPasajeros ($nuevosPasajeros){
        $this -> pasajeros = $nuevosPasajeros;
    }

    /**
     * METODO para setear la persona responsable del viaje
     * @param object
     */
    public function setPersonaResponsable ($nuevaPersonaResponsable){
        $this -> personaResponsable = $nuevaPersonaResponsable;
    }

    /**
     * METODO para setear el costo del viaje
     * @param int
     */
    public function setCostoViaje($nuevoCostoViaje){
        $this->costoViaje = $nuevoCostoViaje;
    }

    /**
     * METODO para setear la suma total de los costos abonados por los pasajeros
     * @param int
     */
    public function setSumaCostosAbonados($nuevaSumaCostosAbonados){
        $this->sumaCostosAbonados = $nuevaSumaCostosAbonados;
    }

    /**
     * METODO para agregar un nuevo pasajero los que ya existian
     * @param array $pasajeroNuevo
     */
    public function agregarPasajero ($pasajeroNuevo){
        $cantElementosPasajeros = count($this->getPasajeros());
        $arrayActual = $this->getPasajeros();
        $arrayActual[$cantElementosPasajeros] = $pasajeroNuevo;
        $this -> setPasajeros($arrayActual);
    }

    /**
     * METODO que retorna toda la información de los pasajeros
     * @return string
     */
    public function retornaInfoPasajeros (){
        $informacionPasajeros = "";
        $elemPasajeros = count($this->getPasajeros());
        for ($i=0; $i < $elemPasajeros; $i++){
            $informacionPasajeros = $informacionPasajeros . "\n" . $this->getPasajeros()[$i] . "\n";
        }
        return $informacionPasajeros;
    }
    /**
     * METODO que retorna en un string toda la informacion del viaje
     */
    public function __toString(){
        return "El CODIGO DEL VIAJE es: " . $this->getCodigo() . "\n" .
         "El DESTINO DEL VIAJE es: " . $this->getDestino() . "\n" .
         "La CANTIDAD MAXIMA DE PASAJEROS DEL VIAJE es: " . $this->getCantidadMaximaPasajeros() . "\n" .
         "Información de los pasajeros: \n\n" . 
         $this->retornaInfoPasajeros() . "\n\n" . 
         "Información de la persona responsable: \n" . 
         $this->getPersonaResponsable() . "\n" .
         "COSTO DEL VIAJE: " . $this->getCostoViaje() . "\n" . 
         "SUMA DE COSTOS ABONADOS: " . $this->getSumaCostosAbonados() . "\n";
    }

    /**implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a 
     * la colección de pasajeros ( solo si hay espacio disponible),
     * actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero. */
    public function venderPasaje($objPasajero){
        $hayPasaje = $this->hayPasajesDisponible();
        if ($hayPasaje){
            $this->agregarPasajero($objPasajero);
            $porcentajeIncremento = $objPasajero->darPorcentajeIncremento();
            $costoViajeAPasajero = $this->getCostoViaje() + (($this->getCostoViaje()*$porcentajeIncremento)/100);
            $sumaDeCostos = $this->getSumaCostosAbonados();
            $sumaDeCostos = $sumaDeCostos + $costoViajeAPasajero;
            $this->setSumaCostosAbonados($sumaDeCostos);
        } else {
            $costoViajeAPasajero = 0;
        }
        return $costoViajeAPasajero;
    }

    /**Implemente la función hayPasajesDisponible()
     * que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad
     * máxima de pasajeros y falso caso contrario */
    public function hayPasajesDisponible(){
        $arregloPasajerosActual = $this->getPasajeros();
        $cantidadPasajeros = count($arregloPasajerosActual);
        $cantidadMaximaPasajeros = $this->getCantidadMaximaPasajeros();
        if ($cantidadPasajeros < $cantidadMaximaPasajeros){
            $hayPasajeDisponible = true;
        } else {
            $hayPasajeDisponible = false;
        }
        return $hayPasajeDisponible;
    }
}