
<?php 
        include_once("../INCLUDES/headerAdmin.php"); 
        include('../CONFIG/conexao.php'); // Incluindo a conexão com o banco de dados
// Inicializa a variável $cargo como um array vazio
        $cargo = [];

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

        <!-- Conteúdo Principal -->
        
        <h2 class="text-left" style="color: #B02727;">Editar Cargo</h2>

        <!-- Formulário para editar o cargo -->
        <form action="../CONFIG/processamentoCargo.php" method="POST">
            <input type="hidden" name="id_cargo" value="<?php echo $cargo['id_cargo']; ?>"> <!-- Campo oculto para o ID do cargo -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($cargo['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($cargo['descricao']); ?></textarea>
            </div>
            <div class="d-flex justify-content-end">
        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarCargo.php'">VOLTAR</button>
        <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">ATUALIZAR</button>
        </div>
        </form>
    </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>