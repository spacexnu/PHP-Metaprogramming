<?php
declare(strict_types=1);

namespace AddMethodToObj;

require_once 'traitGenMetodo.php';

/**
 * CarroUsaTrait class demonstrating trait usage for metaprogramming
 * 
 * This class uses the GenMetodo trait to enable dynamic method creation
 */
class CarroUsaTrait {
    /**
     * Use the GenMetodo trait for dynamic method creation
     */
    use GenMetodo;

    /**
     * Car model
     */
    private string $modelo;

    /**
     * Car year
     */
    private string $ano;

    /**
     * Constructor
     *
     * @param string $modelo Car model
     * @param string $ano Car year
     */
    public function __construct(string $modelo, string $ano) {
        $this->modelo = $modelo;
        $this->ano = $ano;
    }

    /**
     * Start the car
     *
     * @return void
     */
    public function ligar(): void {
        echo "Ligando o carro\n";
    }

    /**
     * Get the car model
     *
     * @return string
     */
    public function getModelo(): string {
        return $this->modelo;
    }

    /**
     * Get the car year
     *
     * @return string
     */
    public function getAno(): string {
        return $this->ano;
    }
}
