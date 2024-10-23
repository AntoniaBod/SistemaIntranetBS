<?php
include('conexao.php'); // Incluindo a conexão com o banco de dados
session_start();

// Função para incluir um novo cargo
if (isset($_POST['incluir'])) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Todos os campos devem ser preenchidos.";
        header("Location: ../TEMPLATES/incluirCargo.php");
        exit();
    }

    // Query para inserção
    $sql = "INSERT INTO cargo (nome, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/incluirCargo.php");
        exit();
    }

    $stmt->bind_param("ss", $nome, $descricao);

    if ($stmt->execute()) {
        // Inserção bem-sucedida
        $_SESSION['mensagem'] = "Cargo incluído com sucesso!";
        header("Location: ../TEMPLATES/listarCargo.php");
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao incluir cargo: " . $stmt->error;
        header("Location: ../TEMPLATES/incluirCargo.php");
    }
    
    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

// Função para editar um cargo
if (isset($_POST['editar'])) {
    $id_cargo = $_POST['id_cargo'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Todos os campos devem ser preenchidos.";
        header("Location: ../TEMPLATES/editarCargo.php?id=$id_cargo");
        exit();
    }

    // Query para atualização
    $sql = "UPDATE cargo SET nome = ?, descricao = ? WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/editarCargo.php?id=$id_cargo");
        exit();
    }

    $stmt->bind_param("ssi", $nome, $descricao, $id_cargo);

    if ($stmt->execute()) {
        // Atualização bem-sucedida
        $_SESSION['mensagem'] = "Cargo editado com sucesso!";
        header("Location: ../TEMPLATES/listarCargo.php");
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao editar cargo: " . $stmt->error;
        header("Location: ../TEMPLATES/editarCargo.php?id=$id_cargo");
    }

    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

if (isset($_GET['acao']) && $_GET['acao'] === 'excluir' && isset($_GET['id'])) {
    $id_cargo = $_GET['id']; // O ID do cargo a ser excluído

    // Query para exclusão
    $sql = "DELETE FROM cargo WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/listarCargo.php");
        exit();
    }

    $stmt->bind_param("i", $id_cargo); // "i" para inteiro

    if ($stmt->execute()) {
        // Exclusão bem-sucedida
        $_SESSION['mensagem'] = "Cargo excluído com sucesso!";
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao excluir cargo: " . $stmt->error;
    }
    $stmt->close(); // Fechar a declaração
    header("Location: ../TEMPLATES/listarCargo.php");
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

// Função para visualizar um cargo
if (isset($_GET['id'])) {
    $id_cargo = $_GET['id']; // O ID do cargo a ser visualizado

    // Query para obter os detalhes do cargo
    $sql = "SELECT * FROM cargo WHERE id_cargo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cargo); // "i" para inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cargo = $result->fetch_assoc(); // Obtém os dados do cargo
        // Exibir os dados do cargo (pode ser feita em uma página específica)
        echo "<h2>Detalhes do Cargo</h2>";
        echo "<p>ID: " . $cargo['id_cargo'] . "</p>";
        echo "<p>Nome: " . $cargo['nome'] . "</p>";
        echo "<p>Descrição: " . $cargo['descricao'] . "</p>";
    } else {
        $_SESSION['mensagem'] = "Cargo não encontrado.";
        header("Location: ../TEMPLATES/listarCargo.php");
        exit();
    }

    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}
?>
