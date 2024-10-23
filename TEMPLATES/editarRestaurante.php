<?php
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

// Verificar se o ID do restaurante foi passado pela URL
if (isset($_GET['id'])) {
    $id_restaurante = $_GET['id'];

    // Consulta para obter os dados do restaurante com o ID fornecido
    $query = "SELECT * FROM restaurante WHERE id_restaurante = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_restaurante);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar se o restaurante foi encontrado
    if ($row = mysqli_fetch_assoc($result)) {
        $nome_restaurante = $row['nome_restaurante'];
        $telefone_contato = $row['telefone_contato'];
        $fk_cozinheiro = $row['fk_cozinheiro'];
    } else {
        $_SESSION['mensagem'] = "Restaurante não encontrado.";
        header('Location: listarRestaurantes.php');
        exit();
    }
} else {
    $_SESSION['mensagem'] = "ID de restaurante inválido.";
    header('Location: listarRestaurantes.php');
    exit();
}

// Atualizar os dados do restaurante após o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_restaurante = $_POST['nome_restaurante'];
    $telefone_contato = $_POST['telefone_contato'];
    $fk_cozinheiro = $_POST['fk_cozinheiro'];

    $query = "UPDATE restaurante SET nome_restaurante = ?, telefone_contato = ?, fk_cozinheiro = ? WHERE id_restaurante = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssii', $nome_restaurante, $telefone_contato, $fk_cozinheiro, $id_restaurante);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensagem'] = "Restaurante atualizado com sucesso!";
        header('Location: listarRestaurantes.php');
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar o restaurante: " . mysqli_error($conn);
    }
}

// Consulta para obter a lista de cozinheiros
$query_cozinheiros = "SELECT id_funcionario, nome FROM funcionario WHERE fk_cargo = (SELECT id_cargo FROM cargo WHERE nome = 'Cozinheiro')";
$result_cozinheiros = mysqli_query($conn, $query_cozinheiros);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Restaurante</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
        <div class="container mt-3">
    <?php include_once("../INCLUDES/headerAdmin.php"); ?>
    
            <h2 class="text-left" style="color:#B02727">Editar Restaurante</h2>

            <?php if (isset($_SESSION['mensagem'])): ?>
                <div class='alert alert-success'><?php echo $_SESSION['mensagem']; ?></div>
                <?php unset($_SESSION['mensagem']); ?>
            <?php endif; ?>

            <form action="editarRestaurante.php?id=<?php echo $id_restaurante; ?>" method="POST">
                <div class="mb-3">
                    <label for="nome_restaurante" class="form-label">Nome do Restaurante</label>
                    <input type="text" class="form-control" id="nome_restaurante" name="nome_restaurante" value="<?php echo $nome_restaurante; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="telefone_contato" class="form-label">Telefone de Contato</label>
                    <input type="text" class="form-control" id="telefone_contato" name="telefone_contato" value="<?php echo $telefone_contato; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fk_cozinheiro" class="form-label">Cozinheiro Responsável</label>
                    <select class="form-control" id="fk_cozinheiro" name="fk_cozinheiro" required>
                        <option value="" disabled selected>Selecione um cozinheiro</option>
                        <?php while ($cozinheiro = mysqli_fetch_assoc($result_cozinheiros)): ?>
                            <option value="<?php echo $cozinheiro['id_funcionario']; ?>" <?php echo ($fk_cozinheiro == $cozinheiro['id_funcionario']) ? 'selected' : ''; ?>>
                                <?php echo $cozinheiro['nome']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-end">
        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarRestaurante.php'">VOLTAR</button>
        <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">ATUALIZAR</button>
        </div>
            </form>
        </div>
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
