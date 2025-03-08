<?php
namespace Routes;

use Controllers\EspController;
use Controllers\PacienteController;
use Controllers\MedicoController;
use Lib\Router;

class Routes {
    public static function index() {
        error_log("Checkpoint: Entrando a Routes::index");

        // Ruta principal de inicio
        Router::add('GET', '/', function () {
            error_log("Checkpoint: Cargando la vista de inicio");
            $pages = new \Lib\Pages();
            $pages->render('inicio'); 
        });

        // Rutas de paciente

        // Ruta para mostrar el formulario de registro
        Router::add('GET', '/register', function () {
            error_log("Checkpoint: Ruta GET /register ejecutada");
            (new PacienteController())->crearPaciente();
        });

        // Ruta para registrar un nuevo paciente (POST)
        Router::add('POST', '/register', function () {
            error_log("Checkpoint: Ruta POST /register ejecutada");
            (new PacienteController())->crearPaciente();
        });

        // Ruta para confirmar el registro
        Router::add('GET', '/confirmarRegistro', function () {
            (new PacienteController())->confirmarRegistro();
        });

        // Ruta para mostrar el formulario de inicio de sesión
        Router::add('GET', '/login', function () {
            error_log("Checkpoint: Ruta GET /login ejecutada");
            (new PacienteController())->iniciarSesion();
        });

        // Ruta para procesar el inicio de sesión (POST)
        Router::add('POST', '/login', function () {
            error_log("Checkpoint: Ruta POST /login ejecutada");
            (new PacienteController())->iniciarSesion();
        });

        // Ruta para cerrar sesión
        Router::add('GET', '/logout', function () {
            error_log("Checkpoint: Ruta GET /logout ejecutada");
            (new PacienteController())->cerrarSesion();
        });

        // Ruta para procesar el cierre de sesión (POST)
        Router::add('POST', '/logout', function () {
            error_log("Checkpoint: Ruta POST /logout ejecutada");
            (new PacienteController())->cerrarSesion();
        });

        // Ruta para recuperar la contraseña (GET)
        Router::add('GET', '/resetPassword', function () {
            (new PacienteController())->recuperarContrasena();
        });

        // Ruta para procesar la recuperación de contraseña (POST)
        Router::add('POST', 'resetPassword', function () {
            (new PacienteController())->recuperarContrasena();
        });


        Router::add('GET', '/restablecerContrasena', function () {
            (new PacienteController())->restablecerContrasena();
        });

        // Ruta para procesar la recuperación de contraseña (POST)
        Router::add('POST', 'restablecerContrasena', function () {
            (new PacienteController())->restablecerContrasena();
        });


        // Otras rutas de ejemplo
        Router::add('GET', '/verP', function () {
            // Aquí puedes agregar otro controlador, como el de Medico
            (new MedicoController())->verMedicos();
        });

        Router::add('GET', '/verPacientes', function () {
            // Aquí puedes agregar otro controlador, como el de Medico
            (new PacienteController())->verPacientes();
        });

        Router::add('GET', '/crearm', function () {
            // Aquí puedes agregar otro controlador, como el de Medico
            (new MedicoController())->crearMedico();
        });

        Router::add('GET', '/esp', function () {
            // Aquí puedes agregar otro controlador, como el de Medico
            (new EspController())->index();
        });


        Router::add('POST', 'crearm', function () {
            // Aquí puedes agregar otro controlador, como el de Medico
            (new MedicoController())->crearMedico();
        });

        // Despachar la solicitud
        Router::dispatch();
    }
}
