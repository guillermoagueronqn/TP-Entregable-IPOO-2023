<?php
include 'Viaje.php';
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
echo "PARA ENTRAR AL MENÚ, PRIMERO SE DEBE CARGAR LA INFORMACIÓN DE UN VIAJE.\n";
echo "INICIO DE CARGA DE INFORMACIÓN DEL VIAJE\n";
// INGRESO DE DATOS DEL VIAJE
echo "Ingrese el codigo del viaje: "; 
$codigoViaje = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: ";
$destinoViaje = trim(fgets(STDIN));
echo "Ingrese la cantidad maxima de pasajeros del viaje: ";
$cantMaximaPasajeros = trim(fgets(STDIN));
echo "Ingrese la cantidad de pasajeros que quiere cargar: ";
$cantPasajeros = trim(fgets(STDIN));
for ($i=0; $i < $cantPasajeros; $i++){
    echo "Ingrese el nombre del pasajero n°" . $i+1 . ": ";
    $arregloPasajeros[$i]["nombre"] = trim(fgets(STDIN));
    echo "Ingrese el apellido del pasajero n°" . $i+1 . ": ";
    $arregloPasajeros[$i]["apellido"] = trim(fgets(STDIN));
    echo "Ingrese el dni del pasajero n°" . $i+1 . ": ";
    $arregloPasajeros[$i]["dni"] = trim(fgets(STDIN));
}
$viaje = new Viaje($codigoViaje, $destinoViaje, $cantMaximaPasajeros, $arregloPasajeros);
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
            echo "Ingrese que atributo desea modificar (1.codigo / 2.destino /3.cantidad maxima de pasajeros / 4.pasajeros): ";
            $atributoAModificar = solicitarNumeroEntre(1, 4);
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
                    if ($arregloPasaj[$j]["dni"] == $dniPasajero){
                        $pasajeroEncontrado = true;
                    } else {
                        $j++;
                    }
                }
                if ($pasajeroEncontrado){
                    echo "Que desea modificar del pasajero (1.nombre / 2.apellido / 3. dni): ";
                    $caracAModificar = solicitarNumeroEntre(1, 3);
                    if ($caracAModificar == 1){
                        $j = 0;
                        $pasajeroEncontrado = false;
                        while (($j < $cantPasajeros) && (!$pasajeroEncontrado)){
                            if ($arregloPasaj[$j]["dni"] == $dniPasajero){
                                $pasajeroEncontrado = true;
                                echo "Ingrese el NUEVO NOMBRE del pasajero n°" . $j+1 . ": ";
                                $arregloPasaj[$j]["nombre"] = trim(fgets(STDIN));
                            } else {
                                $j++;
                            }
                        }
                    } elseif ($caracAModificar == 2){
                        $g = 0;
                        $pasajeroEncontrado = false;
                        while (($g < $cantPasajeros) && (!$pasajeroEncontrado)){
                            if ($arregloPasaj[$g]["dni"] == $dniPasajero){
                                $pasajeroEncontrado = true;
                                echo "Ingrese el NUEVO APELLIDO del pasajero n°" . $g+1 . ": ";
                                $arregloPasaj[$g]["apellido"] = trim(fgets(STDIN));
                            } else {
                                $g++;
                            }
                        }
                    } elseif ($caracAModificar == 3){
                        $h = 0;
                        $pasajeroEncontrado = false;
                        while (($h < $cantPasajeros) &&(!$pasajeroEncontrado)){
                            if ($arregloPasaj[$h]["dni"] == $dniPasajero){
                                $pasajeroEncontrado = true;
                                echo "Ingrese el NUEVO DNI del pasajero n°" . $h+1 . ": ";
                                $arregloPasaj[$h]["dni"] = trim(fgets(STDIN));    
                            } else {
                                $h++;
                            }
                        } 
                    }
                } else {
                    echo "No se ha encontrado un pasajero con el dni ingresado.\n";
                }
                $viaje -> setPasajeros($arregloPasaj);
            }
            break;
        case 2:
            if (count($viaje -> getPasajeros()) < $viaje -> getCantidadMaximaPasajeros()){
                $nuevoPasajero = [];
                echo "Ingrese el nombre del nuevo pasajero: ";
                $nuevoPasajero["nombre"] = trim(fgets(STDIN));
                echo "Ingrese el apellido del nuevo pasajero: ";
                $nuevoPasajero["apellido"] = trim(fgets(STDIN));
                echo "Ingrese el dni del nuevo pasajero: ";
                $nuevoPasajero["dni"] = trim(fgets(STDIN));
                $viaje -> agregarPasajero($nuevoPasajero);
            } else {
                echo "NO SE PUEDEN AGREGAR MAS PASAJEROS A ESTE VIAJE.\nPRIMERO AUMENTE LA CANTIDAD MAXIMA DE PASAJEROS PARA PODER AGREGAR MAS PASAJEROS.\n";
            }
            break;
        case 3:
            echo $viaje->__toString();
            break;
        case 4:
            echo "FIN DEL MENU!";
            break;
    }
} while ($opcionElegida != 4);