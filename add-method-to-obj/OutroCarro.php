<?php
declare(strict_types=1);

namespace AddMethodToObj;

use Closure;
use Exception;

/**
 * Alternative Carro class with public properties
 * 
 * This class demonstrates a simpler approach to dynamic method handling
 */
class OutroCarro {
    public string $modelo;
    public string $ano;
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

/**
 * GnuPG encryption/decryption example
 * 
 * This demonstrates using the GnuPG extension for PHP
 */
class GnuPGExample {
    private const KEY_ID = "8660281B6051D071D94B5B230549F9DC851566DC";
    private const PASSWORD = 'senha';
    private const SECRET_TEXT = "Texto Secreto";

    /**
     * Run the GnuPG example
     *
     * @return string|null The decrypted text or null if extension not loaded
     * @throws Exception If encryption or decryption fails
     */
    public static function run(): ?string {
        if (!extension_loaded('gnupg')) {
            return null;
        }

        try {
            // Object-oriented approach
            $gpg = new \gnupg();
            $gpg->addencryptkey(self::KEY_ID);
            $encrypted = $gpg->encrypt(self::SECRET_TEXT);

            // Procedural approach
            $resource = gnupg_init();
            gnupg_adddecryptkey($resource, self::KEY_ID, self::PASSWORD);
            $decrypted = gnupg_decrypt($resource, $encrypted);

            return $decrypted;
        } catch (Exception $e) {
            throw new Exception("GnuPG operation failed: " . $e->getMessage());
        }
    }
}

// Execute the GnuPG example if the extension is loaded
try {
    $result = GnuPGExample::run();
    if ($result !== null) {
        echo "GnuPG example executed successfully.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
