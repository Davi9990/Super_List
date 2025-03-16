<?php

use App\routes\web;
use App\controllers\ProdutoController;

beforeEach(function () {
    // Certifique-se de que o controlador está sendo instanciado corretamente.
    $this->controller = mock(ProdutoController::class);
});

// Testando a ação "add" com método POST
it('Testando o metodo de adicionar', function () {
    // Simula uma requisição POST com ação "add"
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['action'] = 'add';

    // Chama o arquivo web.php (simulando a execução)
    require_once __DIR__ . '/../app/routes/web.php';

    // Verifica se o método store foi chamado
    $this->controller->shouldHaveReceived('store');
});

// Testando a ação "delete" com método GET
it('Testando o metodo de deletar', function () {
    // Simula uma requisição GET com ação "delete"
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_GET['action'] = 'delete';

    // Chama o arquivo web.php (simulando a execução)
    require_once __DIR__ . '/../app/routes/web.php';

    // Verifica se o método delete foi chamado
    $this->controller->shouldHaveReceived('delete');
});

// Testando a ação padrão (index)
it('Testando ação Padrão do Index', function () {
    // Simula uma requisição GET sem ação
    $_SERVER['REQUEST_METHOD'] = 'GET';

    // Chama o arquivo web.php (simulando a execução)
    require_once __DIR__ . '/../app/routes/web.php';

    // Verifica se o método index foi chamado
    $this->controller->shouldHaveReceived('index');
});

?>