<?php
include('../CONFIG/conexao.php'); // Incluindo a conexão
session_start();

// Exibir mensagem
if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-info'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}

// Consulta para obter todos os cargos
$query = "SELECT * FROM cargo";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos - Sistema Intranet</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="col-md-11 ms-sm-auto px-md-2">
<div class="container mt-4">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
       
                <div class="row align-items-center mb-3">
                    <div class="col-md-auto">
                        <h2 class="text-left" style="color:#B02727;">Cargos Cadastrados</h2>
                    </div>
                    <div class="col-md-auto ms-auto">
                        <div class="input-group">
                            <input type="text" class="form-control input-search" id="searchInput" style="margin-right: 0";   placeholder="Pesquisar..." aria-label="Pesquisar" onkeyup="searchCargos()">
                            <button class="btn btn-outline-secondary" type="button" onclick="searchCargos()">
                                <img src="../IMAGES/lupa.png" alt="Pesquisar" style="width: 20px; height: 20px;">
                            </button>
                            <button class="btn-add btn-primary ms-3" onclick="window.location.href='/SistemaIntranetBS/TEMPLATES/incluirCargo.php'">Incluir Cargo +</button>
                        </div>
                    </div>
                </div>
                <div id="cargoList">
                    <table class="table table-bordered table-striped w-100" style="text-align: center;">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>DADOS | EDITAR | EXCLUIR</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($cargo = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $cargo['id_cargo']; ?></td>
                                <td><?php echo $cargo['nome']; ?></td>
                                <td><?php echo $cargo['descricao']; ?></td>
                                <td>
                                    <a href="visualizarCargo.php?id=<?php echo $cargo['id_cargo']; ?>" class="btn-view" style="margin-right: 20px;">👁️</a>
                                    <a href="editarCargo.php?id=<?php echo $cargo['id_cargo']; ?>" class="btn-edit" style="margin-right: 20px;">✏️</a>
                                    <a href="../CONFIG/processamentoCargo.php?acao=excluir&id=<?php echo $cargo['id_cargo']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este cargo?');">🗑️</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center">Nenhum restaurante cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
    function searchCargos() {
        var query = document.getElementById('searchInput').value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../CONFIG/pesquisarCargos.php' + (query.length > 0 ? '?q=' + encodeURIComponent(query) : ''), true);
        xhr.onload = function () {
            if (this.status === 200) {
                document.getElementById('cargoList').innerHTML = this.responseText;
            } else {
                console.error('Erro ao buscar cargos:', this.statusText);
            }
        };
        xhr.send();
    }

    // Carregar todos os cargos ao iniciar a página
    document.addEventListener('DOMContentLoaded', searchCargos);
    </script>
</body>
</html>
