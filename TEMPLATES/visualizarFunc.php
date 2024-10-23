<?php 
include('../CONFIG/conexao.php'); 
session_start();

// Obtendo o ID do funcionário pela URL
$id_funcionario = $_GET['id'];

// Consulta para obter os dados do funcionário
$query = "SELECT * FROM funcionario WHERE id_funcionario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_funcionario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $funcionario = $result->fetch_assoc();
} else {
    echo "Funcionário não encontrado.";
    exit;
}

// Consulta para obter o nome do cargo
$cargo_query = "SELECT nome FROM cargo WHERE id_cargo = ?";
$cargo_stmt = $conn->prepare($cargo_query);
$cargo_stmt->bind_param("i", $funcionario['fk_cargo']);
$cargo_stmt->execute();
$cargo_result = $cargo_stmt->get_result();

if ($cargo_result->num_rows > 0) {
    $cargo = $cargo_result->fetch_assoc();
} else {
    $cargo['nome'] = 'Cargo não encontrado';
}

// Obter informações do restaurante se necessário
$restaurante_query = "SELECT * FROM restaurante WHERE id_restaurante = ?";
$restaurante_stmt = $conn->prepare($restaurante_query);
$restaurante_stmt->bind_param("i", $funcionario['fk_restaurante']);
$restaurante_stmt->execute();
$restaurante_result = $restaurante_stmt->get_result();

if ($restaurante_result->num_rows > 0) {
    $restaurante = $restaurante_result->fetch_assoc();
} else {
    $restaurante = null; // Defina como null ou um array vazio
}

$cargo_stmt->close();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Funcionário</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="col-md-11 ms-sm-auto px-md-2">
        <div class="container mt-3">
            <?php include_once("../INCLUDES/headerAdmin.php"); ?>
            <h2 class="text-left" style="color: #B02727;">Detalhes do Funcionário</h2>

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Cargo</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($cargo['nome']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['cpf']); ?>" readonly>
            </div>
            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="dt_adm" class="form-label">Data de Admissão</label>       
                </div>
                <div class="col-md-4">
                    <label for="salario" class="form-label">Salário</label>
                </div>
                <div class="col-md-4">
                    <label for="contato" class="form-label">Contato</label>
                </div>
            </div>
           
            <div class="mb-3 row">
                <div class="col-md-4">
                <input type="date" class="form-control" value="<?php echo htmlspecialchars($funcionario['dt_adm']); ?>" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['salario']); ?>" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['contato']); ?>" required>
                </div>
             </div>
             <div class="mb-3">
                <label class="form-label">Restaurante Referência</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($restaurante['nome_restaurante']); ?>" readonly>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-back btn btn-secondary me-2" onclick="window.location.href='../TEMPLATES/listarFunc_admin.php'">VOLTAR</button>
            </div>
        </div>
    </main>
</body>
</html>
