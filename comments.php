<?php
include 'database.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        header("Location: comments.php");
        exit();
    } else {
        echo "Erro ao excluir o comentário.";
    }
}

if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $stmt = $conn->prepare("UPDATE comments SET approved = TRUE WHERE id = ?");
    $stmt->bind_param("i", $approve_id);
    if ($stmt->execute()) {
        header("Location: comments.php");
        exit();
    } else {
        echo "Erro ao aprovar o comentário.";
    }
}


$sql = "SELECT id, name, email, comment, image, approved FROM comments";
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
                        if ($row['image']) {
                            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Image' width='100' height='100'></td>";
                        } else {
                            echo "<td>N/A</td>";
                        }
                        // Botões para excluir e aprovar o comentário
                        echo "<td>";
                        echo "<a href='comments.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Excluir</a> ";
                        if (!$row['approved']) {
                            echo "<a href='comments.php?approve_id=" . $row['id'] . "' class='btn btn-success btn-sm'>Aprovar</a>";
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