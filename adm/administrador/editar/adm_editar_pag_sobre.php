<?php
	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		//Buscar os dados referente ao usuario situado nesse id
		$result_sobre = "SELECT * FROM sobre WHERE id = '$id' LIMIT 1";
		$resultado_sobre = mysqli_query($conn, $result_sobre);
		$row_sobre = mysqli_fetch_assoc($resultado_sobre);
	}
?>
<div class="container theme-showcase" role="main">
  <div class="page-header">
    <h1>Editar Pagina Sobre</h1>
  </div>
  <div class="row">
      <div class="pull-right" style="padding-bottom: 20px;">
          <a href="administracao.php?link=16"><button type="button" class="btn btn-sm btn-success">Listar</button>
          </a>
      </div>
  </div>
  <form class="form-horizontal" method="POST" action="administrador/processa/adm_proc_edita_pag_sobre.php" enctype="multipart/form-data">

	  <div class="form-group">
	    <label class="col-sm-2 control-label">Titulo</label>
	    <div class="col-sm-10">
	      <input type="text" name="titulo" class="form-control" id="inputEmail3" placeholder="Titulo"
		   <?php
		   		if(!empty($row_sobre['titulo'])){
		   			echo "value='".$row_sobre['titulo']."'";
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
	      	  }elseif (!empty($row_sobre['conteudo'])) {
	      	  	?><textarea name="conteudo" class="form-control" id="editable" rows="15"><?php echo $row_sobre['conteudo'];?>
	      	  	</textarea><?php
	      	  }else{
	      	  	?><textarea name="conteudo" class="form-control" id="editable" rows="15"></textarea><?php
	      	  }

	      ?>
	    </div>
	  </div>

	  <input type="hidden" name="id" value="<?php echo $row_sobre['id']; ?>">
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-warning">Alterar</button>
	    </div>
	  </div>
	</form>
</div>