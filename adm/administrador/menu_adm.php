<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Simple Page - Dashboard</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuário<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="administracao.php?link=2">Listar Usuários</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Páginas<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="administracao.php?link=14">Home</a></li>
            <li><a href="administracao.php?link=16">Sobre</a></li>
            <li><a href="administracao.php?link=#">Serviços</a></li>
            <li><a href="administracao.php?link=#">Contato</a></li>
          </ul>
        </li>
      </ul>
      <div class="navbar-form navbar-right">
        <a href="sair.php"><button type="submit" class="btn btn-danger">Sair</button></a>
      </div>
    </div><!--/.nav-collapse -->
  </div>
</nav>