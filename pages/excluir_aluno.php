<?php
include '../src/sessao.php';
include '../src/conexao.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $sql = $pdo->prepare("DELETE FROM alunos WHERE id=?");
    $sql->execute([$id]);
}
header("Location: alunos.php");
?>