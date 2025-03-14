<?php

namespace App\controllers;
use App\config\Database;
use App\models\Produto;
use view\produtos\index;
use PDO;

//require_once __DIR__ . "/../../view/produtos/index.php";
require_once __DIR__ . "/../models/Produto.php";

class ProdutoController
{
    private $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function index()
    {
        $produtos = $this->produto->getAll(); // Recupera os produtos do banco

        include_once __DIR__ . "/../view/produtos/index.php";
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $nome = $_POST["nome"] ?? "";
            $preco = $_POST["preco"] ?? "";

            if(!empty($nome) && !empty($preco))
            {
                require_once __DIR__."/../models/Produto.php";
                $produto = new Produto();
                $produto->create($nome, $preco);
            }

            header("Location: /Super_List2/app/public/index.php");

            //$this->produto->deletar($_GET["id"]);
        }
    }

    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $this->produto->deletar($_GET["id"]);    
        }
        header("Location: /Super_List2/app/public/index.php");
    }

    
    public function getALL()
    {
        // Use o método connect da classe Database para obter a instância do PDO
        $pdo = \App\config\Database::connect(); // Chama a função connect() da classe Database
        $stmt = $pdo->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  
}
?>