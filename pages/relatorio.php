<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../src/sessao.php';
include '../src/conexao.php'; // Fornece a variável $con

// --- SEÇÃO CONVERTIDA DE PDO PARA MYSQLI ---

// 1. Buscando o total de alunos com MySQLi
$sql_total = "SELECT COUNT(*) as total FROM alunos";
$resultado_total = mysqli_query($con, $sql_total);
$total_data = mysqli_fetch_assoc($resultado_total);
$total = $total_data['total'];

// 2. Buscando a quantidade de alunos por curso com MySQLi
$sql_cursos = "SELECT curso, COUNT(*) as qtd FROM alunos GROUP BY curso";
$resultado_cursos = mysqli_query($con, $sql_cursos);

// --- FIM DA SEÇÃO CONVERTIDA ---
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Alunos</title>

    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
    <h3>Relatório</h3>
    <form>
    <p>Total de alunos: <?php echo $total; ?></p>
    <table>
        <tr>
            <th>Curso</th>
            <th>Quantidade</th>
        </tr>
        <?php 
        // Verifica se há resultados antes de tentar criar a tabela
        if ($resultado_cursos && mysqli_num_rows($resultado_cursos) > 0):
            // Loop while para percorrer os resultados
            while($linha = mysqli_fetch_assoc($resultado_cursos)): 
        ?>
            <tr>
                <td><?php echo htmlspecialchars($linha['curso']); ?></td>
                <td><?php echo htmlspecialchars($linha['qtd']); ?></td>
            </tr>
        <?php 
            endwhile; 
        else:
        ?>
            <tr>
                <td colspan="2">Nenhum aluno encontrado para gerar o relatório por curso.</td>
            </tr>
        <?php
        endif;
        ?>
    </table>
    </form>
    <a href="dashboard.php">Voltar</a>
</body>
</html>