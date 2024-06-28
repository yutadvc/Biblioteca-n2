<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

try {
    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        throw new Exception("Falha na conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $nome_usuario = $_POST['nome_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $livro_id = $_POST['livro_id'];

    // Verifica a disponibilidade do livro
    $sql = "SELECT quantidade FROM cadasto_l WHERE id = $livro_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['quantidade'] > 0) {
            // Inicia uma transação
            $conn->begin_transaction();

            try {
                // Insere a reserva
                $sql = "INSERT INTO reservas (nome_usuario, email_usuario, livro_id) VALUES ('$nome_usuario', '$email_usuario', '$livro_id')";
                $conn->query($sql);

                // Atualiza a quantidade de livros
                $sql = "UPDATE cadasto_l SET quantidade = quantidade - 1 WHERE id = $livro_id";
                $conn->query($sql);

                // Confirma a transação
                $conn->commit();

                echo "Livro reservado com sucesso!";
            } catch (Exception $e) {
                // Desfaz a transação em caso de erro
                $conn->rollback();
                throw $e;
            }
        } else {
            echo "Livro indisponível para reserva.";
        }
    } else {
        echo "Livro não encontrado.";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
} finally {
    // Fecha a conexão
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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