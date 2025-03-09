<?php

/*
echo "<pre";
print_r($_POST);
echo "</pre>";
die();
*/

require_once __DIR__ . "/../app/controllers/ProdutoController.php";

$controller = new ProdutoController();

// Captura a URL requisitada
$request_uri = $_SERVER["REQUEST_URI"];
$request_method = $_SERVER["REQUEST_METHOD"];

// Roteamento baseado no método HTTP e na ação
if ($request_method === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "add") {
        $controller->store();
    }
} elseif ($request_method === "GET") {
    if (isset($_GET["action"]) && $_GET["action"] === "delete") {
        $controller->delete();
    } elseif ($request_uri === "/Super_List/produto/store") {
        $controller->store();
    } else {
        $controller->index();
    }
} else {
    $controller->index();
}

?>
