<?php
session_start(); // Inicie a sessão no início do arquivo
include('conexao.php'); // Incluindo a conexão com o banco de dados

// Verificando se a requisição é para incluir ou atualizar
if (isset($_POST['incluir'])) {
    // Inclusão de um novo funcionário
    $nome = $_POST['nome'];
    $fk_cargo = $_POST['fk_cargo'];
    $cpf = $_POST['cpf'];
    $dt_adm = $_POST['dt_adm'];
    $salario = $_POST['salario'];
    $contato = $_POST['contato'];

    $sql = "INSERT INTO funcionario (nome, fk_cargo, cpf, dt_adm, salario, contato) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissis", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato);
    $stmt->execute();
    
    header("Location: ../TEMPLATES/listarFunc_admin.php");
    exit();

} elseif (isset($_POST['atualizar'])) {
    // Atualização de um funcionário existente
    $id_funcionario = $_POST['id_funcionario'];
    $nome = $_POST['nome'];
    $fk_cargo = $_POST['fk_cargo'];
    $cpf = $_POST['cpf'];
    $dt_adm = $_POST['dt_adm'];
    $salario = $_POST['salario'];
    $contato = $_POST['contato'];

    $sql = "UPDATE funcionario SET nome = ?, fk_cargo = ?, cpf = ?, dt_adm = ?, salario = ?, contato = ? WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissisi", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato, $id_funcionario);
    $stmt->execute();

    header("Location: ../TEMPLATES/listarFunc_admin.php");
    exit();
}

// Função para editar um funcionário existente
function editarFuncionario($id_funcionario, $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato) {
    global $conexao; // Certifique-se de usar a variável de conexão correta
    $sql = "UPDATE funcionario SET nome = ?, fk_cargo = ?, cpf = ?, dt_adm = ?, salario = ?, contato = ? WHERE id_funcionario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssissi", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato, $id_funcionario);
    return $stmt->execute();
}

// Processar ações
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'incluir':
                // Lógica para incluir
                break;
            case 'editar':
                // Chama a função de edição
                editarFuncionario($_POST['id_funcionario'], $_POST['nome'], $_POST['fk_cargo'], $_POST['cpf'], $_POST['dt_adm'], $_POST['salario'], $_POST['contato']);
                $_SESSION['mensagem'] = 'Funcionário editado com sucesso!';
                header("Location: ../TEMPLATES/listarFunc_admin.php");
                exit();
        }
    }
}


// Função para excluir um funcionário
function excluirFuncionario($id_funcionario) {
    global $conexao; // Certifique-se de usar a variável de conexão correta
    $sql = "DELETE FROM funcionario WHERE id_funcionario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    return $stmt->execute();
}

// Processar ações
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir' && isset($_GET['id'])) {
        if (excluirFuncionario($_GET['id'])) {
            $_SESSION['mensagem'] = 'Funcionário excluído com sucesso!';
        } else {
            $_SESSION['mensagem'] = 'Erro ao excluir funcionário.';
        }
        header("Location: ../TEMPLATES/listarFunc_admin.php"); // Redireciona para a lista de funcionários
        exit(); // Para garantir que o script não continue
    }
}


// Função para obter os detalhes de um funcionário
function obterFuncionario($id_funcionario) {
    global $conn;
    $sql = "SELECT * FROM funcionario WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}



// CRUD para a tabela cargo
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'incluir':
            // Incluir novo cargo
            if (isset($_POST['nome'], $_POST['descricao'])) {
                incluirCargo($_POST['nome'], $_POST['descricao']);
                $_SESSION['mensagem'] = 'Cargo incluído com sucesso!';
                header("Location: ../TEMPLATES/listarCargo.php");
                exit; // Adicionado para evitar que o script continue a execução
            }
            break;

        case 'editar':
            // Editar cargo existente
            if (isset($_POST['id'], $_POST['nome'], $_POST['descricao'])) {
                editarCargo($_POST['id'], $_POST['nome'], $_POST['descricao']);
                $_SESSION['mensagem'] = 'Cargo editado com sucesso!';
                header("Location: ../TEMPLATES/listarCargo.php");
                exit; // Adicionado para evitar que o script continue a execução
            }
            break;

        case 'excluir':
            // Excluir cargo
            if (isset($_GET['id'])) {
                excluirCargo($_GET['id']);
                $_SESSION['mensagem'] = 'Cargo excluído com sucesso!';
                header("Location: ../TEMPLATES/listarCargo.php");
                exit; // Adicionado para evitar que o script continue a execução
            }
            break;

        default:
            // Ação inválida
            $_SESSION['mensagem'] = 'Ação inválida!';
            header("Location: ../TEMPLATES/listarCargo.php");
            exit; // Adicionado para evitar que o script continue a execução
    }
}

// Função para incluir um novo cargo
function incluirCargo($nome, $descricao) {
    global $conn;
    $sql = "INSERT INTO cargo (nome, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $descricao);
    return $stmt->execute();
}

// Função para editar um cargo existente
function editarCargo($id, $nome, $descricao) {
    global $conn;
    $sql = "UPDATE cargo SET nome = ?, descricao = ? WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $descricao, $id);
    return $stmt->execute();
}

// Função para excluir um cargo
function excluirCargo($id) {
    global $conn;
    $sql = "DELETE FROM cargo WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Função para obter os detalhes de um cargo
function obterCargo($id) {
    global $conn;
    $sql = "SELECT * FROM cargo WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
