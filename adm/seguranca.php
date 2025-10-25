<?php

	function seguranca_adm(){
		if((empty($_SESSION['usuarioID'])) || (empty($_SESSION['usuarioEmail'])) || (empty($_SESSION['usuarioNivel']))){
			$_SESSION['loginErro'] = "Área restrita";
			header("Location: index.php");
			exit;
		}else{
			if($_SESSION['usuarioNivel'] !== 'admin'){
				$_SESSION['loginErro'] = "Área restrita";
				header("Location: index.php");
				exit;
			}
		}
	}

?>