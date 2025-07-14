<?php
declare(strict_types=1);

namespace AddMethodToObj;

use Closure;

/**
 * Trait for dynamic method generation
 * 
 * This trait provides functionality to dynamically create methods at runtime
 */
trait GenMetodo {
    /**
     * Holds the function arguments string during method creation
     */
    private ?string $functionArgs = null;

    /**
     * Dynamically create a new method for the class using this trait
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
