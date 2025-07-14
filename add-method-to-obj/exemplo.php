<?php
declare(strict_types=1);

// Include the Carro class file
require_once 'Carro.php';

// Use the AddMethodToObj namespace
use AddMethodToObj\Carro;

/**
 * Example demonstrating dynamic method creation with the Carro class
 */
try {
    // Create a new Carro instance
    $carro = new Carro('Uno', '1995');

    // Call the ligar method
    $carro->ligar();

    // Dynamically create a new method 'buzinar' that returns a string
    $carro->createNewMethod('buzinar', null, 'return "biii bii\n";');

    // Call the dynamically created method and echo its return value
    echo $carro->buzinar(1, 2);

    // Dynamically create another method 'freiar' that echoes a message
    $carro->createNewMethod('freiar', null, 'echo "pisei no freio no meu " . $this->getModelo() . "\n";');

    // Call the dynamically created method
    $carro->freiar();

    // Display car information using the getter methods
    echo "Modelo: " . $carro->getModelo() . ", Ano: " . $carro->getAno() . "\n";

} catch (\Exception $e) {
    // Handle any exceptions that might occur
    echo "Error: " . $e->getMessage() . "\n";
}
