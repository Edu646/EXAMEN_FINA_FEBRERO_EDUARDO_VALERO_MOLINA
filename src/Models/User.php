<?php
namespace Models;

class User {

    protected static array $errores = [];

    public function __construct(
        private ?int $id = null,
        private string $nombre = '',
        private string $apellidos = '',
        private string $correo = '',
        private string $password = '',
        private string $telefono = '',
        private string $dni = '',
        private string $token = ''
    ) {}

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function getEmail(): string {
        return $this->correo;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function getDni(): string {
        return $this->dni;
    }



    public static function getErrores(): array {
        return self::$errores;
    }

    // Método adicional para obtener errores (necesario para el AuthController)
    public function getErrors(): array {
        return self::$errores;
    }


    public function gettoken(): string {
        return $this->token;
    }
    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setEmail(string $correo): void {
        $this->correo = $correo;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function setDni(string $dni): void {
        $this->dni = $dni;
    }

    public static function setErrores(array $errores): void {
        self::$errores = $errores;
    }

    public function settoken($token): void {
        $this->token = $token;
    }

    // Validación de los datos
    public function validar(): bool {
        self::$errores = [];

        if (empty($this->nombre)) {
            self::$errores[] = "El nombre es obligatorio.";
        }

        if (empty($this->email)) {
            self::$errores[] = "El correo electrónico es obligatorio.";
        } elseif (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "El formato del correo electrónico no es válido.";
        }

        if (empty($this->password)) {
            self::$errores[] = "La contraseña es obligatoria.";
        }

        if (empty($this-> telefono)) {
            self::$errores[] = "El telefono es obligatorio.";
        }

        if (empty($this->dni)) {
            self::$errores[] = "El dni es obligatorio.";
        }

        return empty(self::$errores);
    }

    // Sanitizar los datos del usuario
    public function sanitize(): void {
        $this->nombre = htmlspecialchars($this->nombre);
        $this->apellidos = htmlspecialchars($this->apellidos);
        $this->correo = filter_var($this->correo, FILTER_SANITIZE_EMAIL);
        $this->password = htmlspecialchars($this->password);
        $this->telefono = htmlspecialchars($this->telefono);
        $this->dni = htmlspecialchars($this->dni);
    }

    // Crear una instancia desde un array
    public static function fromArray(array $data): User {
        $user = new self();
        $user->id = $data['id'] ?? 0;
        $user->nombre = $data['nombre'];
        $user->correo = $data['correo'];
        $user->password = $data['password'];
        $user-> telefono = $data['telefono'];
        $user->dni = $data['dni'];
        $user->token = $data['token'] ?? '';
        return $user;
    }

    // Convertir el objeto a un array
    public function toArray(): array {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'email' => $this->correo,
            'password' => $this->password,
            'telefono' => $this->telefono,
            'dni' => $this->dni,
            'token' => $this->token
        ];
    }
}
?>
