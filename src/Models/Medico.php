<?php 
namespace Models;

use PDO;
use Lib\Database; // Asegúrate de tener una clase Database para manejar la conexión

class Medico {
    private $id;
    private $nombre;
    private $apellidos;
    private $especialidadId;
    private $especialidadNombre; // Nuevo atributo para almacenar el nombre de la especialidad

    public function __construct($id, $nombre, $apellidos, $especialidadId)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->especialidadId = $especialidadId;
        $this->especialidadNombre = $this->obtenerNombreEspecialidad($especialidadId);
    }

    public static function fromArray(array $data) {
        return new self(
            $data['id'] ?? null, 
            $data['nombre'] ?? '', 
            $data['apellidos'] ?? '',
            $data['especialidad_id'] ?? null // Ajustado para usar el ID de la especialidad
        );
    }

    // Método para obtener el nombre de la especialidad desde la base de datos
    private function obtenerNombreEspecialidad($especialidadId) {
        if (!$especialidadId) return 'No asignada';
        
        $db = Database::getConnection(); // Obtener la conexión a la BD
        $stmt = $db->prepare("SELECT nombre FROM especialidades WHERE id = ?");
        $stmt->execute([$especialidadId]);
        $especialidad = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $especialidad['nombre'] ?? 'No asignada';
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }
    
    public function getEspecialidadId() {
        return $this->especialidadId;
    }

    public function getEspecialidadNombre() {
        return $this->especialidadNombre;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEspecialidadId($especialidadId) {
        $this->especialidadId = $especialidadId;
        $this->especialidadNombre = $this->obtenerNombreEspecialidad($especialidadId); // Actualizar el nombre
    }
    
    // Convertir a array
    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'especialidad_id' => $this->especialidadId,
            'especialidad_nombre' => $this->especialidadNombre,
        ];
    }
}
