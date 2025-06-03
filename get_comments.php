<?php
// Usage of this script is undetermined. Consider removal if no active use-case is found.
include 'database.php';

header('Content-Type: application/json'); // Set content type to JSON

// Consulta SQL para selecionar os comentários aprovados, incluindo image_path
$sql = "SELECT name, email, comment, image_path FROM comments WHERE approved = 1";
$result = $conn->query($sql);

$comments = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comment_data = array(
            'name' => htmlspecialchars($row['name']),
            'email' => htmlspecialchars($row['email']),
            'comment' => htmlspecialchars($row['comment']),
            // Use image_path directly. Ensure it's null if empty or not set.
            'image_path' => !empty($row['image_path']) ? htmlspecialchars($row['image_path']) : null
        );
        $comments[] = $comment_data;
    }
}

echo json_encode($comments);
$conn->close();
?>
