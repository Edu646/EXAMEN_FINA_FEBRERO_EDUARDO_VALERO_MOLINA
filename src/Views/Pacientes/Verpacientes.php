<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #P {
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

        .patient {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .patient-details {
            flex: 1;
        }

        .patient-details h2 {
            margin-top: 0;
        }

        .patient-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1 id="P">Lista de Pacientes</h1>
    <div class="container">
        <?php if (!empty($Pacientes)): ?>
            <?php foreach ($Pacientes as $paciente): ?>
                <div class="patient">
                    <div class="patient-details">
                        <h2><?= htmlspecialchars($paciente->getNombre()) ?></h2>
                        <p><strong>Nombre:</strong> <?= htmlspecialchars($paciente->getNombre()) ?></p>
                        <p><strong>Apellidos:</strong> <?= htmlspecialchars($paciente->getApellidos()) ?></p>
                        <p><strong>Correo:</strong> <?= htmlspecialchars($paciente->getCorreo()) ?></p>
                        <p><strong>Teléfono:</strong> <?= htmlspecialchars($paciente->getTelefono()) ?></p>
                        <p><strong>DNI:</strong> <?= htmlspecialchars($paciente->getDNI()) ?></p>
                        <p><strong>Compañía Aseguradora:</strong> <?= htmlspecialchars($paciente->getCompAseguradora()) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay pacientes registrados.</p>
        <?php endif; ?>
    </div>
</body>
</html>