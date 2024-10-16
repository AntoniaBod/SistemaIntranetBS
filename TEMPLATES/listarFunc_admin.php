<?php
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-success' role='alert'>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']); // Limpa a mensagem após exibi-la
}

// Consulta para obter todos os funcionários
$query = "SELECT * FROM funcionario"; // Adapte conforme sua tabela
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <main class="col-md-11 ms-sm-auto px-md-2">
            <div class="container mt-4">
                <div class="row align-items-center mb-3">
                    <div class="col-md-auto">
                        <h2 class="text-left">Funcionários Cadastrados</h2>
                    </div>
                    <div class="col-md-auto ms-auto">
                        <div class="input-group">
                            <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px;">
                            <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                            <button class="btn-add btn-primary ms-2" onclick="window.location.href='/BSIntranetAntonia/TEMPLATES/incluirFunc.php'">Incluir Funcionário +</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>CPF</th>
                                <th>Data de Admissão</th>
                                <th>Salário</th>
                                <th>Contato</th>
                                <th>Dados|Editar|Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['id_funcionario']; ?></td>
                                    <td><?php echo $row['nome']; ?></td>
                                    <td><?php echo $row['fk_cargo']; ?></td>
                                    <td><?php echo $row['cpf']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['dt_adm'])); ?></td>
                                    <td>R$ <?php echo number_format($row['salario'], 2, ',', '.'); ?></td>
                                    <td><?php echo $row['contato']; ?></td>
                                    <td>
                                        <a href="visualizarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-view">👁️</a>
                                        <a href="editarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-edit">✏️</a>
                                        <a href="../CONFIG/processamento.php?acao=excluir&id=<?php echo $row['id_funcionario']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

