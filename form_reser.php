<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Livro</title>
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
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reserva de Livro</h2>
        <form action="processo_reserva.php" method="post">
            <label for="nome_usuario">Nome:</label>
            <input type="text" id="nome_usuario" name="nome_usuario" required>
            
            <label for="email_usuario">E-mail:</label>
            <input type="email" id="email_usuario" name="email_usuario" required>
            
            <label for="livro_id">Selecione o Livro:</label>
            <select id="livro_id" name="livro_id" required>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "biblioteca";

                // Cria a conexão
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verifica a conexão
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                // Obtém os livros disponíveis
                $sql = "SELECT id, titulo, quantidade FROM cadasto_l WHERE quantidade > 0";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['titulo'] . " (Disponíveis: " . $row['quantidade'] . ")</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum livro disponível</option>";
                }

                $conn->close();
                ?>
            </select>
            
            <input class="btn" type="submit" value="Reservar">
        </form>
    </div>
</body> 
</html>
