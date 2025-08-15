<?php 

@session_start();
require_once('../../includes/conexao.php');
require_once('../verificar-permissao.php');

$autenticado = $_SESSION['autenticado'];

//Valida autorização para inserção
    if ($autenticado != 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf') {
        echo "<script>window.alert('Você não tem autorização!')</script>";
        echo "<script> window.location='../../logout.php'</script>";
    }

$senha_antiga = $_POST['senha_antiga'];
$senha_nova = $_POST['senha_nova'];
$con_senha = $_POST['con_senha'];

$nome_usu = $_SESSION['nome_usuario'];

$consultar = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$nome_usu'");
$res = $consultar->fetchAll(PDO::FETCH_ASSOC);
$senha = $res[0]['chave'];
$id = $res[0]['id'];

$senha_antiga = hash('sha512',$senha_antiga);
$senha_nova = hash('sha512',$senha_nova);
$con_senha = hash('sha512',$con_senha);

if ($senha_antiga != $senha) {
	echo "<script>window.alert('Senha Antiga inválida.')</script>";
	echo "<script>window.location='../index.php?pagina=alterar_senha'</script>";

}else if ($senha_nova != $con_senha) {
	echo "<script>window.alert('Senha Nova inválida. Atenção ao confirmar a senha!')</script>";
	echo "<script>window.location='../index.php?pagina=alterar_senha'</script>";

}else{
	$inserir = $pdo->prepare("UPDATE usuarios SET chave = :chave WHERE id = :id");
	$inserir->bindValue(":chave",$senha_nova);
	$inserir->bindValue(":id", $id);
	$inserir->execute();

	echo "<script>window.alert('Senha alterada com sucesso!')</script>";
	echo "<script>window.location='../index.php'</script>";

}

 ?>
