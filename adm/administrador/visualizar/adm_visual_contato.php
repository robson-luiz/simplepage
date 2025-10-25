<?php
  include_once('./includes/funcoes.php');
  $id = $_GET['id'];
  
  // Buscar os dados da mensagem
  $result_contato = "SELECT * FROM contatos WHERE id = ? LIMIT 1";
  $stmt_contato = db_query($result_contato, [$id]);
  $row_contato = db_fetch_assoc($stmt_contato);
  
  if (!$row_contato) {
    echo "<script>alert('Mensagem não encontrada!'); window.location.href='administracao.php?link=22';</script>";
    exit;
  }
  
  // Marcar como lida se ainda for nova
  if ($row_contato['status'] == 'novo') {
    $update_sql = "UPDATE contatos SET status = 'lido', data_atualizacao = NOW() WHERE id = ?";
    db_query($update_sql, [$id]);
    $row_contato['status'] = 'lido'; // Atualizar array local
  }
?>
<div class="container theme-showcase" role="main">
  <div class="page-header d-flex justify-content-between align-items-center">
    <h1>Visualizar Mensagem de Contato</h1>
    <div>
      <a href="administracao.php?link=22" class="btn btn-sm btn-success">
        <i class="fas fa-list"></i> Voltar à Lista
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <!-- Card principal com dados da mensagem -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="fas fa-envelope me-2"></i>Mensagem #<?php echo $row_contato['id']; ?>
          </h5>
          <?php
          $status_class = '';
          $status_icon = '';
          switch($row_contato['status']) {
            case 'novo':
              $status_class = 'badge bg-primary';
              $status_icon = 'fa-envelope';
              break;
            case 'lido':
              $status_class = 'badge bg-info';
              $status_icon = 'fa-envelope-open';
              break;
            case 'respondido':
              $status_class = 'badge bg-success';
              $status_icon = 'fa-reply';
              break;
            case 'arquivado':
              $status_class = 'badge bg-secondary';
              $status_icon = 'fa-archive';
              break;
          }
          ?>
          <span class="<?php echo $status_class; ?>">
            <i class="fas <?php echo $status_icon; ?> me-1"></i>
            <?php echo ucfirst($row_contato['status']); ?>
          </span>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <strong><i class="fas fa-user me-2"></i>Nome:</strong><br>
              <span class="fs-5"><?php echo htmlspecialchars($row_contato['nome']); ?></span>
            </div>
            <div class="col-md-6">
              <strong><i class="fas fa-envelope me-2"></i>E-mail:</strong><br>
              <a href="mailto:<?php echo htmlspecialchars($row_contato['email']); ?>" class="fs-5">
                <?php echo htmlspecialchars($row_contato['email']); ?>
              </a>
            </div>
          </div>
          
          <div class="mb-3">
            <strong><i class="fas fa-calendar me-2"></i>Data de Envio:</strong><br>
            <span class="fs-6"><?php echo date('d/m/Y \à\s H:i:s', strtotime($row_contato['data_criacao'])); ?></span>
          </div>
          
          <?php if($row_contato['data_atualizacao'] != $row_contato['data_criacao']): ?>
          <div class="mb-3">
            <strong><i class="fas fa-edit me-2"></i>Última Atualização:</strong><br>
            <span class="fs-6"><?php echo date('d/m/Y \à\s H:i:s', strtotime($row_contato['data_atualizacao'])); ?></span>
          </div>
          <?php endif; ?>
          
          <hr>
          
          <div class="mb-3">
            <strong><i class="fas fa-comment me-2"></i>Mensagem:</strong>
            <div class="border rounded p-3 mt-2 bg-light">
              <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">
                <?php echo htmlspecialchars($row_contato['mensagem']); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <!-- Card de ações -->
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Ações</h6>
        </div>
        <div class="card-body">
          <!-- Alterar Status -->
          <div class="mb-3">
            <label class="form-label fw-bold">Alterar Status:</label>
            <div class="btn-group-vertical d-grid gap-2">
              <button type="button" class="btn btn-outline-info btn-sm" onclick="alterarStatus(<?php echo $row_contato['id']; ?>, 'lido')" <?php echo $row_contato['status'] == 'lido' ? 'disabled' : ''; ?>>
                <i class="fas fa-envelope-open me-2"></i>Marcar como Lido
              </button>
              <button type="button" class="btn btn-outline-success btn-sm" onclick="alterarStatus(<?php echo $row_contato['id']; ?>, 'respondido')" <?php echo $row_contato['status'] == 'respondido' ? 'disabled' : ''; ?>>
                <i class="fas fa-reply me-2"></i>Marcar como Respondido
              </button>
              <button type="button" class="btn btn-outline-secondary btn-sm" onclick="alterarStatus(<?php echo $row_contato['id']; ?>, 'arquivado')" <?php echo $row_contato['status'] == 'arquivado' ? 'disabled' : ''; ?>>
                <i class="fas fa-archive me-2"></i>Arquivar
              </button>
              <button type="button" class="btn btn-outline-primary btn-sm" onclick="alterarStatus(<?php echo $row_contato['id']; ?>, 'novo')" <?php echo $row_contato['status'] == 'novo' ? 'disabled' : ''; ?>>
                <i class="fas fa-envelope me-2"></i>Marcar como Novo
              </button>
            </div>
          </div>
          
          <hr>
          
          <!-- Responder por E-mail -->
          <div class="mb-3">
            <a href="mailto:<?php echo htmlspecialchars($row_contato['email']); ?>?subject=Re: Contato via Site&body=Olá <?php echo htmlspecialchars($row_contato['nome']); ?>,%0D%0A%0D%0AObrigado por entrar em contato conosco.%0D%0A%0D%0AAtenciosamente,%0D%0AEquipe SimplePage" 
               class="btn btn-primary btn-sm w-100">
              <i class="fas fa-reply me-2"></i>Responder por E-mail
            </a>
          </div>
          
          <hr>
          
          <!-- Excluir -->
          <div class="mb-3">
            <button type="button" class="btn btn-danger btn-sm w-100" onclick="confirmarExclusaoContato(<?php echo $row_contato['id']; ?>, '<?php echo addslashes($row_contato['nome']); ?>')">
              <i class="fas fa-trash me-2"></i>Excluir Mensagem
            </button>
          </div>
        </div>
      </div>
      
      <!-- Card de informações adicionais -->
      <div class="card mt-3">
        <div class="card-header">
          <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informações</h6>
        </div>
        <div class="card-body">
          <small class="text-muted">
            <p><strong>IP:</strong> Não registrado</p>
            <p><strong>User Agent:</strong> Não registrado</p>
            <p class="mb-0"><strong>Histórico:</strong> Esta mensagem foi <?php echo $row_contato['status'] == 'novo' ? 'recém' : 'anteriormente'; ?> visualizada.</p>
          </small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Confirmação -->
<div class="modal fade" id="modalConfirmacaoContato" tabindex="-1" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <i class="fas fa-exclamation-triangle text-warning"></i> Confirmar Exclusão
        </h4>
        <button type="button" class="close" onclick="fecharModalContato()">
          <span>&times;</span>
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

<script>
function alterarStatus(id, novoStatus) {
    if (confirm('Deseja alterar o status desta mensagem para "' + novoStatus + '"?')) {
        window.location.href = 'administrador/processa/adm_alterar_status_contato.php?id=' + id + '&status=' + novoStatus + '&redirect=view';
    }
}

function confirmarExclusaoContato(idContato, nomeContato) {
    document.getElementById('nomeContatoExcluir').textContent = nomeContato;
    document.getElementById('linkExcluirContato').href = 'administrador/processa/adm_apagar_contato.php?id=' + idContato;
    
    var modal = document.getElementById('modalConfirmacaoContato');
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');
    
    var backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'modalBackdropContato';
    document.body.appendChild(backdrop);
}

function fecharModalContato() {
    var modal = document.getElementById('modalConfirmacaoContato');
    modal.style.display = 'none';
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    
    var backdrop = document.getElementById('modalBackdropContato');
    if (backdrop) {
        backdrop.remove();
    }
}
</script>