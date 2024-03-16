<?php
class MemoryManager
{
    private $pageSize;
    private $pageCount;
    private $memory;

    public function __construct($pageSize, $pageCount)
    {
        $this->pageSize = $pageSize;
        $this->pageCount = $pageCount;
        $this->memory = [];
    }

    public function accessPage($pageNumber)
    {
        if ($pageNumber < 0 || $pageNumber >= $this->pageCount) {
            echo "Error: Página fuera de rango.\n";
            return;
        }

        if (!isset($this->memory[$pageNumber])) {
            $this->loadPageFromDisk($pageNumber);
        }

        echo "Contenido de la página $pageNumber: " . $this->memory[$pageNumber] . "\n";
    }

    private function loadPageFromDisk($pageNumber)
    {
        // Simulamos la carga de la página desde el almacenamiento secundario
        // En este ejemplo, simplemente generamos un contenido aleatorio para la página
        $content = "Contenido de la página $pageNumber";
        $this->memory[$pageNumber] = $content;
        echo "Página $pageNumber cargada en memoria.\n";
    }
}

// Creamos una instancia de MemoryManager con un tamaño de página de 4 bytes y 8 páginas
$memoryManager = new MemoryManager(4, 8);

// Simulamos solicitudes de acceso a páginas de forma interactiva
echo "Simulación de acceso a páginas. Ingrese el número de página que desea acceder (0 - 7) o 'q' para salir.\n";

while (true) {
    echo "Ingrese el número de página: ";
    $input = readline();

    if ($input === 'q') {
        echo "Saliendo del programa.\n";
        break;
    }

    $pageNumber = intval($input);
    $memoryManager->accessPage($pageNumber);
}

