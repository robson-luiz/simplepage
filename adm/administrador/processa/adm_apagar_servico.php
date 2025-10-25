<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Verificar se o ID foi fornecido
	if (!isset($_GET['id']) || empty($_GET['id'])) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
			<script type=\"text/javascript\">
				alert(\"ID do serviço não fornecido.\");
			</script>
			";
		exit;
	}
	
	$id = $_GET['id'];
	
	// Primeiro, verificar se o serviço existe
	$check_sql = "SELECT titulo FROM servicos WHERE id = ?";
	$check_stmt = db_query($check_sql, [$id]);
	$servico_data = db_fetch_assoc($check_stmt);
	
	if (!$servico_data) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
			<script type=\"text/javascript\">
				alert(\"Serviço não encontrado.\");
			</script>
			";
		exit;
	}
	
	$titulo_servico = $servico_data['titulo'];
	
	// Executar a exclusão
	$sql = "DELETE FROM servicos WHERE id = ?";
	$stmt = db_query($sql, [$id]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">	
</head>
	<body><?php
		if(db_affected_rows($stmt) > 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
				<script type=\"text/javascript\">
					alert(\"Serviço '" . addslashes($titulo_servico) . "' foi excluído com sucesso!\");
				</script>
				";
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=18'>
				<script type=\"text/javascript\">
					alert(\"Erro ao excluir o serviço '" . addslashes($titulo_servico) . "'. Tente novamente.\");
				</script>
				";
		}

		?>
	</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>