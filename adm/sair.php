<?php
	session_start();
	unset(
		$_SESSION['usuarioID'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioNiveisAcessoId'],
		$_SESSION['usuarioEmail']
	);

	$_SESSION['loginDeslogado'] = "Deslogado com sucesso";
	header("Location: index.php");
?>