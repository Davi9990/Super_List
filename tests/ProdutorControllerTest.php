<?php

use App\controllers\ProdutoController;
use App\models\Produto;
use Mockery;

beforeEach(function () {
    $this->produtoMock = Mockery::mock(Produto::class);
    $this->produtoController = new ProdutoController($this->produtoMock);
});

test('ProdutoController retorna todos os produtos corretamente', function () {
    // Simulando retorno do banco
    $this->produtoMock->shouldReceive('getAll')
        ->once()
        ->andReturn([
            ['id' => 1, 'nome' => 'Produto 1', 'preco' => 10.0],
            ['id' => 2, 'nome' => 'Produto 2', 'preco' => 20.0]
        ]);

    $produtos = $this->produtoController->getALL();

    expect($produtos)->toBe([
        ['id' => 1, 'nome' => 'Produto 1', 'preco' => 10.0],
        ['id' => 2, 'nome' => 'Produto 2', 'preco' => 20.0]
    ]);
});

test('ProdutoController adiciona um produto corretamente', function () {
    // Simula chamada ao método create()
    $this->produtoMock->shouldReceive('create')
        ->once()
        ->with('Novo Produto', 15.50);

    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['nome'] = 'Novo Produto';
    $_POST['preco'] = 15.50;

    $this->produtoController->store();

    unset($_POST, $_SERVER['REQUEST_METHOD']);
});


// Teste para o método delete
test('ProdutoController exclui um produto corretamente', function () {
    $produtoId = 1; // ID do produto a ser excluído

    // Simula a chamada ao método deletar()
    $this->produtoMock->shouldReceive('deletar')
        ->once()
        ->with($produtoId);

    // Simula a passagem do ID do produto via $_GET
    $_GET['id'] = $produtoId;

    // Chama o método delete()
    $this->produtoController->delete();

    unset($_GET); // Limpa a variável global $_GET
});


//Teste para o método update
test("ProdutoController atualizar um produto corretamente", function(){
    $produtoId = 1; // ID do produto a ser atualizado
    $novonome = 'Produto Atualizado';
    $novoPreco = 25.00;

    //Simula a chamada ao método atualizar()
    $this->produtoMock->shouldReceive('atualizar')
        ->once()
        ->with($produtoId, $novonome, $novoPreco);

    //Simule os dados enviados via POST
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST['id'] = $produtoId;
    $_POST['nome'] = $novonome;
    $_POST['preco'] = $novoPreco;

    //Chama o método update()
    $this->produtoController->update();

    //Limpa as variáveis globais
    unset($_POST, $_SERVER['REQUEST_METHOD']);
});

?>