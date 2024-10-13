<?php
session_start();
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
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sissis", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato);
    $stmt->execute();
    
    $_SESSION['mensagem'] = 'Funcionário incluído com sucesso!';
    header("Location: ../TEMPLATES/listarFunc_admin.php");
    exit();

} elseif(isset($_POST['editar'])) {
    // Atualização de um funcionário existente
    $id_funcionario = $_POST['id_funcionario'];
    $nome = $_POST['nome'];
    $fk_cargo = $_POST['fk_cargo'];
    $cpf = $_POST['cpf'];
    $dt_adm = $_POST['dt_adm'];
    $salario = $_POST['salario'];
    $contato = $_POST['contato'];

    // Adicionando um log para verificar os dados recebidos
    error_log("Atualizando funcionário: $id_funcionario, Nome: $nome, Cargo: $fk_cargo, CPF: $cpf, Data de Admissão: $dt_adm, Salário: $salario, Contato: $contato");

    $sql = "UPDATE funcionario SET nome = ?, fk_cargo = ?, cpf = ?, dt_adm = ?, salario = ?, contato = ? WHERE id_funcionario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sissisi", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $contato, $id_funcionario);
    
    if ($stmt->execute()) {
        $_SESSION['mensagem'] = 'Dados do funcionário atualizados com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar os dados do funcionário. Erro: ' . $stmt->error;
    }
    
    header("Location: ../TEMPLATES/listarFunc_admin.php");
    exit();
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


// CRUD para a tabela cargo

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
    $sql = "UPDATE cargo SET nome = ?, descricao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $descricao, $id);
    return $stmt->execute();
}

// Função para excluir um cargo
function excluirCargo($id) {
    global $conn;
    $sql = "DELETE FROM cargo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Função para obter os detalhes de um cargo
function obterCargo($id) {
    global $conn;
    $sql = "SELECT * FROM cargo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

?>
