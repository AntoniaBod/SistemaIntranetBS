<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="../CSS/style1.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <main>
            <h1>Editar Funcionário</h1>
            <form action="CONFIG/processamento.php" method="POST">
                <input type="hidden" name="acao" value="editar">
                <input type="hidden" name="id" value="<?php echo $funcionario['id_funcionario']; ?>">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $funcionario['nome']; ?>" required>
                </div>
                <div>
                    <label for="fk_cargo">Cargo:</label>
                    <input type="text" name="fk_cargo" value="<?php echo $funcionario['fk_cargo']; ?>" required>
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" value="<?php echo $funcionario['cpf']; ?>" required>
                </div>
                <div>
                    <label for="data_admissao">Data de Admissão:</label>
                    <input type="date" name="data_admissao" value="<?php echo date('Y-m-d', strtotime($funcionario['dt_adm'])); ?>" required>
                </div>
                <div>
                    <label for="salario">Salário:</label>
                    <input type="text" name="salario" value="<?php echo $funcionario['salario']; ?>" required>
                </div>
                <button class="btn-back">VOLTAR</button>
                <button class="btn-back">SALVAR</button>
            </form>
        </main>
    </div>
</body>
</html>
