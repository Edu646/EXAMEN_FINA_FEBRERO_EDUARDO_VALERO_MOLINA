<?php
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>

<h2>Registrar Médico</h2>

<form action="crearm" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" required>

    <label for="especialidad">Especialidad:</label>
    <input type="text" name="especialidad" required>

    <button type="submit">Guardar</button>
</form>
