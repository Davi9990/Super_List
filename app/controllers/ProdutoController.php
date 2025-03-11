<?php

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

        include_once __DIR__ . "/../../view/produtos/index.php";
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

            header("Location: /Super_List/routes/web.php");

            //$this->produto->deletar($_GET["id"]);
        }
    }

    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $this->produto->deletar($_GET["id"]);    
        }
        header("Location: /Super_List/routes/web.php");
    }

    
    public function getALL()
    {
        require_once __DIR__."/../../config/database.php";
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM produtos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>