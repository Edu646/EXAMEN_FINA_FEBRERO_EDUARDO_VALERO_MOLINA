<?php if (isset($_SESSION['register_success'])): ?>
    <p style="color: green;"><?= $_SESSION['register_success'] ?></p>
    <?php unset($_SESSION['register_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['register_error'])): ?>
    <p style="color: red;"><?= $_SESSION['register_error'] ?></p>
    <?php unset($_SESSION['register_error']); ?>
<?php endif; ?>

<h3>Iniciar Sesión</h3>
<form action="<?= BASE_URL ?>login" method="POST">
    <label for="correo">Correo:</label>
    <input type="email" name="correo" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Iniciar Sesión</button>
</form>

<div class="container">
    <h2>Recuperar Contraseña</h2>
    <form action="<?= BASE_URL ?>resetPassword" method="POST">
        <label for="correo">Introduce tu correo electrónico:</label>
        <input type="email" name="correo" required>
        
        <button type="submit">Recuperar Contraseña</button>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="message" style="color: red;">
            <p><?= $error_message ?></p>
        </div>
    <?php endif; ?>
</div>
