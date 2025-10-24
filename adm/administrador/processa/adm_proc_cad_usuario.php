<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	$nome = $_POST['nome'];
	$email = $_POST['email'];

	$senha = $_POST['senha'];
	$status = $_POST['status'];
	$nivel = $_POST['nivel'];


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
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../../../administracao.php?link=2'>
			<script type=\"text/javascript\">
				alert(\"Usuário cadastrado com sucesso.\");
			</script>
			";
		}else{
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../../../administracao.php?link=2'>
			<script type=\"text/javascript\">
				alert(\"O Usuário não foi cadastrado com sucesso.\");
			</script>
			";
		}	?>
</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>