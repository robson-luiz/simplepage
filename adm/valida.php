<?php
	session_start();
	include_once("conexao/conexao.php");
	//Verifica se os campos possuem dados

	if((isset($_POST['txt_usuario'])) && (isset($_POST['txt_senha']))){
		$usuario = trim($_POST['txt_usuario']);
		$senha = $_POST['txt_senha'];

		// Busca usuário pelo email
		$sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$usuario]);
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if($resultado && password_verify($senha, $resultado['senha'])){
			$_SESSION['usuarioID'] = $resultado['id'];
			$_SESSION['usuarioNome'] = $resultado['nome'];
			$_SESSION['usuarioNivel'] = $resultado['nivel'];
			$_SESSION['usuarioEmail'] = $resultado['email'];
			if($resultado['nivel'] == 'admin'){
				header("Location: administracao.php");
			}elseif ($resultado['nivel'] == 'editor') {
				header("Location: colaborador.php");
			}else{
				$_SESSION['loginErro'] = "Erro - Entre em contato com o administrador";
				header("Location: index.php");
			}
		}else{
			$_SESSION['loginErro'] = "Usuario ou senha inválida";
			header("Location: index.php");
		}
	}else{
		$_SESSION['loginErro'] = "Usuario ou senha inválida";
		header("Location: index.php");
	}


?>