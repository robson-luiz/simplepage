<?php
include_once('includes/funcoes.php');
if(!empty($_GET['id'])){
	$id = $_GET['id'];
	//Buscar os dados referente ao registro home situado nesse id
	$result_home = "SELECT * FROM home WHERE id = ? LIMIT 1";
	$stmt_home = db_query($result_home, [$id]);
	$row_home = db_fetch_assoc($stmt_home);
}
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Editar Pagina Home</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=14"><button type="button" class="btn btn-sm btn-success">Listar</button>
          </a>
      </div>
  </div>
	<form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_edita_pag_home.php" enctype="multipart/form-data">

			<div class="form-group">
				<label class="col-sm-2 control-label">Imagem</label>
				<div class="col-sm-10">
					<div class="col-md-12 text-center">
						<?php 
						if (!empty($row_home['imagem'])): 
						$caminho_imagem_home = './uploads/home/' . $row_home['id'] . '/' . $row_home['imagem'];
						?>
					<img src="<?php echo $caminho_imagem_home; ?>" alt="Imagem Home" style="max-width:200px; margin-bottom:10px; box-shadow:0 2px 8px #ccc;" />
					<?php else: ?>
					<span style="color:#aaa;">Sem imagem</span>
					<?php endif; ?>
					</div>
					<input type="file" name="imagem" class="form-control" accept="image/*">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Titulo</label>
				<div class="col-sm-10">
					<input type="text" name="titulo" class="form-control" id="inputEmail3" placeholder="Titulo"
					 <?php
						if(!empty($row_home['titulo'])){
								echo "value='".$row_home['titulo']."'";
						}
						if(!empty($_SESSION['value_titulo'])){
								echo "value='".$_SESSION['value_titulo']."'";
								unset($_SESSION['value_titulo']);
						}
					 ?>
					/>
				</div>
			</div>

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Conteudo</label>
	    <div class="col-sm-10">
	      <?php
	      	  if(!empty($_SESSION['value_conteudo'])){
	      	  	?><textarea name="conteudo" class="form-control" id="editable" rows="15"><?php echo $_SESSION['value_conteudo'];?>
	      	  	</textarea><?php
	      	  	unset($_SESSION['value_conteudo']);
	      	  }elseif (!empty($row_home['conteudo'])) {
	      	  	?><textarea name="conteudo" class="form-control" id="editable" rows="15"><?php echo $row_home['conteudo'];?>
	      	  	</textarea><?php
	      	  }else{
	      	  	?><textarea name="conteudo" class="form-control" id="editable" rows="15"></textarea><?php
	      	  }

	      ?>
	    </div>
	  </div>

	  <input type="hidden" name="id" value="<?php echo $row_home['id']; ?>">
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-warning">Alterar</button>
	    </div>
	  </div>
	</form>
</div>