<?php
include_once("Viaje.php");
include_once("Pasajero.php");
include_once("ResponsableV.php");

// Utilizo función sacada del proyecto del año pasado Wordix para validar los numeros ingresados
/**
 *  Corrobora que un número se encuentre entre un mínimo y un máximo 
 * @param int $min
 * @param int $max
 * @return int
 */
function solicitarNumeroEntre($min, $max) {
    //int $numero
    $numero = (trim(fgets(STDIN)));
    while ((((int)($numero) != $numero)) || (!($numero >= $min && $numero <= $max))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/// creación del viaje
echo "Para empezar con el menú primero debemos crear un viaje!\n\n";
echo "Ingrese el codigo del viaje: ";
$codigoViaje = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: ";
$destinoViaje = trim(fgets(STDIN));
echo "Ingrese la cantidad maxima de pasajeros: ";
$cantMaximaPasajeros = trim(fgets(STDIN));
echo "¿Cuantos pasajeros quieres ingresar en primera instancia?: ";
$pasajerosIngresados = trim(fgets(STDIN));
$arregloPasajeros = [];
for ($i=0; $i < $pasajerosIngresados; $i++){
    echo "PASAJERO N°" . $i+1 . "\n";
    echo "Ingrese el nombre: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido: ";
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el numero de documento: ";
    $nroDocumentoPasajero = trim(fgets(STDIN));
    echo "Ingrese el telefono del pasajero: ";
    $telefonoPasajero = trim(fgets(STDIN));
    $pasajero = new Pasajero($nombrePasajero, $apellidoPasajero, $nroDocumentoPasajero, $telefonoPasajero);
    array_push($arregloPasajeros, $pasajero);
}
// creación del responsable del viaje
echo "INGRESO DE DATOS DEL RESPONSABLE DEL VIAJE\n\n";
echo "Ingrese el nombre del responsable del viaje: ";
$nombreResponsable = trim(fgets(STDIN));
echo "Ingrese el apellido del responsable del viaje: ";
$apellidoResponsable = trim(fgets(STDIN));
echo "Ingrese el numero de empleado del responsable: ";
$numeroEmpleadoResponsable = trim(fgets(STDIN));
echo "Ingrese el numero de licencia del responsable: ";
$numeroLicenciaResponsable = trim(fgets(STDIN));
$personaResponsable = new ResponsableV($numeroEmpleadoResponsable, $numeroLicenciaResponsable, $nombreResponsable, $apellidoResponsable);
// creacion del viaje con los datos
$viaje = new Viaje($codigoViaje, $destinoViaje, $cantMaximaPasajeros, $arregloPasajeros, $personaResponsable);

// MENU PRINCIPAL
do {
    echo "MENÚ PRINCIPAL: \n";
    echo "Seleccione una opción\n" . 
        "1. Modificar datos del viaje.\n" . 
        "2. Cargar datos de un nuevo pasajero.\n" . 
        "3. Mostrar los datos del viaje.\n" . 
        "4. Salir del menú.\n" . 
        "OPCIÓN SELECCIONADA: ";
    $opcionElegida = solicitarNumeroEntre(1, 4);
    switch ($opcionElegida){
        case 1:
            echo "Ingrese que atributo del viaje desea modificar (1.codigo / 2.destino /3.cantidad maxima de pasajeros / 4.pasajeros / 5.persona responsable): ";
            $atributoAModificar = solicitarNumeroEntre(1, 5);
            if ($atributoAModificar == 1){
                echo "Ingrese el NUEVO CODIGO DEL VIAJE: ";
                $nuevoCodigoViaje = trim(fgets(STDIN));
                $viaje -> setCodigo($nuevoCodigoViaje);
            } elseif ($atributoAModificar == 2){
                echo "Ingrese el NUEVO DESTINO DEL VIAJE: ";
                $nuevoDestinoViaje = trim(fgets(STDIN));
                $viaje -> setDestino($nuevoDestinoViaje);
            } elseif ($atributoAModificar == 3){
                echo "Ingrese la NUEVA CANTIDAD MAXIMA DE PASAJEROS: ";
                $nuevaCantidadMaximaPasajeros = trim(fgets(STDIN));
                $viaje -> setCantidadMaximaPasajeros($nuevaCantidadMaximaPasajeros);
            } elseif ($atributoAModificar == 4){
                echo "Ingrese el DNI del pasajero que desea modificar: ";
                $dniPasajero = trim(fgets(STDIN));
                $arregloPasaj = $viaje -> getPasajeros();
                $cantPasajeros = count($arregloPasaj);
                $j = 0;
                $pasajeroEncontrado = false;
                while ($j < $cantPasajeros && (!$pasajeroEncontrado)){
                    $pasajeroAComparar = $arregloPasaj[$j];
                    if ($pasajeroAComparar->getNroDocumento() == $dniPasajero){
                        $pasajeroEncontrado = true;
                        $pasajeroAModificar = $pasajeroAComparar;
                    } else {
                        $j++;
                    }
                }
                if ($pasajeroEncontrado){
                    echo "¿Qué desea modificar del pasajero? (1.nombre / 2.apellido / 3.telefono): ";
                    $caracAModificar = solicitarNumeroEntre(1, 3);
                    if ($caracAModificar == 1){
                        echo "Ingrese el nuevo nombre del pasajero: ";
                        $nuevoNombrePasaj = trim(fgets(STDIN));
                        $pasajeroAModificar->setNombre($nuevoNombrePasaj);
                    } elseif ($caracAModificar == 2){
                        echo "Ingrese el nuevo apellido del pasajero: ";
                        $nuevoApellidoPasaj = trim(fgets(STDIN));
                        $pasajeroAModificar->setApellido($nuevoApellidoPasaj);
                    } elseif ($caracAModificar == 3){
                        echo "Ingrese el nuevo telefono del pasajero: ";
                        $nuevoTelefonoPasaj = trim(fgets(STDIN));
                        $pasajeroAModificar->setTelefono($nuevoTelefonoPasaj);
                    }
                } else {
                    echo "No se ha encontrado un pasajero con el dni ingresado.\n";
                }
                $viaje -> setPasajeros($arregloPasaj);
            } elseif ($atributoAModificar == 5){
                echo "Ingrese el atributo que desea modificar (1.nombre / 2.apellido / 3.numero de empleado / 4.numero de licencia): ";
                $caracAModificar = solicitarNumeroEntre(1, 4);
                if ($caracAModificar == 1){
                    echo "Ingrese el nuevo nombre de la persona responsable: ";
                    $nuevoNombreResponsable = trim(fgets(STDIN));
                    $personaResponsable->setNombre($nuevoNombreResponsable);
                } elseif ($caracAModificar == 2){
                    echo "Ingrese el nuevo apellido de la persona responsable: ";
                    $nuevoApellidoPersonaResponsable = trim(fgets(STDIN));
                    $personaResponsable->setApellido($nuevoApellidoPersonaResponsable);
                } elseif ($caracAModificar == 3){
                    echo "Ingrese el nuevo número de empleado de la persona responsable: ";
                    $nuevoNumeroEmpleado = trim(fgets(STDIN));
                    $personaResponsable->setNumeroEmpleado($nuevoNumeroEmpleado);
                } elseif ($caracAModificar == 4){
                    echo "Ingrese el nuevo numero de licencia de la persona responsable: ";
                    $nuevoNumeroLicencia = trim(fgets(STDIN));
                    $personaResponsable->setNumeroLicencia($nuevoNumeroLicencia);
                }
            }
            break;
        case 2:
            if (count($viaje -> getPasajeros()) < $viaje -> getCantidadMaximaPasajeros()){
                echo "Ingrese el nombre del nuevo pasajero: ";
                $nombreNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del nuevo pasajero: ";
                $apellidoNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el número de documento del nuevo pasajero: ";
                $dniNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el telefono del nuevo pasajero: ";
                $telefonoNuevoPasajero = trim(fgets(STDIN));
                $pasajeroNuevo = new Pasajero($nombreNuevoPasajero, $apellidoNuevoPasajero, $dniNuevoPasajero, $telefonoNuevoPasajero);
                $j = 0;
                $pasajeroHabilitado = true;
                $arregloPasajerosActual = $viaje->getPasajeros();
                while ($j < count($arregloPasajerosActual) && $pasajeroHabilitado){
                    $pasajAComparar = $arregloPasajerosActual[$j];
                    if ($dniNuevoPasajero == $pasajAComparar->getNroDocumento()){
                        $pasajeroHabilitado = false;
                    } else {
                        $j++;
                    }
                }
                if ($pasajeroHabilitado){
                    $viaje->agregarPasajero($pasajeroNuevo);
                } else {
                    echo "Ya hay un pasajero con el dni ingresado. VUELVA A INGRESAR UN PASAJERO CON OTRO DNI\n";
                }
                
            } else {
                echo "NO SE PUEDEN AGREGAR MAS PASAJEROS A ESTE VIAJE.\nPRIMERO AUMENTE LA CANTIDAD MAXIMA DE PASAJEROS PARA PODER AGREGAR MAS PASAJEROS.\n";
            }
            break;
        case 3:
            echo $viaje;
            break;
        case 4:
            echo "FIN DEL MENU!";
            break;
    }
} while ($opcionElegida != 4);