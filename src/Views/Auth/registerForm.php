<style>
 
/* Contenedor del formulario */
form {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease-in-out;
}

form:hover {
    transform: translateY(-5px);
}

/* Título */
h3 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 15px;
}

/* Etiquetas */
label {
    margin-top: 12px;
    font-weight: 600;
    color: #555;
}

/* Campos de entrada */
input {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    transition: border 0.3s, box-shadow 0.3s;
}

/* Efecto al enfocar los inputs */
input:focus {
    border-color: #007BFF;
    box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
    outline: none;
}

/* Botón */
button {
    background: linear-gradient(45deg, #007BFF, #0056b3);
    color: white;
    border: none;
    padding: 12px;
    margin-top: 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
}

button:hover {
    background: linear-gradient(45deg, #0056b3, #003d80);
    transform: scale(1.05);
}

/* Mensajes de éxito y error */
.message {
    text-align: center;
    font-weight: bold;
    padding: 12px;
    border-radius: 6px;
    margin-top: 15px;
    font-size: 14px;
}

/* Mensaje de éxito */
.message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Mensaje de error */
.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

</style>
<h3>Registrarse</h3>
<form method="POST" action="<?php echo BASE_URL; ?>register">
    <label>Nombre:</label><input type="text" name="nombre" required>
    <label>Apellidos:</label><input type="text" name="apellidos" required>
    <label>Correo:</label><input type="email" name="correo" required>
    <label>Contraseña:</label><input type="password" name="password" required>
    <label>Teléfono:</label><input type="text" name="telefono" required>
    <label>DNI:</label><input type="text" name="DNI" required>

    <label>¿Tiene compañía aseguradora?</label>
    <select id="aseguradoraSelect" required onchange="toggleAseguradora()">
        <option value="no">No</option>
        <option value="si">Sí</option>
    </select>

    <label>Compañía Aseguradora:</label>
    <input type="text" name="comp_aseguradora" id="comp_aseguradora" value="No" readonly>

    <button type="submit">Crear Paciente</button>
</form>

<!-- Mensajes -->
<?php if (isset($_SESSION['register_success'])): ?>
    <p class="message success"><?= $_SESSION['register_success'] ?></p>
    <?php unset($_SESSION['register_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['register_error'])): ?>
    <p class="message error"><?= $_SESSION['register_error'] ?></p>
    <?php unset($_SESSION['register_error']); ?>
<?php endif; ?>

<script>
function toggleAseguradora() {
    let select = document.getElementById("aseguradoraSelect");
    let input = document.getElementById("comp_aseguradora");

    if (select.value === "si") {
        input.value = "";
        input.removeAttribute("readonly");
    } else {
        input.value = "No";
        input.setAttribute("readonly", "readonly");
    }
}
</script>