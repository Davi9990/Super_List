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

    public function __construct(Produto $produto = null)
    {
        $this->produto = $produto ?? new Produto();
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
                //$produto = new Produto();
                $this->produto->create($nome, $preco);
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
        return $this->produto->getAll(); // Agora retorna direto do objeto injetado
    }  

    public function update()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $id = $_POST["id"] ?? "";
            $nome = $_POST["nome"]?? "";
            $preco = $_POST["preco"]?? "";

            if(!empty($id) &&!empty($nome) &&!empty($preco))
            {
                $this->produto->atualizar($id, $nome, $preco);
            }

            header("Location: /Super_List2/app/public/index.php");
        }
    }
}
?>