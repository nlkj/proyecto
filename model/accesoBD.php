<?php

class AccesoBD{
  private $con;

  public function __construct(){
        $pdo = new PDO("mysql:host=localhost;dbname=entrenador_ex", "root");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->con= $pdo;
  }

  public function obtenerCategorias(){
      $sql= "SELECT id, titulo FROM temas;";
      $res= $this->con->query($sql);
      $res= $res->fetchAll();

      return $res;
  }

  public function crearPregunta($params){
    $idPreg= $this->guardarPregunta($params['cat'], $params['preg']);

    for ($i=1; $i <4 ; $i++) {
      if ($params['correcta']==$i)
        $correcta=1;
      else
        $correcta=0;

      $this->guardarRespuesta($params["resp$i"], $correcta, $idPreg);
    }
  }

  private function guardarPregunta($cat, $preg){
    //'limpiar' para acceder BD
    $categoria= $this->con->quote($cat);
    $pregunta= $this->con->quote($preg);

    $sql= "insert into Preguntas(pregunta,tema) values ($pregunta,$categoria);";
    $res = $this->con->exec($sql);

    $sql= "SELECT id FROM preguntas WHERE pregunta= $pregunta AND tema= $categoria;";
    $res= $this->con->query($sql);
    $res= $res->fetch()['id'];

    return $res;
  }

  private function guardarRespuesta($resp, $correcta, $idPreg){
    //'limpiar' para acceder BD
    $respuesta= $this->con->quote($resp);

    $sql= "insert into Respuestas(respuesta, verdadera, pregunta) values ($respuesta,$correcta,$idPreg);";
    $res = $this->con->exec($sql);

    return $res;
  }

}

?>
