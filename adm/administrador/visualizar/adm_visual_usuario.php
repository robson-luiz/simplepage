<?php
	include_once('./includes/funcoes.php');
	$id = $_GET['id'];
	//Buscar os dados referente ao usuario situado nesse id
	$result_usuario = "SELECT * FROM usuarios WHERE id = ? LIMIT 1";
	$stmt_usuario = db_query($result_usuario, [$id]);
	$row_usuario = db_fetch_assoc($stmt_usuario);
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<h1>Visualizar Usuário</h1>
	</div>
	<div class="row">
		<div class="pull-right" style="padding-bottom: 20px;">
			<a href="administracao.php?link=2">
				<button type="button" class="btn btn-sm btn-success">Listar</button>
			</a>
			<a href="administracao.php?link=4&id=<?php echo $row_usuario['id']; ?>">
				<button type="button" class="btn btn-sm btn-warning">Editar</button>
			</a>
			<a href="#" onclick="confirmarExclusaoUsuario(<?php echo $row_usuario['id']; ?>, '<?php echo addslashes($row_usuario['nome']); ?>')">
				<button type="button" class="btn btn-sm btn-danger">Apagar</button>
			</a>
		</div>
	</div>
    <div class="row" style="margin-bottom:20px;">
      <div class="col-md-12 text-center">
			<?php
				$fs_path = './assets/imagens/usuarios/' . $row_usuario['id'] . '/' . $row_usuario['imagem'];
				if (!empty($row_usuario['imagem']) && is_file($fs_path)) {
					echo '<img src="' . $fs_path . '" alt="Foto do usuário" style="width:180px; height:180px; border-radius:50%; object-fit:cover; box-shadow:0 2px 8px #ccc; border: 3px solid #eee;" />';
				} else {
					echo '<span style="color:#aaa;">Sem imagem</span>';
				}
			?>
      </div>
    </div>
	<dl class="dl-horizontal">
		<dt>Nome</dt>
		<dd><?php echo $row_usuario['nome']; ?></dd>
		<dt>E-mail</dt>
		<dd><?php echo $row_usuario['email']; ?></dd>
		<dt>Status</dt>
		<dd><?php echo isset($row_usuario['status']) ? ucfirst($row_usuario['status']) : '-'; ?></dd>
		<dt>Nível de Acesso</dt>
		<dd><?php echo isset($row_usuario['nivel']) ? ucfirst($row_usuario['nivel']) : '-'; ?></dd>
		<dt>Inserido</dt>
		<dd><?php
			if(isset($row_usuario['created'])){
			echo date('d/m/Y H:i:s', strtotime($row_usuario['created']));
		}?>
		</dd>
		</dd>
		<dt>Modificado</dt>
		<dd><?php
			if(isset($row_usuario['modified'])){
			echo date('d/m/Y H:i:s', strtotime($row_usuario['modified']));
		}?>
		</dd>
	</dl>
</div>

<!-- Modal de Confirmação para Usuários -->
<div class="modal fade" id="modalConfirmacaoUsuario" tabindex="-1" role="dialog" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fas fa-exclamation-triangle text-warning"></i> Confirmar Exclusão de Usuário
        </h4>
        <button type="button" class="close" onclick="fecharModalUsuario()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir o usuário:</p>
        <div class="alert alert-info">
          <strong id="nomeUsuarioExcluir"></strong>
        </div>
        <p class="text-danger">
          <i class="fas fa-warning"></i> <strong>Atenção:</strong> Esta ação não poderá ser desfeita e o usuário perderá acesso ao sistema.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="fecharModalUsuario()">
          <i class="fas fa-times"></i> Cancelar
        </button>
        <a id="linkExcluirUsuario" href="#" class="btn btn-danger">
          <i class="fas fa-trash"></i> Sim, Excluir
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Script administrativo -->
<script src="js/admin.js"></script>