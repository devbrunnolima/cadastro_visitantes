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

$nome_usu = $_SESSION['nome_usuario'];
$consultar = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$nome_usu'");
$res_usu = $consultar->fetchAll(PDO::FETCH_ASSOC);

// Recuperando dados de entrada
$usuario = $_POST['usuario'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$departamento = $_POST['departamento'];
$senha = $_POST['senha'];
$id = $_POST['id'];

// Guardando dados antigos para comparar e evitar duplicidade
$antigo_email = $_POST['antigo_email'];
$antigo_departamento = $_POST['antigo_departamento'];
$antiga_senha = $_POST['antiga_senha'];

// Verificando se e-mail já foi cadastrado 
if ($antigo_email != $email) {
    $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $consulta->bindValue(":email", $email);
    $consulta->execute();

    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $total_registro = count($resultado);
    if ($total_registro > 0) {
        echo 'O email do usuário já está cadastrado!';
        exit();
    }
}

// Verificando se usuário já foi cadastrado
if ($id == '') {
    $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $consulta->bindValue(":usuario", $usuario);
    $consulta->execute();

    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $total_registro = count($resultado);
    if ($total_registro > 0) {
        echo 'O usuário já está cadastrado!';
        exit();
    }
}

if ($id == '') {
    // Inserção de novo usuário
    $inserir = $pdo->prepare("INSERT INTO usuarios SET usuario = :usuario, nome = :nome, email = :email, departamento = :departamento, chave = :chave");
    $inserir->bindValue(":usuario", $usuario);
    $inserir->bindValue(":nome", $nome);
    $inserir->bindValue(":email", $email);
    $inserir->bindValue(":departamento", $departamento);
    $inserir->bindValue(":chave", hash('sha512',$senha));
    $inserir->execute();

    echo "Salvo com Sucesso!"; 
} else {
    // Atualização de usuário existente
    if ($antiga_senha != $senha) {
        $senha = hash('sha512',$senha);
    } else {
        $senha = $antiga_senha;
    }
    
    $atualizar = $pdo->prepare("UPDATE usuarios SET usuario = :usuario, nome = :nome, email = :email, departamento = :departamento, chave = :chave WHERE id = :id");
    $atualizar->bindValue(":usuario", $usuario);
    $atualizar->bindValue(":nome", $nome);
    $atualizar->bindValue(":email", $email);
    $atualizar->bindValue(":departamento", $departamento);
    $atualizar->bindValue(":chave", $senha);
    $atualizar->bindValue(":id", $id);
    $atualizar->execute();

    echo 'Salvo com Sucesso!';
}
?>