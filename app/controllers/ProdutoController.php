<?php

require_once realpath(dirname(__FILE__) . "/../../view/produtos/index.php");

class ProdutoController
{
    private $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function index()
    {
        $produtos = $this->produto->listar();
        require_once __DIR__."/../view/produtos/index.php";
    }

    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $this->produto->deletar($_GET["id"]);
        }
    }

    public function delete()
    {
        if(isset($_GET["id"]))
        {
            $this->produto->deletar($_GET["id"]);    
        }
        header("Location: /");
    }
}
?>