<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Funcionário</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <main>
            <h1>Detalhes do Funcionário</h1>
            <p>ID: <?php echo $funcionario['id']; ?></p>
            <p>Nome: <?php echo $funcionario['nome']; ?></p>
            <p>Cargo: <?php echo $funcionario['cargo']; ?></p>
            <p>CPF: <?php echo $funcionario['cpf']; ?></p>
            <p>Data de Admissão: <?php echo $funcionario['data_admissao']; ?></p>
            <p>Salário: R$ <?php echo number_format($funcionario['salario'], 2, ',', '.'); ?></p>
            <button a href="listarfunc.php" class="btn-back">VOLTAR</button>
            <button a href="listarfunc.php" class="btn-back">SALVAR</button>
        </main>
    </div>
</body>
</html>
