<?php
    require "vendor/autoload.php";
    require_once "model/accesoBD.php";
    require_once "controler/controladorPriv.php";
    require_once "controler/controladorPub.php";
    require "clickCount.php";

    $app= new Slim\App();

    $c = $app->getContainer();

    $c['bdPriv'] = function(){
        $pdo = new PDO("mysql:host=localhost;dbname=entrenador_ex", "root");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };

    //test Middleware
    $app->add(new ClickCount($c['bdPriv']));

    //autenticar
    $app->add(new \Slim\Middleware\HttpBasicAuthentication([
    	"path" => "/user",
    	"users" => [
        	"admin" => "admin"
    	]
]));

    //https
    $app->add(new \Slim\Middleware\SafeURLMiddleware());



    $c['vistaPriv']= new \Slim\Views\PhpRenderer('view/viewPriv/');
    $c['vistaPub']= new \Slim\Views\PhpRenderer('view/viewPub/');
    $c['model']=new AccesoBD();

    /*****************zona pública***********************/
    /*$app->get('/', function($request, $response, $args){
        $data["mensaje"]= "";
        $data['clicks']= $request->getAttribute('clicks');
        $response= $this->vistaPub->render($response, "plantilla1.php",$data );
        return $response;
    });*/
    //mostrar página principal
    $app->get('/', '\ControladorPub:paginaPrincipal');

    /*****************zona privada***********************/
    //mostrar página principal
	  $app->get('/user', '\ControladorPriv:paginaPrincipal');
    //crear pregunta
    $app->post('/user/pregunta', '\ControladorPriv:crearPregunta');

    $app->run();
?>
