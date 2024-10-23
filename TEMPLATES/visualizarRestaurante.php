<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Restaurante</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
    <div class="container mt-3">
        <?php 
        include_once("../INCLUDES/headerAdmin.php"); 
        include('../CONFIG/conexao.php'); // Incluindo a conexão com o banco de dados

        // Verifica se o ID do restaurante está presente na URL
        if (isset($_GET['id'])) {
            $id_restaurante = $_GET['id'];

            // Query para obter os dados do restaurante e do cozinheiro
            $sql = "
                SELECT r.nome_restaurante, r.telefone_contato, f.nome AS nome_cozinheiro
                FROM restaurante r
                LEFT JOIN funcionario f ON r.fk_cozinheiro = f.id_funcionario
                WHERE r.id_restaurante = ?
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_restaurante);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se o restaurante existe
            if ($result->num_rows > 0) {
                $restaurante = $result->fetch_assoc(); // Obtém os dados do restaurante
            } else {
                $_SESSION['mensagem'] = "Restaurante não encontrado.";
                header("Location: listarRestaurante.php");
                exit();
            }
        } else {
            $_SESSION['mensagem'] = "ID do restaurante não informado.";
            header("Location: listarRestaurante.php");
            exit();
        }
        ?>

        <h2 class="text-left" style="color: #B02727;">Visualizar Restaurante</h2>

        <!-- Nome do Restaurante -->
        <div class="mb-3">
            <label class="form-label">Nome do Restaurante</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($restaurante['nome_restaurante']); ?>" readonly>
        </div>

        <!-- Telefone de Contato -->
        <div class="mb-3">
            <label class="form-label">Telefone de Contato</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($restaurante['telefone_contato']); ?>" readonly>
        </div>

        <!-- Cozinheiro Responsável -->
        <div class="mb-3">
            <label class="form-label">Cozinheiro Responsável</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($restaurante['nome_cozinheiro']); ?>" readonly>
        </div>

        <!-- Botão Voltar -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-back btn btn-secondary me-2" onclick="window.location.href='listarRestaurante.php'">VOLTAR</button>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
