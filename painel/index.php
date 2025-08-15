<?php

@session_start();
require_once("../includes/conexao.php");
require_once("verificar-permissao.php");
$_SESSION['nome_usuario'];

// Nome das páginas
$menu_home = 'home';
$menu_usuarios = 'usuarios';
$alterar_senha = 'alterar_senha';
$menu_visitantes = 'visitantes';


//RECUPERAR DADOS DO USUÁRIO
$query = $pdo->prepare("SELECT * from usuarios WHERE id = :id");
$query->bindValue(':id', $_SESSION['id_usuario']);
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usu = $res[0]['usuario'];
$email_usu = $res[0]['email'];
$senha_usu = $res[0]['chave'];
$departamento_usu = $res[0]['departamento'];
$id_usu = $res[0]['id'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- DataTables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #002c53;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Painel Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?pagina=<?php echo $menu_home ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?pagina=<?php echo $menu_usuarios ?>">Usuários</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="index.php?pagina=<?php echo $menu_visitantes ?>">Visitantes</a>
            </li>
          </ul>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $nome_usu ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalPerfil">Editar Perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../includes/logout.php">Sair</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container-fluid mt-5 pt-4">
    <?php
    if (@$_GET['pagina'] == $menu_home) {
      include_once($menu_home . ".php");
    } else if (@$_GET['pagina'] == $menu_usuarios) {
      include_once($menu_usuarios . ".php");
    } else if (@$_GET['pagina'] == $menu_visitantes) {
      include_once($menu_visitantes . ".php");
    } else if (@$_GET['pagina'] == $alterar_senha) {
      include_once($alterar_senha . ".php");
    } else {
      include_once($menu_home . ".php");
    }
    ?>
  </main>

  <div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form-perfil" method="post">
          <div class="modal-body">
            <div class="mb-3">
              <label for="usuario-perfil" class="form-label">Usuário</label>
              <input type="text" class="form-control" id="usuario-perfil" name="usuario-perfil" placeholder="Nome do Usuário" required="" value="<?php echo @$nome_usu ?>">
            </div>

            <div class="mb-3">
              <label for="email-perfil" class="form-label">Email</label>
              <input type="email" class="form-control" id="email-perfil" name="email-perfil" placeholder="Email" readonly value="<?php echo @$email_usu ?>" style="background-color: #dfdfdf;">
            </div>

            <div class="mb-3">
              <label for="senha-perfil" class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha-perfil" name="senha-perfil" placeholder="Senha" required="" value="<?php echo @$senha_usu ?>">
            </div>

            <small>
              <div align="center" class="mt-1" id="mensagem-perfil">

              </div>
            </small>

          </div>
          <div class="modal-footer">
            <button type="button" id="btn-fechar-perfil" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button name="btn-salvar-perfil" id="btn-salvar-perfil" type="submit" class="btn btn-success">Salvar</button>

            <input name="id-perfil" type="hidden" value="<?php echo @$id_usu ?>">

            <input name="antigo-perfil" type="hidden" value="<?php echo @$funcional_usu ?>">
            <input name="antigo2-perfil" type="hidden" value="<?php echo @$email_usu ?>">
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="../js/mascara.js"></script>

  <script type="text/javascript">
    $("#form-perfil").submit(function() {
      event.preventDefault();
      var formData = new FormData(this);

      $.ajax({
        url: "editar-perfil.php",
        type: 'POST',
        data: formData,

        success: function(mensagem) {

          $('#mensagem-perfil').removeClass()

          if (mensagem.trim() == "Salvo com Sucesso!") {

            $('#btn-fechar-perfil').click();
            window.location = "index.php?pagina=" + pag; // 'pag' needs to be defined if this script is used outside a page context where 'pag' is set.

          } else {

            $('#mensagem-perfil').addClass('text-danger')
          }

          $('#mensagem-perfil').text(mensagem)

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
</body>

</html>