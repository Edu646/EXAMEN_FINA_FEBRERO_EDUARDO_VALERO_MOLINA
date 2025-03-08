<?php

namespace Controllers;

use Models\Esp;
use Services\EspService;
use Lib\Pages;

class EspController {
    private $espService;
    private $pages;

    public function __construct() {
        $this->espService = new EspService();
        $this->pages = new Pages(); // Instancia de Pages
    }

    public function index() {
        $esps = $this->espService->getAll();
        $this->pages->render('Especialidades/index', ['esps' => $esps]);
    }

    public function show($id) {
        $esp = $this->espService->getById($id);
        $this->pages->render('esp/show', ['esp' => $esp]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $esp = new Esp(null, $nombre, $descripcion, $precio);
            $this->espService->save($esp);

            header('Location: /esp');
        } else {
            $this->pages->render('esp/create');
        }
    }

    public function edit($id) {
        $esp = $this->espService->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $esp->setNombre($_POST['nombre']);
            $esp->setDescripcion($_POST['descripcion']);
            $esp->setPrecio($_POST['precio']);
            $this->espService->update($esp);

            header('Location: /esp');
        }

        $this->pages->render('esp/edit', ['esp' => $esp]);
    }

    public function delete($id) {
        $this->espService->delete($id);
        header('Location: /esp');
    }
}
