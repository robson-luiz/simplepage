<?php
include_once('conexao/conexao.php');
include_once('includes/funcoes.php');

// Buscar estatísticas do sistema
$stmt_users = db_query("SELECT COUNT(*) as total FROM usuarios");
$total_users = db_fetch_assoc($stmt_users)['total'];

$stmt_home = db_query("SELECT COUNT(*) as total FROM home");
$total_home = db_fetch_assoc($stmt_home)['total'];

$stmt_sobre = db_query("SELECT COUNT(*) as total FROM sobre");
$total_sobre = db_fetch_assoc($stmt_sobre)['total'];

$stmt_contatos = db_query("SELECT COUNT(*) as total FROM contatos WHERE status = 'novo'");
$total_contatos_novos = db_fetch_assoc($stmt_contatos)['total'];

$stmt_contatos_total = db_query("SELECT COUNT(*) as total FROM contatos");
$total_contatos_total = db_fetch_assoc($stmt_contatos_total)['total'];

$stmt_servicos = db_query("SELECT COUNT(*) as total FROM servicos");
$total_servicos = db_fetch_assoc($stmt_servicos)['total'];
?>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
    </div>
</div>

<!-- Cards de Estatísticas -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuários</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Páginas Home</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_home; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Páginas Sobre</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_sobre; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Contatos Novos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_contatos_novos; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Segunda linha de estatísticas -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Serviços</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_servicos; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cogs fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total de Contatos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_contatos_total; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Links Rápidos -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Links Rápidos - Conteúdo</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="administracao.php?link=2" class="list-group-item list-group-item-action">
                        <i class="fas fa-users text-primary"></i> Gerenciar Usuários
                    </a>
                    <a href="administracao.php?link=14" class="list-group-item list-group-item-action">
                        <i class="fas fa-home text-success"></i> Editar Página Home
                    </a>
                    <a href="administracao.php?link=16" class="list-group-item list-group-item-action">
                        <i class="fas fa-info-circle text-info"></i> Editar Página Sobre
                    </a>
                    <a href="administracao.php?link=18" class="list-group-item list-group-item-action">
                        <i class="fas fa-cogs text-dark"></i> Gerenciar Serviços
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-warning">Mensagens de Contato</h6>
                <?php if($total_contatos_novos > 0): ?>
                    <span class="badge bg-danger"><?php echo $total_contatos_novos; ?> nova(s)</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="administracao.php?link=22" class="list-group-item list-group-item-action">
                        <i class="fas fa-envelope text-warning"></i> Todas as Mensagens 
                        <span class="badge bg-secondary ms-2"><?php echo $total_contatos_total; ?></span>
                    </a>
                    <?php if($total_contatos_novos > 0): ?>
                    <a href="administracao.php?link=22&status=novo" class="list-group-item list-group-item-action list-group-item-warning">
                        <i class="fas fa-envelope text-danger"></i> Mensagens Novas 
                        <span class="badge bg-danger ms-2"><?php echo $total_contatos_novos; ?></span>
                    </a>
                    <?php endif; ?>
                    <a href="administracao.php?link=22&status=respondido" class="list-group-item list-group-item-action">
                        <i class="fas fa-reply text-success"></i> Mensagens Respondidas
                    </a>
                    <a href="administracao.php?link=22&status=arquivado" class="list-group-item list-group-item-action">
                        <i class="fas fa-archive text-secondary"></i> Mensagens Arquivadas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informações do Sistema -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informações do Sistema</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Usuário Logado:</strong> <?php echo $_SESSION['usuarioNome']; ?></p>
                        <p><strong>Email:</strong> <?php echo $_SESSION['usuarioEmail']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nível de Acesso:</strong> <?php echo ucfirst($_SESSION['usuarioNivel']); ?></p>
                        <p><strong>Último Acesso:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.border-left-dark {
    border-left: 0.25rem solid #5a5c69 !important;
}
.border-left-secondary {
    border-left: 0.25rem solid #858796 !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
.list-group-item-warning {
    background-color: #fff3cd;
    border-color: #ffecb5;
}
</style>