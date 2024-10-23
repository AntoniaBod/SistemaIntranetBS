<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Categoria</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
        <div class="container mt-3">
        <?php 
        include_once("../INCLUDES/headerAdmin.php"); 
        include('../CONFIG/conexao.php'); // Incluindo a conexão com o banco de dados

        // Verifica se o ID do categoria está presente na URL
        if (isset($_GET['id'])) {
            $id_categoria = $_GET['id'];
            // Query para obter os dados do categoria
            $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i",$id_categoria);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o categoria existe
            if ($result->num_rows > 0) {
                $categoria = $result->fetch_assoc(); // Obtém os dados do categoria
            } else {
                $_SESSION['mensagem'] = "Categoria não encontrada.";
                header("Location: ../TEMPLATES/listarCategoria.php");
                exit();
            }
        } else {
            $_SESSION['mensagem'] = "ID do categoria não informado.";
            header("Location: ../TEMPLATES/listarCategoria.php");
            exit();
        }
        ?>

        <h2 class="text-left" style="color: #B02727;">Visualizar Categoria</h2>

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($categoria['nome']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($categoria['descricao']); ?></textarea>
        </div>
        
        <div class="d-flex justify-content-end">
                        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarCategoria.php'">VOLTAR</button>
                        
        </div>
    </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>