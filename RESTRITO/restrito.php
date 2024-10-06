<?php
session_start();

function verifica_acesso($tipos_permitidos) {
    if (!isset($_SESSION['tipo_usuario']) || !in_array($_SESSION['tipo_usuario'], $tipos_permitidos)) {
        header("Location: login.php");
        exit();
    }
}

// Para cada página, você chama a função com os tipos de usuários permitidos:
verifica_acesso(['administrador', 'cozinheiro']);  // Apenas administradores e cozinheiros podem acessar esta página.
?>
