<?php
@session_start();
require_once("../includes/conexao.php");
require_once("verificar-permissao.php");

$nome_usu = $_SESSION['nome_usuario'];
$pag = 'usuarios';

?>

<main class="ml-1 mr-1">

	<div class="mx-5 mb-5 mt-5">
		
	</div>
	<div class="mb-2">
		<a href="index.php?pagina=<?php echo $pag ?>&funcao=novo" class="btn mx-2 mt-5 mb-4 text-white" style="background-color: #002c53;"><i class="bi bi-person-plus-fill"></i> Novo Usuario </a>
	</div>


	<!-- Fazendo consulta no banco de dados para preencher a tabela -->
	<?php

	$consultar = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
	$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
	$total = count($resultado);

	// Usar todos os usuários para exibição
	$res_usuarios = $resultado;

	?>
	<!-- Se houver registro, crie a tabela -->
	<!-- DataTables com pesquisa, filtros e paginação -->
	<div class="table-responsive px-2">

		<table id="tbl_usuarios" class="table table-striped" style="width:100%; border: 2px solid #dddddd;">
			<thead class="table-secondary" style="color: #004475;">
				<tr>
					<th>Usuário</th>
					<th>Nome</th>
					<th>Email</th>
					<th>Departamento</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($total > 0) { ?>
					<!-- Preenchendo a tabela com registro através do for -->
					


					

				
					<?php
					for ($i = 0; $i < $total; $i++) {
						foreach ($resultado[$i] as $key => $value) {
						}
						// for aberto para renderizar registro na tabela
					?>
						<tr>
							<td><?php echo $resultado[$i]['usuario'] ?></td>
							<td><?php echo $resultado[$i]['nome'] ?></td>
							<td><?php echo $resultado[$i]['email'] ?></td>
							<td><?php echo $resultado[$i]['departamento'] ?></td>
							<td>
								<a class="text-white" href="index.php?pagina=<?php echo $pag ?>&funcao=editar&id=<?php echo $resultado[$i]['id'] ?>" title="Editar">
									<button type="button" class="btn btn-sm " style="background-color: #c2c2c2;">
										<i class="bi bi-pencil-square" style="color: #004475"></i>
									</button>
								</a>

								<a class="text-white" href="index.php?pagina=<?php echo $pag ?>&funcao=excluir&id=<?php echo $resultado[$i]['id'] ?>&usuario=<?php echo $resultado[$i]['usuario'] ?>">
									<button type="button" class="btn btn-sm" style="background-color: #c2c2c2;">
										<i class="bi bi-trash" style="color: #004475"></i>
									</button>
								</a>

								<a class="text-white" href="index.php?pagina=<?php echo $pag ?>&funcao=alterar_senha&id=<?php echo $resultado[$i]['id'] ?>&usuario=<?php echo $resultado[$i]['usuario'] ?>" title="Alterar Senha">
									<button type="button" class="btn btn-sm" style="background-color: #c2c2c2;">
										<i class="bi bi-shield-lock-fill" style="color: #004475"></i>
									</button>
								</a>
							</td>
						</tr>

					<?php } ?>

				<?php } else {
					echo "<p>Nenhum registro encontrado!</p>";
				} ?>
			</tbody>
		</table>
	</div>


	<!-- Recuperando dados para função Editar-->
	<?php
	if (@$_GET['funcao'] == 'editar') {
		$titulo_modal = 'Editar Registro';

		// Recuperando os dados do usuário através do ID se a função for editar
		$consultar = $pdo->query("SELECT * FROM usuarios WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$usuario = $resultado[0]['usuario'];
			$nome = $resultado[0]['nome'];
			$email = $resultado[0]['email'];
			$departamento = $resultado[0]['departamento'];
			$senha = $resultado[0]['chave'];
			$id = $resultado[0]['id'];
		}
	} else {
		// Quando a função for novo 
		$titulo_modal = 'Cadastrar usuário';
	}


	if (@$_GET['funcao'] == 'alterar_senha') {

		// Recuperando os dados do usuário através do ID se a função for editar
		$consultar = $pdo->query("SELECT * FROM usuarios WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$id = $resultado[0]['id'];
			$nivel = $resultado[0]['nivel'];
		}
	}

	if (@$_GET['funcao'] == 'excluir') {

		// Recuperando os dados do usuário através do ID se a função for editar
		$consultar = $pdo->query("SELECT * FROM usuarios WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$usuario = $resultado[0]['usuario'];
			$id = $resultado[0]['id'];
		}
	}
	?>
	<!-- FIM TABELA -->

	<!-- Modal Cadastrar Usuário -->
	<div class="modal fade" id="modalCadastrarUsuario" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo $titulo_modal ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">
					</button>
				</div>
				<div class="modal-body">
					<!-- INICIO DO FORMULÁRIO -->
					<form id="form-cadastrar" method="POST">

						<div class="form-group mt-3">
							<label>
								<h6>Usuário:</h6>
							</label>
							<input size=150 maxlength=150 type="text" class="form-control" name="usuario" placeholder="Usuário" value="<?php echo @$usuario ?>" required="">
						</div>

						<div class="form-group mt-3">
							<label>
								<h6>Nome:</h6>
							</label>
							<input size=150 maxlength=150 type="text" class="form-control" name="nome" placeholder="Nome Completo" value="<?php echo @$nome ?>" required="">
						</div>

						<div class="form-group mt-3">
							<label>
								<h6>E-mail:</h6>
							</label>
							<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo @$email ?>" required="">
						</div>

						<div class="form-group mt-3">
						<label>
							<h6>Departamento:</h6>
						</label>
						<select class="form-select" name="departamento" required="">
							<option class="text-muted" value="">Selecione o departamento</option>
							<option <?php if (@$departamento == 'Administração') { ?> selected <?php } ?> value="Administração">Administração</option>
							<option <?php if (@$departamento == 'Recepção') { ?> selected <?php } ?> value="Recepção">Recepção</option>
							<option <?php if (@$departamento == 'Segurança') { ?> selected <?php } ?> value="Segurança">Segurança</option>
							<option <?php if (@$departamento == 'Recursos Humanos') { ?> selected <?php } ?> value="Recursos Humanos">Recursos Humanos</option>
						</select>
					</div>


						<div class="row mt-3">
							<div class="form-group mb-3">
								<label>
									<h6>Senha:</h6>
								</label>
								<input type="password" class="form-control" name="senha" placeholder="Senha" value="" required="">
							</div>
						</div>
						<!-- Mensagem via AJAX para notificações -->
						<small>
							<div align="center" class="mt-1" id="mensagem">

							</div>
						</small>

						<div class="modal-footer">
							<button id="btn-fechar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
							<button id="btn-salvar" type="submit" class="btn  btn-success">Salvar</button>
						</div>

						<!-- Campo oculto para passar o ID na função editar -->
						<input type="hidden" name="id" value=<?php echo @$id ?>>

						<!-- Email e Departamento recuperados (antigos) usado na função editar -->
						<input type="hidden" name="antigo_email" value="<?php echo @$email ?>">
						<input type="hidden" name="antigo_departamento" value="<?php echo @$departamento ?>">
						<input type="hidden" name="antiga_senha" value="<?php echo @$senha ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL ALTERAR SENHA -->
	<div class="modal fade" id="modalAlterarSenha" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Alterar Senha</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<!-- INICIO DO FORMULÁRIO -->
					<form method="POST" action="usuarios/update_senha.php">

						<div class="form-group mt-2 mb-3">
							<label>
								<h6>Nova Senha:</h6>
							</label>
							<input type="password" class="form-control" name="senha" placeholder="Senha" value="" required="">
						</div>

						<!-- Mensagem via AJAX para notificações -->
						<small>
							<div align="center" id="mensagem"></div>
						</small>

						<div class="modal-footer">
							<button id="btn-fechar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
							<button id="btn-salvar" type="submit" class="btn btn-success">Salvar</button>
						</div>

						<!-- Campo oculto para passar o ID na função editar -->
						<input type="hidden" name="id" value="<?php echo @$id ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Editar Usuário - CORRIGIDO -->
	<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title"><?php echo $titulo_modal ?></h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	            </div>
	            <div class="modal-body">
	                <form id="form-editar" method="POST">
	                    <div class="form-group mt-3">
	                        <label><h6>Usuário:</h6></label>
	                        <input type="text" class="form-control" name="usuario" value="<?php echo @$usuario ?>" required>
	                    </div>
	                    
	                    <div class="form-group mt-3">
	                        <label><h6>Nome:</h6></label>
	                        <input type="text" class="form-control" name="nome" value="<?php echo @$nome ?>" required>
	                    </div>
	                    
	                    <div class="form-group mt-3">
	                        <label><h6>E-mail:</h6></label>
	                        <input type="email" class="form-control" name="email" value="<?php echo @$email ?>" required>
	                    </div>
	                    
	                    <div class="form-group mt-3">
	                        <label><h6>Departamento:</h6></label>
	                        <select class="form-select" name="departamento" required>
	                            <option value="">Selecione o departamento</option>
	                            <option <?php if (@$departamento == 'Administração') { ?> selected <?php } ?> value="Administração">Administração</option>
	                            <option <?php if (@$departamento == 'Recepção') { ?> selected <?php } ?> value="Recepção">Recepção</option>
	                            <option <?php if (@$departamento == 'Segurança') { ?> selected <?php } ?> value="Segurança">Segurança</option>
	                            <option <?php if (@$departamento == 'Recursos Humanos') { ?> selected <?php } ?> value="Recursos Humanos">Recursos Humanos</option>
	                        </select>
	                    </div>
	                    
	                    <div class="form-group mt-3">
	                        <label><h6>Senha:</h6></label>
	                        <input type="password" class="form-control" name="senha" placeholder="Nova senha (deixe em branco para manter a atual)">
	                    </div>
	                    
	                    <small><div align="center" id="mensagem"></div></small>
	                    
	                    <div class="modal-footer">
	                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
	                        <button type="submit" class="btn btn-success">Salvar</button>
	                    </div>
	                    
	                    <!-- Campos ocultos -->
	                    <input type="hidden" name="id" value="<?php echo @$id ?>">
	                    <input type="hidden" name="antigo_email" value="<?php echo @$email ?>">
	                    <input type="hidden" name="antiga_senha" value="<?php echo @$senha ?>">
	                    <input type="hidden" name="antigo_departamento" value="<?php echo @$departamento ?>">
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- MODAL EXCLUIR USUÁRIO -->
	<div class="modal fade" id="modalExcluirUsuario" tabindex="-1">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Excluir Registro</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <form method="POST" id="form-excluir">
	                <div class="modal-body">
	                    <h6 class="text-center mt-3">Deseja realmente excluir os registro de <b><?php echo @$usuario ?></b>?</h6>

	                    <small>
	                        <div align="center" class="mt-1" id="mensagem-excluir"></div>
	                    </small>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
	                    <button name="btn-excluir" id="btn-excluir" type="submit" class="btn btn-danger">Excluir</button>

	                    <input name="id" type="hidden" value="<?php echo @$_GET['id'] ?>">
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</main>

