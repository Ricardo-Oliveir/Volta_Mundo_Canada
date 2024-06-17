<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    }

    $stmt = $conn->prepare("INSERT INTO comments (name, email, comment, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $comment, $image);

    if ($stmt->execute()) {
        echo "Comentário enviado com sucesso!";
    } else {
        echo "Erro ao enviar comentário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
