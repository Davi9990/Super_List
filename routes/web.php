<?php

require_once __DIR__ . "/../app/controllers/ProdutoController.php";

$controller = new ProdutoController();

$request_uri = $_SERVER["REQUEST_URI"];
$request_method = $_SERVER["REQUEST_METHOD"];



if ($request_method === "POST" && isset($_POST["action"])) {
    if ($_POST["action"] === "add") {
        $controller->store();
    }
} else {
    $controller->index(); // Sempre carregar a listagem na página inicial
}
?>
