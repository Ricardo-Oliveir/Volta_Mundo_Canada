<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Verificar se o usuário já existe
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Username already exists!";
        } else {
            // Criptografar a senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Inserir o novo usuário no banco de dados
            $query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                echo "User registered successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } else {
        echo "Please enter valid information!";
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
            <a href="login.html" class="btn btn-secondary">Clique aqui para logar</a>
        </form>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>