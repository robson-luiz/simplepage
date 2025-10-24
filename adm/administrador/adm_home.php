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

<!-- Links Rápidos -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Links Rápidos</h6>
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informações do Sistema</h6>
            </div>
            <div class="card-body">
                <p><strong>Último Login:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
                <p><strong>Usuário:</strong> <?php echo $_SESSION['usuarioNome']; ?></p>
                <p><strong>Nível:</strong> <?php echo ucfirst($_SESSION['usuarioNivel']); ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['usuarioEmail']; ?></p>
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
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
</style>