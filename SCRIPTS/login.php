<?php
session_start();
include("config/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verificar o usuário e senha no banco de dados (simplificado):
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conn, $query);
    $dados = mysqli_fetch_assoc($resultado);

    if ($dados) {
        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['tipo_usuario'] = $dados['tipo'];  // 'administrador', 'cozinheiro', 'degustador', 'editor'

        // Redireciona de acordo com o tipo de usuário:
        if ($dados['tipo'] == 'administrador') {
            header("Location: templates/dashboard_admin.php");
        } elseif ($dados['tipo'] == 'cozinheiro') {
            header("Location: templates/dashboard_cozinheiro.php");
        } elseif ($dados['tipo'] == 'editor') {
            header("Location: templates/dashboard_editor.php");
        } elseif ($dados['tipo'] == 'degustador') {
            header("Location: templates/dashboard_degustador.php");
        }
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>
