<?php

namespace Repositories;

use Models\Medico;
use PDO;
use PDOException;
use Exception;

class MedicoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM medicos");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function($data) {
            return Medico::fromArray($data);
        }, $result);
    }


    // Repositorio ProductoRepository
    public function getAllMedicos() {
    $sql = "SELECT * FROM medicos";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
    }

}
    
    


