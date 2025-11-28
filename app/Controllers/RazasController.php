<?php
namespace App\Controllers;
use App\Models\RazaModel;

class RazasController {
    private $model;

    public function __construct() {
        $this->model = new RazaModel();
    }

    public function index() {
        $razas = $this->model->obtenerTodos();
        $title = 'Lista de Razas';
        $css_specific = 'raza';
        $content = '../app/Views/Razas/index.php';
        require '../app/Views/layout.php';
    }

    public function crear() {
        $title = 'Crear Raza';
        $css_specific = 'raza';
        $content = '../app/Views/Razas/crear.php';
        require '../app/Views/layout.php';
    }

    public function guardar() {
        $this->model->agregar($_POST);
        header('Location: ' . BASE_URL . '/Razas');
    }

    public function editar($id) {
        $persona = $this->model->obtenerPorId($id);
        $css_specific = 'raza';
        $content = '../app/Views/Razas/editar.php';
        require  '../app/Views/layout.php';
    }

    public function actualizar($id) {
        $this->model->actualizar($id, $_POST);
        header('Location: ' . BASE_URL . '/Razas');
    }

    public function eliminar($id) {
        $this->model->eliminar($id);
        header('Location: ' . BASE_URL . '/Razas');
    }
}
