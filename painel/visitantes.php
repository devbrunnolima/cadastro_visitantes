<?php
@session_start();
require_once("../includes/conexao.php");
require_once("verificar-permissao.php");

$nome_usu = $_SESSION['nome_usuario'];
$pag = 'visitantes';

?>

<main class="ml-1 mr-1">

	<div class="mx-5 mb-5 mt-5">
		
	</div>
	<div class="mb-2">
		<button class="btn mx-2 mt-5 mb-4 text-white" style="background-color: #002c53;" data-bs-toggle="modal" data-bs-target="#modalCadastrarVisitante" onclick="limparCampos()"><i class="bi bi-person-plus-fill"></i> Novo Visitante</button>
	</div>


	<!-- Fazendo consulta no banco de dados para preencher a tabela -->
	<?php

	$consultar = $pdo->query("SELECT * FROM visitantes ORDER BY id DESC");
	$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
	$total = count($resultado);

	?>
	<!-- Se houver registro, crie a tabela -->
	<!-- DataTables com pesquisa, filtros e paginação -->
	<div class="table-responsive px-2">

		<table id="tbl_visitantes" class="table table-striped" style="width:100%; border: 2px solid #dddddd;">
			<thead class="table-secondary" style="color: #004475;">
				<tr>
					<th>Nome</th>
					<th>Documento</th>
					<th>Empresa</th>
					<th>Pessoa Visitada</th>
					<th>Departamento</th>
					<th>Data Entrada</th>
					<th>Status</th>
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
							<td><?php echo $resultado[$i]['nome'] ?></td>
							<td><?php echo $resultado[$i]['documento'] ?></td>
							<td><?php echo $resultado[$i]['empresa'] ?></td>
							<td><?php echo $resultado[$i]['pessoa_visitada'] ?></td>
							<td><?php echo $resultado[$i]['departamento_visitado'] ?></td>
							<td><?php echo date('d/m/Y H:i', strtotime($resultado[$i]['data_entrada'])) ?></td>
							<td>
								<?php if($resultado[$i]['status'] == 'Ativo') { ?>
									<span class="badge bg-success">Ativo</span>
								<?php } else { ?>
									<span class="badge bg-secondary">Finalizado</span>
								<?php } ?>
							</td>
							
                     <td>
                            <button type="button" class="btn btn-sm" style="background-color: #c2c2c2;" data-bs-toggle="modal" data-bs-target="#modalCadastrarVisitante" onclick="editarVisitante('<?php echo $resultado[$i]['id'] ?>', '<?php echo $resultado[$i]['nome'] ?>', '<?php echo $resultado[$i]['documento'] ?>', '<?php echo $resultado[$i]['tipo_documento'] ?>', '<?php echo $resultado[$i]['telefone'] ?>', '<?php echo $resultado[$i]['email'] ?>', '<?php echo $resultado[$i]['empresa'] ?>', '<?php echo $resultado[$i]['motivo_visita'] ?>', '<?php echo $resultado[$i]['pessoa_visitada'] ?>', '<?php echo $resultado[$i]['departamento_visitado'] ?>', '<?php echo $resultado[$i]['observacoes'] ?>')" title="Editar">
                                <i class="bi bi-pencil-square" style="color: #004475"></i>
                            </button>
                        
                            <?php if($resultado[$i]['status'] == 'Ativo') { ?>
                            <button type="button" class="btn btn-sm" style="background-color: #28a745;" data-bs-toggle="modal" data-bs-target="#modalFinalizarVisita" onclick="finalizarVisita('<?php echo $resultado[$i]['id'] ?>', '<?php echo $resultado[$i]['nome'] ?>')" title="Finalizar Visita">
                                <i class="bi bi-check-circle" style="color: white"></i>
                            </button>
                            <?php } ?>
                        
                            <button type="button" class="btn btn-sm" style="background-color: #c2c2c2;" data-bs-toggle="modal" data-bs-target="#modalExcluirVisitante" onclick="excluirVisitante('<?php echo $resultado[$i]['id'] ?>', '<?php echo $resultado[$i]['nome'] ?>')" title="Excluir">
                                <i class="bi bi-trash" style="color: #004475"></i>
                            </button>
                        </td>
						</tr>
					<?php } ?>
				<?php } else { ?>
					<tr>
						<td colspan="8" class="text-center">Nenhum visitante cadastrado</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php
	// Definindo variáveis para os modais
	if (@$_GET['funcao'] == 'novo') {
		$titulo_modal = 'Cadastrar Visitante';
	}

	if (@$_GET['funcao'] == 'editar') {
		$titulo_modal = 'Editar Visitante';

		// Recuperando os dados do visitante através do ID se a função for editar
		$consultar = $pdo->query("SELECT * FROM visitantes WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$nome = $resultado[0]['nome'];
			$documento = $resultado[0]['documento'];
			$tipo_documento = $resultado[0]['tipo_documento'];
			$telefone = $resultado[0]['telefone'];
			$email = $resultado[0]['email'];
			$empresa = $resultado[0]['empresa'];
			$motivo_visita = $resultado[0]['motivo_visita'];
			$pessoa_visitada = $resultado[0]['pessoa_visitada'];
			$departamento_visitado = $resultado[0]['departamento_visitado'];
			$observacoes = $resultado[0]['observacoes'];
			$id = $resultado[0]['id'];
		}
	}

	if (@$_GET['funcao'] == 'excluir') {
		// Recuperando os dados do visitante através do ID se a função for excluir
		$consultar = $pdo->query("SELECT * FROM visitantes WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$nome = $resultado[0]['nome'];
			$id = $resultado[0]['id'];
		}
	}

	if (@$_GET['funcao'] == 'finalizar') {
		// Recuperando os dados do visitante através do ID se a função for finalizar
		$consultar = $pdo->query("SELECT * FROM visitantes WHERE id = $_GET[id]");
		$resultado = $consultar->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($resultado);
		if ($total_reg > 0) {
			$nome = $resultado[0]['nome'];
			$id = $resultado[0]['id'];
		}
	}
	?>

	<!-- Modal Cadastrar/Editar Visitante -->
	<div class="modal fade" id="modalCadastrarVisitante" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo @$titulo_modal ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">
					</button>
				</div>
				<div class="modal-body">
					<!-- INICIO DO FORMULÁRIO -->
					<form id="form-cadastrar-visitante" method="POST">

						<div class="row">
							<div class="form-group col-md-6 mt-3">
								<label>
									<h6>Nome Completo:</h6>
								</label>
								<input type="text" class="form-control" name="nome" placeholder="Nome Completo" value="<?php echo @$nome ?>" required="">
							</div>

							<div class="form-group col-md-3 mt-3">
								<label>
									<h6>Tipo Documento:</h6>
								</label>
								<select class="form-select" name="tipo_documento" required="">
									<option value="CPF" <?php if (@$tipo_documento == 'CPF') { ?> selected <?php } ?>>CPF</option>
									<option value="RG" <?php if (@$tipo_documento == 'RG') { ?> selected <?php } ?>>RG</option>
									<option value="CNH" <?php if (@$tipo_documento == 'CNH') { ?> selected <?php } ?>>CNH</option>
									<option value="Passaporte" <?php if (@$tipo_documento == 'Passaporte') { ?> selected <?php } ?>>Passaporte</option>
								</select>
							</div>

							<div class="form-group col-md-3 mt-3">
								<label>
									<h6>Documento:</h6>
								</label>
								<input type="text" class="form-control" name="documento" placeholder="Número do documento" value="<?php echo @$documento ?>" required="">
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-6 mt-3">
								<label>
									<h6>Telefone:</h6>
								</label>
								<input type="text" class="form-control" name="telefone" placeholder="(11) 99999-9999" value="<?php echo @$telefone ?>">
							</div>

							<div class="form-group col-md-6 mt-3">
								<label>
									<h6>E-mail:</h6>
								</label>
								<input type="email" class="form-control" name="email" placeholder="email@exemplo.com" value="<?php echo @$email ?>">
							</div>
						</div>

						<div class="form-group mt-3">
							<label>
								<h6>Empresa:</h6>
							</label>
							<input type="text" class="form-control" name="empresa" placeholder="Nome da empresa" value="<?php echo @$empresa ?>">
						</div>

						<div class="row">
							<div class="form-group col-md-6 mt-3">
								<label>
									<h6>Pessoa Visitada:</h6>
								</label>
								<input type="text" class="form-control" name="pessoa_visitada" placeholder="Nome da pessoa" value="<?php echo @$pessoa_visitada ?>" required="">
							</div>

							<div class="form-group col-md-6 mt-3">
								<label>
									<h6>Departamento Visitado:</h6>
								</label>
								<select class="form-select" name="departamento_visitado" required="">
									<option value="">Selecione o departamento</option>
									<option value="Administração" <?php if (@$departamento_visitado == 'Administração') { ?> selected <?php } ?>>Administração</option>
									<option value="Recepção" <?php if (@$departamento_visitado == 'Recepção') { ?> selected <?php } ?>>Recepção</option>
									<option value="Segurança" <?php if (@$departamento_visitado == 'Segurança') { ?> selected <?php } ?>>Segurança</option>
									<option value="Recursos Humanos" <?php if (@$departamento_visitado == 'Recursos Humanos') { ?> selected <?php } ?>>Recursos Humanos</option>
									<option value="Financeiro" <?php if (@$departamento_visitado == 'Financeiro') { ?> selected <?php } ?>>Financeiro</option>
									<option value="Vendas" <?php if (@$departamento_visitado == 'Vendas') { ?> selected <?php } ?>>Vendas</option>
									<option value="Marketing" <?php if (@$departamento_visitado == 'Marketing') { ?> selected <?php } ?>>Marketing</option>
								</select>
							</div>
						</div>

						<div class="form-group mt-3">
							<label>
								<h6>Motivo da Visita:</h6>
							</label>
							<textarea class="form-control" name="motivo_visita" rows="3" placeholder="Descreva o motivo da visita" required=""><?php echo @$motivo_visita ?></textarea>
						</div>

						<div class="form-group mt-3">
							<label>
								<h6>Observações:</h6>
							</label>
							<textarea class="form-control" name="observacoes" rows="2" placeholder="Observações adicionais"><?php echo @$observacoes ?></textarea>
						</div>

						<!-- Mensagem via AJAX para notificações -->
						<small>
							<div align="center" class="mt-1" id="mensagem-visitante">

							</div>
						</small>

						<div class="modal-footer">
							<button id="btn-fechar-visitante" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
							<button id="btn-salvar-visitante" type="submit" class="btn btn-success">Salvar</button>
						</div>

						<!-- Campo oculto para passar o ID na função editar -->
						<input type="hidden" name="id" value="<?php echo @$id ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

</main>

<!-- Scripts para os modais -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_visitantes').DataTable({
            "ordering": false,
            "stateSave": true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
            }
        });
    });

    function limparCampos() {
        $('#form-cadastrar-visitante')[0].reset();
        $('.modal-title').text('Cadastrar Visitante');
    }

    function editarVisitante(id, nome, documento, tipo_documento, telefone, email, empresa, motivo_visita, pessoa_visitada, departamento_visitado, observacoes) {
        $('#form-cadastrar-visitante input[name="id"]').val(id);
        $('#form-cadastrar-visitante input[name="nome"]').val(nome);
        $('#form-cadastrar-visitante input[name="documento"]').val(documento);
        $('#form-cadastrar-visitante select[name="tipo_documento"]').val(tipo_documento);
        $('#form-cadastrar-visitante input[name="telefone"]').val(telefone);
        $('#form-cadastrar-visitante input[name="email"]').val(email);
        $('#form-cadastrar-visitante input[name="empresa"]').val(empresa);
        $('#form-cadastrar-visitante textarea[name="motivo_visita"]').val(motivo_visita);
        $('#form-cadastrar-visitante input[name="pessoa_visitada"]').val(pessoa_visitada);
        $('#form-cadastrar-visitante select[name="departamento_visitado"]').val(departamento_visitado);
        $('#form-cadastrar-visitante textarea[name="observacoes"]').val(observacoes);
        $('.modal-title').text('Editar Visitante');
    }

    function excluirVisitante(id, nome) {
        $('#modalExcluirVisitante input[name="id"]').val(id);
        $('#modalExcluirVisitante b').text(nome);
    }

    function finalizarVisita(id, nome) {
        $('#modalFinalizarVisita input[name="id"]').val(id);
        $('#modalFinalizarVisita b').text(nome);
    }

    // AJAX para cadastro/edição de visitantes
    $("#form-cadastrar-visitante").submit(function() {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "visitantes/inserir.php",
            type: 'POST',
            data: formData,
            success: function(mensagem) {
                $('#mensagem-visitante').text('');
                $('#mensagem-visitante').removeClass();
                if (mensagem.trim() == "Salvo com Sucesso!") {
                    $('#btn-fechar-visitante').click();
                    window.location = "index.php?pagina=visitantes";
                } else {
                    $('#mensagem-visitante').addClass('text-danger');
                    $('#mensagem-visitante').text(mensagem);
                }
            },
            cache: false,
            contentType: false,
            processData: false,
        });
    });
</script>

<!-- Modal Excluir Visitante -->
<div class="modal fade" id="modalExcluirVisitante" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Excluir Visitante</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Deseja realmente excluir o visitante <b><?php echo @$nome ?></b>?</p>
				<small><div align="center" id="mensagem-excluir"></div></small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				<form method="post" action="visitantes/excluir.php">
					<input type="hidden" name="id" value="<?php echo @$id ?>">
					<button type="submit" class="btn btn-danger">Excluir</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Finalizar Visita -->
<div class="modal fade" id="modalFinalizarVisita" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Finalizar Visita</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Deseja finalizar a visita de <b><?php echo @$nome ?></b>?</p>
				<small><div align="center" id="mensagem-finalizar"></div></small>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
				<form method="post" action="visitantes/finalizar.php">
					<input type="hidden" name="id" value="<?php echo @$id ?>">
					<button type="submit" class="btn btn-success">Finalizar</button>
				</form>
			</div>
		</div>
	</div>
</div>
