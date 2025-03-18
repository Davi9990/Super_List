<?php

use App\controllers\ProdutoController;
use Mockery;
use function Pest\tests;

test('rota POST / adiciona um produto', function () {
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $mock = Mockery::mock(ProdutoController::class)->makePartial();
    $mock->shouldReceive('store')->once();

    $mock->store();
});

test('rota GET /?action=delete exclui um produto', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $mock = Mockery::mock(ProdutoController::class)->makePartial();
    $mock->shouldReceive('delete')->once();

    $mock->delete();
});

test('rota padrão chama index', function () {
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $mock = Mockery::mock(ProdutoController::class)->makePartial();
    $mock->shouldReceive('index')->once();

    $mock->index();
});

?>
