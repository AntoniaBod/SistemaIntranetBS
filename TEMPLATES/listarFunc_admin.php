<?php
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']); // Apaga a mensagem após exibir
}

// Consulta para obter todos os funcionários
$query = "
    SELECT f.id_funcionario, f.nome, f.cpf, f.dt_adm, f.salario, f.contato, c.nome AS cargo, r.nome_restaurante AS restaurante 
    FROM funcionario f
    INNER JOIN cargo c ON f.fk_cargo = c.id_cargo
    LEFT JOIN restaurante r ON f.fk_restaurante = r.id_restaurante
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
    <title>Funcionários Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../SCRIPTS/scriptLista.js">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2"> 
<div class="container">
    <?php include_once("../INCLUDES/headerAdmin.php"); ?>
    
        <div class="container mt-3">
            <div class="row align-items-center mb-3">
                <div class="col-md-auto">
                    <h2 class="text-left" style="color:#B02727">Funcionários Cadastrados</h2>
                </div>
                <div class="col-md-auto ms-auto">
                    <div class="input-group">
                        <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px; margin-right: 0;">
                        <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                        <button class="btn-add btn-primary ms-3" style="background-color: #34593D" onclick="window.location.href='/SistemaIntranetBS/TEMPLATES/incluirFunc.php'">Incluir Funcionário +</button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" style="text-align: center;">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>CPF</th>
                            <th>Data de Admissão</th>
                            <th>Salário</th>
                            <th>Contato</th>
                            <th>Restaurante</th> <!-- Adiciona a coluna de Restaurante -->
                            <th>Dados | Editar | Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id_funcionario']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cargo']; ?></td> <!-- Exibe o nome do cargo -->
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['dt_adm'])); ?></td>
                            <td>R$ <?php echo number_format($row['salario'], 2, ',', '.'); ?></td>
                            <td><?php echo $row['contato']; ?></td>
                            <td><?php echo $row['restaurante']; ?></td> <!-- Exibe o nome do restaurante -->
                            <td>
                                <a href="visualizarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-view" style="margin-right: 10px;">👁️</a>
                                <a href="editarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-edit" style="margin-right: 10px;">✏️</a>
                                <a href="../CONFIG/processamentoFunc.php?action=excluir&id=<?php echo $funcionario['id_funcionario']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionario?');">🗑️</a>

                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">Nenhum restaurante cadastrado.</td>
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
