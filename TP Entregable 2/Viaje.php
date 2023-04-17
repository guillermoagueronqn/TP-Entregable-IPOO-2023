<?php
/**Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos 
nombre, apellido, numero de documento y teléfono. 
El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. 
También se desea guardar la información de la persona responsable de realizar el viaje, 
para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. 
La clase Viaje debe hacer referencia al responsable de realizar el viaje.

Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. 
Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
De la misma forma cargue la información del responsable del viaje.*/

class Viaje {
    private $codigo;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $pasajeros;
    private $personaResponsable;

    /**
     * METODO constructor de la clase
     * @param int
     * @param string
     * @param int
     * @param array
     */
    public function __construct($cod, $dest, $cantMax, $pasaj, $pPersonaResponsable){
        $this -> codigo = $cod;
        $this -> destino = $dest;
        $this -> cantidadMaximaPasajeros = $cantMax;
        $this -> pasajeros = $pasaj;
        $this -> personaResponsable = $pPersonaResponsable;
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
         $this->getPersonaResponsable();
    }
}