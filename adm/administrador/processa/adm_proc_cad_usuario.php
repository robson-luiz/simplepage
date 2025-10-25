<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	
	// Validação dos campos obrigatórios
	$erros = [];
	
	$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
	$email = isset($_POST['email']) ? trim($_POST['email']) : '';
	$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : '';
	$nivel = isset($_POST['nivel']) ? $_POST['nivel'] : '';
	
	// Validar nome
	if (empty($nome) || strlen($nome) < 2) {
		$erros[] = "Nome é obrigatório e deve ter pelo menos 2 caracteres.";
	}
	
	// Validar email
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$erros[] = "E-mail é obrigatório e deve ter um formato válido.";
	}
	
	// Verificar se email já existe
	if (!empty($email)) {
		$check_email = "SELECT id FROM usuarios WHERE email = ?";
		$stmt_check = db_query($check_email, [$email]);
		if (db_fetch_assoc($stmt_check)) {
			$erros[] = "Este e-mail já está cadastrado no sistema.";
		}
	}
	
	// Validar senha
	if (empty($senha) || strlen($senha) < 6) {
		$erros[] = "Senha é obrigatória e deve ter pelo menos 6 caracteres.";
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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=3'>
			<script type=\"text/javascript\">
				alert(\"Erro(s) no cadastro:\\n\\n$mensagem_erro\");
			</script>
		";
		exit;
	}

	$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
	$sql = "INSERT INTO usuarios (nome, email, senha, status, nivel, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
	$stmt = db_query($sql, [$nome, $email, $senha_hash, $status, $nivel]);

	// Se cadastrou, processa imagem
	if (db_affected_rows($stmt) != 0) {
		$usuario_id = db_last_insert_id();
		if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
			$ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
			$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
			if (in_array($ext, $allowed)) {
				$dir = '../../assets/imagens/usuarios/' . $usuario_id . '/';
				if (!is_dir($dir)) {
					mkdir($dir, 0755, true);
				}
				$filename = 'foto.' . $ext;
				$dest = $dir . $filename;
				if (move_uploaded_file($_FILES['imagem']['tmp_name'], $dest)) {
					// Atualiza campo imagem com apenas o nome do arquivo
					$sql_img = "UPDATE usuarios SET imagem = ? WHERE id = ?";
					db_query($sql_img, [$filename, $usuario_id]);
				}
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
				alert(\"Usuário cadastrado com sucesso.\");
			</script>
			";
		}else{
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=2'>
			<script type=\"text/javascript\">
				alert(\"O Usuário não foi cadastrado com sucesso.\");
			</script>
			";
		}	?>
</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>