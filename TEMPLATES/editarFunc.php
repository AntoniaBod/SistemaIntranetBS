<?php
session_start();
include('../CONFIG/conexao.php'); // Incluindo a conexão com o banco de dados

// Verificando se o ID do funcionário foi passado
if (isset($_GET['id'])) {
    $id_funcionario = $_GET['id'];

    // Obtendo os detalhes do funcionário
    $sql = "SELECT * FROM funcionario WHERE id_funcionario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();
    $funcionario = $result->fetch_assoc();
} else {
    // Redirecionar se o ID não for encontrado
    header("Location: listarFunc_admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="../CSS/style1.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?> <!-- Incluindo o header e o aside -->
            <!-- Conteúdo Principal -->
    <main>
    <div class="container mt-5">
    <?php include_once("../INCLUDES/headeradmin.php"); 
        // Incluindo a conexão com o banco de dados
        include('../CONFIG/conexao.php');

        // Query para obter a lista de cargos
        $sql = "SELECT id_cargo, nome FROM cargo";
        $result = $conexao->query($sql);?>
        <h2 class="text-center">Editar Dados do Funcionário</h2>
        <form action="../CONFIG/processamento.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Funcionário:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="fk_cargo" class="form-label">Cargo:</label>
                <select name="fk_cargo" required>
                                <option value="">Selecione um cargo</option>
                                <?php
                                // Preenchendo o select com os cargos do banco de dados, mostrando ID e Nome
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_cargo'] . "'>" . $row['id_cargo'] . " - " . $row['nome'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum cargo disponível</option>";
                                }
                                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="dt_adm" class="form-label">Data de Admissão:</label>
                <input type="date" class="form-control" id="dt_adm" name="dt_adm" required>
            </div>
            <div class="mb-3">
                <label for="salario" class="form-label">Salário:</label>
                <input type="number" class="form-control" id="salario" name="salario" required>
            </div>
            <div class="mb-3">
                <label for="contato" class="form-label">Contato:</label>
                <input type="text" class="form-control" id="contato" name="contato" required>
            </div>
            <button type="button" class="btn-back btn btn-secondary" formnovalidate onclick="window.location.href='../TEMPLATES/listarFunc_admin.php'">VOLTAR</button>
            <button type="submit" name="incluir" class="btn btn-primary">SALVAR</button>  
           
        </form>
    </div>
   </main>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
