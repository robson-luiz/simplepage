<?php	
	//Buscar os dados referente ao usuario situado nesse id
	$result_sobre = "SELECT * FROM sobre";
	$resultado_sobre = mysqli_query($conn, $result_sobre);
	$row_sobre = mysqli_fetch_assoc($resultado_sobre);

?>
<div class="container theme-showcase" role="main">
	<div class="page-header">
		<h1>Visualizar Sobre</h1>
	</div>
	<div class="row">
		<div class="pull-right" style="padding-bottom: 20px;">			
			<a href="administracao.php?link=17&id=<?php echo $row_sobre['id']; ?>">
				<button type="button" class="btn btn-sm btn-warning">Editar</button>
			</a>
		</div>
	</div>
	<dl class="dl-horizontal">
		<dt>Titulo</dt>
		<dd><?php echo $row_sobre['titulo']; ?></dd>
		<dt>Conteudo</dt>
		<dd><?php echo $row_sobre['conteudo']; ?></dd>
		<dt>Inserido</dt>
		<dd><?php
			if(isset($row_sobre['created'])){
			echo date('d/m/Y H:i:s', strtotime($row_sobre['created']));
		}?>
		</dd>
		<dt>Modificado</dt>
		<dd><?php
			if(isset($row_sobre['modified'])){
			echo date('d/m/Y H:i:s', strtotime($row_sobre['modified']));
		}?>
		</dd>
	</dl>
</div>