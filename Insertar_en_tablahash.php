<?php


// Definir la tabla hash con datos precargados
$tablaHash = array(
    "Pedro" => array("nombre" => "Pedro", "edad" => 25, "carrera" => "Medicina"),
    "María" => array("nombre" => "María", "edad" => 22, "carrera" => "Comunicación"),
    "Luis" => array("nombre" => "Luis", "edad" => 24, "carrera" => "Informática")
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

// Insertar un nuevo valor sin clave "nombre"
$clave = "Ana";
$valor = array("nombre" => "Ana", "edad" => 20, "carrera" => "Ingeniería Informática");

$indice = hashPersonalizado($clave, $tablaHash);
$tablaHash[$indice] = $valor;

// Mostrar la tabla hash
echo "Tabla hash con valor insertado:" . PHP_EOL;
foreach ($tablaHash as $clave => $valor) {
    if (array_key_exists("nombre", $valor)) {
        echo "Nombre: " . $valor["nombre"] . PHP_EOL;
    } else {
        echo "Nombre no disponible" . PHP_EOL;
    }

    // Mostrar el valor completo del array
    print_r($valor);
    echo "-------------------" . PHP_EOL;
}
