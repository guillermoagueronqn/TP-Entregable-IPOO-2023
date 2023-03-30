<?php
/**
*La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes.
*De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
*Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos 
*de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros.
*Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.
*Implementar un script testViaje.php que cree una instancia de la clase Viaje
*y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.
*/

class Viaje {
    private $codigo;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $pasajeros;

    /**
     * METODO constructor de la clase
     * @param int
     * @param string
     * @param int
     * @param array
     */
    public function __construct($cod, $dest, $cantMax, $pasaj){
        $this -> codigo = $cod;
        $this -> destino = $dest;
        $this -> cantidadMaximaPasajeros = $cantMax;
        $this -> pasajeros = $pasaj;
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
     * METODO para agregar un nuevo pasajero los que ya existian
     * @param array $pasajeroNuevo
     */
    public function agregarPasajero ($pasajeroNuevo){
        $cantElementosPasajeros = count($this->getPasajeros());
        $arrayActual = $this->getPasajeros();
        $arrayActual[$cantElementosPasajeros]["nombre"] = $pasajeroNuevo["nombre"];
        $arrayActual[$cantElementosPasajeros]["apellido"] = $pasajeroNuevo["apellido"];
        $arrayActual[$cantElementosPasajeros]["dni"] = $pasajeroNuevo["dni"];
        $this -> setPasajeros($arrayActual);
    }

    /**
     * METODO que retorna en un string toda la informacion del viaje
     */
    public function __toString(){
        $informacionPasajeros = "";
        $elemPasajeros = count($this->getPasajeros());
        for ($i=0; $i<$elemPasajeros; $i++){
            $informacionPasajeros = $informacionPasajeros . "PASAJERO N°" . $i+1 . "\n" .
            "NOMBRE: " . $this->getPasajeros()[$i]["nombre"] . "\n" .
            "APELLIDO: " . $this ->getPasajeros()[$i]["apellido"] . "\n" . 
            "DNI: " . $this->getPasajeros()[$i]["dni"] . "\n\n"; 
        }
        return "El CODIGO DEL VIAJE es: " . $this->getCodigo() . "\n" .
         "El DESTINO DEL VIAJE es: " . $this->getDestino() . "\n" .
         "La CANTIDAD MAXIMA DE PASAJEROS DEL VIAJE es: " . $this->getCantidadMaximaPasajeros() . "\n" .
         "Información de los pasajeros: \n\n" . 
         $informacionPasajeros;
    }
}