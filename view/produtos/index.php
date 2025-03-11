

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supeList</title>
    <link rel = "stylesheet" href="/css/style.css">
</head>
<body>

    <pre><?php print_r($produtos); ?></pre><!-- Exibe o conteúdo da variável para depuração -->
    <h1>Lista de Produtos</h1>
    <p>Lista de Produtos será exibida aqui.</p>

    <form action= "/Super_List/routes/web.php" method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <button type="submit">Adicionar</button>
    </form>

    <table>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
        </tr>
        <?php if (!empty($produtos)): ?>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= htmlspecialchars($produto['nome']) ?></td>
            <td><?= htmlspecialchars($produto['preco']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="2">Nenhum produto encontrado.</td>
    </tr>
<?php endif; ?>
    </table>
</body>
</html>