<?php

namespace Repositories;

use Models\Medico;
use PDO;
use PDOException;

class MedicoRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        try {
            $stmt = $this->pdo->query("SELECT * FROM medicos");
            $medicos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $medicos[] = Medico::fromArray($row);
            }
            return $medicos;
        } catch (PDOException $e) {
            throw new \Exception("Error al obtener los médicos: " . $e->getMessage());
        }
    }

    public function add(Medico $medico): bool {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO medicos (nombre, apellidos, especialidad) VALUES (:nombre, :apellidos, :especialidad)");
            return $stmt->execute([
                ':nombre' => $medico->getNombre(),
                ':apellidos' => $medico->getApellido(),
                ':especialidad' => $medico->getEspecialidad()
            ]);
        } catch (PDOException $e) {
            throw new \Exception("Error al añadir médico: " . $e->getMessage());
        }
    }
}
