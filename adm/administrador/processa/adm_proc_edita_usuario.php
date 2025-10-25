<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Validação dos campos obrigatórios
	$erros = [];
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
	$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : '';
	$nivel = isset($_POST['nivel']) ? $_POST['nivel'] : '';
	
	// Validar ID
	if ($id <= 0) {
		$erros[] = "ID do usuário é inválido.";
	}
	
	// Validar nome
	if (empty($nome) || strlen($nome) < 2) {
		$erros[] = "Nome é obrigatório e deve ter pelo menos 2 caracteres.";
	}
	
	// Validar email
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erros[] = "E-mail é obrigatório e deve ter um formato válido.";
	}
	
	// Verificar se email já existe (exceto para o próprio usuário)
	if (!empty($email)) {
		$check_email = "SELECT id FROM usuarios WHERE email = ? AND id != ?";
		$stmt_check = db_query($check_email, [$email, $id]);
		if (db_fetch_assoc($stmt_check)) {
			$erros[] = "Este e-mail já está cadastrado para outro usuário.";
		}
	}
	
	// Validar senha (apenas se foi preenchida)
	if (!empty($senha) && strlen($senha) < 6) {
		$erros[] = "Nova senha deve ter pelo menos 6 caracteres.";
	}
	
	// Validar status
	if (empty($status) || !in_array($status, ['ativo', 'inativo'])) {
		$erros[] = "Status é obrigatório e deve ser válido.";
	}
	
	// Validar nível
	if (empty($nivel) || !in_array($nivel, ['admin', 'editor'])) {
		$erros[] = "Nível de acesso é obrigatório e deve ser válido.";
	}
	
	// Se há erros, redirecionar com mensagem
	if (!empty($erros)) {
		$mensagem_erro = implode("\\n", $erros);
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=4&id=$id'>
			<script type=\"text/javascript\">
				alert(\"Erro(s) na edição:\\n\\n$mensagem_erro\");
			</script>
		";
		exit;
	}

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