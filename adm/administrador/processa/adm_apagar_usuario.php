<?php
	include_once("../../conexao/conexao.php");
	include_once("../../includes/funcoes.php");
	$id = $_GET['id'];

	// Busca o nome da imagem e prepara o caminho da pasta
	$sql_img = "SELECT imagem FROM usuarios WHERE id = ?";
	$stmt_img = db_query($sql_img, [$id]);
	$row_img = db_fetch_assoc($stmt_img);
	$user_dir = '../../assets/imagens/usuarios/' . $id . '/';

	$sql = "DELETE FROM usuarios WHERE id = ?";
	$stmt = db_query($sql, [$id]);

	// Remove a pasta e imagens do usuário se o DELETE foi bem-sucedido
	if (db_affected_rows($stmt) != 0) {
		if (is_dir($user_dir)) {
			// Função para remover diretório e arquivos
			function rrmdir($dir) {
				if (is_dir($dir)) {
					$objects = scandir($dir);
					foreach ($objects as $object) {
						if ($object != "." && $object != "..") {
							$path = $dir . DIRECTORY_SEPARATOR . $object;
							if (is_dir($path)) {
								rrmdir($path);
							} else {
								unlink($path);
							}
						}
					}
					rmdir($dir);
				}
			}
			rrmdir($user_dir);
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
					alert(\"Usuário apagado com sucesso.\");
				</script>
				";
			}else{
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/simplepage/adm/administracao.php?link=2'>
				<script type=\"text/javascript\">
					alert(\"O Usuário não foi apagado com sucesso.\");
				</script>
				";
			}		?>
	</body>
</html>
<?php /* PDO não precisa fechar explicitamente */ ?>