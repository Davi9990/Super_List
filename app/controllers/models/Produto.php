<?php
require_once __DIR__ . "/../../../config/database.php";

class Produto {
    private $db;

    public function __construct() {
        $this->db = Database::connect(); // Garante que é uma instância de PDO
    }

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM produtos ORDER BY id DESC"); 
        return $stmt->fetchAll();
    }

    public function adicionar($nome, $preco) {
        $stmt = $this->db->prepare("INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)");
        return $stmt->execute(["nome" => $nome, "preco" => $preco]);
    }

    public function deletar($id) {
        $stmt = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}
?>
