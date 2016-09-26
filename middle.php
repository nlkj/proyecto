<?php
//require "vendor/autoload.php";

class Middle{
  private $db;

  public function __construct($db){
    $this->db= $db;

    /* crear tabla estadísticas si no existe*/
    $sql = "create table  IF NOT EXISTS Estadisticas(ruta varchar(20),clics int DEFAULT 0);";
    $db->exec($sql);

  }


    public function __invoke($request, $response, $next){
      $path= $request->getUri()->getPath();
      if(($clics= $this->clickCount($path))!== false){
        $clics++;
        $sql= "update Estadisticas set clics=$clics where ruta=\"$path\";";
		      $res = $this->db->exec($sql);
      }
      else{
        $sql = "insert into Estadisticas(ruta,clics) values(\"$path\", 1);";
        $res = $this->db->exec($sql);
      }

      $response = $next($request, $response);
      return $response;
    }

    private function clickCount($path){
      $sql= "SELECT clics FROM Estadisticas WHERE ruta= \"$path\";";
      $res= $this->db->query($sql);
      if($res!== false){
        $res= $res->fetch()['clics'];
      }

      return $res;
    }
  }
?>
