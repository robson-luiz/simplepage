<?php
  include_once('adm/conexao/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php
    include_once('menu.php'); 
    ?>


    <div id="section1" class="container-fluid">
      <?php
        $result_home = "SELECT * FROM home";
        $resultado_home = mysqli_query($conn, $result_home);
        $row_home = mysqli_fetch_assoc($resultado_home);
      ?>
        <h1 class="text-center"><?php echo $row_home['titulo']; ?></h1>
        <hr>
        <p><?php echo $row_home['conteudo']; ?></p>
    </div>

    <div id="section2" class="container-fluid">
      <?php
        $result_sobre = "SELECT * FROM sobre";
        $resultado_sobre = mysqli_query($conn, $result_sobre);
        $row_sobre = mysqli_fetch_assoc($resultado_sobre);
      ?>
        <h1 class="text-center"><?php echo $row_sobre['titulo']; ?></h1>
        <hr>
        <p><?php echo $row_sobre['conteudo']; ?></p>
    </div>

    <div id="section3" class="container-fluid">
      <h1 class="text-center">Serviços</h1>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus convallis auctor faucibus. Aliquam volutpat nisl ut ullamcorper pellentesque.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus convallis auctor faucibus. Aliquam volutpat nisl ut ullamcorper pellentesque. Sed tempor elit nec mauris suscipit varius. Sed semper nisi non augue commodo consequat vel eget enim. Curabitur a venenatis velit. Ut purus lacus, vestibulum id varius sed, vestibulum luctus neque.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus convallis auctor faucibus. Aliquam volutpat nisl ut ullamcorper pellentesque. Sed tempor elit nec mauris suscipit varius. Sed semper nisi non augue commodo consequat vel eget enim. Curabitur a venenatis velit. Ut purus lacus, vestibulum id varius sed, vestibulum luctus neque.</p>
    </div>

    <div id="section4" class="container-fluid">
      <div class="container">          
        <div class="row">     
          <div class="col-sm-12">
              <h1 class="text-center">Contato</h1>
              <hr>
            <form name="CadMsgContato" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-6 form-group">
                      <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                  </div>
                  <div class="col-sm-6 form-group">
                      <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                  </div>
                </div>
                <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
                <div class="row">
                  <div class="col-sm-12 form-group">
                      <button class="btn btn-default" type="submit">Send</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php include_once('footer.php'); ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>