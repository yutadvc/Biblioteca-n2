
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

                echo "<div class='message-container'>
                <p>Seu livro foi reservado com sucesso! Por favor, dirija-se à biblioteca para retirá-lo.</p>
                <a href='reserva_livro.php' class='btn-voltar'>Voltar para a página inicial</a>
              </div>";
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
    .message-container {
        text-align: center;
        padding: 20px;
        background-color: #f4f4f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 50px auto;
    }

    .message-container p {
        font-size: 18px;
        margin-bottom: 20px;
        color: #333;
    }

    .btn-voltar {
        display: inline-block;
        background-color: #5cb85c;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn-voltar:hover {
        background-color: #4cae4c;
    }
</style>

</body>
</html>
