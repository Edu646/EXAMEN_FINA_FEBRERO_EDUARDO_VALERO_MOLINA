<?php
namespace Services;

use Repositories\EspRepository;
use Models\Esp;

class EspService {
    private $espRepository;

    public function __construct() {
        $this->espRepository = new EspRepository();
    }

    public function getAll() {
        return $this->espRepository->getAll();
    }

    public function getById($id) {
        return $this->espRepository->getById($id);
    }

    public function save(Esp $esp) {
        $this->espRepository->save($esp);
    }

    public function update(Esp $esp) {
        $this->espRepository->update($esp);
    }

    public function delete($id) {
        $this->espRepository->delete($id);
    }
}
