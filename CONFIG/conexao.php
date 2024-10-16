<?php
// Definir as credenciais de conexão com o banco de dados
$servidor = "localhost";  // Endereço do servidor (normalmente 'localhost' em ambiente local)
$usuario = "root";        // Nome de usuário do banco de dados
$senha = "";              // Senha do banco de dados
$banco = "AcervoReceita"; // Nome do banco de dados

// Criar a conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);
// Verificar se a conexão foi bem-sucedida
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Definir o charset para garantir a compatibilidade com caracteres especiais
$conexao->set_charset("utf8");

// Exemplo de mensagem de sucesso (opcional, pode remover após teste):
echo "Conexão realizada com sucesso!";
?>
