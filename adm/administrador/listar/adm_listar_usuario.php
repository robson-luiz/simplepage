<?php
  include_once('./includes/funcoes.php');
  $result_usuarios = "SELECT * FROM usuarios";
  $stmt_usuarios = db_query($result_usuarios);
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Lista de Usuários</h1>
  </div>
  <div class="row mb-3">
      <div class="pull-right">
          <a href="administracao.php?link=3"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
      </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">Imagem</th>
              <th class="text-center">ID</th>
              <th class="text-center">Nome</th>
              <th class="text-center">E-mail</th>
              <th class="text-center">Status</th>
              <th class="text-center">Nível</th>
              <th class="text-center">Inserido</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($row_usuarios = db_fetch_assoc($stmt_usuarios)) {?>
            <tr>
                <td class="text-center" data-label="Imagem">
                    <?php
                      $fs_path = './assets/imagens/usuarios/' . $row_usuarios['id'] . '/' . $row_usuarios['imagem'];
                      if (!empty($row_usuarios['imagem']) && is_file($fs_path)) {
                        echo '<img src="' . $fs_path . '" alt="Imagem" style="max-width:50px; max-height:50px; border-radius:50%;" />';
                      } else {
                        echo '<span style="color:#aaa;">-</span>';
                      }
                    ?>
                </td>
              <td class="text-center" data-label="ID"><?php echo $row_usuarios['id']; ?></td>
              <td class="text-center" data-label="Nome"><?php echo $row_usuarios['nome']; ?></td>
              <td class="text-center" data-label="E-mail"><?php echo $row_usuarios['email']; ?></td>
              <td class="text-center" data-label="Status">
                <?php echo isset($row_usuarios['status']) ? ucfirst($row_usuarios['status']) : '-'; ?>
              </td>
              <td class="text-center" data-label="Nível">
                <?php echo isset($row_usuarios['nivel']) ? ucfirst($row_usuarios['nivel']) : '-'; ?>
              </td>
              <td class="text-center" data-label="Inserido"><?php echo date('d/m/Y H:i:s',strtotime($row_usuarios['created_at'])); ?></td>
              <td class="text-center" data-label="Ações">
                <div class="btn-group-vertical d-md-inline" role="group">
                <a href="administracao.php?link=5&id=<?php echo $row_usuarios['id']; ?>">
                    <button type="button" class="btn btn-xs btn-primary">
                        <i class="fas fa-eye"></i> <span class="d-none d-sm-inline">Visualizar</span>
                    </button>
                </a>

                <a href="administracao.php?link=4&id=<?php echo $row_usuarios['id']; ?>">
                    <button type="button" class="btn btn-xs btn-warning">
                        <i class="fas fa-edit"></i> <span class="d-none d-sm-inline">Editar</span>
                    </button>
                </a>
                
                <a href="#" onclick="confirmarExclusaoUsuario(<?php echo $row_usuarios['id']; ?>, '<?php echo addslashes($row_usuarios['nome']); ?>')">
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