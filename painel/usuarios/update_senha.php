<?php

@session_start();
require_once('../../conexao.php');
require_once('../verificar-permissao.php');

$autenticado = $_SESSION['autenticado'];

//Valida autorização para inserção
    if ($autenticado != 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf') {
        echo "<script>window.alert('Você não tem autorização!')</script>";
        echo "<script> window.location='../../logout.php'</script>";
    }

$nome_usu = $_SESSION['nome_usuario'];

$id = $_POST['id'];
$senha = $_POST['senha'];
$senha = hash("sha512",$senha);

$consultar = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$nome_usu'");
$res_usu = $consultar->fetchAll(PDO::FETCH_ASSOC);

$consultar = $pdo->query("SELECT * FROM usuarios WHERE id = '$id'");
$res = $consultar->fetchAll(PDO::FETCH_ASSOC);
// REMOVIDO: $nivel = $res[0]['nivel'];

// REMOVIDO: Verificação de nível
// if($nivel == "Administrador"){
//     echo "<script>window.alert('Apenas o administrador pode alterar senhas de diretores!')</script>";
//     echo "<script>window.location='../index.php?pagina=usuarios'</script>";
// }else{

// Atualização direta da senha
$atualizar = $pdo->prepare("UPDATE usuarios set chave = :chave WHERE id = :id");
$atualizar->bindValue(":chave", $senha);
$atualizar->bindValue(":id", $id);
$atualizar->execute();

echo "<script>window.alert('Senha alterada com sucesso!')</script>";
echo "<script>window.location='../index.php?pagina=usuarios'</script>";

?>