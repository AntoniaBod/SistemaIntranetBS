<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargos - Sistema Intranet</title>
    <link rel="stylesheet" href="../CSS/style1.css"> <!-- Adicione seu arquivo de estilo aqui -->
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?> <!-- Incluindo o header e o aside -->

        <main>
            <h1>Cargos</h1>
             <!-- Seção de pesquisa e inclusão de funcionário -->
             <div class="actions-top">
                <!-- Campo de pesquisa e botão de inclusão juntos, alinhados à direita -->
                <div class="search-actions">
                    <input type="text" placeholder="Pesquisar..." name="search" class="input-search">
                    <button class="btn-search">🔍</button>
                    <!-- Botão para incluir novo Cargo com link -->
                    <a href="incluirCargo.php" class="btn-add">Incluir Cargo +</a>
                </div>
            </div> 
        
            <h2>Selecione a categoria para consultar a descrição:</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th> <!-- Coluna para as ações -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0001</td>
                        <td>Cozinheiro</td>
                        <td>Lançar receitas, edita-las, editar metas, cadastrar medidas e ingredientes</td>
                        <td>
                            <a href="visualizarCargo.php?id=1" class="btn-view">👁️</a>
                            <a href="editarCargo.php?id=1" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=1" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td> <!-- Botões alinhados ao final da linha -->
                    </tr>
                    <tr>
                        <td>0002</td>
                        <td>Cozinheiro</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus tempore perspiciatis voluptatem eveniet fugit officiis consectetur ?</td>
                        <td>
                            <a href="visualizarCargo.php?id=2" class="btn-view">👁️</a>
                            <a href="editarCargo.php?id=2" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=2" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td>
                    </tr>
                    <tr>
                        <td>0003</td>
                        <td>Cozinheiro</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus tempore perspiciatis voluptatem eveniet fugit officiis consectetur ?</td>
                        <td>
                            <a href="visualizarCargo.php" class="btn-view">👁️</a>
                            <a href="editarCargo.php?id=3" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=3" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td>
                    </tr>
                    <!-- Continue para os outros funcionários -->
                </tbody>
            </table>
            <button class="btn-back">VOLTAR</button>
            <button class="btn-back">SALVAR</button>
        </main>
    </div>
</body>
</html>
