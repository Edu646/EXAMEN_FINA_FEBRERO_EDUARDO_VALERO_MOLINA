<?php

namespace Services;

use Repositories\MedicoRepository;
use Models\Medico;

class MedicoService {
    private $medicoRepository;

    public function __construct(MedicoRepository $medicoRepository) {
        $this->medicoRepository = $medicoRepository;
    }

    public function getAllMedicos(): array {
        return $this->medicoRepository->getAll();
    }

    public function addMedico(Medico $medico): bool {
        return $this->medicoRepository->add($medico);
    }
}
