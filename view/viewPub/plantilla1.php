<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Página principal</title>
    <style>
      div{
        padding-left: 5px;
      }
      p{
        margin-bottom: 0;
      }
      output{
        padding: 5px;
        background-color: lightgreen;
      }
    </style>
    <?php
         //encontrar path
         $path= dirname($_SERVER['PHP_SELF']);
     ?>
  </head>
  <body>
    <h1>Página principal</h1>
    <div>
      <p>clicks:</p><br>
      <output><?php $mens=$data['clicks']; echo $mens; ?></output>
    </div>
    <a href="<?php echo $path;?>/index.php/user">acceso añadir preguntas</a>
  </body>
</html>
