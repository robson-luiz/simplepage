<?php
	include_once("../../conexao/conexao.php");
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
	$conteudo = mysqli_real_escape_string($conn, $_POST['conteudo']);	

	$result_sobre = "UPDATE sobre SET titulo= '$titulo', conteudo= '$conteudo', modified= NOW() WHERE id = '$id' ";
	$resultado_sobre = mysqli_query($conn, $result_sobre);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
</head>
<body><?php
	if(mysqli_affected_rows($conn) != 0){
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/wwwsbl/simplepage/adm/administracao.php?link=16'>
			<script type=\"text/javascript\">
				alert(\"Pagina Sobre alterada com sucesso.\");
			</script>
			";
		}else{
			echo "
			<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/wwwsbl/simplepage/adm/administracao.php?link=16'>
			<script type=\"text/javascript\">
				alert(\"A pagina Sobre não foi alterada com sucesso.\");
			</script>
			";
		}

	?>
</body>
</html>
<?php $conn->close(); ?>