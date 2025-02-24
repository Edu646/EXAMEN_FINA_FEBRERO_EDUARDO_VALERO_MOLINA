

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

#P{
    text-align: center;
    color: #333;
    margin-top: 20px;
}

.container {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.product {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 20px;
}

.product img {
    max-width: 300px;
    height: auto;
    margin-right: 20px;
}

.product-details {
    flex: 1;
}

.product-details h2 {
    margin-top: 0;
}

.product-details p {
    margin: 5px 0;
}
    </style>
</head>
<body>
    <h1 id="P">Lista de Productos</h1>
    <div class="container">
        <?php foreach ($Medicos as $Medico): ?>
            <div class="product">
                <div class="product-details">
                    <h2><?= $Medico->getNombre() ?></h2>
                    <p><strong>nombre</strong> <?= $Medico->getNombre() ?></p>
                    <p><strong>apellidos</strong> <?=$Medico->getApellido()?></p>
                    <p><strong>especialidad</strong> <?=$Medico->getEspecialidad()?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>