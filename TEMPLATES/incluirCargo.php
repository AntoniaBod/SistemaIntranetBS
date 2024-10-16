<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Cargo</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <main>
            <h1>Incluir Cargo</h1>
            <form action="../CONFIG/processamento.php" method="POST">
                <input type="hidden" name="acao" value="incluir">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div>
                    <label for="descricao">Descrição:</label>
                    <input type="text" name="descricao" required>
                </div>
                <button class="btn-back">VOLTAR</button>
                <button class="btn-back">SALVAR</button>
            </form>
        </main>
    </div>
</body>
</html>
