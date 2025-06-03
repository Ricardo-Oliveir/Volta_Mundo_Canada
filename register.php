<?php
session_start(); // Add session_start() at the beginning
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $raw_username = $_POST['username'] ?? '';
    $raw_password = $_POST['password'] ?? '';

    $username = trim($raw_username);
    $password = trim($raw_password); // Password is trimmed, then length checked, then hashed.

    // --- Input Validation ---
    if (empty($username) || empty($password)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Usuário e senha são obrigatórios.'];
        header("Location: register.php"); // Redirect back to register form
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'A senha deve ter pelo menos 8 caracteres.'];
        header("Location: register.php"); // Redirect back to register form
        exit;
    }

    // Proceed with database operations only if initial validation passes
    // Verificar se o usuário já existe
    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username); // Use trimmed username
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro: Nome de usuário já existe.'];
        header("Location: register.php"); // Redirect back to register form
        exit;
    } else {
        // Criptografar a senha
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Use trimmed password

        // Inserir o novo usuário no banco de dados
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Usuário registrado com sucesso! Você já pode fazer o login.'];
            header("Location: login.php"); // Redirect to login on success
            exit;
        } else {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro ao registrar usuário: ' . $stmt->error];
            header("Location: register.php"); // Redirect back to register form on DB error
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="login.php" class="btn btn-secondary">Clique aqui para logar</a> <!-- Link to login.php -->
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>