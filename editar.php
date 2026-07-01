<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'administrador') {
    die("Acesso negado.");
}

$id = $_GET['id'];
$sql_busca = "SELECT * FROM produtos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql_busca);
$prod = mysqli_fetch_assoc($resultado);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $sql_update = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', imagem='$imagem' WHERE id = $id";
    if (mysqli_query($conexao, $sql_update)) {
        header("Location: admin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pelúcia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <h2 style="color: #d87093; margin-bottom: 20px;">Editar Pelúcia</h2>
        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="<?php echo $prod['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" rows="3" required><?php echo $prod['descricao']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Preço</label>
                <input type="number" step="0.01" name="preco" value="<?php echo $prod['preco']; ?>" required>
            </div>
            <div class="form-group">
                <label>URL da Imagem</label>
                <input type="text" name="imagem" value="<?php echo $prod['imagem']; ?>" required>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Atualizar Produto</button>
        </form>
    </div>
</body>
</html>