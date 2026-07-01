<?php
session_start();
include 'conexao.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];

        if ($usuario['tipo'] == 'administrador') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $erro = "E-mail ou senha inválidos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Loja de Pelúcias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box" style="text-align: center;">
        <h2 style="color: #d87093; margin-bottom: 20px;">Entrar na Loja 🌸</h2>
        
        <?php if($erro): ?>
            <p style="color: red; margin-bottom: 15px;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Entrar</button>
        </form>
    </div>
</body>
</html>