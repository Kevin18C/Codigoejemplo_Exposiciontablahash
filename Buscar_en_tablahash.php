<?php


// Definir la tabla hash con valores precargados
$tablaHash = array(
    "Ana" => array("edad" => 20, "carrera" => "Ingeniería Informática"),
    "Luis" => array("edad" => 22, "carrera" => "Matemáticas"),
    "María" => array("edad" => 21, "carrera" => "Medicina")
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

// Buscar un valor
$clave = "Luis";

if (isset($tablaHash[$clave])) {
    $informacion = $tablaHash[$clave];
    echo "Información de $clave:" . PHP_EOL;
    print_r($informacion);
} else {
    echo "Clave '$clave' no encontrada" . PHP_EOL;
}
