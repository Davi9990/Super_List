<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supeList</title>
    <link rel = "stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Lista de Produtos</h1>
    <p>Lista de Produtos será exibida aqui.</p>

    <form action= "/" method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <button type="submit">Adicionar</button>
    </form>

    <table>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= htmlspecialchars($produto["nome"]) ?></td>
                <td>R$ <?= number_format($produto["preco"], 2, ",", ".") ?></td>
                <td>
                    <a href="?action=delete&id=<?= $produto["id"] ?>" onclick="return confirm('Tem certeza que deseja deletar?')"></a>
                </td>
            </tr>
            <?php endforeach;?>
    </table>
</body>
</html>