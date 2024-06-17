<?php
include 'database.php';

// Consulta SQL para selecionar todos os comentários
$sql = "SELECT id, name, email, comment FROM comments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $comments = array();
    while ($row = $result->fetch_assoc()) {
        $comments[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'comment' => $row['comment']
        );
    }

    // Saída JSON
    header('Content-Type: application/json');
    echo json_encode($comments, JSON_PRETTY_PRINT);
} else {
    echo json_encode(array('message' => 'Nenhum comentário encontrado.'), JSON_PRETTY_PRINT);
}

$conn->close();
