<?php
include_once('adm/conexao/conexao.php');
include_once('includes/funcoes.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['comments']);
    
    // Validações mais robustas
    $erros = [];
    
    // Validar nome
    if (empty($nome)) {
        $erros[] = 'O campo nome é obrigatório.';
    } elseif (strlen($nome) < 2) {
        $erros[] = 'O nome deve ter pelo menos 2 caracteres.';
    } elseif (strlen($nome) > 100) {
        $erros[] = 'O nome não pode ter mais de 100 caracteres.';
    }
    
    // Validar email
    if (empty($email)) {
        $erros[] = 'O campo e-mail é obrigatório.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'Por favor, insira um e-mail válido.';
    } elseif (strlen($email) > 100) {
        $erros[] = 'O e-mail não pode ter mais de 100 caracteres.';
    }
    
    // Validar mensagem
    if (empty($mensagem)) {
        $erros[] = 'O campo mensagem é obrigatório.';
    } elseif (strlen($mensagem) < 10) {
        $erros[] = 'A mensagem deve ter pelo menos 10 caracteres.';
    } elseif (strlen($mensagem) > 1000) {
        $erros[] = 'A mensagem não pode ter mais de 1000 caracteres.';
    }
    
    // Se há erros, redireciona com a lista de erros
    if (!empty($erros)) {
        $erro_msg = implode(' ', $erros);
        header("Location: index.php?erro=validacao&msg=" . urlencode($erro_msg) . "#contact");
        exit;
    }
    
    // Sanitizar dados
    $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $mensagem = htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');
    
    try {
        $sql = "INSERT INTO contatos (nome, email, mensagem, status, data_criacao) VALUES (?, ?, ?, 'novo', NOW())";
        $stmt = db_query($sql, [$nome, $email, $mensagem]);
        
        if (db_affected_rows($stmt) > 0) {
            header("Location: index.php?sucesso=contato_enviado#contact");
        } else {
            header("Location: index.php?erro=erro_interno#contact");
        }
        
    } catch (Exception $e) {
        error_log("Erro ao processar contato: " . $e->getMessage());
        header("Location: index.php?erro=erro_interno#contact");
    }
} else {
    header("Location: index.php#contact");
}
exit;
?>