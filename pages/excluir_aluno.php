<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/sessao.php';
include '../src//conexao.php'; // Este arquivo nos dá a variável $con

// Pega o ID da URL de forma segura, garantindo que seja um número inteiro
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);


if ($id) {
    // 1. A consulta SQL com o placeholder (?)
    $sql = "DELETE FROM alunos WHERE id = ?";

    // 2. Prepara a consulta usando a conexão do MySQLi ($con)
    $stmt = mysqli_prepare($con, $sql);

    // 3. Liga o parâmetro 'id' à consulta. "i" significa que a variável é um inteiro.
    mysqli_stmt_bind_param($stmt, "i", $id);

    // 4. Executa a exclusão
    mysqli_stmt_execute($stmt);
}

// Redireciona o usuário de volta para a lista de alunos
header("Location: /alunos.php");
exit(); // É uma boa prática adicionar exit() após um redirecionamento
?>