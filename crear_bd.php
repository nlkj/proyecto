<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd</title>
    </head>
    <body>
        <h1>Creación de una bd</h1>
        <?php
        /* Nos conectamos al SGBD */
        try{
            $conexion = new PDO("mysql:host=localhost", "root");
        }catch(PDOException $e){
            echo "Error: ".$e->getMessage();
            die();
        }

        /* borrar base de datos */
        $sql = "drop database if exists entrenador_ex;";
        $res = $conexion->exec($sql);


        /* Crear la BD */
        $sql = "create database entrenador_ex;";
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la base de datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>base de datos creada.</p>";
        }

        /* Conectar a la base de datos */
        $sql = "use entrenador_ex;";
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido conectar a la base de datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Conectados!!!!</p>";
        }

        /* Crear tabla Temas */
        $sql = <<<sql
create table Temas(
    id int primary key auto_increment,
    titulo varchar(100),
    titulo_url varchar(110)
);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la tabla Temas.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Tabla Temas creada!!!</p>";
        }

        /* Crear tabla Preguntas */
        $sql = <<<sql
create table Preguntas(
    id int primary key auto_increment,
    pregunta text,
    pregunta_url varchar(5),
    tema int,
    foreign key(tema) references Temas(id)
);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la tabla Preguntas.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Tabla Temas creada!!!</p>";
        }


        /* Crear tabla Respuestas */
        $sql = <<<sql
create table Respuestas(
    id int primary key auto_increment,
    respuesta text,
    verdadera bit,
    pregunta int,
    foreign key(pregunta) references Preguntas(id)
);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>No se ha podido crear la tabla Respuestas.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Tabla Respuestas creada!!!</p>";
        }



        /* Insert temas */
        $sql = <<<sql
insert into Temas(titulo,titulo_url) values
("tornillos", "tornillos"),
("mates", "mates");
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>Error al añadir datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Se han añadido $res filas</p>";
        }

        /* Insert Preguntas */
        $sql = <<<sql
insert into Preguntas(pregunta, tema) values
("¿Te gustan los tornillos?",1),
("¿Deseas conocer más sobre el mundo de los tornillos?",1);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>Error al añadir datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Se han añadido $res filas</p>";
        }

        /* Insert Respuestas */
        $sql = <<<sql
insert into Respuestas(respuesta, verdadera, pregunta) values
("sí",1,1),
("no",0,1),
("depende del día",0,1),
("sí",1,2),
("no",0,2),
("depende del día",0,2);
sql;
        $res = $conexion->exec($sql);
        if($res===FALSE){
            echo "<p>Error al añadir datos.</p>";
            echo "<p>".$conexion->errorInfo()[2]."</p>";
        }else{
            echo "<p>Se han añadido $res filas</p>";
        }

        ?>
    </body>
</html>
