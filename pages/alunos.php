<?php
include '../src/sessao.php';
include '../src/conexao.php';

$busca = $_GET['busca'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM alunos WHERE nome LIKE ? OR curso LIKE ? ORDER BY nome");
$stmt->execute(["%$busca%", "%$busca%"]);
$alunos = $stmt->fetchAll();
?>
<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  th, td {
    padding: 5px;
    text-align: left;
  }
</style>
<h3>Alunos</h3>
<form method="get">
  Buscar: <input type="text" name="busca" value="<?php echo htmlspecialchars($busca); ?>">
  <button type="submit">Pesquisar</button>
</form>
<table>
  <tr><th>Nome</th><th>Email</th><th>Curso</th><th>Ações</th></tr>
  <?php if (count($alunos) > 0): ?>
    <?php foreach($alunos as $a): ?>
    <tr>
      <td><?php echo htmlspecialchars($a['nome']); ?></td>
      <td><?php echo htmlspecialchars($a['email']); ?></td>
      <td><?php echo htmlspecialchars($a['curso']); ?></td>
      <td>
        <a href="editar_aluno.php?id=<?php echo $a['id']; ?>">Editar</a> |
        <a href="excluir_aluno.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Excluir?')">Excluir</a>
      </td>
    </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="4">Nenhum aluno encontrado.</td>
    </tr>
  <?php endif; ?>
</table>
<a href="dashboard.php">Voltar</a>
