<?php
// Iniciar a sessão (se ainda não estiver iniciada)
session_start();

include('../CONFIG/processamento.php');

// Incluir a conexão com o banco de dados
include('../CONFIG/conexao.php');

// Verificar se o ID foi passado na URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']); // Converter para inteiro para segurança
    $funcionario = obterFuncionario($id); // Função que busca o funcionário

    if (!$funcionario) {
        // Se o funcionário não for encontrado, redirecionar ou mostrar mensagem
        echo "Funcionário não encontrado.";
        exit; // Encerra o script se não encontrar o funcionário
    }
} else {
    // Se não passar o ID, redirecionar ou mostrar mensagem
    echo "ID do funcionário não fornecido.";
    exit; // Encerra o script se o ID não for fornecido
}


$id = $_GET['id']; // Pega o ID do funcionário da URL
$funcionario = obterFuncionario($id); // Chama a função para obter os dados do funcionário
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Funcionário</title>
    <link rel="stylesheet" href="../CSS/style1.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?>
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
