<?php

// Função para cadastrar novos usuários
include('conexao.php'); // Incluindo a conexão com o banco de dados


// Função para incluir um novo funcionário
function incluirFuncionario($nome, $fk_cargo, $cpf, $dt_adm, $salario) {
    global $conn; // Usando a conexão global
    // Query SQL para inserir funcionário
    $sql = "INSERT INTO funcionario (nome, fk_cargo, cpf, dt_adm, salario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $nome, $fk_cargo, $cpf, $dt_adm, $salario);
    return $stmt->execute();
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao']) && $_POST['acao'] == 'incluir') {
        // Pega os dados do formulário e garante que todos os campos obrigatórios estão presentes
        $nome = $_POST['nome'] ?? null;
        $cpf = $_POST['cpf'] ?? null;
        $dt_adm = $_POST['dt_adm'] ?? null;
        $salario = $_POST['salario'] ?? null;
        $fk_cargo = $_POST['fk_cargo'] ?? null;

        // Verifica se todos os campos obrigatórios estão preenchidos
        if ($nome && $cpf && $dt_adm && $salario && $fk_cargo) {
            if (incluirFuncionario($nome, $fk_cargo, $cpf, $dt_adm, $salario)) {
                header("Location: ../listarfunc.php"); // Redireciona para a lista de funcionários após inclusão bem-sucedida
            } else {
                echo "Erro: Falha ao incluir o funcionário."; // Mensagem de erro
            }
        } else {
            echo "Erro: Todos os campos são obrigatórios."; // Mensagem de erro
        }
    }


// Função para editar um funcionário existente
function editarFuncionario($id_funcionario, $nome, $fk_cargo, $cpf, $dt_adm, $salario) {
    global $conn;
    // Corrigido o campo 'fk_cargo'
    $sql = "UPDATE funcionario SET nome = ?, fk_cargo = ?, cpf = ?, dt_adm = ?, salario = ? WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissii", $nome, $fk_cargo, $cpf, $dt_adm, $salario, $id_funcionario);
    return $stmt->execute();
}

// Função para excluir um funcionário
function excluirFuncionario($id_funcionario) {
    global $conn;
    $sql = "DELETE FROM funcionario WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_funcionario);
    return $stmt->execute();
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

// Processar as ações com base no método HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'incluir':
                incluirFuncionario($_POST['nome'], $_POST['fk_cargo'], $_POST['cpf'], $_POST['dt_adm'], $_POST['salario']);
                header("Location: ../listarfunc.php");
                break;

            case 'editar':
                editarFuncionario($_POST['id_funcionario'], $_POST['nome'], $_POST['fk_cargo'], $_POST['cpf'], $_POST['dt_adm'], $_POST['salario']);
                header("Location: ../listarfunc.php");
                break;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        excluirFuncionario($_GET['id']);
        header("Location: ../listarfunc.php");
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

// Processar as ações com base no método HTTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao'])) {
        switch ($_POST['acao']) {
            case 'incluir':
                incluirFuncionario($_POST['nome'], $_POST['cargo'], $_POST['cpf'], $_POST['dt_adm'], $_POST['salario']);
                header("Location: ../listarfunc.php");
                break;

            case 'editar':
                editarFuncionario($_POST['id'], $_POST['nome'], $_POST['cargo'], $_POST['cpf'], $_POST['dt_adm'], $_POST['salario']);
                header("Location: ../listarfunc.php");
                break;

            case 'incluirCargo':
                incluirCargo($_POST['nome'], $_POST['descricao']);
                header("Location: ../listarCargo.php"); // Redirecionar para a lista de cargos
                break;

            case 'editarCargo':
                editarCargo($_POST['id'], $_POST['nome'], $_POST['descricao']);
                header("Location: ../listarCargo.php"); // Redirecionar para a lista de cargos
                break;
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['acao'])) {
    if ($_GET['acao'] == 'excluir') {
        excluirFuncionario($_GET['id']);
        header("Location: ../listarfunc.php");
    } elseif ($_GET['acao'] == 'excluirCargo') {
        excluirCargo($_GET['id']);
        header("Location: ../listarCargo.php"); // Redirecionar para a lista de cargos
    }
}
}
?>
