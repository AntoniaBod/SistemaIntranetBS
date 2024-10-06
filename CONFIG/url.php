<?php
// Definir o caminho base do sistema
define('BASE_URL', 'http://localhost/sistema-intranet/'); // Alterar conforme a URL real do projeto

// Função para gerar URLs absolutas
function url($path = '') {
    return BASE_URL . $path;
}

// Função para redirecionar para outra página
function redirecionar($rota) {
    header("Location: " . url($rota));
    exit();
}

// Função para verificar se o usuário está logado
function verificarLogin() {
    if (!isset($_SESSION['usuario'])) {
        redirecionar('Index.php'); // Redireciona para a página de login se não estiver logado
    }
}
?>
