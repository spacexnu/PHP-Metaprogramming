<?php
declare(strict_types=1);

// Include the Empresa class file
require_once 'Empresa.php';

// Use the FormGenerator namespace
use FormGenerator\Empresa;

/**
 * Example demonstrating the form generator functionality
 */
try {
    // Create a new Empresa instance with sample data
    $empresa = new Empresa([
        'nome' => 'Empresa Exemplo',
        'razao_social' => 'Empresa Exemplo LTDA',
        'endereco' => 'Rua das Flores, 123',
        'cidade' => 'São Paulo',
        'estado' => 'SP'
    ]);

    // Generate the form HTML
    $formHtml = $empresa->parse();

} catch (\Exception $e) {
    // Handle any exceptions that might occur
    $errorMessage = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo - Form Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
        }
        div {
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body id="formGenerator">
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?= $errorMessage ?></div>
    <?php else: ?>
        <h1>Formulário de Empresa</h1>
        <form action="" method="post" accept-charset="utf-8">
            <?= $formHtml ?>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
