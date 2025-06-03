<?php
include 'database.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// CSRF Token Generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Handle Delete Action
if (isset($_POST['delete_id'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token.");
    }
    $delete_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        // Optional: Regenerate token after successful action
        // $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: comments.php");
        exit();
    } else {
        echo "Erro ao excluir o comentário.";
    }
}

// Handle Approve Action
if (isset($_POST['approve_id'])) {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token.");
    }
    $approve_id = $_POST['approve_id'];
    $stmt = $conn->prepare("UPDATE comments SET approved = TRUE WHERE id = ?");
    $stmt->bind_param("i", $approve_id);
    if ($stmt->execute()) {
        // Optional: Regenerate token after successful action
        // $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header("Location: comments.php");
        exit();
    } else {
        echo "Erro ao aprovar o comentário.";
    }
}

// Select image_path as well. The old 'image' column (blob) is no longer primarily used for display.
$sql = "SELECT id, name, email, comment, image, image_path, approved FROM comments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Comentários</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Sair</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Comentário</th>
                    <th>Imagem</th>
                    <th>Ação</th> <!-- Adicionando uma coluna para ação (excluir/aprovar) -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['comment']) . "</td>";
                        // Display image using image_path
                        if (!empty($row['image_path'])) {
                            echo "<td><img src='" . htmlspecialchars($row['image_path']) . "' alt='Image' width='100' height='100' style='object-fit: cover;'></td>";
                        } else {
                            // Fallback for very old comments that might still have blob and no path
                            // This part can be removed if no such fallback is needed or after migration
                            if ($row['image']) { 
                                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Image (Legacy)' width='100' height='100' style='object-fit: cover;'></td>";
                            } else {
                                echo "<td>N/A</td>";
                            }
                        }
                        // Botões para excluir e aprovar o comentário
                        echo "<td>";
                        // Delete Form
                        echo "<form method='POST' action='comments.php' style='display:inline-block;'>";
                        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='csrf_token' value='" . htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') . "'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>Excluir</button>";
                        echo "</form> ";

                        if (!$row['approved']) {
                            // Approve Form
                            echo "<form method='POST' action='comments.php' style='display:inline-block;'>";
                            echo "<input type='hidden' name='approve_id' value='" . $row['id'] . "'>";
                            echo "<input type='hidden' name='csrf_token' value='" . htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') . "'>";
                            echo "<button type='submit' class='btn btn-success btn-sm'>Aprovar</button>";
                            echo "</form>";
                        } else {
                            echo "Aprovado";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum comentário encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>