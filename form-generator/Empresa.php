<?php
declare(strict_types=1);

namespace FormGenerator;

require_once 'ReflectionForm.php';

/**
 * Empresa class for generating company information forms
 * 
 * This class extends ReflectionForm to automatically generate
 * HTML form fields for company information.
 */
class Empresa extends ReflectionForm {
    /**
     * Company name
     */
    private ?string $nome = null;

    /**
     * Company legal name
     */
    private ?string $razao_social = null;

    /**
     * Company address
     */
    private ?string $endereco = null;

    /**
     * Company neighborhood
     */
    private ?string $bairro = null;

    /**
     * Company city
     */
    private ?string $cidade = null;

    /**
     * Company state
     */
    private ?string $estado = null;

    /**
     * Company phone number
     */
    private ?string $telefone = null;

    /**
     * Company email
     */
    private ?string $email = null;

    /**
     * Constructor
     *
     * @param array $data Optional initial data for company properties
     */
    public function __construct(array $data = []) {
        parent::__construct();

        // Initialize properties from data array if provided
        if (!empty($data)) {
            $this->setData($data);
        }
    }

    /**
     * Set multiple properties at once
     *
     * @param array $data Associative array of property values
     * @return self
     */
    public function setData(array $data): self {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }

        return $this;
    }

    /**
     * Get company name
     *
     * @return string|null
     */
    public function getNome(): ?string {
        return $this->nome;
    }

    /**
     * Set company name
     *
     * @param string $nome
     * @return self
     */
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get company legal name
     *
     * @return string|null
     */
    public function getRazaoSocial(): ?string {
        return $this->razao_social;
    }

    /**
     * Set company legal name
     *
     * @param string $razaoSocial
     * @return self
     */
    public function setRazaoSocial(string $razaoSocial): self {
        $this->razao_social = $razaoSocial;
        return $this;
    }

    /**
     * Get company address
     *
     * @return string|null
     */
    public function getEndereco(): ?string {
        return $this->endereco;
    }

    /**
     * Set company address
     *
     * @param string $endereco
     * @return self
     */
    public function setEndereco(string $endereco): self {
        $this->endereco = $endereco;
        return $this;
    }

    /**
     * Get company neighborhood
     *
     * @return string|null
     */
    public function getBairro(): ?string {
        return $this->bairro;
    }

    /**
     * Set company neighborhood
     *
     * @param string $bairro
     * @return self
     */
    public function setBairro(string $bairro): self {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * Get company city
     *
     * @return string|null
     */
    public function getCidade(): ?string {
        return $this->cidade;
    }

    /**
     * Set company city
     *
     * @param string $cidade
     * @return self
     */
    public function setCidade(string $cidade): self {
        $this->cidade = $cidade;
        return $this;
    }

    /**
     * Get company state
     *
     * @return string|null
     */
    public function getEstado(): ?string {
        return $this->estado;
    }

    /**
     * Set company state
     *
     * @param string $estado
     * @return self
     */
    public function setEstado(string $estado): self {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get company phone number
     *
     * @return string|null
     */
    public function getTelefone(): ?string {
        return $this->telefone;
    }

    /**
     * Set company phone number
     *
     * @param string $telefone
     * @return self
     */
    public function setTelefone(string $telefone): self {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * Get company email
     *
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * Set company email
     *
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }
}
