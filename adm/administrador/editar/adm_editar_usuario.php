<?php
	include_once('./includes/funcoes.php');
	$id = $_GET['id'];
	//Buscar os dados referente ao usuario situado nesse id
	$result_usuario = "SELECT * FROM usuarios WHERE id = ? LIMIT 1";
	$stmt_usuario = db_query($result_usuario, [$id]);
	$row_usuario = db_fetch_assoc($stmt_usuario);
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Editar Usuários</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=2"><button type="button" class="btn btn-sm btn-success">Listar</button>
          </a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_edita_usuario.php" enctype="multipart/form-data" id="formEditUsuario">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nome <span class="text-danger">*</span></label>
	    <div class="col-sm-10">
	      <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Nome Completo" value="<?php echo htmlspecialchars($row_usuario['nome']); ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">E-mail <span class="text-danger">*</span></label>
	    <div class="col-sm-10">
	      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail" value="<?php echo htmlspecialchars($row_usuario['email']); ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nova Senha</label>
	    <div class="col-sm-10">
	      <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Deixe em branco para manter a atual" minlength="6">
	      <small class="text-muted">Deixe em branco para manter a senha atual. Mínimo de 6 caracteres se alterar.</small>
	    </div>
	  </div>
	

		<div class="form-group">
			<label class="col-sm-2 control-label">Status <span class="text-danger">*</span></label>
			<div class="col-sm-10">
					<select class="form-control" name="status" required>
							<option value="ativo" <?php if($row_usuario['status'] == 'ativo') echo 'selected'; ?>>Ativo</option>
							<option value="inativo" <?php if($row_usuario['status'] == 'inativo') echo 'selected'; ?>>Inativo</option>
					</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Nível de Acesso <span class="text-danger">*</span></label>
			<div class="col-sm-10">
					<select class="form-control" name="nivel" required>
							<option value="admin" <?php if($row_usuario['nivel'] == 'admin') echo 'selected'; ?>>Administrador</option>
							<option value="editor" <?php if($row_usuario['nivel'] == 'editor') echo 'selected'; ?>>Editor</option>
					</select>
			</div>
		</div>

	  <input type="hidden" name="id" value="<?php echo $row_usuario['id']; ?>">
	<!-- Exibe imagem atual se existir -->
	<?php
		$img_path = '../../assets/imagens/usuarios/' . $row_usuario['id'] . '/' . $row_usuario['imagem'];
		if (!empty($row_usuario['imagem']) && is_file($img_path)) {
			echo '<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><img src="' . $img_path . '" alt="Foto do usuário" style="max-width:120px;max-height:120px;margin-bottom:10px;"></div></div>';
		}
	?>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nova Imagem</label>
		<div class="col-sm-10">
			<input type="file" name="imagem" accept="image/*" class="form-control">
			<p class="help-block">Selecione uma nova imagem para substituir a atual.</p>
		</div>
	</div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-warning">Alterar</button>
	    </div>
	  </div>
	</form>
	
	<p class="text-muted mt-3"><span class="text-danger">*</span> Campos obrigatórios</p>
</div>