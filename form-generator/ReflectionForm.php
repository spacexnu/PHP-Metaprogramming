<?php
declare(strict_types=1);

namespace FormGenerator;

use ReflectionObject;
use ReflectionProperty;

/**
 * Form Generator Example
 * 
 * This abstract class uses reflection to generate HTML form fields
 * based on the properties of a class that extends it.
 */
abstract class ReflectionForm {
    /**
     * Holds the generated HTML form
     */
    private ?string $generated = null;

    /**
     * Constructor
     */
    public function __construct() {
        $this->generated = '';
    }

    /**
     * Generate HTML form fields based on class properties
     *
     * @return string The generated HTML form
     */
    public function parse(): string {
        // Create a reflection object for the current instance
        $reflection = new ReflectionObject($this);

        // Get all properties of the class
        $fields = $reflection->getProperties();

        // Generate HTML for each property
        array_walk($fields, function(ReflectionProperty $field): void {
            $fieldName = $field->getName();
            $this->generated .= "\t\t<div>" . ucfirst($fieldName) . "</div>\n";
            $this->generated .= "\t\t<div><input type=\"text\" name=\"{$fieldName}\" /></div>\n";
        });

        // Store the generated HTML and reset the property
        $generatedHtml = $this->generated;
        $this->generated = '';

        return $generatedHtml;
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
