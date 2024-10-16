<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Sistema Intranet</title>
    <link rel="stylesheet" href="../CSS/style1.css"> <!-- Adicione seu arquivo de estilo aqui -->
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headerAdmin.php"); ?> <!-- Incluindo o header e o aside -->

        <main>
            <h1>Categorias</h1>
            <div class="actions-top">
                <!-- Campo de pesquisa e botão de inclusão juntos, alinhados à direita -->
                <div class="search-actions">
                    <input type="text" placeholder="Pesquisar..." name="search" class="input-search">
                    <button class="btn-search">🔍</button>
                    <!-- Botão para incluir novo funcionário com link -->
                    <a href="incluirFunc.php" class="btn-add">Incluir Funcionário +</a>
                </div>
            </div> 
            <h2>Selecione a categoria para consultar a descrição:</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Categoria</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th> <!-- Coluna para as ações -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0001</td>
                        <td>Aves</td>
                        <td>Em ramo culinário, a categoria de aves é bastante diversificada.</td>
                        <td>
                            <a href="visualizarFunc.php?id=1" class="btn-view">👁️</a>
                            <a href="editarFunc.php?id=1" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=1" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td> <!-- Botões alinhados ao final da linha -->
                    </tr>
                    <tr>
                        <td>0002</td>
                        <td>Bebidas</td>
                        <td>A categoria de bebidas é igualmente diversificada.</td>
                        <td>
                            <a href="visualizarFunc.php?id=1" class="btn-view">👁️</a>
                            <a href="editarFunc.php?id=1" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=1" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td> <!-- Botões alinhados ao final da linha -->
                    </tr>
                    <tr>
                        <td>0003</td>
                        <td>Bolos e tortas</td>
                        <td>Os bolos são geralmente feitos com uma base de farinha.</td>
                        <td>
                            <a href="visualizarFunc.php?id=1" class="btn-view">👁️</a>
                            <a href="editarFunc.php?id=1" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=1" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td> <!-- Botões alinhados ao final da linha -->
                    </tr>
                    <tr>
                        <td>0004</td>
                        <td>Massas</td>
                        <td>Referem-se a pratos cujo ingrediente principal é a massa.</td>
                        <td>
                            <a href="visualizarFunc.php?id=1" class="btn-view">👁️</a>
                            <a href="editarFunc.php?id=1" class="btn-edit">✏️</a>
                            <a href="../CONFIG/processamento.php?acao=excluir&id=1" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">🗑️</a>
                        </td> <!-- Botões alinhados ao final da linha -->
                    </tr>
                </tbody>
            </table>
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
