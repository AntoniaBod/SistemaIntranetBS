<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="../CSS/style1.css"> <!-- Adicione o caminho correto para o seu CSS -->
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?> <!-- Incluindo o header e o aside -->

        <main>
            <h1>Funcionários Cadastrados</h1>

            <!-- Seção de pesquisa e inclusão de funcionário -->
            <div class="actions-top">
                <!-- Campo de pesquisa e botão de inclusão juntos, alinhados à direita -->
                <div class="search-actions">
                    <input type="text" placeholder="Pesquisar..." name="search" class="input-search">
                    <button class="btn-search">🔍</button>
                    <!-- Botão para incluir novo funcionário com link -->
                    <a href="incluirFunc.php" class="btn-add">Incluir Funcionário +</a>
                </div>
            </div> 

            <h2>Selecione o funcionário para consultar os detalhes:</h2>
            
            <!-- Tabela para exibir a lista de funcionários -->
            <table>
                    <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>CPF</th>
                <th>Data de Admissão</th>
                <th>Salário</th>
                <th>Contato</th> <!-- Nova coluna para contato -->
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Incluindo a conexão com o banco de dados
            include('../CONFIG/conexao.php');

            // Query para obter a lista de funcionários com seus cargos
            $sql = "SELECT f.id_funcionario, f.nome, c.nome AS cargo, f.cpf, f.dt_adm, f.salario, f.contato 
                    FROM funcionario f
                    JOIN cargo c ON f.fk_cargo = c.id_cargo";
            
            $result = $conn->query($sql);

            // Verifica se há resultados na consulta
            if ($result->num_rows > 0) {
                // Exibe os funcionários em cada linha da tabela
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_funcionario'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['cargo'] . "</td>";
                    echo "<td>" . $row['cpf'] . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($row['dt_adm'])) . "</td>";
                    echo "<td>R$ " . number_format($row['salario'], 2, ',', '.') . "</td>";
                    echo "<td>" . $row['contato'] . "</td>"; // Exibindo o contato
                    echo "<td>
                        <a href='visualizarFunc.php?id=" . $row['id_funcionario'] . "' class='btn-view'>👁️</a>
                        <a href='editarFunc.php?id=" . $row['id_funcionario'] . "' class='btn-edit'>✏️</a>
                        <a href='../CONFIG/processamento.php?acao=excluir&id=" . $row['id_funcionario'] . "' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este funcionário?\");'>🗑️</a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum funcionário encontrado.</td></tr>"; // Ajuste o colspan
            }
            ?>
        </tbody>

            </table>

            <!-- Paginação (se aplicável) -->
            <div class="pagination">
                <button>1</button>
                <button>2</button>
                <button>3</button>
                <button>...</button>
                <button>50</button>
            </div>
        </main>
    </div>
</body>
</html>
