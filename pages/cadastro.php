<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/conexao.php';
$mensagem = ""; // Variável para a mensagem de feedback

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $sobrenome, $email, $senha);

    if (mysqli_stmt_execute($stmt)) {
        $mensagem = "Usuário cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>

    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
    <form method="POST">
        <h3>Cadastrar Usuário</h3>
        Nome: <input type="text" name="nome" required>
        Sobrenome: <input type="text" name="sobrenome" required>
        Email: <input type="email" name="email" required>
        Senha: <input type="password" name="senha" required>
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <?php
    if (!empty($mensagem)) {
        echo "<p>" . htmlspecialchars($mensagem) . "</p>";
    }
    ?>

    <a href="../index.php">Voltar para o Login</a>
</body>
</html>