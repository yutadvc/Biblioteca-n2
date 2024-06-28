<?php 
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "biblioteca";

    $conn = mysqli_connect($host,$user,$password,$database);

    if (mysqli_connect_errno()){
        die("Não vai dar não BD foi de base".$conn ->connect_error);
    }

    if($_SERVER ["REQUEST_METHOD"] == "POST"){
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $editora = $_POST['editora'];
        $ano = $_POST['ano'];
        $isbn = $_POST['isbn'];
        $quantidade = $_POST['quantidade'];
    
       
        $sql =  "INSERT INTO cadasto_l (titulo, autor, editora, ano, isbn, quantidade) VALUES('$titulo','$autor','$editora','$ano','$isbn', $quantidade)";
        $sql_consulta = "SELECT log FROM cadasto_l";
        $resultado = mysqli_query($conn, $sql_consulta);

        if($conn -> query($sql) == TRUE){
            echo "Dados inseridos com sucesso";
        } else{
            echo "Dados errados";
        }

      $conn -> close();
    }else{
        header("location: index.html");
        exit();
    }
?>;
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <button><a href="index.html"> Sair!</a></button>


    <style>
        a{
            text-decoration: none;
            color: red;
        }
        </style>
        ,

</body>
</html>