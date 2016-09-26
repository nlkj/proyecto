<?php
require "vendor/autoload.php";


class ControladorPub{
    private $ci;
    private $mens;

    public function __construct(Interop\Container\ContainerInterface $ci){
        $this->ci = $ci;
        $this->mens="";
    }


    /*muestra la página principal*/
 	public function paginaPrincipal($request, $response, $args){
    $data['clicks']= $request->getAttribute('clicks');
    $response= $this->ci['vistaPub']->render($response, "plantilla1.php",$data );
    return $response;

    }

}
?>
