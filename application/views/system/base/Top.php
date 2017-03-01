<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="utf-8">
   <title>
<?php
   echo getD3D("page_act"); 
?>
   </title>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
   <link rel="shortcut icon" href="<?php echo URL_BASE; ?>images/favicon.ico" />
   <link rel="stylesheet" media="all" type="text/css" href="<?php echo URL_BASE; ?>css/style.css" />   
   <link rel="stylesheet" href="<?php echo URL_BASE; ?>css/pushy.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <link href="<?php echo URL_BASE; ?>css/bootstrap.min.css" rel="stylesheet">
   <script src="<?php echo URL_BASE; ?>js/jquery.min.js"></script>
   <script src="<?php echo URL_BASE; ?>js/bootstrap.min.js"></script>
   <link href="https://fonts.googleapis.com/css?family=Dosis|Lato" rel="stylesheet"> 
</head>
<body>
   <?php include_once( DIR_BASE ."php/analyticstracking.php") ?>
   <div class="logos">
      <div class="rellenar"></div>
      <div class="page" style="z-index:99; position:relative">
         <img src="<?php echo URL_BASE; ?>img/triangulo_color.png" 
              style="float:left;margin-top:-2px; margin-bottom:2px; margin-left:100px;height:120px;margin-bottom:12px;"/>
         <div style="position:absolute; left:0px; top:20px; visibility:visible z-index:2;"> 
            <img src="<?php echo URL_BASE; ?>img/logo_PO.png" style="float:right;"/>
            <map name="Map1">
               <area shape="rect" coords="0,0,500,100" href="#">    
            </map>
         </div>
         <!--a href="#" style=""-->
            <img alt="Editar logotipo" src="<?php echo URL_BASE; ?>img/logotop.png" style="float:right;width:150px;height:90px;margin-top:10px;" />
         <!--/a-->
         <br><br>
      </div>
   </div>

