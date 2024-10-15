<?php

// Incluir o arquivo de conexão
include('CONFIG/conexao.php');

// Incluir o arquivo de processamento, se necessário
include('CONFIG/processamento.php');

// Verifica se o usuário já está logado e redireciona, se for o caso
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário já está logado e redireciona, se for o caso
if(isset($_SESSION['usuario'])){
    header("Location: listarfunc.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca de Sabores</title>
    <link rel="stylesheet" href="CSS/styleLogin.css"> <!-- O estilo será gerido no style.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-login">
        <div class="login-left">
            <img src="IMAGES/imagemlogin.jpeg" alt="Biblioteca de Sabores" class="login-image">
        </div>
        <div class="login-right">
            <!-- Imagem acima do título -->
            <img src="IMAGES/perfil.png" alt="Ícone de Bem Vindo" class="welcome-icon"> <!-- Caminho da sua imagem -->
            <h2>Bem vindo!</h2>
            <form action="CONFIG/processamento.php" method="POST"> <!-- Verifique se o caminho está correto -->
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i></label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>
                <div class="login-options">
                    <label>
                        <input type="checkbox" name="lembrar"> Lembrar
                    </label>
                    <a href="recuperar_senha.php">Esqueceu a senha?</a>
                </div>
                <button type="submit" name="login">LOGAR</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

