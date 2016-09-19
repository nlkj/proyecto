<?php
require "vendor/autoload.php";

class ControladorPriv{
    private $ci;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->ci = $ci;
    }


    /*muestra la página principal*/
 	public function paginaPrincipal($request, $response, $args){

        if(($res= $this->obtenerArticulos())!==false)
                $datos['listArtic'] = $res;
        if(($res= $this->obtenerCategoriasVacias())!==false)
                $datos['catVacias'] = $res;

        $datos['mensaje']= $this->mensaje;
        $response = $this->ci['viewPriv']->render($response, "principal.php", $datos);

        return $response;
    }


    /*guarda un nuevo artículo*/
    public function crearArticulo($request, $response, $args){
        $params= $request->getParsedBody();

        $art->guardar($params['titulo'],$imagen,$params['contenido'],$params['categoria']);
        $ok= $art->guardarBD();

        if(!$ok)
            $this->mensaje=[false, "Error al crear artículo"];
        else
            $this->mensaje=[true, "Artículo {$params['titulo']} creado"];

        $this->paginaPrincipal($request, $response, $args);
    }


}
