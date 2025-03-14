<?php


use App\controllers\ProdutoController;
use App\models\Produto;
use Mockery as m;

test('Produto Controller Funcionando com exito', function(){

   // Criar um mock da classe Produto
   $produtoMock = m::mock(Produto::class);
   $produtoMock->shouldReceive('getAll')->andReturn([
       ['id' => 1, 'nome' => 'Produto 1', 'preco' => 10.0],
       ['id' => 2, 'nome' => 'Produto 2', 'preco' => 20.0]
   ]);

   // Criar a instância do Controller, injetando o mock
   $produtoController = new ProdutoController();
   
   // Refletir a propriedade privada para substituir pelo mock
   $reflection = new ReflectionClass($produtoController);
   $property = $reflection->getProperty('produto');
   $property->setAccessible(true);
   $property->setValue($produtoController, $produtoMock);

   // Executar o método index() (deve retornar os produtos)
   $produtos = $produtoController->getAll();

   // Verificar se os produtos retornados são os esperados
   expect($produtos)->toBe([
    ['id' => 15, 'nome' => 'Leite Ninho', 'preco' => 3.90],
    ['id' => 16, 'nome' => 'Suco de Fruta', 'preco' => 0.90],
    ['id' => 20, 'nome' => 'Leite de coco', 'preco' => 50.00],
    ['id' => 23, 'nome' => 'Costela', 'preco' => 20.90],
    ['id' => 24, 'nome' => 'Burrito de Frango', 'preco' => 4.90],
    ['id' => 25, 'nome' => 'Pão de Queijo', 'preco' => 5.00],
    ['id' => 26, 'nome' => 'Misto Quente', 'preco' => 3.50]
   ]);
    
}
);
?>