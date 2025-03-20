<?php

use App\models\Produto;
use App\config\Database;
//use PDO;

beforeEach(function () {
    // Conectar ao banco de dados para testar
    $this->produto = new Produto();

    // Preparar banco de dados, criando a tabela de produtos
    $pdo = Database::connect();
    $pdo->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        preco DECIMAL(10, 2) NOT NULL
    )");
});

afterEach(function () {
    // Limpar os dados após os testes
    $pdo = Database::connect();
    $pdo->exec("DELETE FROM produtos");
});

it('deve criar um novo produto', function () {
    // Testar o método create
    $result = $this->produto->create('Produto Teste', 100.50);
    expect($result)->toBeTrue(); // Espera que a inserção seja bem-sucedida
});

it('deve listar todos os produtos', function () {
    // Adicionar um produto antes de listar
    $this->produto->adicionar('Produto A', 50.75);
    $produtos = $this->produto->listar();
    
    // Testar se ao menos um produto foi retornado
    expect($produtos)->toBeArray();
    expect(count($produtos))->toBeGreaterThan(0);
});

it('deve retornar todos os produtos', function () {
    // Testar getAll
    $this->produto->adicionar('Produto A', 10.99);
    $produtos = $this->produto->getAll();
    
    expect($produtos)->toBeArray();
    expect(count($produtos))->toBeGreaterThan(0);
});

it('deve deletar um produto pelo id', function () {
    // Inserir um produto para poder deletar
    $this->produto->adicionar('Produto Para Deletar', 20.99);
    
    // Recuperar o produto para obter o ID
    $produtos = $this->produto->listar();
    $produtoId = $produtos[0]['id'];
    
    // Testar o método deletar
    $result = $this->produto->deletar($produtoId);
    expect($result)->toBeTrue();
    
    // Verificar se o produto foi deletado
    $produtosRestantes = $this->produto->listar();
    expect(count($produtosRestantes))->toBe(0); // Nenhum produto restante
});

it('Deve atualizar um produto existente', function () {
    // Inserir um produto para poder atualizar
    $this->produto->adicionar('Produto Antigo', 30.00);

    // Recuperar o produto para obter o ID
    $produtos = $this->produto->listar();
    $produtoId = $produtos[0]['id'];

    // Novos valores para atualização
    $novoNome = 'Produto Atualizado';
    $novoPreco = 45.99;

    // Testar o método atualizar
    $result = $this->produto->atualizar($produtoId, $novoNome, $novoPreco);
    expect($result)->toBeTrue();

    // Recuperar o produto atualizado
    $produtosAtualizados = $this->produto->listar();
    expect($produtosAtualizados[0]['nome'])->toBe($novoNome);
    
    // Corrigindo a comparação do preço
    expect((float) $produtosAtualizados[0]['preco'])->toBe($novoPreco);
});


?>