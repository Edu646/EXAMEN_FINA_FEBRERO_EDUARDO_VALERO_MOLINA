<?php

namespace Repositories;

use Models\Esp;
use Lib\Database;
use PDO;

class EspRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM especialidades");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $esps = [];
        foreach ($results as $row) {
            $esps[] = new Esp($row['id'], $row['nombre'], $row['descripcion'], $row['precio']);
        }

        return $esps;
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM esps WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Esp($row['id'], $row['nombre'], $row['descripcion'], $row['precio']);
    }

    public function save(Esp $esp) {
        $stmt = $this->db->prepare("INSERT INTO esps (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)");
        $stmt->bindParam(':nombre', $esp->getNombre());
        $stmt->bindParam(':descripcion', $esp->getDescripcion());
        $stmt->bindParam(':precio', $esp->getPrecio());
        $stmt->execute();
    }

    public function update(Esp $esp) {
        $stmt = $this->db->prepare("UPDATE esps SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id");
        $stmt->bindParam(':id', $esp->getId());
        $stmt->bindParam(':nombre', $esp->getNombre());
        $stmt->bindParam(':descripcion', $esp->getDescripcion());
        $stmt->bindParam(':precio', $esp->getPrecio());
        $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM esps WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
