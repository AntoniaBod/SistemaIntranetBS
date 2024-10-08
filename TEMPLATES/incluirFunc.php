<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Funcionário</title>
    <link rel="stylesheet" href="../CSS/style1.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?>
        <main>
            <h1>Incluir Funcionário</h1>
            
            <?php
            // Incluindo a conexão com o banco de dados
            include('../CONFIG/conexao.php');

            // Query para obter a lista de cargos
            $sql = "SELECT id_cargo, nome FROM cargo";
            $result = $conn->query($sql);
            ?>
           <div class="references-list">
               <form action="../CONFIG/processamento.php" method="POST">
                    <div class="reference">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" required>
                       
                            <label for="cpf">CPF:</label>
                            <input type="text" name="cpf" required>
                    
                            <label for="dt_adm">Data de Admissão:</label>
                            <input type="date" name="dt_adm" required>
                    
                            <label for="salario">Salário:</label>
                            <input type="number" name="salario" required>

                            <label for="contato">Contato:</label>
                            <input type="text" id="contato" name="contato" required>

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
                </form>
                <button class="btn-back">VOLTAR</button>
                <button a href="listarFunc.php" class="btn-back">SALVAR</button>
            </div>
            
        </main>
    </div>
</body>
</html>

