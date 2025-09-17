<?php include '../src/sessao.php'; ?>
<h2>Painel</h2>
<p>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</p>
<ul>
    <li><a href="relatorio.php">Relatório</a></li>
    <li><a href="alunos.php">Listar Alunos</a></li>
  <li><a href="cadastro_aluno.php">Cadastrar Aluno</a></li>
  <li><a href="../src/sair.php">Sair</a></li>
</ul>