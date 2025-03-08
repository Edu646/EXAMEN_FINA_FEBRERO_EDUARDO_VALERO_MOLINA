<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/../../../config/config.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin: 0 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            nav ul li {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido a la clínica</h1>
    <nav>
        <ul>
            <?php if (isset($_SESSION['paciente_id'])): ?>
                <li>Bienvenido, <strong><?= htmlspecialchars($_SESSION['nombre'] ?? 'Paciente') ?></strong></li>
                <li><a href="<?= BASE_URL ?>logout">Cerrar Sesión</a></li>
                <li><a href="<?= BASE_URL ?>esp">Lista Especialidades</a></li>
                <li><a href="<?= BASE_URL ?>verP">Lista de Médicos</a></li>
                <li><a href="<?= BASE_URL ?>citas">Mis Citas</a></li>

                <?php if (isset($_SESSION['ROL']) && $_SESSION['ROL'] === 'paciente'): ?>
                    <li><a href="<?= BASE_URL ?>historial">Historial Médico</a></li>
                    <li><a href="<?= BASE_URL ?>perfil">Mi Perfil</a></li>
                <?php elseif (isset($_SESSION['ROL']) && $_SESSION['ROL'] === 'admin'): ?>
                    <li><a href="<?= BASE_URL ?>verPacientes">Gestión de Usuarios</a></li>
                    <li><a href="<?= BASE_URL ?>crearm">Crear medicos</a></li>
                <?php endif; ?>

            <?php else: ?>
                <li><a href="<?= BASE_URL ?>">Inicio</a></li>
                <li><a href="<?= BASE_URL ?>login">Iniciar Sesión</a></li>
                <li><a href="<?= BASE_URL ?>register">Registrarse</a></li>
                <li><a href="<?= BASE_URL ?>esp">Lista Especialidades</a></li>
                <li><a href="<?= BASE_URL ?>verP">Lista de Médicos</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<div class="container">
    <!-- El contenido específico para el rol puede ir aquí -->
    <?php if (isset($_SESSION['ROL']) && $_SESSION['ROL'] === 'admin'): ?>
        <h2>Panel de Administración</h2>
        <p>Aquí puedes gestionar el sistema, usuarios, reportes y configuraciones.</p>
    <?php elseif (isset($_SESSION['ROL']) && $_SESSION['ROL'] === 'paciente'): ?>
        <h2>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></h2>
        <p>Tu panel de paciente está listo para gestionar tus citas y ver tus especialidades y médicos.</p>
    <?php else: ?>
        <h2>Bienvenido a la clínica</h2>
        <p>Inicia sesión o regístrate para acceder a más funciones.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 Clínica. Todos los derechos reservados.</p>
</footer>

</body>
</html>
