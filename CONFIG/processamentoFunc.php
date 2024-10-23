<?php
session_start();
include('../CONFIG/conexao.php');

$action = $_POST['action'] ?? null; // Captura a ação do formulário

// Incluir Funcionário
if ($action === 'incluir') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dt_adm = $_POST['dt_adm'];
    $salario = $_POST['salario'];
    $contato = $_POST['contato'];
    $fk_cargo = $_POST['fk_cargo'];
    $fk_restaurante = $_POST['fk_restaurante'];

    $query = "INSERT INTO funcionario (nome, cpf, dt_adm, salario, contato, fk_cargo, fk_restaurante) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssdssi", $nome, $cpf, $dt_adm, $salario, $contato, $fk_cargo, $fk_restaurante);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Funcionário incluído com sucesso!";
        header("Location: listarFunc.php");
        exit();
    } else {
        die("Erro ao incluir funcionário: " . $stmt->error);
    }
}

// Editar Funcionário
if ($action === 'editar') {
    $id_funcionario = $_POST['id_funcionario'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dt_adm = $_POST['dt_adm'];
    $salario = $_POST['salario'];
    $contato = $_POST['contato'];
    $fk_cargo = $_POST['fk_cargo'];
    $fk_restaurante = $_POST['fk_restaurante'];

    $query = "UPDATE funcionario SET nome=?, cpf=?, dt_adm=?, salario=?, contato=?, fk_cargo=?, fk_restaurante=? WHERE id_funcionario=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssdssii", $nome, $cpf, $dt_adm, $salario, $contato, $fk_cargo, $fk_restaurante, $id_funcionario);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Funcionário editado com sucesso!";
        header("Location: listarFunc.php");
        exit();
    } else {
        die("Erro ao editar funcionário: " . $stmt->error);
    }
}

// Excluir Funcionário
if ($action === 'excluir') {
    $id_funcionario = $_GET['id'];
    echo "ID do Funcionário: " . htmlspecialchars($id_funcionario); // Verificar se o ID está sendo recebido

    // Verifica se o funcionário existe
    $queryCheck = "SELECT * FROM funcionario WHERE id_funcionario=?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param("i", $id_funcionario);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows === 0) {
        die("Funcionário não encontrado!");
    }

    // Exclui o funcionário
    $query = "DELETE FROM funcionario WHERE id_funcionario=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_funcionario);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Funcionário excluído com sucesso!";
        header("Location: listarFunc.php");
        exit();
    } else {
        die("Erro ao excluir funcionário: " . $stmt->error);
    }
}




// Visualizar Funcionário
if ($action === 'visualizar') {
    $id_funcionario = $_GET['id'];

    $query = "SELECT * FROM funcionario WHERE id_funcionario=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();
    $funcionario = $result->fetch_assoc();

    // Exibir informações do funcionário
    echo "<h2>Dados do Funcionário</h2>";
    echo "<p>Nome: " . htmlspecialchars($funcionario['nome']) . "</p>";
    echo "<p>CPF: " . htmlspecialchars($funcionario['cpf']) . "</p>";
    echo "<p>Data de Admissão: " . date('d/m/Y', strtotime($funcionario['dt_adm'])) . "</p>";
    echo "<p>Salário: R$ " . number_format($funcionario['salario'], 2, ',', '.') . "</p>";
    echo "<p>Contato: " . htmlspecialchars($funcionario['contato']) . "</p>";
    echo "<p>Cargo: " . htmlspecialchars($funcionario['fk_cargo']) . "</p>";
    echo "<p>Restaurante: " . htmlspecialchars($funcionario['fk_restaurante']) . "</p>";
    echo "<a href='listarFunc.php'>Voltar</a>";
    exit();
}
?>
