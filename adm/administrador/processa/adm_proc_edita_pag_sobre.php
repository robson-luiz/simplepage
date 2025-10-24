<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];

	// Upload de imagem
	$imagem_nome = null;
	if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
		// Validar extensão do arquivo
		$extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		$ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
		
		if (in_array($ext, $extensoes_permitidas)) {
			$nome_arquivo = 'foto.' . $ext;
			$diretorio = '../../uploads/sobre/' . $id . '/';
			$destino = $diretorio . $nome_arquivo;
			
			// Criar diretório se não existir
			if (!is_dir($diretorio)) {
				mkdir($diretorio, 0755, true);
			}
			
			// Mover arquivo uploaded
			if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
				$imagem_nome = $nome_arquivo;
			}
		}
	}

	if ($imagem_nome) {
		$sql = "UPDATE sobre SET titulo= ?, conteudo= ?, imagem= ?, updated_at= NOW() WHERE id = ?";
		$stmt = db_query($sql, [$titulo, $conteudo, $imagem_nome, $id]);
	} else {
		$sql = "UPDATE sobre SET titulo= ?, conteudo= ?, updated_at= NOW() WHERE id = ?";
		$stmt = db_query($sql, [$titulo, $conteudo, $id]);
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
</head>
<body><?php
	if(db_affected_rows($stmt) != 0){
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=16'>
			<script type=\"text/javascript\">
				alert(\"Pagina Sobre alterada com sucesso.\");
			</script>
			";
	}else{
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=16'>
			<script type=\"text/javascript\">
				alert(\"A pagina Sobre não foi alterada com sucesso.\");
			</script>
			";
	}

	?>
</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>