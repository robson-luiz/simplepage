<?php

    $result_usuarios = "SELECT * FROM usuarios ";
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);
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
              <th class="text-center">Inscrição</th>
              <th class="text-center">Nome</th>
              <th class="text-center">E-mail</th>
              <th class="text-center">Situação</th>
              <th class="text-center">Nivel de Acesso</th>
              <th class="text-center">Inserido</th>
              <th class="text-center">Ação</th>
            </tr>
          </thead>
          <tbody>
          <?php while ($row_usuarios = mysqli_fetch_assoc($resultado_usuarios)) {?>
            <tr>
              <td class="text-center"><?php echo $row_usuarios['id']; ?></td>
              <td class="text-center"><?php echo $row_usuarios['nome']; ?></td>
              <td class="text-center"><?php echo $row_usuarios['email']; ?></td>
              <td class="text-center">
                <?php $situacao =  $row_usuarios['situacoe_id']; 
                    $result_situacao = "SELECT * FROM situacoes WHERE id = '$situacao' LIMIT 1";
                    $resultado_situacao = mysqli_query($conn, $result_situacao);
                    $row_situacao = mysqli_fetch_assoc($resultado_situacao);
                    echo $row_situacao['nome'];
                ?>
              </td>
              <td class="text-center">
                <?php $nivel_acesso =  $row_usuarios['niveis_acesso_id']; 
                    $result_nivel_acesso = "SELECT * FROM niveis_acessos WHERE id = '$nivel_acesso' LIMIT 1";
                    $resultado_nivel_acesso = mysqli_query($conn, $result_nivel_acesso);
                    $row_nivel_acesso = mysqli_fetch_assoc($resultado_nivel_acesso);
                    echo $row_nivel_acesso['nome'];
                ?>
              </td>
              <td class="text-center"><?php echo date('d/m/Y H:i:s',strtotime($row_usuarios['created'])); ?></td>
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