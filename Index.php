<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Sabores - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Seu CSS customizado -->
    <link rel="stylesheet" href="/CSS/styleLogin.css"> <!-- Verifique se este caminho está correto -->
</head>
<body>

<div class="container-fluid login-container">
    <div class="row w-100">
        <!-- Seção Esquerda -->
        <div class="col-lg-6 d-none d-lg-flex left-section">
            <div>
                <h1>Biblioteca de Sabores</h1>
                <img src="/IMAGES/imagemlogin.jpeg" alt="Logo Biblioteca de Sabores" class="img-fluid">
                <!-- Certifique-se de que o caminho da imagem está correto -->
            </div>
        </div>
        <!-- Seção Direita -->
        <div class="col-lg-6 col-12 login-box d-flex align-items-center justify-content-center">
            <div>
                <div class="profile-icon text-center">
                    <img src="/IMAGES/perfil.png" alt="Ícone de Perfil" class="img-fluid" style="width: 100px;">
                    <!-- Certifique-se de que o caminho da imagem está correto -->
                </div>
                <h2 class="text-center">Bem-vindo!</h2>
                <form action="/CONFIG/processamento.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person"></i></span> <!-- Ícone de usuário -->
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span> <!-- Ícone de senha -->
                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
                    </div>
                    <div class="options mb-3">
                        <label for="remember">
                            <input type="checkbox" id="remember" name="remember"> Lembrar
                        </label>
                        <a href="#">Esqueceu a senha?</a>
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
