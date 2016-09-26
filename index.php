<?php
    require "vendor/autoload.php";
    require "controladorPriv.php";
    require "middle.php";

    $app= new Slim\App();

    //autenticar
/*
    $app->add(new \Slim\Middleware\HttpBasicAuthentication([
    	"path" => "/user",
    	"users" => [
        	"admin" => "admin"
    	]
]));
*/
    //https
    //$app->add(new \Slim\Middleware\SafeURLMiddleware());


    $c = $app->getContainer();

    $c['bdPriv'] = function(){
        $pdo = new PDO("mysql:host=localhost;dbname=entrenador_ex", "root");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };

    //test Middleware
    $c['path']="aaa";
    $app->add(new Middle($c['bdPriv']));
/*    $app->add(function ($request, $response, $next) {
          $this->path= $request->getUri()->getPath();
          $response = $next($request, $response);
          return $response;
    });*/



    $c['vistaPriv']= new \Slim\Views\PhpRenderer('viewPriv/');
    $c['vistaPub']= new \Slim\Views\PhpRenderer('viewPub/');


    $app->get('/', function($request, $response, $args){
        $data["mensaje"]= $this->path;
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
