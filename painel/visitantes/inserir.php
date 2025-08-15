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

// Recuperando dados de entrada
$nome = $_POST['nome'];
$documento = $_POST['documento'];
$tipo_documento = $_POST['tipo_documento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$empresa = $_POST['empresa'];
$motivo_visita = $_POST['motivo_visita'];
$pessoa_visitada = $_POST['pessoa_visitada'];
$departamento_visitado = $_POST['departamento_visitado'];
$observacoes = $_POST['observacoes'];
$id = $_POST['id'];

// Guardando dados antigos para comparar e evitar duplicidade
$antigo_documento = @$_POST['antigo_documento'];

// Verificando se documento já foi cadastrado 
if ($id == '' || ($antigo_documento != $documento)) {
    $consulta = $pdo->prepare("SELECT * FROM visitantes WHERE documento = :documento");
    $consulta->bindValue(":documento", $documento);
    $consulta->execute();

    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $total_registro = count($resultado);
    if ($total_registro > 0 && $id == '') {
        echo 'O documento do visitante já está cadastrado!';
        exit();
    }
}

if ($id == '') {
    // Inserção de novo visitante
    $inserir = $pdo->prepare("INSERT INTO visitantes SET nome = :nome, documento = :documento, tipo_documento = :tipo_documento, telefone = :telefone, email = :email, empresa = :empresa, motivo_visita = :motivo_visita, pessoa_visitada = :pessoa_visitada, departamento_visitado = :departamento_visitado, observacoes = :observacoes, data_entrada = NOW(), status = 'Ativo', usuario_cadastro = :usuario_cadastro");
    $inserir->bindValue(":nome", $nome);
    $inserir->bindValue(":documento", $documento);
    $inserir->bindValue(":tipo_documento", $tipo_documento);
    $inserir->bindValue(":telefone", $telefone);
    $inserir->bindValue(":email", $email);
    $inserir->bindValue(":empresa", $empresa);
    $inserir->bindValue(":motivo_visita", $motivo_visita);
    $inserir->bindValue(":pessoa_visitada", $pessoa_visitada);
    $inserir->bindValue(":departamento_visitado", $departamento_visitado);
    $inserir->bindValue(":observacoes", $observacoes);
    $inserir->bindValue(":usuario_cadastro", $nome_usu);
    $inserir->execute();

    echo "Salvo com Sucesso!"; 
} else {
    // Atualização de visitante existente
    $atualizar = $pdo->prepare("UPDATE visitantes SET nome = :nome, documento = :documento, tipo_documento = :tipo_documento, telefone = :telefone, email = :email, empresa = :empresa, motivo_visita = :motivo_visita, pessoa_visitada = :pessoa_visitada, departamento_visitado = :departamento_visitado, observacoes = :observacoes WHERE id = :id");
    $atualizar->bindValue(":nome", $nome);
    $atualizar->bindValue(":documento", $documento);
    $atualizar->bindValue(":tipo_documento", $tipo_documento);
    $atualizar->bindValue(":telefone", $telefone);
    $atualizar->bindValue(":email", $email);
    $atualizar->bindValue(":empresa", $empresa);
    $atualizar->bindValue(":motivo_visita", $motivo_visita);
    $atualizar->bindValue(":pessoa_visitada", $pessoa_visitada);
    $atualizar->bindValue(":departamento_visitado", $departamento_visitado);
    $atualizar->bindValue(":observacoes", $observacoes);
    $atualizar->bindValue(":id", $id);
    $atualizar->execute();

    echo 'Salvo com Sucesso!';
}
?>