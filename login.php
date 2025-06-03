<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Login</h2>

        <?php
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']); // Clear the message after displaying
            $alert_type = $message['type'] === 'error' ? 'danger' : 'success';
            echo "<div class='alert alert-{$alert_type} alert-dismissible fade show' role='alert'>";
            echo htmlspecialchars($message['text']);
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }
        ?>

        <form action="login_process.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-secondary">Clique aqui para cadastrar</a>
            <a href="index.php" class="btn btn-secondary">Voltar para o Index</a>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script> <!-- Changed to bundle for dismissible alerts -->
</body>

</html>
