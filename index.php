<?php session_start(); ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login</title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Sistema Escolar - Login</h2>

<?php if(isset($_SESSION['erro'])): ?>
    <p style="color:red"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>

<form method="post" action="src/login.php" style="width: 400px;">
    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Senha:</label>
    <input type="password" name="senha" required>

    <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
        <button type="submit">Entrar</button>
        <a href="pages/cadastro.php">Cadastrar</a>
    </div>
</form>
</body>
</html>