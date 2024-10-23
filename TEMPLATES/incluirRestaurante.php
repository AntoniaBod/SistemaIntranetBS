<?php
// Iniciar sessão
session_start();
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui

// Consulta para obter os cozinheiros (funcionários) disponíveis para seleção
$queryCozinheiros = "SELECT id_funcionario, nome FROM funcionario WHERE fk_cargo = (SELECT id_cargo FROM cargo WHERE nome = 'Cozinheiro')";
$resultCozinheiros = mysqli_query($conn, $queryCozinheiros);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Restaurante</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
<div class="container mt-3">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        
                <h2 class="text-left" style="color:#B02727">Incluir Restaurante</h2>

                <!-- Exibe mensagem de sucesso/erro -->
                <?php if (isset($_SESSION['mensagem'])): ?>
                    <div class="alert alert-info">
                        <?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?>
                    </div>
                <?php endif; ?>

                <form action="../CONFIG/processamentoRestaurante.php" method="POST">
                <input type="hidden" name="action" value="incluir">
                    <div class="mb-3">
                        <label for="nome_restaurante" class="form-label">Nome do Restaurante</label>
                        <input type="text" class="form-control" id="nome_restaurante" name="nome_restaurante" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefone_contato" class="form-label">Telefone de Contato</label>
                        <input type="text" class="form-control" id="telefone_contato" name="telefone_contato" required>
                    </div>

                    <div class="mb-3">
                        <label for="fk_cozinheiro" class="form-label">Cozinheiro</label>
                        <select class="form-control" id="fk_cozinheiro" name="fk_cozinheiro" required>
                            <option value="" selected disabled>Selecione o Cozinheiro</option>
                            <?php while ($row = mysqli_fetch_assoc($resultCozinheiros)): ?>
                                <option value="<?php echo $row['id_funcionario']; ?>">
                                    <?php echo $row['nome']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
        <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarRestaurante.php'">VOLTAR</button>
        <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">SALVAR</button>
                </form>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
