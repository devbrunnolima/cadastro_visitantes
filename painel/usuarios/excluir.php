<?php 
@session_start();
require_once("../../includes/conexao.php");
require_once('../verificar-permissao.php');

$autenticado = $_SESSION['autenticado'];

//Valida autorização para inserção
    if ($autenticado != 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf') {
        echo "<script>window.alert('Você não tem autorização!')</script>";
        echo "<script> window.location='../../logout.php'</script>";
    }

$id = $_POST['id'];

// Exclui o usuário
$consultar = $pdo->query("DELETE from usuarios WHERE id = $id");

echo "Excluído com sucesso!";
?>
