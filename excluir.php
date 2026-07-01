<?php
session_start();
include 'conexao.php';

if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produtos WHERE id = $id";
    mysqli_query($conexao, $sql);
}

header("Location: admin.php");
exit();
?>