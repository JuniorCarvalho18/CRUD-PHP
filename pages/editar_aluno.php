<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/sessao.php';
include '../src/conexao.php'; // Fornece a variável $con

// Pega o ID da URL de forma segura
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: alunos.php");
    exit;
}

// --- PARTE 1: LÓGICA PARA SALVAR OS DADOS (QUANDO O FORMULÁRIO É ENVIADO) ---
if (isset($_POST['salvar'])) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];

    // Se o campo de nova senha NÃO estiver vazio, atualiza a senha
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        
        $sql = "UPDATE alunos SET nome=?, email=?, curso=?, senha=? WHERE id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $nome, $email, $curso, $senha, $id);

    } else { // Se o campo de senha estiver vazio, atualiza sem mexer na senha
        
        $sql = "UPDATE alunos SET nome=?, email=?, curso=? WHERE id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $curso, $id);
    }
    
    // Executa a consulta de atualização
    if (mysqli_stmt_execute($stmt)) {
        header("Location: alunos.php?status=editado");
        exit();
    } else {
        $erro = "Erro ao atualizar o aluno.";
    }
}

// --- PARTE 2: LÓGICA PARA BUSCAR OS DADOS DO ALUNO E MOSTRAR NO FORMULÁRIO ---
$sql_select = "SELECT * FROM alunos WHERE id = ?";
$stmt_select = mysqli_prepare($con, $sql_select);
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$result = mysqli_stmt_get_result($stmt_select);
$aluno = mysqli_fetch_assoc($result);

// Se nenhum aluno for encontrado com esse ID, volta para a lista
if (!$aluno) {
    header("Location: alunos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>

    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
    <form method="post">
      <h3>Editar Aluno</h3>
      Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($aluno['nome']); ?>" required>
      Email: <input type="email" name="email" value="<?php echo htmlspecialchars($aluno['email']); ?>" required>
      Curso: <input type="text" name="curso" value="<?php echo htmlspecialchars($aluno['curso']); ?>" required>
      Nova senha (deixe em branco para não alterar): <input type="password" name="senha">
      <button type="submit" name="salvar">Salvar Alterações</button>
    </form>

    <?php
    if (isset($erro)) {
        echo "<p>" . htmlspecialchars($erro) . "</p>";
    }
    ?>

    <a href="alunos.php">Voltar</a>
</body>
</html>