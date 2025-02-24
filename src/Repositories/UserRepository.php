<?php 
namespace Repositories;

use Models\User;
use PDO;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=clinica', 'root', '');
    }

    public function save(User $user): void
{
    // Asignar valores a variables para evitar el paso directo
    $nombre = $user->getNombre();
    $apellidos = $user->getApellidos();
    $correo = $user->getEmail();
    $password = $user->getPassword();
    $telefono = $user->getTelefono();
    $dni = $user->getDni();
    $token = $user->getToken();

    $stmt = $this->db->prepare('INSERT INTO usuarios (nombre, email, password, rol,token) VALUES (:nombre, :email, :password, :rol , :token)');
    
    // Ahora pasamos las variables en lugar de los métodos directamente
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':password', $password);
    $stmt-> bindParam(':telefono', $telefono);
    $stmt-> bindParam(':dni', $dni);
    $stmt->bindParam(':token', $token);
    
    $stmt->execute();
}

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM pacientes WHERE correo = :correo LIMIT 1');
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? User::fromArray($data) : null;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare('SELECT * FROM pacientes WHERE id = :id LIMIT 1');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? User::fromArray($data) : null;
    }

    public function findAll(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM pacientes');
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($usuarioData) {
            return User::fromArray($usuarioData);
        }, $usuarios);
    }

    public function update(User $user): void
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET nombre = :nombre, correo = :correo WHERE id = :id');
        $stmt->bindParam(':nombre', $user->getNombre());
        $stmt->bindParam(':apellidos', $user->getApellidos());
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':telefono', $user->getTelefono());
        $stmt->bindParam(':dni', $user->getDni());
        $stmt->bindParam(':id', $user->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM pacientes WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function saveRecoveryToken($userId, $token)
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET recovery_token = :token WHERE id = :id');
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function findByRecoveryToken($token)
    {
        $stmt = $this->db->prepare('SELECT * FROM pacientes WHERE recovery_token = :token LIMIT 1');
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return User::fromArray($user);
        }

        return null;
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET password = :password WHERE id = :id');
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function clearRecoveryToken($userId)
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET recovery_token = NULL WHERE id = :id');
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function saveToken($userId, $token)
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET token = :token WHERE id = :id');
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function confirmUser($userId)
    {
        $stmt = $this->db->prepare('UPDATE pacientes SET confirmado = 1 WHERE id = :id');
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }
}
?>
