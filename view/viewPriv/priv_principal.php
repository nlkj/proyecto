<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Crear preguntas</title>
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
         $path= explode("index.php",$path, -1)[0];
     ?>
  </head>
  <body>
    <h1>Crear pregunta</h1>
    <div>
      <p>clicks:</p><br>
      <output><?php $mens=$data['clicks']; echo $mens; ?></output>
    </div>
    <a href="<?php echo $path;?>">acceso zona pública</a>
    <h3><?php $r=$data['mens']; echo $r; ?> </h3>

    <!----------------------------------------!>
    <?php
    if(isset($data['cat'])){
    	if($data['cat']){
    ?>

      <form method="post" action="<?php echo $path;?>index.php/user/pregunta">
          <p>Categoría</p>
        		<?php
        		foreach ($data['cat'] as $fila) {
        			echo "<input type='radio' name='cat' value={$fila['id']} id='c{$fila['id']}' required>";
        			echo "<label for='c{$fila['id']}'>{$fila['titulo']}</label><br>";
        		}
        		?>
          <p>pregunta</p>
          <textarea rows="4" cols="50" name="preg">
          </textarea>

          <p>respuesta 1</p>
          <textarea rows="2" cols="50" name= "resp1">
          </textarea>

          <p>respuesta 2</p>
          <textarea rows="2" cols="50" name= "resp2">
          </textarea>

          <p>respuesta 3</p>
          <textarea rows="2" cols="50" name= "resp3">
          </textarea>
          <br>

          <p>Respuesta correcta</p>
          <?php
          for($i=1; $i<4; $i++){
            echo "<input type='radio' name='correcta' value=$i id='r{$i}' required>";
            echo "<label for='r{$i}'>$i</label><br>";
          }
          ?>



      		<input type="submit" name="Enviar">

    </form>

    <?php
    	}
    	else
    		echo "<p><strong>No hay categorías vacías</strong><p>";
    }
    ?>
    <!-----------------------------------------------------!>



  </body>
</html>
