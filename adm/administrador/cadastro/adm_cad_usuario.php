<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Cadastrar Usuários</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=2"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_cad_usuario.php" enctype="multipart/form-data">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nome</label>
	    <div class="col-sm-10">
	      <input type="text" name="nome" class="form-control" id="inputEmail3" placeholder="Nome Completo">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">E-mail</label>
	    <div class="col-sm-10">
	      <input type="email" name="email" class="form-control" id="inputPassword3" placeholder="E-mail">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Senha</label>
	    <div class="col-sm-10">
	      <input type="password" name="senha" class="form-control" id="inputEmail3" placeholder="Senha">
	    </div>
	  </div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Status</label>
			<div class="col-sm-10">
					<select class="form-control" name="status">
							<option value="ativo">Ativo</option>
							<option value="inativo">Inativo</option>
					</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Nível de Acesso</label>
			<div class="col-sm-10">
					<select class="form-control" name="nivel">
							<option value="admin">Administrador</option>
							<option value="editor">Editor</option>
					</select>
			</div>
		</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Imagem</label>
				<div class="col-sm-10">
					<input type="file" name="imagem" class="form-control" accept="image/*">
				</div>
			</div>

	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary">Cadastrar</button>
	    </div>
	  </div>
	</form>
 </div>