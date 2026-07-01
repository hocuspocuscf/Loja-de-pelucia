<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'administrador') {
    die("Acesso negado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES ('$nome', '$descricao', '$preco', '$imagem')";
    if (mysqli_query($conexao, $sql)) {
        header("Location: admin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pelúcia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <h2 style="color: #d87093; margin-bottom: 20px;">Cadastrar Nova Pelúcia</h2>
        <form action="cadastrar.php" method="POST">
            <div class="form-group">
                <label>Nome do Produto</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Preço (Ex: 49.90)</label>
                <input type="number" step="0.01" name="preco" required>
            </div>
            <div class="form-group">
                <label>URL da Imagem</label>
                <input type="text" name="imagem" placeholder="http://..." required>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Salvar Produto</button>
        </form>
    </div>
</body>
</html>