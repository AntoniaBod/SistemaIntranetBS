<?php
if ($_SESSION['tipo_usuario'] == 'administrador') {
    echo '<li><a href="funcionarios.php">Gerenciar Funcionários</a></li>';
    echo '<li><a href="metas.php">Definir Metas</a></li>';
}
if ($_SESSION['tipo_usuario'] == 'cozinheiro') {
    echo '<li><a href="receitas.php">Cadastrar Receitas</a></li>';
}
if ($_SESSION['tipo_usuario'] == 'degustador') {
    echo '<li><a href="receitas.php">Avaliar Receitas</a></li>';
}
if ($_SESSION['tipo_usuario'] == 'editor') {
    echo '<li><a href="livro.php">Finalizar Livro</a></li>';
}
?>
