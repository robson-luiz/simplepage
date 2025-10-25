<?php
	include_once('./includes/funcoes.php');
	$id = $_GET['id'];
	//Buscar os dados referente ao serviço situado nesse id
	$result_servico = "SELECT * FROM servicos WHERE id = ? LIMIT 1";
	$stmt_servico = db_query($result_servico, [$id]);
	$row_servico = db_fetch_assoc($stmt_servico);
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<h1>Visualizar Serviço</h1>
	</div>
	<div class="row">
		<div class="pull-right" style="padding-bottom: 20px;">
			<a href="administracao.php?link=18">
				<button type="button" class="btn btn-sm btn-success">Listar</button>
			</a>
			<a href="administracao.php?link=20&id=<?php echo $row_servico['id']; ?>">
				<button type="button" class="btn btn-sm btn-warning">Editar</button>
			</a>
			<a href="#" onclick="confirmarExclusao(<?php echo $row_servico['id']; ?>, '<?php echo addslashes($row_servico['titulo']); ?>')">
				<button type="button" class="btn btn-sm btn-danger">Apagar</button>
			</a>
		</div>
	</div>
    <div class="row" style="margin-bottom:20px;">
      <div class="col-md-12 text-center">
        <i class="fas <?php echo $row_servico['icone']; ?> fa-5x text-primary" style="margin-bottom: 20px;"></i>
      </div>
    </div>
	<dl class="dl-horizontal">
		<dt>Título</dt>
		<dd><?php echo $row_servico['titulo']; ?></dd>
		<dt>Descrição</dt>
		<dd><?php echo $row_servico['descricao']; ?></dd>
		<dt>Ícone</dt>
		<dd><?php echo $row_servico['icone']; ?></dd>
		<dt>Ordem</dt>
		<dd><?php echo $row_servico['ordem']; ?></dd>
		<dt>Status</dt>
		<dd><?php echo isset($row_servico['status']) ? ucfirst($row_servico['status']) : '-'; ?></dd>
		<dt>Criado em</dt>
		<dd><?php
			if(isset($row_servico['created_at'])){
			echo date('d/m/Y H:i:s', strtotime($row_servico['created_at']));
		}?>
		</dd>
		<dt>Modificado em</dt>
		<dd><?php
			if(isset($row_servico['updated_at'])){
			echo date('d/m/Y H:i:s', strtotime($row_servico['updated_at']));
		}?>
		</dd>
	</dl>
</div>

<!-- Modal de Confirmação -->
<div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalConfirmacaoLabel">
          <i class="fas fa-exclamation-triangle text-warning"></i> Confirmar Exclusão
        </h4>
        <button type="button" class="close" onclick="fecharModal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir o serviço:</p>
        <div class="alert alert-info">
          <strong id="nomeServicoExcluir"></strong>
        </div>
        <p class="text-danger">
          <i class="fas fa-warning"></i> <strong>Atenção:</strong> Esta ação não poderá ser desfeita.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="fecharModal()">
          <i class="fas fa-times"></i> Cancelar
        </button>
        <a id="linkExcluir" href="#" class="btn btn-danger">
          <i class="fas fa-trash"></i> Sim, Excluir
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Script administrativo -->
<script src="js/admin.js"></script>