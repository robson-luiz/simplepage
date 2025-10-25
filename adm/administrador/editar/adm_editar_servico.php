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
    <h1>Editar Serviço</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=18"><button type="button" class="btn btn-sm btn-success">Listar</button>
          </a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_edita_servico.php">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Título</label>
	    <div class="col-sm-10">
	      <input type="text" name="titulo" class="form-control" id="inputTitulo" placeholder="Nome do Serviço" value="<?php echo $row_servico['titulo']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Descrição</label>
	    <div class="col-sm-10">
	      <textarea name="descricao" class="form-control" rows="4" placeholder="Descrição do serviço" required><?php echo $row_servico['descricao']; ?></textarea>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Ícone</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="icone" required>
	        <option value="">Selecione um ícone</option>
	        <option value="fa-laptop-code" <?php if($row_servico['icone'] == 'fa-laptop-code') echo 'selected'; ?>>💻 Desenvolvimento Web</option>
	        <option value="fa-palette" <?php if($row_servico['icone'] == 'fa-palette') echo 'selected'; ?>>🎨 Design</option>
	        <option value="fa-bullhorn" <?php if($row_servico['icone'] == 'fa-bullhorn') echo 'selected'; ?>>📢 Marketing</option>
	        <option value="fa-mobile-alt" <?php if($row_servico['icone'] == 'fa-mobile-alt') echo 'selected'; ?>>📱 Mobile</option>
	        <option value="fa-shopping-cart" <?php if($row_servico['icone'] == 'fa-shopping-cart') echo 'selected'; ?>>🛒 E-commerce</option>
	        <option value="fa-search" <?php if($row_servico['icone'] == 'fa-search') echo 'selected'; ?>>🔍 SEO</option>
	        <option value="fa-shield-alt" <?php if($row_servico['icone'] == 'fa-shield-alt') echo 'selected'; ?>>🛡️ Segurança</option>
	        <option value="fa-cloud" <?php if($row_servico['icone'] == 'fa-cloud') echo 'selected'; ?>>☁️ Cloud</option>
	        <option value="fa-database" <?php if($row_servico['icone'] == 'fa-database') echo 'selected'; ?>>🗄️ Banco de Dados</option>
	        <option value="fa-cogs" <?php if($row_servico['icone'] == 'fa-cogs') echo 'selected'; ?>>⚙️ Automação</option>
	      </select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Ordem</label>
	    <div class="col-sm-10">
	      <input type="number" name="ordem" class="form-control" min="1" placeholder="Ordem de exibição" value="<?php echo $row_servico['ordem']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="status" required>
	        <option value="ativo" <?php if($row_servico['status'] == 'ativo') echo 'selected'; ?>>Ativo</option>
	        <option value="inativo" <?php if($row_servico['status'] == 'inativo') echo 'selected'; ?>>Inativo</option>
	      </select>
	    </div>
	  </div>

	  <input type="hidden" name="id" value="<?php echo $row_servico['id']; ?>">
	  <div class="form-group mt-4">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-warning">Alterar</button>
	    </div>
	  </div>
	</form>
</div>