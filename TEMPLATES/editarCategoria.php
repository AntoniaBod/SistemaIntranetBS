<?php
include('../CONFIG/conexao.php'); // Incluindo a conexão
session_start();

if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];

    // Consulta para obter os dados da categoria
    $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc(); // Obtém os dados da categoria
    } else {
        $_SESSION['mensagem'] = "Categoria não encontrada.";
        header("Location: listarCategoria.php");
        exit();
    }
} else {
    $_SESSION['mensagem'] = "ID da categoria não especificado.";
    header("Location: listarCategoria.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
<div class="container mt-3">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?> <!-- Incluindo o header -->

        <h2 class="text-left" style="color: #B02727;">Editar Categoria</h2>

        <!-- Formulário para editar o categoria -->
        <form action="../CONFIG/processamentoCategoria.php" method="POST">
            <input type="hidden" name="categoria" value="<?php echo $categoria['id_categoria']; ?>"> <!-- Campo oculto para o ID do categoria -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($categoria['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($categoria['descricao']); ?></textarea>
            </div>
            <div class="d-flex justify-content-end">
        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarCategoria.php'">VOLTAR</button>
        <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">ATUALIZAR</button>
        </div>
        </form>
    </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>