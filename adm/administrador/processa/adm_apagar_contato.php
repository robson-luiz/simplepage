<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Verificar se o ID foi fornecido
	if (!isset($_GET['id']) || empty($_GET['id'])) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
			<script type=\"text/javascript\">
				alert(\"ID da mensagem não fornecido.\");
			</script>
			";
		exit;
	}
	
	$id = $_GET['id'];
	
	// Primeiro, verificar se a mensagem existe
	$check_sql = "SELECT nome FROM contatos WHERE id = ?";
	$check_stmt = db_query($check_sql, [$id]);
	$contato_data = db_fetch_assoc($check_stmt);
	
	if (!$contato_data) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
			<script type=\"text/javascript\">
				alert(\"Mensagem não encontrada.\");
			</script>
			";
		exit;
	}
	
	$nome_contato = $contato_data['nome'];
	
	// Executar a exclusão
	$sql = "DELETE FROM contatos WHERE id = ?";
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
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
				<script type=\"text/javascript\">
					alert(\"Mensagem de '". addslashes($nome_contato) . "' foi excluída com sucesso!\");
				</script>
				";
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
				<script type=\"text/javascript\">
					alert(\"Erro ao excluir a mensagem de '". addslashes($nome_contato) . "'. Tente novamente.\");
				</script>
				";
		}

		?>
	</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>