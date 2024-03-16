<?php

class MemoryManager {
    private $memory = array();

    public function allocate($processName, $size) {
        $bestFitIndex = -1;
        $bestFitSize = PHP_INT_MAX;

        foreach ($this->memory as $key => $block) {
            if (!$block['allocated'] && $block['size'] >= $size && $block['size'] < $bestFitSize) {
                $bestFitIndex = $key;
                $bestFitSize = $block['size'];
            }
        }

        if ($bestFitIndex != -1) {
            // Asignar memoria al proceso
            $this->memory[$bestFitIndex]['allocated'] = true;
            $this->memory[$bestFitIndex]['process'] = $processName;
            echo "Proceso '$processName' asignado a bloque de memoria $bestFitIndex.\n";
        } else {
            echo "No hay suficiente memoria disponible para el proceso '$processName'.\n";
        }
    }

    public function deallocate($processName) {
        foreach ($this->memory as $key => $block) {
            if ($block['allocated'] && $block['process'] === $processName) {
                // Liberar memoria
                $this->memory[$key]['allocated'] = false;
                $this->memory[$key]['process'] = '';
                echo "Memoria liberada para el proceso '$processName'.\n";
                return;
            }
        }
        echo "No se encontró memoria asignada para el proceso '$processName'.\n";
    }

    public function displayMemory() {
        foreach ($this->memory as $key => $block) {
            $status = $block['allocated'] ? 'Asignado a ' . $block['process'] : 'Libre';
            echo "Bloque $key: Tamaño = {$block['size']}, Estado = $status\n";
        }
    }

    public function addMemoryBlock($size) {
        $this->memory[] = array(
            'size' => $size,
            'allocated' => false,
            'process' => ''
        );
    }
}

// Ejemplo de uso:

// Crear un administrador de memoria
$memoryManager = new MemoryManager();

// Agregar bloques de memoria
$memoryManager->addMemoryBlock(100);
$memoryManager->addMemoryBlock(50);
$memoryManager->addMemoryBlock(200);

// Asignar memoria a procesos
$memoryManager->allocate('Proceso1', 80);
$memoryManager->allocate('Proceso2', 120);

// Mostrar el estado de la memoria después de la asignación
echo "Estado de la memoria después de la asignación:\n";
$memoryManager->displayMemory();

// Liberar memoria de un proceso
$memoryManager->deallocate('Proceso1');

// Mostrar el estado de la memoria después de liberar memoria
echo "\nEstado de la memoria después de liberar memoria del proceso 'Proceso1':\n";
$memoryManager->displayMemory();

?>
