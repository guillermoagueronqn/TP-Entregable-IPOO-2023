<?php 
/**También se desea guardar la información de la persona responsable de realizar el viaje, 
para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. */

class ResponsableV {
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;

    /**
     * METODO contructor de la clase ResponsableV
     * @param int
     * @param int
     * @param string
     * @param string
     */
    public function __construct($pNumeroEmpleado, $pNumeroLicencia, $pNombre, $pApellido){
        $this -> numeroEmpleado = $pNumeroEmpleado;
        $this -> numeroLicencia = $pNumeroLicencia;
        $this -> nombre = $pNombre;
        $this -> apellido = $pApellido;
    }

    /**
     * METODO para obtener el numero de empleado del responsable del viaje
     * @return int
     */
    public function getNumeroEmpleado (){
        return $this -> numeroEmpleado;
    }

    /**
     * METODO para obtener el numero de licencia del responsable del viaje
     * @return int
     */
    public function getNumeroLicencia (){
        return $this -> numeroLicencia;
    }

    /**
     * METODO para obtener el nombre del responsable del viaje
     * @return string
     */
    public function getNombre (){
        return $this -> nombre;
    }

    /**
     * METODO para obtener el apellido del responsable del viaje
     * @return string
     */
    public function getApellido (){
        return $this -> apellido;
    }

    /**
     * METODO para setear el numero de empleado del responsable del viaje
     * @param int
     */
    public function setNumeroEmpleado ($nuevoNumeroEmpleado){
        $this -> numeroEmpleado = $nuevoNumeroEmpleado;
    }

    /**
     * METODO para setear el numero de licencia del responsable del viaje
     * @param int
     */
    public function setNumeroLicencia ($nuevoNumeroLicencia){
        $this -> numeroLicencia = $nuevoNumeroLicencia;
    }

    /**
     * METODO para setear el nombre del responsable del viaje
     * @param string
     */
    public function setNombre ($nuevoNombre){
        $this -> nombre = $nuevoNombre;
    }

    /**
     * METODO para setear el apellido del responsable del viaje
     * @param string
     */
    public function setApellido ($nuevoApellido){
        $this -> apellido = $nuevoApellido;
    }

    /**
     * METODO que retorna un string con toda la información del responsable del viaje
     */
    public function __toString(){
        return "INFORMACION DEL RESPONSABLE DEL VIAJE\n" . 
        "NUMERO DE EMPLEADO: " . $this->getNumeroEmpleado() . "\n" . 
        "NUMERO DE LICENCIA: " . $this->getNumeroLicencia() . "\n" . 
        "NOMBRE: " . $this->getNombre() . "\n" . 
        "APELLIDO: " . $this->getApellido() . "\n";
    }
}