<?php
declare(strict_types=1);

// Include the Empresa class file
require_once 'Empresa.php';

// Use the FormGeneratorAttributes namespace
use FormGeneratorAttributes\Empresa;

/**
 * Example demonstrating the form generator functionality with PHP 8 Attributes
 */
try {
    // Create a new Empresa instance with sample data
    $empresa = new Empresa([
        'nome' => 'Empresa Exemplo',
        'razao_social' => 'Empresa Exemplo LTDA',
        'endereco' => 'Rua das Flores, 123',
        'cidade' => 'São Paulo',
        'estado' => 'SP',
        'email' => 'contato@exemplo.com'
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
    <title>Exemplo - Form Generator com Atributos PHP 8</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-control:focus {
            border-color: #4a90e2;
            outline: none;
        }
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #357ab8;
        }
        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body id="formGenerator">
    <?php if (isset($errorMessage)): ?>
        <div class="error"><?= $errorMessage ?></div>
    <?php else: ?>
        <h1>Formulário de Empresa com Atributos PHP 8</h1>
        <form action="" method="post" accept-charset="utf-8">
            <?= $formHtml ?>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
        <div style="text-align: center; margin-top: 20px; color: #666;">
            <p>Este formulário foi gerado automaticamente usando atributos PHP 8.</p>
        </div>
    <?php endif; ?>
</body>
</html>
