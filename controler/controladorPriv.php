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
        $res= $this->ci['model']->obtenerCategorias();
        if($res!==false)
                $datos['cat'] = $res;
        $datos['clicks']= $request->getAttribute('clicks');

        $response = $this->ci['vistaPriv']->render($response, "priv_principal.php", $datos);
        return $response;
    }


    /*guarda un nueva pregunta*/
    public function crearPregunta($request, $response, $args){
        $params= $request->getParsedBody();
        $res= $this->ci['model']->crearPregunta($params);

        $this->paginaPrincipal($request, $response, $args);
    }

}
?>
