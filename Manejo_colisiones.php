<?php


// Definir la tabla hash con datos precargados
$tablaHash = array(
    "Pedro" => array("nombre" => "Pedro", "edad" => 25, "carrera" => "Medicina"),
    "María" => array("nombre" => "María", "edad" => 22, "carrera" => "Comunicación"),
    "Luis" => array("nombre" => "Luis", "edad" => 24, "carrera" => "Informática"),
    "Ana" => array("nombre" => "Ana", "edad" => 20, "carrera" => "Ingeniería Informática"), // Nuevo valor con la misma clave que "Pedro"
);

// Función hash personalizada (con argumento)
function hashPersonalizado($clave, $tablaHash)
{
    $longitud = strlen($clave);
    $suma = 0;
    for ($i = 0; $i < $longitud; $i++) {
        $suma += ord($clave[$i]);
    }

    return $suma % count($tablaHash);
}

// Manejo de colisiones con encadenamiento
function manejarColision($clave, $indice, $valor, $tablaHash)
{
    // Crear un nuevo nodo con el valor
    $nuevoNodo = array("clave" => $clave, "valor" => $valor);

    // Si no hay siguiente nodo, el nuevo nodo es el siguiente
    if (!isset($tablaHash[$indice]["siguiente"])) {
        $tablaHash[$indice]["siguiente"] = $nuevoNodo;
    } else {
        // Agregar el nuevo nodo al final de la cadena
        $actual = $tablaHash[$indice]["siguiente"];
        while (isset($actual["siguiente"])) {
            $actual = $actual["siguiente"];
        }

        $actual["siguiente"] = $nuevoNodo;
    }

    return $indice; // El índice no cambia
}

// Insertar un nuevo valor (con colisión)
$clave = "Ana";
$valor = array("nombre" => "Ana", "edad" => 20, "carrera" => "Ingeniería Informática");

$indice = hashPersonalizado($clave, $tablaHash);

// Manejar colisión si el índice ya está ocupado
if (isset($tablaHash[$indice]["siguiente"])) {
    $indice = manejarColision($clave, $indice, $valor, $tablaHash);
}

// **Corrección:** Agregar la clave "valor" al nuevo nodo antes de insertarlo en la tabla hash
$tablaHash[$indice]["valor"] = $valor;

// Mostrar la tabla hash
echo "Tabla hash con valor insertado:" . PHP_EOL;
foreach ($tablaHash as $clave => $valor) {
    if (isset($valor["siguiente"])) {
        echo "Nombre: " . $valor["siguiente"]["valor"]["nombre"] . " (índice: " . $indice . ", cadena de colisiones)" . PHP_EOL;
        print_r($valor["siguiente"]["valor"]);
        echo "-------------------" . PHP_EOL;

        // Recorrer la cadena y mostrar los valores siguientes
        $actual = $valor["siguiente"];
        while (isset($actual["siguiente"])) {
            echo "Nombre: " . $actual["siguiente"]["valor"]["nombre"] . " (índice: " . $actual["siguiente"]["valor"]["clave"] . ", cadena de colisiones)" . PHP_EOL;
            print_r($actual["siguiente"]["valor"]);
            echo "-------------------" . PHP_EOL;
            $actual = $actual["siguiente"];
        }
    } else {
        if (isset($valor["nombre"])) { // Comprobar si existe la clave "nombre"
            echo "Nombre: " . $valor["nombre"] . PHP_EOL;
        } else {
            echo "Nombre no disponible" . PHP_EOL;
        }

        print_r($valor);
        echo "-------------------" . PHP_EOL;
    }
}

