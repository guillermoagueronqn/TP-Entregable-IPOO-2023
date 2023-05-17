<?php
include_once("Viaje.php");
include_once("Pasajero.php");
include_once("ResponsableV.php");
include_once("PasajeroEstandar.php");
include_once("PasajeroVIP.php");
include_once("PasajeroNecesidadEspecial.php");

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
echo "Ingrese el costo del viaje: ";
$costoViaje = trim(fgets(STDIN));
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
$viaje = new Viaje($codigoViaje, $destinoViaje, $cantMaximaPasajeros, [], $personaResponsable, $costoViaje);
// pregunta si quiere ingresar pasajeros junto con el viaje
echo "¿Desea ingresar pasajeros en primera instacia?(si/no): ";
$respuesta = trim(fgets(STDIN));
$numeroTicketPasajero = 1;
if ($respuesta == "si"){
    echo "¿Cuantos pasajeros quieres ingresar en primera instancia?: ";
    $pasajerosIngresados = solicitarNumeroEntre(1, $cantMaximaPasajeros);
    $arregloPasajeros = [];
    for ($i=0; $i < $pasajerosIngresados; $i++){
        echo "PASAJERO N°" . $i+1 . "\n";
        echo "Ingrese el tipo de pasajero que ingresará(1.Estandar / 2.Con necesidades especiales / 3.VIP): ";
        $tipoPasajero = solicitarNumeroEntre(1, 3);
        echo "Ingrese el nombre: ";
        $nombrePasajero = trim(fgets(STDIN));
        echo "Ingrese el apellido: ";
        $apellidoPasajero = trim(fgets(STDIN));
        echo "Ingrese el numero de documento: ";
        $nroDocumentoPasajero = trim(fgets(STDIN));
        echo "Ingrese el telefono del pasajero: ";
        $telefonoPasajero = trim(fgets(STDIN));
        echo "Ingrese el numero de asiento: ";
        $numeroAsientoPasajero = trim(fgets(STDIN));
        if ($tipoPasajero == 1){
            $pasajeroAIngresar = new PasajeroEstandar($nombrePasajero, $apellidoPasajero, $nroDocumentoPasajero, $telefonoPasajero, $numeroAsientoPasajero, $numeroTicketPasajero);
        } elseif ($tipoPasajero == 2){
            echo "¿El pasajero requiere de una silla de ruedas?(si/no): ";
            $requiereSillaRuedas = trim(fgets(STDIN));
            echo "¿El pasajero requiere de asistencia para el embarque o desembarque?(si/no): ";
            $requiereAsistencia = trim(fgets(STDIN));
            echo "¿El pasajero requiere de comidas especiales por alergias o restricciones alimentarias(si/no): ";
            $requiereComidaEspecial = trim(fgets(STDIN));
            $pasajeroAIngresar = new PasajeroNecesidadEspecial($nombrePasajero, $apellidoPasajero, $nroDocumentoPasajero, $telefonoPasajero, $numeroAsientoPasajero, $numeroTicketPasajero, $requiereSillaRuedas, $requiereAsistencia, $requiereComidaEspecial);
        } elseif ($tipoPasajero == 3){
            echo "Ingrese el numero de viajero frecuente del pasajero VIP: ";
            $numeroViajeroFrecuente = trim(fgets(STDIN));
            echo "Ingrese las millas acumuladas que tiene el pasajero: ";
            $millasActualesPasajero = trim(fgets(STDIN));
            $pasajeroAIngresar = new PasajeroVIP($nombrePasajero, $apellidoPasajero, $nroDocumentoPasajero, $telefonoPasajero, $numeroAsientoPasajero, $numeroTicketPasajero, $numeroViajeroFrecuente, $millasActualesPasajero);
        }
    $viaje->venderPasaje($pasajeroAIngresar);
    $numeroTicketPasajero = $numeroTicketPasajero+1;
    }
} else {
    echo "No se ha ingresado ningún pasajero!\n";
}


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
            echo "Ingrese que atributo del viaje desea modificar (1.codigo / 2.destino /3.cantidad maxima de pasajeros / 4.pasajeros / 5.persona responsable / 6.costo del viaje): ";
            $atributoAModificar = solicitarNumeroEntre(1, 6);
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
                    $tipoPasajero = get_class($pasajeroAModificar);
                    if ($tipoPasajero == "PasajeroEstandar"){
                        echo "¿Qué desea modificar del pasajero? (1.nombre / 2.apellido / 3.telefono / 4. numero de asiento): ";
                        $caracAModificar = solicitarNumeroEntre(1, 4);
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
                        } elseif ($caracAModificar == 4){
                            echo "Ingrese el nuevo numero de asiento del pasajero: ";
                            $nuevoNroAsiento = trim(fgets(STDIN));
                            $pasajeroAModificar->setNumeroAsiento($nuevoNroAsiento);
                        }
                    } elseif ($tipoPasajero == "PasajeroNecesidadEspecial"){
                        echo "¿Qué desea modificar del pasajero? (1.nombre / 2.apellido / 3.telefono / 4. numero de asiento / 5.requiere silla de ruedas / 6.requiere asistencia / 7.requiere comida especial): ";
                        $caracAModificar = solicitarNumeroEntre(1, 7);
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
                        } elseif ($caracAModificar == 4){
                            echo "Ingrese el nuevo numero de asiento del pasajero: ";
                            $nuevoNroAsiento = trim(fgets(STDIN));
                            $pasajeroAModificar->setNumeroAsiento($nuevoNroAsiento);
                        } elseif ($caracAModificar == 5){
                            echo "El pasajero requiere silla de ruedas?(si/no): ";
                            $nuevoRequiereSillaDeRuedas = trim(fgets(STDIN));
                            $pasajeroAModificar->setRequiereSillaDeRuedas($nuevoRequiereSillaDeRuedas);
                        } elseif ($caracAModificar == 6){
                            echo "El pasajero requiere asistencia en el embarque o desembarque?(si/no): ";
                            $nuevoRequiereAsistencia = trim(fgets(STDIN));
                            $pasajeroAModificar->setRequiereAsistencia($nuevoRequiereAsistencia);
                        } elseif ($caracAModificar == 7){
                            echo "El pasajero requiere comida especial?(si/no): ";
                            $nuevoRequiereComidaEspecial = trim(fgets(STDIN));
                            $pasajeroAModificar->setRequiereComidaEspecial($nuevoRequiereComidaEspecial);
                        }
                    } elseif ($tipoPasajero == "PasajeroVIP"){
                        echo "¿Qué desea modificar del pasajero? (1.nombre / 2.apellido / 3.telefono / 4.numero de asiento / 5.numero de viajero frecuente / 6.cantidad de millas): ";
                        $caracAModificar = solicitarNumeroEntre(1, 6);
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
                        } elseif ($caracAModificar == 4){
                            echo "Ingrese el nuevo numero de asiento del pasajero: ";
                            $nuevoNroAsiento = trim(fgets(STDIN));
                            $pasajeroAModificar->setNumeroAsiento($nuevoNroAsiento);
                        } elseif ($caracAModificar == 5){
                            echo "Ingrese el nuevo numero de viajero frecuente: ";
                            $nuevoNumeroViajeroFrecuente = trim(fgets(STDIN));
                            $pasajeroAModificar->setNumeroViajeroFrecuente($nuevoNumeroViajeroFrecuente);
                        } elseif ($caracAModificar == 6){
                            echo "Ingrese la nueva cantidad de millas: ";
                            $nuevaCantidadMillas = trim(fgets(STDIN));
                            $pasajeroAModificar->setCantidadMillas($nuevaCantidadMillas);
                        }
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
                $viaje->setPersonaResponsable($personaResponsable);
            } elseif ($atributoAModificar == 6){
                echo "Ingrese el nuevo costo del viaje: ";
                $nuevoCostoViaje = trim(fgets(STDIN));
                $viaje->setCostoViaje($nuevoCostoViaje);
            }
            break;
        case 2:
            if ($viaje->getCantidadMaximaPasajeros() > count($viaje->getPasajeros())){
                echo "Que tipo de pasajero desea ingresar (1.Estandar / 2.Con necesidades especiales / 3.VIP): ";
                $tipoPasajero = solicitarNumeroEntre(1, 3);
                echo "Ingrese el nombre del nuevo pasajero: ";
                $nombreNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del nuevo pasajero: ";
                $apellidoNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del nuevo pasajero: ";
                $dniNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el telefono del nuevo pasajero: ";
                $telefonoNuevoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de asiento del nuevo pasajero: ";
                $numeroAsientoNuevoPasajero = trim(fgets(STDIN));
                $numeroTicketNuevoPasajero = $numeroTicketPasajero;
                $numeroTicketPasajero++;
                if ($tipoPasajero == 1){
                    $pasajeroAAgregar = new PasajeroEstandar($nombreNuevoPasajero, $apellidoNuevoPasajero, $dniNuevoPasajero, $telefonoNuevoPasajero, $numeroAsientoNuevoPasajero, $numeroTicketNuevoPasajero);
                } elseif ($tipoPasajero == 2){
                    echo "¿El pasajero requiere de una silla de ruedas?(si/no): ";
                    $requiereSillaRuedas = trim(fgets(STDIN));
                    echo "¿El pasajero requiere de asistencia para el embarque o desembarque?(si/no): ";
                    $requiereAsistencia = trim(fgets(STDIN));
                    echo "¿El pasajero requiere de comidas especiales por alergias o restricciones alimentarias(si/no): ";
                    $requiereComidaEspecial = trim(fgets(STDIN));
                    $pasajeroAAgregar = new PasajeroNecesidadEspecial($nombreNuevoPasajero, $apellidoNuevoPasajero, $dniNuevoPasajero, $telefonoNuevoPasajero, $numeroAsientoNuevoPasajero, $numeroTicketNuevoPasajero, $requiereSillaRuedas, $requiereAsistencia, $requiereComidaEspecial);
                } elseif ($tipoPasajero == 3){
                    echo "Ingrese el numero de viajero frecuente del pasajero VIP: ";
                    $numeroViajeroFrecuente = trim(fgets(STDIN));
                    echo "Ingrese las millas acumuladas que tiene el pasajero: ";
                    $millasActualesPasajero = trim(fgets(STDIN));
                    $pasajeroAAgregar = new PasajeroVIP($nombreNuevoPasajero, $apellidoNuevoPasajero, $dniNuevoPasajero, $telefonoNuevoPasajero, $numeroAsientoNuevoPasajero, $numeroTicketNuevoPasajero, $numeroViajeroFrecuente, $millasActualesPasajero);
                }
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
                    $costoViaje = $viaje->venderPasaje($pasajeroAAgregar);
                    echo "Se ha vendido exitosamente el pasaje. El monto a pagar es de $" . $costoViaje . "\n";
                } else {
                    echo "Ya hay un pasajero con el dni ingresado. VUELVA A INGRESAR UN PASAJERO CON OTRO DNI\n";
                }
            } else {
                echo "Lo sentimos, no hay pasajes disponibles para el viaje.\n";
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