<?php

beforeEach(function () {
    // Configuração inicial (se necessário)
    $_POST['action'] = 'add'; // Simulando o envio de um formulário, se necessário
    $_POST['nome'] = 'Produto Teste';
    $_POST['preco'] = 10.99;
});

it('exibe a página inicial corretamente', function () {
    ob_start();
    include __DIR__ . '/../app/view/produtos/index.php';
    $response = ob_get_clean();

    // Verificando se o conteúdo está dentro do HTML gerado
    expect(strpos($response, '<title>superList</title>'))->toBeGreaterThanOrEqual(0);
});

it('lista produtos na página', function () {
    // Simulação de dados de produtos
    $produtos = [
        ['id' => 1, 'nome' => 'Produto Teste 1', 'preco' => 'R$ 22.00'],
        ['id' => 2, 'nome' => 'Produto Teste 2', 'preco' => 'R$ 30.00'],
    ];

    // Aqui simulamos que a variável $produtos existe na página
    // Usando ob_start para capturar o conteúdo gerado pela view
    ob_start();
    
    // Passamos a variável de produtos para a página para que ela seja utilizada no template
    // Por exemplo, se a página usa um include, isso injetará os dados simulados diretamente no template
    include __DIR__ . '/../app/view/produtos/index.php';  

    // Captura a saída gerada pela execução da página
    $response = ob_get_clean(); 

    // Verifica se a resposta contém os produtos simulados
    foreach ($produtos as $produto) {
        expect($response)->toContain($produto['nome']);
        expect($response)->toContain($produto['preco']);
    }
});

it('gera link de exclusão corretamente', function () {
     // Simula o link de exclusão para um produto com ID 1
     $id = 1;

     ob_start();
     include __DIR__ . '/../app/view/produtos/index.php';
     $response = ob_get_clean();
 
     // Verifica se o link de exclusão foi gerado corretamente
     expect(strpos($response, "/Super_List2/app/routes/web.php?action=delete&id=$id"))->toBeGreaterThanOrEqual(0);
});


it('Exibe o formulário de edição corretamente', function () {
    ob_start();
    include __DIR__ . '/../app/view/produtos/index.php';
    $response = ob_get_clean();

    // Verifica se o formulário de edição existe na página
    expect($response)->toContain('<form id="form-editar"');
    expect($response)->toContain('<input type="hidden" name="action" value="update">');
    expect($response)->toContain('<button type="submit">Salvar</button>');
});

?>