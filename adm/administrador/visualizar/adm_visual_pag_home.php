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
	<div class="row" style="margin-bottom:20px;">
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
	</div>
	<dl class="dl-horizontal">
		<dt>Titulo</dt>
		<dd><?php echo $row_home['titulo']; ?></dd>
		<dt>Conteudo</dt>
		<dd><?php echo $row_home['conteudo']; ?></dd>
		<dt>Inserido</dt>
		<dd><?php
			if (isset($row_home['created'])) {
				echo date('d/m/Y H:i:s', strtotime($row_home['created']));
			} ?>
		</dd>
		<dt>Modificado</dt>
		<dd><?php
			if (isset($row_home['modified'])) {
				echo date('d/m/Y H:i:s', strtotime($row_home['modified']));
			} ?>
		</dd>
	</dl>
</div>