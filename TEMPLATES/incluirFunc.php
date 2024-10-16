<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Funcionário</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?>
        <main>
            <h1>Incluir Funcionário</h1>
            
            <?php
            // Incluindo a conexão com o banco de dados
            include('../CONFIG/conexao.php');

            // Query para obter a lista de cargos
            $sql = "SELECT id_cargo, nome FROM cargo";
            $result = $conexao->query($sql);
            ?>

            <form action="../CONFIG/processamento.php" method="POST">
                <input type="hidden" name="acao" value="incluir">

                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                
                <div>
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" required>
                </div>
                
                <div>
                    <label for="dt_adm">Data de Admissão:</label>
                    <input type="date" name="dt_adm" required>
                </div>
                
                <div>
                    <label for="salario">Salário:</label>
                    <input type="number" name="salario" required>
                </div>
                <label for="contato">Contato:</label>
                <input type="text" id="contato" name="contato" required>

                <div>
                    <label for="fk_cargo">Cargo:</label>
                    <select name="fk_cargo" required>
                        <option value="">Selecione um cargo</option>
                        <?php
                        // Preenchendo o select com os cargos do banco de dados, mostrando ID e Nome
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id_cargo'] . "'>" . $row['id_cargo'] . " - " . $row['nome'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhum cargo disponível</option>";
                        }
                        ?>
                    </select>
                </div>

                <button class="btn-back">VOLTAR</button>
                <button a href="listarFunc.php" class="btn-back">SALVAR</button>
            </form>
        </main>
    </div>
</body>
</html>

