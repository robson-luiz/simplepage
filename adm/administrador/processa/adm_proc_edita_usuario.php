<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$status = $_POST['status'];
	$nivel = $_POST['nivel'];

	// Só atualiza a senha se o campo não estiver vazio
	if (!empty($senha)) {
		$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
		$sql = "UPDATE usuarios SET nome= ?, email= ?, senha= ?, status= ?, nivel= ?, updated_at= NOW() WHERE id = ?";
		$stmt = db_query($sql, [$nome, $email, $senha_hash, $status, $nivel, $id]);
	} else {
		$sql = "UPDATE usuarios SET nome= ?, email= ?, status= ?, nivel= ?, updated_at= NOW() WHERE id = ?";
		$stmt = db_query($sql, [$nome, $email, $status, $nivel, $id]);
	}

	// Lógica de upload de imagem
	if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
		$imagem = $_FILES['imagem'];
		$extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
		$permitidas = ['jpg', 'jpeg', 'png', 'gif'];
		if (in_array($extensao, $permitidas)) {
			$pasta_destino = '../../assets/imagens/usuarios/' . $id . '/';
			if (!is_dir($pasta_destino)) {
				mkdir($pasta_destino, 0755, true);
			}
			// Remove imagem antiga se existir
			$sql_img = "SELECT imagem FROM usuarios WHERE id = ?";
			$stmt_img = db_query($sql_img, [$id]);
			$usuario = db_fetch_assoc($stmt_img);
			if (!empty($usuario['imagem'])) {
				$caminho_antigo = $pasta_destino . $usuario['imagem'];
				if (is_file($caminho_antigo)) {
					unlink($caminho_antigo);
				}
			}
			$nome_arquivo = 'foto.' . $extensao;
			$caminho_final = $pasta_destino . $nome_arquivo;
			if (move_uploaded_file($imagem['tmp_name'], $caminho_final)) {
				// Atualiza campo imagem no banco
				$sql_up_img = "UPDATE usuarios SET imagem = ? WHERE id = ?";
				db_query($sql_up_img, [$nome_arquivo, $id]);
			}
		}
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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=2'>
			<script type=\"text/javascript\">
				alert(\"Usuário alterado com sucesso.\");
			</script>
			";
		}else{
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=2'>
			<script type=\"text/javascript\">
				alert(\"O Usuário não foi alterado com sucesso.\");
			</script>
			";
		}	?>
</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>