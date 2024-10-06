<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Referências</title>
    <link rel="stylesheet" href="../CSS/style1.css"> <!-- Adicione seu arquivo de estilo aqui -->
</head>
<body>
    <div class="container">
        <?php include_once("../INCLUDES/headeradmin.php"); ?> <!-- Incluindo o header e o aside -->
        
        <main>
            <h1>Editar Referências</h1>
    
            <div class="references-list">
                <form action="processamento.php" method="POST">
                    <div class="reference">
                        <label for="cozinheiro">Cozinheiro *</label>
                        <input type="text" id="cozinheiro" name="cozinheiro" value="João Jose" disabled>

                        <label for="restaurante">Restaurante *</label>
                        <input type="text" id="restaurante" name="restaurante" value="Panela de Barro" disabled>

                        <label for="data_inicio">Data Início *</label>
                        <input type="text" id="data_inicio" name="data_inicio" value="01/04/2005" disabled>

                        <label for="data_final">Data Final *</label>
                        <input type="text" id="data_final" name="data_final" value="10/09/2005" disabled>

                        <label for="contato">Contato *</label>
                        <input type="text" id="contato" name="contato" value="(61) 999999999" disabled>

                    </div>
                </form>
            </div>
            <button class="btn-back">VOLTAR</button>
            <button class="btn-back">SALVAR</button>
        </main>
    </div>
</body>
</html>
