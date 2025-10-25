<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Construir condições de filtro baseadas nos parâmetros GET originais
	$where_conditions = [];
	$params = [];
	
	// Aplicar os mesmos filtros da página de listagem
	if (!empty($_GET['status'])) {
		$where_conditions[] = "status = ?";
		$params[] = $_GET['status'];
	}
	
	if (!empty($_GET['search'])) {
		$where_conditions[] = "(nome LIKE ? OR email LIKE ? OR mensagem LIKE ?)";
		$search_param = "%{$_GET['search']}%";
		$params[] = $search_param;
		$params[] = $search_param;
		$params[] = $search_param;
	}
	
	// Adicionar condição para não alterar mensagens já lidas, respondidas ou arquivadas
	$where_conditions[] = "status = 'novo'";
	
	$where_clause = "WHERE " . implode(" AND ", $where_conditions);
	
	// Atualizar todas as mensagens que correspondem aos filtros
	$sql = "UPDATE contatos SET status = 'lido', data_atualizacao = NOW() {$where_clause}";
	$stmt = db_query($sql, $params);
	
	$rows_affected = db_affected_rows($stmt);
	
	// Construir URL de retorno com os filtros originais
	$redirect_params = [];
	foreach ($_GET as $key => $value) {
		if ($key !== 'link') { // Excluir parâmetro 'link' para evitar conflito
			$redirect_params[$key] = $value;
		}
	}
	$redirect_params['link'] = 22; // Sempre voltar para a listagem de contatos
	
	$redirect_url = "http://localhost/simplepage/adm/administracao.php?" . http_build_query($redirect_params);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">	
</head>
	<body>
		<?php
		if($rows_affected > 0){
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL={$redirect_url}'>
				<script type=\"text/javascript\">
					alert(\"{$rows_affected} mensagem(ns) marcada(s) como lida(s) com sucesso!\");
				</script>
				";
		} else {
			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL={$redirect_url}'>
				<script type=\"text/javascript\">
					alert(\"Nenhuma mensagem nova encontrada para marcar como lida.\");
				</script>
				";
		}
		?>
	</body>
</html>