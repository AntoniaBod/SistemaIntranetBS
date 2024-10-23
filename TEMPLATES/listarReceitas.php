<?php
// Incluir arquivo de conexão com o banco de dados
require_once '../config/conexao.php';

// Query para buscar as receitas
$query = "SELECT r.id_receita, r.nome_receita, r.modo_preparo, r.dt_cadastro, c.nome AS nome_categoria, f.nome 
          FROM Receita r
          JOIN Categoria c ON r.fk_categoria = c.id_categoria
          JOIN Funcionario f ON r.fk_cozinheiro = f.id_funcionario";

// Executar a consulta e verificar se foi bem-sucedida
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn)); 
}

// Início do HTML
?>

!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style.css">
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
                    <h2 class="text-left" style="color:#B02727">Listar Receitas</h2>
                </div>
                <div class="col-md-auto ms-auto">
                    <div class="input-group">
                        <input type="text" class="form-control input-search" name="search" placeholder="Pesquisar..." aria-label="Pesquisar" style="flex: 1; min-width: 200px; margin-right: 0;">
                        <button class="btn-search btn btn-outline-secondary" type="button">🔍</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped w-100" style="text-align: center;">
                    <thead class="table-dark">
                    <tr>
                    <th>ID</th>
                    <th>Nome da Receita</th>
                    <th>Modo de Preparo</th>
                    <th>Data de Cadastro</th>
                    <th>Categoria</th>
                    <th>Cozinheiro</th>
                    <th>Dados | Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    echo "<tr>";
                    echo "<td>{$row['id_receita']}</td>";
                    echo "<td>{$row['nome_receita']}</td>";
                    echo "<td>" . substr($row['modo_preparo'], 0, 100) . "...</td>"; // Exibe apenas os primeiros 100 caracteres
                    echo "<td>" . date('d/m/Y', strtotime($row['dt_cadastro'])) . "</td>";
                    echo "<td>{$row['nome_categoria']}</td>";
                    echo "<td>{$row['nome']}</td>"; // Verifique se essa coluna está correta
                    echo "<td>
                    <a href="visualizarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-view" style="margin-right: 10px;">👁️</a>
                    <a href="editarFunc.php?id=<?php echo $row['id_funcionario']; ?>" class="btn-edit" style="margin-right: 10px;">✏️</a>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">Nenhum restaurante cadastrado.</td>
                        </tr>
                    <?php endif; ?>
            </tbody>
        </table>
    </main>

   
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
