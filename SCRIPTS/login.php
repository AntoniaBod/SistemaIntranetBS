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
<?php
session_start();
include 'config/conexao.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar as credenciais e o perfil do funcionário
    $sql = "
        SELECT u.id_usuarios, f.nome, f.perfil, u.senha
        FROM usuario u
        JOIN funcionario f ON u.fk_funcionario = f.id_funcionario
        WHERE u.login = ? AND f.status = 'ativo'
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        // Armazena informações importantes na sessão
        $_SESSION['user_id'] = $user['id_usuarios'];
        $_SESSION['user_nome'] = $user['nome'];
        $_SESSION['user_perfil'] = $user['perfil'];

        // Redireciona de acordo com o perfil do funcionário
        switch ($user['perfil']) {
            case 'Administrador':
                header('Location: dashboard_admin.php');
                break;
            case 'Cozinheiro':
                header('Location: dashboard_cozinheiro.php');
                break;
            case 'Degustador':
                header('Location: dashboard_degustador.php');
                break;
            case 'Editor':
                header('Location: dashboard_editor.php');
                break;
            default:
                // Caso o perfil não seja reconhecido
                header('Location: login.php?erro=perfil');
        }
    } else {
        // Caso o login falhe
        header('Location: login.php?erro=login');
    }
}
?>

