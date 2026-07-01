<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mundo das Pelúcias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>🌸 Mundo das Pelúcias 🌸</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if ($_SESSION['tipo'] == 'administrador'): ?>
                <a href="admin.php" style="color: #ff1493;">Painel Admin</a>
            <?php endif; ?>
            <a href="logout.php" style="color: #777;">Sair</a>
        </nav>
    </header>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 30px; color: #d87093;">✨ Super Ofertas da Semana ✨</h2>
        
        <div class="produtos-grid">
            <?php while($produto = mysqli_fetch_assoc($resultado)): ?>
                <div class="card">
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                    <h3><?php echo $produto['nome']; ?></h3>
                    <p><?php echo $produto['descricao']; ?></p>
                    <div class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></div>
                    
                    <a href="comprar.php?id=<?php echo $produto['id']; ?>" class="btn">Comprar</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Mundo das Pelúcias. Todos os direitos reservados.</p>
    </footer>

</body>
</html>