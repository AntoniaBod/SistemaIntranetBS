<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Cargo</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
        <div class="container mt-3">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>

        <h2 class="text-left" style="color: #B02727;">Cadastrar Novo Cargo</h2>

        <!-- Formulário para incluir novo cargo -->
        <form action="../CONFIG/processamentoCargo.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <div class="d-flex justify-content-end">
        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarCargo.php'">VOLTAR</button>
        <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">SALVAR</button>
        </div>
        </form>
        </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
