<?php
include 'database.php';

// Consulta SQL para selecionar os comentários aprovados
$sql = "SELECT name, email, comment, image FROM comments WHERE approved = 1";
$result = $conn->query($sql);

$comments = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comment = array(
            'name' => htmlspecialchars($row['name']),
            'email' => htmlspecialchars($row['email']),
            'comment' => htmlspecialchars($row['comment']),
            'image' => $row['image'] ? 'data:image/jpeg;base64,' . base64_encode($row['image']) : null
        );
        $comments[] = $comment;
    }
}

echo json_encode($comments);
$conn->close();
