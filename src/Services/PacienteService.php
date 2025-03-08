<?php

namespace Services;

use Models\Paciente;
use Repositories\PacienteRepository;

class PacienteService
{
    private PacienteRepository $pacienteRepository;

    public function __construct(PacienteRepository $pacienteRepository)
    {
        $this->pacienteRepository = $pacienteRepository;
    }

    public function crearPaciente(array $data): void
    {
        $this->pacienteRepository->crearPaciente($data);
    }

    public function verificarCredenciales(string $correo, string $password): ?array
    {
        $paciente = $this->pacienteRepository->obtenerPorCorreo($correo);

        if ($paciente && password_verify($password, $paciente['password'])) {
            return $paciente;
        }

        return null;
    }

    public function obtenerPorToken(string $token): ?array
    {
        return $this->pacienteRepository->obtenerPorToken($token);
    }

    public function confirmarPaciente(int $id): void
    {
        $this->pacienteRepository->confirmarPaciente($id);
    }

    public function obtenerPorId(int $id): ?array
    {
        return $this->pacienteRepository->obtenerPorId($id);
    }

    public function obtenerTodos(): array
    {
        return $this->pacienteRepository->obtenerTodos();
    }

    public function actualizarPaciente(int $id, array $data): void
    {
        $this->pacienteRepository->actualizarPaciente($id, $data);
    }

    public function eliminarPaciente(int $id): void
    {
        $this->pacienteRepository->eliminarPaciente($id);
    }

    public function obtenerPorCorreo($correo)
{
    return $this->pacienteRepository->buscarPorCorreo($correo);
}

public function guardarTokenRecuperacion($id, $token)
{
    $this->pacienteRepository->guardarTokenRecuperacion($id, $token);
}

public function obtenerPorTokenRecuperacion($token)
{
    return $this->pacienteRepository->buscarPorTokenRecuperacion($token);
}

public function actualizarContrasena($id, $nuevaPassword)
{
    $this->pacienteRepository->actualizarContrasena($id, $nuevaPassword);
}
}
