<?php
include('conexao.php'); // Incluindo a conexão com o banco de dados
session_start();

// Função para incluir um novo categoria
if (isset($_POST['incluir'])) {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Todos os campos devem ser preenchidos.";
        header("Location: ../TEMPLATES/incluirCategoria.php");
        exit();
    }

    // Query para inserção
    $sql = "INSERT INTO categoria (nome, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/incluirCategoria.php");
        exit();
    }

    $stmt->bind_param("ss", $nome, $descricao);

    if ($stmt->execute()) {
        // Inserção bem-sucedida
        $_SESSION['mensagem'] = "Categoria incluído com sucesso!";
        header("Location: ../TEMPLATES/listarCategoria.php");
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao incluir categoria: " . $stmt->error;
        header("Location: ../TEMPLATES/incluirCategoria.php");
    }
    
    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

// Função para editar uma categoria
// Função para editar uma categoria
if (isset($_POST['editar'])) {
    $id_categoria = $_POST['id_categoria'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($descricao)) {
        $_SESSION['mensagem'] = "Todos os campos devem ser preenchidos.";
        header("Location: ../TEMPLATES/editarCategoria.php?id=$id_categoria");
        exit();
    }

    // Query para atualização
    $sql = "UPDATE categoria SET nome = ?, descricao = ? WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/editarCategoria.php?id=$id_categoria");
        exit();
    }

    $stmt->bind_param("ssi", $nome, $descricao, $id_categoria);

    // Execute a consulta de atualização
    if ($stmt->execute()) {
        // Atualização bem-sucedida
        $_SESSION['mensagem'] = "Categoria editada com sucesso!";
        header("Location: ../TEMPLATES/listarCategoria.php");
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao editar categoria: " . $stmt->error;
        header("Location: ../TEMPLATES/editarCategoria.php?id=$id_categoria");
    }

    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

if (isset($_GET['acao']) && $_GET['acao'] === 'excluir' && isset($_GET['id'])) {
    $id_categoria = $_GET['id']; // O ID do categoria a ser excluído

    // Query para exclusão
    $sql = "DELETE FROM categoria WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        $_SESSION['mensagem'] = "Erro na preparação da consulta: " . $conn->error;
        header("Location: ../TEMPLATES/listarCategoria.php");
        exit();
    }

    $stmt->bind_param("i", $id_categoria); // "i" para inteiro

    if ($stmt->execute()) {
        // Exclusão bem-sucedida
        $_SESSION['mensagem'] = "categoria excluído com sucesso!";
    } else {
        // Em caso de erro, armazena mensagem de erro
        $_SESSION['mensagem'] = "Erro ao excluir categoria: " . $stmt->error;
    }
    $stmt->close(); // Fechar a declaração
    header("Location: ../TEMPLATES/listarCategoria.php");
    exit(); // Garante que o script seja encerrado após o redirecionamento
}

// Função para visualizar um categoria
if (isset($_GET['id'])) {
    $id_categoria = $_GET['id']; // O ID do categoria a ser visualizado

    // Query para obter os detalhes do categoria
    $sql = "SELECT * FROM categoria WHERE id_categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_categoria); // "i" para inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc(); // Obtém os dados do categoria
        // Exibir os dados do categoria (pode ser feita em uma página específica)
        echo "<h2>Detalhes do categoria</h2>";
        echo "<p>ID: " . $categoria['id_categoria'] . "</p>";
        echo "<p>Nome: " . $categoria['nome'] . "</p>";
        echo "<p>Descrição: " . $categoria['descricao'] . "</p>";
    } else {
        $_SESSION['mensagem'] = "categoria não encontrado.";
        header("Location: ../TEMPLATES/listarCategoria.php");
        exit();
    }

    $stmt->close(); // Fechar a declaração
    $conn->close(); // Fechar a conexão
    exit(); // Garante que o script seja encerrado após o redirecionamento
}
?>
