<?php
  include_once('adm/conexao/conexao.php');
  include_once('includes/funcoes.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Page</title>
    <!-- Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome via CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS customizado -->
    <style>
      :root {
          --primary-color: #1e88e5;
          --secondary-color: #009688;
          --dark-blue: #001256;
          --gray-blue: #778899;
      }
      body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          scroll-behavior: smooth;
      }
      .navbar {
          background: linear-gradient(135deg, var(--primary-color), #1565c0);
          box-shadow: 0 2px 10px rgba(0,0,0,0.1);
          transition: all 0.3s ease;
      }
      .navbar-brand {
          font-weight: bold;
          font-size: 1.5rem;
          color: white !important;
      }
      .nav-link {
          color: rgba(255,255,255,0.9) !important;
          font-weight: 500;
          margin: 0 10px;
          transition: all 0.3s ease;
          position: relative;
      }
      .nav-link:hover {
          color: white !important;
          transform: translateY(-2px);
      }
      .section {
          min-height: 100vh;
          padding: 80px 0;
          display: flex;
          align-items: center;
      }
      .section-title {
          font-size: 2.5rem;
          font-weight: bold;
          margin-bottom: 2rem;
          position: relative;
          display: inline-block;
      }
      .section-title::after {
          content: '';
          position: absolute;
          bottom: -10px;
          left: 0;
          width: 60px;
          height: 4px;
          background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
          border-radius: 2px;
      }
      #home {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          color: white;
      }
      .fade-in {
          animation: fadeInUp 1s ease-out;
      }
      @keyframes fadeInUp {
          from {
              opacity: 0;
              transform: translateY(30px);
          }
          to {
              opacity: 1;
              transform: translateY(0);
          }
      }
      .btn-custom {
          background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
          border: none;
          color: white;
          padding: 12px 30px;
          border-radius: 50px;
          font-weight: bold;
          transition: all 0.3s ease;
      }
      .btn-custom:hover {
          transform: translateY(-3px);
          box-shadow: 0 10px 25px rgba(0,0,0,0.2);
          color: white;
      }
    </style>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="70">

    <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-rocket"></i> SimplePage
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Texto à esquerda -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="home-content fade-in">
                        <?php
                        $result_home = "SELECT * FROM home";
                        $stmt_home = db_query($result_home);
                        $row_home = db_fetch_assoc($stmt_home);
                        ?>
                        <h1 class="display-4 fw-bold mb-4"><?php echo $row_home['titulo']; ?></h1>
                        <?php if (!empty($row_home['subtitulo'])): ?>
                            <p class="lead mb-4"><?php echo $row_home['subtitulo']; ?></p>
                        <?php endif; ?>
                        <p class="mb-4"><?php echo $row_home['conteudo']; ?></p>
                        <a href="#about" class="btn btn-custom btn-lg">
                            <i class="fas fa-arrow-down me-2"></i>Saiba Mais
                        </a>
                    </div>
                </div>
                <!-- Imagem à direita -->
                <div class="col-lg-6">
                  <div class="text-center fade-in">
                    <?php 
                    if (!empty($row_home['imagem'])): 
                      $caminho_imagem = './adm/uploads/home/'. $row_home['id'].'/' . $row_home['imagem'];
                      if (file_exists($caminho_imagem)):
                    ?>                            
                      <img src="<?php echo $caminho_imagem; ?>" alt="Imagem Home" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;" />
                    <?php 
                      else: 
                    ?>
                      <div class="placeholder-image bg-light rounded shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-exclamation-triangle fa-5x text-warning"></i>
                        <p class="text-muted mt-2">Imagem não encontrada</p>
                      </div>
                    <?php 
                      endif;
                    else: 
                    ?>
                      <div class="placeholder-image bg-light rounded shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-image fa-5x text-muted"></i>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Imagem à esquerda -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <?php
                    $result_sobre = "SELECT * FROM sobre";
                    $stmt_sobre = db_query($result_sobre);
                    $row_sobre = db_fetch_assoc($stmt_sobre);
                    ?>
                    <div class="text-center fade-in">
                    <?php 
                    if (!empty($row_sobre['imagem'])):
                      $caminho_imagem_sobre = './adm/uploads/sobre/' . $row_sobre['id'] . '/' . $row_sobre['imagem'];
                      if (file_exists($caminho_imagem_sobre)):
                    ?>
                        <img src="<?php echo $caminho_imagem_sobre; ?>" alt="Imagem Sobre" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;" />
                    <?php 
                      else:
                    ?>
                        <div class="placeholder-image bg-light rounded shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                          <i class="fas fa-exclamation-triangle fa-5x text-warning"></i>
                          <p class="text-muted mt-2">Imagem não encontrada</p>
                        </div>
                    <?php
                      endif;
                    else:
                    ?>
                      <div class="placeholder-image bg-light rounded shadow-lg d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-image fa-5x text-muted"></i>
                      </div>
                    <?php endif; ?>
                    </div>
                </div>
                <!-- Texto à direita -->
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="section-title text-dark"><?php echo $row_sobre['titulo']; ?></h2>
                        <?php if (!empty($row_sobre['subtitulo'])): ?>
                            <p class="lead text-muted mb-4"><?php echo $row_sobre['subtitulo']; ?></p>
                        <?php endif; ?>
                        <p class="text-muted"><?php echo $row_sobre['conteudo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Nossos Serviços</h2>
                    <p class="lead text-muted">Oferecemos soluções completas para sua presença digital</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-laptop-code fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Desenvolvimento Web</h5>
                            <p class="card-text text-muted">Criação de sites e sistemas web modernos e responsivos com as melhores tecnologias do mercado.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-palette fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Design Gráfico</h5>
                            <p class="card-text text-muted">Criação de identidade visual e materiais gráficos que representam a essência da sua marca.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-bullhorn fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title">Marketing Digital</h5>
                            <p class="card-text text-muted">Estratégias de marketing e presença digital para aumentar sua visibilidade online.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title text-dark">Entre em Contato</h2>
                    <p class="lead text-muted">Vamos conversar sobre seu próximo projeto</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-body p-5">
                            <form name="CadMsgContato" action="" method="post">
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nome</label>
                                        <input class="form-control" id="name" name="name" placeholder="Seu nome" type="text" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" id="email" name="email" placeholder="seu@email.com" type="email" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="comments" class="form-label">Mensagem</label>
                                    <textarea class="form-control" id="comments" name="comments" placeholder="Descreva seu projeto ou dúvida..." rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-custom btn-lg" type="submit">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-rocket me-2"></i>SimplePage</h5>
                    <p class="text-muted mb-0">Criando experiências digitais incríveis</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">&copy; <?php echo date('Y'); ?> SimplePage. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Scroll spy effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
  </body>
</html>