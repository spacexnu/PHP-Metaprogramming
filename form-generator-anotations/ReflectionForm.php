<?php
declare(strict_types=1);

namespace FormGeneratorAttributes;

use ReflectionObject;
use ReflectionProperty;
use ReflectionAttribute;
use Exception;

/**
 * Form Field Attribute
 * 
 * This attribute is used to define form field properties
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class FormField {
    /**
     * Constructor
     *
     * @param string $type Input field type (text, email, number, etc.)
     * @param string|null $label Custom label for the field
     * @param bool $required Whether the field is required
     * @param string|null $placeholder Placeholder text
     * @param array $options Additional options for the field
     */
    public function __construct(
        public string $type = 'text',
        public ?string $label = null,
        public bool $required = false,
        public ?string $placeholder = null,
        public array $options = []
    ) {}
}

/**
 * Modern Form Generator Example using PHP 8 Attributes
 * 
 * This abstract class uses reflection and PHP 8 attributes to generate
 * HTML form fields based on the properties of a class that extends it.
 */
abstract class ReflectionForm {
    /**
     * Holds metadata about form fields
     */
    private array $metadataFields = [];

    /**
     * Generate HTML form fields based on class properties and their attributes
     *
     * @return string The generated HTML form
     * @throws Exception If there's an error processing attributes
     */
    public function parse(): string {
        $this->getFormInfo();
        $generated = '';

        foreach ($this->metadataFields as $fieldName => $fieldParams) {
            $label = $fieldParams['label'] ?? ucfirst($fieldName);
            $type = $fieldParams['type'] ?? 'text';
            $required = $fieldParams['required'] ?? false;
            $placeholder = $fieldParams['placeholder'] ?? '';

            $generated .= "\t\t<div class=\"form-group\">\n";
            $generated .= "\t\t\t<label for=\"{$fieldName}\">{$label}</label>\n";
            $generated .= "\t\t\t<input type=\"{$type}\" name=\"{$fieldName}\" id=\"{$fieldName}\"";

            if ($required) {
                $generated .= " required";
            }

            if (!empty($placeholder)) {
                $generated .= " placeholder=\"{$placeholder}\"";
            }

            // Add value if the property has a value
            if (property_exists($this, $fieldName) && $this->$fieldName !== null) {
                $generated .= " value=\"" . htmlspecialchars($this->$fieldName) . "\"";
            }

            $generated .= " class=\"form-control\">\n";
            $generated .= "\t\t</div>\n";
        }

        return $generated;
    }

    /**
     * Extract form field information from property attributes
     *
     * @throws Exception If there's an error processing attributes
     */
    private function getFormInfo(): void {
        // Create a reflection object for the current instance
        $reflection = new ReflectionObject($this);

        // Get all properties of the class
        $properties = $reflection->getProperties();

        // Process each property
        foreach ($properties as $property) {
            // Get FormField attributes for the property
            $attributes = $property->getAttributes(FormField::class);

            if (!empty($attributes)) {
                // Get the first FormField attribute
                $formFieldAttribute = $attributes[0]->newInstance();

                // Store the field metadata
                $this->metadataFields[$property->getName()] = [
                    'type' => $formFieldAttribute->type,
                    'label' => $formFieldAttribute->label ?? ucfirst($property->getName()),
                    'required' => $formFieldAttribute->required,
                    'placeholder' => $formFieldAttribute->placeholder,
                    'options' => $formFieldAttribute->options
                ];
            }
        }
    }

    /**
     * Get the value of a property
     *
     * @param string $property Property name
     * @return mixed Property value or null if not found
     */
    protected function getPropertyValue(string $property) {
        return property_exists($this, $property) ? $this->$property : null;
    }
}
