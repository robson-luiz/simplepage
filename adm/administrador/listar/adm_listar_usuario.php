<?php
  include_once('./includes/funcoes.php');
  $result_usuarios = "SELECT * FROM usuarios";
  $stmt_usuarios = db_query($result_usuarios);
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Lista de Usuários</h1>
  </div>
  <div class="row">
      <div class="pull-right">
          <a href="administracao.php?link=3"><button type="button" class="btn btn-sm btn-success">Cadastrar</button></a>
      </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">Imagem</th>
              <th class="text-center">Inscrição</th>
              <th class="text-center">Nome</th>
              <th class="text-center">E-mail</th>
              <th class="text-center">Status</th>
              <th class="text-center">Nível</th>
              <th class="text-center">Inserido</th>
              <th class="text-center">Ação</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($row_usuarios = db_fetch_assoc($stmt_usuarios)) {?>
            <tr>
                <td class="text-center">
                    <?php
                      $fs_path = './assets/imagens/usuarios/' . $row_usuarios['id'] . '/' . $row_usuarios['imagem'];
                      if (!empty($row_usuarios['imagem']) && is_file($fs_path)) {
                        echo '<img src="' . $fs_path . '" alt="Imagem" style="max-width:50px; max-height:50px; border-radius:50%;" />';
                      } else {
                        echo '<span style="color:#aaa;">-</span>';
                      }
                    ?>
                </td>
              <td class="text-center"><?php echo $row_usuarios['id']; ?></td>
              <td class="text-center"><?php echo $row_usuarios['nome']; ?></td>
              <td class="text-center"><?php echo $row_usuarios['email']; ?></td>
              <td class="text-center">
                <?php echo isset($row_usuarios['status']) ? ucfirst($row_usuarios['status']) : '-'; ?>
              </td>
              <td class="text-center">
                <?php echo isset($row_usuarios['nivel']) ? ucfirst($row_usuarios['nivel']) : '-'; ?>
              </td>
              <td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row_usuarios['created_at'])); ?></td>
              <td class="text-center">
                <a href="administracao.php?link=5&id=<?php echo $row_usuarios['id']; ?>">
                    <button type="button" class="btn btn-xs btn-primary">Visualizar</button>
                </a>

                <a href="administracao.php?link=4&id=<?php echo $row_usuarios['id']; ?>">
                    <button type="button" class="btn btn-xs btn-warning">Editar</button>
                </a>
                
                <a href="administrador/processa/adm_apagar_usuario.php?id=<?php echo $row_usuarios['id']; ?>">
                    <button type="button" class="btn btn-xs btn-danger">Apagar</button>
                </a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</div>