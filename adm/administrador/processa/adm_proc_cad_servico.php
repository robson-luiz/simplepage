<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$icone = $_POST['icone'];
	$ordem = $_POST['ordem'];
	$status = $_POST['status'];

	$sql = "INSERT INTO servicos (titulo, descricao, icone, ordem, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
	$stmt = db_query($sql, [$titulo, $descricao, $icone, $ordem, $status]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">	
</head>
<body><?php
	if(db_affected_rows($stmt) != 0){
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
			<script type=\"text/javascript\">
				alert(\"Serviço cadastrado com sucesso.\");
			</script>
			";
	}else{
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
			<script type=\"text/javascript\">
				alert(\"O Serviço não foi cadastrado com sucesso.\");
			</script>
			";
	}

	?>
</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>