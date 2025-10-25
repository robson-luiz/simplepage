<?php
  include_once('./includes/funcoes.php');
  
  // Filtros
  $status_filter = isset($_GET['status']) ? $_GET['status'] : '';
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  
  // Construir query base
  $where_conditions = [];
  $params = [];
  
  if (!empty($status_filter)) {
    $where_conditions[] = "status = ?";
    $params[] = $status_filter;
  }
  
  if (!empty($search)) {
    $where_conditions[] = "(nome LIKE ? OR email LIKE ? OR mensagem LIKE ?)";
    $search_param = "%{$search}%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
  }
  
  $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";
  
  $result_contatos = "SELECT * FROM contatos {$where_clause} ORDER BY data_criacao DESC";
  $stmt_contatos = db_query($result_contatos, $params);
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Mensagens de Contato</h1>
  </div>
  
  <!-- Filtros -->
  <div class="row mb-3">
    <div class="col-lg-8 col-md-12">
      <form method="GET" class="row g-2 align-items-end">
        <input type="hidden" name="link" value="22">
        <div class="col-md-3 col-sm-6">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="">Todos os Status</option>
            <option value="novo" <?php echo $status_filter == 'novo' ? 'selected' : ''; ?>>Novo</option>
            <option value="lido" <?php echo $status_filter == 'lido' ? 'selected' : ''; ?>>Lido</option>
            <option value="respondido" <?php echo $status_filter == 'respondido' ? 'selected' : ''; ?>>Respondido</option>
            <option value="arquivado" <?php echo $status_filter == 'arquivado' ? 'selected' : ''; ?>>Arquivado</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-6">
          <label for="search" class="form-label">Buscar</label>
          <input type="text" name="search" id="search" class="form-control" placeholder="Nome, email ou mensagem..." value="<?php echo htmlspecialchars($search); ?>">
        </div>
        <div class="col-md-2 col-6">
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-search"></i> <span class="d-none d-sm-inline">Filtrar</span>
          </button>
        </div>
        <div class="col-md-2 col-6">
          <a href="administracao.php?link=22" class="btn btn-secondary w-100">
            <i class="fas fa-times"></i> <span class="d-none d-sm-inline">Limpar</span>
          </a>
        </div>
      </form>
    </div>
    <div class="col-lg-4 col-md-12 text-end mt-3 mt-lg-0">
      <div class="btn-group w-100 d-lg-inline-block">
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="marcarTodasLidas()">
          <i class="fas fa-check-double"></i> <span class="d-none d-lg-inline">Marcar Todas como Lidas</span><span class="d-lg-none">Marcar Lidas</span>
        </button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Email</th>
            <th class="text-center">Status</th>
            <th class="text-center">Data/Hora</th>
            <th class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $count = 0;
        while ($row_contatos = db_fetch_assoc($stmt_contatos)) {
          $count++;
          // Definir classe CSS baseada no status
          $status_class = '';
          $status_icon = '';
          switch($row_contatos['status']) {
            case 'novo':
              $status_class = 'badge badge-primary';
              $status_icon = 'fa-envelope';
              break;
            case 'lido':
              $status_class = 'badge badge-info';
              $status_icon = 'fa-envelope-open';
              break;
            case 'respondido':
              $status_class = 'badge badge-success';
              $status_icon = 'fa-reply';
              break;
            case 'arquivado':
              $status_class = 'badge badge-default';
              $status_icon = 'fa-archive';
              break;
          }
        ?>
          <tr class="<?php echo $row_contatos['status'] == 'novo' ? 'table-warning' : ''; ?>">
            <td class="text-center" data-label="ID"><?php echo $row_contatos['id']; ?></td>
            <td class="text-center" data-label="Nome">
              <?php echo htmlspecialchars($row_contatos['nome']); ?>
              <?php if($row_contatos['status'] == 'novo'): ?>
                <span class="badge badge-danger">NOVO</span>
              <?php endif; ?>
            </td>
            <td class="text-center" data-label="Email"><?php echo htmlspecialchars($row_contatos['email']); ?></td>
            <td class="text-center" data-label="Status">
              <span class="<?php echo $status_class; ?>">
                <i class="fas <?php echo $status_icon; ?> me-1"></i>
                <?php echo ucfirst($row_contatos['status']); ?>
              </span>
            </td>
            <td class="text-center" data-label="Data/Hora"><?php echo date('d/m/Y H:i', strtotime($row_contatos['data_criacao'])); ?></td>
            <td class="text-center" data-label="Ações">
                <div class="btn-group-vertical d-md-inline" role="group">
                <a href="administracao.php?link=23&id=<?php echo $row_contatos['id']; ?>">
                    <button type="button" class="btn btn-xs btn-primary">
                        <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Visualizar</span>
                    </button>
                </a>

                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Editar</span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php if($row_contatos['status'] != 'lido'): ?>
                        <li><a class="dropdown-item" href="#" onclick="alterarStatus(<?php echo $row_contatos['id']; ?>, 'lido')">
                            <i class="fas fa-envelope-open text-info me-2"></i> Marcar como Lida
                        </a></li>
                        <?php endif; ?>
                        
                        <?php if($row_contatos['status'] != 'respondido'): ?>
                        <li><a class="dropdown-item" href="#" onclick="alterarStatus(<?php echo $row_contatos['id']; ?>, 'respondido')">
                            <i class="fas fa-reply text-success me-2"></i> Marcar como Respondida
                        </a></li>
                        <?php endif; ?>
                        
                        <?php if($row_contatos['status'] != 'arquivado'): ?>
                        <li><a class="dropdown-item" href="#" onclick="alterarStatus(<?php echo $row_contatos['id']; ?>, 'arquivado')">
                            <i class="fas fa-archive text-muted me-2"></i> Arquivar
                        </a></li>
                        <?php endif; ?>
                        
                        <?php if($row_contatos['status'] != 'novo'): ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="alterarStatus(<?php echo $row_contatos['id']; ?>, 'novo')">
                            <i class="fas fa-envelope text-primary me-2"></i> Marcar como Nova
                        </a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <a href="#" onclick="confirmarExclusaoContato(<?php echo $row_contatos['id']; ?>, '<?php echo addslashes($row_contatos['nome']); ?>')">
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
      
      <?php if ($count == 0): ?>
        <div class="alert alert-info text-center">
          <i class="fas fa-info-circle"></i> Nenhuma mensagem encontrada com os filtros aplicados.
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Modal de Confirmação para Contatos -->
<div class="modal fade" id="modalConfirmacaoContato" tabindex="-1" role="dialog" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fas fa-exclamation-triangle text-warning"></i> Confirmar Exclusão
        </h4>
        <button type="button" class="close" onclick="fecharModalContato()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir a mensagem de:</p>
        <div class="alert alert-info">
          <strong id="nomeContatoExcluir"></strong>
        </div>
        <p class="text-danger">
          <i class="fas fa-warning"></i> <strong>Atenção:</strong> Esta ação não poderá ser desfeita.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="fecharModalContato()">
          <i class="fas fa-times"></i> Cancelar
        </button>
        <a id="linkExcluirContato" href="#" class="btn btn-danger">
          <i class="fas fa-trash"></i> Sim, Excluir
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Script administrativo -->
<script src="js/admin.js"></script>