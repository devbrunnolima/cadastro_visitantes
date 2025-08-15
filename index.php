<?php
require_once("includes/conexao.php");
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="expires" content="-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Artistas Culturais</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/css/login.css">


    <link rel="icon" href="vendor/img/favicon-prefeitura-150x150.png" sizes="32x32" />
    <link rel="icon" href="vendor/img/favicon-prefeitura-300x300.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="vendor/img/logos/favicon-prefeitura-300x300.png" />


</head>

<body>
    <div class="login-card">
        <div class="logo-container text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-bounding-box logo-svg" viewBox="0 0 16 16">
                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            </svg>
            <h4>Sistema de Cadastro de Visitantes</h4>
            <p>Faça login para acessar seu perfil.</p>
        </div>
        <form action="includes/autenticar.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" name="usuario" class="form-control" id="floatingInput" placeholder="E-mail ou Usuário" required>
                <label for="floatingInput">E-mail ou Usuário</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Sua senha" required>
                <label for="floatingPassword">Sua senha</label>
            </div>
            <button type="submit" class="btn btn-culture-login">Entrar</button>
        </form>
        <a href="index.php" class="btn-link-back">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTFyflXQ+uFLkfmW7BqQoQvFzjrR5q/Ff1sLw5M3lG0tB8m+dGj/i" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlco4jFj+eN7GvsaacH8P0RjS0sU+zL3s5nJ7V4T2L5E6U" crossorigin="anonymous"></script>
</body>

</html>