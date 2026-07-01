<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'administrador') {
    die("Acesso estritamente reservado aos administradores.");
}

$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Painel Administrativo</h1>
        <nav>
            <a href="index.php">Ver Vitrine da Loja</a>
            <a href="cadastrar.php" style="background: #fff; color: #ff69b4; padding: 5px 10px; border-radius: 5px;">+ Novo Produto</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="container">
        <h2 style="margin-bottom: 20px; color: #d87093;">Gerenciamento de Pelúcias</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($prod = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td><?php echo $prod['id']; ?></td>
                    <td><?php echo $prod['nome']; ?></td>
                    <td>R$ <?php echo number_format($prod['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $prod['id']; ?>" class="btn" style="padding: 5px 10px; font-size: 0.8rem;">Editar</a>
                        <a href="excluir.php?id=<?php echo $prod['id']; ?>" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>