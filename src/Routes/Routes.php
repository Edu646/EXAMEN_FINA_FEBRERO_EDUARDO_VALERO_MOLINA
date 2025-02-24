<?php

namespace Routes;
use Controllers\CategoryController;
use Controllers\AuthController;
use Controllers\PaymentController;
use Controllers\ProductoController;
use Lib\Router;  
use Src\Controllers\ErrorController;
use Lib\Database;
use Controllers\PedidoController;
use Controllers\MedicoController;

class Routes {
    public static function index() {
        error_log("Checkpoint: Entrando a Routes::index");

        Router::add('GET', '/', function () {
            error_log("Checkpoint: Cargando la vista de inicio");
            // Usa tu clase Pages para cargar la vista de inicio
            $pages = new \Lib\Pages();
            $pages->render('inicio'); 
        });

        



        Router::add('GET', '/listus/', function () {
            if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
                error_log("Acceso denegado a admin, redirigiendo a /error/");
                return (new ErrorController())->error404();
            }
        
        });
        
        
        // Ruta para errores
        Router::add('GET', '/error/', function () {
            error_log("Checkpoint: Ruta de error ejecutada");
            return (new ErrorController())->error404();
        });
        
        /* AUTH */
        Router::add('GET', '/register', function () {
            error_log("Checkpoint: Ruta GET /register ejecutada");
            (new AuthController())->register();
        });

        Router::add('POST', 'register', function () {
            error_log("Checkpoint: Ruta POST /register ejecutada");
            (new AuthController())->register();
        });

        // login
        Router::add('GET', 'login', function () {
            error_log("Checkpoint: Ruta GET /login ejecutada");
            (new AuthController())->login();
        });

        Router::add('POST', 'login', function () {
            error_log("Checkpoint: Ruta POST /login ejecutada");
            (new AuthController())->processLogin();
        });

      

        Router::add('GET', '/verP', function () {
            (new MedicoController())->verMEDICOS();
        });

      

    Router::add('GET', '/confirmRegistration', function () {
        (new AuthController())->confirmRegistration();
    });


    

    Router::add('POST', '/sendPasswordRecoveryToken', function () {
        (new AuthController())->sendPasswordRecoveryToken();
    });

    Router::add('GET', '/resetPassword', function () {
        (new AuthController())->resetPassword();
    });

    Router::add('POST', '/resetPassword', function () {
        (new AuthController())->resetPassword();
    });


// ...existing code...


        Router::dispatch();
    }
}
