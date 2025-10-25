<?php
  include_once('./includes/funcoes.php');
  $result_servicos = "SELECT * FROM servicos ORDER BY ordem ASC";
  $stmt_servicos = db_query($result_servicos);
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Lista de Serviços</h1>
  </div>
  <div class="row mb-3">
      <div class="pull-right">
          <a href="administracao.php?link=19"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
      </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Título</th>
              <th class="text-center">Ícone</th>
              <th class="text-center">Ordem</th>
              <th class="text-center">Status</th>
              <th class="text-center">Criado em</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($row_servicos = db_fetch_assoc($stmt_servicos)) {?>
            <tr>
              <td class="text-center" data-label="ID"><?php echo $row_servicos['id']; ?></td>
              <td class="text-center" data-label="Título"><?php echo $row_servicos['titulo']; ?></td>
              <td class="text-center" data-label="Ícone">
                <i class="fas <?php echo $row_servicos['icone']; ?> fa-2x text-primary"></i>
              </td>
              <td class="text-center" data-label="Ordem"><?php echo $row_servicos['ordem']; ?></td>
              <td class="text-center" data-label="Status">
                <?php echo isset($row_servicos['status']) ? ucfirst($row_servicos['status']) : '-'; ?>
              </td>
              <td class="text-center" data-label="Criado em"><?php echo date('d/m/Y H:i:s',strtotime($row_servicos['created_at'])); ?></td>
              <td class="text-center" data-label="Ações">
                <div class="btn-group-vertical d-md-inline" role="group">
                <a href="administracao.php?link=21&id=<?php echo $row_servicos['id']; ?>">
                    <button type="button" class="btn btn-xs btn-primary">
                        <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Visualizar</span>
                    </button>
                </a>

                <a href="administracao.php?link=20&id=<?php echo $row_servicos['id']; ?>">
                    <button type="button" class="btn btn-xs btn-warning">
                        <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Editar</span>
                    </button>
                </a>
                
                <a href="#" onclick="confirmarExclusao(<?php echo $row_servicos['id']; ?>, '<?php echo addslashes($row_servicos['titulo']); ?>')">
                    <button type="button" class="btn btn-xs btn-danger">
                        <i class="fas fa-trash"></i> <span class="d-none d-sm-inline">Apagar</span>
                    </button>
                </a>
                </div>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
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