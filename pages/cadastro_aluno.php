<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/conexao.php';
$mensagem = ""; // Variável para guardar a mensagem de sucesso ou erro

if(isset($_POST['cadastrar_aluno'])){
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO alunos (nome, curso, email, senha) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $curso, $email, $senha);

    if (mysqli_stmt_execute($stmt)) {
        $mensagem = "Aluno cadastrado com sucesso!";
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
    <title>Cadastrar Aluno</title>

    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
    <form method="post">
      <h3>Cadastrar Aluno</h3>
      Nome: <input type="text" name="nome" required>
      Email: <input type="email" name="email" required>
      Curso: <input type="text" name="curso" required>
      Senha: <input type="password" name="senha" required>
      <button type="submit" name="cadastrar_aluno">Cadastrar</button>
    </form>
    
    <?php
    // Exibe a mensagem se ela não estiver vazia
    if (!empty($mensagem)) {
        echo "<p>" . htmlspecialchars($mensagem) . "</p>";
    }
    ?>

    <a href="dashboard.php">Voltar</a>
</body>
</html>