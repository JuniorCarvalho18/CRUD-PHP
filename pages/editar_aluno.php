<?php
include '../src/sessao.php';
include '../src/conexao.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: alunos.php"); exit; }

if (isset($_POST['salvar'])) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $sql = $pdo->prepare("UPDATE alunos SET nome=?, email=?, curso=?, senha=? WHERE id=?");
        $sql->execute([$nome, $email, $curso, $senha, $id]);
    } else {
        $sql = $pdo->prepare("UPDATE alunos SET nome=?, email=?, curso=? WHERE id=?");
        $sql->execute([$nome, $email, $curso, $id]);
    }
    echo "Aluno atualizado!";
}

$sql = $pdo->prepare("SELECT * FROM alunos WHERE id=?");
$sql->execute([$id]);
$aluno = $sql->fetch();
?>
<form method="post">
  <h3>Editar Aluno</h3>
  Nome: <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>"><br><br>
  Email: <input type="email" name="email" value="<?php echo $aluno['email']; ?>"><br><br>
  Curso: <input type="text" name="curso" value="<?php echo $aluno['curso']; ?>"><br><br>
  Nova senha: <input type="password" name="senha"><br><br>
  <button type="submit" name="salvar">Salvar</button>
</form>
<a href="alunos.php">Voltar</a>