<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/conexao.php';
if(isset($_POST['cadastrar_aluno'])){
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO alunos (nome, curso, email, senha) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssss", $nome, $curso, $email, $senha);

    if (mysqli_stmt_execute($stmt)) {
        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}
?>
<form method="post">
  <h3>Cadastrar Aluno</h3>
  Nome: <input type="text" name="nome" required><br><br>
  Email: <input type="email" name="email" required><br><br>
  Curso: <input type="text" name="curso" required><br><br>
  Senha: <input type="password" name="senha" required><br><br>
  <button type="submit" name="cadastrar_aluno">Cadastrar</button>
</form>
<a href="dashboard.php">Voltar</a>