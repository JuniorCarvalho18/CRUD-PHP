<?php
// Adicionado para vermos qualquer erro que possa surgir
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/sessao.php';
include '../src/conexao.php'; // Este arquivo cria a variável $con

// A variável de conexão agora é $con, que vem do conexao.php
if (!$con) {
    die("A conexão com o banco de dados falhou.");
}

$busca = $_GET['busca'] ?? '';

// --- SEÇÃO DE CÓDIGO ALTERADA DE PDO PARA MYSQLI ---

// 1. A consulta SQL é a mesma, mas a preparamos com a função do MySQLi
$sql = "SELECT * FROM alunos WHERE nome LIKE ? OR curso LIKE ? ORDER BY nome";
$stmt = mysqli_prepare($con, $sql);

// 2. Criamos a variável para o LIKE do MySQLi (precisa ser feito separadamente)
$busca_param = "%{$busca}%";

// 3. Ligamos os parâmetros ao statement ("ss" significa duas variáveis do tipo string)
mysqli_stmt_bind_param($stmt, "ss", $busca_param, $busca_param);

// 4. Executamos o statement
mysqli_stmt_execute($stmt);

// 5. Pegamos os resultados da consulta
$result = mysqli_stmt_get_result($stmt);

// 6. Buscamos todos os resultados em um array associativo
$alunos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// --- FIM DA SEÇÃO ALTERADA ---

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