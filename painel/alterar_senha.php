<?php
@session_start();
require_once('../includes/conexao.php');
require_once('verificar-permissao.php');

$autenticado = $_SESSION['autenticado'];

//Valida autorização para inserção
    if ($autenticado != 'ce3be15a5ea2d583662661472f1104edcd7b86f2a1ebafa9dc79155a5f58bf8c042f10995624319fed94d1017acb380d5d574f2b67f34198618d0998e3c117bf') {
        echo "<script>window.alert('Você não tem autorização!')</script>";
        echo "<script> window.location='../logout.php'</script>";
    }

$pag = 'alterar_senha';
$nome_usu = $_SESSION['nome_usuario'];

$consultar = $pdo->query("SELECT * FROM usuarios WHERE usuario = '$nome_usu'");
$res_usu = $consultar->fetchAll(PDO::FETCH_ASSOC);
$total_usu = count($res_usu);

$usuario = $res_usu[0]['usuario'];
$nome = $res_usu[0]['nome'];
$departamento = $res_usu[0]['departamento'];
$email = $res_usu[0]['email'];


 ?>

 <div class="container mt-5">
    	<b><h4 class="mt-4 mb-5 text-detalhes">Alterar Senha <span class="text-muted">| Geral</span></h4></b>
	</div>

<div class="container-fluid">
	<div class="container" style="border: 2px solid #dddddd; background-color: #f1f1f1; border-radius: 5px;">
		<div class="row">
			<div class="col-7">
				<div class="mt-3">
					<h6>Usuário: <?php echo $usuario ?></h6>
					<h6>Nome: <?php echo $nome ?></h6>
					<h6>Departamento: <?php echo $departamento ?></h6>
					<h6>Email: <?php echo $email ?></h6>
				</div>

				<div class="mt-5">
					<form method="POST" action="alterar-senha/update_senha.php">
						<div class="form-group col-9">
							<label><h6>Senha Antiga:</h6></label>
							<input type="password" name="senha_antiga" class="form-control" value="" required>
						</div>

						<div class="form-group col-9 mt-3">
							<label><h6>Nova Senha:</h6></label>
							<input type="password" name="senha_nova" class="form-control" value="" required>
						</div>

						<div class="form-group col-9 mt-3">
							<label><h6>Confirmar Senha:</h6></label>
							<input type="password" name="con_senha" class="form-control" value="" required>
						</div>

						<div class="mt-3 mb-3">
							<a href="index.php?pagina=home" type="button" class="btn btn-secondary">Fechar</a>
							<button id="btn-salvar" type="submit" class="btn text-white" style="background-color: #002c53;">Salvar Alterações</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-5 text-white" style="background-color: #002c53; border-radius: 5px">
				<div class="text-center mt-3">
					<h5>Informação</h5>
				</div>
				<p>Para quaisquer dúvidas em relação aos seus dados (Usuário, Funcional e Email) ou qualquer problema em relação à troca de senha e mal funcionamento do sistema, abrir uma Ordem de Serviço (O.S) para a Central de Processamento de Dados (CPD). Caso não consiga, entrar em contato com o Controle de Acesso.</p>
				<ul>
					<li><h6>Sistema de Ordem de Serviço: <a href="http://suporte.ts.sp.gov.br/">http://suporte.ts.sp.gov.br</a></h6></li>
					<li><h6>Controle de Acesso <i class="bi bi-arrow-right-short"></i> (11) 4788-5307 <i class="bi bi-telephone-fill"></i></h6></li>
				</ul>
			</div>
		</div>
	</div>
</div>