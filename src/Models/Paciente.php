<?php

namespace Models;

class Paciente
{
    private ?int $id;
    private string $nombre;
    private string $apellidos;
    private string $correo;
    private string $password;
    private string $telefono;
    private string $DNI;
    private string $ROL;
    private ?string $token;
    private bool $confirmado;
    private ?string $comp_aseguradora;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->apellidos = $data['apellidos'];
        $this->correo = $data['correo'];
        $this->password = $data['password'];
        $this->telefono = $data['telefono'];
        $this->DNI = $data['DNI'];
        $this->ROL = $data['ROL'];
        $this->token = $data['token'] ?? null;
        $this->confirmado = $data['confirmado'] ?? false;
        $this->comp_aseguradora = $data['comp_aseguradora'] ?? null;
    }

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getApellidos(): string { return $this->apellidos; }
    public function getCorreo(): string { return $this->correo; }
    public function getPassword(): string { return $this->password; }
    public function getTelefono(): string { return $this->telefono; }
    public function getDNI(): string { return $this->DNI; }
    public function getROL(): string { return $this->ROL; }
    public function getToken(): ?string { return $this->token; }
    public function isConfirmado(): bool { return $this->confirmado; }
    public function getCompAseguradora(): ?string { return $this->comp_aseguradora; }

    // Setters
    public function setId(?int $id): void { $this->id = $id; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setApellidos(string $apellidos): void { $this->apellidos = $apellidos; }
    public function setCorreo(string $correo): void { $this->correo = $correo; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setTelefono(string $telefono): void { $this->telefono = $telefono; }
    public function setDNI(string $DNI): void { $this->DNI = $DNI; }
    public function setROL(string $ROL): void { $this->ROL = $ROL; }
    public function setToken(?string $token): void { $this->token = $token; }
    public function setConfirmado(bool $confirmado): void { $this->confirmado = $confirmado; }
    public function setCompAseguradora(?string $comp_aseguradora): void { $this->comp_aseguradora = $comp_aseguradora; }
}