<!-- Inicio Funções  -->
<?php
if (@$_GET['funcao'] == "novo") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalCadastrarUsuario'), {
            backdrop: 'static'
        })
        myModal.show();
    </script>
<?php } ?>

<?php
if (@$_GET['funcao'] == "editar") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'), {
            backdrop: 'static'
        })
        myModal.show();
    </script>
<?php } ?>

<?php
if (@$_GET['funcao'] == "alterar_senha") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalAlterarSenha'), {
            backdrop: 'static'
        })
        myModal.show();
    </script>
<?php } ?>

<?php
if (@$_GET['funcao'] == "excluir") { ?>
    <script type="text/javascript">
        var myModal = new bootstrap.Modal(document.getElementById('modalExcluirUsuario'), {})
        myModal.show();
    </script>
<?php } ?>

<!-- INICIO AJAX -->
<!--AJAX PARA INSERÇÃO DOS USUÁRIOS -->
<script type="text/javascript">
    $("#form-cadastrar").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,
            success: function(mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;
                } else {
                    $('#mensagem').addClass('text-danger')
                }
                $('#mensagem').text(mensagem)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>

<!--AJAX PARA EDIÇÃO DOS USUÁRIOS -->
<script type="text/javascript">
    $("#form-editar").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,
            success: function(mensagem) {
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#btn-fechar').click();
                    window.location = "index.php?pagina=" + pag;
                } else {
                    $('#mensagem').addClass('text-danger')
                }
                $('#mensagem').text(mensagem)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>

