<?php 

namespace Controllers;

use Services\MedicoService;
use Repositories\MedicoRepository;
use Lib\Pages;
use Lib\Database;
use Models\Medico;
use PDO;
use PDOException;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class MedicoController {
    private $MedicoService;
    private $pages;

    public function __construct() {
        $db = new Database();
        $pdo = $db->getConnection();
        $MedicoRepository = new \Repositories\MedicoRepository($pdo);
        $this->MedicoService = new MedicoService($MedicoRepository);
        $this->pages = new Pages();
    }

    


    public function verMEDICOS() {
        $Medicos = $this->MedicoService->getAllMedicos();
        $this->pages->render('Medico/VerMedicos', ['Medicos' => $Medicos]);
       
    }



    
    
    
}