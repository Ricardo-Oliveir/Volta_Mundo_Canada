<?php
session_start(); // Add session_start() at the beginning
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve raw inputs first for validation
    $raw_name = $_POST['name'] ?? '';
    $raw_email = $_POST['email'] ?? '';
    $raw_comment = $_POST['comment'] ?? '';

    // --- Input Validation (Text Fields) ---
    $trimmed_name = trim($raw_name);
    $trimmed_email = trim($raw_email);
    $trimmed_comment = trim($raw_comment);

    if (empty($trimmed_name) || empty($trimmed_email) || empty($trimmed_comment)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Nome, email e comentário são obrigatórios.'];
        header("Location: index.php");
        exit;
    }

    if (!filter_var($trimmed_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Formato de email inválido.'];
        header("Location: index.php");
        exit;
    }

    // Apply htmlspecialchars after validation, before DB insertion
    $name = htmlspecialchars($trimmed_name);
    $email = htmlspecialchars($trimmed_email);
    $comment = htmlspecialchars($trimmed_comment);

    // --- Image Handling Variables ---
    $image_path = null; // Will store the path to the image, or null
    $upload_dir = 'uploads/images/';
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_file_size = 2 * 1024 * 1024; // 2MB

    // Check if upload directory exists and is writable
    if (!is_dir($upload_dir)) {
        // Attempt to create it (optional, task says script should be aware, not necessarily create)
        // if (!mkdir($upload_dir, 0755, true)) {
        //     echo "Erro: Diretório de uploads não existe e não pôde ser criado.";
        //     exit;
        // }
        // For this task, we error if it doesn't exist, as per instructions.
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => "Erro: Diretório de uploads '" . htmlspecialchars($upload_dir) . "' não existe. Por favor, crie este diretório."];
        header("Location: index.php");
        exit;
    }
    if (!is_writable($upload_dir)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => "Erro: Diretório de uploads '" . htmlspecialchars($upload_dir) . "' não tem permissão de escrita."];
        header("Location: index.php");
        exit;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $file_type = mime_content_type($tmp_name); // More reliable than $_FILES['image']['type']
        $file_size = $_FILES['image']['size']; 

        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro: Tipo de arquivo não permitido. Apenas JPG, PNG e GIF são aceitos.'];
            header("Location: index.php");
            exit;
        }

        // Validate file size
        if ($file_size > $max_file_size) {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Arquivo de imagem muito grande. Máximo permitido: 2MB.'];
            header("Location: index.php");
            exit;
        }

        // Generate unique filename (e.g., prefix_timestamp_random.extension)
        $original_filename = basename($_FILES['image']['name']);
        $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
        $sanitized_original_name = preg_replace("/[^a-zA-Z0-9_.-]/", "", pathinfo($original_filename, PATHINFO_FILENAME));
        if (empty($sanitized_original_name)) {
            $sanitized_original_name = 'image';
        }
        $unique_filename = $sanitized_original_name . '_' . uniqid() . '_' . time() . '.' . $file_extension;
        $destination = $upload_dir . $unique_filename;

        if (move_uploaded_file($tmp_name, $destination)) {
            $image_path = $destination; // Store relative path
        } else {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro ao mover o arquivo de imagem enviado.'];
            header("Location: index.php");
            exit;
        }
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {
        // Handle other upload errors
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro no upload da imagem: Código ' . $_FILES['image']['error']];
        header("Location: index.php");
        exit;
    }

    // The 'image' column (blob) will be NULL for new uploads.
    // The 'image_path' column will store the path or be NULL if no image.
    $stmt = $conn->prepare("INSERT INTO comments (name, email, comment, image_path, image) VALUES (?, ?, ?, ?, NULL)");
    $stmt->bind_param("ssss", $name, $email, $comment, $image_path);

    if ($stmt->execute()) {
        $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Comentário enviado com sucesso e aguardando aprovação!'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Erro ao enviar comentário: ' . $stmt->error];
    }

    $stmt->close();
    $conn->close();
    header("Location: index.php"); // Redirect back to index.php
    exit;
}
