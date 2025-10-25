<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Verificar se os parâmetros foram fornecidos
	if (!isset($_GET['id']) || !isset($_GET['status']) || empty($_GET['id']) || empty($_GET['status'])) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
			<script type=\"text/javascript\">
				alert(\"Parâmetros inválidos.\");
			</script>
			";
		exit;
	}
	
	$id = $_GET['id'];
	$novo_status = $_GET['status'];
	$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'list';
	
	// Validar status
	$status_validos = ['novo', 'lido', 'respondido', 'arquivado'];
	if (!in_array($novo_status, $status_validos)) {
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=22'>
			<script type=\"text/javascript\">
				alert(\"Status inválido.\");
			</script>
			";
		exit;
	}
	
	// Verificar se a mensagem existe
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
	
	// Atualizar o status
	$sql = "UPDATE contatos SET status = ?, data_atualizacao = NOW() WHERE id = ?";
	$stmt = db_query($sql, [$novo_status, $id]);
	
	// Definir URL de redirecionamento
	$redirect_url = "http://localhost/simplepage/adm/administracao.php?link=22";
	if ($redirect == 'view') {
		$redirect_url = "http://localhost/simplepage/adm/administracao.php?link=23&id=" . $id;
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">	
</head>
	<body><?php
		if(db_affected_rows($stmt) >= 0){ // >= 0 porque pode não haver mudança se o status for o mesmo
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL={$redirect_url}'>
				<script type=\"text/javascript\">
					alert(\"Status da mensagem de '". addslashes($nome_contato) . "' alterado para '". ucfirst($novo_status) . "' com sucesso!\");
				</script>
				";
		}else{
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL={$redirect_url}'>
				<script type=\"text/javascript\">
					alert(\"Erro ao alterar status da mensagem. Tente novamente.\");
				</script>
				";
		}
		?>
	</body>
</html>