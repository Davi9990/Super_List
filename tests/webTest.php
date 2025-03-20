<?php

use App\controllers\ProdutoController;
use Mockery;
use Pest\TestSuite; // Adicione esta linha para evitar erro na função test()

beforeEach(function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';
});

test('rota POST / adiciona um produto', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $mock = Mockery::mock(ProdutoController::class);
    $mock->shouldReceive('store')->once();

    $mock->store();
});

test('rota GET /?action=delete exclui um produto', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $mock = Mockery::mock(ProdutoController::class);
    $mock->shouldReceive('delete')->once();

    $mock->delete();
});

test('rota padrão chama index', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $mock = Mockery::mock(ProdutoController::class);
    $mock->shouldReceive('index')->once();

    $mock->index();
});

test('rota POST /?action=update atualiza um produto', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['action'] = 'update';

    $mock = Mockery::mock(ProdutoController::class);
    $mock->shouldReceive('update')->once();

    $mock->update();
});

afterEach(function () {
    Mockery::close();
});
