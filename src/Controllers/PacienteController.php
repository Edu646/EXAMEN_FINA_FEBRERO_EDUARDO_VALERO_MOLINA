<?php

namespace Controllers;

use Lib\Pages;
use Models\Paciente;
use Repositories\PacienteRepository;
use Services\PacienteService;
use PDO;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PacienteController
{
    private $pacienteService;
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
        
        try {
            // Conectar a la base de datos con manejo de errores
            $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=clinica;charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }

        $pacienteRepository = new PacienteRepository($db);
        $this->pacienteService = new PacienteService($pacienteRepository);
    }

    // Crear un nuevo paciente con token de confirmación
    public function crearPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = bin2hex(random_bytes(32));

            $data = [
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'correo' => $_POST['correo'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'telefono' => $_POST['telefono'],
                'DNI' => $_POST['DNI'],
                'ROL' => 'paciente',
                'comp_aseguradora' => $_POST['comp_aseguradora'],
                'Token' => $token,
                'confirmado' => 0
            ];

            $this->pacienteService->crearPaciente($data);
            $this->enviarCorreo($data['correo'], $token);

            echo "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
        } else {
            Pages::render('Auth/registerForm');
        }
    }

    // Enviar correo con enlace de confirmación
    private function enviarCorreo($correo, $token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '828a04b69cf388';
            $mail->Password = 'd5c6c03cad7d30';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@clinica.com', 'Clinica');
            $mail->addAddress($correo);

            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de registro en la Clínica';

            $urlConfirmacion = BASE_URL . "confirmarRegistro?token=" . $token;
            $mail->Body = "Gracias por registrarte en nuestra clínica. Para confirmar tu cuenta, haz clic en el siguiente enlace: <a href='$urlConfirmacion'>$urlConfirmacion</a>";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
        }
    }

    // Confirmar registro de usuario mediante token
    public function confirmarRegistro()
    {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $paciente = $this->pacienteService->obtenerPorToken($token);

            if ($paciente) {
                $this->pacienteService->confirmarPaciente($paciente['id']);
                echo "Cuenta confirmada con éxito. Ahora puedes iniciar sesión.";
            } else {
                echo "Token inválido o expirado.";
            }
        } else {
            echo "Token no proporcionado.";
        }
    }

    public function iniciarSesion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            $paciente = $this->pacienteService->verificarCredenciales($correo, $password);

            if ($paciente) {
                session_start();
                $_SESSION['paciente_id'] = $paciente['id'];
                $_SESSION['nombre'] = $paciente['nombre'];
                $_SESSION['ROL'] = $paciente['ROL'];

                header('Location: ' . BASE_URL);
                exit();
            } else {
                echo "Correo o contraseña incorrectos.";
            }
        } else {
            Pages::render('Auth/login');
        }
    }

    public function cerrarSesion()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: ' . BASE_URL);
        exit();
    }

    public function recuperarContrasena()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $paciente = $this->pacienteService->obtenerPorCorreo($correo);
    
            if ($paciente) {
                // Generar el token
                $token = bin2hex(random_bytes(32));
                // Guardar el token en la base de datos
                $this->pacienteService->guardarTokenRecuperacion($paciente['id'], $token);
                
                // Generar un enlace sin el token visible
                $urlRecuperacion = BASE_URL . "restablecerContrasena";
                $this->enviarCorreoRecuperacion($correo, $urlRecuperacion, $token);
    
                echo "Hemos enviado un enlace de recuperación a tu correo.";
            } else {
                echo "No se encontró ninguna cuenta con ese correo.";
            }
        } else {
            Pages::render('Auth/resetPasswordForm');
        }
    }
    
    private function enviarCorreoRecuperacion($correo, $urlRecuperacion, $token)
    {
      
        $_SESSION['token_recuperacion'] = $token; // Guardamos el token en la sesión (puedes hacerlo en la base de datos si lo prefieres)
    
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '828a04b69cf388';
            $mail->Password = 'd5c6c03cad7d30';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('no-reply@clinica.com', 'Clinica');
            $mail->addAddress($correo);
    
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
    
            // Enviar el enlace sin el token en la URL
            $urlRecuperacionConToken = $urlRecuperacion;
    
            $mail->Body = "Para restablecer tu contraseña, haz clic en el siguiente enlace: <a href='$urlRecuperacionConToken'>$urlRecuperacionConToken</a>";
    
            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
        }
    }
    
    public function restablecerContrasena()
{

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        // Recuperar el token de la sesión
        $token = $_SESSION['token_recuperacion'] ?? null;

        // Validar el token
        if ($token) {
            $nuevaPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Buscar el paciente por el token
            $paciente = $this->pacienteService->obtenerPorTokenRecuperacion($token);

            if ($paciente) {
                // Actualizar la contraseña
                $this->pacienteService->actualizarContrasena($paciente['id'], $nuevaPassword);
                echo "Contraseña actualizada con éxito.";

                // Eliminar el token de la sesión después de usarlo
                unset($_SESSION['token_recuperacion']);
            } else {
                echo "Token inválido o expirado.";
            }
        } else {
            echo "Token no proporcionado o ha expirado.";
        }
    } else {
        // Mostrar el formulario para cambiar la contraseña (sin necesidad de token en la URL)
        Pages::render('Auth/resetPasswordForm');
    }
}

public function verPacientes() {
    $pacientes = $this->pacienteService->obtenerTodos();
    $this->pages->render('Pacientes/Verpacientes', ['Pacientes' => $pacientes]);
}
    
}
