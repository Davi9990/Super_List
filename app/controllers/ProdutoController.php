<?php


require_once __DIR__ . "/../../view/produtos/index.php";
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
        require_once __DIR__ . "/../models/Produto.php";

        $produto = new Produto();
        $produtos = $produto->getAll();//Método que busca todos os produtos 

        require_once __DIR__."/../../view/produtos/index.php";
    }

    public function store()
    {
        $nome = $_POST["nome"] ?? "";
        $preco = $_POST["preco"] ?? "";

        if(!empty($nome) && !empty($preco))
        {
            require_once __DIR__."/../models/Produto.php";
            $produto = new Produto();
            $produto->create($nome, $preco);
        }

        // Redireciona para a página correta que exibe os produtos
        header("Location: /Super_List/routes/web.php");
        exit(); // IMPORTANTE: Encerra a execução para evitar bugs
    }

    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $this->produto->deletar($_GET["id"]);    
        }
        header("Location: /");
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