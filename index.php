<?php
    require "vendor/autoload.php";
    require "controladorPriv.php";

    $app= new Slim\App();

    $app->add(new \Slim\Middleware\HttpBasicAuthentication([
    	"path" => "/user",
    	"users" => [
        	"admin" => "admin"
    	]
]));

    $c = $app->getContainer();

    $c['bdPriv'] = function(){
        $pdo = new PDO("mysql:host=localhost;dbname=entrenador_ex", "root");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };

    $c['vistaPriv']= new \Slim\Views\PhpRenderer('viewPriv/');
    $c['vistaPub']= new \Slim\Views\PhpRenderer('viewPub/');


    $app->get('/', function($request, $response, $args){
        //$response->write("<h1>Hola</h1>");
        //return $response;
        $data["mensaje"]= "Holaaa";
        $response= $this->vistaPub->render($response, "plantilla1.php",$data );
        return $response;
    });


    /*****************zona privada***********************/
    //mostrar página principal
	  $app->get('/user', '\ControladorPriv:paginaPrincipal');
    //crear pregunta
    $app->post('/user/pregunta', '\ControladorPriv:crearPregunta');

    $app->run();
?>
