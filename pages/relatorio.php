<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/sessao.php';
include '../src/conexao.php'; // Fornece a variável $con

// --- SEÇÃO CONVERTIDA DE PDO PARA MYSQLI ---

// 1. Buscando o total de alunos com MySQLi
$sql_total = "SELECT COUNT(*) FROM alunos";
$resultado_total = mysqli_query($con, $sql_total);
// mysqli_fetch_row() pega a primeira linha, e [0] pega a primeira coluna dessa linha
$total_array = mysqli_fetch_row($resultado_total);
$total = $total_array[0];

// 2. Buscando a quantidade de alunos por curso com MySQLi
$sql_cursos = "SELECT curso, COUNT(*) as qtd FROM alunos GROUP BY curso";
$resultado_cursos = mysqli_query($con, $sql_cursos);

// --- FIM DA SEÇÃO CONVERTIDA ---


echo "<h3>Relatório</h3>";
echo "<p>Total de alunos: $total</p>";

// O HTML abaixo está praticamente igual, só o loop foreach mudou para while
echo "<table border='1' cellpadding='5'><tr><th>Curso</th><th>Quantidade</th></tr>";

// Para MySQLi, usamos um loop 'while' para percorrer os resultados
while($linha = mysqli_fetch_assoc($resultado_cursos)){
    echo "<tr><td>" . htmlspecialchars($linha['curso']) . "</td><td>" . htmlspecialchars($linha['qtd']) . "</td></tr>";
}

echo "</table>";
?>
<a href="dashboard.php">Voltar</a>