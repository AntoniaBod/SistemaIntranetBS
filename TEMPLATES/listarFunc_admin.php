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
    <div class="layout">
        <!-- Barra Lateral (Aside) -->
        <aside>
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

        <!-- Conteúdo Principal -->
        <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                <h2 class="text-center">Funcionários Cadastrados</h2>

                <!-- Campo de busca e botão Incluir -->
                <div class="row justify-content-between mb-3">
                    <div class="col-12 col-md-6">
                        <input type="text" class="form-control" placeholder="Pesquisar...">
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <button class="btn btn-primary mt-2 mt-md-0">Incluir Funcionário +</button>
                    </div>
                </div>

                <!-- Tabela Responsiva -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>CPF</th>
                                <th>Data de Admissão</th>
                                <th>Salário</th>
                                <th>Contato</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Joao Silva</td>
                                <td>Cozinheiro</td>
                                <td>12345678900</td>
                                <td>30/11/0001</td>
                                <td>R$ 2.500,00</td>
                                <td>---</td>
                                <td>
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Ernesto Carlos</td>
                                <td>Cozinheiro</td>
                                <td>08384984859</td>
                                <td>09/04/1980</td>
                                <td>R$ 3.000,00</td>
                                <td>---</td>
                                <td>
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Outros registros de funcionários -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
