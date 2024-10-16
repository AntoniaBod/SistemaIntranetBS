<?php
// Definir as credenciais de conexão com o banco de dados
$servidor = "localhost";  // Endereço do servidor (normalmente 'localhost' em ambiente local)
$usuario = "root";        // Nome de usuário do banco de dados
$senha = "";              // Senha do banco de dados
$banco = "AcervoReceita"; // Nome do banco de dados

// Criar a conexão com o banco de dados
$conn = new mysqli($servidor, $usuario, $senha, $banco);
// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir o charset para garantir a compatibilidade com caracteres especiais
$conn->set_charset("utf8");

// Exemplo de mensagem de sucesso (opcional, pode remover após teste):
/*echo "Conexão realizada com sucesso!";*/
?>
