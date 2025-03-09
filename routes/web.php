<?php

require_once __DIR__."/../app/controllers/ProdutoController.php";

$controller = new ProdutoController();


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]))
{
    if($_POST["action"] === "add")
    {
        $controller->store();    
    }
}elseif($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "delete")
{
    $controller->delete();
}else
{
    $controller->index();    
}

?>