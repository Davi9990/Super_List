
<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>superList</title>
    <link rel = "stylesheet" href="../public/css/style.css">
</head>
<body>

    <h1>Lista de Produtos</h1>


    <form action= "/Super_List2/app/public/index.php" method="post">
        <input type="hidden" name="action" value="add">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <button type="submit">Adicionar</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Ação</th>
        </tr>
        <?php if (!empty($produtos)): ?>
    <ul>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= htmlspecialchars($produto['id'])  ?></td>
            <td><?= htmlspecialchars($produto['nome']) ?></td>
            <td><?= htmlspecialchars($produto['preco']) ?></td>
            <td>
            <a href = "/Super_List2/app/routes/web.php?action=delete&id=<?= $produto['id'] ?>"
                    onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                    <button style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Excluir
                    </button>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <tr>
        <td colspan="2">Nenhum produto encontrado.</td>
    </tr>
<?php endif; ?>
    </table>
</body>
</html>