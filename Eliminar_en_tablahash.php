<?php


// Definir la tabla hash con valores precargados
$tablaHash = array(
    "Ana" => array("edad" => 20, "carrera" => "Ingeniería Informática"),
    "Luis" => array("edad" => 22, "carrera" => "Matemáticas"),
    "María" => array("edad" => 21, "carrera" => "Medicina")
);

// Función hash personalizada (ejemplo sencillo)
function hashPersonalizado($clave, $tablaHash)
{
    $longitud = strlen($clave);
    $suma = 0;
    for ($i = 0; $i < $longitud; $i++) {
        $suma += ord($clave[$i]);
    }
    return $suma % count($tablaHash);
}

// Eliminar un valor
$clave = "Luis";

if (isset($tablaHash[$clave])) {
    unset($tablaHash[$clave]);
    echo "Clave '$clave' eliminada" . PHP_EOL;
    echo "Tabla hash actualizada:" . PHP_EOL;
    print_r($tablaHash);
} else {
    echo "Clave '$clave' no encontrada" . PHP_EOL;
}
