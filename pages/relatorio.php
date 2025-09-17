	<?php
include '../src/sessao.php';
include '../src/conexao.php';

$total = $pdo->query("SELECT COUNT(*) FROM alunos")->fetchColumn();
$stmt = $pdo->query("SELECT curso, COUNT(*) as qtd FROM alunos GROUP BY curso");

echo "<h3>Relatório</h3>";
echo "<p>Total de alunos: $total</p>";
echo "<table border='1' cellpadding='5'><tr><th>Curso</th><th>Quantidade</th></tr>";
foreach($stmt as $linha){
    echo "<tr><td>{$linha['curso']}</td><td>{$linha['qtd']}</td></tr>";
}
echo "</table>";
?>
<a href="dashboard.php">Voltar</a>
