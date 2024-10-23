<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Sabores - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Customizado -->
    <link rel="stylesheet" href="CSS/styleLogin.css"> <!-- Certifique-se que o caminho está correto -->
</head>
<body>
<div class="container-fluid login-container">
    <div class="row w-100">
        <!-- Seção Esquerda -->
        <div class="col-lg-6 d-none d-lg-flex left-section">
            <div class="text-center m-auto">
                <img src="IMAGES/imagemlogin.jpeg" alt="Logo Biblioteca de Sabores" class="img-fluid">
            </div>
        </div>
        <!-- Seção Direita -->
        <div class="col-lg-6 col-12 login-box d-flex align-items-center justify-content-center">
            <div class="login-form text-center">
                <div class="profile-icon">
                    <img src="IMAGES/perfil.png" alt="Ícone de Perfil" class="img-fluid" style="width: 100px;">
                </div>
                <h2 class="welcome-text">Bem-vindo!</h2>
                <form action="/CONFIG/processamento.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
                    </div>
                    <div class="d-flex justify-content-between options mb-3">
                        <label for="remember">
                            <input type="checkbox" id="remember" name="remember"> Lembrar
                        </label>
                        <a href="TEMPLATES/alterarSenha.php">Esqueceu a senha?</a>
                    </div>
                    <button type="submit" class="btn login-button">LOGAR</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
