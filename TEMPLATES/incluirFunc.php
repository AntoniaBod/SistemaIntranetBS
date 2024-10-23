<?php
include('../CONFIG/conexao.php'); // Inclua sua conexão aqui
session_start(); // Certifique-se de que a sessão esteja iniciada

if (isset($_SESSION['mensagem'])) {
    echo "<p>{$_SESSION['mensagem']}</p>";
    unset($_SESSION['mensagem']); // Remove a mensagem após exibir
}

// Consulta para obter os restaurantes
// Consulta para obter os restaurantes
$sqlRestaurantes = "SELECT id_restaurante, nome_restaurante FROM restaurante"; // Verifique se o nome está correto
$resultRestaurantes = $conn->query($sqlRestaurantes);

$restaurantes = [];
if ($resultRestaurantes->num_rows > 0) {
    while ($row = $resultRestaurantes->fetch_assoc()) {
        $restaurantes[] = $row; // Armazena cada restaurante em um array
    }
} else {
    echo "Nenhum restaurante cadastrado."; // Mensagem se não houver restaurantes
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Funcionário</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
<div class="container mt-3">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>

        <h2 class="text-left" style="color: #B02727;">Cadastrar Funcionário</h2>
        <!-- Formulário para incluir novo funcionário -->
        <form action="processamentoFunc.php" method="post">
         <input type="hidden" name="action" value="incluir">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
             <?php 
                // Consulta para obter os cargos
                $sqlCargos = "SELECT id_cargo, nome FROM cargo"; // Ajuste o nome da tabela e coluna conforme necessário
                $resultCargos = $conn->query($sqlCargos);

                $cargos = [];
                if ($resultCargos->num_rows > 0) {
                    while ($row = $resultCargos->fetch_assoc()) {
                        $cargos[] = $row; // Armazena cada cargo em um array
                    }
                }?>
            <label for="fk_cargo" class="form-label">Cargo</label>
                <select class="form-control" id="fk_cargo" name="fk_cargo" required>
                    <option value="" disabled selected>Selecione um cargo</option> <!-- Opção padrão -->
                    <?php foreach ($cargos as $cargo): ?>
                        <option value="<?php echo $cargo['id_cargo']; ?>"><?php echo $cargo['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
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
                <input type="date" class="form-control" id="dt_adm" name="data_admissao" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="salario" name="salario" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="contato" name="contato" required>
                </div>
            </div>

            <div class="row align-items-center mb-3">
                <div class="col-5">
                    <label for="fk_restaurante" class="form-label">Restaurante de Referência:</label>
                    <select class="form-control" id="fk_restaurante" name="fk_restaurante" required>
                        <option value="" disabled selected>Selecione um restaurante</option>
                        <?php foreach ($restaurantes as $restaurante): ?>
                            <option value="<?php echo $restaurante['id_restaurante']; ?>"><?php echo $restaurante['nome_restaurante']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-3 d-flex align-items-center ms-0 mt-2">
                    <button type="button" class="btn btn-primary" onclick="adicionarSelect()">Add Restaurante+</button>
                </div>
            </div>

            <div class="col-5" id="novo-selects"></div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn-back btn btn-secondary me-2" formnovalidate onclick="window.location.href='../TEMPLATES/listarFunc_admin.php'">VOLTAR</button>
                <button type="submit" name="incluir" class="btn btn-primary" style="background-color: #34593D;">SALVAR</button>
            </div>
        </form>
    </div>
</main>

<script>
function adicionarSelect() {
    // Cria um novo elemento select
    var novoSelect = document.createElement("select");
    novoSelect.className = "form-control"; // Adiciona a classe de estilo
    novoSelect.name = "fk_restaurante_novo[]"; // Nome do select (pode ser um array se você precisar de múltiplos selects)

    // Cria a opção padrão
    var optionDefault = document.createElement("option");
    optionDefault.value = "";
    optionDefault.disabled = true;
    optionDefault.selected = true;
    optionDefault.textContent = "Selecione um restaurante";
    novoSelect.appendChild(optionDefault);

    // Adiciona as opções existentes
    <?php foreach ($restaurantes as $restaurante): ?>
        var option = document.createElement("option");
        option.value = "<?php echo $restaurante['id_restaurante']; ?>";
        option.textContent = "<?php echo $restaurante['nome_restaurante']; ?>"; // Ajuste o nome se necessário
        novoSelect.appendChild(option);
    <?php endforeach; ?>

    // Adiciona o novo select ao div "novo-selects"
    document.getElementById("novo-selects").appendChild(novoSelect);
}
</script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
