<?php include '../src/sessao.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>

    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
    <h2>Painel</h2>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
    <ul>
        <li><a href="relatorio.php">Relatório</a></li>
        <li><a href="alunos.php">Listar Alunos</a></li>
        <li><a href="cadastro_aluno.php">Cadastrar Aluno</a></li>
        <li><a href="../src/sair.php">Sair</a></li>
    </ul>
</body>
</html>