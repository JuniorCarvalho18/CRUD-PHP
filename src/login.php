<?php
session_start();
include 'conexao.php'; // Reutiliza a conexão existente

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // 1. Prepara a consulta de forma segura para evitar SQL Injection
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // 2. Verifica se encontrou um usuário com o email fornecido
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // 3. Verifica se a senha digitada corresponde à senha com hash no banco
        if (password_verify($senha, $usuario['senha'])) {
            // Senha correta! Inicia a sessão.
            $_SESSION["usuario"] = $usuario["nome"]; // Salva apenas o nome na sessão
            header("Location: ../pages/dashboard.php");
            exit();
        }
    }

    // Se chegou até aqui, o email não foi encontrado ou a senha estava incorreta.
    $_SESSION["erro"] = "Email ou senha inválidos!";
    header("Location: ../index.php"); // 4. Redireciona de volta para a página de login
    exit();

} else {
    // Se alguém tentar acessar login.php diretamente, redireciona para o início
    header("Location: ../index.php");
    exit();
}
?>