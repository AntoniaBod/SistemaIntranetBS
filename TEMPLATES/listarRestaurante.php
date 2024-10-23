<?php
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']); // Apaga a mensagem após exibir
}

// Consulta para obter todos os restaurantes
$query = "
    SELECT r.id_restaurante, r.nome_restaurante, r.telefone_contato, f.nome AS nome_cozinheiro 
    FROM restaurante r
    LEFT JOIN funcionario f ON r.fk_cozinheiro = f.id_funcionario
";

// Executar a consulta
$result = mysqli_query($conn, $query);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
<div class="container mt-3">
    <?php include_once("../INCLUDES/headerAdmin.php"); ?>
            <div class="row align-items-center mb-3">
                <div class="col-md-auto">
                    <h2 class="text-left" style="color:#B02727">Restaurantes Cadastrados</h2>
                </div>
                <div class="col-md-auto ms-auto">
                    <div class="input-group">
                        <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px; margin-right: 0;">
                        <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                        <button class="btn-add btn-primary ms-3" style="background-color: #34593D" onclick="window.location.href='/SistemaIntranetBS/TEMPLATES/incluirRestaurante.php'">Incluir Restaurante +</button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" style="text-align: center;">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Restaurante</th>
                            <th>Nome do Restaurante</th>
                            <th>Telefone de Contato</th>
                            <th>Cozinheiro Responsável</th> <!-- Coluna para mostrar o nome do cozinheiro -->
                            <th>Dados | Editar | Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id_restaurante']; ?></td>
                                <td><?php echo $row['nome_restaurante']; ?></td>
                                <td><?php echo $row['telefone_contato']; ?></td>
                                <td><?php echo $row['nome_cozinheiro']; ?></td> <!-- Exibe o nome do cozinheiro -->
                                <td>
                                    <a href="visualizarRestaurante.php?id=<?php echo $row['id_restaurante']; ?>" class="btn-view" style="margin-right: 10px;">👁️</a>
                                    <a href="editarRestaurante.php?id=<?php echo $row['id_restaurante']; ?>" class="btn-edit" style="margin-right: 10px;">✏️</a>
                                    <a href="../CONFIG/processamento.php?acao=excluir&id=<?php echo $row['id_restaurante']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este restaurante?');">🗑️</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhum restaurante cadastrado.</td>
                        </tr>
                    <?php endif; ?>
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
