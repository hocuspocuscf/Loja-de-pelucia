<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];
    $usuario_id = $_SESSION['id'];

    $sql_compra = "INSERT INTO compras (usuario_id, produto_id) VALUES ('$usuario_id', '$produto_id')";
    
    if (mysqli_query($conexao, $sql_compra)) {
        echo "<script>
                alert('Fofura adquirida com sucesso! Sua compra foi registrada.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Erro ao registrar a compra.";
    }
} else {
    header("Location: index.php");
}
?>