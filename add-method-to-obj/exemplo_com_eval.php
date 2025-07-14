<?php
declare(strict_types=1);

// Include the OutroCarro class file
require_once 'OutroCarro.php';

// Use the AddMethodToObj namespace
use AddMethodToObj\OutroCarro;

/**
 * Example demonstrating dynamic method creation with eval and closures
 */
try {
    // Create a new OutroCarro instance
    $carro = new OutroCarro('Uno', '1995');

    // Call the ligar method
    $carro->ligar();

    // Method 1: Using eval to create a method dynamically
    // Note: This is for demonstration purposes only. In production code,
    // avoid using eval for security reasons.
    $str = '$carro->buzinar = function(): void {';
    $str .= 'echo "fom fom \n";';
    $str .= '};';

    eval($str);

    // Method 2: Directly assigning a closure to an object property
    // Using arrow function (PHP 7.4+)
    $carro->algumaCoisa = fn(): void => echo "faz alguma coisa\n";

    // Method 3: Creating a method that uses object properties
    $carro->mostrarInfo = function() use ($carro): void {
        echo "Carro modelo: {$carro->modelo}, ano: {$carro->ano}\n";
    };

    // Call the dynamically created methods
    $carro->buzinar();

    // This will throw an exception since freiar doesn't exist
    try {
        $carro->freiar();
    } catch (\BadMethodCallException $e) {
        echo "Error calling freiar: " . $e->getMessage() . "\n";
    }

    $carro->algumaCoisa();
    $carro->mostrarInfo();

} catch (\Exception $e) {
    // Handle any exceptions that might occur
    echo "Error: " . $e->getMessage() . "\n";
}
