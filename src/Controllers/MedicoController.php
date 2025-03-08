<?php 

namespace Controllers;

use Services\MedicoService;
use Repositories\MedicoRepository;
use Lib\Pages;
use Lib\Database;
use Models\Medico;
use PDO;
use Exception;

class MedicoController {
    private $medicoService;
    private $pages;

    public function __construct() {
        $db = new Database();
        $pdo = $db->getConnection();
        $medicoRepository = new MedicoRepository($pdo);
        $this->medicoService = new MedicoService($medicoRepository);
        $this->pages = new Pages();
    }

    public function verMedicos() {
        $medicos = $this->medicoService->getAllMedicos();
        $this->pages->render('Medico/VerMedicos', ['medicos' => $medicos]);
    }

    public function crearMedico() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nombre = $_POST['nombre'] ?? '';
                $apellidos = $_POST['apellidos'] ?? '';
                $especialidad = $_POST['especialidad'] ?? '';

                if (empty($nombre) || empty($apellidos) || empty($especialidad)) {
                    throw new Exception("Todos los campos son obligatorios");
                }

                $medico = new Medico(null, $nombre, $apellidos, $especialidad);
                $this->medicoService->addMedico($medico);

                header('Location: /verP');
                exit();
            } catch (Exception $e) {
                $this->pages->render('Medico/crearMedico', ['error' => $e->getMessage()]);
            }
        } else {
            $this->pages->render('Medico/crearMedico');
        }
    }
}
