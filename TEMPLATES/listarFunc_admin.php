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
    
    // Verifica se o funcionário foi encontrado
    if (!$funcionario) {
        // Redirecionar se não encontrar o funcionário
        $_SESSION['mensagem'] = 'Funcionário não encontrado.';
        header("Location: listarFunc_admin.php");
        exit();
    }
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
    <title>Funcionários Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style1.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <div class="container">
        <?php include_once("../INCLUDES/header.php"); ?>
       
            <!-- Conteúdo Principal -->
            <main class="col-md-10 ms-sm-auto px-md-4">
            <div class="container mt-4">
            <div class="row align-items-center mb-3">
               <div class="col-md-auto">
                   <h2 class="text-left">Funcionários Cadastrados</h2>
            </div>
                    <div class="col-md-auto ms-auto">
                        <div class="input-group" >
                            <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px;"> <!-- Ajuste o min-width conforme necessário -->
                            <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                            <button class="btn-add btn-primary ms-2" onclick="window.location.href='/BSIntranetAntonia/TEMPLATES/incluirFunc.php'">Incluir Funcionário +</button>
                        </div>
                    </div>
                </div>
            </div>
                              <!-- Tabela Responsiva -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>CPF</th>
                                    <th>Data de Admissão</th>
                                    <th>Salário</th>
                                    <th>Contato</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($funcionario = $result->fetch_assoc()): ?>
                                <tr>
                                <td><?php echo $funcionario['id_funcionario']; ?></td>
                                <td><?php echo htmlspecialchars($funcionario['nome']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['fk_cargo']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['cpf']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['dt_adm']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['salario']); ?></td>
                                <td><?php echo htmlspecialchars($funcionario['contato']); ?></td>
                                    <td>
                                        <a href="visualizarFunc.php?id=<?php echo $funcionario['id_funcionario']; ?>" class="btn-view">👁️</a>
                                        <a href="editarFunc.php?id=<?php echo $funcionario['id_funcionario']; ?>" class="btn-edit">✏️</a>
                                        <a href="../CONFIG/processamento.php?acao=excluir&id=<?php echo $funcionario['id_funcionario']; ?>"class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                                    </td>
                                </tr>
                               
                                <?php endwhile; ?>
                                <!-- Outros registros de funcionários -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
