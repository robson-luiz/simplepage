<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Cadastrar Serviços</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=18"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_cad_servico.php">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Título</label>
	    <div class="col-sm-10">
	      <input type="text" name="titulo" class="form-control" id="inputTitulo" placeholder="Nome do Serviço" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Descrição</label>
	    <div class="col-sm-10">
	      <textarea name="descricao" class="form-control" rows="4" placeholder="Descrição do serviço" required></textarea>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Ícone</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="icone" required>
	        <option value="">Selecione um ícone</option>
	        <option value="fa-laptop-code">💻 Desenvolvimento Web</option>
	        <option value="fa-palette">🎨 Design</option>
	        <option value="fa-bullhorn">📢 Marketing</option>
	        <option value="fa-mobile-alt">📱 Mobile</option>
	        <option value="fa-shopping-cart">🛒 E-commerce</option>
	        <option value="fa-search">🔍 SEO</option>
	        <option value="fa-shield-alt">🛡️ Segurança</option>
	        <option value="fa-cloud">☁️ Cloud</option>
	        <option value="fa-database">🗄️ Banco de Dados</option>
	        <option value="fa-cogs">⚙️ Automação</option>
	      </select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Ordem</label>
	    <div class="col-sm-10">
	      <input type="number" name="ordem" class="form-control" min="1" placeholder="Ordem de exibição" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-10">
	      <select class="form-control" name="status" required>
	        <option value="ativo">Ativo</option>
	        <option value="inativo">Inativo</option>
	      </select>
	    </div>
	  </div>

	  <div class="form-group mt-4">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary">Cadastrar</button>
	    </div>
	  </div>
	</form>
 </div>