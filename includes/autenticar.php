<?php
session_start();
require_once('conexao.php'); // Certifique-se de que este caminho está correto e que $pdo está disponível

// Entrada de dados
$usuario_input = $_POST['usuario']; // Pode ser email ou funcional
$senha_raw = $_POST['senha'];       // Senha bruta vinda do formulário

// Geração do hash SHA-512 da senha para comparação com AMBAS as tabelas
$senha_hashed_sha512 = hash('sha512', $senha_raw);

// Token CSRF (Recomendação de segurança: Este token deve ser gerado por sessão e validado em cada requisição)
$CSRF = 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf';

$loggedIn = false; // Flag para indicar se o login foi bem-sucedido

// --- Tentar autenticar na tabela 'usuarios' ---
// A consulta compara o hash SHA-512 diretamente e inclui todos os campos necessários
$consultaUsuarios = $pdo->prepare("SELECT id, usuario, nome, email, departamento, chave FROM usuarios WHERE (email = :usuario_input OR usuario = :usuario_input) AND senha = :senha_hashed");
$consultaUsuarios->bindValue(":usuario_input", $usuario_input);
$consultaUsuarios->bindValue(":senha_hashed", $senha_hashed_sha512);
$consultaUsuarios->execute();
$resultadoUsuario = $consultaUsuarios->fetch(PDO::FETCH_ASSOC);

if ($resultadoUsuario) {
    $loggedIn = true;
    $departamento = $resultadoUsuario['departamento'];

    // Configura variáveis de sessão para usuários do sistema
    $_SESSION['nome_usuario'] = $resultadoUsuario['nome'];
    $_SESSION['usuario'] = $resultadoUsuario['usuario'];
    $_SESSION['email'] = $resultadoUsuario['email'];
    $_SESSION['departamento'] = $departamento;
    $_SESSION['chave'] = $resultadoUsuario['chave'];
    $_SESSION['id_usuario'] = $resultadoUsuario['id'];
    $_SESSION['autenticado'] = $CSRF;

    // Redireciona para o painel único
    echo "<script>window.location='../painel/'</script>";
    exit();
}



// --- Se o login não foi bem-sucedido ---
if (!$loggedIn) {
    echo "<script>window.alert('Login inválido. Usuário ou senha incorreta')</script>";
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>