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
    
       
        $sql =  "INSERT INTO cadastro (titulo, autor, editora, ano, isbn) VALUES('$titulo','$autor','$editora','$ano','$isbn')";
        $sql_consulta = "SELECT log FROM cadastro";
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Livro</h2>
        <form action="processa_cadastro.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>
            
            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora" required>
            
            <label for="ano">Ano de Publicação:</label>
            <input type="number" id="ano" name="ano" required>
            
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required>

            <label for="entrega">Dia da doação:</label>
            <input type="number" id="dia" name="dia" required>

            <input type="submit" value="Cadastrar">
        </form>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</body>
</html>
