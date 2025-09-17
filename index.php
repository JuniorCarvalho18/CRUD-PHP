<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<h2>Sistema Escolar - Login</h2>

<?php if(isset($_SESSION['erro'])): ?>
    <p style="color:red"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>

<form method="post" action="src/login.php">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Entrar</button>
    <a href="pages/cadastro.php">Cadastrar</a>
</form>
</body>
</html>