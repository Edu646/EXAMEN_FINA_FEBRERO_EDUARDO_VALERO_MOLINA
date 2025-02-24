<?php 
namespace Models;
use PDO;
class Medico{
    private $id;
    private $nombre;
    private $apellidos;
    private $especialidad;
   

    public function __construct($id, $nombre, $apellidos, $especialidad)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->especialidad = $especialidad;
        
    }

    public static function fromArray(array $data) {
        return new self(
            $data['id'],
            $data['nombre'],
            $data['apellidos'],
            $data['especialidad']
        );
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellidos;
    }
    
    public function getEspecialidad() {
        return $this->especialidad;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function setApellido($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEspecialidad($especialidad) {
        $this->especialidad = $especialidad;
    }
    
    

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'especialidad' => $this->especialidad,
            
        ];
    }
}
