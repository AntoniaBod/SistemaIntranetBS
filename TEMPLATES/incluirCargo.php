
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Cargo</title>
    <link rel="stylesheet" href="C:\Users\antpa\OneDrive\Documentos\GitHub\SistemaIntranetBS\CSS\style1.css">
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?>
        <main>
            <h1>Incluir Cargo</h1>
            <div class="references-list">
                <form action="../CONFIG/processamento.php" method="POST">
                    <input type="hidden" name="acao" value="incluir">
                    <div  class="reference">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" required>
                   
                  
                        <label for="descricao">Descrição:</label>
                        <input type="text" name="descricao" required>
                    </div>
                    
                </form>
            </div>
            <button class="btn-back">VOLTAR</button>
            <button class="btn-back">SALVAR</button>
        </main>
    </div>
</body>
</html>
