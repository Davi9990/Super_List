<?php

require_once __DIR__ . "/../config/database.php";


class Produto {
    private $db;

    public function __construct() {
        $this->db = Database::connect(); // Garante que é uma instância de PDO
    }

    //Função para pegar todos os produtos
    public function getAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM produtos"); // Verifique se o nome da tabela está correto!
        return $stmt->fetchAll();
    
        return $result;
    }

    public function create($nome, $preco)
    {
        $sql = "INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":preco", $preco);
        return $stmt->execute();
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
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
