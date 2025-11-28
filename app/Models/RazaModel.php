<?php
namespace App\Models;

use App\Database\Database;

class RazaModel {
    private const NOMBRE_CLASE = RazaModel::class;
    
    public $Id;
    public $Nombre;
    
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM razas");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::NOMBRE_CLASE);
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM razas WHERE Id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchObject(self::NOMBRE_CLASE);
    }

    public function agregar($data) {
        $stmt = $this->db->prepare("INSERT INTO razas (Nombre) VALUES (:nombre)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = $this->db->prepare("UPDATE razas SET Nombre = :nombre WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nombre' => $data['nombre'],
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM razas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
