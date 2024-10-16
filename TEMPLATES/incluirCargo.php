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
    <main>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <h2 class="text-left">Cadastrar Novo Cargo</h2>
        <form action="../CONFIG/processamento.php" method="POST">
            <table class="table table-bordered table-striped w-100">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            // Conexão com o banco de dados
            include('../CONFIG/conexao.php');

            // Consulta para obter todos os cargos
            $sql = "SELECT id_cargo, nome, descricao FROM cargo"; // Certifique-se de usar o nome correto
            $result = $conn->query($sql);

            // Verifica se existem cargos e os lista
            if ($result->num_rows > 0) {
                while ($cargo = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($cargo['id_cargo']) . "</td>"; // Use o nome correto
                    echo "<td>" . htmlspecialchars($cargo['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($cargo['descricao']) . "</td>";
                    echo "<td>
                        <a href='visualizarCargo.php?id=" . $cargo['id_cargo'] . "' class='btn-view'>👁️</a>
                        <a href='editarCargo.php?id=" . $cargo['id_cargo'] . "' class='btn-edit'>✏️</a>
                        <a href='../CONFIG/processamento.php?acao=excluir&id=" . $cargo['id_cargo'] . "' class='btn-delete' onclick=\"return confirm('Tem certeza que deseja excluir este cargo?');\">🗑️</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum cargo encontrado.</td></tr>";
            }
        ?>
                </tbody>
            </table>
            <button type="button" class="btn-back btn btn-secondary" formnovalidate onclick="window.location.href='../TEMPLATES/listarCargo.php'">VOLTAR</button>
            <button type="submit" name="incluir" class="btn btn-primary">SALVAR</button>
        </form>

        <!-- Modal de sucesso -->
        <div class="modal fade" id="sucessoModal" tabindex="-1" aria-labelledby="sucessoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sucessoModalLabel">Sucesso!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Funcionário incluído com sucesso!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='../TEMPLATES/listarCargo.php'">Ver Funcionários</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Verifica se o parâmetro de sucesso está na URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('sucesso')) {
            var sucessoModal = new bootstrap.Modal(document.getElementById('sucessoModal'));
            sucessoModal.show(); // Mostra o modal se o parâmetro sucesso estiver presente
        }
    </script>
</body>
</html>