<!--AJAX PARA EXCLUSÃO DE REGISTRO -->
<script type="text/javascript">
	$("#form-excluir").submit(function() {
		//Atribuindo uma variável php numa variável javascript
		var pag = "<?= $pag ?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/excluir.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {

				$('#mensagem-excluir').removeClass()

				if (mensagem.trim() == "Excluído com sucesso!") {

					//$('#usuario').val('');
					//$('#cpf').val('');
					$('#btn-fechar-excluir').click();
					window.location = "index.php?pagina=" + pag;

				} else if (mensagem.trim() == "Chave de Segurança inválida!") {

					//$('#usuario').val('');
					//$('#cpf').val('');
					$('#btn-fechar-excluir').click();
					window.location = "index.php?pagina=" + pag;

				} else {

					$('#mensagem-excluir').addClass('text-danger')
				}

				$('#mensagem-excluir').text(mensagem)

			},

			cache: false,
			contentType: false,
			processData: false,
			xhr: function() { // Custom XMLHttpRequest
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
					myXhr.upload.addEventListener('progress', function() {
						/* faz alguma coisa durante o progresso do upload */
					}, false);
				}
				return myXhr;
			}
		});
	});
</script>

<!-- Script para componentes DataTables -->
<script>
    $(document).ready(function() {
        $('#tbl_usuarios').DataTable({
            "ordering": false
        });
    });
</script>