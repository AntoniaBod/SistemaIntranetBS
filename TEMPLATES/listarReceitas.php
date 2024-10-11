<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários Cadastrados</title>
    <link rel="stylesheet" href="../CSS/style1.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<body>
<body>
    <header>
        <div class="logo">
            <img src="../IMAGES/logo.jpeg" alt="Logo">
        </div>
        <div class="user-info">
            <span>UsernameAdm</span>
            <button type="submit" class="logout-button">
                <img src="../IMAGES/Log out.png" alt="Sair" class="logout-icon">
            </button>
        </div>
    </header>

    <!-- Layout principal com barra lateral e conteúdo -->
    <div class="container-fluid">
        <div class="row">
            <!-- Barra Lateral (Aside) -->
            <aside class="col-md-2">
                <nav>
                    <ul>
                        <li><a href="../TEMPLATES/listarCategoria.php">Categorias</a></li>
                        <li><a href="../TEMPLATES/listarCargo.php">Cargos</a></li>
                        <li><a href="#">Degustações</a></li>
                        <li><a href="../TEMPLATES/listarFunc_admin.php">Funcionários</a></li>
                        <li><a href="#">Ingredientes</a></li>
                        <li><a href="#">LivroBS</a></li>
                        <li><a href="#">Medidas</a></li>
                        <li><a href="#">Metas</a></li>
                        <li><a href="../TEMPLATES/listarReceitas.php">Receitas</a></li>
                        <li><a href="../TEMPLATES/ListarRestaurante.php">Restaurante</a></li>
                    </ul>
                </nav>
            </aside>
        </div>
    </div>
</body>
</html>
