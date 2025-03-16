<?php

use App\config\Database;
use PDO;
//use PHPUnit\Framework\TestCase;

beforeEach(function () {
    // Limpa a conexão antes de cada teste
    Database::connect();
});

test('A conexão com o banco de dados deve ser bem-sucedida', function () {
    $conexao = Database::connect();
    
    expect($conexao)->toBeInstanceOf(PDO::class); // Verifica se a conexão retornada é uma instância de PDO
});

test('A conexão não deve ser nula', function () {
    $conexao = Database::connect();
    
    expect($conexao)->not->toBeNull(); // Verifica se a conexão foi criada corretamente
});

test('A conexão deve ser única (singleton)', function () {
    $conexao1 = Database::connect();
    $conexao2 = Database::connect();
    
    expect($conexao1)->toBe($conexao2); // Verifica se ambas as conexões são a mesma instância
});


?>