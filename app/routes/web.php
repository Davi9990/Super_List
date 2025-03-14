<?php

namespace App\routes;
use App\controllers\ProdutoController;

require_once __DIR__ . "/../controllers/ProdutoController.php";

$controller = new ProdutoController();

$request_uri = $_SERVER["REQUEST_URI"];
$request_method = $_SERVER["REQUEST_METHOD"];



if ($request_method === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        $controller->store();
    }
}
if ($request_method === "GET" && isset($_GET["action"]) && $_GET["action"] === "delete") {
    $controller->delete();
    exit(); // Encerra o script após a exclusão
}
else {
    $controller->index(); // Sempre carregar a listagem na página inicial
}
?>
