<?php 

@session_start();
require_once('../../includes/conexao.php');
require_once('../verificar-permissao.php');

$autenticado = $_SESSION['autenticado'];

//Valida autorização para finalização
if ($autenticado != 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf') {
    echo "<script>window.alert('Você não tem autorização!')</script>";
    echo "<script> window.location='../../logout.php'</script>";
}

$id = $_POST['id'];

// Verificar se o visitante existe e está ativo
$consultar = $pdo->prepare("SELECT * FROM visitantes WHERE id = :id AND status = 'Ativo'");
$consultar->bindValue(':id', $id);
$consultar->execute();
$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
$total_reg = count($resultado);

if ($total_reg > 0) {
    // Finalizar a visita
    $finalizar = $pdo->prepare("UPDATE visitantes SET status = 'Finalizado', data_saida = NOW() WHERE id = :id");
    $finalizar->bindValue(':id', $id);
    $finalizar->execute();
    
    echo "<script>window.alert('Visita finalizada com sucesso!')</script>";
    echo "<script>window.location='../index.php?pagina=visitantes'</script>";
} else {
    echo "<script>window.alert('Visitante não encontrado ou visita já finalizada!')</script>";
    echo "<script>window.location='../index.php?pagina=visitantes'</script>";
}

?>