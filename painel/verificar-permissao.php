<?php
@session_start();
//VERIFICAR PERMISSÃO DE USUÁRIO
if(!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])){
    echo "<script language='javascript'>window.location='../index.php'</script>";
    exit();
}

// Verificar se o usuário tem permissão baseada no departamento
$departamentos_permitidos = ['Administração', 'Recepção', 'Segurança', 'Recursos Humanos'];
if(!in_array($_SESSION['departamento'], $departamentos_permitidos)){
    echo "<script language='javascript'>window.location='../index.php'</script>";
    exit();
}

?>