<?php
require "vendor/autoload.php";

class ControladorPriv{
    private $ci;
    private $mens;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->ci = $ci;
        $this->mens="";
    }


    /*muestra la página principal*/
 	public function paginaPrincipal($request, $response, $args){

        $datos['mens']= $this->mens;
        if(($res= $this->obtenerCategorias())!==false)
                $datos['cat'] = $res;

        $response = $this->ci['vistaPriv']->render($response, "priv_principal.php", $datos);
        return $response;
    }


    /*guarda un nueva pregunta*/
    public function crearPregunta($request, $response, $args){
        $params= $request->getParsedBody();

        $idPreg= $this->guardarPregunta($params['cat'], $params['preg']);

        for ($i=1; $i <4 ; $i++) {
          if ($params['correcta']==$i)
            $correcta=1;
          else
            $correcta=0;

          $this->guardarRespuesta($params["resp$i"], $correcta, $idPreg);
        }

        $this->paginaPrincipal($request, $response, $args);
    }

    private function obtenerCategorias(){
        $sql= "SELECT id, titulo FROM temas;";
        $res= $this->ci['bdPriv']->query($sql);
        $res= $res->fetchAll();

        return $res;
    }

    private function guardarPregunta($cat, $preg){
      //'limpiar' para acceder BD
      $categoria= $this->ci['bdPriv']->quote($cat);
      $pregunta= $this->ci['bdPriv']->quote($preg);

      $sql= "insert into Preguntas(pregunta,tema) values ($pregunta,$categoria);";
      $res = $this->ci['bdPriv']->exec($sql);

      $sql= "SELECT id FROM preguntas WHERE pregunta= $pregunta AND tema= $categoria;";
      $res= $this->ci['bdPriv']->query($sql);
      $res= $res->fetch()['id'];

  		return $res;
    }

    private function guardarRespuesta($resp, $correcta, $idPreg){
      //'limpiar' para acceder BD
      $respuesta= $this->ci['bdPriv']->quote($resp);

      $sql= "insert into Respuestas(respuesta, verdadera, pregunta) values ($respuesta,$correcta,$idPreg);";
      $res = $this->ci['bdPriv']->exec($sql);

  		return $res;
    }


}
?>
