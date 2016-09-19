<?php
    require "vendor/autoload.php";

    $app= new Slim\App(); 
    $c = $app->getContainer();

    /*//$c['bd'] = function(){
        $pdo = new PDO("mysql:host=localhost;dbname=entrenador_ex", "root");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //return $pdo;
    //};*/

    //$c['view']= new \Slim\Views\PhpRenderer('view/');
    $c['vista']= new \Slim\Views\PhpRenderer('view/');


    $app->get('/', function($request, $response, $args){
        //$response->write("<h1>Hola</h1>");
        //return $response;
        $data["mensaje"]= "Holaaa";
        $response= $this->vista->render($response, "plantilla1.php",$data );
        return $response;
    });


    /*****************zona privada***********************/
    //mostrar página principal
	  $app->get('/user', '\ControladorPriv:paginaPrincipal');
    //crear pregunta
    $app->post('/user/pregunta', '\ControladorPriv:crearPregunta');

    $app->run();
?>
