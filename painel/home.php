<?php

@session_start();
require_once('../includes/conexao.php');
require_once("verificar-permissao.php");

// Contadores para o dashboard
$query_usuarios = $pdo->query("SELECT COUNT(*) FROM usuarios");
$total_usuarios = $query_usuarios->fetchColumn();

$query_visitantes = $pdo->query("SELECT COUNT(*) FROM visitantes");
$total_visitantes = $query_visitantes->fetchColumn();

$query_visitantes_ativos = $pdo->query("SELECT COUNT(*) FROM visitantes WHERE status = 'Ativo'");
$total_visitantes_ativos = $query_visitantes_ativos->fetchColumn();

?>
<main>

    <div class="container mt-5">
        <b>
            <h4 class="mt-4 mb-5 text-detalhes">Dashboard <span class="d-none d-md-inline"> - Sistema de Gerenciamento</span></h4>
        </b>

        <div class="row">
            <div class="col-md-4 Dashboard">
                <div class="card mt-5 cartao">
                    <a class="text-decoration-none" href="index.php?pagina=usuarios">
                        <div class="card-body">
                            <div class="row align-items-center ">
                                <div class="col">
                                    <i class="bi bi-people mx-5 mt-3" style="font-size: 50px"></i>
                                </div>
                                <div class="col">
                                    <h1 class="text-center"><?php echo $total_usuarios ?></h1>
                                    <h5 class="text-center">Usuários</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 Dashboard">
                <div class="card mt-5 cartao">
                    <a class="text-decoration-none" href="index.php?pagina=visitantes">
                        <div class="card-body">
                            <div class="row align-items-center ">
                                <div class="col">
                                    <i class="bi bi-person-badge mx-5 mt-3" style="font-size: 50px"></i>
                                </div>
                                <div class="col">
                                    <h1 class="text-center"><?php echo $total_visitantes ?></h1>
                                    <h5 class="text-center">Visitantes</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 Dashboard">
                <div class="card mt-5 cartao">
                    <a class="text-decoration-none" href="index.php?pagina=visitantes">
                        <div class="card-body">
                            <div class="row align-items-center mt-2 mb-1">
                                <div class="col">
                                    <i class="bi bi-person-check mx-5 mt-3" style="font-size: 50px"></i>
                                </div>
                                <div class="col">
                                    <h1 class="text-center"><?php echo $total_visitantes_ativos ?></h1>
                                    <h5 class="text-center">Visitas Ativas</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 Dashboard">
                <div class="card mt-5 cartao" style="visibility: hidden;">
                    <div class="card-body">
                        <div class="row align-items-center mt-2 mb-1">
                                <div class="col">
                                    <i class="bi bi-exclamation-triangle-fill mx-5 mt-3" style="font-size: 50px"></i>
                                </div>
                                <div class="col">
                                    <h1 class="text-center"><?php echo $total_denuncias ?></h1>
                                    <h5 class="text-center">Denúncias</h5>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>