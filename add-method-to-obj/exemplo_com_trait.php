<?php
declare(strict_types=1);

// Include the CarroUsaTrait class file
require_once 'CarroUsaTrait.php';

// Use the AddMethodToObj namespace
use AddMethodToObj\CarroUsaTrait;

/**
 * Example demonstrating dynamic method creation with traits
 */
try {
    // Create a new CarroUsaTrait instance
    $carro = new CarroUsaTrait('Uno', '1995');

    // Call the ligar method
    $carro->ligar();

    // Dynamically create a new method 'buzinar' that returns a string
    $carro->createNewMethod('buzinar', null, 'return "biii bii\n";');

    // Call the dynamically created method and echo its return value
    echo $carro->buzinar(1, 2);

    // Dynamically create another method 'freiar' that echoes a message
    // Using the getModelo() method instead of directly accessing the property
    $carro->createNewMethod('freiar', null, 'echo "pisei no freio do meu " . $this->getModelo() . "\n";');

    // Call the dynamically created method
    $carro->freiar();

    // Display car information using the getter methods
    echo "Modelo: " . $carro->getModelo() . ", Ano: " . $carro->getAno() . "\n";

} catch (\Exception $e) {
    // Handle any exceptions that might occur
    echo "Error: " . $e->getMessage() . "\n";
}
