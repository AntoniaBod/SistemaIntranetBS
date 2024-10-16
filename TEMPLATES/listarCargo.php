<?php
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-success' role='alert'>{$_SESSION['mensagem']}</div>";
    unset($_SESSION['mensagem']); // Limpa a mensagem após exibi-la
}

// Consulta para obter todos os cargos
$query = "SELECT * FROM cargo"; // Adapte conforme sua tabela
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos - Sistema Intranet</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <?php include_once("../INCLUDES/headerAdmin.php"); ?><!-- Incluindo o header e o aside -->
    <main class="col-md-11 ms-sm-auto px-md-2">
            <div class="container mt-4">
                <div class="row align-items-center mb-3">
                    <div class="col-md-auto">
                        <h2 class="text-left">Cargos Cadastrados</h2>
                    </div>
                    <div class="col-md-auto ms-auto">
                        <div class="input-group">
                            <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px;">
                            <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                            <button class="btn-add btn-primary ms-2" onclick="window.location.href='/BSIntranetAntonia/TEMPLATES/incluirCargo.php'">Incluir Cargo +</button>
                        </div>
                    </div>
                </div>
            <table class="table table-bordered table-striped w-100">
                        <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Dados|Editar|Excluir</th> <!-- Coluna para as ações -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cargo = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $cargo['id_cargo']; ?></td>
                        <td><?php echo $cargo['nome']; ?></td>
                        <td><?php echo $cargo['descricao']; ?></td>
                        <td>
                            <a href="visualizarCargo.php?id=<?php echo $cargo['id_cargo']; ?>" class="btn-view">👁️</a>
                            <a href="editarCargo.php?id=<?php echo $cargo['id_cargo']; ?>" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=<?php echo $cargo['id_cargo']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este cargo?');">🗑️</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button class="btn-back" onclick="history.back()">VOLTAR</button>
        </main>
    </div>
</body>
</html>
