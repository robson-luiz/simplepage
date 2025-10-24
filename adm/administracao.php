<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao/conexao.php");
	seguranca_adm();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePage | Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- TinyMCE -->
    <script src="lib/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
                selector: 'textarea#editable',
                plugins: [
                    'advlist autolink lists link image charmap preview anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media table contextmenu paste textcolor colorpicker textpattern imagetools codesample'
                ],
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
                image_advtab: true,
                height: 400,
                content_css: ['//fonts.googleapis.com/css?family=Lato:300,300i,400,400i']
            });</script>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #1e88e5;
            color: #fff;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        .sidebar-header h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li a {
            display: block;
            padding: 0.9rem 1.5rem;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .sidebar-menu li a:hover, .sidebar-menu li a.active {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .content-area {
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
  <body>
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-layer-group me-2"></i>SimplePage</h4>
        </div>
        <ul class="sidebar-menu">
            <li><a href="administracao.php" class="<?php echo empty($_GET['link']) ? 'active' : ''; ?>"><i class="fas fa-home me-2"></i>Dashboard</a></li>
            <li><a href="administracao.php?link=2"><i class="fas fa-users me-2"></i>Usuários</a></li>
            <li><a href="administracao.php?link=14"><i class="fas fa-home me-2"></i>Página Home</a></li>
            <li><a href="administracao.php?link=16"><i class="fas fa-info-circle me-2"></i>Página Sobre</a></li>
            <li><a href="sair.php"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Painel Administrativo</h5>
            </div>
            <div>
                <i class="fas fa-user-circle me-2"></i><?php echo $_SESSION['usuarioNome']; ?>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            <?php
            $pag[1] = "administrador/adm_home.php";
            $pag[2] = "administrador/listar/adm_listar_usuario.php";
            $pag[3] = "administrador/cadastro/adm_cad_usuario.php";
            $pag[4] = "administrador/editar/adm_editar_usuario.php";
            $pag[5] = "administrador/visualizar/adm_visual_usuario.php";
            $pag[14] = "administrador/visualizar/adm_visual_pag_home.php";
            $pag[15] = "administrador/editar/adm_editar_pag_home.php";
            $pag[16] = "administrador/visualizar/adm_visual_pag_sobre.php";
            $pag[17] = "administrador/editar/adm_editar_pag_sobre.php";

              if(!empty($_GET["link"])){
                $link = $_GET["link"];
                if(file_exists($pag[$link])){
                  include $pag[$link];
                }else{
                  include "administrador/adm_home.php";
                }
              }else{
                include "administrador/adm_home.php";
              }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>