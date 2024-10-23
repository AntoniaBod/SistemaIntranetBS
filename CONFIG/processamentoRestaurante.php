<?php
session_start();
include('../CONFIG/conexao.php');

// Verifica qual ação foi solicitada: incluir, editar, excluir ou visualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];

    if ($acao == 'incluir') {
        // Função Incluir Restaurante
        $nome_restaurante = $_POST['nome_restaurante'];
        $telefone_contato = $_POST['telefone_contato'];
        $fk_cozinheiro = $_POST['fk_cozinheiro'];

        if (empty($nome_restaurante) || empty($telefone_contato) || empty($fk_cozinheiro)) {
            $_SESSION['mensagem'] = "Preencha todos os campos!";
        } else {
            // Inserir no banco de dados
            $queryInsert = "INSERT INTO restaurante (nome_restaurante, telefone_contato, fk_cozinheiro) 
                            VALUES ('$nome_restaurante', '$telefone_contato', $fk_cozinheiro)";
            if (mysqli_query($conn, $queryInsert)) {
                $_SESSION['mensagem'] = "Restaurante incluído com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Erro ao incluir restaurante: " . mysqli_error($conn);
            }

            header('Location: gerenciarRestaurante.php');
            exit();
        }
    }

    if ($acao == 'editar') {
        // Função Editar Restaurante
        $id_restaurante = $_POST['id_restaurante'];
        $nome_restaurante = $_POST['nome_restaurante'];
        $telefone_contato = $_POST['telefone_contato'];
        $fk_cozinheiro = $_POST['fk_cozinheiro'];

        if (empty($nome_restaurante) || empty($telefone_contato) || empty($fk_cozinheiro)) {
            $_SESSION['mensagem'] = "Preencha todos os campos!";
        } else {
            // Atualizar o restaurante no banco de dados
            $queryUpdate = "UPDATE restaurante 
                            SET nome_restaurante = '$nome_restaurante', telefone_contato = '$telefone_contato', fk_cozinheiro = $fk_cozinheiro
                            WHERE id_restaurante = $id_restaurante";
            if (mysqli_query($conn, $queryUpdate)) {
                $_SESSION['mensagem'] = "Restaurante atualizado com sucesso!";
            } else {
                $_SESSION['mensagem'] = "Erro ao atualizar restaurante: " . mysqli_error($conn);
            }

            header('Location: gerenciarRestaurante.php');
            exit();
        }
    }

    if ($acao == 'excluir') {
        // Função Excluir Restaurante
        $id_restaurante = $_POST['id_restaurante'];

        $queryDelete = "DELETE FROM restaurante WHERE id_restaurante = $id_restaurante";
        if (mysqli_query($conn, $queryDelete)) {
            $_SESSION['mensagem'] = "Restaurante excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir restaurante: " . mysqli_error($conn);
        }

        header('Location: gerenciarRestaurante.php');
        exit();
    }
}

// Verifica se a ação é visualizar para exibir os detalhes
if (isset($_GET['id_restaurante'])) {
    $id_restaurante = $_GET['id_restaurante'];

    // SQL para obter os dados do restaurante
    $query = "SELECT r.*, c.nome AS nome_cozinheiro 
              FROM restaurante r
              JOIN cozinheiro c ON r.fk_cozinheiro = c.id_cozinheiro
              WHERE r.id_restaurante = $id_restaurante";
    $result = mysqli_query($conn, $query);
    $restaurante = mysqli_fetch_assoc($result);

    // Exibir os dados do restaurante
    if ($restaurante) {
        echo "<h3>Detalhes do Restaurante</h3>";
        echo "Nome do Restaurante: " . htmlspecialchars($restaurante['nome_restaurante']) . "<br>";
        echo "Telefone de Contato: " . htmlspecialchars($restaurante['telefone_contato']) . "<br>";
        echo "Cozinheiro Responsável: " . htmlspecialchars($restaurante['nome_cozinheiro']) . "<br>";
    } else {
        echo "Restaurante não encontrado.";
    }
}
?>