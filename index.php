<?php
  include_once('adm/conexao/conexao.php');
  include_once('includes/funcoes.php');
  
  // Verifica se há mensagens de feedback
  $mensagem_sucesso = '';
  $mensagem_erro = '';
  
  if (isset($_GET['sucesso'])) {
      switch ($_GET['sucesso']) {
          case 'contato_enviado':
              $mensagem_sucesso = 'Mensagem enviada com sucesso! Entraremos em contato em breve.';
              break;
      }
  }
  
  if (isset($_GET['erro'])) {
      switch ($_GET['erro']) {
          case 'campos_obrigatorios':
              $mensagem_erro = 'Por favor, preencha todos os campos obrigatórios.';
              break;
          case 'email_invalido':
              $mensagem_erro = 'Por favor, insira um e-mail válido.';
              break;
          case 'erro_interno':
              $mensagem_erro = 'Ocorreu um erro interno. Tente novamente mais tarde.';
              break;
          case 'validacao':
              $mensagem_erro = isset($_GET['msg']) ? urldecode($_GET['msg']) : 'Erro de validação.';
              break;
      }
  }
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
    <link href="css/style.css" rel="stylesheet">
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
                <?php
                $result_servicos = "SELECT * FROM servicos WHERE status = 'ativo' ORDER BY ordem ASC";
                $stmt_servicos = db_query($result_servicos);
                while ($row_servicos = db_fetch_assoc($stmt_servicos)) {
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas <?php echo $row_servicos['icone']; ?> fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title"><?php echo $row_servicos['titulo']; ?></h5>
                            <p class="card-text text-muted"><?php echo $row_servicos['descricao']; ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
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
                            <?php if ($mensagem_sucesso): ?>
                                <div class="alert alert-custom alert-success-custom">
                                    <i class="fas fa-check-circle me-2"></i><?php echo $mensagem_sucesso; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($mensagem_erro): ?>
                                <div class="alert alert-custom alert-danger-custom">
                                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $mensagem_erro; ?>
                                </div>
                            <?php endif; ?>
                            
                            <form name="CadMsgContato" action="processa_contato.php" method="post" onsubmit="return validarFormulario()" novalidate>
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                                        <input class="form-control" id="name" name="name" placeholder="Seu nome completo" type="text" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                                        <input class="form-control" id="email" name="email" placeholder="seu@email.com" type="email" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="comments" class="form-label">Mensagem <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="comments" name="comments" placeholder="Descreva seu projeto ou dúvida... (mínimo 10 caracteres)" rows="5" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-custom btn-lg" type="submit" id="btnEnviar">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                                    </button>
                                </div>
                                <div class="text-center mt-3">
                                    <small class="text-muted"><span class="text-danger">*</span> Campos obrigatórios</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-rocket me-2"></i>SimplePage</h5>
                    <p>Transformando ideias em soluções digitais inovadoras. Criamos experiências únicas que conectam marcas e pessoas.</p>
                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Nossos Serviços</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#services" class="text-light"><i class="fas fa-laptop-code me-2"></i>Desenvolvimento Web</a></li>
                        <li class="mb-2"><a href="#services" class="text-light"><i class="fas fa-palette me-2"></i>Design Gráfico</a></li>
                        <li class="mb-2"><a href="#services" class="text-light"><i class="fas fa-bullhorn me-2"></i>Marketing Digital</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Contato</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>contato@simplepage.com</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>(11) 99999-9999</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>São Paulo, SP</li>
                        <li class="mb-2"><i class="fas fa-clock me-2"></i>Seg - Sex: 9h às 18h</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> SimplePage. Todos os direitos reservados. Desenvolvido por Robson Luiz</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript customizado -->
    <script src="js/script.js"></script>
  </body>
</html>