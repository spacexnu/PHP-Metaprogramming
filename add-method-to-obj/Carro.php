<?php
declare(strict_types=1);

namespace AddMethodToObj;

use Closure;

/**
 * Carro class demonstrating PHP metaprogramming capabilities
 * 
 * This class allows dynamic method creation at runtime
 */
class Carro {
    private string $modelo;
    private string $ano;
    private ?string $functionArgs = null;

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

    /**
     * Dynamically create a new method for this object
     *
     * @param string $name Method name
     * @param array|null $args Method arguments
     * @param string $code Method body code
     * @return void
     */
    public function createNewMethod(string $name, ?array $args, string $code): void {
        if (!is_null($args) && count($args) > 0) {
            array_walk($args, function (string $value): void {
                if (empty($this->functionArgs)) {
                    $this->functionArgs = '$' . $value;
                } else {
                    $this->functionArgs .= ', $' . $value;
                }
            });
        }

        $functionDefinition = '$this->{$name} = function (' . ($this->functionArgs ?? '') . ') use ($this)';
        $functionDefinition .= '{' . $code . '};';

        // Note: eval is used for metaprogramming demonstration purposes
        // In production code, consider safer alternatives
        eval($functionDefinition);
        $this->functionArgs = null;
    }

    /**
     * Magic method to handle calls to dynamically created methods
     *
     * @param string $method Method name
     * @param array $args Method arguments
     * @return mixed
     * @throws \BadMethodCallException When method doesn't exist
     */
    public function __call(string $method, array $args) {
        if (isset($this->{$method}) && $this->{$method} instanceof Closure) {
            return ($this->{$method})(...$args);
        }

        throw new \BadMethodCallException("Method $method does not exist");
    }
}
