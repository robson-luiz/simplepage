<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Cadastrar Usuários</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=2"><button type="button" class="btn btn-sm btn-success">Listar</button></a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_cad_usuario.php" enctype="multipart/form-data" id="formCadUsuario">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nome <span class="text-danger">*</span></label>
	    <div class="col-sm-10">
	      <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Nome Completo" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">E-mail <span class="text-danger">*</span></label>
	    <div class="col-sm-10">
	      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Senha <span class="text-danger">*</span></label>
	    <div class="col-sm-10">
	      <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Senha" required minlength="6">
	      <small class="text-muted">Mínimo de 6 caracteres</small>
	    </div>
	  </div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Status <span class="text-danger">*</span></label>
			<div class="col-sm-10">
					<select class="form-control" name="status" required>
							<option value="">Selecione o status</option>
							<option value="ativo">Ativo</option>
							<option value="inativo">Inativo</option>
					</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Nível de Acesso <span class="text-danger">*</span></label>
			<div class="col-sm-10">
					<select class="form-control" name="nivel" required>
							<option value="">Selecione o nível</option>
							<option value="admin">Administrador</option>
							<option value="editor">Editor</option>
					</select>
			</div>
		</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Imagem</label>
				<div class="col-sm-10">
					<input type="file" name="imagem" class="form-control" accept="image/*">
					<small class="text-muted">Campo opcional. Formatos aceitos: JPG, PNG, GIF</small>
				</div>
			</div>

	  <div class="form-group mt-3">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary">Cadastrar</button>
	    </div>
	  </div>
	</form>
	
	<p class="text-muted mt-3"><span class="text-danger">*</span> Campos obrigatórios</p>
 </div>