<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao/conexao.php");
	seguranca_adm();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administração</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="lib/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
                selector: 'textarea#editable',
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
                ],
                toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });</script>
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include_once("administrador/menu_adm.php");

    	$pag[1] = "administrador/adm_home.php";
    	$pag[2] = "administrador/listar/adm_listar_usuario.php";
    	$pag[3] = "administrador/cadastro/adm_cad_usuario.php";
        $pag[4] = "administrador/editar/adm_editar_usuario.php";
        $pag[5] = "administrador/visualizar/adm_visual_usuario.php";
        //$pag[6] = "administrador/listar/adm_listar_situacao.php";
        //$pag[7] = "administrador/cadastro/adm_cad_situacao.php";
        //$pag[8] = "administrador/editar/adm_editar_situacao.php";
        //$pag[9] = "administrador/visualizar/adm_visual_situacao.php";
        //$pag[10] = "administrador/listar/adm_listar_nivel.php";
        //$pag[11] = "administrador/cadastro/adm_cad_nivel.php";
        //$pag[12] = "administrador/editar/adm_editar_nivel.php";
        //$pag[13] = "administrador/visualizar/adm_visual_nivel.php";
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>