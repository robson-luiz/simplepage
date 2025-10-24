<?php
	//Conexão com o banco de dados PDO
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "simplepage";

	try {
		$conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8mb4", $usuario, $senha);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die("Falha na conexao: " . $e->getMessage());
	}


?>