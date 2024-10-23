<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Cargo</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
        <div class="container mt-3">
        <?php 
        include_once("../INCLUDES/headerAdmin.php"); 
        include('../CONFIG/conexao.php'); // Incluindo a conexão com o banco de dados

        // Verifica se o ID do cargo está presente na URL
        if (isset($_GET['id'])) {
            $id_cargo = $_GET['id'];
            // Query para obter os dados do cargo
            $sql = "SELECT * FROM cargo WHERE id_cargo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_cargo);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o cargo existe
            if ($result->num_rows > 0) {
                $cargo = $result->fetch_assoc(); // Obtém os dados do cargo
            } else {
                $_SESSION['mensagem'] = "Cargo não encontrado.";
                header("Location: ../TEMPLATES/listarCargo.php");
                exit();
            }
        } else {
            $_SESSION['mensagem'] = "ID do cargo não informado.";
            header("Location: ../TEMPLATES/listarCargo.php");
            exit();
        }
        ?>

        <h2 class="text-left" style="color: #B02727;">Visualizar Cargo</h2>

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($cargo['nome']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($cargo['descricao']); ?></textarea>
        </div>
        
        <div class="d-flex justify-content-end">
                        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarCargo.php'">VOLTAR</button>
                        
        </div>
    </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
