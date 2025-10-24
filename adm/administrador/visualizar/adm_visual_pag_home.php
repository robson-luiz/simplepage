<?php
include_once('conexao/conexao.php');
include_once('includes/funcoes.php');

//Buscar os dados referente ao usuario situado nesse id
$result_home = "SELECT * FROM home";
$stmt_home = db_query($result_home);
$row_home = db_fetch_assoc($stmt_home);
?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<h1>Visualizar Home</h1>
	</div>
	<div class="row">
		<div class="pull-right" style="padding-bottom: 20px;">			
			<a href="administracao.php?link=15&id=<?php echo $row_home['id']; ?>">
				<button type="button" class="btn btn-sm btn-warning">Editar</button>
			</a>
		</div>
	</div>
	<dl class="dl-horizontal">
		<dt>Titulo</dt>
		<dd><?php echo $row_home['titulo']; ?></dd>
		<dt>Conteudo</dt>
		<dd><?php echo $row_home['conteudo']; ?></dd>
		<dt>Inserido</dt>
		<dd><?php
			if(isset($row_home['created'])){
			echo date('d/m/Y H:i:s', strtotime($row_home['created']));
		}?>
		</dd>
		<dt>Modificado</dt>
		<dd><?php
			if(isset($row_home['modified'])){
			echo date('d/m/Y H:i:s', strtotime($row_home['modified']));
		}?>
		</dd>
	</dl>
</div>