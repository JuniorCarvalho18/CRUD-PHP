<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/conexao.php';
if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO usuarios (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "ssss", $nome, $sobrenome, $email, $senha);

    if (mysqli_stmt_execute($stmt)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}
?>
<form method="POST">
    <h3>Cadastrar Usuário</h3>
    Nome: <input type="text" name="nome"><br>
    Sobrenome: <input type="text" name="sobrenome"><br><br>
    Email: <input type="email" name="email"><br><br>
    Senha: <input type="password" name="senha"><br><br>
    <button type="submit" name="cadastrar">Cadastrar</button>
</form>