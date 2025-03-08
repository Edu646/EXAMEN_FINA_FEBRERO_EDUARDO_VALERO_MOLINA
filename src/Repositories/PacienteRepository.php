<?php

namespace Repositories;

use Models\Paciente;
use PDO;

class PacienteRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function crearPaciente(array $data): void
    {
        $sql = "INSERT INTO pacientes (nombre, apellidos, correo, password, telefono, DNI, ROL, Token, confirmado, comp_aseguradora)
                VALUES (:nombre, :apellidos, :correo, :password, :telefono, :DNI, :ROL, :Token, :confirmado, :comp_aseguradora)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function obtenerPorCorreo(string $correo): ?array
    {
        $sql = "SELECT * FROM pacientes WHERE correo = :correo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['correo' => $correo]);

        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $paciente ?: null;
    }

    public function obtenerPorToken(string $token): ?array
    {
        $sql = "SELECT * FROM pacientes WHERE Token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['token' => $token]);

        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $paciente ?: null;
    }

    public function confirmarPaciente(int $id): void
    {
        $sql = "UPDATE pacientes SET confirmado = 1, Token = NULL WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function obtenerPorId(int $id): ?array
    {
        $sql = "SELECT * FROM pacientes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        return $paciente ?: null;
    }
    
    public function obtenerTodos()
{
    $stmt = $this->db->query("SELECT * FROM pacientes");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pacientes = [];
    foreach ($result as $row) {
        $pacientes[] = new Paciente($row); // Convertir cada array en un objeto
    }

    return $pacientes;
}

    
    public function actualizarPaciente(int $id, array $data): void
    {
        $sql = "UPDATE pacientes SET 
                    nombre = :nombre, apellidos = :apellidos, correo = :correo, 
                    password = :password, telefono = :telefono, DNI = :DNI, 
                    ROL = :ROL, comp_aseguradora = :comp_aseguradora
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function eliminarPaciente(int $id): void
    {
        $sql = "DELETE FROM pacientes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function buscarPorCorreo($correo)
{
    $stmt = $this->db->prepare("SELECT * FROM pacientes WHERE correo = :correo");
    $stmt->execute(['correo' => $correo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function guardarTokenRecuperacion($id, $token)
{
    $stmt = $this->db->prepare("UPDATE pacientes SET Token = :token WHERE id = :id");
    $stmt->execute(['token' => $token, 'id' => $id]);
}

public function buscarPorTokenRecuperacion($token)
{
    $stmt = $this->db->prepare("SELECT * FROM pacientes WHERE Token = :token");
    $stmt->execute(['token' => $token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function actualizarContrasena($id, $nuevaPassword)
{
    $stmt = $this->db->prepare("UPDATE pacientes SET password = :password, Token = NULL WHERE id = :id");
    $stmt->execute(['password' => $nuevaPassword, 'id' => $id]);
}

}
